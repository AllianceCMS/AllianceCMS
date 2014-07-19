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
$schema['0.01']['create']['table']['modules'] = [
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
            'name' => 'version',
            'type' => 'varchar(20)',
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
            'name' => 'developer',
            'type' => 'varchar(50)',
            'not_null' => '',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => 'NULL',
        ],
    ],
    [
        'column' => [
            'name' => 'developer_site',
            'type' => 'varchar(100)',
            'not_null' => '',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => 'NULL',
        ],
    ],
    [
        'column' => [
            'name' => 'developer_email',
            'type' => 'varchar(100)',
            'not_null' => '',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => 'NULL',
        ],
    ],
    [
        'column' => [
            'name' => 'folder_path',
            'type' => 'varchar(255)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'folder_name',
            'type' => 'varchar(100)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
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
            'UNIQUE KEY (name)',
            'INDEX (version)',
            'INDEX (folder_name)',
        ],
    ],
];

$schema['0.01']['insert']['table'] = [
    [
        'modules' => [
            [
                'id' => '',
                'name' => 'Home',
                'version' => '0.01',
                'description' => 'This Official AllianceCMS Module allows you to manage your home page.',
                'developer' => 'Jesse Burns',
                'developer_email' => 'jesse.burns@alliancecms.com',
                'developer_site' => 'http://www.alliancecms.com',
                'folder_path' => '/axis/modules',
                'folder_name' => 'Home',
                'weight' => 1,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'id' => '',
                'name' => 'Admin Manager',
                'version' => '0.01',
                'description' => 'This Official AllianceCMS Module allows you to manage your administrative pages.',
                'developer' => 'Jesse Burns',
                'developer_email' => 'jesse.burns@alliancecms.com',
                'developer_site' => 'http://www.alliancecms.com',
                'folder_path' => '/axis/modules',
                'folder_name' => 'AdminManager',
                'weight' => 2,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'id' => '',
                'name' => 'Auth Manager',
                'version' => '0.01',
                'description' => 'This Official AllianceCMS Module enables User Authentication functionality.',
                'developer' => 'Jesse Burns',
                'developer_email' => 'jesse.burns@alliancecms.com',
                'developer_site' => 'http://www.alliancecms.com',
                'folder_path' => '/axis/modules',
                'folder_name' => 'AuthManager',
                'weight' => 3,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'id' => '',
                'name' => 'User Manager',
                'version' => '0.01',
                'description' => 'This Official AllianceCMS Module enables User Management functionality.',
                'developer' => 'Jesse Burns',
                'developer_email' => 'jesse.burns@alliancecms.com',
                'developer_site' => 'http://www.alliancecms.com',
                'folder_path' => '/axis/modules',
                'folder_name' => 'UserManager',
                'weight' => 4,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'id' => '',
                'name' => 'Module Manager',
                'version' => '0.01',
                'description' => 'This Official AllianceCMS Module allows you to manage your site Modules.',
                'developer' => 'Jesse Burns',
                'developer_email' => 'jesse.burns@alliancecms.com',
                'developer_site' => 'http://www.alliancecms.com',
                'folder_path' => '/axis/modules',
                'folder_name' => 'ModuleManager',
                'weight' => 5,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'id' => '',
                'name' => 'Venue Manager',
                'version' => '0.01',
                'description' => 'This Official AllianceCMS Module allows you to manage your site Venues.',
                'developer' => 'Jesse Burns',
                'developer_email' => 'jesse.burns@alliancecms.com',
                'developer_site' => 'http://www.alliancecms.com',
                'folder_path' => '/axis/modules',
                'folder_name' => 'VenueManager',
                'weight' => 6,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
        ],
    ],
];
//*/
