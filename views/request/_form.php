<?php

use app\models\Request;
use app\models\User;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this View */
/* @var $model Request */
/* @var $form ActiveForm */
/* @var $user User */

$this->title = $model->isNewRecord ? 'Пригласить' : 'Редактировать запрос';
if ($user->email) {
    $this->title = 'Запрос на участие в проекте';
}
$this->params['breadcrumbs'][] = ['label' => 'Запросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="request-create">

    <div class="request-form">

        <?php $form = ActiveForm::begin(); ?>

        <?php if (!$user->email): ?>

        <?= $form->field($user, 'email')->textInput() ?>

        <?php endif; ?>

        <?= $form->field($model, 'comment')->widget(CKEditor::class, [
            'options' => ['rows' => 6],
            'preset' => 'basic'
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton($user->email ? 'Отправить запрос' : 'Пригласить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>