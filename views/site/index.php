<?php

use yii\web\View;
use yii\helpers\Html;

/* @var $this View */
/* @var $projects int */
/* @var $sums int */
/* @var $invites int */
/* @var $users int */
/* @var $rates int */

$this->title = 'Главная';
?>

<h1>Сейчас на сервисе:</h1>

<div class="site-index">

    <div><?=Html::a($projects, ['project/index']) ?> проектов</div>

    <div> Уже проинвестировано <?=$sums ?> рублей </div>

    <div><?=Html::a($invites, ['invite/index']) ?> объявлений</div>

    <div><?=Html::a($users, ['user/index']) ?> пользователей</div>

    <div>У проектов <?=$rates ?> оценок</div>
</div>


