<?php

namespace backend\models;

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
           [['sale_amount', 'purchase_amount','expense_amount'], 'number'],
            [['created_by'],'integer'],
            [['created_at'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
             'created_at' => 'Sale Date',
            'sale_amount' => 'Sale Amount',
            'expense_amount' => 'Expense Amount',
            'purchase_amount' => 'Purchase Amount',
        ];
    }
}
