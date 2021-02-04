<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%part}}`.
 */
class m210202_075934_create_part_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%part}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%part}}');
    }
}
