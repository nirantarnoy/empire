<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bom_version".
 *
 * @property int $id
 * @property int $product_id
 * @property string $bom_name
 * @property string $description
 * @property double $cost
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class BomVersion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bom_version';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'],'required'],
            [['product_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['cost'], 'number'],
            [['bom_name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'รหัสสินค้า',
            'bom_name' => 'ชื่อ',
            'description' => 'รายละเอียด',
            'cost' => 'ราคา',
            'status' => 'สถาณะ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
