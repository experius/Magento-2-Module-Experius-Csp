<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Model\Collector;

use Magento\Csp\Api\PolicyCollectorInterface;
use Magento\Csp\Model\Policy\FetchPolicy;
use Magento\Framework\App\ResourceConnection;

/**
 * CSPs dynamically added during the rendering of current page (from .phtml templates for instance).
 */
class DynamicCollector implements PolicyCollectorInterface
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
     * DynamicCollector constructor.
     * @param ResourceConnection $connection
     */
    public function __construct(
        ResourceConnection $connection
    )
    {
        $this->connection = $connection;
    }

    /**
     * @inheritDoc
     */
    public function collect(array $defaultPolicies = []): array
    {
        foreach ($defaultPolicies as $policy) {

            $policies[] = new FetchPolicy(
                $policy->getId(),
                false,
                $this->getAdditionalUrls($policy),
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

        return array_merge($defaultPolicies, $policies);
    }

    /**
     * @param $policy
     * @return array|bool
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function getAdditionalUrls($policy)
    {
        $urls = $this->getStoreUrls();

        if ($urls) {
            return $urls;
        }
        return [];
    }

    /**
     * @return array|bool
     */
    public function getStoreUrls()
    {
        if ($this->storeUrls) {
            return $this->storeUrls;
        }

        $connection = $this->connection->getConnection();

        $table = $connection->getTableName('core_config_data');
        $sql = "SELECT DISTINCT TRIM(BOTH '/' FROM value) FROM $table WHERE path LIKE 'web/unsecure/base_url'";

        $results = $connection->fetchCol($sql);

        if (!$results && !empty($results)) {
            return false;
        }

        $this->storeUrls = $results;

        return $results;
    }
}
