<?php
return [
    'debug_ip' => env('DEBUG_IP', ''),

    'permissions' => [

        'Role Management' => [
            [
                'displayName' => 'List',
                'name'        => 'roleList',
                'guard_name'  => 'web',
                'desc'        => '',
                'marginLeft'  => 0
            ],
            [
                'displayName' => 'Create',
                'name'        => 'roleCreate',
                'guard_name'  => 'web',
                'desc'        => '',
                'marginLeft'  => 0
            ],
            [
                'displayName' => 'Update',
                'name'        => 'roleUpdate',
                'guard_name'  => 'web',
                'desc'        => '',
                'marginLeft'  => 0
            ],
            [
                'displayName' => 'Delete',
                'name'        => 'roleDelete',
                'guard_name'  => 'web',
                'desc'        => '',
                'marginLeft'  => 0
            ]
        ],

        'Permission Management' => [
            [
                'displayName' => 'List',
                'name'        => 'permissionList',
                'guard_name'  => 'web',
                'desc'        => '',
                'marginLeft'  => 0
            ],
        ],

        'Email Template Management' => [
            [
                'displayName' => 'List',
                'name'        => 'emailTemplateList',
                'guard_name'  => 'web',
                'desc'        => '',
                'marginLeft'  => 0
            ],
            [
                'displayName' => 'Update',
                'name'        => 'emailTemplateUpdate',
                'guard_name'  => 'web',
                'desc'        => '',
                'marginLeft'  => 0
            ],
        ],

        'User management' => [
            [
                'displayName' => 'List',
                'name'        => 'userList',
                'guard_name'  => 'web',
                'desc'        => 'Access to see users list.',
                'marginLeft'  => 0
            ],
            [
                'displayName' => 'Create',
                'name'        => 'userCreate',
                'guard_name'  => 'web',
                'desc'        => 'Create a new user.',
                'marginLeft'  => 0
            ],
            [
                'displayName' => 'Update',
                'name'        => 'userUpdate',
                'guard_name'  => 'web',
                'desc'        => 'Update a existing user.',
                'marginLeft'  => 0
            ],
            [
                'displayName' => 'Delete',
                'name'        => 'userDelete',
                'guard_name'  => 'web',
                'desc'        => 'Delete a existing user.',
                'marginLeft'  => 0
            ],
            [
                'displayName' => 'Password reset link send',
                'name'        => 'sendPasswordResetLink',
                'guard_name'  => 'web',
                'desc'        => 'Delete a existing user.',
                'marginLeft'  => 0
            ]
        ],

        'Site config' => [
            [
                'displayName' => 'General Settings',
                'name'        => 'siteConfigUpdate',
                'guard_name'  => 'web',
                'desc'        => 'User can update site configuration.',
                'marginLeft'  => 0
            ],
            [
                'displayName' => 'Mail Settings',
                'name'        => 'mailConfigUpdate',
                'guard_name'  => 'web',
                'desc'        => 'User can update mail configuration.',
                'marginLeft'  => 29
            ]
        ],

        'Audit Logs' => [
            [
                'displayName' => 'List audit logs',
                'name'        => 'listLogs',
                'guard_name'  => 'web',
                'desc'        => 'Access check site logs',
                'marginLeft'  => 0
            ],
            [
                'displayName' => 'Check log details',
                'name'        => 'LogDetail',
                'guard_name'  => 'web',
                'desc'        => 'Access to check details of a log',
                'marginLeft'  => 49
            ]
        ]
    ]
];
