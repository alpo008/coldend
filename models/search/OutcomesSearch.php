<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Outcomes;

/**
 * OutcomesSearch represents the model behind the search form about `app\models\Outcomes`.
 */
class OutcomesSearch extends Outcomes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'materials_id', 'came_from', 'purpose'], 'integer'],
            [['qty'], 'number'],
            [['materials_id', 'came_to', 'responsible', 'trans_date', 'ref_doc', 'comment'], 'safe'],
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
        $query = Outcomes::find();

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
            'materials_id' => $this->materials_id,
            'qty' => $this->qty,
            'came_from' => $this->came_from,
            'came_to' => $this->came_to,
            'purpose' => $this->purpose,
        ]);

        $query->andFilterWhere(['like', 'responsible', $this->responsible])
            ->andFilterWhere(['like', 'ref_doc', $this->ref_doc])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'trans_date', $this->trans_date]);

        return $dataProvider;
    }
}
