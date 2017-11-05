<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Sale */

$this->title = 'สร้างใบสั่งซื้อ';
$this->params['breadcrumbs'][] = ['label' => 'ใบสั่ง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-create">

    <?= $this->render('_form', [
        'model' => $model,
        'runno' => $runno,
    ]) ?>

</div>
