<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Machines;

/**
 * MachinesSearch represents the model behind the search form about `app\models\Machines`.
 */
class MachinesSearch extends Machines
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'to_replace', 'to_order'], 'integer'],
            [['name', 'place', 'to_do', 'unit_01', 'unit_02', 'unit_03', 'unit_04', 'unit_05', 'unit_06', 'unit_07', 'unit_08', 'unit_09', 'unit_10', 'unit_11', 'unit_12', 'comment'], 'safe'],
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
        $query = Machines::find();

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
            'status' => $this->status,
            'to_replace' => $this->to_replace,
            'to_order' => $this->to_order,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'to_do', $this->to_do])
            ->andFilterWhere(['like', 'unit_01', $this->unit_01])
            ->andFilterWhere(['like', 'unit_02', $this->unit_02])
            ->andFilterWhere(['like', 'unit_03', $this->unit_03])
            ->andFilterWhere(['like', 'unit_04', $this->unit_04])
            ->andFilterWhere(['like', 'unit_05', $this->unit_05])
            ->andFilterWhere(['like', 'unit_06', $this->unit_06])
            ->andFilterWhere(['like', 'unit_07', $this->unit_07])
            ->andFilterWhere(['like', 'unit_08', $this->unit_08])
            ->andFilterWhere(['like', 'unit_09', $this->unit_09])
            ->andFilterWhere(['like', 'unit_10', $this->unit_10])
            ->andFilterWhere(['like', 'unit_11', $this->unit_11])
            ->andFilterWhere(['like', 'unit_12', $this->unit_12])
            ->andFilterWhere(['like', 'unit_13', $this->unit_13])
            ->andFilterWhere(['like', 'unit_14', $this->unit_14])
            ->andFilterWhere(['like', 'unit_15', $this->unit_15])
            ->andFilterWhere(['like', 'unit_16', $this->unit_16])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
