<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use toxor88\switchery\Switchery;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
$cat = \backend\models\Category::find()->where(['status'=>1])->all();
$sub_cat = \backend\models\Subcategory::find()->where(['status'=>1])->all();
$unit = \backend\models\Unit::find()->where(['status'=>1])->all();
$wh = \backend\models\Warehouse::find()->all();
$agentgroupall = \backend\models\AgentGroup::find()->all();
$agentall = \backend\models\Agent::find()->all();
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

     <div class="form-group">
          <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
     </div>
<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">ข้อมูลสินค้า</a></li>
              <li><a href="#tab_3" data-toggle="tab">กำหนดขั้นต่ำตามคลังสินค้า</a></li>
              
              <?php if(!$model->isNewRecord):?>
              <li><a href="#tab_2" data-toggle="tab">สินค้าคงคลังและความเคลื่อนไหว</a></li>
              <li><a href="#tab_4" data-toggle="tab">กำหนดราคาขายตัวแทน</a></li>
              <li><a href="#tab_5" data-toggle="tab">สินค้าจัดชุด</a></li>
            <?php endif;?>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                  <div class="row">
                      <div class="col-lg-12">
                        <div class="panel">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-lg-6">

                                    <?= $form->field($model, 'product_code')->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'category_id')->widget(Select2::className(),
                                                    [
                                                     'data'=> ArrayHelper::map($cat,'id','name'),
                                                    'options'=>['placeholder' => 'เลือกหมวดผลิตภัณฑ์','class'=>'form-control','id'=>'level',
                                                       'onchange'=>' 
                                                          $.post("index.php?r=product/showsubcategory&id=' . '"+$(this).val(),function(data){
                                                          $("select#sub_cat").html(data);
                                                          $("select#sub_cat").prop("disabled","");

                                                          });
                                                      ',
                                                    ],
                                                    ]

                                                  )->label() ?>
                                    <?= $form->field($model, 'parent_id')->widget(Select2::className(),
                                                    [
                                                     'data'=> ArrayHelper::map($sub_cat,'id','name'),
                                                     'options'=>['placeholder' => 'เลือกหมวดผลิตภัณฑ์ย่อย','class'=>'form-control','id'=>'sub_cat','disabled'=>'disabled'],
                                                    ]

                                                  )->label() ?>

                                    <?php //echo $form->field($model, 'brand_id')->widget(Select2::className(),
                                                   // [
                                                    // 'data'=> ArrayHelper::map(\backend\models\Brand::find()->all(),'id','name'),
                                                    /// 'options'=>['placeholder' => 'เลือกยี่ห้อ','class'=>'form-control','id'=>'brand_id',
                                                     //'onchange'=>' 
                                                     //     $.post("index.php?r=product/showmodel&id=' . '"+$(this).val(),function(data){
                                                      //    $("select#model_id").html(data);
                                                      //    $("select#model_id").prop("disabled","");
                                                      //    });
                                                     // ',
                                                   //  ],
                                                   // ]
                                                //  )->label() ?>

                                    <?php //echo $form->field($model, 'model_id')->widget(Select2::className(),
                                             //       [
                                             //        'data'=> ArrayHelper::map(\backend\models\Productmodel::find()->all(),'id','name'),
                                             //        'options'=>['placeholder' => 'เลือกรุ่นสินค้า','class'=>'form-control','id'=>'model_id','disabled'=>'disabled'],
                                              //      ]

                                              //    )->label() ?>

                                    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'unit_id')->widget(Select2::className(),
                                                    [
                                                     'data'=> ArrayHelper::map($unit,'id','name'),
                                                     'options'=>['placeholder' => 'เลือกหน่วยนับ','class'=>'form-control','id'=>'unit'],
                                                    ]

                                                  )->label() ?>

                                    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
                                    
                                    <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'qty')->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'min_qty')->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'max_qty')->textInput(['maxlength' => true]) ?>

                                    <?php echo "<h5>แนบไฟล์</h5>";?>
                                       <?php
                                           echo FileInput::widget([
                                             'model' => $modelfile,
                                              'attribute' => 'file[]',
                                              'id'=>'upfile',
                                              'options' => ['multiple' => true,'accept' => ['.TXT','.PDF','.PNG','.JPG','.GIF'],'style'=>'width: 300px'],
                                              'pluginOptions' => [
                                              'showUpload'=>false,
                                              'maxFileCount'=>3,
                                                ],
                                              ]);
                                       ?>
                 
                                     <input type="hidden" name="old_photo" value="<?=$model->photo?>" />
                                     <br />
                                   <?php echo $form->field($model, 'status')->widget(Switchery::className(),['options'=>['label'=>'']]) ?>

                                
                                </div>
                                </div>

                                    <hr />
                                    <div class="row">
                                      <div class="col-lg-12">
                                         <?php if(!$model->isNewRecord){
                                              if(count($imagelist)>0){
                                                $list = [];
                                                echo "<div class='row'>";
                                                foreach($imagelist as $value){
                                                  // array_push($list,[
                                                  //     'url' => '@web/uploads/images/'.$value->image,
                                                  //     'src' => '@web/uploads/images/'.$value->image,
                                                  //     'options' =>['title' => 'Sail us to the Moon','style'=>'height: 10px;width:10px;']
                                                  //  ]);
                                                  echo "<div class='col-lg-2' style='padding: 15px;'>";
                                                  echo Html::img('@web/uploads/images/'.$value->image,['style'=>'width: 80%']);
                                                  echo "</div>";
                                                }
                                              echo "</div>";
                                                // $items = [$list];
                                              //echo dosamigos\gallery\Gallery::widget(['items' => $list]);
                                            }
                                           }?>

                                      </div>
                                    </div>

                                </div>
                              </div>
                            </div>
                          </div>
              </div>
              <?php if(!$model->isNewRecord):?>
              <div class="tab-pane" id="tab_2">
                <div class="row">
                  <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-12">
                            <h3>สินค้าคงคลัง</h3>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-12">
                              <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                   // 'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                       // 'id',
                                        //'warehouse_id',
                                        [
                                          'attribute'=>'warehouse_id',
                                          'value'=> function($data){
                                            return $data->warehouse_id!=''?\backend\models\Warehouse::findName($data->warehouse_id):'';
                                          }
                                        ],
                                        'qty',
                                        [
                                        'attribute'=>'updated_at',
                                        'label' => 'อัพเดทล่าสุด',
                                          'value' => function($data){
                                            return date('d-m-Y',$data->updated_at);
                                          }
                                        ]
                                        // [
                                        //   'attribute'=>'sale_date',
                                        //   'value' => function($data){
                                        //     return date('d-m-Y',$data->sale_date);
                                        //   }
                                        // ],
                                        //'sale_amount',
                                        //'payment_type',
                                        //'require_ship_date',
                                        //'note',
                                       // 'payment_status',
                                       // [
                                       //     'attribute'=>'status',
                                       //     'format' => 'html',
                                       //     'value'=>function($data){
                                       //       return $data->status === 1 ? '<div class="label label-success">Active</div>':'<div class="label label-default">Inactive</div>';
                                       //     }
                                       //   ],
                                        //'created_at',
                                        // 'updated_at',
                                        // 'created_by',
                                        // 'updated_by',

                                        // [
                                        //             'label' => 'Action',
                                        //             'format' => 'raw',
                                        //             'value' => function($model){
                                        //                     return '
                                        //                         <div class="btn-group" >
                                        //                             <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                                        //                             <ul class="dropdown-menu" style="right: 0; left: auto;">
                                        //                             <li><a href="'.Url::toRoute(['/sale/view', 'id'=>$model->id]).'">'.'View'.'</a></li>
                                        //                             <li><a href="'.Url::toRoute(['/sale/update', 'id'=>$model->id]).'">'.'Update'.'</a></li>
                                        //                             <li><a onclick="return confirm(\'Confirm ?\')" href="'.Url::to(['/sale/delete', 'id'=>$model->id],true).'">Delete</a></li>
                                        //                             </ul>
                                        //                         </div>
                                        //                     ';
                                        //                 // }
                                        //             },
                                        //             'headerOptions'=>['class'=>'text-center'],
                                        //             'contentOptions' => ['class'=>'text-center','style'=>'vertical-align: middle','text-align: center'],

                                        //         ],
                                    ],
                                ]); ?>
                          </div>
                        </div>
                         <div class="row">
                          <div class="col-lg-12">
                            <h3>ความเคลื่อนไหวล่าสุด</h3>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-12">
                              <?= GridView::widget([
                                    'dataProvider' => $dataProvider2,
                                   // 'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                       // 'id',
                                        'journal_no',
                                        [
                                          'attribute'=>'warehouse_id',
                                          'value'=> function($data){
                                            return $data->warehouse_id!=''?\backend\models\Warehouse::findName($data->warehouse_id):'';
                                          }
                                        ],
                                        'qty',
                                        [
                                        'attribute'=>'invent_type',
                                        'format'=>'html',
                                          'value' => function($data){
                                           
                                              return $data->invent_type === 0 ? '<div class="label label-success">in</div>':'<div class="label label-danger">out</div>';
                                          
                                          }
                                        ],
                                        [
                                        'attribute'=>'transdate',
                                          'value' => function($data){
                                            return date('d-m-Y',$data->transdate);
                                          }
                                        ]
                                        // [
                                        //   'attribute'=>'sale_date',
                                        //   'value' => function($data){
                                        //     return date('d-m-Y',$data->sale_date);
                                        //   }
                                        // ],
                                        //'sale_amount',
                                        //'payment_type',
                                        //'require_ship_date',
                                        //'note',
                                       // 'payment_status',
                                       // [
                                       //     'attribute'=>'status',
                                       //     'format' => 'html',
                                       //     'value'=>function($data){
                                       //       return $data->status === 1 ? '<div class="label label-success">Active</div>':'<div class="label label-default">Inactive</div>';
                                       //     }
                                       //   ],
                                        //'created_at',
                                        // 'updated_at',
                                        // 'created_by',
                                        // 'updated_by',

                                        // [
                                        //             'label' => 'Action',
                                        //             'format' => 'raw',
                                        //             'value' => function($model){
                                        //                     return '
                                        //                         <div class="btn-group" >
                                        //                             <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                                        //                             <ul class="dropdown-menu" style="right: 0; left: auto;">
                                        //                             <li><a href="'.Url::toRoute(['/sale/view', 'id'=>$model->id]).'">'.'View'.'</a></li>
                                        //                             <li><a href="'.Url::toRoute(['/sale/update', 'id'=>$model->id]).'">'.'Update'.'</a></li>
                                        //                             <li><a onclick="return confirm(\'Confirm ?\')" href="'.Url::to(['/sale/delete', 'id'=>$model->id],true).'">Delete</a></li>
                                        //                             </ul>
                                        //                         </div>
                                        //                     ';
                                        //                 // }
                                        //             },
                                        //             'headerOptions'=>['class'=>'text-center'],
                                        //             'contentOptions' => ['class'=>'text-center','style'=>'vertical-align: middle','text-align: center'],

                                        //         ],
                                    ],
                                ]); ?>
                          </div>
                        </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                  </div>
                </div>
              </div>

            <?php endif;?>
            <div class="tab-pane" id="tab_3">
                <div class="row">
                  <div class="col-lg-6">
                     <div class="row">
                      <div class="col-lg-12">
                        <div class="btn btn-primary" id="addline"><i class="fa fa-plus"></i></div>
                      </div>
                     </div>
                     <div class="row">
                      <div class="col-lg-12">
                        <table class="table table-striped table-hover">
                          <thead>
                            <tr>
                              <th style="width: 60%">
                                คลังสินค้า
                              </th>
                                <th style="width: 40%">
                                ขั้นต่ำ
                              </th>
                               <th>
                                
                              </th>
                            </tr>
                          </thead>
                          <tbody id="min-body">
                            <?php 
                              if(!$model->isNewRecord):?>
                               <?php foreach($minline as $value):?>
                                <tr>
                                    <td>
                                      <input type="hidden" name="product_id[]" value="<?=$value->product_id?>">
                                    <select id="whid" class="form-control" name="warehouse[]">
                                        <?php foreach($wh as $data):?>
                                         <?php 
                                             $select = '';
                                             if($value->warehouse_id == $data->id){
                                              $select = 'selected';
                                             }
                                        ?>
                                        <option value="<?=$data->id?>" <?=$select?>>
                                          <?=$data->name?>
                                        </option>
                                      <?php endforeach;?>
                                      </select>
                                    </td>
                                    <td>
                                      <input type="text" name="min_qty[]" class="form-control" value="<?=$value->minstock?>">
                                    </td>
                                    <td>
                                      <div class="btn btn-warning line_remove" onclick="removeline($(this));"><i class="fa fa-minus"></i></div>
                                    </td>
                                  </tr>
                                <?php endforeach;?>
                              <?php endif;?>
                          </tbody>
                        </table>
                      </div>
                     </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab_4">
                <div class="row">
                  <div class="col-lg-12">
                    
                        <table class="table" width="100%">
                          <tr>
                            <td style="width: 20%">ราคาขาย</td>
                            <td style="width: 80%">
                              <input type="text" class="form-control price_sale" style="width: 30%" name="price_sale" value="">
                            </td>
                          </tr>
                           <tr>
                            <td style="width: 20%">กลุ่มตัวแทน</td>
                            <td style="width: 80%">
                              <?php
                                  echo Select2::widget([
                                    'name'=>'agent_group' ,
                                     'data'=> ArrayHelper::map($agentgroupall,'id','name'),
                                     'options' => ['multiple' => true,'id'=>'agent-group-select',
                                      //'maintainOrder' => true,
                                     'onchange'=>'
                                        if($(this).val().length >0){
                                          $("#agent-select").prop("disabled","disabled");
                                          agent_type = 1;
                                        }else{
                                          $("#agent-select").prop("disabled","");
                                          agent_type = "";
                                        }
                                     '
                                     ],
                                     'pluginOptions' => [
                                         'tags'=>true,
                                         'allowClear' => true,
                                         'multiple' => true,
                                       ],
                                  ]);
                              ?>
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 20%">รายชื่อตัวแทน</td>
                            <td style="width: 80%">
                              <?php
                                  echo Select2::widget([
                                    'name'=>'agent' ,
                                     'data'=> ArrayHelper::map($agentall,'id','name'),
                                     'options' => ['multiple' => true,'id'=>'agent-select',
                                      //'maintainOrder' => true,
                                     'onchange'=>'
                                        if($(this).val().length >0){
                                          $("#agent-group-select").prop("disabled","disabled");
                                          agent_type = 2;
                                        }else{
                                          $("#agent-group-select").prop("disabled","");
                                          agent_type = "";
                                        }
                                     '
                                     ],
                                     'pluginOptions' => [
                                         'tags'=>true,
                                         'allowClear' => true,
                                         'multiple' => true,
                                       ],
                                  ]);
                              ?>
                            </td>
                          </tr>
                        </table>
                        <div class="btn btn-primary" id="add-agent"><i class="fa fa-plus"></i></div>
                      </div>
                     </div>
                     <div class="row">
                      <div class="col-lg-12">
                          <table id="agent-list" class="table table-striped">
                            <thead>
                              <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 20%">ราคาขาย</th>
                                <th style="width: 60%">รายชื่อตัวแทน</th>
                                <th style="width: 15%"></th>
                              </tr>
                            </thead>
                            <tbody id="agent-body">
                               <?php if(!$model->isNewRecord):?>
                                 <?php foreach($modelagentprice as $data):?>
                                    <?php
                                       $name = '';
                                       $aid = explode(",",$data->agent_id_list);
                                       for($x=0;$x<=count($aid)-1;$x++){
                                         $name.= \backend\models\Agent::getAgentname($aid[$x]).",";
                                       }
                                     ?>
                                  <tr>
                                    <td></td>
                                    <td>
                                      <?php echo $data->price;?>
                                          <input type="hidden" class="line_price" name="line_price[]" value="<?=$data->price?>">     
                                          <input type="hidden" class="agent_type" name="agent_type[]" value="<?=$data->agent_type?>">     
                                      </td>
                                    <td>
                                      <?php echo $name;?>
                                        <input type="hidden" class="agentid" name="agentid[]" value="<?=$data->agent_id_list?>">   
                                      </td>
                                    <td><div class="btn btn-success btn-edit-agent" onclick="editagent($(this));">แก้ไข</div> <div class="btn btn-danger btn-delete-agent" onclick="deleteagent($(this));">ลบ</div></td>
                                  </tr>
                                <?php endforeach;?>
                               <?php endif;?>
                            </tbody>
                          </table>
                      </div>
                     </div>
                  
              </div>
              <div class="tab-pane" id="tab_5">
                <div class="row">
                      <div class="col-lg-12">
                        <div class="btn btn-primary" id="add_bom_line"><i class="fa fa-plus"></i></div>
                        <div class="total pull-right">
                          <h3><small>ราคารวม</small> <b><span class="bundle_total">0</span></b></h3>
                        </div>
                      </div>
                     </div>
                <div class="row">
                  <div class="col-lg-12">
                     <table id="table-bundle" class="table table-striped table-hover">
                          <thead>
                            <tr>
                              <th style="width: 20%">
                                รหัสสินค้า
                              </th>
                                <th style="width: 40%">
                                ชื่อสินค้า
                              </th>
                               <th style="width: 20%">
                                จำนวน
                              </th>
                               <th style="width: 20%">
                                ราคา
                              </th>
                               <th>
                                
                              </th>
                            </tr>
                          </thead>
                          <tbody id="bundle-body">
                            <?php 
                              if(!$model->isNewRecord):?>
                               <?php foreach($minline as $value):?>
                                <tr>
                                    <td>
                                      <input type="hidden" name="product_id[]" value="<?=$value->product_id?>">
                                    <select id="whid" class="form-control" name="warehouse[]">
                                        <?php foreach($wh as $data):?>
                                         <?php 
                                             $select = '';
                                             if($value->warehouse_id == $data->id){
                                              $select = 'selected';
                                             }
                                        ?>
                                        <option value="<?=$data->id?>" <?=$select?>>
                                          <?=$data->name?>
                                        </option>
                                      <?php endforeach;?>
                                      </select>
                                    </td>
                                    <td>
                                      <input type="text" name="min_qty[]" class="form-control" value="<?=$value->minstock?>">
                                    </td>
                                    <td>
                                      <div class="btn btn-warning line_remove" onclick="removeline($(this));"><i class="fa fa-minus"></i></div>
                                    </td>
                                  </tr>
                                <?php endforeach;?>
                              <?php endif;?>
                          </tbody>
                        </table>
                  </div>
                </div>  
              </div>
            </div>
</div>



 


    <?php ActiveForm::end(); ?>

</div>
<?php
Modal::begin([
    'header' => '<h4>Sales Quotation</h4>',
    'id' => 'modal',
    // 'data-backdrop'=>false,
    'size' => 'modal-lg',
    'options' => ['data-backdrop' => 'static',
    ],
    'footer' => '<a href="#" class="btn btn-danger" data-dismiss="modal">ยกเลิก</a>',
]);
echo "<div id='showmodal'></div>";
?> 

<?php Modal::end() ?>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa  fa-hand-pointer-o"></i> เลือกรหัสสินค้า</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-12">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider3,
                    'filterModel' => $searchModel3,
                    'id'=>'search-grid',
                    'pjax' => true,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        ['class' => 'yii\grid\CheckboxColumn'],
                        //'id',
                        'product_code',
                        'name',
                       // 'description',
                        //'photo',
                          [
                           'attribute'=>'category_id',
                           'filter'=>ArrayHelper::map(\backend\models\Category::find()->all(),'id','name'),
                           'format' => 'html',
                           'value'=>function($data){
                             return $data->category_id !== Null ? \backend\models\Category::getCategorycode($data->category_id):'';
                           }
                         ],
                       
                          [
                           'attribute'=>'price',
                           'format' => 'html',
                           'value'=>function($data){
                             return number_format($data->price);
                           }
                         ],
                      
                    ],
                ]); ?>
            </div>
           
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-submit-product" data-dismiss="modal2">เลือก</button>
      </div>
    </div>

  </div>
</div>

<?php
$url_to_addline = Url::to(['product/addminline'],true);
$url_to_addbundleline = Url::to(['product/addbundleline'],true);
$url_to_addagent = Url::to(['product/addagent'],true);
$this->registerJs('
  var agent_type = "";
  $(function(){
    $("#addline").click(function(){
      $.ajax({
        type: "post",
        dataType: "html",
        url: "'.$url_to_addline.'",
        data: {id:0},
        success: function(data){
          $("#min-body").append(data);
        }
      });
    });

    $("#add-agent").click(function(){
        var  listx = $("#agent-select").val();
        var  price = $(".price_sale").val();

        var dup = 0;
       
        $("table#agent-list tbody tr").each(function(){
           var hasprice = $(this).closest("tr").find(".line_price").val();
           if(hasprice == price){
            //alert("ราคาขายมีในระบบแล้ว");
             dup = 1;
           }
        });

        if(dup == 1){

          if(confirm("ราคาขายมีในระบบแล้ว คุณต้องการแก้ไขรายการนี้ใช่หรือไม่")){
           $("table#agent-list tbody tr").each(function(){
               var hasprice = $(this).closest("tr").find(".line_price").val();
               if(hasprice == price){
                  $(this).remove();
               }
            });
   

            $.ajax({
            type: "post",
            dataType: "html",
            url: "'.$url_to_addagent.'",
            data: {list: listx,price: price,agent_type: agent_type},
            success: function(data){
               //alert(data);
               $("#agent-body").append(data);
               $(".price_sale").val("0");
               $("#agent-group-select").prop("disabled","");
               $("#agent-select").prop("disabled","");
               $("#agent-select").val("").trigger("change");
            }
           });
          }

        }else{
            $.ajax({
            type: "post",
            dataType: "html",
            url: "'.$url_to_addagent.'",
            data: {list: listx,price: price,agent_type: agent_type},
            success: function(data){
               //alert(data);
               $("#agent-body").append(data);
               $(".price_sale").val("0");
               $("#agent-group-select").prop("disabled","");
               $("#agent-select").prop("disabled","");
               $("#agent-select").val("").trigger("change");
            }
          });
        }

    });
 
    $("#add_bom_line").click(function(){
        var xurl = "' . \yii::$app->getUrlManager()->createUrl('product/findproduct') . '";
        $("#myModal").modal("show");
                   // .find("#showmodal")
                   // .load(xurl);
    });

    $(".btn-submit-product").click(function(){
        var recid = $("#search-grid").yiiGridView("getSelectedRows");

                if(recid < 1){
                    alert("คุณยังไม่เลือกรายการใดๆ");
                    return;
                }else{
                    alert(recid.length);
                    for(var i=0;i<=recid.length -1;i++){
                      $.ajax({
                      type: "post",
                      dataType: "html",
                      url: "'.$url_to_addbundleline.'",
                      data: {prodid: recid[i]},
                      success: function(data){
                       // alert(data);
                         $("#bundle-body").append(data);
                         calBundle();
                         $("#myModal").modal("hide");
                      }
                     });
                    }
                     
                }
    });

  });
 function removeline(e){
    if(confirm("ต้องการลบรายการนี้ใช่หรือไม่")){
      e.parent().parent().remove();
    }
    
  }
  function calBundle(){
    var total = 0;
    $("#table-bundle tbody tr").each(function(){
        var qty = $(this).closest("tr").find(".qty").val();
        var price = $(this).closest("tr").find(".price").val();
        total = total + (qty * price);
    });
    $(".bundle_total").text(total);
  }
  function editagent(e){
    var line_price = e.closest("tr").find(".line_price").val();
    var line_ids = e.closest("tr").find(".agentid").val().split(",");
    agent_type = e.closest("tr").find(".agent_type").val();

    $(".price_sale").val(line_price);
    if(agent_type== 1){
      $("#agent-select").prop("disabled","disabled");
    }else if(agent_type ==2){

      $("#agent-group-select").prop("disabled","disabled");
      $("#agent-select").val(line_ids).change();
    }
  }
   function deleteagent(e){
    if(confirm("คุณต้องการลบรายการนี้ใช่หรือไม่")){
      e.parent().parent().remove();
    }
  }
  function removebundleline(e){
     if(confirm("คุณต้องการลบรายการนี้ใช่หรือไม่")){
      e.parent().parent().remove();
      calBundle();
    }
  }
  ',static::POS_END);
 ?>