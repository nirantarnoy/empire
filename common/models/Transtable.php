<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transtable".
 *
 * @property int $id
 * @property string $transno
 * @property int $trans_type
 * @property int $transdate
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Transtable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transtable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        [['transno'],'required'],
            [['trans_type', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['transno'], 'string', 'max' => 255],
            [[ 'transdate'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transno' => 'เลขที่',
            'trans_type' => 'ประเภท',
            'transdate' => 'วันที่',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
