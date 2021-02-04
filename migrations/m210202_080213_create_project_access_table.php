<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project_access}}`.
 */
class m210202_080213_create_project_access_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project_access}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNUll()->comment('Проект'),
            'user_id' => $this->integer()->notNull()->comment('Пользователь'),
            'role_id' => $this->integer()->notNull()->comment('Роль'),
        ]);

        $this->addForeignKey('fk_project_access_project_id', 'project_access', 'project_id', 'project', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_project_access_project_id', 'project_access','project_id');

        $this->addForeignKey('fk_project_access_user_id', 'project_access', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_project_access_user_id', 'project_access', 'user_id');

        $this->addForeignKey('fk_project_access_role_id', 'project_access', 'role_id', 'role', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_project_access_role_id', 'project_access', 'role_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project_access}}');
    }
}
