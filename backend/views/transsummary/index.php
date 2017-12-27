<?php
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use yii\helpers\Html;

$this->title = "สรุปรายรับ รายจ่าย";

$js = <<<JS
    // $(document).ready(function () {
    
    //     $('#searchbutton').click(function (e) {
    //         e.preventDefault();
    //         if($('#sdate').val() > $('#edate').val()){
    //             alert('วันที่เริ่มค้นหาห้ามน้อยกว่าวันที่สิ้นสุด');
    //         }else{
    //             $('#searchdate').submit();
    //         }
    //     })
    // });
JS;
$this->registerJs($js, static::POS_END);
if ($Sdate=='01-01-1970') {
    $Sdate = date('d-m-Y');
    $Edate = date('d-m-Y');
}
//echo date($Sdate);

 ?>
<div class="row">
	<div class="col-lg-12">
						
 <div class="row">
 	<div class="col-lg-12">
 		<div class="row">

 		</div>
 		<div class="row">
 			<div class="col-lg-3">
 				<div class="row">
 					<div class="col-lg-12">
 						<div class="info-box">
			            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

			            <div class="info-box-content">
			              <span class="info-box-text"><h4>รายรับ</h4></span>
			              <span class="info-box-number"><?=number_format($income)?></span>
			            </div>
			            <!-- /.info-box-content -->
			          </div>
			          <!-- /.info-box -->
 					</div>
 				</div>
 				<div class="row">
 					<div class="col-lg-12">
 						<div class="info-box">
			            <span class="info-box-icon bg-yellow"><i class="fa fa-shopping-cart"></i></span>

			            <div class="info-box-content">
			              <span class="info-box-text"><h4>รายจ่าย</h4></span>
			              <span class="info-box-number"><?=number_format($expense + $purch + $expense2 + $expense3 + $expense4 + $emp_amount)?></span>
			            </div>
			            <!-- /.info-box-content -->
			          </div>
			          <!-- /.info-box -->
 					</div>
 				</div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text"><h4>คงเหลือ</h4></span>
                          <span class="info-box-number"><?=number_format($income - ($expense + $purch + $expense2 + $expense3 + $expense4 + $emp_amount))?></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                </div>
	 			</div>
 			<div class="col-lg-9">
 				<div class="row">
    <div class="col-lg-12">
        <!-- <div class="callout callout-default">
          <h4>Preventive maintenence Dashboard</h4>
          <!-- <p>แสดงภาพรวมของระบบกิจกรรม PM ของฝ่ายวิศวกรรม</p> -->
        <!-- </div>  -->
        
        <div class="pull-right">
         
            <?php $form = ActiveForm::begin(['id' => 'searchdate', 'type' => ActiveForm::TYPE_INLINE, 'action' => 'index.php?r=transsummary/index','method'=>'get']); ?>
            <span>วันที่ </span>
            <?= DatePicker::widget([
                'name' => 'Startdate',
                'value' => $Sdate,
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'readonly' => false,
                'layout' => '{picker}{input}',
                'options' => [
                    'id' => 'sdate',
                    'placeholder' => 'วันที่เริ่ม',
                    'autocomplete' => 'on'
                ],
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ]
            ]); ?>
            <?= DatePicker::widget([
                'name' => 'Enddate',
                'value' => $Edate,
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'readonly' => false,
                'options' => [
                    'id' => 'edate',
                    'placeholder' => 'วันที่สิ้นสุด',
                    'autocomplete' => 'off'
                ],
                'layout' => '{picker}{input}',
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ]
            ]); ?>
            <?= Html::submitButton('ค้นหา', ['id' => 'searchbutton', 'class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div> <br />
 				<div class="row">
 					<div class="col-lg-12">
 						<div class="panel">
 					<div class="panel-body">
 					<?= GridView::widget([
				        'dataProvider' => $dataProvider,
				       // 'filterModel' => $searchModel,
				        'columns' => [
				            ['class' => 'yii\grid\SerialColumn'],
				           // 'id',
				            //'name',
				            [
				            	'attribute'=>'created_at',
				            	'label' => 'วันที่',
				            	'value' => function($data){
				            		return $data->created_at;
				            	}
				            ],
				             [
				            	'attribute'=>'in_amount',
                                'headerOptions'=>['style'=>'text-align: right;'],
                                'contentOptions'=>['style'=>'text-align: right;'],
				            	'label' => 'รายรับ',
				            	'value' => function($data){
				            		return number_format($data->income_amount);
				            	}
				            ],
				             [
				            	'attribute'=>'out_amount',
                                 'headerOptions'=>['style'=>'text-align: right;'],
                                'contentOptions'=>['style'=>'text-align: right;'],
				            	'label' => 'รายจ่าย',
				            	'value' => function($data){
                                    $emp_amount_line = 0;
                                    if($data->emp_amount !=''){
                                        if($data->emp_amount < 250){
                                            $emp_amount_line = 250;
                                        }else{
                                            $emp_amount_line = $data->emp_amount;
                                        }
                                    }
				            		return number_format($data->purchase_amount + $data->expense_amount_1 + $data->expense_amount_2 + $data->expense_amount_3 + $data->expense_amount_4  + $emp_amount_line);
				            	}
				            ],
                              [
                                //'attribute'=>'out_amount',
                                'label' => 'คงเหลือ',
                                 'headerOptions'=>['style'=>'text-align: right;'],
                                'contentOptions'=>['style'=>'text-align: right;'],
                                'value' => function($data){
                                    $emp_amount_line = 0;
                                    if($data->emp_amount !=''){
                                        if($data->emp_amount < 250){
                                            $emp_amount_line = 250;
                                        }else{
                                            $emp_amount_line = $data->emp_amount;
                                        }
                                    }
                                    return number_format($data->income_amount - ($data->purchase_amount + $data->expense_amount_1 + $data->expense_amount_2 + $data->expense_amount_3 + $data->expense_amount_4  + $emp_amount_line));
                                }
                            ],
				            //'description',
				            //'menu_type_id',
				            //'status',
				            //'created_at',
				            //'updated_at',
				            //'created_by',
				            //'updated_by',
				            //'sub_number',

				         //   ['class' => 'yii\grid\ActionColumn'],
				        ],
				    ]); ?>
 				</div>
 				</div>
 					</div>
 				</div>
 				
 			</div>
 		</div>
 	</div>
 </div>


