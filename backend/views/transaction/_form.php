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
                <?= $form->field($model, 'status')->textInput(['readonly'=>'readonly','value'=>$model->isNewRecord?$status:\backend\helpers\TransactionType::getTypeById($model->statue)]) ?>
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
                                <th>ชื่อ</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="line-body">
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
    $this->registerJs('
        $(function(){
            $(".btn-addline").click(function(){
                $.ajax({
                    type: "post",
                    dataType: "html",
                    url: "'.$url_to_add_line.'",
                    data: {id: 1},
                    success: function(data){
                        $(".line-body").append(data);
                    }   
                });
            });
        });
   ');
 ?>