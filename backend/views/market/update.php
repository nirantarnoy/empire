<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Market */

$this->title = 'แก้ไขตลาด: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'ตลาด', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="market-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
