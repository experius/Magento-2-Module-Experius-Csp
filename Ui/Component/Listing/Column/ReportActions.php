<?php
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Ui\Component\Listing\Column;

use Experius\Csp\Model\ReportRepository;

class ReportActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var ReportRepository
     */
    protected $reportRepository;

    const URL_PATH_VIEW = 'experius_csp/report/view';
    const URL_PATH_DETAILS = 'experius_csp/report/details';
    protected $urlBuilder;
    const URL_PATH_DELETE = 'experius_csp/report/delete';
    const URL_PATH_WHITELIST = 'experius_csp/report/whitelist';

    /**
     * ReportActions constructor.
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     * @param ReportRepository $reportRepository
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        ReportRepository $reportRepository
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->reportRepository = $reportRepository;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['report_id'])) {
                    $strippedBlockedUrl = $this->reportRepository->stripBlockedUrl($item['blocked_uri']);
                    $message = $item['whitelist'] ? 'Are you sure you wan\'t to de-whitelist this record?' : 'Are you sure you wan\'t to whitelist this record?';
                    $item[$this->getData('name')] = [
                        'view' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_VIEW,
                                [
                                    'report_id' => $item['report_id']
                                ]
                            ),
                            'label' => __('View')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'report_id' => $item['report_id']
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete %1', $strippedBlockedUrl),
                                'message' => __('Are you sure you wan\'t to delete this record?')
                            ]
                        ],
                        'whitelist' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_WHITELIST,
                                [
                                    'report_id' => $item['report_id']
                                ]
                            ),
                            'label' => __('Whitelist'),
                            'confirm' => [
                                'title' => __('Whitelist %1', $strippedBlockedUrl),
                                'message' => __($message)
                            ]
                        ],
                    ];
                }
            }
        }

        return $dataSource;
    }
}

