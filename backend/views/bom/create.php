<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Bom */

$this->title = 'สร้างสินค้าจัดชุด';
$this->params['breadcrumbs'][] = ['label' => 'สินค้าจัดชุด', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bom-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
