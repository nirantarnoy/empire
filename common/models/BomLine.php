<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bom_line".
 *
 * @property int $id
 * @property int $bom_id
 * @property int $product_id
 * @property double $qty
 * @property double $price
 * @property double $total
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class BomLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bom_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bom_id','product_id'],'required'],
            [['bom_id', 'product_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
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
            'bom_id' => 'Bom',
            'product_id' => 'รหัสสินค้า',
            'qty' => 'จำนวน',
            'price' => 'ราคา',
            'total' => 'รวม',
            'status' => 'สถาณะ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
