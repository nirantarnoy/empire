<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sale".
 *
 * @property int $id
 * @property string $sale_no
 * @property int $sale_date
 * @property int $payment_type
 * @property int $require_ship_date
 * @property string $note
 * @property int $payment_status
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Sale extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        [['sale_no','customer_id'],'required'],
            [['payment_type', 'require_ship_date', 'payment_status', 'status', 'updated_at', 'created_by', 'updated_by','customer_id'], 'integer'],
            [['sale_no', 'note'], 'string', 'max' => 255],
            [['discount','discount_per','sale_amount'],'number'],
            [['sale_date', 'created_at' ],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sale_no' => 'เลขที่ใบสั่งซื้อ',
            'sale_date' => 'วันที่สั่งซื้อ',
            'payment_type' => 'วิธีชำระเงิน',
            'require_ship_date' => 'วันที่ต้องการสินค้า',
            'note' => 'หมายเหตุ',
            'payment_status' => 'สถานะชำระเงิน',
            'status' => 'สถานะ',
            'customer_id' =>'ลูกค้า',
            'discount'=>'ส่วนลดเงินสด',
            'discount_per'=>'ส่วนลด%',
            'sale_amount'=>'ยอดรวม',
            'created_at' => 'สร้างเมื่อ',
            'updated_at' => 'แก้ไขเมื่อ',
            'created_by' => 'สร้างโดย',
            'updated_by' => 'แก้ไขโดย',
        ];
    }
}
