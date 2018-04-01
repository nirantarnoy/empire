<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "agent_price".
 *
 * @property int $id
 * @property int $agent_id
 * @property int $product_id
 * @property double $min
 * @property double $max
 * @property double $price
 * @property double $promotion_start_date
 * @property double $promotion_expire_date
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class AgentPrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agent_price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['agent_id','product_id'],'required'],
            [['agent_id', 'product_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['min', 'max', 'price', 'promotion_start_date', 'promotion_expire_date'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'agent_id' => 'ตัวแทน',
            'product_id' => 'รหัสสินค้า',
            'min' => 'ขั้นต่ำ',
            'max' => 'สูงสุด',
            'price' => 'ราคา',
            'promotion_start_date' => 'วันเริ่มโปรฯ',
            'promotion_expire_date' => 'วันสิ้นสุดโปรฯ',
            'status' => 'สถาณะ',
            'created_at' => 'สร้างเมื่อ',
            'updated_at' => 'แก้ไขเมื่อ',
            'created_by' => 'สร้างโดย',
            'updated_by' => 'แก้ไขโดย',
        ];
    }
}
