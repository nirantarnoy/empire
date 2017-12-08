<?php
use yii\helpers\Html;
?>
<div class="row">
	<div class="col-lg-12">	
		<div class="form-inline">
			<h3>รายงานใบเบิกสารเคมี</h3> <small>วันที่ <?=$from_date?>   ถึงวันที่  <?=$to_date?>  </small>
		</div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-lg-12">
		<table class="table table-striped table-bordered" style="width: 100%">
			<thead>
				<tr>
					<td>ลำดับ</td>
					<td>รายละเอียดเคมี</td>
					<td>จำนวนเบิก</td>
					<td>จำนวนคืน</td>
					<td>หน่วย</td>
				</tr>
			</thead>
			<tbody>
				<?php for($i=0;$i<=count($list)-1;$i++): ?>
					<tr>
					<td><?=$i+1;?></td>
					<td><?=$list[$i]['chemical_name']?></td>
					<td><?=$list[$i]['qty']?></td>
					<td><?=$list[$i]['return_qty']==''?0:$list[$i]['return_qty']?></td>
					<td><?=$list[$i]['unit_name']?></td>
				   </tr>
				<?php endfor; ?>
			</tbody>	
		</table>
	</div>
</div>


