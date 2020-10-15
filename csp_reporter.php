<?php
// phpcs:ignoreFile
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
$devBootstrap = realpath(__DIR__) . '/app/bootstrap.php';
$liveBootstrap = realpath(__DIR__) . '/../app/bootstrap.php';

if (is_file($devBootstrap)) {
    include $devBootstrap;
} elseif (is_file($liveBootstrap)) {
    include $liveBootstrap;
}

$bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $_SERVER);

$objectManager = $bootstrap->getObjectManager();
$data = file_get_contents('php://input');
if ($data) {
    try {
        $obj = json_decode($data);
        if (isset($obj->{'csp-report'}) && $obj->{'csp-report'}) {
            $reportRepository = $objectManager->get('Experius\Csp\Api\ReportRepositoryInterface');
            $reportInterfaceFactory = $objectManager->get('Experius\Csp\Api\Data\ReportInterfaceFactory');
            /** @var ReportInterface $report */
            $report = $reportInterfaceFactory->create();
            $report->setDocumentUri($obj->{'csp-report'}->{'document-uri'});
            $report->setReferrer($obj->{'csp-report'}->{'referrer'});
            $report->setViolatedDirective($obj->{'csp-report'}->{'violated-directive'});
            $report->setOriginalPolicy($obj->{'csp-report'}->{'original-policy'});
            $report->setBlockedUri($obj->{'csp-report'}->{'blocked-uri'});
            $report->setDate(date("Y-m-d H:i:s"));
            $reportRepository->save($report);
        }
    } catch (\Exception $exception) {
        file_put_contents(BP . '/var/log/csp-report-exception.log', $exception->getMessage(), FILE_APPEND | LOCK_EX);
    }
}
