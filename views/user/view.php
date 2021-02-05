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
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute'=>'image',
                'format' => 'raw',
                'value' => function($data) {
                    $image = $data->image ? 'data:image/jpeg;charset=utf-8;base64,' . base64_encode(stream_get_contents($data->image)) : '';
                    if ($image) {
                        return Html::img($image, ['style' => '...']);

                    }
                    return '';
                },
            ],
            'surname',
            'name',
            'phone',
            'email:email',
            'firm',
            'about:ntext',
        ],
    ]) ?>

</div>
