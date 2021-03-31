<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\markdown\MarkdownEditor;

/* @var $this yii\web\View */
/* @var $model app\modules\post\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tags')->listBox(
        ArrayHelper::map($tags, 'id', 'title'),
        [
            'multiple' => true
        ]
    ); ?>

    <?= $form->field($model, 'anons')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'body')->widget(
        MarkdownEditor::classname(),
        ['height' => 500, 'encodeLabels' => false]
    ); ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
