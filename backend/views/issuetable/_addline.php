<?php
 //$wh = \backend\models\Warehouse::find()->all();
?>
<tr class="saleline-id-">
  <td>1</td>
  <td>
  	<input type="text" class="form-control product_code" name="product_code[]" value="<?=$data["product_code"]?>" disabled="disabled" /> 
  	<input type="hidden" class="form-control product_id" name="product_id[]" value="<?=$data["id"]?>" /> 
  </td>
  <td>
  	<input type="text" class="form-control name" name="name[]" value="<?=$data["name"]?>" disabled="disabled" /> 
  </td>
  <td>
  	<input type="text" class="form-control qty" name="qty[]" value="1" onkeydown="eventNumber($(this));" onchange="linecal($(this));" /> 
  </td>
  <td><div class="btn btn-warning line_remove"><i class="fa fa-minus"></i></div></td>
</tr>