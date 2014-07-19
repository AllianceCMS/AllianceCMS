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
            'INDEX (module_id)',
        ],
    ],
];

$schema['0.01']['create']['table']['labels'] = [
    [
        'column' => [
            'name' => 'id',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '1',
            'default' => ''
        ]
    ],
    [
        'column' => [
            'name' => 'cryptonym',
            'type' => 'varchar(50)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => ''
        ]
    ],
    [
        'column' => [
            'name' => 'name',
            'type' => 'varchar(50)',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => ''
        ]
    ],
    [
        'column' => [
            'name' => 'comment',
            'type' => 'text',
            'not_null' => '',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => ''
        ]
    ],
    [
        'column' => [
            'name' => 'order',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '1'
        ]
    ],
    [
        'column' => [
            'name' => 'active',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '1'
        ]
    ],
    [
        'column' => [
            'name' => 'created',
            'type' => 'timestamp',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => "'0000-00-00 00:00:00'"
        ]
    ],
    [
        'column' => [
            'name' => 'modified',
            'type' => 'timestamp',
            'not_null' => '1',
            'unsigned' => '',
            'autoincrement' => '',
            'default' => 'CURRENT_TIMESTAMP'
        ]
    ],
    [
        'keys' => [
            'PRIMARY KEY (id)',
            'INDEX (cryptonym)'
        ]
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
            'name' => 'module_id',
            'type' => 'int(11)',
            'not_null' => '1',
            'unsigned' => '1',
            'autoincrement' => '',
            'default' => '0',
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
            'default' => '0',
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
            'INDEX (module_id)',
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
            'name' => 'type',
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
    ],[
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
        'blocks' => [
            [
                'name' => 'login_block',
                'venue_id' => '1',
                'module_id' => '3',
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
                'module_id' => '1',
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
                'module_id' => '1',
                'description' => 'AllianceCMS contact information.',
                'block_area' => '1',
                'block_order' => '3',
                'active' => '2',
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
        ],
        'labels' => [
            [
                'id' => '',
                'cryptonym' => 'venue',
                'name' => 'Venue',
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
                'module_id' => '1',
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
                'module_id' => '',
                'label' => 'Docs',
                'url' => 'https://github.com/jbWebWare/AllianceCMS/wiki',
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
                'module_id' => '',
                'label' => 'API',
                'url' => 'http://api.alliancecms.com/',
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
                'module_id' => '5',
                'label' => 'Create Venue',
                'url' => '/venues/create/start',
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
                'module_id' => '2',
                'label' => 'Admin Dashboard',
                'url' => '/admin/dashboard',
                'comment' => '',
                'link_parent' => '',
                'link_area' => 1,
                'link_order' => 5,
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
        ],
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
        'themes' => [
            [
                'id' => '',
                'name' => 'Charisma',
                'version' => '0.01',
                'description' => 'This theme is an AllianceCMS port of the Charisma website template found @ http://usman.it/free-responsive-admin-template/.',
                'artist' => 'Jesse Burns',
                'artist_email' => 'jesse.burns@alliancecms.com',
                'artist_site' => 'http://www.alliancecms.com',
                'folder_path' => '/themes',
                'folder_name' => 'Charisma',
                'type' => '1',
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'id' => '',
                'name' => 'Brownie',
                'version' => '0.01',
                'description' => 'This theme is an AllianceCMS port of the Brownie website template found @ http://www.egrappler.com/free-responsive-html5-portfolio-business-website-template-brownie/.',
                'artist' => 'Jesse Burns',
                'artist_email' => 'jesse.burns@alliancecms.com',
                'artist_site' => 'http://www.alliancecms.com',
                'folder_path' => '/themes',
                'folder_name' => 'Brownie',
                'type' => '2',
                'active' => 2,
                'created' => $currentMySqlTimestamp,
                'modified' => $currentMySqlTimestamp,
            ],
            [
                'id' => '',
                'name' => 'Emplode',
                'version' => '0.01',
                'description' => 'This theme is an AllianceCMS port of the Emplode website template found @ http://templates.arcsin.se.',
                'artist' => 'Jesse Burns',
                'artist_email' => 'jesse.burns@alliancecms.com',
                'artist_site' => 'http://www.alliancecms.com',
                'folder_path' => '/themes',
                'folder_name' => 'Emplode',
                'type' => '2',
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
