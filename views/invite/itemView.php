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
                <?php
                    $image = $model->project->image ? 'data:image/jpeg;charset=utf-8;base64,' . base64_encode(stream_get_contents($model->project->image)) : '';
                    if ($image) {
                        echo Html::img($image, ['style' => '...']);
                    }
                ?>
            </div>
        </div>
        <p class="card__label">
            <?= Html::a($model->project->name, ['/project/view', 'id' => $model->project_id]) ?>
        </p>
    </div>
    <div class="card__info card__info--big">
        <p class="card__additional">Инициатор: &nbsp; <span><a href="#"><?= UserHelper::fioLink($model->project->iniciator) ?></a></span></p>
    </div>
    <div class="card__textWrapper">
        <p>Содержание:</p>
        <div>
            <?= $model->comment ?>
        </div>
    </div>
    <br>
    <div class="card__buttons">
        <br/>
        <?= Html::a('Откликнуться', ['new-request', 'id' => $model->id], ['class' => 'myButton myButton--blue']) ?>
    </div>
</div>
