<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Agent */

$this->title = 'แก้ไขตัวแทน: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'ตัวแทน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="agent-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
