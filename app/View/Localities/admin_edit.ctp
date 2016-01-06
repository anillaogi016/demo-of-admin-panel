<?php 
//echo '<pre>'; print_r($allsubCategory); die;
//$val_sub = $this->Session->read('sub_category_id');
//echo $val_sub; die;

echo $this->Form->create('Locality', array('novalidate' => true, 'url'=>array('controller'=>'localities','action'=>'admin_edit'),'id'=>'subsubcategory'));
?>
<?php echo $this->Html->Script(array('jquery.validate')); ?>      

<script>
$(document).ready(function(){
	
	if($("#subsubcategory").validate){
		$("#subsubcategory").validate({
			 rules:{
				'data[Locality][name]':{
					required: true,
					maxlength: 50
				}
			},
			messages:{
				'data[Locality][name]':{
					required: 'This field is required.',
					 maxlength: 'Locality Name should be 50 character or less.'
				}
			}	
     });
	}
	
	$(".categorySelect").change(function(){
        var formData =$("#categorySelect").val();
	    var formUrl   = "<?php echo WWW_BASE_ADMIN.'/localities/city';?>";
	 	$.ajax({ 
			type: 'GET',
			url: formUrl,
			data: {'data':formData},
			success: function(msg){
				$("#subcategoryselect").show();
				$("#subcategoryselect").html(msg);
				
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
</style>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Add Locality
		</td>
	</tr>
	<tr><td height="10px"> </td></tr>
	<tr>
		<td align="center">
			<table cellpadding="0" cellspacing="0" border="0" class="change-password form_section">
				<h2><?php echo $this->Session->flash();?></h2>
				
				<tr>
					<td> Select State <span class="required">*</span>:</td>
					
					<?php
						$val = $this->Session->read('state_id');
					?>
					
					<td>
						<?php 
						echo $this->Form->hidden('id');
						echo $this->Form->input('state_id',array('type'=>'select', 'empty' => 'Select one' ,'options' => $allState , 'selected' => $val, 'class' => 'form-control categorySelect','id'=>'categorySelect','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				
				
				<tr>
					<td> Select City <span class="required">*</span>:</td>
					
					<?php
						$val_city = $this->Session->read('city_ids');
					?>
					
					<td>
						<?php echo $this->Form->input('city_id',array('type'=>'select', 'empty' => 'Select one' ,'options' => $allCity ,'selected' => $val_city,'class' => 'form-control','id'=>'subcategoryselect','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				
				<tr>
					<td>Locality Name<span class="required">*</span>: </td>
					<td>
						<?php echo $this->Form->input('name',array('type'=>'text','class' => 'form-control','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
				   <td></td>
				   <td><button  class="btn-common" type="submit"  >Save</button>&nbsp;<a style="text-decoration:none" class="btn-common" href=" <?php echo WWW_BASE_ADMIN;?>/localities/localityList ">Cancel </a>
				   <?php //echo $this->Form->end(); ?></td>
				</tr>
			</table>
	   </td>
	</tr>
</table>
<?php echo $this->Form->end(); ?>