<table width="100%" cellpadding="0" cellspacing="0" border="0">
	
	<tr>
		<td class="page-title change_password_title">
			<b>Sub Category:</b> <?php echo $parent['Category']['name'];?>
			<a class="back_btn" href="<?php echo WWW_BASE."admin/categories/add_subcat/".$parent['Category']['id'] ?>">Add Sub Category</a>
		</td>
	</tr>
	
    <tr><td height="10px"> </td></tr>
	<tr>
		<td align="center">
	
	<table border="1" class="table_section">
	<h2><?php echo $this->Session->flash();?></h2>
	<tr class="th_align">
		<th><?php echo $this->Paginator->sort('Category.name','Name'); ?></th>
		<th><?php echo $this->Paginator->sort('Category.active','Active'); ?></th>
		<th>Action</th>	
	</tr>
	<?php if(!empty($data)) { 
	$row_count = 1;
	foreach ($data as $rec) { 
		?>
	<tr>
		<td><?php echo $rec['Category']['name']; ?></td>
		
		<td>
			<?php
				if($rec['Category']['active'] == 'Yes') {
					 echo $this->Html->link('Yes','/admin/categories/status/'.$rec['Category']['id'].'/No',array('escape'=>false)); 	
				} 

				if($rec['Category']['active'] == 'No') {
					 echo $this->Html->link('No','/admin/categories/status/'.$rec['Category']['id'].'/Yes',array('escape'=>false)); 	
				} 
			?>
		</td>
		<td align="center">
		
		<?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>','/admin/categories/edit/'.$rec['Category']['id'],array('escape'=>false));  ?>
		&nbsp;
		<?php echo $this->Html->link('<i class="fa fa-trash-o"></i>','/admin/categories/del/'.$rec['Category']['id'],array('escape'=>false),'Are you sure you want to delete this record?');  ?>
	
		&nbsp;
		</td>
	</tr>
	<?php $row_count++;  }; ?>
		<?php unset($cat); ?>
		<?php if($this->params['paging']['Category']['pageCount']>1){?>
		<tr>
			<td colspan='7' align="center">
				<!-- Shows the next and previous links -->
				<?php echo $this->Paginator->prev(); ?> &nbsp;
				<!-- Shows the page numbers -->
				<?php echo $this->Paginator->numbers(); ?> &nbsp;
				<?php echo $this->Paginator->next(); ?> &nbsp;<br>
				<!-- prints X of Y, where X is current page and Y is number of pages -->
				<?php echo $this->Paginator->counter();echo "&nbsp Page"; ?>
			</td>
		</tr>
		<?php } ?>
		<?php } else {?>
	<tr>
		<td align="center" colspan="7">No records found.</td>
	</tr>
	<?php } ?>
	</table>
	   </td>
	</tr>
</table>