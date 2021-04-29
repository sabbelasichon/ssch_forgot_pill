<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use Ssch\SschForgotPill\Hooks\RealUrlAutoConfiguration;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
if ( ! defined('TYPO3_MODE')) {
    die('Access denied.');
}


# Wizard configuration
ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:ssch_forgot_pill/Configuration/TSconfig/ContentElementWizard.txt">');

ExtensionUtility::configurePlugin(
    'Ssch.ssch_forgot_pill', 'Pi1', [
    'ForgotPill' => 'index,intro,step1,step2,step3,step4,result',
], [
        'ForgotPill' => 'index,intro,step1,step2,step3,step4,result',
    ]
);

ExtensionUtility::configurePlugin(
    'Ssch.ssch_forgot_pill', 'Pi2', [
    'ForgotPill' => 'teaser',
], [
        'ForgotPill' => '',
    ]
);

# Auto RealUrl Configuration
if (ExtensionManagementUtility::isLoaded('realurl')) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/realurl/class.tx_realurl_autoconfgen.php']['extensionConfiguration']['ssch_forgot_pill'] =
        RealUrlAutoConfiguration::class.'->addConfig';
}

call_user_func(function () {

    if (TYPO3_MODE === 'BE') {
        if (class_exists(IconRegistry::class)) {
            /** @var IconRegistry $iconRegistry */
            $iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
            $iconRegistry->registerIcon(
                'ssch-forgot-pill-wizard',
                SvgIconProvider::class,
                ['source' => 'EXT:ssch_forgot_pill/Resources/Public/Icons/question.svg']
            );
        }
    }

});
