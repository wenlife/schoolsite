<?php

namespace backend\modules\sys\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sys\models\SysSwitch;

/**
 * SysswitchSearch represents the model behind the search form of `backend\modules\sys\models\SysSwitch`.
 */
class SysswitchSearch extends SysSwitch
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'state'], 'integer'],
            [['name', 'start', 'end', 'note'], 'safe'],
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
        $query = SysSwitch::find();

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
            'state' => $this->state,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'start', $this->start])
            ->andFilterWhere(['like', 'end', $this->end])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
