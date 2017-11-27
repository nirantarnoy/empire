<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_expense_day_sum".
 *
 * @property string $expense_date
 * @property double $amount
 * @property int $created_by
 */
class VExpenseDaySum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_expense_day_sum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount'], 'number'],
            [['created_by'], 'integer'],
            [['expense_date'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'expense_date' => 'Expense Date',
            'amount' => 'Amount',
            'created_by' => 'Created By',
        ];
    }
}
