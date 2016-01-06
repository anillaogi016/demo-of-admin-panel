<div class="login-form">	
	<div class="loginpage_align">
		<div class="form_row top_heading">
		<?php
			if($this->Session->check('Message.flash'))
			{
				echo $this->Session->flash();
			}
		?></div> 
		<div class="form_row top_heading1">Retrieve your Password</div>
		<div class="clr20"></div>
		<div class="form_row">
		<?php echo $this->Form->create('User', array('novalidate' => true, 'id'=>'loginFrm', 'url'=>WWW_BASE.'admin/users/forgot_password'));
		?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td style="width:20px;">Email</td>
				<td style="width:5px;">:</td>
				<td style="width:200px;"><?php echo $this->Form->input('email', array('type'=>'text','class'=>'inputbox forgot_pas','label'=>false,'size' => 20,'id'=>'email')); ?></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td> <input type="button" value="Back" class="btn1 button" onclick="window.location.href='<?php echo WWW_BASE; ?>'"    />
				     <input type="submit" value="Submit" class="btn1 button"/>      
				</td>
			  </tr>
			</table>
		<?php echo $this->Form->end(); ?>
	</div> 
</div>
<script>
$(document).ready(function(){
	$('#loginFrm').validate({
		rules:{
			username:'required',
			password:'required',
		},
		messages: {
			username:'Please enter the User Name',
			password:'Please enter the Password',
		}
	});
});
	
</script>