<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Plugin\Magento\Csp\Api\Data;

use Magento\Framework\App\Config\ScopeConfigInterface;

class ModeConfiguredInterface
{
    const XML_PATH_CSP_REPORTING_ENABLED = 'experius_csp/general/reporting_enabled';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * After getReportUri() plugin to be able to disable Content Security Policy reporting using configuration
     *
     * @param \Magento\Csp\Api\Data\ModeConfiguredInterface $subject
     * @param $result
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetReportUri(
        \Magento\Csp\Api\Data\ModeConfiguredInterface $subject,
        $result
    ): ?string {
        if (!$this->scopeConfig->isSetFlag(self::XML_PATH_CSP_REPORTING_ENABLED)) {
            // Return empty reporting url to disable reporting
            return null;
        }

        return $result;
    }
}
