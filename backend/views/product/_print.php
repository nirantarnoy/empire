<div>
	<?php if(count($bcode)>0):?>
		<table>
		<?php for($i=0;$i<=count($bcode)-1;$i++):?>
			<tr>
				<?php for($x=1;$x<=$bcode[$i]['qty'];$x++):?>
					<td style="text-align: center;">
						<strong><?=$bcode[$i]['code']?></strong><small><?=$bcode[$i]['name']?></small>
						<br />
						<barcode code="<?=$bcode[$i]['code']?>" type="c39" size="0.8" height="2.0"/><br />
					</td>
				<?php endfor;?>
			</tr>
                
				
		<?php endfor;?>
	</table>
	<?php endif;?>
</div>