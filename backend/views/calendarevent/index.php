<?php
use yii\helpers\Url;

$this->title = 'ปฏิทิน';
?>
<div class="row">
  <div class="col-lg-6">
    <?php

         $events = array(); 
         if(count($model)>0){
            foreach($model as $value){
              $Event = new \yii2fullcalendar\models\Event();
              $Event->id = 1;
              $Event->title = $value->title;
              $Event->start = date('Y-m-d\TH:i:s\Z');
         
              $events[] = $Event;
            }
         }
          
          // //Testing
          // $Event = new \yii2fullcalendar\models\Event();
          // $Event->id = 1;
          // $Event->title = 'Testing';
          // $Event->start = date('Y-m-d\TH:i:s\Z');
          // // $event->nonstandard = [
          // //   'field1' => 'Something I want to be included in object #1',
          // //   'field2' => 'Something I want to be included in object #2',
          // // ];
          // $events[] = $Event;

          // $Event = new \yii2fullcalendar\models\Event();
          // $Event->id = 2;
          // $Event->title = 'Testing';
          // $Event->start = date('Y-m-d\TH:i:s\Z',strtotime('tomorrow 6am'));
          // $events[] = $Event;


          echo \yii2fullcalendar\yii2fullcalendar::widget(array(
             'options'=>[
                'lang' => 'th',
             ],
             'clientOptions' => [
                //... more options to be defined here!
               // 'eventLimit' => TRUE,
        //                'theme'=>true,
                'fixedWeekCount' => false,
                'dayClick'=> new \yii\web\JsExpression('function (cellInfo, jsEvent) {alert(cellInfo);}'),
              ],
             // 'events'=> $events,
              'ajaxEvents' => Url::to(['/calendarevent/jsoncalendar'])
          ));
    ?>
  </div>
</div>
