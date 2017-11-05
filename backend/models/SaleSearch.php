<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sale;

/**
 * SaleSearch represents the model behind the search form of `backend\models\Sale`.
 */
class SaleSearch extends Sale
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sale_date', 'payment_type', 'require_ship_date', 'payment_status', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['sale_no', 'note'], 'safe'],
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
        $query = Sale::find();

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
            'sale_date' => $this->sale_date,
            'payment_type' => $this->payment_type,
            'require_ship_date' => $this->require_ship_date,
            'payment_status' => $this->payment_status,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        if($this->globalSearch != ''){
            $query->orFilterWhere(['like','sale_no',$this->globalSearch])
                  ->orFilterWhere(['like','note',$this->globalSearch])
                  ->orFilterWhere(['like','sale_date',$this->globalSearch]);
        }

        return $dataProvider;
    }
}
