<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Sale */

$this->title = 'แก้ไขใบขาย: '.$model->sale_no;
$this->params['breadcrumbs'][] = ['label' => 'ใบขาย', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sale_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sale-update">

    <?= $this->render('_form', [
        'model' => $model,
         'modelline' => $modelline,
    ]) ?>

</div>
