<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_sum_expense_center".
 *
 * @property int $created_by
 * @property int $title_id
 * @property string $title_name
 * @property double $sum_amount
 * @property string $create_date
 * @property int $type_id
 */
class VSumExpenseCenter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_sum_expense_center';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by', 'title_id', 'type_id','unix_date'], 'integer'],
            [['sum_amount'], 'number'],
            [['title_name'], 'string', 'max' => 255],
            [['create_date'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'created_by' => 'Created By',
            'title_id' => 'Title ID',
            'title_name' => 'Title Name',
            'sum_amount' => 'Sum Amount',
            'create_date' => 'Create Date',
            'type_id' => 'Type ID',
        ];
    }
}
