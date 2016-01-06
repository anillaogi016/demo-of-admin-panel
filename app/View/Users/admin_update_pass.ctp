<?php echo $this->Form->create('User', array('novalidate' => true, 'id'=>'changePwdFrm', 'url'=>array('controller'=>'users','action'=>'change_password')));
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Update Password : <?php echo $userdata['User']['name']; ?>
		</td>
	</tr>
	<tr><td height="10px"> </td></tr>
	<tr>
		<td align="center">
			<table cellpadding="0" cellspacing="0" border="0" class="change-password form_section">
				<h2><?php echo $this->Session->flash();?></h2>
				<tr>
					<td class="text-area">New Password<span class="required">*</span>: </td>
					<td>
						<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
						 <?php echo $this->Form->input('password',array('type'=>'password','class' => 'form-control','label'=>false)); ?>
						 <div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td class="text-area">Confirm Password<span class="required">*</span>: </td>
					<td><?php echo $this->Form->input('confirm_password',array('type'=>'password','class' => 'form-control','label'=>false)); ?>
					<div class="clr10"></div>
					</td>
					 
				</tr>
				<tr>
				   <td></td>
				   <td><button  class="btn-common" type="submit"  onclick="return validchangepassword();">Save</button>
				   <?php //echo $this->Form->end(); ?></td>
				</tr>
			</table>
	   </td>
	</tr>
</table>
<?php echo $this->Form->end(); ?>