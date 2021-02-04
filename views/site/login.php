<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
?>
<div class="site-login">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['placeholder' => 'Эл. почта или телефон +7-XXX-XXX-XX-XX'])->label('') ?>

    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль'])->label('') ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <div class="col-md-6 text-right">
        <?= Html::a('Не помню пароль', ['site/forgot']) ?>
    </div>
    <div class="col-md-6">
        <?= Html::a('Зарегистрироваться', ['site/registration']) ?>
    </div>
</div>
