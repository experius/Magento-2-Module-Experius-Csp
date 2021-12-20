<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Api;

use Experius\Csp\Api\Data\ReportInterface;
use Experius\Csp\Api\Data\ReportSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface ReportRepositoryInterface
{

    /**
     * Save Report
     * @param ReportInterface $report
     * @return ReportInterface
     * @throws LocalizedException
     */
    public function save(
        ReportInterface $report
    );

    /**
     * Retrieve Report
     * @param string $reportId
     * @return ReportInterface
     * @throws LocalizedException
     */
    public function get($reportId);

    /**
     * Retrieve Report matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return ReportSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Report
     * @param ReportInterface $report
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(
        ReportInterface $report
    );

    /**
     * Delete Report by ID
     * @param string $reportId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($reportId);
}

