<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name Комментарий
 * @property int $status Статус
 * @property int $rating Рейтинг
 * @property string|null $about Описание
 * @property float $finance Требуемые финансы
 * @property bool|null $invested Поддержка инвесторами
 * @property string $date_start Дата начала
 * @property string $date_end Дата конца
 *
 * @property Invite[] $invites
 * @property ProjectAccess[] $projectAccesses
 * @property ProjectPart[] $projectParts
 * @property ProjectRate[] $projectRates
 * @property Request[] $requests
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status', 'date_start', 'date_end'], 'required'],
            [['status', 'rating'], 'default', 'value' => null],
            [['status', 'rating'], 'integer'],
            [['about'], 'string'],
            [['finance'], 'number'],
            [['invested'], 'boolean'],
            [['date_start', 'date_end'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Комментарий',
            'status' => 'Статус',
            'rating' => 'Рейтинг',
            'about' => 'Описание',
            'finance' => 'Требуемые финансы',
            'invested' => 'Поддержка инвесторами',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата конца',
        ];
    }

    /**
     * Gets query for [[Invites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvites()
    {
        return $this->hasMany(Invite::class, ['project_id' => 'id']);
    }

    /**
     * Gets query for [[ProjectAccesses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectAccesses()
    {
        return $this->hasMany(ProjectAccess::class, ['project_id' => 'id']);
    }

    /**
     * Gets query for [[ProjectParts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectParts()
    {
        return $this->hasMany(ProjectPart::class, ['project_id' => 'id']);
    }

    /**
     * Gets query for [[ProjectRates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectRates()
    {
        return $this->hasMany(ProjectRate::class, ['project_id' => 'id']);
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['project_id' => 'id']);
    }
}
