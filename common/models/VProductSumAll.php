<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_product_sum_all".
 *
 * @property int $id
 * @property string $product_code
 * @property string $name
 * @property double $cost
 * @property double $total_qty
 * @property double $total_amount
 */
class VProductSumAll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_product_sum_all';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['cost', 'total_qty', 'total_amount'], 'number'],
            [['product_code', 'name'], 'string', 'max' => 255],
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
            'cost' => 'Cost',
            'total_qty' => 'Total Qty',
            'total_amount' => 'Total Amount',
        ];
    }
}
