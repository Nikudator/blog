<?php
return [
    'login' => [
        'type' => 2,
    ],
    'logout' => [
        'type' => 2,
    ],
    'emailconfirm' => [
        'type' => 2,
    ],
    'passwordrequest' => [
        'type' => 2,
    ],
    'resendverificationemail' => [
        'type' => 2,
    ],
    'error' => [
        'type' => 2,
    ],
    'signup' => [
        'type' => 2,
    ],
    'index' => [
        'type' => 2,
    ],
    'view' => [
        'type' => 2,
    ],
    'update' => [
        'type' => 2,
    ],
    'delete' => [
        'type' => 2,
    ],
    'create' => [
        'type' => 2,
    ],
    'guest' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'login',
            'signup',
            'emailconfirm',
            'passwordrequest',
            'resendverificationemail',
            'error',
            'index',
            'view',
        ],
    ],
    'user' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'guest',
            'logout',
            'passwordrequest',
        ],
    ],
    'redactor' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'create',
            'user',
        ],
    ],
    'moderator' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'redactor',
            'update',
        ],
    ],
    'admin' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'delete',
            'moderator',
        ],
    ],
    'root' => [
        'type' => 1,
        'ruleName' => 'userGroup',
    ],
];
