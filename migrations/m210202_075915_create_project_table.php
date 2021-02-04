<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project}}`.
 */
class m210202_075915_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200)->unique()->notNull()->comment('Комментарий'),
            'status_id' => $this->smallInteger()->notNull()->comment('Статус'),
            'rating' => $this->smallInteger()->notNull()->defaultValue(0)->comment('Рейтинг'),
            'about' => $this->text()->null()->comment('Описание'),
            'finance' => $this->decimal(19, 2)->notNull()->defaultValue(0)->comment('Требуемые финансы'),
            'invested' => $this->boolean()->null()->comment('Поддержка инвесторами'),
            'date_start' => $this->date()->notNull()->comment('Дата начала'),
            'date_end' => $this->date()->notNull()->comment('Дата конца'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project}}');
    }
}
