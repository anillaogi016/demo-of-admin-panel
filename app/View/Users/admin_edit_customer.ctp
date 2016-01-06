<?php echo $this->Form->create('User', array('novalidate' => true, 'url'=>array('controller'=>'users','action'=>'admin_edit_customer',$data['User']['slug'])));
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
					<td>First Name<span class="required">*</span>: </td>
					<td>
						<?php echo $this->Form->input('name',array('type'=>'text','value'=>$data['User']['name'],'class' => 'form-control','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td>Last Name<span class="required">*</span>: </td>
					<td>
						<?php echo $this->Form->input('last_name',array('type'=>'text','value'=>$data['User']['last_name'],'class' => 'form-control','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td class="text-area">Email<span class="required">*</span>: </td>
					<td> 
						 <?php echo $this->Form->input('email',array('type'=>'text','value'=>$data['User']['email'],'class' => 'form-control','label'=>false)); ?> 
						 <div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td class="text-area">Address Line 1<span class="required">*</span>: </td>
					<td><?php echo $this->Form->input('address_line1',array('type'=>'text','value'=>$data['User']['address_line1'],'class' => 'form-control','label'=>false)); ?>
					<div class="clr10"></div>
					</td>
					 
				</tr>
				<tr>
					<td class="text-area">Address Line 2<span class="required">*</span>: </td>
					<td><?php echo $this->Form->input('address_line2',array('type'=>'text','value'=>$data['User']['address_line2'],'class' => 'form-control','label'=>false)); ?>
					<div class="clr10"></div>
					</td>
					 
				</tr>
                <tr>
					<td class="text-area">Town<span class="required">*</span>: </td>
					<td><?php echo $this->Form->input('town_id',array('type'=>'select','class'=>'form-control townlistcls','id'=>'User','options'=>$townlist,'selected'=>$data['User']['town_id'],'label'=>false)); ?>
					<div class="clr10"></div>
					</td>
					 
				</tr>
                <tr id="place">
					<td class="text-area">Place<span class="required">*</span>: </td>
					<td><?php echo $this->Form->input('place_id',array('type'=>'select','options'=>$placelist,'selected'=>$data['User']['place_id'],'class' => 'form-control','label'=>false)); ?>
					<div class="clr10"></div>
					</td>
					 
				</tr>				
				<tr>
					<td class="text-area">Phone: </td>
					<td><?php echo $this->Form->input('phone',array('type'=>'text','value'=>$data['User']['phone'],'class' => 'form-control','label'=>false)); ?>
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