<?php
use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use yii\jui\AutoComplete;
?>
<tr id="line_trans">
	<td>
    <input type="text" placeholder="ค้นหารหัส..." class="form-control" name="expend_tite[]" id="prodid" value="">
    <input type="hidden" name="expend_tite_id[]" id="expend_title_id" value="">
	</td>		
	<td><input type="text" class="form-control name" value=""></td>		
	<td><input type="text" class="form-control price"></td>		
  <td><input type="text" class="form-control"></td>   
  <td>
    <div class="btn btn-danger btn-del"><i class="fa fa-bin"></i> ลบ</div>
  </td>   
</tr>