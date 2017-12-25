<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\assets\ICheckAsset;

ICheckAsset::register($this);

$this->title = 'ใบขาย';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
    '@web/js/stockbalancejs.js?V=001',
    ['depends' => [\yii\web\JqueryAsset::className()]],
    static::POS_END
);
?>
<div class="sale-index">
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
<input type="hidden" name="listid" class="listid" value="">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
           <div>
            <?= Html::a('<i class="fa fa-plus-circle"></i> สร้างใบขาย', ['create'], ['class' => 'btn btn-success']) ?>
            <div class="btn btn-warning btn-bulk-remove" disabled>ลบ <span class="remove_item">[0]</span></div>
            <div class="btn-group pull-right" style="bottom: 10px">
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
      </div>
      </div>
      </div>
      <div class="panel-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
 ['class' => 'yii\grid\CheckboxColumn'],
           // 'id',
            'sale_no',
           // 'sale_date',
            [
              'attribute'=>'sale_date',
              'value' => function($data){
                return date('d-m-Y',$data->sale_date);
              }
            ],
             [
                      'attribute'=>'sale_amount',
                                 'headerOptions'=>['style'=>'text-align: right;'],
                                'contentOptions'=>['style'=>'text-align: right;'],
                      'label' => 'รายจ่าย',
                      'value' => function($data){
                        return number_format($data->sale_amount);
                      }
                    ],
            //'payment_type',
            //'require_ship_date',
            //'note',
           // 'payment_status',
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
                                        <li><a href="'.Url::toRoute(['/sale/view', 'id'=>$model->id]).'">'.'View'.'</a></li>
                                        <li><a href="'.Url::toRoute(['/sale/update', 'id'=>$model->id]).'">'.'Update'.'</a></li>
                                        <li><a onclick="return confirm(\'Confirm ?\')" href="'.Url::to(['/sale/delete', 'id'=>$model->id],true).'">Delete</a></li>
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
  <div class="row">
    <div class="col-lg-3">
      <form id="form-perpage" class="form-inline" action="<?=Url::to(['sale/index'],true)?>" method="post">
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

<?php
$url_to_delete =  Url::to(['sale/bulkdelete'],true);
   $this->registerJs('
     $(".btn-save-receive").click(function(){
        $("form#form-receive").submit();
     });
    $("#perpage").change(function(){
          $("#form-perpage").submit();
      });

    $(".btn-bulk-remove").click(function(e){
     // alert($(".listid").val());
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
    ',static::POS_END);
 ?>