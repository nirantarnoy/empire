<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_summary_day".
 *
 * @property string $sale_date
 * @property double $sale_amount
 * @property double $purchase_amount
 */
class VSummaryDay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_summary_day';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sale_amount', 'purchase_amount'], 'number'],
            [['sale_date'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sale_date' => 'Sale Date',
            'sale_amount' => 'Sale Amount',
            'purchase_amount' => 'Purchase Amount',
        ];
    }
}
