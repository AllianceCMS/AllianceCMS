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

/*
$schema['0.01']['create']['table']['venues'] = [
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
            'name' => 'venue_type',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '1',
        ],
    ],
    [
        'column' => [
            'name' => 'cryptonym', // Internal Name
            'type' => 'varchar(20)',
            'not_null' => '',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'name',
            'type' => 'varchar(20)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'title',
            'type' => 'varchar(50)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'tagline',
            'type' => 'varchar(200)',
            'not_null' => '',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => 'NULL',
        ],
    ],
    [
        'column' => [
            'name' => 'description',
            'type' => 'text',
            'not_null' => '',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => 'NULL',
        ],
    ],
    [
        'column' => [
            'name' => 'keywords',
            'type' => 'text',
            'not_null' => '',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => 'NULL',
        ],
    ],
    [
        'column' => [
            'name' => 'venue_admin',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '1',
        ],
    ],
    [
        'column' => [
            'name' => 'venue_email',
            'type' => 'varchar(100)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'venue_email_name',
            'type' => 'varchar(100)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'default_module',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '1',
        ],
    ],
    [
        'column' => [
            'name' => 'active_theme',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '2',
        ],
    ],
    [
        'column' => [
            'name' => 'maintenance_flag',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '1',
        ],
    ],
    [
        'column' => [
            'name' => 'maintenance_flag_text',
            'type' => 'text',
            'not_null' => '',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => 'NULL',
        ],
    ],
    [
        'column' => [
            'name' => 'language',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '1',
        ],
    ],
    [
        'column' => [
            'name' => 'active',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '2',
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
            'UNIQUE KEY (cryptonym)',
            'UNIQUE KEY (name)',
            'INDEX (venue_type)',
            'INDEX (venue_admin)',
            'INDEX (default_module)',
            'INDEX (active_theme)',
            'INDEX (language)',
        ],
    ],
];

$schema['0.01']['create']['table']['venue_modules_activated'] = [
    [
        'column' => [
            'name' => 'venue_id',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'module_id',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'active',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '1',
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
            'INDEX (venue_id)',
            'INDEX (module_id)',
        ],
    ],
];

$schema['0.01']['create']['table']['venue_modules_allowed'] = [
    [
        'column' => [
            'name' => 'module_id',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'venue_type_id',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'venue_id',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'active',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '1',
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
            'INDEX (module_id)',
            'INDEX (venue_id)',
            'INDEX (venue_type_id)',
        ],
    ],
];

$schema['0.01']['create']['table']['venue_types'] = [
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
            'name' => 'cryptonym', // Internal Name
            'type' => 'varchar(50)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'name',
            'type' => 'varchar(50)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'description',
            'type' => 'text',
            'not_null' => '',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => 'NULL',
        ],
    ],
    [
        'column' => [
            'name' => 'weight',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '1',
        ],
    ],
    [
        'column' => [
            'name' => 'active',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '2',
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
            'UNIQUE KEY (cryptonym)',
        ],
    ],
];

$schema['0.01']['insert']['table'] = [
    [
        'venues' => [
            [
                'id' => '',
                'venue_type' => 1,
                'cryptonym' => strtolower($venueInsertLabel),
                'name' => $venueInsertLabel,
                'title' => $venueInsertTitle,
                'tagline' => $venueInsertTagline,
                'description' => '',
                'keywords' => '',
                'venue_admin' => 1,
                'venue_email' => $venueInsertEmail,
                'venue_email_name' => $venueInsertEmailName,
                'default_module' => 1,
                'active_theme' => 2,
                'maintenance_flag' => 1,
                'maintenance_flag_text' => '',
                'language' => $languageInsert,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
        ],
        'venue_modules_activated' => [
            [
                'venue_id' => 1,
                'module_id' => 1,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'venue_id' => 1,
                'module_id' => 2,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'venue_id' => 1,
                'module_id' => 3,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'venue_id' => 1,
                'module_id' => 4,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'venue_id' => 1,
                'module_id' => 5,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'venue_id' => 1,
                'module_id' => 6,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
        ],
        'venue_modules_allowed' => [
            [
                'module_id' => 1,
                'venue_type_id' => 1,
                'venue_id' => 0,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'module_id' => 2,
                'venue_type_id' => 1,
                'venue_id' => 0,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'module_id' => 3,
                'venue_type_id' => 1,
                'venue_id' => 0,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'module_id' => 4,
                'venue_type_id' => 1,
                'venue_id' => 0,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'module_id' => 5,
                'venue_type_id' => 1,
                'venue_id' => 0,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'module_id' => 6,
                'venue_type_id' => 1,
                'venue_id' => 0,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
        ],
        'venue_types' => [
            [
                'id' => 1,
                'cryptonym' => 'venue',
                'name' => 'Venue',
                'description' => 'The default venue type is a generic venue type. Use this venue type if you do not plan on using multiple venue types',
                'weight' => 1,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
        ],
    ],
];
//*/
