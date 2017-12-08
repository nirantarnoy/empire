<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_product_sum".
 *
 * @property int $id
 * @property string $product_code
 * @property string $name
 * @property string $price
 * @property double $cost
 * @property double $qty
 * @property int $warehouse_id
 * @property string $warhouse_name
 * @property int $warehouse_qty
 */
class VProductSum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_product_sum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'warehouse_id', 'warehouse_qty'], 'integer'],
            [['price', 'cost', 'qty'], 'number'],
            [['product_code', 'name', 'warhouse_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_code' => 'Product Code',
            'name' => 'Name',
            'price' => 'Price',
            'cost' => 'Cost',
            'qty' => 'Qty',
            'warehouse_id' => 'Warehouse ID',
            'warhouse_name' => 'Warhouse Name',
            'warehouse_qty' => 'Warehouse Qty',
        ];
    }
}
