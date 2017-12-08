<?php

 ?>
 <table class="table">
 	<thead>
 		<tr>
 			<th></th>
 			<th></th>
 			<th></th>
 			<th></th>
 			<?php foreach($model_wh as $value2):?>
 				 
 						<th style="padding-left: 50px;"><?=$value2->warhouse_name?></th>

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
 				 		<td style="width: 50%">จำนวน</td>
 				 		<td style="width: 50%">ราคา</td>
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
 						 			<td style="width: 50%">
 						 				<?=$value2->warehouse_qty?>
 						 			</td>
 						 			<td style="width: 50%">
 						 				100
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