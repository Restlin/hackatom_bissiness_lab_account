<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string|null $name Наименование
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * Черновик
     */
    public const DRAFT = 1;
    /**
     * Идея
     */
    public const IDEA = 2;
    /**
     * Концепция
     */
    public const CONCEPTION = 3;
    /**
     * Бизнес-проект
     */
    public const BUSINESS_PROJECT = 4;
    /**
     * Релиз
     */
    public const RELEASE = 5;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    public static function getList(): array {
        $models = self::find()->orderBy('id')->all();
        $list = [];
        foreach($models as $model) {
            $list[$model->id] = $model->name;
        }
        return $list;
    }
}
