<?php

use yii\web\View;
use yii\helpers\Html;

/* @var $this View */
/* @var $projects int */
/* @var $sums int */
/* @var $invites int */
/* @var $users int */
/* @var $rates int */

$this->title = 'Главная';
?>
<div class="myPreview js-preview">
    <header class="myPreview__header">Сейчас на сервисе</header>
    <div
            class="myCounter myCounter--65 myPreview__myCounter js-leftPreviewElement"
    >
        <div class="MyCounter__textWrapper">
            <?=Html::a("{$projects} проектов", ['project/index']) ?>
        </div>
    </div>

    <div
            class="myCounter myCounter--80 myCounter--rev myPreview__myCounter js-rightPreviewElement"
    >
        <div class="MyCounter__textWrapper MyCounter__textWrapper--rev">
            Уже проинвестировано <?=$sums ?> рублей
        </div>
    </div>

    <div
            class="myCounter myCounter--65 myPreview__myCounter js-leftPreviewElement"
    >
        <div class="MyCounter__textWrapper">
            <?=Html::a("{$invites} объявлений", ['invite/index']) ?>
        </div>
    </div>

    <div
            class="myCounter myCounter--65 myCounter--rev myPreview__myCounter js-rightPreviewElement"
    >
        <div class="MyCounter__textWrapper">
            <?php
                $cntProjectAccess = \app\models\ProjectAccess::find()->andWhere(['role_id' => \app\models\Role::ASSISTANT])->count();
            ?>
            <?= $cntProjectAccess ?> откликов</a>
        </div>
    </div>

    <div
            class="myCounter myCounter--60 myCounter myPreview__myCounter js-leftPreviewElement"
    >
        <div class="MyCounter__textWrapper">
            <?=Html::a("{$users} пользователей", ['user/index']) ?>
        </div>
    </div>

    <div class="myCounter__buttonWrapper">
        <div
                class="myCounter myCounter--50 myCounter--rev myPreview__myCounter js-rightPreviewElement"
        >
            <div class="MyCounter__textWrapper">
                У проектов <?=$rates ?> оценок
            </div>
            <?= Html::a('Воплотить свою идею', ['project/create'], ['class' => 'js-buttonPreview myCounter__myButton myButton myButton--blue myButton--BIG']) ?>
        </div>
    </div>
    <div class="buttonPreview__line">
        <?= Html::a('Воплотить свою идею', ['project/create'], ['class' => 'buttonPreview  myButton myButton--blue myButton--BIG']) ?>
    </div>
</div>