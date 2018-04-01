<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AgentPrice */

$this->title = 'แก้ไขราคาตัวแทน:'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'ราคาตัวแทน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="agent-price-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
