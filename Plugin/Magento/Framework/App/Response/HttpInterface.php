<?php
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Plugin\Magento\Framework\App\Response;

class HttpInterface
{

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
