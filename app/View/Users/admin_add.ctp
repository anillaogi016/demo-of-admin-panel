<?php echo $this->Form->create('User', array('novalidate' => true, 'url'=>array('controller'=>'users','action'=>'admin_add'),'id'=>'categoryadd'));
?>
<script>
$(document).ready(function(){
	if($("#categoryadd").validate){
		$("#categoryadd").validate({
										
		    rules:{
                'data[User][mobile]':{
					required: true,
					maxlength: 10,
					number:true
                }
            },
            messages:{
                'data[User][mobile]':{
                    required: 'This field is required.',
					number: 'Please enter number only.',
                    maxlength: 'Mobile  should be 10 number only.'
                }
            }	 						
		});
	}
	
});
</script>
<style>
label.error {
    color: red;
}
</style>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Add User
		</td>
	</tr>
	<tr><td height="10px"> </td></tr>
	<tr>
		<td align="center">
			<table cellpadding="0" cellspacing="0" border="0" class="change-password form_section">
				<h2><?php echo $this->Session->flash();?></h2>
				<!--<tr>
					<td>User Email<span class="required">*</span>: </td>
					<td>
						<?php echo $this->Form->input('email',array('type'=>'text','class' => 'form-control','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>-->
				<tr>
					<td>User Mobile<span class="required">*</span>: </td>
					<td>
						<?php echo $this->Form->input('mobile',array('type'=>'text','class' => 'form-control','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
				   <td></td>
				   <td><button  class="btn-common" type="submit"  >Save</button>&nbsp;<a style="text-decoration:none" class="btn-common" href=" <?php echo WWW_BASE_ADMIN;?>/users/list ">Cancel </a>
				   <?php //echo $this->Form->end(); ?></td>
				</tr>
			</table>
	   </td>
	</tr>
</table>
<?php echo $this->Form->end(); ?>