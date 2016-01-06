<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr><td height="10px"> </td></tr>
	<div>
		<?php if(!empty($image['Product']['image'])){?>
		<img src="<?php echo WWW_BASE.'img/product_img/'.$image['Product']['image'];?>" width="400" height="400"></img>
		<?php }else{
			echo 'Product Image is not available';
		}?>
    </div>
	</tr>
</table>
