<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "issue_table".
 *
 * @property int $id
 * @property string $issue_no
 * @property int $request_by
 * @property int $require_date
 * @property string $description
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class IssueTable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'issue_table';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['issue_no'],'required'],
            [['request_by', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [[ 'require_date'],'safe'],
            [['issue_no', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'issue_no' => 'เลขที่ใบเบิก',
            'request_by' => 'ผู้เบิก',
            'require_date' => 'วันที่ต้องการ',
            'description' => 'รายละเอียด',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
