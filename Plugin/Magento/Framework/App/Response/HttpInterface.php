<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Plugin\Magento\Framework\App\Response;

class HttpInterface
{
    /**
     * @param \Magento\Framework\App\Response\HttpInterface $subject
     * @param $name
     * @param $value
     * @param false $replace
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeSetHeader(
        \Magento\Framework\App\Response\HttpInterface $subject,
        $name,
        $value,
        $replace = false
    ) {
        if ($name == 'Content-Security-Policy' || $name == 'Content-Security-Policy-Report-Only') {
            $value = str_replace(' report-to report-endpoint;', '', $value);
        }
        return [$name, $value, $replace];
    }
}
