<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use toxor88\switchery\Switchery;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Warehouse */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="warehouse-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6">
                
                  <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
                  
                  <?= $form->field($model, 'sale_id')->widget(Select2::className(),[
                      'data' => ArrayHelper::map(\backend\models\Employee::find()->all(),'id','first_name'),
                      'options' => ['placeholder'=>'เลือกพนักงานขาย'],
                      'pluginOptions'=>[
                        'allowClear' => true,
                      ]
                  ]) ?>

                  <?= $form->field($model, 'market_id')->widget(Select2::className(),[
                      'data' => ArrayHelper::map(\backend\models\Market::find()->all(),'id','name'),
                      'options' => ['placeholder'=>'เลือกตลาด'],
                      'pluginOptions'=>[
                        'allowClear' => true,
                      ]
                  ]) ?>

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
