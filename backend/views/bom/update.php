<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Bom */

$this->title = 'แก้ไขสินค้าจัดชุด:'.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'สินค้าจัดชุด', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bom-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
