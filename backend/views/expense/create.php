<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Expense */

$this->title = 'สร้างค่าใช้จ่าย';
$this->params['breadcrumbs'][] = ['label' => 'ค่าใช้จ่าย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expense-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
