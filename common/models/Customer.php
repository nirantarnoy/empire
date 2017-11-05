<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $customer_type
 * @property string $mobile
 * @property string $phone
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        [['name'],'required'],
            [['customer_type', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'description', 'mobile', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อลูกค้า',
            'description' => 'รายละเอียด',
            'customer_type' => 'ประเภทลูกค้า',
            'mobile' => 'มือถือ',
            'phone' => 'เบอร์โทร',
            'status' => 'สถานะ',
            'created_at' => 'สร้างเมื่อ',
            'updated_at' => 'แก้ไขเมื่อ',
            'created_by' => 'สร้างโดย',
            'updated_by' => 'แก้ไขโดย',
        ];
    }
}
