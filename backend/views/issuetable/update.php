<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Issuetable */

$this->title = 'แก้ไขใบเติมสินค้า:'.$model->issue_no;
$this->params['breadcrumbs'][] = ['label' => 'ใบเติมสินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->issue_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="issuetable-update">

    <?= $this->render('_form', [
        'model' => $model,
        'status' => $status,
        'modelline' => $modelline,
    ]) ?>

</div>
