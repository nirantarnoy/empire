<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use toxor88\switchery\Switchery;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\Agent */
/* @var $form yii\widgets\ActiveForm */
 
 $group = backend\models\AgentGroup::find()->all();

?>

<div class="agent-form">

    <?php $form = ActiveForm::begin(); ?>

     <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6">
                
                    <?= $form->field($model, 'agent_code')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'agent_group')->widget(Select2::className(),[
                         'data'=>ArrayHelper::map($group,'id','name'),
                         'options' => ['placeholder'=>'เลือกกลุ่ม']
                        ]) ?>
                      <?php if($model->isNewRecord){$model->start_date = date('d-m-Y');}else{$model->start_date = date('d-m-Y',$model->start_date);} ?>
                    <?= $form->field($model, 'start_date')->widget(DatePicker::className(), [ 'pluginOptions' => [
                                          'format' => 'dd-mm-yyyy',
                                          //'value' => date('dd-mm-yyyy'),
                                          'autoclose' => true,
                                          'todayHighlight' => true
                                      ], 'options' => ['style' => 'width: 100%',
                                           
                                      ]])->label() ?>
                      <?php if($model->isNewRecord){$model->expire_date = date('d-m-Y');}else{$model->expire_date = date('d-m-Y',$model->expire_date);} ?>
                    <?= $form->field($model, 'expire_date')->widget(DatePicker::className(), [ 'pluginOptions' => [
                                          'format' => 'dd-mm-yyyy',
                                          //'value' => date('dd-mm-yyyy'),
                                          'autoclose' => true,
                                          'todayHighlight' => true
                                      ], 'options' => ['style' => 'width: 100%',
                                           
                                      ]])->label() ?>

                    <?= $form->field($model, 'score')->textInput() ?>

                    <?= $form->field($model, 'amount')->textInput() ?>

                   <?php echo $form->field($model, 'status')->widget(Switchery::className(),['options'=>['label'=>'']]) ?>

                  <div class="form-group">
                      <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                  </div>
                </div>
                <div class="col-lg-6">
                   
                </div>
                </div>
                </div>
              </div>
            </div>
          </div>

    <?php ActiveForm::end(); ?>

</div>
