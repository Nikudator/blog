<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\icons\Icon;
Icon::map($this);

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php Yii::$app->user->isGuest ? Yii::$app->session->setFlash('warning', "Наш сайт использует файлы cookes, если вы не согласны с этим, то покиньте сайт.") : false; ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Yii::$app->name . ' ' . Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/highlight.min.js"></script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
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
                    ['class' => 'btn btn-link logout'], ['options' => ['title' =>'Выйти']]
                )
                . Html::endForm()
                . '</li>'
            )
        ])
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Одноглазый Джо aka One-eyed Joe 2019 - <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?> / <a href="http://php.net">PHP</a> / <a href="http://apache.org">Apache</a>
            / <a href="http://nginx.org">Nginx</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
