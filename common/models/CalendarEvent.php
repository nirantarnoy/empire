<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "calendar_event".
 *
 * @property int $id
 * @property int $event_id
 * @property string $title
 * @property string $description
 * @property int $start_date
 * @property int $end_date
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class CalendarEvent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calendar_event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        [['event_id','title'],'required'],
            [['event_id', 'start_date', 'end_date', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title', 'description', 'note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'เหตุการณ์',
            'title' => 'ชื่อเรื่อง',
            'description' => 'รายละเอียด',
            'start_date' => 'จากวันที่',
            'end_date' => 'ถึงวันที่',
            'note' => 'บันทึก',
            'status' => 'สถานะ',
            'created_at' => 'สร้างเมื่อ',
            'updated_at' => 'แก้ไขเมื่อ',
            'created_by' => 'สร้างโดย',
            'updated_by' => 'แก้ไขโดย',
        ];
    }
}
