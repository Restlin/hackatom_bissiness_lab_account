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
            'project_id' => $this->integer(),
            'access_code' => $this->integer(),
        ]);

        $this->addForeignKey('fk_project_access_project_id', 'project_access', 'project_id', 'project', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_project_access_project_id', 'project_access','project_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project_access}}');
    }
}
