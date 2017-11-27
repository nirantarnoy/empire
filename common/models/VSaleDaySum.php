<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_sale_day_sum".
 *
 * @property string $sale_date
 * @property double $sale_amount
 * @property int $created_by
 */
class VSaleDaySum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_sale_day_sum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sale_amount'], 'number'],
            [['created_by'], 'integer'],
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
            'created_by' => 'Created By',
        ];
    }
}
