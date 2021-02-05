<?php

use yii\db\Migration;

/**
 * Class m210205_132500_change_project_rate
 */
class m210205_132500_change_project_rate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%project_rate}}', 'rate', $this->float()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%project_rate}}', 'rate', $this->smallInteger()->notNull());
    }
}
