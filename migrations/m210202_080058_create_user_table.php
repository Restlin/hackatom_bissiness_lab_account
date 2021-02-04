<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210202_080058_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'surname' => $this->string(50)->notNull()->comment('Фамилия'),
            'name' => $this->string(50)->notNull()->comment('Имя'),
            'patronymic' => $this->string(50)->comment('Отчество'),
            'phone' => $this->string(20)->unique()->comment('Телефон'),
            'email' => $this->string(50)->notNull()->unique()->comment('Email'),
            'no_confirm_email' => $this->string(50)->comment('Не подтверждённый email'),
            'email_code' => $this->string(6)->null()->comment('Код подтверждения Email'),
            'email_code_unixtime' => $this->bigInteger()->null()->comment('Время генерации кода'),
            'password_hash' => $this->string(64)->comment('Хеш пароля'),
            'pwd_reset_token' => $this->string(32)->null()->comment('Токен для сброса пароля'),
            'pwd_reset_token_unixtime' => $this->bigInteger()->null()->comment('Время жизни токена сброса пароля'),
            'active' => $this->boolean()->notNull()->defaultValue(false)->comment('Активирован'),
            'firm' => $this->string(100)->null()->comment('Организация'),
            'about' => $this->text()->null()->comment('О себе'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
