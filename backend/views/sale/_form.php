<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\typeahead\Typeahead;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Sale */
/* @var $form yii\widgets\ActiveForm */
 $wh = \backend\models\Warehouse::find()->all();
?>

<div class="sale-form">

    <?php $form = ActiveForm::begin(['id'=>'form-sale']); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                <?php if(!$model->isNewRecord):?>
                <div class="btn btn-primary btn-sale-confirm">ยืนยัน</div>
                <input type="hidden" class="sale_id" value="<?=$model->id?>" />
              <?php endif;?>
            </div>

        </div>
    </div>
    <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-lg-3">
                     <?= $form->field($model, 'sale_no')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>$model->isNewRecord?$runno:$model->sale_no]) ?>
                </div>
                <div class="col-lg-3">
                    <?php if($model->isNewRecord){$model->sale_date = date('d-m-Y');}else{$model->sale_date = date('d-m-Y',$model->sale_date);} ?>
                     <?= $form->field($model, 'sale_date')->widget(DatePicker::className(), [ 'pluginOptions' => [
                                          'format' => 'dd-mm-yyyy',
                                          //'value' => date('dd-mm-yyyy'),
                                          'autoclose' => true,
                                          'todayHighlight' => true
                                      ], 'options' => ['style' => 'width: 100%',
                                           
                                      ]])->label() ?>
                </div>
                <div class="col-lg-3">
                     <?= $form->field($model, 'customer_id')->widget(Select2::className(),[
                        'data' => ArrayHelper::map(\backend\models\Customer::find()->all(),'id','name'),
                        'options'=>['placeholder'=>'เลือกลูกค้า']
                     ]) ?>
                </div>
                <div class="col-lg-3">
                     <?= $form->field($model, 'payment_type')->widget(Select2::className(),
                                    [
                                     'data'=> ArrayHelper::map(\backend\helpers\PaymentType::asArrayObject(),'id','name'),
                                    'options'=>['maxlength' => true,'class'=>'form-control form-inline','id'=>'payment_type'],
                                    ]

                                  )->label() ?>   
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                     <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                     <?= $form->field($model, 'discount_per')->textInput() ?>
                </div>
                <div class="col-lg-3">
                     <?= $form->field($model, 'sale_amount')->textInput(['readonly'=>'readonly']) ?>
                </div>
                <div class="col-lg-3">
                     <?= $form->field($model, 'payment_status')->textInput(['readonly'=>'readonly']) ?>
                </div>
            </div>
             <div class="row">
                <div class="col-lg-3">
                   <?php if($model->isNewRecord){$model->created_at = date('d-m-Y');}else{$model->created_at = date('d-m-Y',$model->created_at);} ?>
                     <?= $form->field($model, 'created_at')->textInput(['readonly'=>'readonly']) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>
                </div>
              
            </div>
               
               <hr />
               <div class="row">
                <div class="col-lg-3">
                  <?php
                    echo Typeahead::widget([
                          'name' => 'country',
                          'options' => ['placeholder' => 'ค้นหารหัสสินค้า...','id'=>'type_prod'],
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
                                        url: '".Url::to(['/sale/addline'])."',
                                        data: {data:s},
                                        success: function(data){
                                          var prodcode = '';
                                          $('.table-tmp').empty();
                                          $('.table-tmp').append(data);
                                          $('.table-tmp tr').each(function(){
                                            prodcode = $(this).closest('tr').find('.product_code').val(); 
                                          });
                                         
                                          if(prodcode != ''){
                                             if($('.add-saleline >tr').length == 0){
                                                  var cnt =0;
                                                  $('.add-saleline').append(data);
                                                  $('#lineitem >tbody >tr').each(function(){
                                                    cnt+=1;
                                                    $(this).find('td:first-child').text(cnt);
                                                  });
                                                  sumall();
                                             }else{
                                                var countline = 0;
                                                $('.add-saleline >tr').each(function(){
                                                   if($(this).closest('tr').find('.product_code').val() == prodcode){
                                                      countline +=1;
                                                      var old_qty = $(this).closest('tr').find('.qty').val();
                                                      var prc = $(this).closest('tr').find('.price').val();
                                                      $(this).closest('tr').find('.qty').val(parseInt(old_qty)+1);
                                                      $(this).closest('tr').find('.line_amount').val((parseInt(old_qty)+1) * parseInt(prc) );
                                                      sumall();
                                                   }
                                                 });
                                                 if(countline == 0){
                                                      $('.add-saleline').append(data);
                                                       var cnt =0;
                                                        $('#lineitem >tbody >tr').each(function(){
                                                          cnt+=1;
                                                          $(this).find('td:first-child').text(cnt);
                                                        });
                                                      sumall();
                                                 }
                                             }
                                             
                                          }else{
                                              var cnt =0;
                                              $('#lineitem >tbody >tr').each(function(){
                                                cnt+=1;
                                                $(this).find('td:first-child').text(cnt);
                                              });
                                          }
                                          
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
               <table class="table" id="lineitem">
                <thead>
                  <tr>
                    <th>#</th>
                     <th>รหัสสินค้า</th>
                     <th>ชื่อสินค้า</th>
                     <th>คลังสินค้า</th>
                      <th>จำนวน</th>
                     <th>ราคา</th>
                     <th>รวมเงิน</th>
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
                            <select id="whid" class="form-control" name="warehouse[]">
                              <?php foreach($wh as $values):?>
                              <?php 
                                   $select = '';
                                   if($value->warehouse_id == $values->id){
                                    $select = 'selected';
                                   }
                              ?>
                              <option value="<?=$values->id?>" <?=$select?>>
                                <?=$values->name?>
                              </option>
                            <?php endforeach;?>
                            </select>
                          </td>
                          <td>
                            <input type="text" class="form-control qty" name="qty[]" value="<?=$value->qty?>" onkeydown="eventNumber($(this));" onchange="linecal($(this));" /> 
                          </td>
                          <td>
                            <input type="text" class="form-control price" name="price[]" value="<?=$value->price?>" onchange="linecal($(this));" />
                          </td>
                          <td><input type="text" class="form-control line_amount" name="line_amount[]" value="<?=$value->line_amount?>" /></td>
                          <td><div class="btn btn-warning line_remove" onclick="removeline($(this));"><i class="fa fa-minus"></i></div></td>
                        </tr>
                      <?php endforeach;?>
                    <?php endif;?>
                   <?php endif;?>
                </tbody>
                <tfoot>
                  <tr>
                    <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td style="text-align: right;"><h4>รวม</h4></td>
                     <td>
                        <input type="text" value="" class="form-control total_all" readonly /> 
                     </td>
                  </tr>
                </tfoot>
               </table>
               
               </table>
        </div>    
    </div>

    

    
    <?php ActiveForm::end(); ?>
<table class="table-tmp" style="display: none;">
</div>
<?php 
$url_to_firm = Url::to(['sale/firmorder'],true);
$url_to_check_onhand = Url::to(['sale/checkonhand'],true);
 $this->registerJs('
  $(function(){
    sumall();

    $(window).keydown(function(event){ 
       if(event.keyCode == 13 && event.target !== document.getElementById("type_prod")) {
         if(event.keyCode == 13) {
           event.preventDefault();
           return false;
          }
      }
    });


    $(".btn-sale-confirm").click(function(){
      if($(".add-saleline >tr").length <=0){
        alert("กรุณาเพิ่มรายละเอียดใบสั่งซื้อก่อน");return;
      }
      if(confirm("คุณต้องการยืนยันใยสั่งซื้อนี้ใช่หรือไม่")){
        var sale_id = $(".sale_id").val();
        //alert(sale_id);
        $.ajax({
          type: "post",
          dataType: "html",
          url: "'.$url_to_firm.'",
          data:{saleid: sale_id},
          success: function(data){
           alert(data);
          }
        });
      }

      });

    $("#type_prod ,.typeahead").keypress(function(e){
      if(e.keyCode == 13){
        e.preventDefault();
        $(".tt-suggestion:first-child").trigger("click");
        $("#sale-form").on("submit",function(){
            return false;
        });
        //return false;

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
  function changeQty(e){
    var pdid = e.closest("tr").find(".product_id").val();
    var whid = e.closest("tr").find("#whid").val();
    var qty = e.val();
    var price = e.closest("tr").find(".price").val();

    if(qty > 0){
      $.ajax({
        type: "post",
        dataType: "html",
        url: "'.$url_to_check_onhand.'",
        data:{wh: whid,pd: pdid},
        success: function(data){
         // alert(data);
          if(parseInt(data) < parseInt(qty)){
             alert("จำนวนในสต๊อกน้อยกว่าที่ต้องการ");
             e.val(0);
             e.closest("tr").find(".line_amount").val(parseFloat(e.val() * price));
          }else{
              e.closest("tr").find(".line_amount").val(parseFloat(qty * price));
          }
        
          sumall();
        }
      });
    }
    
    
  }
  function linecal(e){
    var whid = e.closest("tr").find("#whid").val();
    var qty = e.closest("tr").find(".qty").val();
    var price = e.closest("tr").find(".price").val();
    e.closest("tr").find(".line_amount").val(parseFloat(qty * price));
    sumall();
  }
  function removeline(e){
    if(confirm("ต้องการลบรายการนี้ใช่หรือไม่")){
      e.parent().parent().remove();
      sumall();
    }
    
  }

  ',static::POS_END)?>