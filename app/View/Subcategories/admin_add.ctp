<?php echo $this->Form->create('Subcategory', array('novalidate' => true, 'url'=>array('controller'=>'subcategories','action'=>'admin_add'),'id'=>'subcategory'));
?>
<?php //echo $this->Html->Script(array('jquery_1.11.1.min','bootstrap.min','jquery.validate')); ?>      

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
			Add Sub-Category
		</td>
	</tr>
	<tr><td height="10px"> </td></tr>
	<tr>
		<td align="center">
			<table cellpadding="0" cellspacing="0" border="0" class="change-password form_section">
				<h2><?php echo $this->Session->flash();?></h2>
				
				<tr>
					<td> Select Category <span class="required">*</span>:</td>
					<td>
					
					 <?php  $keys = array_keys($allCategory);
							$val = $this->Session->read('category_id');
							@$this->Session->delete('category_id');
							//sort($allCategory); 
					?>
						<?php echo $this->Form->input('category_id',array('type'=>'select', 'empty' => 'Select one' ,'selected' => $val, 'options' => $allCategory ,'class' => 'form-control','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td>Sub-category Name<span class="required">*</span>: </td>
					<td>
						<?php echo $this->Form->input('name',array('type'=>'text','class' => 'required form-control','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
				   <td></td>
				   <td><button  class="btn-common" type="submit"  >Save</button>&nbsp;<button  class="btn-common" type="submit"  id="Back" onclick="goBack()">Cencel</button>
				   <?php //echo $this->Form->end(); ?></td>
				</tr>
			</table>
	   </td>
	</tr>
</table>
<?php echo $this->Form->end(); ?>