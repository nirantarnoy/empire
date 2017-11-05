<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Customertype */

$this->title = 'แก้ไขประเภทลูกค้า: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'ประเภทลูกค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customertype-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
