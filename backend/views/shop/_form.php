<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\FileInput;
use toxor88\switchery\Switchery;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
use backend\models\Bank;

/* @var $this yii\web\View */
/* @var $model backend\models\Shop */
/* @var $form yii\widgets\ActiveForm */



?>

<div class="shop-form">
    <?php $form = ActiveForm::begin(['class'=>'form-horizontal','options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ข้อมูลร้านค้า
                </div>
                <div class="panel-body">
                    <div class="row">
                       <div class="col-lg-12">
                          
                         
                           <div class="form-group">
                                <label class="control-label col-sm-2" for="name" style="bottom: -5px;text-align: right;"><?=$model->getAttributeLabel('name')?></label>
                                <div class="col-sm-10">
                                  <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class'=>'form-control form-inline','id'=>'name'])->label(false) ?>
                                </div>
                           </div>
                           <div class="form-group">
                                <label class="control-label col-sm-2" for="description" style="bottom: -5px;text-align: right;"><?=$model->getAttributeLabel('description')?></label>
                                <div class="col-sm-10">
                                  <?= $form->field($model, 'description')->textarea(['maxlength' => true,'class'=>'form-control','id'=>'description'])->label(false) ?>
                                </div>
                           </div>
                           <div class="form-group">
                                <label class="control-label col-sm-2" for="email" style="bottom: -5px;text-align: right;"><?=$model->getAttributeLabel('taxid')?></label>
                                <div class="col-sm-10">
                                  <?= $form->field($model, 'taxid')->textInput(['maxlength' => true,'class'=>'form-control','style'=>'width: 50%;'])->label(false) ?>
                                </div>
                           </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email" style="bottom: -5px;text-align: right;"><?=$model->getAttributeLabel('license_no')?></label>
                                <div class="col-sm-10">
                                  <?= $form->field($model, 'license_no')->textInput(['maxlength' => true,'class'=>'form-control','style'=>'width: 50%;'])->label(false) ?>
                                </div>
                           </div>
                           <div class="form-group">
                                <label class="control-label col-sm-2" for="email" style="bottom: -5px;text-align: right;"><?=$model->getAttributeLabel('email')?></label>
                                <div class="col-sm-10">
                                  <?= $form->field($model, 'email')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                           </div>
                             
                            
                           <div class="form-group">
                                <label class="control-label col-sm-2" for="email" style="bottom: -5px;text-align: right;"><?=$model->getAttributeLabel('address')?></label>
                                <div class="col-sm-10">
                                  <?= $form->field($model, 'address')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                           </div>
                           <div class="form-group">
                                <label class="control-label col-sm-2" for="email" style="bottom: -5px;text-align: right;"><?=$model->getAttributeLabel('zipcode')?></label>
                                <div class="col-sm-10">
                                  <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true,'class'=>'form-control','style'=>'width: 50%;'])->label(false) ?>
                                </div>
                           </div>
                           <div class="form-group">
                                <label class="control-label col-sm-2" for="email" style="bottom: -5px;text-align: right;"><?=$model->getAttributeLabel('phone')?></label>
                                <div class="col-sm-10">
                                  <?= $form->field($model, 'phone')->textInput(['maxlength' => true,'class'=>'form-control','style'=>'width: 50%;'])->label(false) ?>
                                </div>
                           </div>
                           <div class="form-group">
                                <label class="control-label col-sm-2" for="email" style="bottom: -5px;text-align: right;"><?=$model->getAttributeLabel('mobile')?></label>
                                <div class="col-sm-10">
                                  <?= $form->field($model, 'mobile')->textInput(['maxlength' => true,'class'=>'form-control','style'=>'width: 50%;'])->label(false) ?>
                                </div>
                           </div>
                           <div class="form-group">
                                <label class="control-label col-sm-2" for="email" style="bottom: -5px;text-align: right;"><?=$model->getAttributeLabel('logo')?></label>
                                <div class="col-sm-10">
                                  <?= $form->field($model, 'logo')->fileInput()->label(false) ?>
                                <input type="hidden" name="old_logo" value="<?=$model->logo?>" />
                                </div>
                           </div>
                           <div class="form-group">
                                <label class="control-label col-sm-2" for="email" style="bottom: -5px;text-align: right;"><?=$model->getAttributeLabel('website')?></label>
                                <div class="col-sm-10">
                                  <?= $form->field($model, 'website')->textInput(['maxlength' => true,'class'=>'form-control','style'=>'width: 50%;'])->label(false) ?>
                                </div>
                           </div>
                           <div class="form-group">
                                <label class="control-label col-sm-2" for="email" style="bottom: -5px;text-align: right;"><?=$model->getAttributeLabel('facebook')?></label>
                                <div class="col-sm-10">
                                  <?= $form->field($model, 'facebook')->textInput(['maxlength' => true,'class'=>'form-control','style'=>'width: 50%;'])->label(false) ?>
                                </div>
                           </div>
                           <div class="form-group">
                                <label class="control-label col-sm-2" for="email" style="bottom: -5px;text-align: right;"><?=$model->getAttributeLabel('line')?></label>
                                <div class="col-sm-10">
                                  <?= $form->field($model, 'line')->textInput(['maxlength' => true,'class'=>'form-control','style'=>'width: 50%;'])->label(false) ?>
                                </div>
                           </div>


                    <?php //echo $form->field($model, 'status')->textInput() ?>

                    <?php //echo $form->field($model, 'created_at')->textInput() ?>

                    <?php //echo $form->field($model, 'updated_at')->textInput() ?>

                    <?php //echo $form->field($model, 'created_by')->textInput() ?>

                    <?php //echo $form->field($model, 'updated_by')->textInput() ?>

                   
                       
                   
                        </div>
                   </div>
                    </div>
            </div>
        </div>
      

                     
    </div>
    <div class="row">
      <div class="col-lg-12">
         <div class="form-group">
                         <label class="control-label col-sm-2" for="email" style="bottom: -5px;"></label>
                                <div class="col-sm-10">
                                   <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                                </div>
                       
                    </div>
      </div>
    </div>
</div>

  <?php ActiveForm::end(); ?>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
              <h3>เพิ่มบัญชีธนาคาร</h3>
          </div>
          <div class="modal-body">
             <?php $form = ActiveForm::begin(['id'=>'form-bank']); ?>
                   <div class="row">
                    <div class="col-lg-12">
                      <div class="panel panel-default">
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-lg-12">

                                  <div class="form-group">
                                              <label class="control-label col-sm-3" for="name" style="bottom: -5px;text-align: right;"><?=$model_bankaccount->getAttributeLabel('bank_id')?></label>
                                              <div class="col-sm-9">
                                                <?= $form->field($model_bankaccount, 'bank_id')->widget(Select2::className(),
                                                  [
                                                   'data'=> ArrayHelper::map(\backend\models\Bank::find()->all(),'id','name'),
                                                  'options'=>['maxlength' => true,'class'=>'form-control form-inline','id'=>'bank_id'],
                                                  ]

                                                )->label(false) ?>
                                              </div>
                                  </div>

                                  <div class="form-group">
                                              <label class="control-label col-sm-3" for="name" style="bottom: -5px;text-align: right;"><?=$model_bankaccount->getAttributeLabel('account_no')?></label>
                                              <div class="col-sm-9">
                                                <?= $form->field($model_bankaccount, 'account_no')->textInput(['maxlength' => true,'class'=>'form-control form-inline','id'=>'account_num'])->label(false) ?>
                                              </div>
                                         </div>

                                  <div class="form-group">
                                              <label class="control-label col-sm-3" for="name" style="bottom: -5px;text-align: right;"><?=$model_bankaccount->getAttributeLabel('brance')?></label>
                                              <div class="col-sm-9">
                                                <?= $form->field($model_bankaccount, 'brance')->textInput(['maxlength' => true,'class'=>'form-control form-inline','id'=>'brance'])->label(false) ?>
                                              </div>
                                         </div>

                                 <div class="form-group">
                                    <?php //echo Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                                    <div class="btn btn-success btn-addbank">ตกลง</div>
                                </div>
                              </div>
                              </div>
                              </div>
                            </div>
                          </div>
                        </div>

    <?php ActiveForm::end(); ?>
          </div>
          <!-- <div class="modal-footer">
            <button class="btn" data-dismiss="modal">Close</button>
          </div> -->
          </div>
        </div>
        </div>
    <?php
        $this->registerJs('
            $(function(){
                  $(".btn-add-bank").click(function(){
                    $("#myModal").modal("show");
                  });

                  $(".btn-addbank").click(function(e){
                  var type = $("#bank_id").val();
                  var account_no = $("#account_num").val();
                  var brances = $("#brance").val();
                  var bank_text = $("#bank_id option:selected").text();
                 //alert(account_no);return;
                    $.ajax({
                           type: "POST",
                           dataType: "html",
                          url: "'.Url::toRoute(['/shop/addbank'], true).'",
                          data: { txt: bank_text,id: type,account: account_no,brance: brances },
                          success: function(data){
                            //alert(data);
                                  $(".add-bank-body").append(data);
                                }
                      });
                  $("#myModal").modal("hide");
                });
            });
            function bankRemove(e){
              if(confirm("ต้องการลบรายการนี้ใช่หรือไม่")){
                  e.parents("tr").remove();
              }
            }
',static::POS_END);
    ?>
