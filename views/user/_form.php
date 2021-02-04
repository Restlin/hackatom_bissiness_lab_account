<?php

use app\models\User;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model User */

$this->title = $model->isNewRecord ? 'Создать' : 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'no_confirm_email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email_code')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email_code_unixtime')->textInput() ?>

        <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pwd_reset_token')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pwd_reset_token_unixtime')->textInput() ?>

        <?= $form->field($model, 'active')->checkbox() ?>

        <?= $form->field($model, 'firm')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>