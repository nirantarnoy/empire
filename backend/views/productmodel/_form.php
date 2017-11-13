<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use toxor88\switchery\Switchery;

/* @var $this yii\web\View */
/* @var $model backend\models\Productmodel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productmodel-form">

    <?php $form = ActiveForm::begin(); ?>
 <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6">
                
                  <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
  
                  <?= $form->field($model, 'brand_id')->widget(Select2::className(),[
                        'data'=>ArrayHelper::map(\backend\models\Brand::find()->all(),'id','name'),
                        'options'=>['placeholder'=>'เลือกยี่ห้อ'],

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
