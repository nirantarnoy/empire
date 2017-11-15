<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Issuetable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="issuetable-form">
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
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
                <?php if($model->isNewRecord && $model->status!=\backend\helpers\IssueStatus::ISSUE_OPEN):?>
                <div class="btn btn-primary btn-approve">อนุมัติ</div>
                <?php endif;?>
            </div>

        </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-4">
                  <?= $form->field($model, 'issue_no')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>$model->isNewRecord?$runno:$model->issue_no]) ?>
                </div>
                <div class="col-lg-4">
              
                     <?php if($model->isNewRecord){$model->require_date = date('d-m-Y');}else{$model->require_date = date('d-m-Y',$model->require_date);} ?>
                     <?= $form->field($model, 'require_date')->widget(DatePicker::className(), [ 'pluginOptions' => [
                                          'format' => 'dd-mm-yyyy',
                                          //'value' => date('dd-mm-yyyy'),
                                          'autoclose' => true,
                                          'todayHighlight' => true
                                      ], 'options' => ['style' => 'width: 100%',
                                           
                                      ]])->label() ?>
                </div>
                <div class="col-lg-4">

                  <?= $form->field($model, 'request_by')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>Yii::$app->user->identity->username]) ?>

                </div>
                </div>
               <div class="row">
              <div class="col-lg-4">
                <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4">

                  <?= $form->field($model, 'status')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>$status]) ?>
                </div>
               
                </div>

                 <hr />
               <div class="row">
                <div class="col-lg-3">
                  <?php
                    echo Typeahead::widget([
                          'name' => 'country',
                          'options' => ['placeholder' => 'ค้นหารหัสสินค้า...'],
                          'pluginOptions' => ['highlight'=>true],
                          'dataset' => [
                              [
                                  'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                                  'display' => 'value',
                                  'limit' => '100',
                                  'templates'=>[
                                    'notFound' => '<div class="text-danger" style="padding:0 8px">ไม่พบสินค้า</div>',
                                    'suggestion' => new \yii\web\JsExpression("Handlebars.compile('<div><span class=\'fa fa-picture-o\' style=\'font-size:1.5em;\'></span> {{product_code}} {{name}}</div>')"),
                                  ],
                                  //'prefetch' => '/samples/countries.json',
                                  'remote' => [
                                      'url' => 'index.php?r=sale%2Fproductlist'.'&q=%QUERY',
                                      'wildcard' => '%QUERY'
                                  ]
                              ]
                              ],
                              'pluginEvents'=>[
                                "typeahead:select" => "
                                  function(e,s){
                                    if($(document).find('.saleline-id-'+s.id).length >=1){

                                    }else{
                                      $.ajax({
                                        type: 'POST',
                                        url: '".Url::to(['/issuetable/addline'])."',
                                        data: {data:s},
                                        success: function(data){
                                          $('.add-saleline').parent().append(data);
                                          var cnt =0;
                                          $('#lineitem >tbody >tr').each(function(){
                                            cnt+=1;
                                            $(this).find('td:first-child').text(cnt);
                                          });
                                            sumall();
                                        }
                                      });
                                    }
                                  }
                                "
                              ]
                          
                      ]);
                  ?>
                </div>
               </div>
               <div class="table-responsive">
                <table class="table table-responsive" id="lineitem">
                <thead>
                  <tr>
                    <th>#</th>
                     <th>รหัสสินค้า</th>
                     <th>ชื่อสินค้า</th>
                     <th>จำนวน</th>
                    
                    <th></th>
                  </tr>
                </thead>
                <tbody class="add-saleline">
                  <?php if(!$model->isNewRecord):?>
                    <?php if(count($modelline)>0):?>
                      <?php foreach($modelline as $value):?>
                        <tr class="saleline-id-">
                          <td>1</td>
                          <td>
                            <input type="text" class="form-control product_code" name="product_code[]" value="<?=\backend\models\Product::getProdcode($value->product_id)?>" disabled="disabled" /> 
                            <input type="hidden" class="form-control product_id" name="product_id[]" value="<?=$value->product_id?>" /> 
                          </td>
                          <td>
                            <input type="text" class="form-control name" name="name[]" value="<?=\backend\models\Product::getProdname($value->product_id)?>" disabled="disabled" /> 
                          </td>
                          <td>
                            <input type="text" class="form-control qty" name="qty[]" value="<?=$value->req_qty?>" onkeydown="eventNumber($(this));" onchange="linecal($(this));" /> 
                          </td>
                         <td><div class="btn btn-warning line_remove" onclick="removeline($(this));"><i class="fa fa-minus"></i></div></td>
                        </tr>
                      <?php endforeach;?>
                    <?php endif;?>
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
$url_to_approve = Url::to(['issuetable/approve'],true);
$mid = $model->isNewRecord?0:$model->id;
$this->registerJs('
  $(function(){
    var modelid = "'.$mid.'";
    sumall();

    $(".btn-approve").click(function(){
      if(confirm("อนุมัติใบเติมสินค้าใช่หรือไม่")){
        $.ajax({
          type: "post",
          dataType: "html",
          url: "'.$url_to_approve.'",
          data: {id:modelid},
          success: function(data){
            alert(data);
          }
        });
      }
    });
  });
  function sumall(){
    var amount = 0;
    $(".add-saleline >tr").each(function(){
      amount = parseFloat(amount) + parseFloat($(this).closest("tr").find(".line_amount").val());
    });
    $(".total_all").val(amount);
  }
  function eventNumber(e){
    // var x = e.val().replace(/[^0-9\.]/g,"");
    //   e.val(x);

      if(e.keyCode == 46 || e.keyCode == 8){

      }else{
        if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)){
          e.preventDefault();
        }
      }
  }
  function linecal(e){
    var qty = e.closest("tr").find(".qty").val();
    var price = e.closest("tr").find(".price").val();
    e.closest("tr").find(".line_amount").val(parseFloat(qty * price));
    sumall();
  }
  function removeline(e){
    if(confirm("ต้องการลบรายการนี้ใช่หรือไม่")){
      e.parent().parent().remove();
    }
    
  }

  ',static::POS_END)?>

