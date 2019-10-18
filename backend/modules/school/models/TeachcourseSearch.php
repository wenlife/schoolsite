<?php

namespace backend\modules\school\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\school\models\TeachCourse;

/**
 * TeachcourseSearch represents the model behind the search form of `backend\modules\school\models\TeachCourse`.
 */
class TeachcourseSearch extends TeachCourse
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'year_id', 'class_id', 'day_time_id'], 'integer'],
           [['weekday', 'subject_id', 'subject2_id', 'note'], 'safe'],
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
        $query = TeachCourse::find();

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
            'class_id' => $this->class_id,
            'day_time_id' => $this->day_time_id,
            'subject_id' => $this->subject_id,
            'subject2_id' => $this->subject2_id,
        ]);

        $query->andFilterWhere(['like', 'weekday', $this->weekday])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
