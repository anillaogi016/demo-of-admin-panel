<?php //echo $this->Html->Script(array('jquery_1.11.1.min')); ?>

<script>
$(document).ready(function(){
	
	$("#product_listing").hide();
	$("#basketSelect").change(function(){
        var formData =$("#basketSelect").val();
	    var formUrl   = "<?php echo WWW_BASE_ADMIN.'/products/get_basket_products';?>";
		
		//alert( formData ); return false;
		
	 	$.ajax({ 
			type: 'POST',
			url: formUrl,
			data: {'basket_id':formData},
			success: function(msg){
				$("#product_listing").show();
				$("#product_listing").html(msg);
				//alert(msg);
			}
		}); 
		return false;
     }); 
	
});
function goBack() {
		window.history.back();
}
</script>
<style>
label.error {
    color: red;
}
.form-control1{
	color: #555;
    display: block;
    font-size: 14px;
    height: 34px;
    line-height: 1.42857;
    margin-left: 9px;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 37%;
}
</style>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Manage standard baskets
		</td>
	</tr>
	
	<tr>
		<td align="left" class="page-title change_password_title">
			<a class="back_btn" href="<?php echo WWW_BASE."admin/standards/add_item" ?>">Add product</a>
		</td>
	</tr>
	<tr><td height="10px"> </td></tr>
	<tr>
		<td align="center">
			<table cellpadding="0" cellspacing="0" border="0" class="change-password form_section">
				<h2 id="flashmsg"><?php echo $this->Session->flash();?></h2>
				
				<tr>
					<td> Select Basket :</td>
					<td>
						<?php echo $this->Form->input('basket_id',array('type'=>'select', 'empty' => 'Select one basket' ,'options' => $all_baskets ,'class' => 'form-control','id'=>'basketSelect','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
			</table>
			
			<div id="product_listing">
			
			
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				
				<tr><td height="10px"> </td></tr>
				<tr>
					<td align="center">
				
				<table border="1" class="table_section">
				<h2><?php echo $this->Session->flash();?></h2>
				<tr class="th_align">
					<th><?php echo 'Product name'; ?></th>
					<th>Action</th>	
				</tr>
				<?php if(!empty($data)) { 
				$row_count = 1;
				foreach ($data as $rec):
					
				?>
				<tr>
					<td align="center"><?php echo $rec['Product']['name']; ?></td>
					<td align="center">
					<?php echo $this->Html->link('<i class="fa fa-trash-o"></i>',array('controller'=>'items','action'=>'admin_delete_product',$rec['Predefinebasketitem']['product_id']),array('escape'=>false,'confirm'=>'Do you really wish to delete this Product?'));?>
					</td>
				</tr>
				<?php $row_count++;  endforeach; ?>
					<?php unset($cat); ?>
					<?php if($this->params['paging']['Product']['pageCount']>1){?>
					<tr>
						<td colspan='7' align="center">
							<!-- Shows the next and previous links -->
							<?php echo $this->Paginator->prev(); ?> &nbsp;
							<!-- Shows the page numbers -->
							<?php echo $this->Paginator->numbers(); ?> &nbsp;
							<?php echo $this->Paginator->next(); ?> &nbsp;<br>
							<!-- prints X of Y, where X is current page and Y is number of pages -->
							<?php echo $this->Paginator->counter();echo "&nbsp Page"; ?>
						</td>
					</tr>
					<?php } ?>
					<?php } else {?>
				<tr>
					<td align="center" colspan="7">No product found.</td>
				</tr>
				<?php } ?>
				</table>
				   </td>
				</tr>
			</table>
			
			</div>
			
	   </td>
	</tr>
</table>
<?php echo $this->Form->end(); ?>