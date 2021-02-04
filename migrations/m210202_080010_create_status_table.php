<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%status}}`.
 */
class m210202_080010_create_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Наименование'),
        ]);

        $this->batchInsert('{{%status}}', ['name'], [
            ['черновик'], //ничего никаких частей проекта
            ['идея'],   //заполняется 1 уровень
            ['концепция'], //заполнены части 1 - 2 уровень
            ['бизнес-проект'], //готов для рассмотрения инвестора
            ['релиз'], //после решения инвестора
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%status}}');
    }
}
