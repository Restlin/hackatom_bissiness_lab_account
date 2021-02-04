<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Invite */
/* @var $form yii\widgets\ActiveForm */

$this->title = $model->isNewRecord ? 'Создать' : 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invite-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="invite-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'project_id')->textInput() ?>

        <?= $form->field($model, 'author_id')->textInput() ?>

        <?= $form->field($model, 'date')->textInput() ?>

        <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
