<?php
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
 ?>
<div class="row">
	<div class="col-lg-12">
		<?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'id'=>'product-grid',
        'pjax' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            //'id',
            'product_code',
            'name',
            'description',
            //'photo',
              [
               'attribute'=>'category_id',
               'format' => 'html',
               'value'=>function($data){
                 return $data->category_id !== Null ? \backend\models\Category::getCategorycode($data->category_id):'';
               }
             ],
            // 'weight',
            // 'unit_id',
            // 'price',
            // 'status',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
           //  [
           //     'attribute'=>'qty',
           //     'format' => 'html',
           //     'value'=>function($data){
           //       return number_format($data->qty);
           //     }
           //   ],
           //    [
           //     'attribute'=>'cost',
           //     'format' => 'html',
           //     'value'=>function($data){
           //       return number_format($data->cost);
           //     }
           //   ],
              [
               'attribute'=>'price',
               'format' => 'html',
               'value'=>function($data){
                 return number_format($data->price);
               }
             ],
           // [
           //     'attribute'=>'status',
           //     'format' => 'html',
           //     'value'=>function($data){
           //       return $data->status === 1 ? '<div class="label label-success">Active</div>':'<div class="label label-default">Inactive</div>';
           //     }
           //   ],
        ],
    ]); ?>
	</div>
</div>