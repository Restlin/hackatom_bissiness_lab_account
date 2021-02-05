<?php

use yii\db\Migration;

/**
 * Class m210205_072033_change_project_part
 */
class m210205_072033_change_project_part extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%project_part}}', 'content', $this->text()->null()->comment('Содержание'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%project_part}}', 'content');
    }
}
