<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_minstock".
 *
 * @property int $id
 * @property int $product_id
 * @property int $warehouse_id
 * @property double $minstock
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class ProductMinstock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_minstock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'warehouse_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['minstock'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'รหัสสินค้า',
            'warehouse_id' => 'คลังสินค้า',
            'minstock' => 'ขั้นต่ำ',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
