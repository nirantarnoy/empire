<?php
$wh = \backend\models\Warehouse::find()->all();
?>
<tr>
	<td>
		<input type="hidden" name="product_id[]" value="">
	<select id="whid" class="form-control" name="warehouse[]">
      <?php foreach($wh as $value):?>
      <option value="<?=$value->id?>">
        <?=$value->name?>
      </option>
    <?php endforeach;?>
    </select>
	</td>
	<td>
		<input type="text" name="min_qty[]" class="form-control" value="0">
	</td>
	<td>
		<div class="btn btn-warning line_remove" onclick="removeline($(this));"><i class="fa fa-minus"></i></div>
	</td>
</tr>