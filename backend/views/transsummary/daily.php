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
				<div class="table">
					<table class="table table-bordered">
						<tr style="background-color: #CCC">
							<td rowspan="2" style="text-align: center;vertical-align: middle"><b>พนักงาน</b></td>
							<td colspan="4" style="text-align: center;"><b>รายได้</b></td>
							<td colspan="4" style="text-align: center;"><b>รายจ่ายอื่นๆ</b></td>
							<td rowspan="2" style="text-align: center;vertical-align: middle"><b>ตลาด</b></td>
							<td rowspan="2" style="text-align: center;vertical-align: middle"><b>ค่าคอมฯ</b></td>
				
							<td rowspan="2" style="text-align: center;vertical-align: middle"><b>ยอดคิด%</b></td>
						</tr>
						<tr style="background-color: #CCC">
							
							<td style="text-align: center;">ยอดขายเต็ม</td>
							<td style="text-align: center;">ทุนบุหรี่</td>
							<td style="text-align: center;">รายได้</td>
							<td style="text-align: center;">เงินสดรับ</td>
							<td style="text-align: center;">ที่</td>
							<td style="text-align: center;">รถ</td>
							<td style="text-align: center;">เด็ก</td>
							<td style="text-align: center;">อื่นๆ</td>
							<!-- <td style="text-align: center;"></td>
							<td style="text-align: center;"></td>
							<td style="text-align: center;"></td> -->
						</tr>
						<?php
							$sum1 = 0;
							$sum2 = 0;
							$sum3 = 0;
							$sum4 = 0;
							$expense1 = 0;
							$expense2 = 0;
							$expense3 = 0;
							$expense4 = 0;
							$sum_empamount = 0;
							$sum_center = 0;

						 ?>
						<?php foreach($model as $value):?>
						<?php

							$emp_amount_line = 0;
							if($value->emp_amount !=''){
								if($value->emp_amount < 250){
									$emp_amount_line = 250;
								}else{
									$emp_amount_line = $value->emp_amount;
								}
							}

							$sum_empamount += $emp_amount_line;

							$sum1 += $value->amount;
							$sum2 += $value->cost;
							$sum3 += $value->income_amount;
							$sum4 += $value->income_amount!=''?$value->income_amount - $value->expense_amount_1 - $value->expense_amount_2 - $value->expense_amount_3 - $value->expense_amount_4 - $value->purchase_amount - $emp_amount_line:'0';

							$expense1 += $value->expense_amount_1;
							$expense2 += $value->expense_amount_2;
							//$expense3 += $value->expense_amount_3;
							$expense3 += $value->expense_amount_3;
							$expense4 += $value->expense_amount_4;
							


							
						 ?>
						<tr>
							<td style="text-align: center;"><?=$value->first_name?></td>
							<td style="text-align: center;"><?=$value->amount!=''?number_format($value->amount):'0'?></td>
							<td style="text-align: center;"><?=$value->cost!=''?number_format($value->cost):'0'?></td>
							<td style="text-align: center;"><?=$value->income_amount!=''?number_format($value->income_amount):'0'?></td>
							<td style="text-align: center;"><?=$value->income_amount!=''?number_format($value->income_amount - $value->expense_amount_1 - $value->expense_amount_2 - $emp_amount_line - $value->expense_amount_3 - $value->expense_amount_4 -$value->purchase_amount) :'0'?></td>
							<td style="text-align: center;"><?=$value->expense_amount_1!=''?number_format($value->expense_amount_1):'0'?></td>
							<td style="text-align: center;"><?=$value->expense_amount_2!=''?number_format($value->expense_amount_2):'0'?></td>
							<td style="text-align: center;"><?=$value->expense_amount_3!=''?number_format($value->expense_amount_3):'0'?></td>
							<td style="text-align: center;"><?=$value->expense_amount_4!=''?number_format($value->expense_amount_4):'0'?></td>
							<td style="text-align: center;"><?=$value->market_name?></td>
							<td style="text-align: center;"><?=number_format($emp_amount_line) ?></td>
							<td style="text-align: center;"><?php //echo(number_format($value->income_amount - $value->expense_amount_1 - $value->expense_amount_2 - $value->expense_amount_3 - $value->expense_amount_4)-number_format($value->amount))/100?></td>
						</tr>
						<?php endforeach;?>
						<tr style="background-color: #CCC">
							<td style="text-align: center;"><b>รวม</b></td>
							<td style="text-align: center;"><b><?=number_format($sum1)?></b></td>
							<td style="text-align: center;"><b><?=number_format($sum2)?></b></td>
							<td style="text-align: center;"><b><?=number_format($sum3)?></b></td>
							<td style="text-align: center;"><b><?=number_format($sum4)?></b></td>
							<td style="text-align: center;"><b><?=number_format($expense1)?></b></td>
							<td style="text-align: center;"><b><?=number_format($expense2)?></b></td>
							<td style="text-align: center;"><b><?=number_format($expense3)?></b></td>
							<td style="text-align: center;"><b><?=number_format($expense4)?></b></td>
							<td style="text-align: center;"></td>
							<td style="text-align: center;"><b><?=number_format($sum_empamount)?></td>
							<td style="text-align: center;"></td>
						</tr>
					</table>
					<label>ค่าใช้จ่ายส่วนกลาง</label>
					<div class="row">
						<div class="col-lg-6">
							<table class="table table-bordered">
								<tr style="background-color: #ccc">
									<td>ชื่อรายจ่าย</td>
									<td>จำนวนเงิน</td>
								</tr>
								<?php if(count($center_expense)>0):?>
								    <?php foreach($center_expense as $value):?>
								    <?php $sum_center += $value->sum_amount ?>
								    <tr>
								    	<td><?=$value->title_name;?></td>
								    	<td><?=number_format($value->sum_amount);?></td>
								    </tr>
								    <?php endforeach;?>
								<?php endif;?>
							</table>
						</div>
						<div class="col-lg-3">
							<table class="table table-bordered">
								<tr >
									<td style="background-color: #ccc;text-align: right">เงินสดรับ</td>
									<td style="text-align: right"><b><?=number_format($sum4)?></b></td>
								</tr>
								<tr>
									<td style="background-color: #ccc;text-align: right">ค่าใช้จ่าย</td>
									<td style="text-align: right"><b><?=number_format($sum_center)?></b></td>
								</tr>
								<tr>
									<td style="background-color: #ccc;text-align: right">รายได้สุทธิ</td>
									<td style="text-align: right"><b><?=number_format($sum4 - $sum_center)?></b></td>
								</tr>
							</table>
						</div>
					</div>
					
				</div>
				
			</div>
		</div>
		
	</div>
</div>