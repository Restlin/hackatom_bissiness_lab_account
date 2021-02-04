<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project_part}}`.
 */
class m210202_075944_create_project_part_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project_part}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull()->comment('Проект'),
            'part_id' => $this->integer()->notNull()->comment('Раздел'),
            'ready' => $this->boolean()->notNull()->defaultValue(false)->comment('Готовность')

        ]);

        $this->addForeignKey('fk_project_part_project_id', 'project_part', 'project_id', 'project', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_project_part_project_id', 'project_part','project_id');

        $this->addForeignKey('fk_project_part_part_id', 'project_part', 'part_id', 'part', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_project_part_part_id', 'project_part', 'part_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project_part}}');
    }
}
