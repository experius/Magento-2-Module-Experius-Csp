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

class ConfigWhitelistCollector implements PolicyCollectorInterface
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

        foreach (FetchPolicy::POLICIES as $directive) {
            if (!str_ends_with($directive, '-src')) {
                //Skip any policy that isn't a "-src" policy
                continue;
            }

            //Collect configuration
            $configPath = substr($directive, 0,-4);
            $whitelistedValues = $this->scopeConfig->getValue("experius_csp/whitelist/$configPath");
            if (!$whitelistedValues) {
                //If nothing is set go to next entry
                continue;
            }
            $whitelistedArray = explode("\r\n", $whitelistedValues);
            foreach ($whitelistedArray as &$whitelistedValue) {
                //Clean any whitespace
                $whitelistedValue = trim($whitelistedValue);
            }
            $policies[] = new FetchPolicy(
                $directive,
                false,
                $whitelistedArray,
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


}
