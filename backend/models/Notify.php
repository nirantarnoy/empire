<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\Task;
use common\models\Notification;
class Notify extends Model
{
	public static function showNotify(){
		$nextdate = date('d-m-Y');
		$model = Task::find()->where(['FROM_UNIXTIME(task_next_date,"%d-%m-%Y")'=>$nextdate])->one();
		if($model){
			$modelnoti = new Notification();
			$modelnoti->title = $model->name;
			$modelnoti->description = $model->description;
			$modelnoti->status = 1;
			$modelnoti->save(false);
		}else{
			//return "no";
		}
	}
	public static function getNotify(){
		$model = Notification::find()->where(['status'=>1])->all();
		return $model;
	}
}