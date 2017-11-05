<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_model".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $brand_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class ProductModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','brand_id'],'required'],
            [['brand_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'รุ่น',
            'description' => 'รายละเอียด',
            'brand_id' => 'ยี่ห้อ',
            'status' => 'สถานะ',
            'created_at' => 'สร้างเมื่อ',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
