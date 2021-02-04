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
                ['Актуальный статус продукта', 1, 3],
                ['Определение продукта', 1, 3],
                ['Технологии', 1, 1],
                ['Ключевые потребители', 2, 1],
                ['Конкурентные преимущества', 2, 1],
                ['Планы', 2, 1],
                ['Команда проекта', 2, 1],
                ['Необходимые ресурсы', 2, 1],
                ['Презентация', 3, 3],
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
