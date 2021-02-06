<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'about')->widget(CKEditor::class, [
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'finance')->textInput() ?>

    <?= $form->field($model, 'date_start')->widget(DatePicker::class, [
        'language' => 'ru',
    ]) ?>

    <?= $form->field($model, 'date_end')->widget(DatePicker::class, [
        'language' => 'ru',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
