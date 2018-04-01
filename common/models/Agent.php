<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "agent".
 *
 * @property int $id
 * @property string $agent_code
 * @property string $name
 * @property int $agent_group
 * @property int $start_date
 * @property int $expire_date
 * @property double $score
 * @property double $amount
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Agent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['agent_group','name'],'required'],
            [['agent_group',  'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['score', 'amount'], 'number'],
            [['start_date', 'expire_date'],'safe'],
            [['agent_code', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'agent_code' => 'รหัสตัวแทน',
            'name' => 'ชื่อตัวแทน',
            'agent_group' => 'กลุ่มตัวแทน',
            'start_date' => 'วันเริ่ม',
            'expire_date' => 'วันหมดอายุ',
            'score' => 'คะแนน',
            'amount' => 'จำนวนเงิน',
            'status' => 'สถาณะ',
            'created_at' => 'สร้างเมื่อ',
            'updated_at' => 'แก้ไขเมื่อ',
            'created_by' => 'สร้างโดย',
            'updated_by' => 'แก้ไขโดย',
        ];
    }
}
