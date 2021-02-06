<?php

use app\models\ProjectPart;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var ProjectPart $model */
/* @var int $key */
/* @var int $index */
/* @var ListView $widget */


?>


<div class="card__body card__notHEAD">
    <div class="card__info">
        <p class="card__label"><?= $model->part->name ?></p>
    </div>
    <div class="card__textWrapper">
        <p>Содержание:</p>
        <div>
            <p>
                <?= mb_strlen($model->content) > 0 ? $model->content : 'Не заполнено' ?>
            </p>
        </div>
    </div>
    <div class="card__files">

    </div>
    <div class="card__info card__info--big">
        <p class="card__additional">Принято: &nbsp;
            <?php if ($model->ready): ?>
            <span class="glyphicon glyphicon-ok" style="font-size: 25px; color:#07bd99" aria-hidden="true"></span>
            <?php else: ?>
            <span class="glyphicon glyphicon-remove" style="font-size: 25px; color:#cf2c2b" aria-hidden="true"></span>
            <?php endif; ?>
        </p>
    </div>
    <div class="card__buttons">
        <?= Html::a('Редактировать', ['/project-part/update', 'id' => $model->id], ['class' => 'myButton myButton--blue']) ?>
        <?= Html::a('Проверить', ['/project-part/update', 'id' => $model->id], ['class' => 'myButton myButton--green']) ?>
    </div>
</div>
