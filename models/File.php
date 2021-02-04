<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property int $project_part_id Часть раздела
 * @property int $user_id Пользователь
 * @property string $name Наименование файла
 * @property string $mime MIME тип
 * @property bool|null $correct Файл коректен
 *
 * @property ProjectPart $projectPart
 * @property User $user
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_part_id', 'user_id', 'name', 'mime'], 'required'],
            [['project_part_id', 'user_id'], 'default', 'value' => null],
            [['project_part_id', 'user_id'], 'integer'],
            [['correct'], 'boolean'],
            [['name', 'mime'], 'string', 'max' => 255],
            [['project_part_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectPart::class, 'targetAttribute' => ['project_part_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_part_id' => 'Часть раздела',
            'user_id' => 'Пользователь',
            'name' => 'Наименование файла',
            'mime' => 'MIME тип',
            'correct' => 'Файл коректен',
        ];
    }

    /**
     * Gets query for [[ProjectPart]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectPart()
    {
        return $this->hasOne(ProjectPart::class, ['id' => 'project_part_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
