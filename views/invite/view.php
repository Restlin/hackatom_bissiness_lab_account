<?php

use app\models\Invite;
use yii\helpers\Html;
use yii\web\View;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Invite */
/* @var $canEdit bool */
/* @var $canRequest bool */

$this->title = "Объявление №{$model->id}";
$this->params['breadcrumbs'][] = ['label' => 'Объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="invite-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($canEdit): ?>

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

    <?php endif; ?>

    <?php if ($canRequest): ?>

        <p class="content__button-wrapper">
            &nbsp;
            <?= Html::a('Присоединиться к проекту', ['new-request', 'id' => $model->id], ['class' => 'myButton myButton--blue']) ?>
        </p>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Проект',
                'value' => Html::a($model->project->name, ['project/view', 'id' => $model->project_id]),
                'format' => 'html',
            ],
            [
                'label' => 'Автор',
                'value' => "{$model->project->iniciator->name} {$model->project->iniciator->surname}"
            ],
            'date',
            'comment:ntext',
        ],
    ]) ?>

</div>
