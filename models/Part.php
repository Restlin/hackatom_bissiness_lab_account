<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "part".
 *
 * @property int $id
 * @property string $name Наименование
 * @property int $level Уровень
 * @property int $weight Значимость
 *
 * @property ProjectPart[] $projectParts
 */
class Part extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'part';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['level', 'weight'], 'default', 'value' => null],
            [['level', 'weight'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'level' => 'Уровень',
            'weight' => 'Значимость',
        ];
    }

    /**
     * Gets query for [[ProjectParts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectParts()
    {
        return $this->hasMany(ProjectPart::class, ['part_id' => 'id']);
    }
}
