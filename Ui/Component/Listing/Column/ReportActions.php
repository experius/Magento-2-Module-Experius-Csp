<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Ui\Component\Listing\Column;

use Experius\Csp\Model\ReportRepository;
use Magento\Csp\Model\Collector\Config\FetchPolicyReader;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class ReportActions extends Column
{
    const URL_PATH_VIEW = 'experius_csp/report/view';
    const URL_PATH_DETAILS = 'experius_csp/report/details';
    const URL_PATH_DELETE = 'experius_csp/report/delete';
    const URL_PATH_WHITELIST = 'experius_csp/report/whitelist';

    /**
     * @var ReportRepository
     */
    protected $reportRepository;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var FetchPolicyReader
     */
    protected $fetchPolicyReader;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param ReportRepository $reportRepository
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        ReportRepository $reportRepository,
        FetchPolicyReader $fetchPolicyReader,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->reportRepository = $reportRepository;
        $this->fetchPolicyReader = $fetchPolicyReader;
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
                    $hostSource = $this->reportRepository->extractHostSource($item['blocked_uri']);
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
                                'title' => __('Delete %1', $hostSource),
                                'message' => __('Are you sure you wan\'t to delete this record?')
                            ]
                        ],
                    ];
                    if ($this->fetchPolicyReader->canRead($item['violated_directive'])) {
                        $message = $item['whitelist'] ? __('Are you sure you want to de-whitelist this record?') : __('Are you sure you want to whitelist this record?');
                        $item[$this->getData('name')]['whitelist'] = [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_WHITELIST,
                                [
                                    'report_id' => $item['report_id']
                                ]
                            ),
                            'label' => $item['whitelist'] ? __('De-whitelist') : __('Whitelist'),
                            'confirm' => [
                                'title' => __('Whitelist %1', $hostSource),
                                'message' => $message
                            ]
                        ];
                    }
                }
            }
        }

        return $dataSource;
    }
}
