<?php

/* @var $project app\models\Project */
use app\helpers\UserHelper;
use yii\helpers\Html;
?>
<h1><?= $project->name ?></h1>
<div style="overflow: auto">
    <div style="float: left; width: 120mm;">
        Тип: <?= $project->type->name ?><br>
        Сроки проекта: <?= $project->date_start ?> - <?= $project->date_end ?><br>
        Требуемое финансирование: <?= $project->finance ?> рублей
    </div>
    <div style="float: left; width: 60mm;">
        <?php 
            $stream = $project->image ? stream_get_contents($project->image) : false;
            if ($stream) {
                $image = 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($stream);
                echo Html::img($image, ['style' => 'width: 50mm;']);
            }
        ?>
    </div>    
</div>
<h2>Команда проекта</h2>
<ol>
<?php 
    foreach($project->projectAccesses as $access) { ?>
    <li><?= UserHelper::fio($access->user) ?>, <?=$access->role->name ?> </li>
    <?php }
?>
</ol>
<h2>Аннотация</h2>
<?= $project->about ?>
<?php 
    foreach($project->projectParts as $part) { ?>
        <h3><?= $part->part->name ?></h3>
        <hr>
        <?= $part->content ?>
    <?php }
?>
