<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use backend\assets\ICheckAsset;

ICheckAsset::register($this);
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

$cat = \backend\models\Category::find()->all();
$name = $name_search;
$cats = $cat_search;
$cost_s = $cost_start;
$cost_e = $cost_end;

$use_advance = 0;


if($name !='' || $cats !='' || $cost_s !='' || $cost_e !='' ){
  $use_advance = 1;
}

$this->registerJsFile(
    '@web/js/stockbalancejs.js?V=001',
    ['depends' => [\yii\web\JqueryAsset::className()]],
    static::POS_END
);
?>
<div class="product-index">
  <input type="hidden" name="listid" class="listid" value="">
   <div class="row">
    <div class="col-lg-12">
      <?php
      $session = Yii::$app->session;
       if(!empty($session->getFlash("success"))):?>
      <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php echo $session->getFlash('success'); ?>
      </div>
    <?php endif;?>
    <?php if(!empty($session->getFlash("error"))):?>
    <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php echo $session->getFlash('error'); ?>
      </div>
    <?php endif;?>
    </div>
   </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
           <div>
            <?= Html::a('<i class="fa fa-plus-circle"></i> สร้างผลิตภัณฑ์', ['create'], ['class' => 'btn btn-success']) ?>
            <div class="btn btn-default btn-import" data-toggle="modal" data-target="#myModal"><i class="fa fa-upload"></i> นำเข้าสินค้า</div>
            <div class="btn btn-warning btn-bulk-remove" disabled>ลบ <span class="remove_item">[0]</span></div>
               <div class="btn btn-primary btn-bulk-barcode" disabled><i class="fa fa-barcode"> พิมพ์บาร์โค้ด </i> <span class="print_barcode">[0]</span></div>
               <div class="btn btn-info btn-bulk-reset"> รีเซ็ตจำนวน</div>
            <div class="btn-group pull-right" style="bottom: 0px">
                 <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>
                  <div class="label babel-default"><a href="#" class="show-adv"><i class="fa fa-caret-down i-icon"></i> ค้นหา</a></div>
            </div>
      </div> <br />
      <div class="row advance-search" style="display: none">
        <div class="col-lg-12">
          <form id="search-form" action="<?=Url::to(['product/index'],true);?>" method="post">
          <div class="form-inline">
            <input type="text" placeholder="รหัสสินค้า , ชื่อสินค้า" name="name_search" class="form-control" value="<?=$name?>">
            <select name="cat_id" class="form-control">
              <option>กลุ่มสินค้า</option>
              <?php foreach($cat as $value):?>
                   <?php 
                          $selected = '';
                          if($value->id == $cats){
                            $selected = 'selected';
                          }
                    ?>
                 <option value="<?=$value->id?>" <?=$selected;?>><?=$value->name?></option>
              <?php endforeach;?>
            </select>
           <input type="text" placeholder="ช่วงทุนเริ่ม" class="form-control" name="cost_start" value="<?=$cost_s?>">
            <input type="text" placeholder="ช่วงทุนสิ้นสุด" class="form-control" name="cost_end" value="<?=$cost_e?>">
            <div class="btn btn-default btn-search-submit"> ค้นหา</div>
            <div class="btn btn-default btn-search-clear"> ล้างข้อมูล</div>
          </div>
        </form>
        </div>
      </div>
      </div>
      <div class="panel-body">
<div class="table-grid">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            //'id',
            'product_code',
            'name',
            'description',
            //'photo',
              [
               'attribute'=>'category_id',
               'format' => 'html',
               'value'=>function($data){
                 return $data->category_id !== Null ? \backend\models\Category::getCategorycode($data->category_id):'';
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
               'attribute'=>'qty',
               'format' => 'html',
               'value'=>function($data){
                 return number_format($data->qty);
               }
             ],
              [
               'attribute'=>'cost',
               'format' => 'html',
               'value'=>function($data){
                 return number_format($data->cost);
               }
             ],
              [
               'attribute'=>'price',
               'format' => 'html',
               'value'=>function($data){
                 return number_format($data->price);
               }
             ],
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
  </div>
  <div class="row">
    <div class="col-lg-3">
      <form id="form-perpage" class="form-inline" action="<?=Url::to(['product/index'],true)?>" method="post">
        <div class="form-group">
         <label>จำนวนรายการ</label>
          <select class="form-control" name="perpage" id="perpage">
             <option value="20" <?=$perpage=='20'?'selected':''?>>20</option>
             <option value="50" <?=$perpage=='50'?'selected':''?> >50</option>
             <option value="100" <?=$perpage=='100'?'selected':''?>>100</option>
          </select>
      </div>
      </form>
      
    </div>
  </div>
    <?php Pjax::end(); ?>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-download"></i> นำเข้ารหัสสินค้า</h4>
      </div>
      <div class="modal-body">
        
        <div class="row">
            <div class="col-lg-6">
                <?php 

                ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]);
                echo FileInput::widget([
                  'name' => 'file',
                  'model' => $modelfile,
                  'attribute' => 'file',

                ]);
                ?>
                <br />
                <?php
                echo "<label>เลือกคลังสินค้า</label>";
                  echo Select2::widget([
                    'name'=>'warehouseid',
                    'model'=>$modelfile,
                    'attribute'=>'warehouseid',
                    'data'=> ArrayHelper::map(\backend\models\Warehouse::find()->all(),'id','name'),
                    ]);
                 ?>
                <br />
                <div class="btn-group">
                  <input type="submit" class="btn btn-success" value="ตกลง">
                </div>
                <?php
                ActiveForm::end();
             ?>
            </div>
           
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>

  </div>
</div>
<div id="modal_page" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-barcode"></i> กำหนดจำนวนพิมพ์บาร์โค้ด</h4>
      </div>
      <div class="modal-body">
        <form target="_blank" method="post" action="<?=Url::to(['product/printbarcode'],true)?>">
        <div class="row">
            <div class="col-lg-12">
              
               <input type="hidden" name="pcode" value="" class="pcode">
               <input type="number" class="form-control" name="qty" value="1">

            </div>
        </div><br>
        <div class="row">
          <div class="col-lg-12">
             <input type="submit" value="ตกลง"  class="btn btn-primary btn-submit">
          </div>
        </div>
         </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>

  </div>
</div>
<?php 
  $url_to_delete =  Url::to(['product/bulkdelete'],true);
  $url_to_reset =  Url::to(['product/bulkreset'],true);
  $this->registerJs('
    $(function(){
      var use_advance = "'.$use_advance.'";
      if(use_advance == 1){
        if($(".advance-search").css("display")=="none"){
            $(".advance-search").fadeIn(300);
            $(".i-icon").removeClass("fa-caret-down");
            $(".i-icon").addClass("fa-caret-up");
          }else{
            // $(".advance-search").fadeOut(300);
            //  $(".i-icon").removeClass("fa-caret-up");
            // $(".i-icon").addClass("fa-caret-down");
          }
      }
      $(".btn-search-submit").click(function(){
        //alert();return;
        $("#search-form").submit();
      });
      $(".btn-search-clear").click(function(){
          $("form#search-form :input").each(function(){
              $(this).val("");
          });
      });
      $(".btn-bulk-remove").click(function(e){
      //alert($(".listid").val());
            if($(this).attr("disabled")){
              return;
            }
            if(confirm("คุณต้องการลบรายการที่เลือกใช่หรือไม่")){
              if($(".listid").length >0){
                $.ajax({
                  type: "post",
                  dataType: "html",
                  url: "'.$url_to_delete.'",
                  data: {id: $(".listid").val()},
                  success: function(data){

                  }
                });
              }
            }
    });
    $(".btn-bulk-reset").click(function(e){
      //alert($(".listid").val());
            if($(this).attr("disabled")){
              return;
            }
            if(confirm("คุณต้องการรีเซ็ตจำนวนเป็น 0 ใช่หรือไม่")){
              if($(".listid").length >0){
                $.ajax({
                  type: "post",
                  dataType: "html",
                  url: "'.$url_to_reset.'",
                  data: {id: $(".listid").val()},
                  success: function(data){

                  }
                });
              }
            }
    });
    $(".btn-bulk-barcode").click(function(){
      if($(this).attr("disabled")){
              return;
            }
      $("#modal_page").modal("show").find(".pcode").val($(".listid").val());
    });
    $(".btn-submit").click(function(){
      $("#modal_page").modal("hide");
    });
      $("#perpage").change(function(){
          $("#form-perpage").submit();
      });
       $(".show-adv").click(function(){
          if($(".advance-search").css("display")=="none"){
            $(".advance-search").fadeIn(300);
            $(".i-icon").removeClass("fa-caret-down");
            $(".i-icon").addClass("fa-caret-up");
          }else{
            $(".advance-search").fadeOut(300);
             $(".i-icon").removeClass("fa-caret-up");
            $(".i-icon").addClass("fa-caret-down");
          }
          
       });
      });
    ',static::POS_END);
?>
