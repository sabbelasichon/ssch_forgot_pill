<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
defined('TYPO3_MODE') || die('Access denied.');

ExtensionManagementUtility::addStaticFile('ssch_forgot_pill', 'Configuration/TypoScript', 'Pille vergessen?');
