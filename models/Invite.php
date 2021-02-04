<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invite".
 *
 * @property int $id
 * @property int $project_id Проект
 * @property int $author_id Автор
 * @property string $date Дата
 * @property string|null $comment Комментарий
 *
 * @property Project $project
 * @property User $author
 */
class Invite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'author_id', 'date'], 'required'],
            [['project_id', 'author_id'], 'default', 'value' => null],
            [['project_id', 'author_id'], 'integer'],
            [['date'], 'safe'],
            [['comment'], 'string'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
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
            'author_id' => 'Автор',
            'date' => 'Дата',
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
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }
}
