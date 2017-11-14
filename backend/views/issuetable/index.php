<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\IssuetableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบเติมสินค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="issuetable-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
           <div>
            <?= Html::a('<i class="fa fa-plus-circle"></i> สร้างใบเติมสินค้า', ['create'], ['class' => 'btn btn-success']) ?>
            <div class="btn-group pull-right" style="bottom: 10px">
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
      </div>
      </div>
      </div>
      <div class="panel-body">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'issue_no',
            [
               'attribute'=>'request_by',
               'format' => 'html',
               'value'=>function($data){
                  return \backend\models\User::findUserName($data->request_by);
               }
             ],
             [
               'attribute'=>'require_date',
               'format' => 'html',
               'value'=>function($data){
                  return date('d-m-Y',$data->require_date);
               }
             ],
            'description',
            [
               'attribute'=>'status',
               'format' => 'html',
               'value'=>function($data){
                  if($data->status == 1){
                    return '<div class="label label-success">'.\backend\helpers\IssueStatus::getTypeById($data->status).'</div>';
                  }else if($data->status == 2){
                    return '<div class="label label-primary">'.\backend\helpers\IssueStatus::getTypeById($data->status).'</div>';
                  }
                 
               }
             ],
            //'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            [
                        'label' => 'Action',
                        'format' => 'raw',
                        'value' => function($model){
                                return '
                                    <div class="btn-group" >
                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                                        <ul class="dropdown-menu" style="right: 0; left: auto;">
                                        <li><a href="'.Url::toRoute(['/issuetable/view', 'id'=>$model->id]).'">'.'View'.'</a></li>
                                        <li><a href="'.Url::toRoute(['/issuetable/update', 'id'=>$model->id]).'">'.'Update'.'</a></li>
                                        <li><a onclick="return confirm(\'Confirm ?\')" href="'.Url::to(['/issuetable/delete', 'id'=>$model->id],true).'">Delete</a></li>
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
    </div>
  </div>
  </div>
  </div>
    <?php Pjax::end(); ?>
</div>
