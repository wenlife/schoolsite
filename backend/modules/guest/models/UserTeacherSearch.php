<?php

namespace backend\modules\guest\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\guest\models\UserTeacher;

/**
 * UserTeacherSearch represents the model behind the search form about `common\models\UserTeacher`.
 */
class UserTeacherSearch extends UserTeacher
{
    /**
     * @inheritdoc
     */
 public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'pinx','subject', 'type', 'graduate', 'note'], 'safe'],
            ['secode','string','max'=>5]
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
        $query = UserTeacher::find();

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

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'secode', $this->type])
            ->andFilterWhere(['like', 'graduate', $this->graduate])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
