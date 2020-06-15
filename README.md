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

Provide a basic Content Security Policy Allowed List and when the Resource is blocked it will automatically be reported within the Experius CSP Report Table (experius_csp_report)

### CSP Read Only
The module will disable the Read Only mode to force you to correctly setup your Content Security Policy.
Besides that it gives you a quick start with the Basic Allowed List and the reports which are available in the Admin.

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
 - Several scripts you can you use in your Google Tagmanager

### CSP Report
In the Magento Admin you can view the reports which are created.

    System > Tools > Csp Report
    
   
Based on the reports you can easily add a csp_whitelist.xml file within your own modules and when you are done just delete the record because it no longer is relevant.
More information about how this xml file works you can find here:

    https://devdocs.magento.com/guides/v2.3/extension-dev-guide/security/content-security-policies.html


