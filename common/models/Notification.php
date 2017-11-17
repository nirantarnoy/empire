<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notifiaction".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $files
 * @property string $url
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notifiaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['title', 'description', 'files', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'files' => 'Files',
            'url' => 'Url',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];
    }
}
