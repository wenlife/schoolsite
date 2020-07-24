<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SignBase;

/**
 * SignbaseSearch represents the model behind the search form of `backend\models\SignBase`.
 */
class SignbaseSearch extends SignBase
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'xb', 'flag'], 'integer'],
            [['kh', 'xm', 'byzx', 'bjdm', 'csny', 'lxdh', 'txdz', 'sfzh', 'lqxx', 'bmd', 'note'], 'safe'],
            [['yw', 'sx', 'wy', 'wl', 'hx', 'zz', 'ls', 'sw', 'dl', 'sy', 'ty', 'zf', 'lqzf'], 'number'],
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
        $query = SignBase::find();

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
            'xb' => $this->xb,
            'yw' => $this->yw,
            'sx' => $this->sx,
            'wy' => $this->wy,
            'wl' => $this->wl,
            'hx' => $this->hx,
            'zz' => $this->zz,
            'ls' => $this->ls,
            'sw' => $this->sw,
            'dl' => $this->dl,
            'sy' => $this->sy,
            'ty' => $this->ty,
            'zf' => $this->zf,
            'lqzf' => $this->lqzf,
            'flag' => $this->flag,
        ]);

        $query->andFilterWhere(['like', 'kh', $this->kh])
            ->andFilterWhere(['like', 'xm', $this->xm])
            ->andFilterWhere(['like', 'byzx', $this->byzx])
            ->andFilterWhere(['like', 'bjdm', $this->bjdm])
            ->andFilterWhere(['like', 'csny', $this->csny])
            ->andFilterWhere(['like', 'lxdh', $this->lxdh])
            ->andFilterWhere(['like', 'txdz', $this->txdz])
            ->andFilterWhere(['like', 'sfzh', $this->sfzh])
            ->andFilterWhere(['like', 'lqxx', $this->lqxx])
            ->andFilterWhere(['like', 'bmd', $this->bmd])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
