<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_purch_day_sum".
 *
 * @property string $purchase_date
 * @property double $purchase_amount
 * @property int $created_by
 */
class VPurchDaySum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_purch_day_sum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purchase_amount'], 'number'],
            [['created_by'], 'integer'],
            [['purchase_date'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'purchase_date' => 'Purchase Date',
            'purchase_amount' => 'Purchase Amount',
            'created_by' => 'Created By',
        ];
    }
}
