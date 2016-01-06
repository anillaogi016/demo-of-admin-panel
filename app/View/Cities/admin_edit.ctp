<?php echo $this->Form->create('City', array('novalidate' => true, 'url'=>array('controller'=>'cities','action'=>'admin_edit'),'id'=>'subcategory'));
?>
<script>
$(document).ready(function(){
	if($("#subcategory").validate){
		$("#subcategory").validate({
			 rules:{
				'data[City][name]':{
					required: true,
					maxlength: 50
				}
			},
			messages:{
				'data[City][name]':{
					required: 'This field is required.',
					 maxlength: 'City Name should be 50 character or less.'
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
			Edit City
		</td>
	</tr>
	<tr><td height="10px"> </td></tr>
	<tr>
		<td align="center">
			<table cellpadding="0" cellspacing="0" border="0" class="change-password form_section">
				<h2><?php echo $this->Session->flash();?></h2>
				<tr>
				   <td> Select State <span class="required">*</span>:</td>
					<td>
					
					 <?php  $keys = array_keys($allState);
							$val = $this->Session->read('state_id');
							@$this->Session->delete('state_id');
 
					?>
						<?php echo $this->Form->input('state_id',array('type'=>'select', 'empty' => 'Select One' ,'selected' => $val, 'options' => $allState ,'class' => 'form-control','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td>City Name<span class="required">*</span>: </td>
					<td>
					    <?php echo $this->Form->input('id',array('type'=>'hidden'));?>
						<?php echo $this->Form->input('name',array('type'=>'text','class' => 'form-control','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
				   <td></td>
				   <td><button  class="btn-common" type="submit"  >Save</button>
				   &nbsp;<a style="text-decoration:none" class="btn-common" href=" <?php echo WWW_BASE_ADMIN;?>/cities/list ">Cancel </a>
				   <?php //echo $this->Form->end(); ?></td>
				</tr>
			</table>
	   </td>
	</tr>
</table>
<?php echo $this->Form->end(); ?>