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
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
<?php
    include menu.php;
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
