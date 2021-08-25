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
use Magento\Framework\App\Config\ScopeConfigInterface;

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
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * DynamicCollector constructor.
     * @param ResourceConnection $connection
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ResourceConnection $connection,
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->connection = $connection;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function collect(array $defaultPolicies = []): array
    {
        if (!$this->isEnabled() || !$defaultPolicies) {
            return $defaultPolicies;
        }
        $policies = [];
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
        if (!$this->scopeConfig->getValue('experius_csp/general/add_all_storefront_urls')) {
            return false;
        }

        if ($this->storeUrls) {
            return $this->storeUrls;
        }

        $connection = $this->connection->getConnection();

        $table = $connection->getTableName('core_config_data');
        $select = $connection->select()->from($table, "value")->distinct()
            ->where("value IS NOT NULL")
            ->where("path in (?)",  ['web/unsecure/base_url', 'web/unsecure/base_media_url', 'web/unsecure/base_static_url', 'web/unsecure/base_link_url']);

        $results = $connection->fetchCol($select);
        if (!$results && !empty($results)) {
            return false;
        }

        foreach ($results as &$result) {
            //Strip url down to just the domain.
            preg_match('#//([^/]*)/#', $result, $matches);
            if ($matches) {
                $result = $matches[1];
            }
        }

        $this->storeUrls = array_unique($results);

        return $this->storeUrls;
    }
}
