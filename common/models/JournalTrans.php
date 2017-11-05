<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "journal_trans".
 *
 * @property int $id
 * @property int $journal_id
 * @property int $product_id
 * @property double $qty
 * @property double $price
 * @property double $total
 * @property int $invent_type
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class JournalTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal_trans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['journal_id', 'product_id','warehouse_id', 'invent_type', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['qty', 'price', 'total'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'journal_id' => 'เลขที่',
            'product_id' => 'รหัสสินค้า',
            'qty' => 'จำนวน',
            'price' => 'ราคา',
            'total' => 'รวม',
            'invent_type' => 'ประเภท',
            'status' => 'สถานะ',
            'warehouse_id'=>'คลังสินค้า',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
