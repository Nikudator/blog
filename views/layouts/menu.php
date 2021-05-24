<?php
NavBar::begin([
    'brandLabel' => Html::img('@web/images/logo.png', ['alt'=>Yii::$app->name, 'title'=>Yii::$app->name, 'class'=>"img-responsive",], ),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'encodeLabels' => false,
    'items' => array_filter([
        Yii::$app->user->can('create') ?
            ['label' => Icon::show('feather-alt', ['class'=>'fa-lg']), 'url' => ['/post/create'], 'options' => ['title' => 'Создать запись']] : false,
        ['label' => Icon::show('envelope', ['class'=>'fa-lg']), 'url' => ['/site/contact'], 'options' => ['title' => 'Контакты']],
        ['label' => Icon::show('info-circle', ['class'=>'fa-lg']), 'url' => ['/site/about'], 'options' => ['title' => 'Обо мне']],
        ['label' => Icon::show('scroll', ['class'=>'fa-lg']), 'url' => ['/site/agreement'], 'options' => ['title' => 'Правила']],
        Yii::$app->user->isGuest ?
            ['label' => Icon::show('user-plus', ['class'=>'fa-lg']), 'url' => ['/user/default/signup'], 'options' => ['title' =>'Зарегистрироваться']] : false,
        Yii::$app->user->isGuest ?
            ['label' => Icon::show('key', ['class'=>'fa-lg']), 'url' => ['/password-request'], 'options' => ['title' =>'Восстановить пароль']] : false,
        Yii::$app->user->isGuest ?
            (['label' => Icon::show('door-open', ['class'=>'fa-lg']), 'url' => ['/login'], 'options' => ['title' => 'Войти на сайт']]
            ) : (


            '<li>'
            . Html::beginForm(['/logout'], 'post')
            . Html::submitButton(
                Icon::show('door-closed', ['class'=>'fa-lg']).' (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout',
                    'title' =>'Выйти']
            )
            . Html::endForm()
            . '</li>'
        )
    ])
]);
NavBar::end();
?>