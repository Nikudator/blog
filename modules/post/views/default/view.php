<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\markdown\Markdown;

/* @var $this yii\web\View */
/* @var $model app\modules\post\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>


        <?php
        if (\Yii::$app->user->can('update') || \Yii::$app->user->can('updateOwnPost', ['author_id' => $model->author_id])) {
            echo Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'],);
        }

        ?>
        <?php
        if (\Yii::$app->user->can('delete')) {
        echo Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы точно хотите удалить статью '.Html::encode($this->title),
                    'method' => 'post',
                ],
            ],);
        }
        ?>
    </p>
    <div class="tags">
        Тэги: <?php foreach($model->getTagPost()->all() as $post) : ?>
            <?= $post->getTag()->one()->title ?>
        <?php endforeach; ?>
    </div>

    <div class="blog-anons"><?php echo Html::encode($model->anons);?></div>
    <p></p>
    <div class="blog-body"><?php echo Markdown::convert($model->body); ?></div>

    <div>
    <span class="pull-left text-capitalize">Автор: <?= $model->author->username; ?> Опубликовано: <?= $model->getDate();?>  Обновлено: <?= $model->getUpdate();?></span>
    </div>
</div>
