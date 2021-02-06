<?php

use yii\db\Migration;

/**
 * Class m210206_104302_create_part_comment
 */
class m210206_104302_create_part_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%project_part}}', 'comment', $this->text()->null()->comment('Комментарий'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%project_part}}', 'comment');
    }    
}
