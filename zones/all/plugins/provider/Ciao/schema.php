<?php
$schema['0.01']['create']['table']['ciao_data'] = [
    [
        'column' => [
            'name' => 'id',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '1',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'language',
            'type' => 'varchar(20)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'greeting',
            'type' => 'varchar(100)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'created',
            'type' => 'timestamp',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => "'0000-00-00 00:00:00'",
        ],
    ],
    [
        'column' => [
            'name' => 'modified',
            'type' => 'timestamp',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => 'CURRENT_TIMESTAMP',
        ],
    ],
    [
        'keys' => [
            'PRIMARY KEY (id)',
        ],
    ],
];

$schema['0.01']['insert']['table'] = [
    [
        'ciao_data' => [
            [
                'language' => 'English',
                'greeting' => 'Good morning',
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp
            ],
        ],
    ],
    [
        'ciao_data' => [
            [
                'language' => 'Bulgarian',
                'greeting' => 'Dobro utro',
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp
            ],
        ],
    ],
    [
        'ciao_data' => [
            [
                'language' => 'Finnish',
                'greeting' => 'Hyvää huomenta',
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp
            ],
        ],
    ],
    [
        'ciao_data' => [
            [
                'language' => 'French',
                'greeting' => 'Bonjour',
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp
            ],
        ],
    ],
    [
        'ciao_data' => [
            [
                'language' => 'German',
                'greeting' => 'Guten Morgen',
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp
            ],
        ],
    ],
    [
        'ciao_data' => [
            [
                'language' => 'Mandarin',
                'greeting' => 'Zao shang hao',
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp
            ],
        ],
    ],
    [
        'ciao_data' => [
            [
                'language' => 'Spanish',
                'greeting' => 'Buenos dias',
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp
            ],
        ],
    ],
    [
        'ciao_data' => [
            [
                'language' => 'Tibetan',
                'greeting' => 'Nyado delek',
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp
            ],
        ],
    ],
];