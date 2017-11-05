<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "view_trans".
 *
 * @property int $id
 * @property string $journal_no
 * @property int $transdate
 * @property int $trans_type_id
 * @property string $reference
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $product_id
 * @property string $product_code
 * @property string $name
 * @property double $qty
 * @property double $price
 * @property double $total
 * @property double $cost
 * @property double $sale_price_1
 * @property double $sale_price_2
 */
class ViewTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_trans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'transdate', 'trans_type_id', 'status', 'created_at', 'updated_at','invent_type','warehouse_id', 'created_by', 'updated_by', 'product_id'], 'integer'],
            [['qty', 'price', 'total', 'cost', 'sale_price_1', 'sale_price_2'], 'number'],
            [['journal_no', 'reference', 'product_code', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'journal_no' => 'เลขที่',
            'transdate' => 'วันที่',
            'trans_type_id' => 'ประเภท',
            'reference' => 'เลขที่อ้างอิง',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'product_id' => 'Product ID',
            'product_code' => 'รหัสสินค้า',
            'invent_type'=>'สถานะ',
            'name' => 'ชื่อสินค้า',
            'qty' => 'จำนวน',
            'price' => 'Price',
            'total' => 'Total',
            'cost' => 'Cost',
            'sale_price_1' => 'Sale Price 1',
            'sale_price_2' => 'Sale Price 2',
        ];
    }
}
