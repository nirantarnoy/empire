<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Productmodel */

$this->title = 'แก้ไขรุ่นสิน้า: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Productmodels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="productmodel-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
