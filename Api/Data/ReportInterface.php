<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\Csp\Api\Data;

interface ReportInterface
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
    ];

    /**
     * Get report_id
     * @return string|null
     */
    public function getReportId();

    /**
     * Set report_id
     * @param string $reportId
     * @return $this
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
     * @return $this
     */
    public function setDocumentUri($documentUri);

    /**
     * Get referrer
     * @return string|null
     */
    public function getReferrer();

    /**
     * Set referrer
     * @param string $referrer
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
     */
    public function setDate($date);

    /**
     * Get Count
     * @return string|null
     */
    public function getCount();

    /**
     * @param $count
     * @return $this
     */
    public function setCount($count);

    /**
     * Get Whitelist
     * @return string|null
     */
    public function getWhitelist();

    /**
     * @param $whitelist
     * @return $this
     */
    public function setWhitelist($whitelist);
}
