<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "issue_detail".
 *
 * @property int $id
 * @property int $issue_id
 * @property int $product_id
 * @property int $req_qty
 * @property int $pre_qty
 * @property int $issue_qty
 * @property double $price
 * @property double $line_amount
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class IssueDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'issue_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['issue_id'],'required'],
            [['issue_id', 'product_id', 'req_qty', 'pre_qty', 'issue_qty', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['price', 'line_amount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'issue_id' => 'เลขที่ใบเบิก',
            'product_id' => 'รหัสสินค้า',
            'req_qty' => 'จำนวนที่ต้องการ',
            'pre_qty' => 'จำนวนส่ง',
            'issue_qty' => 'จำนวนรับ',
            'price' => 'ราคา',
            'line_amount' => 'รวม',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
