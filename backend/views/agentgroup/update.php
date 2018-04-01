<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AgentGroup */

$this->title = 'แก้ไขกลุ่มตัวแทน: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'กลุ่มตัวแทน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="agent-group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
