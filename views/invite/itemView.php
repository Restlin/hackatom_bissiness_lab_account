<?php

use app\helpers\UserHelper;
use app\models\Invite;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var Invite $model */
/* @var int $key */
/* @var int $index */
/* @var ListView $widget */

?>

<div class="card__body card__notHEAD">
    <div class="card__info">
        <div class="card__wrapperAvatar">
            <div class="card__avatar">
                <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/American_Beaver.jpg"
                     alt="">
            </div>
        </div>
        <p class="card__label">
            <?= Html::a($model->project->name, ['/project/view', 'id' => $model->project_id]) ?>
        </p>
    </div>
    <div class="card__info card__info--big">
        <p class="card__additional">Инициатор: &nbsp; <span><?= UserHelper::fioLink($model->project->iniciator) ?></span></p>
    </div>
    <div class="card__textWrapper">
        <p>Содержание:</p>
        <div>
            <?= $model->comment ?>
        </div>
    </div>
    <div class="card__buttons">
    <br>
        <?= Html::a('Откликнуться', ['new-request', 'id' => $model->id], ['class' => 'myButton myButton--blue']) ?>
    </div>
</div>