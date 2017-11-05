<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "view_best_saller".
 *
 * @property int $product_id
 * @property string $product_code
 * @property string $name
 * @property double $line_amount
 * @property double $sale_qty
 * @property double $price
 * @property int $created_at
 */
class ViewBestSaller extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_best_saller';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'created_at'], 'integer'],
            [['line_amount', 'sale_qty', 'price'], 'number'],
            [['product_code', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'product_code' => 'Product Code',
            'name' => 'Name',
            'line_amount' => 'Line Amount',
            'sale_qty' => 'Sale Qty',
            'price' => 'Price',
            'created_at' => 'Created At',
        ];
    }
}
