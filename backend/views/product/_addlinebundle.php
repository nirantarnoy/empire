<?php
 ?>
<tr>
	<td><?=$product_code?>
		<input type="hidden" name="bundle_id[]" value="<?=$product_id?>">
	</td>
	<td><?=$product_name?></td>
	<td><?=$qty?>
		<input type="hidden" class="qty" name="bundle_qty[]" value="<?=$qty?>">
	</td>
	<td><?=number_format($price)?>
		<input type="hidden" class="price" name="bundle_price[]" value="<?=number_format($price)?>">
	</td>
	<td>
		<div class="btn btn-warning bundle_line_remove" onclick="removebundleline($(this));"><i class="fa fa-minus"></i></div>
	</td>
</tr>