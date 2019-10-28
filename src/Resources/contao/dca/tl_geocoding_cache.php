<?php

$GLOBALS['TL_DCA']['tl_geocoding_cache'] = [
    'config' => [
        'dataContainer' => 'Table',
        'sql' => [
            'keys' => [
                'id' => 'primary',
                'hash' => 'index'
            ]
        ]
    ],
    'fields' => [
        'id' => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp' => [
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ],
        'hash' => [
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'result' => [
            'sql' => "blob NULL"
        ]
    ]
];