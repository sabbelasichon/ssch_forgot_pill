<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

return [
    'ctrl' => [
        'title' => 'LLL:EXT:ssch_forgot_pill/Resources/Private/Language/locallang_db.xml:tx_sschforgotpill_domain_model_forgotpill',
        'label' => 'how_many_times',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'versioningWS' => 2,
        'versioning_followPages' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'iconfile' => 'EXT:ssch_forgot_pill/Resources/Public/Icons/tx_sschforgotpill_domain_model_forgotpill.png',
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, how_many_times, when_did_you_forgot_to_take_the_pill, which_week, did_you_have_sex, did_you_take_the_pill_correctly_in_previous_weeks',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, how_many_times, when_did_you_forgot_to_take_the_pill, which_week, did_you_have_sex, did_you_take_the_pill_correctly_in_previous_weeks,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0],
                ],
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_sschforgotpill_domain_model_forgotpill',
                'foreign_table_where' => 'AND tx_sschforgotpill_domain_model_forgotpill.pid=###CURRENT_PID### AND tx_sschforgotpill_domain_model_forgotpill.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
                ],
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
                ],
            ],
        ],
        'how_many_times' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:ssch_forgot_pill/Resources/Private/Language/locallang_db.xml:tx_sschforgotpill_domain_model_forgotpill.how_many_times',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:ssch_forgot_pill/Resources/Private/Language/locallang_db.xml:tx_sschforgotpill_domain_model_forgotpill.please_choose', 0],
                    ['LLL:EXT:ssch_forgot_pill/Resources/Private/Language/locallang_db.xml:tx_sschforgotpill_domain_model_forgotpill.forgot_one_pill', 1],
                    ['LLL:EXT:ssch_forgot_pill/Resources/Private/Language/locallang_db.xml:tx_sschforgotpill_domain_model_forgotpill.forgot_more_than_one_pill', 2],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required',
            ],
        ],
        'when_did_you_forgot_to_take_the_pill' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:ssch_forgot_pill/Resources/Private/Language/locallang_db.xml:tx_sschforgotpill_domain_model_forgotpill.when_did_you_forgot_to_take_the_pill',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:ssch_forgot_pill/Resources/Private/Language/locallang_db.xml:tx_sschforgotpill_domain_model_forgotpill.please_choose', 0],
                    ['LLL:EXT:ssch_forgot_pill/Resources/Private/Language/locallang_db.xml:tx_sschforgotpill_domain_model_forgotpill.when_did_you_forgot_the_pill.less_than_12_hours', 1],
                    ['LLL:EXT:ssch_forgot_pill/Resources/Private/Language/locallang_db.xml:tx_sschforgotpill_domain_model_forgotpill.when_did_you_forgot_the_pill.more_than_12_hours', 2],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required',
            ],
        ],
        'which_week' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:ssch_forgot_pill/Resources/Private/Language/locallang_db.xml:tx_sschforgotpill_domain_model_forgotpill.which_week',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:ssch_forgot_pill/Resources/Private/Language/locallang_db.xml:tx_sschforgotpill_domain_model_forgotpill.please_choose', 0],
                    ['LLL:EXT:ssch_forgot_pill/Resources/Private/Language/locallang_db.xml:tx_sschforgotpill_domain_model_forgotpill.which_week_01', 1],
                    ['LLL:EXT:ssch_forgot_pill/Resources/Private/Language/locallang_db.xml:tx_sschforgotpill_domain_model_forgotpill.which_week_02', 2],
                    ['LLL:EXT:ssch_forgot_pill/Resources/Private/Language/locallang_db.xml:tx_sschforgotpill_domain_model_forgotpill.which_week_03', 3],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required',
            ],
        ],
        'did_you_have_sex' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:ssch_forgot_pill/Resources/Private/Language/locallang_db.xml:tx_sschforgotpill_domain_model_forgotpill.did_you_have_sex',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'did_you_take_the_pill_correctly_in_previous_weeks' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:ssch_forgot_pill/Resources/Private/Language/locallang_db.xml:tx_sschforgotpill_domain_model_forgotpill.did_you_take_the_pill_correctly_in_previous_weeks',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
    ],
];
