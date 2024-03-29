<?php

namespace backend\modules\test\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\test\models\TestChapter;

/**
 * ChapterSearch represents the model behind the search form about `common\models\test\TestChapter`.
 */
class ChapterSearch extends TestChapter
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'grade', 'note'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = TestChapter::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'grade', $this->grade])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
