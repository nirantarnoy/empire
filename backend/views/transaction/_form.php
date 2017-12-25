<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>
     <div class="row">
                    <div class="col-lg-12">
                         <div class="form-group">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    </div>
                    </div>
                </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
                <div class="col-lg-3">
                    <?= $form->field($model, 'transno')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>!$model->isNewRecord?$model->transno:$runno]) ?>
                </div>
              <div class="col-lg-3">
                 <?= $form->field($model, 'trans_type')->widget(Select2::className(),[
                    'data'=> ArrayHelper::map(\backend\helpers\TransactionType::asArrayObject(),'id','name'),

                 ]) ?>
                </div>
              <div class="col-lg-3">
                 <?php if($model->isNewRecord){$model->transdate = date('d-m-Y');}else{$model->transdate = date('d-m-Y',$model->transdate);} ?>
                <?= $form->field($model, 'transdate')->widget(DatePicker::className(), [ 'pluginOptions' => [
                                          'format' => 'dd-mm-yyyy',
                                          //'value' => date('dd-mm-yyyy'),
                                          'autoclose' => true,
                                          'todayHighlight' => true
                                      ], 'options' => ['style' => 'width: 100%',
                                           
                                      ]])->label() ?>
                </div>
              <div class="col-lg-3">
                <?= $form->field($model, 'status')->textInput(['readonly'=>'readonly','value'=>$model->isNewRecord?$status:\backend\helpers\TransactionStatus::getTypeById($model->status)]) ?>
                </div>
              
                   
                </div>
               <div class="row">
                <div class="col-lg-12">
                    <div class="btn btn-primary btn-addline"> เพิ่ม</div>
                </div>
               </div> <br />
               <div class="row">
                <div class="col-lg-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>หัวข้อ</th>
                                <th>รายละเอียด</th>
                                <th>จำนวนเงิน</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="line-body">
                          <?php if(!$model->isNewRecord):?>
                              <?php if(count($model_line)>0):?>
                                 <?php $x = 0;?>
                                <?php foreach($model_line as $value):?>
                                  <?php $x += 1;?>
                                  <tr class="saleline-id-">
                                    <td><?=$x?></td>
                                    <td>
                                      <input type="text" class="form-control product_code" name="expend_tite[]" value="<?=\backend\models\Expense::getTitlecode($value->title_id)?>" disabled="disabled" /> 
                                      <input type="hidden" class="form-control expend_title_id" name="expend_title_id[]" value="<?=$value->trans_id?>" /> 
                                    </td>
                                    <td>
                                      <input type="text" class="form-control name" name="name[]" value="<?=\backend\models\Expense::getTitlename($value->title_id)?>" disabled="disabled" /> 
                                    </td>
                                    <td>
                                      <input type="text" class="form-control price" name="price[]" value="<?=$value->amount?>" onkeydown="eventNumber($(this));" onchange="linecal($(this));" /> 
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
    $url_to_add_line = Url::to(['transaction/addline'],true);
    $url_to_list_product = Url::to(['transaction/listproduct'],true);
    $this->registerJs('
        $(function(){
            $(".btn-addline").click(function(){
                var datax = '.$expendlist.';
                $.ajax({
                    type: "post",
                    dataType: "html",
                    url: "'.$url_to_add_line.'",
                    data: {id: 1},
                    success: function(data){
                        $(".line-body").append(data);
                        $(".line-body tr:last td:eq(1) input").val("").autocomplete({
                            source: function (request, response) {
                                   var array = $.map(datax, function (value, key) {
                                        return {
                                            label: value.name,
                                            value: value.id,
                                            name: value.description,
                                           // price: value.price
                                        }
                                    });
                                  response($.ui.autocomplete.filter(array, request.term));                               
                            }, 
                            minLength: 0,
                            focus: function( event, ui ) {
                            $(this).val( ui.item.label);
                                return false;
                            },
                            select: function( event, ui ) {
                                $( this ).val( ui.item.label );
                                // $( "#project-id" ).val( ui.item.value );
                                // $( "#project-description" ).html( ui.item.desc );
                                // $( "#project-icon" ).attr( "src", "images/" + ui.item.icon );

                                $(this).closest("tr").find(".name").val(ui.item.name);
                                //$(this).closest("tr").find(".price").val(ui.item.price);
                                $(this).closest("tr").find(".expend_title_id").val(ui.item.value);
                         
                                return false;
                              }
                        });
                      
                    }   
                });
            });
        });
         
         function removeline(e){
          e.parent().parent().remove();
         }

         function eventNumber(e){
           var x = e.val().replace(/[^0-9\.]/g,"");
             e.val(x);
            if(e.keyCode == 46 || e.keyCode == 8){

            }else{
              if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)){
                e.preventDefault();
              }
            }
        }
   ',static::POS_END);
 ?>