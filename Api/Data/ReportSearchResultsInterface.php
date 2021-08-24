<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Api\Data;

interface ReportSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Report list.
     * @return \Experius\Csp\Api\Data\ReportInterface[]
     */
    public function getItems();

    /**
     * Set document_uri list.
     * @param \Experius\Csp\Api\Data\ReportInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

