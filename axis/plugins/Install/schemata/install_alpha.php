<?php

/**
 * Look into 'ON UPDATE CURRENT_TIMESTAMP' attribute
 */

$schema['0.01']['create']['database'] = [
    'name' => $dbInsertDatabase,
    'charset' => 'utf8',
    'collation' => 'utf8_general_ci',
];

$schema['0.01']['create']['table']['blocks'] = [
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
            'type' => 'varchar(100)',
            'not_null' => '1',
            'unsigned' => '',
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
            'name' => 'plugin_id',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
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
            'name' => 'block_area',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '1',
        ],
    ],
    [
        'column' => [
            'name' => 'block_order',
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
            'PRIMARY KEY (id)',
            'UNIQUE KEY (name)',
            'INDEX (venue_id)',
            'INDEX (plugin_id)',
        ],
    ],
];

$schema['0.01']['create']['table']['languages'] = [
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
            'type' => 'varchar(20)',
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

$schema['0.01']['create']['table']['links'] = [
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
            'name' => 'label',
            'type' => 'varchar(50)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'url',
            'type' => 'varchar(100)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'comment',
            'type' => 'text',
            'not_null' => '',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'link_parent',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'link_area',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '1',
        ],
    ],
    [
        'column' => [
            'name' => 'link_order',
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
            'PRIMARY KEY (id)',
            'INDEX (link_parent)',
        ],
    ],
];

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

$schema['0.01']['create']['table']['plugins'] = [
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
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '',
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
            'name' => 'weight',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '2',
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

$schema['0.01']['create']['table']['schemas'] = [
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
            'name' => 'system_name',
            'type' => 'varchar(100)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'schema_version',
            'type' => 'varchar(20)',
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
            'UNIQUE KEY (system_name)',
        ],
    ],
];

$schema['0.01']['create']['table']['themes'] = [
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
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '',
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
            'name' => 'artist',
            'type' => 'varchar(50)',
            'not_null' => '',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => 'NULL',
        ],
    ],
    [
        'column' => [
            'name' => 'artist_email',
            'type' => 'varchar(100)',
            'not_null' => '',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => 'NULL',
        ],
    ],
    [
        'column' => [
            'name' => 'artist_site',
            'type' => 'varchar(100)',
            'not_null' => '',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => 'NULL',
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
            'PRIMARY KEY (id)',
            'UNIQUE KEY (name)',
            'INDEX (version)',
            'INDEX (folder_name)',
        ],
    ],
];

$schema['0.01']['create']['table']['users'] = [
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
            'name' => 'login_name',
            'type' => 'varchar(20)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'display_name',
            'type' => 'varchar(50)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'password',
            'type' => 'varchar(60)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'email_address',
            'type' => 'varchar(100)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'hide_email_address',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '2',
        ],
    ],
    [
        'column' => [
            'name' => 'timezone_offset',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => "'0'",
        ],
    ],
    [
        'column' => [
            'name' => 'acms_id',
            'type' => 'varchar(60)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => "'0'",
        ],
    ],
    [
        'column' => [
            'name' => 'last_login_time',
            'type' => 'timestamp',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => "'0000-00-00 00:00:00'",
        ],
    ],
    [
        'column' => [
            'name' => 'last_ip',
            'type' => 'varchar(20)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => '',
        ],
    ],
    [
        'column' => [
            'name' => 'registration_ip',
            'type' => 'varchar(20)',
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
            'UNIQUE KEY (login_name)',
            'UNIQUE KEY (email_address)',
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
            'name' => 'default_plugin',
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
            'default' => '1',
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
            'UNIQUE KEY (name)',
            'UNIQUE KEY (venue_email)',
            'INDEX (venue_admin)',
            'INDEX (default_plugin)',
            'INDEX (active_theme)',
            'INDEX (language)',
        ],
    ],
];

$schema['0.01']['insert']['table'] = [
    [
        'blocks' => [
            [
                'name' => 'login_block',
                'venue_id' => '1',
                'plugin_id' => '2',
                'description' => 'This block will help speed up the log-in and registration process for users.',
                'block_area' => '1',
                'block_order' => '1',
                'active' => '2',
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp
            ],
            [
                'name' => 'welcome_block',
                'venue_id' => '1',
                'plugin_id' => '1',
                'description' => 'This is a block that welcomes new AllianceCMS users.',
                'block_area' => '1',
                'block_order' => '2',
                'active' => '2',
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp
            ],
            [
                'name' => 'contact_us',
                'venue_id' => '1',
                'plugin_id' => '1',
                'description' => 'AllianceCMS contact information.',
                'block_area' => '1',
                'block_order' => '3',
                'active' => '2',
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
        ],
        'languages' => [
            [
                'id' => '',
                'name' => 'English',
                'folder_name' => 'english',
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
        ],
        'links' => [
            [
                'id' => '',
                'label' => 'Home',
                'url' => '',
                'comment' => '',
                'link_parent' => '',
                'link_area' => 1,
                'link_order' => 1,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'id' => '',
                'label' => 'Ciao Folks',
                'url' => '/ciao/hey',
                'comment' => '',
                'link_parent' => '',
                'link_area' => 1,
                'link_order' => 2,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'id' => '',
                'label' => 'Ciao People',
                'url' => '/ciao/later',
                'comment' => '',
                'link_parent' => '',
                'link_area' => 1,
                'link_order' => 3,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'id' => '',
                'label' => 'AllianceCMS: Wiki',
                'url' => 'https://github.com/jbWebWare/AllianceCMS/wiki',
                'comment' => '',
                'link_parent' => '',
                'link_area' => 1,
                'link_order' => 4,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'id' => '',
                'label' => 'AllianceCMS: API',
                'url' => 'http://api.alliancecms.com/',
                'comment' => '',
                'link_parent' => '',
                'link_area' => 1,
                'link_order' => 5,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'id' => '',
                'label' => 'Admin Dashboard',
                'url' => '/admin/dashboard',
                'comment' => '',
                'link_parent' => '',
                'link_area' => 1,
                'link_order' => 6,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
        ],
        'permissions' => [
            [
                'ID' => '',
                'Lft' => '0',
                'Rght' => '1',
                'Title' => 'root',
                'Description' => 'root',
            ],
        ],
        'plugins' => [
            [
                'id' => '',
                'name' => 'Admin',
                'version' => '',
                'folder_path' => 'axis/plugins/',
                'folder_name' => 'Admin',
                'description' => 'This Official AllianceCMS Plugin allows you to manage your administrative pages.',
                'developer' => 'Jesse Burns',
                'developer_email' => 'jesse.burns@alliancecms.com',
                'developer_site' => 'http://www.alliancecms.com',
                'weight' => 1,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'id' => '',
                'name' => 'Home',
                'version' => '',
                'folder_path' => 'axis/plugins/',
                'folder_name' => 'Home',
                'description' => 'This Official AllianceCMS Plugin allows you to manage your home page.',
                'developer' => 'Jesse Burns',
                'developer_email' => 'jesse.burns@alliancecms.com',
                'developer_site' => 'http://www.alliancecms.com',
                'weight' => 2,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'id' => '',
                'name' => 'User Manager',
                'version' => '',
                'folder_path' => 'axis/plugins/',
                'folder_name' => 'UserManager',
                'description' => 'This Official AllianceCMS Plugin enables user management functionality.',
                'developer' => 'Jesse Burns',
                'developer_email' => 'jesse.burns@alliancecms.com',
                'developer_site' => 'http://www.alliancecms.com',
                'weight' => 3,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'id' => '',
                'name' => 'Ciao',
                'version' => '',
                'folder_path' => 'axis/plugins/',
                'folder_name' => 'Ciao',
                'description' => 'This is a simple take on the classic "Hello World!" plugin, AllianceCMS style.',
                'developer' => 'Jesse Burns',
                'developer_email' => 'jesse.burns@alliancecms.com',
                'developer_site' => 'http://www.alliancecms.com',
                'weight' => 4,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
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
        'themes' => [
            [
                'id' => '',
                'name' => 'Emplode',
                'version' => '',
                'folder_path' => 'themes/',
                'folder_name' => 'Emplode',
                'description' => 'This theme is an AllianceCMS port of the Emplode website template found @ http://templates.arcsin.se.',
                'artist' => 'Jesse Burns',
                'artist_email' => 'jesse.burns@alliancecms.com',
                'artist_site' => 'http://www.alliancecms.com',
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
        ],
        'userroles' => [
            [
                'UserID' => '1',
                'RoleID' => '1',
                'AssignmentDate' => time(),
            ],
        ],
        'users' => [
            [
                'id' => '',
                'login_name' => $adminInsertLoginName,
                'display_name' => $adminInsertDisplayName,
                'password' => $adminInsertPassword,
                'email_address' => $adminInsertEmail,
                'hide_email_address' => $adminInsertHideEmail,
                'timezone_offset' => '',
                'acms_id' => '',
                'last_login_time' => $currentMySqlTimestamp,
                'last_ip' => getenv('REMOTE_ADDR'),
                'registration_ip' => getenv('REMOTE_ADDR'),
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
        ],
        'venues' => [
            [
                'id' => '',
                'name' => $venueInsertName,
                'title' => $venueInsertTitle,
                'tagline' => $venueInsertTagline,
                'description' => '',
                'keywords' => '',
                'venue_admin' => 1,
                'venue_email' => $venueInsertEmail,
                'venue_email_name' => $venueInsertEmailName,
                'default_plugin' => 1,
                'active_theme' => 1,
                'maintenance_flag' => 1,
                'maintenance_flag_text' => '',
                'language' => $languageInsert,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
        ],
    ],
];
