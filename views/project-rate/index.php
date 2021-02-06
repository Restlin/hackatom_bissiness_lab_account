<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectRateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $rateAvg float */
/* @var $canRate boolean */

?>
<div class="project-rate-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>Средняя оценка проекта: <?= $rateAvg ?> на основании <?= $dataProvider->getTotalCount() ?> оценок</div>
    <?php if($canRate) { ?>
          <p class="content__button-wrapper">

            <?= Html::a('Оценить', ['project-rate/create', 'projectId' => $searchModel->project_id], ['class' => 'myButton myButton--green']) ?>

        </p>
    <?php } ?>

    <?php Pjax::begin(); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "\n{items}\n{pager}",
        'itemOptions' => ['class' => 'card'],
        'options' => ['class' => 'myGridProject'],
        'itemView' => 'item_view',
    ]) ?>

    <?php Pjax::end(); ?>

</div>
