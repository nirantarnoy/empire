<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\Issuetable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="issuetable-form">

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
                  <?= $form->field($model, 'request_by')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
                </div>
                </div>
               <div class="row">
              <div class="col-lg-4">
                <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4">
                  <?= $form->field($model, 'status')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
                </div>
               
                </div>
                </div>
                 </div>
            </div>
          </div>
    
    <?php ActiveForm::end(); ?>

</div>
