<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Productmodel */

$this->title = 'สร้างรุ่นสินค้า';
$this->params['breadcrumbs'][] = ['label' => 'รุ่นสินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productmodel-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
