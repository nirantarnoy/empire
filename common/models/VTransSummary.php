<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_trans_summary".
 *
 * @property string $sale_date
 * @property int $created_by
 * @property double $in_amount
 * @property double $out_amount
 * @property string $market_name
 * @property int $market_id
 */
class VTransSummary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_trans_summary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by', 'market_id'], 'integer'],
            [['in_amount', 'out_amount'], 'number'],
            [['sale_date'], 'string', 'max' => 10],
            [['market_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sale_date' => 'Sale Date',
            'created_by' => 'Created By',
            'in_amount' => 'In Amount',
            'out_amount' => 'Out Amount',
            'market_name' => 'Market Name',
            'market_id' => 'Market ID',
        ];
    }
}
