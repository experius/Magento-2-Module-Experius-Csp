# Mage2 Module Experius Csp

    ``experius/module-csp``

 - [Installation](#markdown-header-installation)
 - [Main Functionalities](#markdown-header-main-functionalities)

## Installation
\* = in production please use the `--keep-generated` option

 - Install the module composer by running `composer require experius/module-csp`
 - enable the module by running `php bin/magento module:enable Experius_Csp`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Main Functionalities

Provide a basic Content Security Policy Allowed List and when the Resource should be blocked it will automatically be reported within the Experius CSP Report Table (experius_csp_report).

When there is a report found an error message will be show in the admin:

<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-Csp/master/Docs/Screenshots/csp-admin-notification.png" title="Admin Notification Error">
</p>

### IMPORTANT: Content Security Policy Report Only Mode
In the upcoming Magento 2.4 Release then the Content Security Policy Report Only Mode then will be disabled and it will validate strict.


The report-to has been disabled in this version because it is not working properly.
See: \Experius\Csp\Plugin\Magento\Framework\App\Response\HttpInterface::beforeSetHeader

### Basic Allowed List
Currently also contains the CSP for the following modules for which a PR has been created to their GitHub repo:

 - Dotdigital / Dotmailer Chat
 - Buckaroo

Besides that it contains an allowed list for:

 - Google Fonts
 - Google Apis such as Google Maps
 - Youtube Videos
 - commerce.adobedc.net for Magento_DataService
 - Several scripts you can you use in your Google Tagmanager0

### Content Security Policy Report
In the Magento Admin you can view the reports which are created.

    System > Tools > Csp Report

<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-Csp/master/Docs/Screenshots/report-view.png" title="Admin Content Security Policy Report View">
</p>

### Add a resource to the Allowed List
Based on the reports you can easily add a csp_whitelist.xml file within your own modules and when you are done just delete the record because it no longer is relevant.
More information about how this xml file works you can find here:

    https://devdocs.magento.com/guides/v2.3/extension-dev-guide/security/content-security-policies.html
    
For example Report:

 - document_uri: https://example.com/
 - referer:https://example.com/
 - violated_directive: img-src
 - original_policy: font-src fonts.googleapis.com fonts.gstatic.com https://www.gstatic.com https://fonts.gstatic.com 'self' 'unsafe-inline'; form-action 'self' 'unsafe-inline'; frame-ancestors 'self' 'unsafe-inline'; frame-src cdn.dnky.co youtube.com www.youtube.com https:/
 - blocked_uri: https://maps.gstatic.com/mapfiles/openhand_8_8.cur
 - date: 2020-06-25 16:42:23

Fix:

    # app/code/Custom/Csp/etc/csp_whitelist
    <?xml version="1.0"?>
    <csp_whitelist xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Csp:etc/csp_whitelist.xsd">
        <policies>
            <policy id="img-src">
                <values>
                    <value id="gstatic" type="host">*.gstatic.com</value>
                </values>
            </policy>
        </policies>
    </csp_whitelist>



