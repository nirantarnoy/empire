<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\assets\ICheckAsset;
 $this->title = "ใบเติมสินค้าอนุมัติ";
 ?>

  <div class="row">
    <div class="col-lg-12">
      <?php
      $session = Yii::$app->session;
       if(!empty($session->getFlash("success"))):?>
      <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php echo $session->getFlash('success'); ?>
      </div>
    <?php endif;?>
    <?php if(!empty($session->getFlash("error"))):?>
    <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php echo $session->getFlash('error'); ?>
      </div>
    <?php endif;?>
    </div>
   </div>
<?php Pjax::begin(); ?>
 <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'id'=>'grid-issue',
                    //'filterModel' => $searchModel,
                    'columns' => [
                      
                        ['class' => 'yii\grid\SerialColumn'],
                        
                        //'id',
                        //'product_id',
                        [
                            'attribute'=>'issue_no',
                            'value' => function($data){
                                return $data->issue_no;
                            }
                        ],
                        [
                            'attribute'=>'require_date',
                            'value' => function($data){
                                return date('d-m-Y',$data->require_date);
                            }
                        ],
                         [
                            'attribute'=>'created_at',
                            'value' => function($data){
                                return date('d-m-Y',$data->created_at);
                            }
                        ],
                         [
                            'attribute'=>'created_by',
                            'value' => function($data){
                                return $data->created_by;
                            }
                        ],
                        //'qty',
                        
                       // 'status',
                        //'created_at',
                        //'updated_at',
                        //'created_by',
                        //'updated_by',

                        [
						  'class' => 'yii\grid\ActionColumn',
						  'buttonOptions'=>['class'=>'btn btn-default'],
						  'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {transissue} </div>',
						  'buttons'=>[
						  			'transissue'=>function($url,$data,$key){
						  				return Html::a('<i class="glyphicon glyphicon-edit"></i>',$url,['class'=>'btn btn-default']);
						  			}
						  ]
						],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
            </div>
            
        </div>
    </div>