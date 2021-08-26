## 1.6.0 (2021-08-26)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.6.0)

*  [FEATURE][SFIN-60] Started custom whitelist add via admin grid *(martijn.vanhaagen)*
*  [FEATURE][SFIN-60] Added functionality to whitelist scripts via admin grid + colors in enable/disable + refactored some code *(martijn.vanhaagen)*
*  [REFACTOR][BUGFIX][DLTM2-617] Store url directive addition doesn't really work properly. Refactored DynamicCollector to properly use scoperesolver supplied by Magento (instead of hard-coded sql). Improved configuration to properly reflect global scope of this setting. *(Boris van Katwijk)*
*  [REFACTOR][DLTM2-617] Rename policy from "dynamic" to "all-store-urls" to better reflect it's workings. *(Boris van Katwijk)*
*  [BUGFIX][DLTM2-617] "Add all store urls" to whitelist policy is a "text" configuration whilst it is ment to be a "select" with Yes/No source model. *(Boris van Katwijk)*
*  [BUGFIX][DLTM2-617] *.[base_url] wildcard system does not work. Reverted it to pure base url logic for adding all store urls. *(Boris van Katwijk)*
*  [REFACTOR][SFIN-60] Refactor of whitelist addition; it should be full domain to work; "*".[url] wildcard syntax does not seem to work for these. Clarified type of collector by renaming it to "ConfiguredWhitelistCollector". *(Boris van Katwijk)*
*  [FEATURE][SFIN-60] Made "current policy" hidden for default CSP report view; since it is often very large. *(Boris van Katwijk)*
*  [FEATURE][SFIN-60] Right trim the slash off all store urls. Correctly extract "host source" from whitelisted urls to add them to the whitelist for the Content Security Policy. *(Boris van Katwijk)*
*  [FEATURE][ARCI-151] Put collector for all store urls after the configured whitelist collector to also add store urls to custom directives. *(Boris van Katwijk)*
*  [BUGFIX][ARCI-151] Styling (red and green) doesn't work if "Enabled" or "Disabled" are translated, since it's value is required to be exactly these values for the knockout styling to work. *(Boris van Katwijk)*
*  [BUGFIX][ARCI-151] Not allowed policies can be reported such as "script-src-elem". Whitelisting these results in breaking all of the CSP whitelist workings. To prevent this only allowed policies can be whitelisted with configuration. *(Boris van Katwijk)*
*  [REFACTOR][ARCI-151] Move message inside allowed directives for "whitelist action" in csp report listing. Add "De-whitelist" label to whitelist toggle action and make labels translatable strings. *(Boris van Katwijk)*
*  [REFACTOR][ARCI-151] Refactor name of menu item and reporting page from "Csp Report" to "CSP reporting & whitelist". *(Boris van Katwijk)*
*  [BUGFIX][SFIN-60][ARCI-151] Existing original policy isn't updated when adding to the hitcount. Update this on upping the hitcount to accurately display the most recent policy. *(Boris van Katwijk)*
*  [DOCS][ARCI-151] Update copyright to include "B.V." in company name. *(Boris van Katwijk)*
*  [FEATURE][SFIN-60][ARCI-151] Include "Not allowed" as type of whitelist to clearly display the "violated directives" which aren't allowed to be whitelisted. *(Boris van Katwijk)*
*  [DOCS][ARCI-151] Updated README.md with new whitelist feature; general update of README.md. *(Boris van Katwijk)*


## 1.5.0 (2021-08-25)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.5.0)

*  [FEATURE][SBAS-1452] Refactored database queries and added support for alternative media, static or link domains *(René Schep)*


## 1.4.0 (2021-08-12)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.4.0)

*  [FEATURE][AOM2-172] Started using count in reports *(martijn.vanhaagen)*
*  [FEATURE][DONS-156] Added delay + fixed filters *(martijn.vanhaagen)*
*  [BUGFIX][AOM2-172] Fatal error: Uncaught Error: Undefined class constant 'COUNT' in ReportInterface instances. *(Boris van Katwijk)*
*  [BUGFIX][AOM2-172] Refactor report existance in save() function to properly function without any reports being active. Small simplification/cleanup for ease of reading the code. *(Boris van Katwijk)*
*  [REFACTOR][AOM2-172] Sleep for a random millisecond instead of microsecond to avoid the difference being smaller than the save time, which would result in duplicate CSP reports. *(Boris van Katwijk)*


## 1.3.7 (2021-07-19)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.3.7)

*  [FEATURE][SBN-184]  Add google ad services to whitelist *(Matthijs Breed)*


## 1.3.6 (2021-06-30)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.3.6)

*  Update csp_whitelist.xml *(Hexmage)*


## 1.3.5 (2021-06-30)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.3.5)

*  Added mouseflow *(Hexmage)*


## 1.3.4 (2021-06-28)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.3.4)

*  [BUGFIX][DOBO-262] - Remove the config change that disables report_only in the backend on module installation *(cassatter)*


## 1.3.3 (2021-06-18)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.3.3)

*  [BUGFIX][DONS-148] ACL nesting is broken since the introduction of the settings; restored this. *(Boris van Katwijk)*


## 1.3.2 (2021-06-16)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.3.2)

*  [FEATURE][ARCI-143] Made notice/error bar less red. *(Boris van Katwijk)*
*  [BUGFIX][DLTM2-617][ARCI-143] Configuration did not have a "tab". ACL is missing for configuration. *(Boris van Katwijk)*
*  [FEATURE][ARCI-143] Add "on/off" switch (configuration setting) to toggle reporting on and off by NOT returning the reporting url csp_reporting.php when the reporting setting is disabled. Default is enabled. *(Boris van Katwijk)*


## 1.3.1 (2021-06-11)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.3.1)

*  [BUGFIX] Blank screen due to erro *(florisschreuder)*


## 1.3.0 (2021-06-09)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.3.0)

*  [FEATURE][DLTSM2-617] dynamically add base urls of all stores to csp list *(Derrick Heesbeen)*
*  [FEATURE][DLTM2-617] Added config setting to add store urls dynamically *(Derrick Heesbeen)*


## 1.2.30 (2021-05-10)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.30)

*  [FEATURE][SXLMP-327] - Expand CSP Whitelist *(cassatter)*


## 1.2.29 (2021-05-05)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.29)

*  [FEATURE] Added support for local fonts. *(Hexmage)*


## 1.2.28 (2021-04-15)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.28)

*  [FEATURE][NAU-712] Added new whitelisted hosts *(JobStoker)*
*  [DOCS] Updated the CHANGELOG.md *(JobStoker)*


## 1.2.27 (2021-03-22)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.27)

*  [FEATURE][SMSE-216] Add jsdelivr CDN, used by snowdog/frontools *(Matthijs Breed)*


## 1.2.16 (2021-03-15)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.16)

*  [BUGFIX] Increased size of database fields because they were to small. *(Hexmage)*


## 1.2.15 (2021-03-15)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.15)

*  [FEATURE] Added nr-data.net to whitelist *(Hexmage)*


## 1.2.14 (2021-02-02)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.14)

*  [FEATURE][DDIJK-229] Added zendesk and newrelic to whitelist to resolve reports for dijkstra *(Quinn Stadens)*
*  [DOCS] Updated the CHANGELOG.md *(Quinn Stadens)*
*  CHANGELOG.md changed *(Quinn Stadens)*


## 1.2.13 (2020-10-30)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.13)

*  [FEATURE][PSTR-151] Trustpilot added to style-src in whitelist *(Quinn Stadens)*


## 1.2.12 (2020-10-30)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.12)

*  [FEATURE][PSTR-151] Trustpilot added to whitelist *(Quinn Stadens)*


## 1.2.11 (2020-10-28)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.11)

*  [DOCS] Modified the COPYING.txt *(Lewis Voncken)*


## 1.2.10 (2020-10-15)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.10)

*  [REFACTOR] [BACI-123] solved errors based on php code sniffer *(Lewis Voncken)*


## 1.2.9 (2020-10-15)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.9)

*  [REFACTOR] Removed unused code or added suppression when unused code is allowed and applied phpcs fixes *(Lewis Voncken)*


## 1.2.8 (2020-09-23)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.8)

*  Update csp_whitelist.xml *(Derrick Heesbeen)*
*  [TASK] added amcglobal to connect-src *(Derrick Heesbeen)*


## 1.2.7 (2020-08-28)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.7)

*  [FEATURE] Added facebook, feedbackcompany and zendesk chat to csp whitelist *(Matthijs Breed)*
*  Update csp_whitelist.xml *(Matthijs Breed)*


## 1.2.6 (2020-08-11)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.6)

*  [FEATURE][SUBI-145] - Whitelisted reported scripts based on patch 2.3.5-p2 *(Ton Matton)*


## 1.1.1 (2020-08-03)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.1.1)



## 1.2.5 (2020-08-03)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.5)

*  [TASK] Additional defaults proposal *(Derrick Heesbeen)*
*  Update csp_whitelist.xml *(Derrick Heesbeen)*
*  [TASK] added demdex and everesttech amcglobal (admin notices) *(Derrick Heesbeen)*


## 1.2.4 (2020-07-16)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.4)

*  [FEATURE] added gallery.mailchimp.com to the allowed list for img-src *(Lewis Voncken)*


## 1.2.3 (2020-07-02)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.3)

*  [TASK] Added google tagmanager to the img-src in the csp_whitelist.xml *(Lewis Voncken)*


## 1.2.2 (2020-06-30)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.2)

*  [FEATURE] Added addtional hosts to the csp_whitelist.xml *(Lewis Voncken)*


## 1.2.1 (2020-06-26)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.1)

*  [DOCS] Updated Screenshot csp-admin-notification.png *(Lewis Voncken)*


## 1.2.0 (2020-06-26)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.2.0)

*  [FEATURE] Allow images from google api *(Lewis Voncken)*
*  [FEATURE] Removed disable report only mode and added admin error notifications *(Lewis Voncken)*


## 1.1.0 (2020-06-22)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.1.0)

*  Update csp_whitelist.xml *(Dulshad)*


## 1.0.1 (2020-06-18)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.0.1)

*  [BUGFIX] Solved composer mapping invalid path for csp_reporter.php *(Lewis Voncken)*


## 1.0.0 (2020-06-15)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Csp.git/commits/tag/1.0.0)

*  [FEATURE] Initial Commit *(Lewis Voncken)*


