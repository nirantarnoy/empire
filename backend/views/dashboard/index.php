<?php
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use yii\helpers\Html;
$this->title = 'ภาพรวมระบบ';


$js = <<<JS
    $(document).ready(function () {
        

        $('#searchbutton').click(function (e) {
            e.preventDefault();
            if($('#sdate').val() > $('#edate').val()){
                alert('วันที่เริ่มค้นหาห้ามน้อยกว่าวันที่สิ้นสุด');
            }else{
                $('#searchdate').submit();
            }
        })
    });
JS;
$this->registerJs($js, static::POS_END);
if ($Sdate === '' && $Edate === '') {
    $Sdate = date('Y-m-d');
    $Edate = date('Y-m-d');
}
$session = Yii::$app->session;
$session->open();
if(isset($session['attributes']['picture'])){
	print_r($session['attributes']['picture']);
}


?>
<div class="row">
    <div class="col-lg-12">
        <!-- <div class="callout callout-default">
          <h4>Preventive maintenence Dashboard</h4>
          <!-- <p>แสดงภาพรวมของระบบกิจกรรม PM ของฝ่ายวิศวกรรม</p> -->
        <!-- </div>  -->
        <div class="pull-left">
            <!-- <h4>Preventive Maintenence Infomation Dashboard</h4> -->
            <div id="show_date_scope" style="display: none"><h4 class="label label-primary" style=" font-size: large">
                    แสดงข้อมูลระหว่างวันที่ <?php echo date('d-m-Y', strtotime($Sdate)) ?>
                    จนถึงวันที่ <?php echo date('d-m-Y', strtotime($Edate)) ?></h4></div>
        </div>
        <div class="pull-right">
            <?php $form = ActiveForm::begin(['id' => 'searchdate', 'type' => ActiveForm::TYPE_INLINE, 'action' => 'index.php?r=dashboard/index']); ?>

            <?= DatePicker::widget([
                'name' => 'Startdate',
                'value' => $Sdate,
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'readonly' => true,
                'layout' => '{picker}{input}',
                'options' => [
                    'id' => 'sdate',
                    'placeholder' => 'วันที่เริ่ม',
                    'autocomplete' => 'off'
                ],
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>
            <?= DatePicker::widget([
                'name' => 'Enddate',
                'value' => $Edate,
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'readonly' => true,
                'options' => [
                    'id' => 'edate',
                    'placeholder' => 'วันที่สิ้นสุด',
                    'autocomplete' => 'off'
                ],
                'layout' => '{picker}{input}',
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>
            <?= Html::submitButton('ค้นหา', ['id' => 'searchbutton', 'class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<br/>
<div class="row">
	<div class="col-lg-12">
						<div class="row">
					        <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box bg-aqua">
					            <div class="inner">
					              <h3><?=number_format($model_sum_sale)?></h3>

					              <p>มูลค่าขาย</p>
					            </div> 
					            <div class="icon">
					              <i class="fa fa-money"></i>
					            </div>
					            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					          </div>
					          
					      </div>
					      <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box bg-yellow">
					            <div class="inner">
					              <h3><?=number_format($model_balance)?></h3>

					              <p>มูลค่าคงคลัง</p>
					            </div> 
					            <div class="icon">
					              <i class="fa fa-money"></i>
					            </div>
					            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					          </div>
					          
					      </div>
					      <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box bg-green">
					            <div class="inner">
					              <h3><?=number_format($model_inventory)?></h3>

					              <p>จำนวนสินค้าทั้งหมด</p>
					            </div> 
					            <div class="icon">
					              <i class="fa fa-cubes"></i>
					            </div>
					            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					          </div>
					          
					      </div>
		
	</div>

</div>
</div>
<div class="row">
	<div class="col-lg-8">
		<div class="box box-info direct-chat direct-chat-info">
					<div class="box-header with-border">
						<div class="box-title">ยอดขาย</div>
					</div>
					<div class="box-body">
							<div class="box-body chart-responsive">
                               <?php

                                    $month = ['Jan', 'Feb', 'Mar', 'Apl', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                                    $titlename = ['ยอดขาย'];

                                    $data1 = [];
                                   
                                    //for ($i = 1; $i <= 7; $i++) {
                                        for ($l = 1; $l <= 12; $l++) {
                                        	$month_x = strtotime(date('d-m-Y'));
                                         	$year_x = strtotime(date('d-m-Y'));

                                         	$months = date('m',$month_x);
											$year = date('Y',$year_x);
     
                                            //if ($l == 1) {
                                            	$m = \backend\models\Sale::getSaleAmt($l);
                                                array_push($data1,(int)$m);
                                           // }
                                        }
                                   // }
                                        $data1x = ['name'=>'Jan','data'=>10];
                                    // echo var_dump($data1);
                                    //  $dataamt = $jobqty;
                                    //var_dump($jobqty);
                                    echo Highcharts::widget([
                                        'options' => [
                                            'title' => ['text' => ''],
                                            'xAxis' => [
                                                'categories' => $month,
                                                'title'=> false,
                                            ],
                                            'yAxis' => [
                                                'title' => ['text' => 'ยอดขาย']
                                            ],
                                            'series' =>[ 
                                                 ['name' => $titlename[0],'data' => $data1],
                                           ],
                                            'legend'=>[
                                            	'enabled'=> false,
                                            ],
                                            'credits' => ['enabled' => false],
                                            'chart' => [
                                                'type' => 'line',
                                            ],
                                        ]
                                    ]);
                                    ?>
                                </div><!-- /.box-body -->
					</div>
				</div>
	</div>
	<div class="col-lg-4">
				<div class="box box-warning direct-chat direct-chat-warning">
					<div class="box-header with-border">
						<div class="box-title">สินค้าขายดี</div>
					</div>
					<div class="box-body">
						<?php
							$data = [];
							 $titlename = ['All', 'Closed',];
						    if(count($model_best)>0){
						    	foreach($model_best as $value){
						    		array_push($data, [$value->name,$value->sale_qty]);
						    	}
						    }
			               // print_r($data);
			               // $dataamt = [['Open', 1], ['Closed', 2]];
			                // print_r($dataamt);
			                // print_r($data);
			                echo Highcharts::widget([
			                    'options' => [
			                        'title' => ['text' => ''],
			                        'xAxis' => [
			                            'categories' => $titlename
			                        ],
			                        'yAxis' => [
			                            'title' => ['text' => 'สินค้าขายดี']
			                        ],
			                        'series' => [
			                            ['name' => 'Best seller', 'data' => $data ],

			                        ],
			                        'colors' => ['#66CC00', '#2F4F4F', '#8bbc21', '#1aadce', '#FF6633'],
			                        'credits' => ['enabled' => false],
			                        'chart' => [
			                            'type' => 'pie',
			                            'options3d' => [
			                                'enabled' => 'true',
			                                'alpha' => 45,
			                            ],
			                        ],
			                        'tooltip' => [
			                            'pointFormat' => '{series.name}: <b>{point.percentage:.1f}%</b>'
			                        ],
			                        'plotOptions' => [
			                            'pie' => [
			                                'allowPointSelect' => true,
			                                'cursor' => 'pointer',
			                                'dataLabels' => [
			                                    'enabled' => false,
			                                    'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
			                                    'style' => [
			                                       // 'color'=> (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			                                    ]
			                                ],
			                                'showInLegend' => true
			                            ]
			                        ],
			                    ]
			                ]);
			                ?>
					</div>
				</div>
			</div>
</div><br />
<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-danger direct-chat direct-chat-danger">
					<div class="box-header with-border">
						<div class="box-title">สินค้าใกล้หมด</div>
					</div>
					<div class="box-body">
						<?= GridView::widget([
						        'dataProvider' => $model_under_stock,
						        //'filterModel' => $searchModel,
						        'columns' => [
						            ['class' => 'yii\grid\SerialColumn'],

						            //'id',
						            'name',
						            'description',
						            [
						               'attribute'=>'status',
						               'format' => 'html',
						               'value'=>function($data){
						                 return $data->status === 1 ? '<div class="label label-success">Active</div>':'<div class="label label-default">Inactive</div>';
						               }
						             ],
						             'qty',
						             'min_qty',
						            //'created_at',
						            // 'updated_at',
						            // 'created_by',
						            // 'updated_by',

						          
						        ],
						    ]); ?>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>

