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
    'auth' => [
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
    'about' => [
        'type' => 2,
    ],
    'contact' => [
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
            'auth',
            'error',
            'index',
            'view',
            'about',
            'contact',
        ],
    ],
    'user' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'logout',
            'passwordrequest',
            'guest',
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
            'update',
            'redactor',
        ],
    ],
    'admin' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'delete',
            'moderator',
            'root',
        ],
    ],
    'root' => [
        'type' => 1,
        'ruleName' => 'userGroup',
    ],
];
