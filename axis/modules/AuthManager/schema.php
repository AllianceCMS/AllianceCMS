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
$schema['0.01']['create']['table']['permissions'] = [
    [
        'column' => [
            'name' => 'ID',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '1',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'Lft',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'Rght',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'Title',
            'type' => 'char(64)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'Description',
            'type' => 'text',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'keys' => [
            'PRIMARY KEY (ID)',
            'INDEX (Title)',
            'INDEX (Lft)',
            'INDEX (Rght)',
        ],
    ],
];

$schema['0.01']['create']['table']['roles'] = [
    [
        'column' => [
            'name' => 'ID',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '1',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'Lft',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'Rght',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'Title',
            'type' => 'varchar(128)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'Description',
            'type' => 'text',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'keys' => [
            'PRIMARY KEY  (ID)',
            'INDEX (Title)',
            'INDEX (Lft)',
            'INDEX (Rght)',
        ],
    ],
];

$schema['0.01']['create']['table']['rolepermissions'] = [
    [
        'column' => [
            'name' => 'RoleID',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'PermissionID',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'AssignmentDate',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'keys' => [
            'PRIMARY KEY  (RoleID,PermissionID)',
        ],
    ],
];

$schema['0.01']['create']['table']['userroles'] = [
    [
        'column' => [
            'name' => 'UserID',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'RoleID',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'AssignmentDate',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'keys' => [
            'PRIMARY KEY (UserID,RoleID)',
        ],
    ],
];

$schema['0.01']['insert']['table'] = [
    [
        'permissions' => [
            [
                'ID' => '',
                'Lft' => '0',
                'Rght' => '1',
                'Title' => 'root',
                'Description' => 'root',
            ],
        ],
        'roles' => [
            [
                'ID' => '',
                'Lft' => '0',
                'Rght' => '1',
                'Title' => 'root',
                'Description' => 'root',
            ],
        ],
        'rolepermissions' => [
            [
                'RoleID' => '1',
                'PermissionID' => '1',
                'AssignmentDate' => time(),
            ],
        ],
        'userroles' => [
            [
                'UserID' => '1',
                'RoleID' => '1',
                'AssignmentDate' => time(),
            ],
        ],
    ],
];
//*/
