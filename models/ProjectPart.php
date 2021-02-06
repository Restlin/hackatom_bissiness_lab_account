<?php

namespace app\models;

use Yii;
use app\services\ProjectService;

/**
 * This is the model class for table "project_part".
 *
 * @property int $id
 * @property int $project_id Проект
 * @property int $part_id Раздел
 * @property string $content Контент
 * @property string $comment Комментарий
 * @property bool $ready Готовность
 *
 * @property File[] $files
 * @property Part $part
 * @property Project $project
 */
class ProjectPart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_part';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'part_id'], 'required'],
            [['project_id', 'part_id'], 'default', 'value' => null],
            [['project_id', 'part_id'], 'integer'],
            [['ready'], 'boolean'],
            [['content', 'comment'], 'string'],
            [['part_id'], 'exist', 'skipOnError' => true, 'targetClass' => Part::class, 'targetAttribute' => ['part_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    public function afterSave($insert, $changedAttributes) {
        ProjectService::recalcProject($this->project);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'project_id' => 'Проект',
            'part_id' => 'Раздел',
            'content' => 'Содержание',
            'comment' => 'Комментарий куратора',
            'ready' => 'Готовность',
        ];
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::class, ['project_part_id' => 'id']);
    }

    /**
     * Gets query for [[Part]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPart()
    {
        return $this->hasOne(Part::class, ['id' => 'part_id']);
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
}
