<?php
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Model\Message;

use Magento\Framework\Notification\MessageInterface;
use Magento\Framework\UrlInterface;
use Experius\Csp\Api\ReportRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class ReportErrors implements MessageInterface
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var ReportRepositoryInterface
     */
    protected $reportRepository;

    /**
     * @var SearchCriteriaInterface
     */
    protected $searchCriteria;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * ReportErrors constructor.
     *
     * @param ReportRepositoryInterface $reportRepository
     * @param UrlInterface $urlBuilder
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        ReportRepositoryInterface $reportRepository,
        UrlInterface $urlBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->reportRepository = $reportRepository;
        $this->urlBuilder = $urlBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @return bool|mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function isDisplayed()
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->setCurrentPage(1)
            ->setPageSize(1);
        $reportList = $this->reportRepository->getList($searchCriteria->create());
        return $reportList->getTotalCount();
    }

    /**
     * Retrieve unique message identity
     *
     * @return string
     */
    public function getIdentity()
    {
        return 'experius_csp_report_message';
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getText()
    {
        $url = $this->urlBuilder->getUrl('experius_csp/report/index');
        return __(
            '<style>
                 .message-system-collapsible a.csp-error {
                    color: #e22626;
                 }
              </style>
              <a href="%1" class="csp-error">
                <b>Content Security Policy Issue Found</b><br />
                View CSP Reports - make sure you update the Content Security Policy or your site won`t work properly in 2.4.
              </a>',
            $url
        );
    }

    /**
     * @return int
     */
    public function getSeverity()
    {
        return self::SEVERITY_CRITICAL;
    }
}
