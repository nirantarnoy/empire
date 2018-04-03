<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Bom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bom-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel">
    
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model, 'product_id')->textInput() ?>

                <?= $form->field($model, 'bom_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'cost')->textInput(['disabled'=>'disabled']) ?>
            </div>
        </div>
   
        </div>
    </div>

    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
