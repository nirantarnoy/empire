<?php
namespace backend\models;
use yii\db\ActiveRecord;
date_default_timezone_set('Asia/Bangkok');

class Bom extends \common\models\BomVersion
{
  public function behaviors()
{
    return [
        'timestampcdate'=>[
            'class'=> \yii\behaviors\AttributeBehavior::className(),
            'attributes'=>[
            ActiveRecord::EVENT_BEFORE_INSERT=>'created_at',
            ],
            'value'=> time(),
        ],
        'timestampudate'=>[
            'class'=> \yii\behaviors\AttributeBehavior::className(),
            'attributes'=>[
            ActiveRecord::EVENT_BEFORE_INSERT=>'updated_at',
            ],
          'value'=> time(),
        ],
        'timestampupdate'=>[
            'class'=> \yii\behaviors\AttributeBehavior::className(),
            'attributes'=>[
            ActiveRecord::EVENT_BEFORE_UPDATE=>'updated_at',
            ],
            'value'=> time(),
        ],
    ];
 }
  public function getBomname($id){
     $model = Agent::find()->where(['id'=>$id])->one();
      return count($model)>0?$model->name:'';
  }
}
