<?php

use app\helpers\UserHelper;
use app\models\Invite;
use app\models\Project;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var Project $model */
/* @var int $key */
/* @var int $index */
/* @var ListView $widget */

?>


<div class="card__body card__notHEAD ">
    <div class="card__info">
        <div class="card__wrapperAvatar">
            <div class="card__avatar">
                <?php
                $image = $model->image ? 'data:image/jpeg;charset=utf-8;base64,' . base64_encode(stream_get_contents($model->image)) : '';
                if ($image) {
                    echo Html::img($image, ['style' => '...']);
                }
                ?>
            </div>
        </div>
        <p class="card__label">
            <?= Html::a($model->name, ['/project/view', 'id' => $model->id]) ?>
        </p>
    </div>
    <div class="card__info card__info--big">
        <p class="card__additional ">01.01.2021 - 31.03.2021</p>
        <p class="card__additional">Рейтинг развития:&nbsp; <span>55%</span></p>
        <p class="card__additional">Оценки:&nbsp; <span>3.4</span> <span class="star"><img src="../media/star.svg" alt=""></span> (<a href="#">202</a>)</p>
        <p class="card__additional">Статус:&nbsp; <span>Идея</span></p>
        <p class="card__additional">Инвестиция:&nbsp; <span>10.000.000р</span></p>
    </div>

    <div class="card__textWrapper">
        <p>Описание:</p>
        <div>
            <p>
                Я красавчик, я жую деревья
            </p>
            <p>
                Делаю болота и пугаю твоих детей
            </p>
            <p>
                Я красавчик, я жую деревья
            </p>
            <p>
                Делаю болота и пугаю твоих детей
            </p>
            <p>
                Я красавчик, я жую деревья
            </p>
            <p>
                Делаю болота и пугаю твоих детей
            </p>
        </div>
    </div>
</div>