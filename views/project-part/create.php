<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectPart */

$this->title = 'Create Project Part';
$this->params['breadcrumbs'][] = ['label' => 'Project Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-part-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
