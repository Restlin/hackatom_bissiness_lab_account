<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $canEdit bool */
/* @var $canReady bool */

?>
<div class="project-part-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "\n{items}\n{pager}",
        'itemOptions' => ['class' => 'card'],
        'options' => ['class' => 'myGridProject'],
        'itemView' => 'itemView',
        'viewParams' => [
            'canEdit' => $canEdit,
            'canReady' => $canReady,
        ],
    ]) ?>

    <?php Pjax::end(); ?>

</div>
