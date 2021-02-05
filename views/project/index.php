<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use app\models\Project;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $statusList array */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <p class="content__button-wrapper">

        <?= Html::a('Создать проект', ['create'], ['class' => 'myButton myButton--green']) ?>

    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "\n{items}\n{pager}",
        'itemOptions' => ['class' => 'card'],
        'options' => ['class' => 'myGridProject'],
        'itemView' => 'itemView',
    ]) ?>

</div>
