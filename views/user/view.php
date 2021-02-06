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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <!--<?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены?',
                'method' => 'post',
            ],
        ]) ?>
        !-->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'image',
                'format' => 'raw',
                'value' => function($model) {
                    $stream = $model->image ? stream_get_contents($model->image) : false;
                    if ($stream) {
                        $image = 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($stream);
                        echo Html::img($image, ['style' => '...']);
                    }else {
                        echo Html::img('../media/123.png');
                    }
                    return '';
                },
            ],
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
