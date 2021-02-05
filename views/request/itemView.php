<?php

use app\helpers\UserHelper;
use app\models\Request;
use app\models\Role;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var Request $model */
/* @var int $key */
/* @var int $index */
/* @var ListView $widget */

?>



<div class="card__head card__head--center">
    <div class="card__head-item">
        <span>Хочет присоединится</span>
    </div>
</div>
<div class="card__body ">
    <div class="card__info not__margin">
        <div class="card__wrapperAvatar">
            <div class="card__avatar">
                <?php
                    $image = $model->user->image ? 'data:image/jpeg;charset=utf-8;base64,' . base64_encode(stream_get_contents($model->user->image)) : '';
                    if ($image) {
                        echo Html::img($image, ['style' => '...']);
                    }
                ?>
            </div>
        </div>
        <p class="card__label">
            <?= UserHelper::fioLink($model->user) ?>
        </p>
    </div>
    <div class="card__info card__info card__to">
        <p ><span>хочет присоединится к проекту:</span> &nbsp; <b><?= Html::a($model->project->name, ['/project/view', 'id' => $model->project_id]) ?></b></p>
    </div>

    <div class="card__textWrapper">
        <p>Запрос:</p>
        <div>
            <?= $model->comment ?>
        </div>
    </div>
    <br>
    <div class="card__buttons">
        <br/>
        <?= Html::a('Принять', ['execute', 'id' => $model->id, 'role' => Role::ASSISTANT], ['class' => 'myButton myButton--green']) ?>
        <?= Html::a('Отклонить', ['execute', 'id' => $model->id, 'role' => false], ['class' => 'myButton myButton--red']) ?>
    </div>
</div>







