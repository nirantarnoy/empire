<?php
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;


$this->title = "โอนสินค้า";
?>
<?php $form = ActiveForm::begin(['id'=>'myform','action'=>['issueapprove/transfersubmit']])?>
<div class="row">
	<div class="col-lg-12">
		<input type="submit" class="btn btn-success" value="ตกลง"/>
		<input type="hidden" name="issue_id" value="<?=$issue_id?>" />
	</div>
</div><br />
<div class="row">
	<div class="col-lg-12">
		<div class="panel">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6">
						<h3> <span>อ้างอิงใบเติมสินค้า:<?=$issue_no?></span> </h3>
					</div>
				</div>
				<hr />
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>รหัสสินค้า</th>
							<th>ชื่อสินค้า</th>
							<th>จำนวน</th>
							<th>จากคลัง</th>
							<th>ไปคลัง</th>
						</tr>
					</thead>
					<tbody>
					<?php if(count($model)>0):?>
						<?php foreach($model as $key =>$data):?>
							<tr id="<?$data->id?>">
								<td><?=$key+1?></td>
								<td>
									<input type="hidden" name="product_id[]" value="<?=$data->product_id?>" />
									<?=\backend\models\Product::getProdCode($data->product_id)?>
								</td>
								<td><?=\backend\models\Product::getProdName($data->product_id)?></td>
								<td><input type="number" class="form-control" name="qty[]" value="<?=$data->req_qty?>" /></td>
								<td>
									<?php
										echo Select2::widget([
												'name'=>'fromwarehouse[]',
												'model'=>$modelWarehouse,
												'attribute'=>'name',
												'data'=>ArrayHelper::map(\backend\models\Warehouse::find()->all(),'id','name'),
												// 'options'=>[//'placeholder'=>'เลือกคลังปลายทาง',
												// 	'onchange'=>'
														
												// 	'
												// ],
												'pluginOptions'=>[
													'allowClear'=> true,
												]
											]);
									?>
								</td>
								<td>
									<?php
									    $sale_id = \backend\models\User::findEmpid(Yii::$app->user->identity->id);
										echo Select2::widget([
												'name'=>'towarehouse[]',
												'model'=>$modelWarehouse,
												'attribute'=>'name',
												'data'=>ArrayHelper::map(\backend\models\Warehouse::find()->where(['sale_id'=>$sale_id])->all(),'id','name'),
												//'data'=>ArrayHelper::map(\backend\models\Warehouse::find()->all(),'id','name'),
												'options'=>[//'placeholder'=>'เลือกคลังปลายทาง',
													'onchange'=>'
														
													'
												],
												'pluginOptions'=>[
													'allowClear'=> true,
												]
											]);
									?>
								</td>
							</tr>
						<?php endforeach;?>
					<?php endif;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php ActiveForm::end();?>