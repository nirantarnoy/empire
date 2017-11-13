<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Sale */

$this->title = 'แก้ไขใบสั่งซื้อ: '.$model->sale_no;
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sale_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sale-update">

    <?= $this->render('_form', [
        'model' => $model,
         'modelline' => $modelline,
    ]) ?>

</div>
