<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\markdown\Markdown;

/* @var $this yii\web\View */
/* @var $model app\modules\post\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (\Yii::$app->user->can('update') || \Yii::$app->user->can('updateOwnPost', $model->author_id)) {
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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'author_id',
            'title',
            'created_at',
            'updated_at',
        ],
    ]) ?>
<p></p>
    <?php echo Markdown::convert($model->body); ?>

</div>
