<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'บันทึกรายรายรับประจำวัน';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="transaction-index">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('สร้างรายการ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'transno',
            //'trans_type',
             [
                'attribute'=>'trans_type',
                'format'=>'html',
                'value'=> function($data){
                    return $data->trans_type ==1?'<div class="label label-danger">จ่าย</div>':'<div class="label label-success">รับ</div>';
                }
            ],
            [
                'attribute'=>'transdate',
                'value'=> function($data){
                    return date('d-m-Y',$data->transdate);
                }
            ],
            [
                'label'=>'จำนวนเงิน',
                'value'=> function($data){
                    return number_format($data->getSum($data->id));
                }
            ],
            
           //'status',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

           [
                        'label' => 'Action',
                        'format' => 'raw',
                        'value' => function($model){
                                return '
                                    <div class="btn-group" >
                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                                        <ul class="dropdown-menu" style="right: 0; left: auto;">
                                        <li><a href="'.Url::toRoute(['/transaction/view', 'id'=>$model->id]).'">'.'View'.'</a></li>
                                        <li><a href="'.Url::toRoute(['/transaction/update', 'id'=>$model->id]).'">'.'Update'.'</a></li>
                                        <li><a onclick="return confirm(\'Confirm ?\')" href="'.Url::to(['/transaction/delete', 'id'=>$model->id],true).'">Delete</a></li>
                                        </ul>
                                    </div>
                                ';
                            // }
                        },
                        'headerOptions'=>['class'=>'text-center'],
                        'contentOptions' => ['class'=>'text-center','style'=>'vertical-align: middle','text-align: center'],

                    ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
