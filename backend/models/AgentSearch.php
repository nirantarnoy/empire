<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Agent;

/**
 * AgentSearch represents the model behind the search form of `backend\models\Agent`.
 */
class AgentSearch extends Agent
{
     public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'agent_group', 'start_date', 'expire_date', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['agent_code', 'name'], 'safe'],
            [['score', 'amount'], 'number'],
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
        $query = Agent::find();

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
            'agent_group' => $this->agent_group,
            'start_date' => $this->start_date,
            'expire_date' => $this->expire_date,
            'score' => $this->score,
            'amount' => $this->amount,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        // $query->andFilterWhere(['like', 'agent_code', $this->agent_code])
        //     ->andFilterWhere(['like', 'name', $this->name]);
        if($this->globalSearch!=''){
             $query->orFilterWhere(['like', 'agent_code', $this->globalSearch])
            ->orFilterWhere(['like', 'name', $this->globalSearch]);
        }

        return $dataProvider;
    }
}
