<?php
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Model;

use Experius\Csp\Api\Data\ReportInterfaceFactory;
use Experius\Csp\Api\Data\ReportSearchResultsInterfaceFactory;
use Experius\Csp\Api\ReportRepositoryInterface;
use Experius\Csp\Model\ResourceModel\Report as ResourceReport;
use Experius\Csp\Model\ResourceModel\Report\CollectionFactory as ReportCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\AbstractAggregateException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class ReportRepository implements ReportRepositoryInterface
{

    protected $reportFactory;

    protected $extensibleDataObjectConverter;
    protected $reportCollectionFactory;

    protected $dataObjectHelper;

    protected $resource;

    private $storeManager;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $dataReportFactory;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $searchCriteriaBuilder;

    /**
     * ReportRepository constructor.
     * @param ResourceReport $resource
     * @param ReportFactory $reportFactory
     * @param ReportInterfaceFactory $dataReportFactory
     * @param ReportCollectionFactory $reportCollectionFactory
     * @param ReportSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        ResourceReport $resource,
        ReportFactory $reportFactory,
        ReportInterfaceFactory $dataReportFactory,
        ReportCollectionFactory $reportCollectionFactory,
        ReportSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->resource = $resource;
        $this->reportFactory = $reportFactory;
        $this->reportCollectionFactory = $reportCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataReportFactory = $dataReportFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Experius\Csp\Api\Data\ReportInterface $report
    ) {
        /* if (empty($report->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $report->setStoreId($storeId);
        } */

        // random microsecond to prevent double saves
        $sleep = rand(1, 1000000);
        usleep($sleep);
        // check for existing report
        $existingReport = $this->checkReportExist($report);

        if(!$existingReport) {
            try {
                $this->resource->save($this->createReportModel($report));
            } catch (\Exception $exception) {
                throw new CouldNotSaveException(__(
                    'Could not save the report: %1',
                    $exception->getMessage()
                ));
            }
            return $report->getDataModel();
        } else {
            $existingReport->setCount($existingReport->getCount() + 1);
            $this->resource->save($this->createReportModel($existingReport));

            return $existingReport->getDataModel();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get($reportId)
    {
        $report = $this->reportFactory->create();
        $this->resource->load($report, $reportId);
        if (!$report->getId()) {
            throw new NoSuchEntityException(__('Report with id "%1" does not exist.', $reportId));
        }
        return $report->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->reportCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Experius\Csp\Api\Data\ReportInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Experius\Csp\Api\Data\ReportInterface $report
    ) {
        try {
            $reportModel = $this->reportFactory->create();
            $this->resource->load($reportModel, $report->getReportId());
            $this->resource->delete($reportModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Report: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($reportId)
    {
        return $this->delete($this->get($reportId));
    }

    /**
     * @param $report
     * @return \Experius\Csp\Api\Data\ReportInterface|false|mixed
     */
    public function checkReportExist($report)
    {
        if ($report) {
            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter('violated_directive', $report->getViolatedDirective(), 'eq')
                ->addFilter('blocked_uri', $report->getBlockedUri(), 'eq')
                ->addFilter('document_uri', $report->getDocumentUri(), 'eq')
                ->create();

            $report = reset($this->getList($searchCriteria)->getItems());
        }

        return $report;
    }

    public function createReportModel($report)
    {
        $reportData = $this->extensibleDataObjectConverter->toNestedArray(
            $report,
            [],
            \Experius\Csp\Api\Data\ReportInterface::class
        );

        return $this->reportFactory->create()->setData($reportData);
    }
}

