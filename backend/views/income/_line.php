<?php
use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use yii\jui\AutoComplete;

$data = \backend\helpers\IncomeType::asArrayObject();



?>
<tr id="line_trans">
  <td></td>
	<td>
   <!--  <input type="text" placeholder="ค้นหารหัส..." class="form-control" name="expend_tite[]" id="prodid" value=""> -->
   <select class="form-control" name="expend_title_id[]" id="prodid">
     <?php for($i=0;$i<=count($data)-1;$i++): ?>
     <option value=""><?=$data[$i]['name']?></option>
     <?php endfor; ?>
   </select>
   <!--  <input type="hidden" name="expend_title_id[]" id="expend_title_id" value=""> -->
	</td>		
	<td><input type="text" class="form-control name" value=""></td>		
	<td><input type="text" class="form-control price" name="price[]" onkeydown="eventNumber($(this));"></td>		
  <td>
    <td><div class="btn btn-warning line_remove" onclick="removeline($(this));"><i class="fa fa-minus"></i></div></td>
  </td>   
</tr>