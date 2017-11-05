<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "view_balance_amount".
 *
 * @property int $id
 * @property string $product_code
 * @property string $name
 * @property string $description
 * @property string $price
 * @property string $qty
 * @property string $balance_amount
 */
class ViewBalanceAmount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_balance_amount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['price', 'qty', 'balance_amount'], 'number'],
            [['product_code', 'name', 'description'], 'string', 'max' => 255],
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
            'description' => 'Description',
            'price' => 'Price',
            'qty' => 'Qty',
            'balance_amount' => 'Balance Amount',
        ];
    }
}
