<?php
 use yii\helpers\Url;
 $this->title = "สรุปยอดสินค้าทั้งหมด";
 $groupall = \backend\models\Category::find()->where(['!=','name',''])->all();
 $whall = \backend\models\Warehouse::find()->where(['!=','name',''])->all();
 ?>
 <div class="row">
          <div class="col-lg-12">
            <form id="search-form" action="<?=Url::to(['transsummary/showreport'],true)?>" method="post">
                   <div class="form-inline">
                <select class="form-control" id="product_group" name="product_group">
                  <option value="">เลือกกลุ่มสินค้า</option>
                  <?php foreach($groupall as $value):?>
                  <?php $select = '';
                    if($value->id == $group){
                      $select = 'selected';
                    }
                  ?>
                  <option value="<?=$value->id?>" <?=$select?>><?=$value->name?></option>
                 <?php endforeach;?>
                </select>
                 <select class="form-control" id="warehouse" name="warehouse">
                  <option value="">เลือกคลังสินค้า</option>
                  <?php foreach($whall as $value):?>
                  <?php $select = '';
                    if($value->id == $warehouse){
                      $select = 'selected';
                    }
                  ?>
                  <option value="<?=$value->id?>" <?=$select?>><?=$value->name?></option>
                 <?php endforeach;?>
                </select>
                 <input type="text" class="form-control" name="product" placeholder="รหัสสินค้า ,ชื่อสินค้า" value="<?=$product?>">
                <input type="submit" class="btn btn-primary" value="ค้นหา">
            </div>
            </form>
       
          </div>
        </div><br />
 <div class="row">
 	<div class="col-lg-12">
 		<div class="panel">

 		<div class="panel-body">
 			<table class="table  table-bordered table-striped">
			 	<thead>
			 		<tr>
			 			<th colspan="5" style="text-align: center;">สรุปมูลค่าสินค้าทั้งหมด</th>
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
			 			<th style="text-align: right;">จำนวนรวม</th>
			 			<th style="text-align: right;">ทุนสินค้า</th>
			 			<th style="text-align: right;">มูลค่ารวม</th>
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
			 			    <td style="text-align: right;"><?=$value->total_qty?></td>
			 			    <td style="text-align: right;"><?=number_format($value->cost,0)?></td>
			 			    <td style="text-align: right;"><?=number_format($value->cost * $value->total_qty,0)?></td>
			 				<?php foreach($model2 as $value2):?>
			 				    <?php if($value2->product_code == $value->product_code):?>
			 						 <td>
			 						 	<table width="100%">
			 						 		<tr>
			 						 			<td style="width: 50%;text-align: right;">
			 						 				<?=number_format($value2->warehouse_qty,0)?>
			 						 			</td>
			 						 			<td style="width: 50%;text-align: right;">
			 						 				<?=number_format($value2->warehouse_qty * $value2->cost,0)?>
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
 