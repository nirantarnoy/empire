<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Market */

$this->title = 'สร้างตลาด';
$this->params['breadcrumbs'][] = ['label' => 'ตลาด', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="market-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
