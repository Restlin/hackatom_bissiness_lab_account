<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Progress;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $statuses array */
/* @var $projectPartIndex string */
/* @var $requestIndex string */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Проекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <div class="wrapper">
        <?= \yii\bootstrap\Tabs::widget([
                'options' => ['class' => 'nav nav-tabs nav-tabs-custom'],
             'items' => [
                 [
                     'label' => 'Информация',
                     'content' => $this->render('info', ['model' => $model, 'statuses' => $statuses]),
                     'active' => true,
                     'headerOptions' => ['role' => 'presentation'],
                 ],
                 [
                     'label' => 'Разделы',
                     'content' => $projectPartIndex,
                     'headerOptions' => ['role' => 'presentation'],
                 ],
                 [
                     'label' => 'Команда',
                     'content' => 'Команда',
                     'headerOptions' => ['role' => 'presentation'],
                 ],
                 [
                     'label' => 'Оценки',
                     'content' => 'Оценки',
                     'headerOptions' => ['role' => 'presentation'],
                 ],
             ],
         ]); ?>
    </div>

</div>
