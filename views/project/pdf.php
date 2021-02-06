<?php

/* @var $project app\models\Project */
use app\helpers\UserHelper;
?>
<h1><?= $project->name ?></h1>
<div>Сроки проекта: <?= $project->date_start ?> - <?= $project->date_end ?></div>
<div>Требуемое финансирование: <?= $project->finance ?> рублей</div>
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
