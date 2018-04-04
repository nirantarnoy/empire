<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = 'สร้างรหัสผลิตภัณฑ์';
$this->params['breadcrumbs'][] = ['label' => 'รหัสผลิตภัณฑ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelfile' => $modelfile,
        'dataProvider3'=>$dataProvider3,
        'searchModel3'=>$searchModel3,
    ]) ?>

</div>
