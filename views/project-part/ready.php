<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectPart */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Проверка: ' . $model->part->name;
$this->params['breadcrumbs'][] = ['label' => 'Проекты', 'url' => ['project/index']];
$this->params['breadcrumbs'][] = ['label' => $model->project->name, 'url' => ['project/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = 'Проверка раздела';
?>
<div class="project-part-update">

    <h1><?= Html::encode($this->title) ?></h1>    

    <div class="project-part-form">

        <?php $form = ActiveForm::begin(); ?>    

        <?= $form->field($model, 'ready')->checkbox() ?>
        
        <?= $form->field($model, 'comment')->widget(CKEditor::class, [        
            'preset' => 'basic'
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
