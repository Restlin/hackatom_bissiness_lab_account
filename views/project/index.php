<?php

use yii\helpers\Html;
use yii\grid\GridView;
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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать проект', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'name',
                'value' => function(Project $model) {
                    return Html::a($model->name, ['view', 'id' => $model->id], ['data-pjax' => 0]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'status_id',
                'value' => function(Project $model) {
                    return $model->status->name;
                },
                'filter' => $statusList
            ],
            'rating',
            'finance',
            'invested:boolean',
            [
                'label' => 'Сроки',
                'value' => function(Project $model) {
                    return $model->date_start.' - '.$model->date_end;
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
