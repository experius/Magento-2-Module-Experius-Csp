<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Model\Collector;

use Magento\Csp\Api\PolicyCollectorInterface;
use Magento\Csp\Model\Policy\FetchPolicy;
use Magento\Framework\Url\ScopeResolverInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class StoreUrlCollector implements PolicyCollectorInterface
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var ScopeResolverInterface
     */
    protected $scopeResolver;

    /**
     * @var array
     */
    protected $storeUrls = [];

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param ScopeResolverInterface $scopeResolver
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ScopeResolverInterface $scopeResolver
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->scopeResolver = $scopeResolver;
    }

    /**
     * Is enabled
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        // Global scope setting only
        return $this->scopeConfig->isSetFlag('experius_csp/general/add_all_storefront_urls');
    }

    /**
     * @inheritDoc
     */
    public function collect(array $defaultPolicies = []): array
    {
        if (!$this->isEnabled() || !$defaultPolicies) {
            return $defaultPolicies;
        }

        $policies = $defaultPolicies;

        // Append all store urls to all default policies
        foreach ($defaultPolicies as $policy) {
            $policies[] = new FetchPolicy(
                $policy->getId(),
                false,
                $this->getStoreUrls(),
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
     * Get store urls
     *
     * @return array
     */
    public function getStoreUrls(): array
    {
        if (!empty($this->storeUrls)) {
            return $this->storeUrls;
        }

        try {
            $baseUrls = [];
            foreach ($this->scopeResolver->getScopes() as $scope) {
                $baseUrls[] = $scope->getBaseUrl();
                $baseUrls[] = $scope->getBaseUrl(UrlInterface::URL_TYPE_LINK, true);
            }

            $this->storeUrls = array_unique($baseUrls);
            return $this->storeUrls;
        } catch (\Exception $e) {
            return [];
        }
    }
}
