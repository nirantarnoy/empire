<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use toxor88\switchery\Switchery;
/* @var $this yii\web\View */
/* @var $model backend\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6">
                
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'task_interval')->widget(Select2::className(),[
                        'data' => ArrayHelper::map(\backend\helpers\TaskInterval::asArrayObject(),'id','name'),
                        'options'=>['id'=>'interval']

                    ]) ?>

                     <?php if($model->isNewRecord){$model->task_start_date = date('d-m-Y');}else{$model->task_start_date = date('d-m-Y',$model->task_start_date);} ?>
                     <?= $form->field($model, 'task_start_date')->widget(DatePicker::className(), [ 'pluginOptions' => [
                                          'format' => 'dd-mm-yyyy',
                                          //'value' => date('d-m-Y'),
                                          'autoclose' => true,
                                          'todayHighlight' => true
                                      ], 'options' => ['style' => 'width: 100%',
                                            'onchange'=>'
                                                var intv = $("#interval").val();
                                                var sdat = $(this).val();

                                                $.ajax({
                                                    type:"post",
                                                    dataType: "html",
                                                    url: "'.Url::to(['task/calinterval'],true).'",
                                                    data:{inter: intv,sdate:sdat},
                                                    success:function(data){
                                                        $("#task_next_date").val(data);
                                                    }
                                                });
                                            '
                                           
                                      ]])->label() ?>
                    <?php if($model->isNewRecord){$model->task_next_date = null;}else{$model->task_next_date = date('d-m-Y',$model->task_next_date);} ?>
                     <?= $form->field($model, 'task_next_date')->widget(DatePicker::className(), [ 'pluginOptions' => [
                                          'format' => 'dd-mm-yyyy',
                                          //'value' => date('d-m-Y'),
                                          'autoclose' => true,
                                          'todayHighlight' => true
                                      ], 'options' => ['style' => 'width: 100%','readonly'=>'readonly','id'=>'task_next_date'
                                           
                                      ]])->label() ?>

                    <?php if($model->isNewRecord){$model->task_last_date = null;}else{$model->task_last_date = date('d-m-Y',$model->task_last_date);} ?>
                     <?= $form->field($model, 'task_last_date')->widget(DatePicker::className(), [ 'pluginOptions' => [
                                          'format' => 'dd-mm-yyyy',
                                          //'value' => date('d-m-Y'),
                                          'autoclose' => true,
                                          'todayHighlight' => true
                                      ], 'options' => ['style' => 'width: 100%','readonly'=>'readonly'
                                           
                                      ]])->label() ?>


                    <?= $form->field($model, 'emp_id')->widget(Select2::className(),[
                        'data'=>ArrayHelper::map(\backend\models\Employee::find()->all(),'id','first_name'),
                        'options'=>['placeholder'=>'เลือกรายการ'],
                    ]) ?>

                    <?php echo $form->field($model, 'status')->widget(Switchery::className(),['options'=>['label'=>'']]) ?>

                    <?php //echo $form->field($model, 'created_at')->textInput() ?>

                    <?php //echo $form->field($model, 'updated_at')->textInput() ?>

                    <?php //echo $form->field($model, 'created_by')->textInput() ?>

                    <?php //echo $form->field($model, 'updated_by')->textInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
                </div>
              </div>
            </div>
          </div>
    <?php ActiveForm::end(); ?>

</div>
