<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Manage Categories
			<a class="back_btn" href="<?php echo WWW_BASE."admin/categories/add" ?>">Add Category</a>
		</td>
	</tr>
	<tr><td align="center"> 
		<form method="GET" action="<?php echo WWW_BASE ?>admin/categories/list/">	
			<div class="search_box">
			<input type="text" name="search" id="search" placeholder="Search" value="<?php echo @$_GET['search']; ?>">
			<input type="submit"  value="Search" id="searchbtn" class="btn-common">
			</div>
		</form>
	</td></tr>
    <tr><td height="10px"> </td></tr>
	<tr>
		<td align="center">
	
	<table border="1" class="table_section">
<h2><?php echo $this->Session->flash();?></h2>
	<tr class="th_align">
	    <th>S.No.</th>
		<th><?php echo $this->Paginator->sort('Category.name','Name',array('direction' => 'desc')); ?></th>
		<th>Sub Category</th> 
		<th><?php echo $this->Paginator->sort('Category.active','Active'); ?></th>
		<th>Action</th>	
	</tr>
	<?php if(!empty($Categories)) { 
	$row_count = 1;
	$i=1;
	foreach ($Categories as $Category): ?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $Category['Category']['name']; ?></td>
		<td><?php echo $this->Html->link('View sub category','/admin/categories/subcatList/'.$Category['Category']['id'],array('escape'=>false));  ?></td>
		<td> 
			<?php
				if($Category['Category']['active'] == 'Yes') {
					 echo $this->Html->link('Yes','/admin/categories/status/'.$Category['Category']['id'].'/No',array('escape'=>false)); 	
				} 

				if($Category['Category']['active'] == 'No') {
					 echo $this->Html->link('No','/admin/categories/status/'.$Category['Category']['id'].'/Yes',array('escape'=>false)); 	
				} 
			?>
		</td>
		
		<td align="center">
		<?php //echo $this->Html->link($this->html->image('add_disable.png',array('title'=>'Add Sub Category','alt'=>'Add Category','border'=>'0','escape'=>false,'height'=>'16','width'=>'16')),'/admin/categories/add_subcat/'.$Category['Category']['id'],array('escape'=>false));  ?>
		<?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',array('controller'=>'categories','action'=>'admin_edit',$Category['Category']['id']),array('escape'=>false));?>
		<?php echo $this->Html->link('<i class="fa fa-trash-o"></i>',array('controller'=>'categories','action'=>'admin_del',$Category['Category']['id']),array('escape'=>false,'confirm'=>'Deleting this category will delete its related records as well. Are you sure?'));?>
		</td>
	</tr>
	<?php $i++; $row_count++;  endforeach; ?>
		<?php unset($cat); ?>
		<?php if($this->params['paging']['Category']['pageCount']>1){?>
		<tr>
			<td colspan='7' align="center">
				<span class="paginate_num_left">
				<?php echo $this->Paginator->prev(); ?> &nbsp;
				<!-- Shows the page numbers -->
				<?php echo $this->Paginator->numbers(); ?> &nbsp;
				<?php echo $this->Paginator->next(); ?> &nbsp;<br>
				</span>
				<!-- prints X of Y, where X is current page and Y is number of pages -->
				<span class="paginate_num_right">
				<?php echo $this->Paginator->counter();echo "&nbsp Page"; ?>
				</span>
			</td>
		</tr>
		<?php } ?>
		<?php } else {?>
	<tr>
		<td align="center" colspan="7">No records found.</td>
	</tr>
	<?php
      	
	} ?>
	</table>
	   </td>
	</tr>
</table>
