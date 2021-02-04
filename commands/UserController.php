<?php

namespace app\commands;

use app\models\Role;
use app\models\User;
use app\models\UserRole;
use Yii;
use yii\console\Controller;
use yii\db\Exception;

class UserController extends Controller {

    public function actionCreateAdmin() {
        $params = Yii::$app->params;
        if (!isset($params['adminUser'])) {
            throw new Exception('Не заполнена конфигурация пользователя admin!');
        }
        $user = User::findOne(['email' => $params['adminUser']['email']]);
        if (!$user) {
            $user = new User();
        }
        $user->setAttributes($params['adminUser']);
        $user->password_hash = Yii::$app->security->generatePasswordHash($params['adminUser']['password']);
        if ($user->save()) {
            $userRole = UserRole::findOne(['user_id' => $user->id, 'role_id' => Role::ADMIN]);
            if (!$userRole) {
                $userRole = new UserRole();
            }
            $userRole->user_id = $user->id;
            $userRole->role_id = Role::ADMIN;
            $userRole->save();
        }
    }

}
