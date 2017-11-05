<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "journal".
 *
 * @property int $id
 * @property string $journal_no
 * @property int $transdate
 * @property int $trans_type_id
 * @property string $reference
 * @property string $remark
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Journal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transdate', 'trans_type_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['journal_no', 'reference', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'journal_no' => 'Journal No',
            'transdate' => 'Transdate',
            'trans_type_id' => 'Trans Type ID',
            'reference' => 'Reference',
            'remark' => 'Remark',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
