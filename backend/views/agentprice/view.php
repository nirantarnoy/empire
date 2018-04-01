<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AgentPrice */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ราคาตัวแทน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-price-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'agent_id',
            'product_id',
            'min',
            'max',
            'price',
            'promotion_start_date',
            'promotion_expire_date',
            'status',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
