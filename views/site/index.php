<?php

use yii\web\View;
use yii\helpers\Html;

/* @var $this View */

$this->title = 'Главная';
?>

<div class="site-index">
    <?= Html::a('Проекты', ['project/index']) ?>
    <br/>
    <?= Html::a('Запросы', ['request/index']) ?>
    <br/>
    <?= Html::a('Объявления', ['invite/index']) ?>
</div>
