<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SignKszbm;

/**
 * SignkszbmSearch represents the model behind the search form of `backend\models\SignKszbm`.
 */
class SignkszbmSearch extends SignKszbm
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'if_pre_educate', 'if_sigle', 'if_alone', 'if_ls', 'if_live', 'if_cload', 'if_en', 'if_help', 'if_uniform', 'verify'], 'integer'],
            [['name', 'gender', 'birth_place', 'birth_date', 'origin_place', 'minzu', 'id_card', 'hukou_place', 'hukou_type', 'health', 'address', 'zk_exam_id', 'zk_school', 'party_type', 'speciality', 'dad_name', 'dad_nation', 'dad_hukou', 'dad_idcard', 'dad_phone', 'dad_company', 'dad_duty', 'mom_name', 'mom_nation', 'mom_hukou', 'mom_idcard', 'mom_phone', 'mom_company', 'mom_duty', 'create_time', 'update_time', 'verify_time', 'verify_admin', 'verify_msg', 'note'], 'safe'],
            [['height', 'zk_score'], 'number'],
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
        $query = SignKszbm::find();

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
            'height' => $this->height,
            'if_pre_educate' => $this->if_pre_educate,
            'if_sigle' => $this->if_sigle,
            'if_alone' => $this->if_alone,
            'if_ls' => $this->if_ls,
            'zk_score' => $this->zk_score,
            'if_live' => $this->if_live,
            'if_cload' => $this->if_cload,
            'if_en' => $this->if_en,
            'if_help' => $this->if_help,
            'if_uniform' => $this->if_uniform,
            'verify' => $this->verify,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'birth_place', $this->birth_place])
            ->andFilterWhere(['like', 'birth_date', $this->birth_date])
            ->andFilterWhere(['like', 'origin_place', $this->origin_place])
            ->andFilterWhere(['like', 'minzu', $this->minzu])
            ->andFilterWhere(['like', 'id_card', $this->id_card])
            ->andFilterWhere(['like', 'hukou_place', $this->hukou_place])
            ->andFilterWhere(['like', 'hukou_type', $this->hukou_type])
            ->andFilterWhere(['like', 'health', $this->health])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'zk_exam_id', $this->zk_exam_id])
            ->andFilterWhere(['like', 'zk_school', $this->zk_school])
            ->andFilterWhere(['like', 'party_type', $this->party_type])
            ->andFilterWhere(['like', 'speciality', $this->speciality])
            ->andFilterWhere(['like', 'dad_name', $this->dad_name])
            ->andFilterWhere(['like', 'dad_nation', $this->dad_nation])
            ->andFilterWhere(['like', 'dad_hukou', $this->dad_hukou])
            ->andFilterWhere(['like', 'dad_idcard', $this->dad_idcard])
            ->andFilterWhere(['like', 'dad_phone', $this->dad_phone])
            ->andFilterWhere(['like', 'dad_company', $this->dad_company])
            ->andFilterWhere(['like', 'dad_duty', $this->dad_duty])
            ->andFilterWhere(['like', 'mom_name', $this->mom_name])
            ->andFilterWhere(['like', 'mom_nation', $this->mom_nation])
            ->andFilterWhere(['like', 'mom_hukou', $this->mom_hukou])
            ->andFilterWhere(['like', 'mom_idcard', $this->mom_idcard])
            ->andFilterWhere(['like', 'mom_phone', $this->mom_phone])
            ->andFilterWhere(['like', 'mom_company', $this->mom_company])
            ->andFilterWhere(['like', 'mom_duty', $this->mom_duty])
            ->andFilterWhere(['like', 'create_time', $this->create_time])
            ->andFilterWhere(['like', 'update_time', $this->update_time])
            ->andFilterWhere(['like', 'verify_time', $this->verify_time])
            ->andFilterWhere(['like', 'verify_admin', $this->verify_admin])
            ->andFilterWhere(['like', 'verify_msg', $this->verify_msg])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
