<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Project;
use app\models\ProjectAccess;
use yii\data\Sort;

/**
 * ProjectSearch represents the model behind the search form of `app\models\Project`.
 */
class ProjectSearch extends Project
{
    public $userId = null;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status_id', 'type_id', 'rating'], 'integer'],
            [['name', 'about', 'date_start', 'date_end'], 'safe'],
            [['finance'], 'number'],
            [['invested', 'public'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Project::find();

        $sort = new Sort();
        $sort->defaultOrder = ['id' => SORT_DESC, 'rating' => SORT_DESC];

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        if($this->userId) {
            
        }
        if($this->public && $this->userId) {
            $ids = ProjectAccess::find()->where(['user_id' => $this->userId])->select(['project_id'])->column();
            $query->andWhere(['AND', ['public' => true] , ['in', 'id', $ids]]);
        } elseif($this->public) {
            $query->andWhere(['public' => true]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status_id' => $this->status_id,
            'type_id' => $this->type_id,            
            'rating' => $this->rating,
            'finance' => $this->finance,            
            'invested' => $this->invested,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'about', $this->about]);

        return $dataProvider;
    }
}
