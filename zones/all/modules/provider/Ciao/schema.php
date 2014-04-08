<?php
/**
 * Module Database Schema
 *
 * Used for Module Installation/Uninstallation/Updates
 *
 * Explaination:
 *
 * @code
 * // Create a table
 * // Individual array for each table you would like to create
 * $schema[$version]['create']['table'][$tableName] = [
 *     [
 *         'column' => [
 *             'name' => $columnName,
 *             'type' => $columnType,
 *             'not_null' => '1' or leave blank to allow null,
 *             'unsigned' => '1' or leave blank to allow unsigned numeric types,
 *             'autoincrement' => '1' or leave blank for no autoincrement,
 *             'default' => $defaultValue or leave blank for no default value,
 *         ],
 *     ],
 * ];
 *
 * // Insert data into tables
 * // A single array of table names and their colum/value pairs for all data inserts
 * $schema['0.01']['insert']['table'] = [
 *     [
 *         'ciao_data' => [
 *             [
 *                 $columnName => $columnValue,
 *                 $columnName => $columnValue,
 *                 $columnName => $columnValue,
 *                 $columnName => $columnValue
 *             ],
 *         ],
 *     ],
 * ];
 * @endcode
 */

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

$schema['0.01']['create']['table']['ciao_demo'] = [
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
                'created' => date("Y-m-d H:i:s", time()),
                'modified' => date("Y-m-d H:i:s", time())
            ],
        ],
    ],
    [
        'ciao_data' => [
            [
                'language' => 'Bulgarian',
                'greeting' => 'Dobro utro',
                'created' => date("Y-m-d H:i:s", time()),
                'modified' => date("Y-m-d H:i:s", time())
            ],
        ],
    ],
    [
        'ciao_data' => [
            [
                'language' => 'Finnish',
                'greeting' => 'Hyv�� huomenta',
                'created' => date("Y-m-d H:i:s", time()),
                'modified' => date("Y-m-d H:i:s", time())
            ],
        ],
    ],
    [
        'ciao_data' => [
            [
                'language' => 'French',
                'greeting' => 'Bonjour',
                'created' => date("Y-m-d H:i:s", time()),
                'modified' => date("Y-m-d H:i:s", time())
            ],
        ],
    ],
    [
        'ciao_data' => [
            [
                'language' => 'German',
                'greeting' => 'Guten Morgen',
                'created' => date("Y-m-d H:i:s", time()),
                'modified' => date("Y-m-d H:i:s", time())
            ],
        ],
    ],
    [
        'ciao_data' => [
            [
                'language' => 'Mandarin',
                'greeting' => 'Zao shang hao',
                'created' => date("Y-m-d H:i:s", time()),
                'modified' => date("Y-m-d H:i:s", time())
            ],
        ],
    ],
    [
        'ciao_data' => [
            [
                'language' => 'Spanish',
                'greeting' => 'Buenos dias',
                'created' => date("Y-m-d H:i:s", time()),
                'modified' => date("Y-m-d H:i:s", time())
            ],
        ],
    ],
    [
        'ciao_data' => [
            [
                'language' => 'Tibetan',
                'greeting' => 'Nyado delek',
                'created' => date("Y-m-d H:i:s", time()),
                'modified' => date("Y-m-d H:i:s", time())
            ],
        ],
    ],
    [
        'ciao_demo' => [
            [
                'language' => 'English',
                'greeting' => 'Good morning',
                'created' => date("Y-m-d H:i:s", time()),
                'modified' => date("Y-m-d H:i:s", time())
            ],
        ],
    ],
    [
        'ciao_demo' => [
            [
                'language' => 'Bulgarian',
                'greeting' => 'Dobro utro',
                'created' => date("Y-m-d H:i:s", time()),
                'modified' => date("Y-m-d H:i:s", time())
            ],
        ],
    ],
    [
        'ciao_demo' => [
            [
                'language' => 'Finnish',
                'greeting' => 'Hyv�� huomenta',
                'created' => date("Y-m-d H:i:s", time()),
                'modified' => date("Y-m-d H:i:s", time())
            ],
        ],
    ],
    [
        'ciao_demo' => [
            [
                'language' => 'French',
                'greeting' => 'Bonjour',
                'created' => date("Y-m-d H:i:s", time()),
                'modified' => date("Y-m-d H:i:s", time())
            ],
        ],
    ],
    [
        'ciao_demo' => [
            [
                'language' => 'German',
                'greeting' => 'Guten Morgen',
                'created' => date("Y-m-d H:i:s", time()),
                'modified' => date("Y-m-d H:i:s", time())
            ],
        ],
    ],
    [
        'ciao_demo' => [
            [
                'language' => 'Mandarin',
                'greeting' => 'Zao shang hao',
                'created' => date("Y-m-d H:i:s", time()),
                'modified' => date("Y-m-d H:i:s", time())
            ],
        ],
    ],
    [
        'ciao_demo' => [
            [
                'language' => 'Spanish',
                'greeting' => 'Buenos dias',
                'created' => date("Y-m-d H:i:s", time()),
                'modified' => date("Y-m-d H:i:s", time())
            ],
        ],
    ],
    [
        'ciao_demo' => [
            [
                'language' => 'Tibetan',
                'greeting' => 'Nyado delek',
                'created' => date("Y-m-d H:i:s", time()),
                'modified' => date("Y-m-d H:i:s", time())
            ],
        ],
    ],
];