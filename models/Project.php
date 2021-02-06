<?php

namespace app\models;

use Yii;
use app\services\ProjectService;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name Комментарий
 * @property int $status_id Статус
 * @property int $type_id Тип
 * @property bool|null $public Публичный
 * @property int $rating Рейтинг
 * @property string|null $about Описание
 * @property float $finance Требуемые финансы
 * @property bool|null $invested Поддержка инвесторами
 * @property string $date_start Дата начала
 * @property string $date_end Дата конца
 * @property string|null $image
 *
 * @property Status $status статус
 * @property Type $type тип
 * @property Invite[] $invites
 * @property ProjectAccess[] $projectAccesses
 * @property ProjectPart[] $projectParts
 * @property ProjectRate[] $projectRates
 * @property Request[] $requests
 * @property User $iniciator
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
            [['name', 'status_id', 'date_start', 'date_end'], 'required'],
            [['status_id', 'rating'], 'default', 'value' => null],
            [['status_id', 'rating', 'type_id'], 'integer'],
            [['type_id'], 'default', 'value' => 1],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::class, 'targetAttribute' => ['type_id' => 'id']],
            [['about'], 'string'],
            [['finance'], 'number'],
            [['invested', 'public'], 'boolean'],
            [['date_start', 'date_end'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['name'], 'unique'],
            [['image'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            'name' => 'Наименование',
            'status_id' => 'Статус',
            'type_id' => 'Тип',
            'public' => 'Публичный',
            'rating' => 'Рейтинг развития',
            'about' => 'Аннотация',
            'finance' => 'Требуемые финансы',
            'invested' => 'Поддержать инвестициями',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата конца',
            'image' => 'Аватар',
        ];
    }

    public function afterSave($insert, $changedAttributes) {
        if($insert && !Yii::$app->user->isGuest) {
            ProjectService::createAuthorAccess($this, Yii::$app->user->getIdentity()->getUser());
            ProjectService::createDefaultParts($this);
        }        
        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus() {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }
    
    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType() {
        return $this->hasOne(Type::class, ['id' => 'type_id']);
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
        return $this->hasMany(ProjectAccess::class, ['project_id' => 'id'])->orderBy('id');
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

    public function getIniciator()
    {
        return ProjectAccess::findOne(['project_id' => $this->id, 'role_id' => Role::INICIATOR])->user;
    }
}
