<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Stockbalance;

/**
 * StockbalanceSearch represents the model behind the search form of `backend\models\Stockbalance`.
 */
class StockbalanceSearch extends Stockbalance
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'qty', 'warehouse_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['globalSearch'],'string'],
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
        $query = Stockbalance::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $query->joinWith('productinfo');
        $query->joinWith('warehouseinfo');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
            'qty' => $this->qty,
            'warehouse_id' => $this->warehouse_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

         $query->orFilterWhere(['like', 'product_id', $this->globalSearch])
            ->orFilterWhere(['like', 'warehouse_id', $this->globalSearch])
            ->orFilterWhere(['like', 'warehouse.name', $this->globalSearch])
            ->orFilterWhere(['like', 'product.product_code', $this->globalSearch]);
        return $dataProvider;
    }
}
