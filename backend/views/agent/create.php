<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Agent */

$this->title = 'สร้างตัวแทน';
$this->params['breadcrumbs'][] = ['label' => 'ตัวแทน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
