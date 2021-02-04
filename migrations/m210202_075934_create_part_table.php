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
            'name' => $this->string(50)->notNull()->comment('Наименование'),
            'level' => $this->smallInteger()->notNull()->comment('Уровень')->defaultValue(1),
            'weight' => $this->smallInteger()->notNull()->comment('Значимость')->defaultValue(1),
        ]);

        $this->batchInsert('{{%part}}',
            ['name', 'level', 'weight'],
            [
                ['актуальный статус продукта', 1, 3],
                ['определение продукта', 1, 3],
                ['технологии', 1, 1],
                ['ключевые потребители', 2, 1],
                ['конкурентные преимущества', 2, 1],
                ['планы', 2, 1],
                ['команда проекта', 2, 1],
                ['необходимые ресурсы', 2, 1],
                ['презентация', 3, 3],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%part}}');
    }
}
