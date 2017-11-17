<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Task */

$this->title = 'สร้างรายการแจ้งเตือน';
$this->params['breadcrumbs'][] = ['label' => 'รายการแจ้งเตือน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
