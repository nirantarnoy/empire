<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_sum_day_by_emp".
 *
 * @property string $transdate
 * @property int $created_by
 * @property string $first_name
 * @property string $last_name
 * @property string $market_name
 * @property double $amount
 * @property double $cost
 * @property string $expense_name_1
 * @property double $expense_amount_1
 * @property string $expense_name_2
 * @property double $expense_amount_2
 * @property string $expense_name_3
 * @property double $expense_amount_3
 * @property string $expense_name_4
 * @property double $expense_amount_4
 */
class VSumDayByEmp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_sum_day_by_emp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by'], 'integer'],
            [['amount', 'cost', 'expense_amount_1', 'expense_amount_2', 'expense_amount_3', 'expense_amount_4'], 'number'],
            [['transdate'], 'string', 'max' => 10],
            [['first_name', 'last_name', 'market_name', 'expense_name_1', 'expense_name_2', 'expense_name_3', 'expense_name_4'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'transdate' => 'Transdate',
            'created_by' => 'Created By',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'market_name' => 'Market Name',
            'amount' => 'Amount',
            'cost' => 'Cost',
            'expense_name_1' => 'Expense Name 1',
            'expense_amount_1' => 'Expense Amount 1',
            'expense_name_2' => 'Expense Name 2',
            'expense_amount_2' => 'Expense Amount 2',
            'expense_name_3' => 'Expense Name 3',
            'expense_amount_3' => 'Expense Amount 3',
            'expense_name_4' => 'Expense Name 4',
            'expense_amount_4' => 'Expense Amount 4',
        ];
    }
}
