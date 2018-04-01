<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AgentGroup */

$this->title = 'สร้างกลุ่มตัวแทน';
$this->params['breadcrumbs'][] = ['label' => 'กลุ่มตัวแทน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-group-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
