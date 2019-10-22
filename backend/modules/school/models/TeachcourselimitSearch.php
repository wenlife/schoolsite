<?php

namespace backend\modules\school\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\school\models\TeachCourseLimit;

/**
 * TeachcourselimitSearch represents the model behind the search form of `backend\modules\school\models\TeachCourseLimit`.
 */
class TeachcourselimitSearch extends TeachCourseLimit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'department_id', 'course_limit'], 'integer'],
            [['course_id', 'note'], 'safe'],
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
        $query = TeachCourseLimit::find();

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
            'department_id' => $this->department_id,
            'course_limit' => $this->course_limit,
        ]);

        $query->andFilterWhere(['like', 'course_id', $this->course_id])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
