<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project_rate}}`.
 */
class m210202_080237_create_project_rate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project_rate}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull()->comment('Проект'),
            'user_id' => $this->integer()->notNull()->comment('Пользователь'),
            'rate' => $this->smallInteger()->notNull(),
            'comment' => $this->text()->null()->comment('Комментарий'),
        ]);

        $this->addForeignKey('fk_project_rate_project_id', 'project_rate', 'project_id', 'project', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_project_rate_project_id', 'project_rate', 'project_id');

        $this->addForeignKey('fk_project_rate_user_id', 'project_rate', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_project_rate_user_id', 'project_rate', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project_rate}}');
    }
}
