<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SignSheet;

/**
 * SignsheetSearch represents the model behind the search form of `backend\models\SignSheet`.
 */
class SignsheetSearch extends SignSheet
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'old', 'verify'], 'integer'],
            [['name', 'gender', 'minzu', 'idcard', 'birth', 'graduate', 'cat1', 'cat2', 'cat3', 'photo', 'graduate_id', 'prizedetail', 'parentname', 'parentrelation', 'parentphone', 'payacount', 'paytime', 'note', 'signtime', 'verifyadmin', 'verifytime', 'verifymsg'], 'safe'],
            [['height', 'weight', 'score', 'yw', 'sx', 'yy', 'wl', 'hx', 'sw', 'zz', 'dl', 'ls', 'sy', 'ty'], 'number'],
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
        $query = SignSheet::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pagesize'=>20] 
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
            'old' => $this->old,
            'height' => $this->height,
            'weight' => $this->weight,
            'score' => $this->score,
            'yw' => $this->yw,
            'sx' => $this->sx,
            'yy' => $this->yy,
            'wl' => $this->wl,
            'hx' => $this->hx,
            'sw' => $this->sw,
            'zz' => $this->zz,
            'dl' => $this->dl,
            'ls' => $this->ls,
            'sy' => $this->sy,
            'ty' => $this->ty,
            'verify' => $this->verify,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'minzu', $this->minzu])
            ->andFilterWhere(['like', 'idcard', $this->idcard])
            ->andFilterWhere(['like', 'birth', $this->birth])
            ->andFilterWhere(['like', 'graduate', $this->graduate])
            ->andFilterWhere(['like', 'cat1', $this->cat1])
            ->andFilterWhere(['like', 'cat2', $this->cat2])
            ->andFilterWhere(['like', 'cat3', $this->cat3])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'graduate_id', $this->graduate_id])
            ->andFilterWhere(['like', 'prizedetail', $this->prizedetail])
            ->andFilterWhere(['like', 'parentname', $this->parentname])
            ->andFilterWhere(['like', 'parentrelation', $this->parentrelation])
            ->andFilterWhere(['like', 'parentphone', $this->parentphone])
            ->andFilterWhere(['like', 'payacount', $this->payacount])
            ->andFilterWhere(['like', 'paytime', $this->paytime])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'signtime', $this->signtime])
            ->andFilterWhere(['like', 'verifyadmin', $this->verifyadmin])
            ->andFilterWhere(['like', 'verifytime', $this->verifytime])
            ->andFilterWhere(['like', 'verifymsg', $this->verifymsg]);

        return $dataProvider;
    }
}
