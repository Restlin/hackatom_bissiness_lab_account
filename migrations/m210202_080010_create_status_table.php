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

        $this->addForeignKey('fk_project_status_id', 'project', 'status_id', 'status', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_project_status_id', 'project','status_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_project_status_id', 'project');
        $this->dropForeignKey('fk_project_status_id', 'project');
        $this->dropTable('{{%status}}');
    }
}
