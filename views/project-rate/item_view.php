<?php
use app\models\ProjectRate;
use yii\helpers\Html;
use app\helpers\UserHelper;
/* @var $model ProjectRate */
?>

<div>
    Пользователь: <?= UserHelper::fioLink($model->user) ?>
</div>
<div>
    Оценка: <?=  $model->rate ?>
</div>
<div>
    Комментарий: <?=  $model->comment ?>
</div>