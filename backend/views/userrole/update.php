<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Userrole */

$this->title = 'แก้ไขสิทธิ์การใช้งาน';
$this->params['breadcrumbs'][] = ['label' => 'สิทธิ์การใช้งาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="userrole-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
