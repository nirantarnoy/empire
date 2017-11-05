<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ผลิตภัณฑ์';
$this->params['breadcrumbs'][] = $this->title;

// $events = array();
//   //Testing
//   $Event = new \yii2fullcalendar\models\Event();
//   $Event->id = 1;
//   $Event->title = 'Testing';
//   $Event->start = date('Y-m-d\TH:i:s\Z');
//   // $event->nonstandard = [
//   //   'field1' => 'Something I want to be included in object #1',
//   //   'field2' => 'Something I want to be included in object #2',
//   // ];
//   $events[] = $Event;

//   $Event = new \yii2fullcalendar\models\Event();
//   $Event->id = 2;
//   $Event->title = 'Testing';
//   $Event->start = date('Y-m-d\TH:i:s\Z',strtotime('tomorrow 6am'));
//   $events[] = $Event;


//   echo \yii2fullcalendar\yii2fullcalendar::widget(array(
//       'events'=> $events,
//   ));

?>
<div class="product-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
           <div>
            <?= Html::a('<i class="fa fa-plus-circle"></i> สร้างผลิตภัณฑ์', ['create'], ['class' => 'btn btn-success']) ?>
            <div class="btn btn-default btn-import"><i class="fa fa-upload"></i> นำเข้าสินค้า</div>
            <div class="btn-group pull-right" style="bottom: 10px">
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
      </div>
      </div>
      </div>
      <div class="panel-body">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'product_code',
            'name',
            'description',
            //'photo',
              [
               'attribute'=>'category_id',
               'format' => 'html',
               'value'=>function($data){
                 return $data->category_id !=='' ? $data->category->name:'';
               }
             ],
            // 'weight',
            // 'unit_id',
            // 'price',
            // 'status',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

           [
               'attribute'=>'status',
               'format' => 'html',
               'value'=>function($data){
                 return $data->status === 1 ? '<div class="label label-success">Active</div>':'<div class="label label-default">Inactive</div>';
               }
             ],
            //'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            [
                        'label' => 'Action',
                        'format' => 'raw',
                        'value' => function($model){
                                return '
                                    <div class="btn-group" >
                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                                        <ul class="dropdown-menu" style="right: 0; left: auto;">
                                        <li><a href="'.Url::toRoute(['/product/view', 'id'=>$model->id]).'">'.'View'.'</a></li>
                                        <li><a href="'.Url::toRoute(['/product/update', 'id'=>$model->id]).'">'.'Update'.'</a></li>
                                        <li><a onclick="return confirm(\'Confirm ?\')" href="'.Url::to(['/product/delete', 'id'=>$model->id],true).'">Delete</a></li>
                                        </ul>
                                    </div>
                                ';
                            // }
                        },
                        'headerOptions'=>['class'=>'text-center'],
                        'contentOptions' => ['class'=>'text-center','style'=>'vertical-align: middle','text-align: center'],

                    ],
        ],
    ]); ?>
    </div>
  </div>
  </div>
  </div>
    <?php Pjax::end(); ?>
</div>
