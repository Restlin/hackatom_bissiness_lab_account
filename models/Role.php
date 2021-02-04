<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property int $id
 * @property string|null $name Наименование
 *
 * @property ProjectAccess[] $projectAccesses
 * @property UserRole[] $userRoles
 */
class Role extends \yii\db\ActiveRecord
{
    public const ADMIN = 1;
    public const STAKEHOLDER = 2;
    public const INICIATOR = 3;
    public const CUSTOMER = 4;
    public const ASSISTANT = 5;
    public const CURATOR = 6;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
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

    /**
     * Gets query for [[ProjectAccesses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectAccesses()
    {
        return $this->hasMany(ProjectAccess::class, ['role_id' => 'id']);
    }

    /**
     * Gets query for [[UserRoles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserRoles()
    {
        return $this->hasMany(UserRole::class, ['role_id' => 'id']);
    }
}
