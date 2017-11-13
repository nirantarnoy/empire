<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Customertype */

$this->title = 'สร้างประเภทลูกค้า';
$this->params['breadcrumbs'][] = ['label' => 'Customertypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customertype-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
