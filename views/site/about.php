<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Обо мне';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Так получилось, что я работаю в IT. Потихоньку буду пилить этот сайт, рассказывать и показывать всякое. Писать
        прочий лытдыбр.
    <p>Возможно это будет кому то интересно.
    <p>

        <code><?= __FILE__ ?></code>
</div>
