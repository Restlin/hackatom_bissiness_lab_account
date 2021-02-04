<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project_file}}`.
 */
class m210204_063906_create_project_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project_file}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer(),
        ]);

        $this->addForeignKey('fk_project_file_project_id', 'project_file', 'project_id', 'project', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_project_file_project_id', 'project_file', 'project_id');

        if (!file_exists('files')) {
            mkdir('files');
        }
        chmod('files', 0777);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project_file}}');
    }
}
