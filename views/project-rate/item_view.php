<?php
use app\models\ProjectRate;
use yii\helpers\Html;
use app\helpers\UserHelper;
/* @var $model ProjectRate */
?>

<div>
    Оценка: <?=  $model->rate ?>
</div>


<div class="card__head">
    <div class="card__head-item">
        <span>Организация</span>
        <span><?= $model->user->firm ?></span>
    </div>
    <div class="card__head-item">
        <span>Email</span>
        <span><?= $model->user->email ?></span>
    </div>
</div>
<div class="card__body">
    <div class="card__info">
        <div class="card__wrapperAvatar">
            <div class="card__avatar">
                <?php
                $stream = $model->user->image ? stream_get_contents($model->user->image) : false;
                if ($stream) {
                    $image = 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($stream);
                    echo Html::img($image, ['style' => '...']);
                } else {
                    echo Html::img('../media/123.png');
                }
                ?>
            </div>
        </div>
        <p class="card__label"><?= UserHelper::fioLink($model->user) ?></p>
        <p class="card__additional">Оценка:&nbsp; <span><?= $model->rate ?></span> <span class="star"><img src="../media/star.svg" alt=""></span></p>
    </div>

    <div class="card__textWrapper">
        <p>Комментарий:</p>
        <div>
            <p>
                <?=  $model->comment ?>
            </p>
        </div>
    </div>
</div>