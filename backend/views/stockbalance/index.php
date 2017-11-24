<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\assets\ICheckAsset;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\StockbalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
ICheckAsset::register($this);

$this->title = 'สินค้าคงคลัง';
$this->params['breadcrumbs'][] = $this->title;


$this->registerJsFile(
    '@web/js/stockbalancejs.js',
    ['depends' => [\yii\web\JqueryAsset::className()]],
    static::POS_END
);

?>
<div class="stockbalance-index">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create Stockbalance', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="row">
        <div class="col-lg-12">
            <div class="btn btn-default btn-trasfer"><i class="fa fa-"></i> โอนสินค้า</div>
            <div class="btn-group pull-right" style="bottom: 10px">
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
      </div>
        </div>
    </div><br />


    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'id'=>'grid-stock',
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\CheckboxColumn',
                          //'headerOptions'=>['class'=>'text-center'],
                        ],
                        ['class' => 'yii\grid\SerialColumn'],
                        
                        //'id',
                        //'product_id',
                        [
                            'attribute'=>'product_id',
                            'format'=>'html',
                            'value' => function($data){
                                return "<a href='index.php?r=product/update&id=$data->product_id'>".\backend\models\Product::getProdCode($data->product_id)."</a>";
                            }
                        ],
                        [
                            'label'=>'ชื่อสินค้า',
                            'value' => function($data){
                                return \backend\models\Product::getProdname($data->product_id);
                            }
                        ],
                        [
                            'attribute'=>'warehouse_id',
                            'value' => function($data){
                                return \backend\models\Warehouse::findName($data->warehouse_id);
                            }
                        ],
                        'qty',
                        
                       // 'status',
                        //'created_at',
                        //'updated_at',
                        //'created_by',
                        //'updated_by',

                        //['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
            </div>
            
        </div>
    </div>
    <div class="row">
    <div class="col-lg-3">
      <form id="form-perpage" class="form-inline" action="<?=Url::to(['stockbalance/index'],true)?>" method="post">
        <div class="form-group">
         <label>จำนวนรายการ</label>
          <select class="form-control" name="perpage" id="perpage">
             <option value="20" <?=$perpage=='20'?'selected':''?>>20</option>
             <option value="50" <?=$perpage=='50'?'selected':''?> >50</option>
             <option value="100" <?=$perpage=='100'?'selected':''?>>100</option>
          </select>
      </div>
      </form>
      
    </div>
    
</div>
<?php 
$url_to_transfer = \yii\helpers\Url::to(['/stockbalance/transfer'],true);
$this->registerJs('
     $("#perpage").change(function(){
          $("#form-perpage").submit();
      });
        $(".btn-trasfer").click(function(){
            var keys = $("#grid-stock").yiiGridView("getSelectedRows");
            if(keys.length > 0){
               // alert();
                $.ajax({
                    type: "post",
                    dataType: "html",
                    url: "'.$url_to_transfer.'",
                    data:{id: keys},
                    success: function(data){
                        alert(data);
                    }
                });
            }
        });
    ');?>