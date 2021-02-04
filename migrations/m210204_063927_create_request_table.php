<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request}}`.
 */
class m210204_063927_create_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        $this->addForeignKey('fk_request_project_id', 'request', 'project_id', 'project', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_request_project_id', 'request', 'project_id');

        $this->addForeignKey('fk_request_user_id', 'request', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_request_user_id', 'request', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request}}');
    }
}
