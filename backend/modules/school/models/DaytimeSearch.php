<?php

namespace backend\modules\school\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\school\models\TeachDaytime;

/**
 * DaytimeSearch represents the model behind the search form of `backend\modules\school\models\TeachDaytime`.
 */
class DaytimeSearch extends TeachDaytime
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'department', 'sort'], 'integer'],
            [['part', 'title', 'start', 'end', 'note'], 'safe'],
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
        $query = TeachDaytime::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'department' => $this->department,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'part', $this->part])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'start', $this->start])
            ->andFilterWhere(['like', 'end', $this->end])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
