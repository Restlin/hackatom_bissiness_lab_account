<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\rating\StarRating;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectRate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-rate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rate')->widget(StarRating::class, [
        'pluginOptions' => [
            'size'=>'lg'
        ]
    ]);
    ?>

    <?= $form->field($model, 'comment')->widget(CKEditor::class, [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Оценить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
