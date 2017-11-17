<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Task */

$this->title = 'แก้ไขรายการแจ้งเตือน: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'รายการแจ้งเตือน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
