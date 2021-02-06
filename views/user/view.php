<?php

use app\models\User;
use yii\helpers\Html;
use yii\web\View;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);

$roles = [];
foreach($model->userRoles as $userRole) {
    $roles[] = $userRole->role->name.' '. Html::a('X',
            ['user-role/delete', 'id' => $userRole->id],
            [
                'data-confirm' => 'Вы уверены, что хотите удалить эту роль?',
                'data-method' => 'POST',
                'class' => 'btn btn-danger'
            ]
    );
}
$roles[] = Html::a('Добавить роль', ['user-role/create', 'userId' => $model->id], ['class' => 'btn btn-success']);
?>
<div class="user-view">
    <p class="content__button-wrapper">
        &nbsp;
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'myButton myButton--blue']) ?>
        &nbsp;
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'myButton myButton--red',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <div class=" content__item content__top">
        <p class="content__name"><?= $model->surname ?> <?= $model->name ?></p>
        <div class="content__line" style="margin-top:10px">
            <div class="content__avatar-wrapper">
                <?php
                $stream = $model->image ? stream_get_contents($model->image) : false;
                if ($stream) {
                    $image = 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($stream);
                    echo Html::img($image, ['style' => '...']);
                }else {
                    echo Html::img('../media/123.png');
                }
                ?>
            </div>

        </div>
    </div>

    <div class=" content__item price">
        <p><?= $model->getAttributeLabel('phone') ?>: <span> <?= $model->phone ?></span></p>
    </div>
    <div class=" content__item price">
        <p><?= $model->getAttributeLabel('email') ?>: <span> <?= $model->email ?></span></p>
    </div>
    <div class=" content__item price">
        <p><?= $model->getAttributeLabel('firm') ?>: <span> <?= $model->firm ?></span></p>
    </div>

    <div class="content__item content__info">
        <header>О себе:</header>
        <div class="content__infoMain">
            <?= $model->about ?>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                'label' => 'ФИО',
                'value' => $model->name.' '.$model->surname
            ],
            [
                'label' => 'Роли',
                'value' => $roles ? implode(' ', $roles) : null,
                'format' => 'raw',

            ],
            'email:email',
            'phone',
            'firm',
            'about:ntext',
        ],
    ]) ?>
</div>
