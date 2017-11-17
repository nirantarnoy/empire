<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $task_interval
 * @property int $task_start_date
 * @property int $task_next_date
 * @property int $task_last_date
 * @property int $emp_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        [['name'],'required'],
            [['task_interval',  'emp_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['task_start_date', 'task_next_date', 'task_last_date'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'เรื่อง',
            'description' => 'รายละอียด',
            'task_interval' => 'ความถี่',
            'task_start_date' => 'เริ่มวันที่',
            'task_next_date' => 'ครั้งถัดไป',
            'task_last_date' => 'วันที่ล่าสุด',
            'emp_id' => 'แจ้งเตือนไปยัง',
            'status' => 'สถานะ',
            'created_at' => 'สร้าง',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
