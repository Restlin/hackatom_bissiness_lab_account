<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%role}}`.
 */
class m210202_080141_create_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%role}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Наименование'),
        ]);

        $this->batchInsert('role', ['name'], [
            ['администратор'],
            ['стейкхолдер'],
            ['инициатор'],
            ['заказчик'],
            ['помощник'],
            ['куратор'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%role}}');
    }
}
