<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_rate".
 *
 * @property int $id
 * @property int $project_id Проект
 * @property int $user_id Пользователь
 * @property int $rate
 * @property string|null $comment Комментарий
 *
 * @property Project $project
 * @property User $user
 */
class ProjectRate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_rate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'user_id', 'rate'], 'required'],
            [['project_id', 'user_id', 'rate'], 'default', 'value' => null],
            [['project_id', 'user_id', 'rate'], 'integer'],
            [['comment'], 'string'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
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
            'project_id' => 'Проект',
            'user_id' => 'Пользователь',
            'rate' => 'Rate',
            'comment' => 'Комментарий',
        ];
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
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
