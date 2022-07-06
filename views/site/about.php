<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Обо мне';
$this->registerMetaTag(['name' => 'description', 'content' => Yii::$app->name . ': ' . Html::encode($this->title)]);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Приветствую на моем сайте. Я блогер. Здесь я буду рассказывать и показывать всякое, что взбредет в мою голову.
    <p>Возможно это будет кому то интересно.
    <p>
    <p>Мой Youtube-канал - https://www.youtube.com/channel/UC6k9vQrMLnZPslhC7kUFhqg
    <p>Моя группа Вконтакте - https://vk.com/oneeyedjoe
    <p>Задонатить на Boosty - https://boosty.to/oej
    <p>Задонатить на - https://www.donationalerts.com/r/one_eyed_joe
</div>
