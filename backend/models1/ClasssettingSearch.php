<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ClassSetting;

/**
 * ClasssettingSearch represents the model behind the search form of `backend\models\ClassSetting`.
 */
class ClasssettingSearch extends ClassSetting
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'year', 'sort', 'type'], 'integer'],
            [['department', 'name', 'note'], 'safe'],
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
        $query = ClassSetting::find();

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
            'year' => $this->year,
            'sort' => $this->sort,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
