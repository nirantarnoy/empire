<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AgentPrice */

$this->title = 'สร้างราคาตัวแทน';
$this->params['breadcrumbs'][] = ['label' => 'ราคาตัวแทน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-price-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
