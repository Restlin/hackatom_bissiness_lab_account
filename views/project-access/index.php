<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectAccessSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $canInvite bool */
?>
<div class="project-access-index">

    <p class="content__button-wrapper">
        <?php
            if($canInvite) {
            echo Html::a('Пригласить', ['/request/autocreate', 'projectId' => $searchModel->project_id], ['class' => 'myButton myButton--blue']),
                    '&nbsp;',
                 Html::a('Подать объявление', ['/invite/autocreate', 'projectId' => $searchModel->project_id], ['class' => 'myButton myButton--blue']);
            } ?>
    </p>
    <?php Pjax::begin(); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "\n{items}\n{pager}",
        'itemOptions' => ['class' => 'card'],
        'options' => ['class' => 'myGridProject'],
        'itemView' => 'item_view',
        'viewParams' => ['canDelete' => $canInvite],
    ]) ?>

    <?php Pjax::end(); ?>

</div>
