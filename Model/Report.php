<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Model;

use Experius\Csp\Api\Data\ReportInterface;
use Experius\Csp\Api\Data\ReportInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Report extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $_eventPrefix = 'experius_csp_report';
    protected $reportDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ReportInterfaceFactory $reportDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Experius\Csp\Model\ResourceModel\Report $resource
     * @param \Experius\Csp\Model\ResourceModel\Report\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ReportInterfaceFactory $reportDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Experius\Csp\Model\ResourceModel\Report $resource,
        \Experius\Csp\Model\ResourceModel\Report\Collection $resourceCollection,
        array $data = []
    ) {
        $this->reportDataFactory = $reportDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve report model with report data
     * @return ReportInterface
     */
    public function getDataModel()
    {
        $reportData = $this->getData();
        
        $reportDataObject = $this->reportDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $reportDataObject,
            $reportData,
            ReportInterface::class
        );
        
        return $reportDataObject;
    }
}

