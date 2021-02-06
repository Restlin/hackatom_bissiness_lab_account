<?php

use app\models\Project;
use yii\bootstrap\Progress;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Project */
/* @var $statuses array */

?>



        <p class="content__button-wrapper">
            <?= Html::a('PDF', ['view', 'id' => $model->id], ['class' => 'myButton myButton--red']) ?>
            &nbsp;
            <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'myButton myButton--blue']) ?>
            &nbsp;
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'myButton myButton--red',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить проект?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>


        <br>
<div class=" content__item content__top">
    <p class="content__name"> <?= $model->name ?></p>
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
            <br>
        </div>
        <div class="content__date">
            <p class="content__date-label-preview">Время исполнения:</p>
            <div>
                <p><?= $model->date_start ?> — <?= $model->date_end ?></p>
                <span></span>
            </div>
        </div>
    </div>
</div>


        <div class=" content__item content__progressBar">
            <!--                Прогрессбар сюда-->
            <?php

            echo Html::tag('div', 'Рейтинг развития: '. $model->rating.'%', ['style' => 'text-align: center; font-size: 18pt;']);
            // striped animated
            echo Progress::widget([
                'percent' => $model->rating,
                'barOptions' => ['class' => 'progress-bar-success'],
                'options' => ['class' => 'active progress-striped', 'style' => 'margin: 10px 0;']
            ]);
            ?>
            <div style="margin-bottom: 10px; overflow:auto; height: 25px;">
                <?php
                foreach($statuses as $code => $status) {
                    echo Html::tag('div', $status, [
                        'style' => 'width:19%; margin-right: 1%; text-align: center; float:left;',
                        'class' => $model->status_id >= $code ? 'btn-info' : 'btn-secondary'
                    ]);
                }
                ?>
            </div>

        </div>

        <div class=" content__item price">
            <p>Требуемое финансирование: <span> <?= $model->finance ?> рублей</span></p>
        </div>

        <div class="content__item content__info">
            <header>Описание:</header>
            <div class="content__infoMain">
                <?= $model->about ?>
            </div>
        </div>

