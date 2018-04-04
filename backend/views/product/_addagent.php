<?php
 ?>

    <tr>
    	<td></td>
    	<td>
    		<?php echo $price;?>
            <input type="hidden" class="line_price" name="line_price[]" value="<?=$price?>">     
            <input type="hidden" class="agent_type" name="agent_type2[]" value="<?=$agent_type?>">     
    		</td>
    	<td>
    		<?php echo $agent_name;?>
    	    <input type="hidden" class="agentid" name="agentid[]" value="<?=$agent_id?>">		
    		</td>
    	<td><div class="btn btn-success btn-edit-agent" onclick="editagent($(this));">แก้ไข</div> <div class="btn btn-danger btn-delete-agent" onclick="deleteagent($(this));">ลบ</div></td>
    </tr>
