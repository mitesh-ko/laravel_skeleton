<?php
return [
    'debug_ip' => env('DEBUG_IP', ''),

    'permissions' => [

        'Role Management' => [
            'List'   => [
                'displayName' => 'List',
                'name'        => 'roleList',
                'guard_name'  => 'web',
                'desc'        => '',
                'marginLeft'  => 0
            ],
            'Create' => [
                'displayName' => 'Create',
                'name'        => 'roleCreate',
                'guard_name'  => 'web',
                'desc'        => '',
                'marginLeft'  => 0
            ],
            'Update' => [
                'displayName' => 'Update',
                'name'        => 'roleUpdate',
                'guard_name'  => 'web',
                'desc'        => '',
                'marginLeft'  => 0
            ],
            'Delete' => [
                'displayName' => 'Delete',
                'name'        => 'roleDelete',
                'guard_name'  => 'web',
                'desc'        => '',
                'marginLeft'  => 0
            ]
        ],

        'Dashboard' => [
            'First Dashboard' => [
                'displayName' => 'First Dashboard',
                'name'        => 'firstDashboard',
                'guard_name'  => 'web',
                'desc'        => '',
                'marginLeft'  => 0
            ],
        ],

        'Permission Management' => [
            'List' => [
                'displayName' => 'List',
                'name'        => 'permissionList',
                'guard_name'  => 'web',
                'desc'        => '',
                'marginLeft'  => 0
            ],
        ],

        'Email Template Management' => [
            'List'   => [
                'displayName' => 'List',
                'name'        => 'emailTemplateList',
                'guard_name'  => 'web',
                'desc'        => '',
                'marginLeft'  => 0
            ],
            'Update' => [
                'displayName' => 'Update',
                'name'        => 'emailTemplateUpdate',
                'guard_name'  => 'web',
                'desc'        => '',
                'marginLeft'  => 0
            ],
        ],

        'User management' => [
            'List'                     => [
                'displayName' => 'List',
                'name'        => 'userList',
                'guard_name'  => 'web',
                'desc'        => 'Access to see users list.',
                'marginLeft'  => 0
            ],
            'Create'                   => [
                'displayName' => 'Create',
                'name'        => 'userCreate',
                'guard_name'  => 'web',
                'desc'        => 'Create a new user.',
                'marginLeft'  => 0
            ],
            'Update'                   => [
                'displayName' => 'Update',
                'name'        => 'userUpdate',
                'guard_name'  => 'web',
                'desc'        => 'Update a existing user.',
                'marginLeft'  => 0
            ],
            'Delete'                   => [
                'displayName' => 'Delete',
                'name'        => 'userDelete',
                'guard_name'  => 'web',
                'desc'        => 'Delete a existing user.',
                'marginLeft'  => 0
            ]
        ],

        'Site config' => [
            'General Settings' => [
                'displayName' => 'General Settings',
                'name'        => 'siteConfigUpdate',
                'guard_name'  => 'web',
                'desc'        => 'User can update site configuration.',
                'marginLeft'  => 0
            ],
            'Mail Settings'    => [
                'displayName' => 'Mail Settings',
                'name'        => 'mailConfigUpdate',
                'guard_name'  => 'web',
                'desc'        => 'User can update mail configuration.',
                'marginLeft'  => 29
            ]
        ],

        'Audit Logs' => [
            'List audit logs'   => [
                'displayName' => 'List audit logs',
                'name'        => 'listLogs',
                'guard_name'  => 'web',
                'desc'        => 'Access check site logs',
                'marginLeft'  => 0
            ],
            'Check log details' => [
                'displayName' => 'Check log details',
                'name'        => 'LogDetail',
                'guard_name'  => 'web',
                'desc'        => 'Access to check details of a log',
                'marginLeft'  => 49
            ]
        ]
    ],
];
