<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = 'แก้ไขผลิตภัณฑ์: '.$model->product_code." ".$model->name;
$this->params['breadcrumbs'][] = ['label' => 'ผลิตภัณฑ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelfile' => $modelfile,
        'imagelist' => $imagelist,
         'dataProvider' => $dataProvider,
         'dataProvider2' => $dataProvider2,
         'dataProvider3' => $dataProvider3,
         'searchModel3'=>$searchModel3 ,
                'model_trans' => $model_trans,
                'minline' => $minline,
                'modelagentprice'=>$modelagentprice,
                'bundleline' =>$bundleline,
    ]) ?>

</div>
