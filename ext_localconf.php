<?php

if ( ! defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Ssch.ssch_forgot_pill', 'Pi1', [
    'ForgotPill' => 'index,intro,step1,step2,step3,step4,result,step4ForOneWeek,step4ForTwoWeeks,step4ForThreeWeeks,resultNoProtection,resultProtection,resultForOneWeekWithoutSex,resultForTwoWeeks,resultForThreeWeeks,resultNoProtectionForOneWeek',
], [
        'ForgotPill' => 'index,intro,step1,step2,step3,step4,result,step4ForOneWeek,step4ForTwoWeeks,step4ForThreeWeeks,resultNoProtection,resultProtection,resultForOneWeekWithoutSex,resultForTwoWeeks,resultForThreeWeeks,resultNoProtectionForOneWeek',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Ssch.ssch_forgot_pill', 'Pi2', [
    'ForgotPill' => 'teaser',
], [
        'ForgotPill' => '',
    ]
);

# Auto RealUrl Configuration
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('realurl')) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/realurl/class.tx_realurl_autoconfgen.php']['extensionConfiguration']['ssch_forgot_pill'] =
        \Ssch\SschForgotPill\Hooks\RealUrlAutoConfiguration::class.'->addConfig';
}
