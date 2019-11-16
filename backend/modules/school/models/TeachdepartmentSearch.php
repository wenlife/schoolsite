<?php

namespace backend\modules\school\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\school\models\TeachDepartment;

/**
 * TeachdepartmentSearch represents the model behind the search form of `backend\modules\school\models\TeachDepartment`.
 */
class TeachdepartmentSearch extends TeachDepartment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'year', 'manager', 'note'], 'safe'],
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
        $query = TeachDepartment::find();

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
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'manager', $this->manager])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
