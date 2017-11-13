<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Issuetable */

$this->title = 'Update Issuetable: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Issuetables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="issuetable-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
