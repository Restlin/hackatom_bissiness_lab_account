<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Invite */
/* @var $form yii\widgets\ActiveForm */

$this->title = $model->isNewRecord ? 'Создать' : 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invite-create">


    <div class="invite-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'comment')->widget(CKEditor::class, [
            'options' => ['rows' => 6],
            'preset' => 'basic'
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
