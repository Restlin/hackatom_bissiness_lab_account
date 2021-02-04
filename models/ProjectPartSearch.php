<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProjectPart;
use yii\data\Sort;

/**
 * ProjectPartSearch represents the model behind the search form of `app\models\ProjectPart`.
 */
class ProjectPartSearch extends ProjectPart
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'part_id'], 'integer'],
            [['ready'], 'boolean'],
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
        $query = ProjectPart::find();


        $sort = new Sort();
        $sort->defaultOrder = ['id' => SORT_ASC];

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'project_id' => $this->project_id,
            'part_id' => $this->part_id,
            'ready' => $this->ready,
        ]);

        return $dataProvider;
    }
}
