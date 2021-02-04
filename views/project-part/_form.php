<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectPart */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-part-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ready')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
