<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectSearch */
/* @var $form ActiveForm */
/* @var $statusList array */
/* @var $typeList array */

$typesList = [null => ''] + \app\models\Type::getList();
?>

<div class="project-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        //'layout' => 'horizontal',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="col-md-3">
        <?= $form->field($model, 'name') ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($model, 'status_id')->dropDownList($statusList) ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($model, 'type_id')->dropDownList($typesList) ?>
    </div>
    <div class="col-md-3">
        <p class="content__button-wrapper pull-left" style="margin-top: 23px;">
            <?= Html::submitButton('Поиск', ['class' => 'myButton myButton--blue']) ?>
        </p>
    </div>


    <?php ActiveForm::end(); ?>

</div>
