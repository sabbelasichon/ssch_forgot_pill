<?php

if ( ! defined('TYPO3_MODE')) {
    die('Access denied.');
}


# Wizard configuration
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:ssch_forgot_pill/Configuration/TSconfig/ContentElementWizard.txt">');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Ssch.ssch_forgot_pill', 'Pi1', [
    'ForgotPill' => 'index,intro,step1,step2,step3,step4,result',
], [
        'ForgotPill' => 'index,intro,step1,step2,step3,step4,result',
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

call_user_func(function () {

    if (TYPO3_MODE === 'BE') {
        if (class_exists(\TYPO3\CMS\Core\Imaging\IconRegistry::class)) {
            /** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
            $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
            $iconRegistry->registerIcon(
                'ssch-forgot-pill-wizard',
                \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
                ['source' => 'EXT:ssch_forgot_pill/Resources/Public/Icons/question.svg']
            );
        }
    }

});
