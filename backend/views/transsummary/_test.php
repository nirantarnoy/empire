<?php
 $this->title = "สรุปยอดสินค้าทั้งหมด";
 ?>
 <div class="row">
 	<div class="col-lg-12">
 		<div class="panel">

 		<div class="panel-body">
 			<table class="table  table-bordered table-striped">
			 	<thead>
			 		<tr>
			 			<th colspan="4" style="text-align: center;">สรุปมูลค่าสินค้าทั้งหมด</th>
			 		<!-- 	<th></th>
			 			<th></th>
			 			<th></th> -->
			 			<?php foreach($model_wh as $value2):?>
			 				 
			 						<th style="padding-left: 50px;text-align: center;"><?=$value2->warhouse_name?></th>

			 				<?php endforeach;?>
			 		</tr>
			 		<tr>
			 			<th>รหัสสินค้า</th>
			 			<th>ชื่อสินค้า</th>
			 			<th>จำนวนรวม</th>
			 			<th>มูลค่ารวม</th>
			 			<?php foreach($model_wh as $value2):?>
				 			<th>
				 				<table width="100%">
			 				 	<tr>
			 				 		<td style="width: 50%;text-align: right;">จำนวน</td>
			 				 		<td style="width: 50%;text-align: right;">ราคารวม</td>
			 				 	</tr>
			 				 </table>
				 			</th>
			 			<?php endforeach;?>
			 		</tr>
			 	</thead>
			 	<tbody>
			 		<?php foreach($model as $value):?>	
			 			<tr>
			 				<td><?=$value->product_code?></td>
			 			    <td><?=$value->name?></td>
			 			    <td>0</td>
			 			    <td>0</td>
			 				<?php foreach($model2 as $value2):?>
			 				    <?php if($value2->product_code == $value->product_code):?>
			 						 <td>
			 						 	<table width="100%">
			 						 		<tr>
			 						 			<td style="width: 50%;text-align: right;">
			 						 				<?=number_format($value2->warehouse_qty)?>
			 						 			</td>
			 						 			<td style="width: 50%;text-align: right;">
			 						 				<?=number_format($value2->warehouse_qty * $value2->cost)?>
			 						 			</td>
			 						 		</tr>
			 						 		
			 						 	</table>
			 						 </td> 
			 					<?php endif;?>
			 				<?php endforeach;?>
			 			</tr>
			 		<?php endforeach;?>
			 	</tbody>
			 </table>
 		</div>
 		</div>
 	</div>
 </div>
 