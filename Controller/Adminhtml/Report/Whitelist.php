<?php
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Controller\Adminhtml\Report;

use Experius\Csp\Model\ReportRepository;

class Whitelist extends \Experius\Csp\Controller\Adminhtml\Report
{

    /**
     * @var ReportRepository
     */
    protected $reportRepository;

    /**
     * Whitelist constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param ReportRepository $reportRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        ReportRepository $reportRepository
    )
    {
        $this->reportRepository = $reportRepository;
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

                $message = $message = 'You whitelisted the Csp Report.';
                if ($report) {
                    $report->getWhitelist() ? $report->setWhitelist(false) && $message = 'You removed the Csp whitelisting for this Report.' : $report->setWhitelist(true);
                    $this->reportRepository->update($report);
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
}

