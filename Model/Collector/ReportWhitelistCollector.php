<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Model\Collector;

use Magento\Csp\Api\PolicyCollectorInterface;
use Magento\Csp\Model\Policy\FetchPolicy;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Experius\Csp\Model\ReportRepository;

class ReportWhitelistCollector implements PolicyCollectorInterface
{
    /**
     * @var ResourceConnection
     */
    protected $connection;

    /**
     * @var bool
     */
    protected $storeUrls = false;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var ReportRepository
     */
    protected $reportRepository;

    /**
     * CustomWhitelistCollector constructor.
     *
     * @param ResourceConnection $connection
     * @param ScopeConfigInterface $scopeConfig
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param ReportRepository $reportRepository
     */
    public function __construct(
        ResourceConnection $connection,
        ScopeConfigInterface $scopeConfig,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ReportRepository $reportRepository
    ) {
        $this->connection = $connection;
        $this->scopeConfig = $scopeConfig;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->reportRepository = $reportRepository;
    }

    /**
     * @inheritDoc
     */
    public function collect(array $defaultPolicies = []): array
    {
        $policies = $defaultPolicies;
        $customWhitelist = $this->collectCustomWhitelist();
        if (!$customWhitelist) {
            return $policies;
        }
        foreach ($customWhitelist as $whitelist) {
            $hostSource = $whitelist->getBlockedUri();
            // Skip empty entries
            if (strlen($hostSource) < 1) {
                continue;
            }

            $policies[] = new FetchPolicy(
                $whitelist->getViolatedDirective(),
                false,
                [$hostSource],
                [],
                false,
                false,
                false,
                [],
                [],
                false,
                false
            );
        }

        return $policies;
    }

    /**
     * @return \Experius\Csp\Api\Data\ReportInterface[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function collectCustomWhitelist()
    {
        // Get custom csp which need to be whitelisted
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('whitelist', 1)
            ->create();

        $whitelistedCspEntities = $this->reportRepository->getList($searchCriteria);

        if ($whitelistedCspEntities->getTotalCount() < 1) {
            return [];
        }
        return $whitelistedCspEntities->getItems();
    }
}
