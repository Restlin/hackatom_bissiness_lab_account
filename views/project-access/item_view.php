<?php
use app\models\ProjectAccess;
use app\helpers\UserHelper;
use app\models\Role;
use yii\helpers\Html;
/* @var $model ProjectAccess */
/* @var $canDelete bool */
?>

    <div class="card">
        <div class="card__head">
            <div class="card__head-item">
                <span>Организация</span>
                <span><?= $model->user->firm ?></span>
            </div>
            <div class="card__head-item">
                <?php if ($canDelete && $model->role_id === Role::ASSISTANT): ?>
                <?= Html::a('<span class="glyphicon glyphicon-remove " style="color:currentColor" aria-hidden="true"></span>', ['project-access/delete', 'id' => $model->id], ['class' => 'myButton myButton--white', 'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить?',
                        'method' => 'post',
                    ],]) ?>
                <?php else: ?>
                    <span>Email</span>
                    <span><?= $model->user->email ?></span>
                <?php endif; ?>
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
                        }else {
                            echo Html::img('../media/123.png');
                        }
                        ?>
                    </div>
                </div>
                <p class="card__label"><?= UserHelper::fioLink($model->user); ?></p>
                <!--                            <p class="card__additional">email: <span>Bober2145@yandex.ru</span></p>-->
                <!--<p class="card__additional">Телефон: <span><?= $model->user->phone ?></span></p> !-->
                <p class="card__additional">Роль: <span> <?= $model->role->name ?></span></p>
            </div>

            <div class="card__textWrapper">
                <p>О себе:</p>
                <div>
                    <?= $model->user->about ?>
                </div>
            </div>
        </div>
    </div>
