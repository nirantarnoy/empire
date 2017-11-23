<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VSummaryDay;

/**
 * AddressSearch represents the model behind the search form of `backend\models\Address`.
 */
class SummarydaySearch extends VSummaryDay
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by',], 'integer'],
            [['sale_amount','purchase_amount'],'number'],
            [['sale_date'], 'safe'],
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
        $query = VSummaryDay::find();

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
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'party_id' => $this->party_id,
        //     'party_type_id' => $this->party_type_id,
        //     'address_type_id' => $this->address_type_id,
        //     'zipcode' => $this->zipcode,
        //     'province' => $this->province,
        //     'status' => $this->status,
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at,
        //     'created_by' => $this->created_by,
        //     'updated_by' => $this->updated_by,
        // ]);

        //$query->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
