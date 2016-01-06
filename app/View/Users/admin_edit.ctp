<?php echo $this->Form->create('User', array('novalidate' => true, 'url'=>WWW_BASE.'admin/users/edit'));
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Edit Profile
		</td>
	</tr>
	<tr><td height="10px"> </td></tr>
	<tr>
		<td align="center">
			<table cellpadding="0" cellspacing="0" border="0" class="change-password form_section">
				<h2><?php echo $this->Session->flash();?></h2>
				
				<tr>
					<td class="text-area">Email<span class="required">*</span>: </td>
					<td>
						 <?php echo $this->Form->input('email',array('type'=>'text','value'=>$data['User']['email'],'class' => 'form-control','label'=>false)); ?>
						 <div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td class="text-area">Mobile<span class="required">*</span>: </td>
					<td>
						 <?php echo $this->Form->input('mobile',array('type'=>'text','value'=>$data['User']['mobile'],'class' => 'form-control','label'=>false)); ?>
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