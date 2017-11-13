<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Issuetable */

$this->title = 'สร้างใบเติมสินค้า';
$this->params['breadcrumbs'][] = ['label' => 'ใบเตืมสินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="issuetable-create">

    <?= $this->render('_form', [
        'model' => $model,
        'runno' => $runno,
        'status' => $status,

    ]) ?>

</div>
