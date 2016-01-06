<?php echo $this->Form->create( array('novalidate' => true));
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Add Sub Category
		</td>
	</tr>
	<tr><td height="10px"> </td></tr>
	<tr>
		<td align="center">
			<table cellpadding="0" cellspacing="0" border="0" class="change-password form_section">
				<h2><?php echo $this->Session->flash();?></h2>
				<?php 
				//echo $this->Form->input('Category.id',array('type'=>'hidden','value'=>$parent['Category']['id']));					
				//echo $this->Form->input('Category.parent_id',array('type'=>'hidden','value'=>$parent['Category']['parent_id'])); ?>				
				<tr>
					<td>Category Name<span class="required">*</span>: </td>
					<td>
						<?php echo '&nbsp;&nbsp;'.$parent['Category']['name'];?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td>Sub Category Name<span class="required">*</span>: </td>
					<td>
						<?php echo $this->Form->input('Category.name',array('class' => 'form-control','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
				   <td></td>
				   <?php
				   echo $this->Form->hidden('Category.parent_id',array('value'=>$parent['Category']['id'],'class' => 'form-control','label'=>false)); ?>
				   <td><button  class="btn-common" type="submit">Save</button>
				    &nbsp;
					<a style="text-decoration:none" class="btn-common" href=" <?php echo WWW_BASE_ADMIN;?>/categories/subcatList/<?php echo $parent['Category']['id']; ?> ">Cancel </a>
				   <?php //echo $this->Form->end(); ?></td>
				</tr>
			</table>
	   </td>
	</tr>
</table>
<?php echo $this->Form->end(); ?>
