<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Model\Block\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Whitelist implements OptionSourceInterface
{
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;
    const STATUS_NOT_ALLOWED = 2;

    /**
     * @var null|array
     */
    protected $options = null;

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        if (is_null($this->options)) {
            $availableOptions = $this->getAvailableStatuses();
            $options = [];
            foreach ($availableOptions as $key => $value) {
                $options[] = [
                    'label' => $value,
                    'value' => $key,
                ];
            }
            $this->options = $options;
        }
        return $this->options;
    }

    /**
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [
            self::STATUS_ENABLED => 'Enabled',
            self::STATUS_DISABLED => 'Disabled',
            self::STATUS_NOT_ALLOWED => 'Not allowed'
        ];
    }
}
