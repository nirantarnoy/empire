<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Transaction */

$this->title = 'แก้ไขรายการ' .$model->transno;
$this->params['breadcrumbs'][] = ['label' => 'บันทึกรายการประจำวัน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->transno, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transaction-update">

    <?= $this->render('_form', [
        'model' => $model,
        'status' => $status,
         'expendlist' => $expendlist,
          'model_line' => $model_line,
    ]) ?>

</div>
