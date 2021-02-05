<?php

use yii\db\Migration;

/**
 * Class m210205_160520_create_photo_columns
 */
class m210205_160520_create_photo_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%project}}', 'image', $this->binary()->defaultValue(null));
        $this->addColumn('{{%user}}', 'image', $this->binary()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'image');
        $this->dropColumn('project', 'image');
    }
}
