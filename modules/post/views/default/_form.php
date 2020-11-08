<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\post\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anons')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'body')->widget(\h0rseduck\tuieditor\TuiEditor::class, [
        'editorOptions' => [
            'initialEditType' => 'markdown',
            'previewStyle' => 'vertical',
            'height' => '500px'
        ]
    ]); ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
