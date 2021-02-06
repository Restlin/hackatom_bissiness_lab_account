<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Решение об инвестициях';
$this->params['breadcrumbs'][] = ['label' => 'Проекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Инвестиции';
?>
<div class="project-update">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <hr>
    
    <p> Проекту требуется сумма в <?= $model->finance ?> рублей </p>

    <div class="project-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'invested')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
