<?php

use app\models\Request;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Request */
/* @var $form ActiveForm */

$this->title = $model->isNewRecord ? 'Создать запрос' : 'Редактировать запрос';
$this->params['breadcrumbs'][] = ['label' => 'Запросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="request-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'project_id')->textInput() ?>

        <?= $form->field($model, 'user_id')->textInput() ?>

        <?= $form->field($model, 'author_id')->textInput() ?>

        <?= $form->field($model, 'executor_id')->textInput() ?>

        <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>