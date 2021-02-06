<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Progress;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $canEdit bool */
/* @var $statuses array */
/* @var $projectPartIndex string */
/* @var $projectAccessIndex string */
/* @var $projectRateIndex string */
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
                 'tabContentOptions' => ['class' => 'content'],
             'items' => [
                 [
                     'label' => 'Информация',
                     'content' => $this->render('info', ['model' => $model, 'statuses' => $statuses, 'canEdit' => $canEdit]),
                     'active' => $tab == 'info',
                     'headerOptions' => ['role' => 'presentation'],
                 ],
                 [
                     'label' => 'Разделы',
                     'content' => $projectPartIndex,
                     'active' => $tab == 'part',
                     'headerOptions' => ['role' => 'presentation'],
                 ],
                 [
                     'label' => 'Команда',
                     'content' => $projectAccessIndex,
                     'active' => $tab == 'access',
                     'headerOptions' => ['role' => 'presentation'],
                 ],
                 [
                     'label' => 'Оценки',
                     'content' => $projectRateIndex,
                     'active' => $tab == 'rate',
                     'headerOptions' => ['role' => 'presentation'],
                 ],
             ],
         ]); ?>
    </div>

</div>
