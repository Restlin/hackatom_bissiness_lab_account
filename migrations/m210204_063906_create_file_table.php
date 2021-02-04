<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project_file}}`.
 */
class m210204_063906_create_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%file}}', [
            'id' => $this->primaryKey(),
            'project_part_id' => $this->integer()->notNull()->comment('Часть раздела'),
            'user_id' => $this->integer()->notNull()->comment('Пользователь'),
            'name' => $this->string()->notNull()->comment('Наименование файла'),
            'mime' => $this->string()->notNull()->comment('MIME тип'),
            'correct' => $this->boolean()->null()->comment('Файл коректен'),
        ]);

        $this->addForeignKey('fk_file_project_part_id', 'file', 'project_part_id', 'project_part', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_file_project_part_id', 'file', 'project_part_id');

        $this->addForeignKey('fk_file_user_id', 'file', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_file_user_id', 'file', 'user_id');


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
        $this->dropTable('{{%file}}');
    }
}
