<?php echo $this->Form->create('Subcategory', array('novalidate' => true, 'url'=>array('controller'=>'subcategories','action'=>'admin_edit'),'id'=>'subcategory'));
?>
<script>
$(document).ready(function(){
	
	if($("#subcategory").validate){
		$("#subcategory").validate({
			 rules:{
				'data[Subcategory][name]':{
					required: true,
					maxlength: 50
				}
			},
			messages:{
				'data[Subcategory][name]':{
					required: 'This field is required.',
					 maxlength: 'Sub-category Name should be 50 character or less.'
				}
			}		
		});
	}
	
});
function goBack() {
		window.history.back();
}
</script>
<style>
label.error {
    color: red;
}
</style>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Edit Sub category
		</td>
	</tr>
	<tr><td height="10px"> </td></tr>
	<tr>
		<td align="center">
			<table cellpadding="0" cellspacing="0" border="0" class="change-password form_section">
				<h2><?php echo $this->Session->flash();?></h2>
				<tr>
					<td>Name<span class="required">*</span>: </td>
					<td>
					    <?php echo $this->Form->input('id',array('type'=>'hidden'));?>
						<?php echo $this->Form->input('name',array('type'=>'text','class' => 'form-control required','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
				   <td></td>
				   <td><button  class="btn-common" type="submit"  >Save</button>
				   <?php //echo $this->Form->end(); ?></td>
				</tr>
			</table>
	   </td>
	</tr>
</table>
<?php echo $this->Form->end(); ?>