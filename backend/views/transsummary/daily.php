<?php
use kartik\date\DatePicker;
use yii\helpers\Url;

$this->title = 'สรุปยอดประจำวัน' ;
$Cdate = date('d-m-Y');
if($cdate !=''){
	$Cdate = $cdate;
}

?>
<div class="row">
	<div class="col-lg-12">
		<form id="form-daily" class="form-inline" action="<?=Url::to(['transsummary/dailyreport'],true)?>" method="post">
			<span>วันที่ </span>
            <?= DatePicker::widget([
                'name' => 'Cdate',
                'value' => $Cdate,
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'readonly' => false,
                'layout' => '{picker}{input}',
                'options' => [
                    'id' => 'sdate',
                    'placeholder' => 'วันที่เริ่ม',
                    'autocomplete' => 'on',
                    'onchange'=>'
                    	$("form#form-daily").submit();
                    '
                ],
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ]
            ]); ?>
		</form>
		 
	</div>
</div>
<br />
<div class="row">
	<div class="col-lg-12">
		<div class="panel">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr style="background-color: #CCC">
							<td style="text-align: center;"><b>พนักงาน</b></td>
							<td colspan="4" style="text-align: center;"><b>รายได้</b></td>
							<td colspan="4" style="text-align: center;"><b>รายจ่ายอื่นๆ</b></td>
							<td style="text-align: center;"><b>ตลาด</b></td>
							<td style="text-align: center;"><b>ต้นทุน</b></td>
							<td style="text-align: center;"><b>ยอดคิด%</b></td>
						</tr>
						<tr style="background-color: #CCC">
							<td style="text-align: center;"></td>
							<td style="text-align: center;">ยอดขายเต็ม</td>
							<td style="text-align: center;">ทุนบุหรี่</td>
							<td style="text-align: center;">รายได้</td>
							<td style="text-align: center;">เงินสดรับ</td>
							<td style="text-align: center;">ที่</td>
							<td style="text-align: center;">รถ</td>
							<td style="text-align: center;">เด็ก</td>
							<td style="text-align: center;">อื่นๆ</td>
							<td style="text-align: center;"></td>
							<td style="text-align: center;"></td>
							<td style="text-align: center;"></td>
						</tr>
						<?php
							$sum1 = 0;
							$sum2 = 0;
							$sum3 = 0;
							$sum4 = 0;
						 ?>
						<?php foreach($model as $value):?>
						<?php
							$sum1 += $value->amount;
							$sum2 += 0;
							$sum3 += $value->amount;
							$sum4 += $value->amount;
						 ?>
						<tr>
							<td style="text-align: center;"><?=$value->first_name?></td>
							<td style="text-align: center;"><?=$value->amount!=''?$value->amount:'0'?></td>
							<td style="text-align: center;">0</td>
							<td style="text-align: center;"><?=$value->amount!=''?$value->amount:'0'?></td>
							<td style="text-align: center;"><?=$value->amount!=''?$value->amount - $value->expense_amount_1 - $value->expense_amount_2 - $value->expense_amount_3 - $value->expense_amount_4 :'0'?></td>
							<td style="text-align: center;"><?=$value->expense_amount_1!=''?$value->expense_amount_1:'0'?></td>
							<td style="text-align: center;"><?=$value->expense_amount_2!=''?$value->expense_amount_2:'0'?></td>
							<td style="text-align: center;"><?=$value->expense_amount_3!=''?$value->expense_amount_3:'0'?></td>
							<td style="text-align: center;"><?=$value->expense_amount_4!=''?$value->expense_amount_4:'0'?></td>
							<td style="text-align: center;"><?=$value->market_name?></td>
							<td style="text-align: center;">0</td>
							<td style="text-align: center;">0</td>
						</tr>
						<?php endforeach;?>
						<tr style="background-color: #CCC">
							<td style="text-align: center;"><b>รวม</b></td>
							<td style="text-align: center;"><b><?=$sum1?></b></td>
							<td style="text-align: center;"><b>0</b></td>
							<td style="text-align: center;"><b><?=$sum3?></b></td>
							<td style="text-align: center;"><b><?=$sum4?></b></td>
							<td style="text-align: center;"><b>0</b></td>
							<td style="text-align: center;"><b>0</b></td>
							<td style="text-align: center;"><b>0</b></td>
							<td style="text-align: center;"><b>0</b></td>
							<td style="text-align: center;"></td>
							<td style="text-align: center;"><b>0</b></td>
							<td style="text-align: center;"></td>
						</tr>
					</table>
				</div>
				
			</div>
		</div>
		
	</div>
</div>