<?php

namespace app\models;

use borales\extensions\phoneInput\PhoneInputValidator;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id ИД
 * @property string $surname Фамилия
 * @property string $name Имя
 * @property string|null $patronymic Отчество
 * @property string $phone Телефон
 * @property string $email Email
 * @property string|null $no_confirm_email Не подтверждённый email
 * @property string|null $email_code Код подтверждения Email
 * @property int|null $email_code_unixtime Время генерации кода
 * @property string|null $password_hash Хеш пароля
 * @property string|null $pwd_reset_token Токен для сброса пароля
 * @property int|null $pwd_reset_token_unixtime Время жизни токена сброса пароля
 * @property bool $active Активирован
 * @property string|null $firm Организация
 * @property string|null $about О себе
 *
 * @property bool $isAdmin
 */
class User extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['surname', 'name', 'email'], 'required'],
            [['email_code_unixtime', 'pwd_reset_token_unixtime'], 'integer'],
            [['active'], 'boolean'],
            [['surname', 'name', 'patronymic', 'email', 'no_confirm_email'], 'string', 'max' => 50],
            [['firm'], 'string', 'max' => 100],
            [['about'], 'string'],

            [['phone'], 'filter', 'filter' => fn($value) => $value ?: null],
            [['phone'], 'string', 'max' => 20],
            [['phone'], 'unique'],
            [['phone'], PhoneInputValidator::class],

            [['email_code'], 'string', 'max' => 6],
            [['password_hash'], 'string', 'max' => 64],
            [['pwd_reset_token'], 'string', 'max' => 32],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ИД',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
            'phone' => 'Телефон',
            'email' => 'Email',
            'no_confirm_email' => 'Не подтверждённый email',
            'email_code' => 'Код подтверждения Email',
            'email_code_unixtime' => 'Время генерации кода',
            'password_hash' => 'Хеш пароля',
            'pwd_reset_token' => 'Токен для сброса пароля',
            'pwd_reset_token_unixtime' => 'Время жизни токена сброса пароля',
            'active' => 'Активирован',
            'firm' => 'Организация',
            'about' => 'О себе',
        ];
    }

    public function getIsAdmin(): bool
    {
        return (bool) UserRole::find()->andWhere(['user_id' => $this->id, 'role_id' => Role::ADMIN])->count();
    }

}
