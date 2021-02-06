<?php

use yii\db\Migration;

/**
 * Class m210206_095052_create_table_type
 */
class m210206_095052_create_table_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->comment('Наименование'),            
        ]);

        $this->batchInsert('{{%type}}',
            ['name'],
            [
                ['Информационные технологии'],
                ['Социальный'],
                ['Экологический'],
                ['Архитектурный'],
                ['Творческий'],
                ['Исследовательский'],
                ['Учебный'],                
            ]
        );        
        
        $this->addColumn('project', 'type_id', $this->smallInteger()->notNull()->defaultValue(1)->comment('Тип'));
        $this->addColumn('project', 'public', $this->boolean()->notNull()->defaultValue(true)->comment('Публичный'));
        
        $this->addForeignKey('fk_project_type_id', 'project', 'type_id', 'type', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_project_type_id', 'project','type_id');        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {              
        $this->dropColumn('project', 'type_id');
        $this->dropColumn('project', 'public');
        $this->dropTable('{{%type}}');
    }

}
