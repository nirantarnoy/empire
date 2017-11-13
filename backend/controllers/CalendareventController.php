<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;

class CalendareventController extends Controller
{
	public function actionIndex()
    {
    	$model = \backend\models\Calendarevent::find()->all();
		return $this->render('index',['model'=>$model]);
	}
	public function actionJsoncalendar($start=NULL,$end=NULL,$_=NULL){

    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $times = \backend\models\Calendarevent::find()->all();

    $events = [];

    foreach ($times AS $time){
      //Testing
      $Event = new \yii2fullcalendar\models\Event();
      $Event->id = $time->id;
      $Event->title = $time->title;
      $Event->start = date('Y-m-d\TH:i:s\Z',$time->start_date);
      $Event->end = date('Y-m-d\TH:i:s\Z',$time->end_date);
      $events[] = $Event;
    }

    return $events;
  }
}