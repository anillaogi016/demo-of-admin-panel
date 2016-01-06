<div class="login-form">	
	<div class="loginpage_align">
		<div class="form_row top_heading">
		<?php
			if($this->Session->check('Message.flash'))
			{
				echo $this->Session->flash();
			}
		?></div> 
		<div class="form_row top_heading1">Log in to Admin Panel</div>
		<div class="clr20"></div>
		<div class="form_row">
		<?php echo $this->Form->create('User', array('novalidate' => true, 'id'=>'loginFrm', 'url'=>array('controller'=>'users','action'=>'admin_login')));
		?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="200">Email</td>
				<td>&nbsp;</td>
				<td width="200"> Password</td>
			  </tr>
			  <tr>
				<td width="200" valign='top'> <?php echo $this->Form->input('email', array('type'=>'text','class'=>'inputbox','label'=>false,'size' => 20,'id'=>'email', 'tabindex'=> '1')); ?> </td>
				<td>&nbsp;</td>
				<td width="200" valign='top'><?php echo $this->Form->input('password', array('label'=>false,'class'=>'inputbox','size' => 20,'id'=>'password','tabindex'=> '2')); ?> </td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td class="forget-pws"><?php echo $this->Html->link('Forgot Password',WWW_BASE.'admin/users/forgot_password',array('escape'=>false));
		?></td>
				<td>&nbsp;</td>
				<td> <input type="submit" value="Submit" class="btn1 button" tabindex='3'  /></td>
			  </tr>
			</table>
		<?php echo $this->Form->end(); ?>
	</div> 
</div>
<script>
$(document).ready(function(){
	$('#loginFrm').validate({
		rules:{
			email:'required',
			password:'required',
		},
		messages: {
			email:'Please enter your email',
			password:'Please enter the Password',
		}
	});
});
	
</script>