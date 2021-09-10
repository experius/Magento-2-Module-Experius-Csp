<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Api\Data;

interface ReportInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const VIOLATED_DIRECTIVE = 'violated_directive';
    const REPORT_ID = 'report_id';
    const DOCUMENT_URI = 'document_uri';
    const REFERRER = 'referrer';
    const ORIGINAL_POLICY = 'original_policy';
    const DATE = 'date';
    const BLOCKED_URI = 'blocked_uri';
    const COUNT = 'count';
    const WHITELIST = 'whitelist';
    // Array of directives that are not in Magento\Csp\Model\Policy\FetchPolicy::POLICIES
    // but do have a fallback directive (cf. see https://www.w3.org/TR/CSP3/)
    const DIRECTIVES_TO_FALLBACKS = [
        'script-src-attr' => 'script-src',
        'script-src-elem' => 'script-src',
        'style-src-attr' => 'style-src',
        'style-src-elem' => 'style-src',
        'worker-src' => 'child-src',
//        'prefetch-src' => 'default-src',
    ];

    /**
     * Get report_id
     * @return string|null
     */
    public function getReportId();

    /**
     * Set report_id
     * @param string $reportId
     * @return \Experius\Csp\Api\Data\ReportInterface
     */
    public function setReportId($reportId);

    /**
     * Get document_uri
     * @return string|null
     */
    public function getDocumentUri();

    /**
     * Set document_uri
     * @param string $documentUri
     * @return \Experius\Csp\Api\Data\ReportInterface
     */
    public function setDocumentUri($documentUri);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Experius\Csp\Api\Data\ReportExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Experius\Csp\Api\Data\ReportExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Experius\Csp\Api\Data\ReportExtensionInterface $extensionAttributes
    );

    /**
     * Get referrer
     * @return string|null
     */
    public function getReferrer();

    /**
     * Set referrer
     * @param string $referrer
     * @return \Experius\Csp\Api\Data\ReportInterface
     */
    public function setReferrer($referrer);

    /**
     * Get violated_directive
     * @return string|null
     */
    public function getViolatedDirective();

    /**
     * Set violated_directive
     * @param string $violatedDirective
     * @return \Experius\Csp\Api\Data\ReportInterface
     */
    public function setViolatedDirective($violatedDirective);

    /**
     * Get original_policy
     * @return string|null
     */
    public function getOriginalPolicy();

    /**
     * Set original_policy
     * @param string $originalPolicy
     * @return \Experius\Csp\Api\Data\ReportInterface
     */
    public function setOriginalPolicy($originalPolicy);

    /**
     * Get blocked_uri
     * @return string|null
     */
    public function getBlockedUri();

    /**
     * Set blocked_uri
     * @param string $blockedUri
     * @return \Experius\Csp\Api\Data\ReportInterface
     */
    public function setBlockedUri($blockedUri);

    /**
     * Get date
     * @return string|null
     */
    public function getDate();

    /**
     * Set date
     * @param string $date
     * @return \Experius\Csp\Api\Data\ReportInterface
     */
    public function setDate($date);

    /**
     * Get Count
     * @return string|null
     */
    public function getCount();

    /**
     * @param $count
     * @return \Experius\Csp\Api\Data\ReportInterface
     */
    public function setCount($count);

    /**
     * Get Whitelist
     * @return string|null
     */
    public function getWhitelist();

    /**
     * @param $whitelist
     * @return \Experius\Csp\Api\Data\ReportInterface
     */
    public function setWhitelist($whitelist);
}
