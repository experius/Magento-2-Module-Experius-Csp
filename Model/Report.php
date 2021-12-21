<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Model;

use Experius\Csp\Api\Data\ReportInterface;
use Magento\Framework\Model\AbstractModel;

class Report extends AbstractModel implements ReportInterface
{
    public function _construct()
    {
        $this->_init(ResourceModel\Report::class);
    }

    /**
     * Get report_id
     * @return string|null
     */
    public function getReportId()
    {
        return $this->getData(self::REPORT_ID);
    }

    /**
     * Set report_id
     * @param string $reportId
     * @return ReportInterface
     */
    public function setReportId($reportId)
    {
        return $this->setData(self::REPORT_ID, $reportId);
    }

    /**
     * Get document_uri
     * @return string|null
     */
    public function getDocumentUri()
    {
        return $this->getData(self::DOCUMENT_URI);
    }

    /**
     * Set document_uri
     * @param string $documentUri
     * @return ReportInterface
     */
    public function setDocumentUri($documentUri)
    {
        return $this->setData(self::DOCUMENT_URI, $documentUri);
    }

    /**
     * Get referrer
     * @return string|null
     */
    public function getReferrer()
    {
        return $this->getData(self::REFERRER);
    }

    /**
     * Set referrer
     * @param string $referrer
     * @return ReportInterface
     */
    public function setReferrer($referrer)
    {
        return $this->setData(self::REFERRER, $referrer);
    }

    public function getFallbackDirective()
    {
        $directive = $this->getData(self::VIOLATED_DIRECTIVE);
        return self::DIRECTIVES_TO_FALLBACKS[$directive] ?? $directive;
    }

    /**
     * Get violated_directive
     * @return string|null
     */
    public function getViolatedDirective()
    {
        return $this->getData(self::VIOLATED_DIRECTIVE);
    }

    /**
     * Set violated_directive
     * @param string $violatedDirective
     * @return ReportInterface
     */
    public function setViolatedDirective($violatedDirective)
    {
        return $this->setData(self::VIOLATED_DIRECTIVE, $violatedDirective);
    }

    /**
     * Get original_policy
     * @return string|null
     */
    public function getOriginalPolicy()
    {
        return $this->getData(self::ORIGINAL_POLICY);
    }

    /**
     * Set original_policy
     * @param string $originalPolicy
     * @return ReportInterface
     */
    public function setOriginalPolicy($originalPolicy)
    {
        return $this->setData(self::ORIGINAL_POLICY, $originalPolicy);
    }

    /**
     * Get blocked_uri
     * @return string|null
     */
    public function getBlockedUri()
    {
        return $this->getData(self::BLOCKED_URI);
    }

    /**
     * Set blocked_uri
     * @param string $blockedUri
     * @return ReportInterface
     */
    public function setBlockedUri($blockedUri)
    {
        return $this->setData(self::BLOCKED_URI, $blockedUri);
    }

    /**
     * Get date
     * @return string|null
     */
    public function getDate()
    {
        return $this->getData(self::DATE);
    }

    /**
     * Set date
     * @param string $date
     * @return ReportInterface
     */
    public function setDate($date)
    {
        return $this->setData(self::DATE, $date);
    }

    /**
     * Get count
     * @return string|null
     */
    public function getCount()
    {
        return $this->getData(self::COUNT);
    }

    /**
     * Set count
     * @param string $count
     * @return ReportInterface
     */
    public function setCount($count)
    {
        return $this->setData(self::COUNT, $count);
    }

    /**
     * Get whitelist
     * @return string|null
     */
    public function getWhitelist()
    {
        return $this->getData(self::WHITELIST);
    }

    /**
     * Set whitelist
     * @param string $whitelist
     * @return ReportInterface
     */
    public function setWhitelist($whitelist)
    {
        return $this->setData(self::WHITELIST, $whitelist);
    }
}

