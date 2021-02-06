<?php

use app\models\UserSearch;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\ListView;

/* @var $this View */
/* @var $searchModel UserSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "\n{items}\n{pager}",
        'itemOptions' => ['class' => 'card'],
        'options' => ['class' => 'myGridProject'],
        'itemView' => 'itemView',
    ]) ?>

</div>
