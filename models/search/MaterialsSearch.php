<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Materials;

/**
 * MaterialsSearch represents the model behind the search form about `app\models\Materials`.
 */
class MaterialsSearch extends Materials
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sap', 'unit'], 'integer'],
            [['at_stock', 'at_dept', 'minqty'], 'integer'],
            [['name', 'model_ref', 'trade_mark', 'manufacturer', 'generic_usage', 'function', 'type', 'analog', 'comment_1', 'comment_2'], 'safe'],
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
        $query = Materials::find();

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
            'sap' => $this->sap,
            'analog' => $this->analog,
            'minqty' => $this->minqty,
            'at_stock' => $this->at_stock,
            'at_dept' => $this->at_dept,
            'unit' => $this->unit,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'model_ref', $this->model_ref])
            ->andFilterWhere(['like', 'trade_mark', $this->trade_mark])
            ->andFilterWhere(['like', 'manufacturer', $this->manufacturer])
            ->andFilterWhere(['like', 'generic_usage', $this->generic_usage])
            ->andFilterWhere(['like', 'function', $this->function])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'comment_1', $this->comment_1])
            ->andFilterWhere(['like', 'comment_2', $this->comment_2])
            ->orderBy('at_stock DESC');

        return $dataProvider;
    }
}
