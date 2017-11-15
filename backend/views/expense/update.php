<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Expense */

$this->title = 'แก้ไขค่าใช้ค่าย: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'ค่าใช้จ่าย', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expense-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
