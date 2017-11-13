<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sale_line".
 *
 * @property int $id
 * @property int $sale_id
 * @property int $product_id
 * @property double $qty
 * @property double $price
 * @property double $disc_amount
 * @property double $disc_per
 * @property double $line_amount
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class SaleLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sale_id', 'product_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by','warehouse_id'], 'integer'],
            [['qty', 'price', 'disc_amount', 'disc_per', 'line_amount'], 'number'],
            [['note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sale_id' => 'เลขที่ใบสั่งซื้อ',
            'product_id' => 'รหัสสินค้า',
            'qty' => 'จำนวน',
            'price' => 'ราคา',
            'disc_amount' => 'ส่วนลดเงินสด',
            'disc_per' => 'ส่วนลด%',
            'line_amount' => 'รวม',
            'note' => 'ยันทึก',
            'status' => 'สถานะ',
            'created_at' => 'สร้างเมื่อ',
            'updated_at' => 'แก้ไขเมื่อ',
            'created_by' => 'สร้างโดย',
            'updated_by' => 'แก้ไขโดย',
        ];
    }
}
