<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Progress;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $statuses array */
/* @var $projectPartIndex string */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Проекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить проект?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php

        echo Html::tag('div', 'Рейтинг развития: '. $model->rating.'%', ['style' => 'text-align: center; font-size: 18pt;']);
            // striped animated
        echo Progress::widget([
            'percent' => $model->rating,
            'barOptions' => ['class' => 'progress-bar-success'],
            'options' => ['class' => 'active progress-striped', 'style' => 'margin-bottom: 5px;']
        ]);
    ?>
    <div style="margin-bottom: 10px; overflow:auto;">
        <?php
            foreach($statuses as $code => $status) {
                echo Html::tag('div', $status, [
                    'style' => 'width:19%; margin-right: 1%; text-align: center; float:left;',
                    'class' => $model->status_id >= $code ? 'btn-info' : 'btn-secondary'
                ]);
            }
        ?>
    </div>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Период',
                'value' => $model->date_start.' - '.$model->date_end
            ],
            [
                'attribute' => 'finance',
                'value' => $model->finance.' руб.'
            ],
            [
                'attribute' => 'invested',
                'visible' => $model->invested !== null,
                'format' => 'boolean'
            ],
            'about:raw',
        ],
    ]) ?>

    <?= $projectPartIndex ?>
</div>
