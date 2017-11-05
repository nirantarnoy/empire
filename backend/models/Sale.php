<?php
namespace backend\models;
use yii\db\ActiveRecord;

date_default_timezone_set('Asia/Bangkok');
class Sale extends \common\models\Sale
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
 public static function getLastNo(){
    $model = Sale::find()->MAX('sale_no');
    if($model){
      $prefix = "SO".substr(date("Y"),2,2);
      $cnum = substr((string)$model,4,strlen($model));
      $len = strlen($cnum);
      $clen = strlen($cnum + 1);
      $loop = $len - $clen;
      for($i=1;$i<=$loop;$i++){
        $prefix.="0";
      }
      $prefix.=$cnum + 1;
      return $prefix;
    }else{
        $prefix ="SO".substr(date("Y"),2,2);
        return $prefix.'000001';
    }
}
  public static function getSaleAmt($m){
    $m = Sale::find()->where(['MONTH(FROM_UNIXTIME(sale_date))' => $m])->andFilterWhere(['YEAR(FROM_UNIXTIME(sale_date))' => 2017])->sum('sale_amount');
    return $m;
  }
}
