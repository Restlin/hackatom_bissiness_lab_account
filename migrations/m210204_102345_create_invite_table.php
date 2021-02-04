<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%invite}}`.
 */
class m210204_102345_create_invite_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invite}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNUll()->comment('Проект'),
            'author_id' => $this->integer()->notNull()->comment('Автор'),
            'date' => $this->date()->notNull()->comment('Дата'),
            'comment' => $this->text()->null()->comment('Комментарий'),
        ]);

        $this->addForeignKey('fk_invite_project_id', 'invite', 'project_id', 'project', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_invite_project_id', 'invite', 'project_id');

        $this->addForeignKey('fk_invite_author_id', 'invite', 'author_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_invite_author_id', 'invite', 'author_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%invite}}');
    }
}
