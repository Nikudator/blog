return [
    'components' => [
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'vkontakte' => [
                    'class' => 'yii\authclient\clients\Vkontakte',
                    'clientId' => '',
                    'clientSecret' => '',
                ],
            ],
        ]
    ],
];
