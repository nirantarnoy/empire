<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model backend\models\Warehouse */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'คลังสินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-view">
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

    <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">ข้อมูลคลังสินค้า</a></li>
              <li><a href="#tab_2" data-toggle="tab">สินค้าคงคลัง</a></li>
             
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                     <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                         //   'id',
                            'name',
                            'description',
                            'is_default',
                            'status',
                            'created_at',
                            // 'updated_at',
                            // 'created_by',
                            // 'updated_by',
                        ],
                    ]) ?>

              </div>
               <div class="tab-pane" id="tab_2">
                    <div class="row">
                          <div class="col-lg-12">
                              <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                   // 'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                       // 'id',
                                        //'warehouse_id',
                                        [
                                          'attribute'=>'product_id',
                                          'format' => 'html',
                                          'value'=> function($data){
                                            $code = $data->product_id!=''?\backend\models\Product::getProdCode($data->product_id):'';
                                            return "<a href='index.php?r=product/update&id=$data->product_id'>".$code."</a>";
                                          }
                                        ],
                                       [
                                          'attribute'=>'product_id',
                                          'value'=> function($data){
                                            return $data->product_id!=''?\backend\models\Product::getProdName($data->product_id):'';
                                          }
                                        ],
                                        [
                                          'attribute'=>'qty',
                                          'headerOptions'=>['style'=>'text-align: right;'],
                                          'contentOptions'=>['style'=>'text-align: right;'],
                                          'value'=> function($data){
                                            return number_format($data->qty);
                                          }
                                        ],
                                        [
                                        'attribute'=>'updated_at',
                                        'label' => 'อัพเดทล่าสุด',
                                          'value' => function($data){
                                            return date('d-m-Y',$data->updated_at);
                                          }
                                        ]
                                   
                                    ],
                                ]); ?>
                          </div>
                        </div>
              </div>
          </div>
      </div>

    
   
</div>
