<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Model\Data;

use Experius\Csp\Api\Data\ReportInterface;

class Report extends \Magento\Framework\Api\AbstractExtensibleObject implements ReportInterface
{

    /**
     * Get report_id
     * @return string|null
     */
    public function getReportId()
    {
        return $this->_get(self::REPORT_ID);
    }

    /**
     * Set report_id
     * @param string $reportId
     * @return \Experius\Csp\Api\Data\ReportInterface
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
        return $this->_get(self::DOCUMENT_URI);
    }

    /**
     * Set document_uri
     * @param string $documentUri
     * @return \Experius\Csp\Api\Data\ReportInterface
     */
    public function setDocumentUri($documentUri)
    {
        return $this->setData(self::DOCUMENT_URI, $documentUri);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Experius\Csp\Api\Data\ReportExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Experius\Csp\Api\Data\ReportExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Experius\Csp\Api\Data\ReportExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get referrer
     * @return string|null
     */
    public function getReferrer()
    {
        return $this->_get(self::REFERRER);
    }

    /**
     * Set referrer
     * @param string $referrer
     * @return \Experius\Csp\Api\Data\ReportInterface
     */
    public function setReferrer($referrer)
    {
        return $this->setData(self::REFERRER, $referrer);
    }

    /**
     * Get violated_directive
     * @return string|null
     */
    public function getViolatedDirective()
    {
        return $this->_get(self::VIOLATED_DIRECTIVE);
    }

    /**
     * Set violated_directive
     * @param string $violatedDirective
     * @return \Experius\Csp\Api\Data\ReportInterface
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
        return $this->_get(self::ORIGINAL_POLICY);
    }

    /**
     * Set original_policy
     * @param string $originalPolicy
     * @return \Experius\Csp\Api\Data\ReportInterface
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
        return $this->_get(self::BLOCKED_URI);
    }

    /**
     * Set blocked_uri
     * @param string $blockedUri
     * @return \Experius\Csp\Api\Data\ReportInterface
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
        return $this->_get(self::DATE);
    }

    /**
     * Set date
     * @param string $date
     * @return \Experius\Csp\Api\Data\ReportInterface
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
        return $this->_get(self::COUNT);
    }

    /**
     * Set count
     * @param string $count
     * @return \Experius\Csp\Api\Data\ReportInterface
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
        return $this->_get(self::WHITELIST);
    }

    /**
     * Set whitelist
     * @param string $whitelist
     * @return \Experius\Csp\Api\Data\ReportInterface
     */
    public function setWhitelist($whitelist)
    {
        return $this->setData(self::WHITELIST, $whitelist);
    }
}

