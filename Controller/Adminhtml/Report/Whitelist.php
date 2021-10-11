<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Controller\Adminhtml\Report;

use Experius\Csp\Api\Data\ReportInterface;
use Experius\Csp\Model\ReportRepository;
use Experius\Elasticsearch\Lib\Search;
use Magento\Framework\Api\SearchCriteriaBuilder;

class Whitelist extends \Experius\Csp\Controller\Adminhtml\Report
{
    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var ReportRepository
     */
    protected $reportRepository;

    /**
     * Whitelist constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param ReportRepository $reportRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry         $coreRegistry,
        ReportRepository                    $reportRepository,
        SearchCriteriaBuilder               $searchCriteriaBuilder
    ) {
        $this->reportRepository = $reportRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Whitelist action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be whitelisted
        $id = $this->getRequest()->getParam('report_id');
        if ($id) {
            try {
                $report = $this->reportRepository->get($id);

                if ($report) {
                    if ($report->getWhitelist()) {
                        $report->setWhitelist(false);
                        $message = 'You removed the Csp whitelisting for this Report.';
                        $whitelisted = false;
                    } else {
                        $report->setWhitelist(true);
                        $message = 'You whitelisted the Csp Report.';
                        $whitelisted = true;
                    }
                    $this->reportRepository->update($report);
                    $this->checkForIdenticalReports($report, $whitelisted);
                }

                // display success message
                $this->messageManager->addSuccessMessage(__($message));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to view
                return $resultRedirect->setPath('*/*/view', ['report_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Csp Report to whitelist.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }

    private function checkForIdenticalReports(
        ReportInterface $report,
        bool $whitelisted
    ) {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('whitelist', $whitelisted ? 0 : 1)
            ->addFilter('blocked_uri', $report->getBlockedUri())
            ->addFilter('violated_directive', $report->getViolatedDirective())
            ->create();

        $identicalReports = $this->reportRepository->getList($searchCriteria)->getItems();
        if (!count($identicalReports)) {
            return;
        }

        foreach($identicalReports as $identicalReport) {
            $whitelisted
                ? $identicalReport->setWhitelist(true)
                : $identicalReport->setWhitelist(false);
            $this->reportRepository->update($identicalReport);
        }
    }
}

