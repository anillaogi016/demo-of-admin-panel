<?php echo $this->Form->create('Category', array('novalidate' => true, 'url'=>array('controller'=>'categories','action'=>'admin_edit')));
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Edit Category
		</td>
	</tr>
	<tr><td height="10px"> </td></tr>
	<tr>
		<td align="center">
			<table cellpadding="0" cellspacing="0" border="0" class="change-password form_section">
				<h2><?php echo $this->Session->flash();?></h2>
				<tr>
					<td>Category Name<span class="required">*</span>: </td>
					<td>
					    <?php echo $this->Form->input('id',array('type'=>'hidden'));?>
						<?php echo $this->Form->input('name',array('type'=>'text','class' => 'form-control','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
				   <td></td>
				   <td><button  class="btn-common" type="submit"  >Save</button>
				   <?php
				   $p_id = $this->Common->parent_category_name($this->request->data['Category']['id']);
				   if($p_id != '')
				   {
				   ?>
				   
				   &nbsp;<a style="text-decoration:none" class="btn-common" href=" <?php echo WWW_BASE_ADMIN;?>/categories/subcatList/<?php echo $p_id;?> ">Cancel </a>
				   <?php
				   }
				   else
				   {
				   ?>
				  &nbsp;<a style="text-decoration:none" class="btn-common" href=" <?php echo WWW_BASE_ADMIN;?>/categories/list ">Cancel </a>
				   <?php
				   }
				   ?>
				   <?php //echo $this->Form->end(); ?></td>
				</tr>
			</table>
	   </td>
	</tr>
</table>
<?php echo $this->Form->end(); ?>