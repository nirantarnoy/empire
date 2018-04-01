<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AgentPrice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agent-price-form">

    <?php $form = ActiveForm::begin(); ?>

     <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6">
                
                    <?= $form->field($model, 'agent_id')->textInput() ?>

                    <?= $form->field($model, 'product_id')->textInput() ?>

                    <?= $form->field($model, 'min')->textInput() ?>

                    <?= $form->field($model, 'max')->textInput() ?>

                    <?= $form->field($model, 'price')->textInput() ?>

                    <?= $form->field($model, 'promotion_start_date')->textInput() ?>

                    <?= $form->field($model, 'promotion_expire_date')->textInput() ?>


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
