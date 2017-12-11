<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Pille vergessen?',
    'description' => 'Formularabfrage zum Thema Pille vergessen? Was tun?',
    'category' => 'plugin',
    'author' => 'Schreiber, Sebastian',
    'author_email' => 'me@schreibersebastian.de',
    'author_company' => 'Sebastian Schreiber',
    'shy' => '',
    'dependencies' => 'cms,extbase,fluid',
    'conflicts' => '',
    'priority' => '',
    'module' => '',
    'state' => 'beta',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '6.2.0',
    'constraints' => [
        'depends' => [
            'typo3' => '6.2.0-8.7.99',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
    'autoload' => [
        'psr-4' => ['Ssch\\SschForgotPill\\' => 'Classes'],
    ],
    'autoload-dev' => [
        'psr-4' => ['Ssch\\SschForgotPill\\Tests\\' => 'Tests'],
    ],
];
