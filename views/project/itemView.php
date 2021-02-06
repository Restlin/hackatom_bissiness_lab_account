<?php

use app\helpers\UserHelper;
use app\models\Invite;
use app\models\Project;
use app\models\ProjectRate;
use app\models\Status;
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
                $stream = $model->image ? stream_get_contents($model->image) : false;
                if ($stream) {
                    $image = 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($stream);
                    echo Html::img($image, ['style' => '...']);
                } else {
                    echo Html::img('../media/123.png');
                }
                ?>
            </div>
        </div>
        <p class="card__label">
            <?= Html::a($model->name, ['/project/view', 'id' => $model->id]) ?>
        </p>
    </div>
    <div class="card__info card__info--big">
        <?php
            $rateAvg = ProjectRate::find()->andWhere(['project_id' => $model->id])->average('rate');
            $rateCnt = ProjectRate::find()->andWhere(['project_id' => $model->id])->count();
            $rate = Html::a($rateCnt, ['/project/view', 'id' => $model->id, 'tab' => 'rate']);
            $statuses = Status::getList();
            $statusName = $statuses[$model->status_id] ?: 'черновик';
        ?>
        <p class="card__additional "><?= $model->date_start ?> - <?= $model->date_end ?></p>
        <p class="card__additional">Рейтинг развития:&nbsp; <span><?= $model->rating ?>%</span></p>
        <p class="card__additional">Оценки:&nbsp; <span><?= $rateAvg ?: 0 ?></span> <span class="star"><img src="../media/star.svg" alt=""></span> (<?= $rate ?>)</p>
        <p class="card__additional">Тип:&nbsp; <span><?= $model->type->name ?></span></p>
        <p class="card__additional">Статус:&nbsp; <span><?= $statusName ?></span></p>        
        <p class="card__additional">Инвестиция:&nbsp; <span><?=$model->finance ?>р</span></p>
    </div>

    <div class="card__textWrapper">
        <p>Описание:</p>
        <div>
            <?= $model->about ?>
        </div>
    </div>
</div>