<?php
use app\models\ProjectAccess;
use app\helpers\UserHelper;
use app\models\Role;
use yii\helpers\Html;
/* @var $model ProjectAccess */
?>

<div>
    <?= UserHelper::fioLink($model->user); ?>
</div>
<div>
    Роль пользователя: <?= $model->role->name; ?>
</div>
<div>
    <?php
        if($model->role_id !== Role::ASSISTANT) {
            echo Html::a('X', ['project-access/delete', 'id' => $model->id], ['class' => 'btn-danger']);
        }
    ?>
</div>
