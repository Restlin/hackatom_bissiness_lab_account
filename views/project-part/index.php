<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\ProjectPart;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="project-part-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items}',
        'filterModel' => null,
        'columns' => [
            [
                'attribute' => 'part_id',
                'value' => function(ProjectPart $model) {
                    return $model->part->name;
                }
            ],
            'content:raw',
            'ready:boolean',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'controller' => 'project-part',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
