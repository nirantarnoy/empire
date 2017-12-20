<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Transaction */

$this->title = 'สร้างรายการ';
$this->params['breadcrumbs'][] = ['label' => 'บันทึกรายการประจำวัน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-create">
    <?= $this->render('_form', [
        'model' => $model,
         'runno' => $runno,
         'status' => $status,
         'expendlist' => $expendlist,
    ]) ?>

</div>
