<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface ReportSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get Report list.
     * @return ReportInterface[]
     */
    public function getItems();

    /**
     * Set document_uri list.
     * @param ReportInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

