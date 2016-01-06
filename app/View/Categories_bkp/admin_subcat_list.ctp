<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Manage Categories
			<a class="back_btn" href="<?php echo WWW_BASE."admin/categories/add" ?>">Add Category</a>
		</td>
	</tr>
	<tr><td align="center"> 
		<form method="GET" action="<?php echo WWW_BASE ?>admin/categories/subcatList/">	
			<div class="search_box">
			<input type="text" name="search" id="search" placeholder="Search Category" value="<?php echo @$_GET['search']; ?>">
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
		<th><?php echo $this->Paginator->sort('Category.name','Sub-Category  Name'); ?></th>
		<th><?php echo $this->Paginator->sort('Category.status','Status'); ?></th>
		<th>Action</th>	
	</tr>
	<?php if(!empty($Categories)) { 
	$row_count = 1;
	$i=1;
	foreach ($Categories as $Category): ?>
	<tr>
		<td  align="center"><?php echo $i; ?></td>
		<td  align="center"><?php echo $Category['Category']['name']; ?></td>
		<td  align="center">
			<?php
				if($Category['Category']['status'] == 'Active') {
					 echo $this->Html->link('Active','/admin/categories/status/'.$Category['Category']['id'].'/Inactive',array('escape'=>false)); 	
				} 
				if($Category['Category']['status'] != 'Active') {
					 echo $this->Html->link('Not Active','/admin/categories/status/'.$Category['Category']['id'].'/Active',array('escape'=>false)); 	
				} 
			?>
		</td>
		
		<td align="center">
		<?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',array('controller'=>'categories','action'=>'admin_edit',$Category['Category']['id']),array('escape'=>false));?>
		<?php echo $this->Html->link('<i class="fa fa-trash-o"></i>',array('controller'=>'categories','action'=>'admin_del',$Category['Category']['id']),array('escape'=>false,'confirm'=>'Deleting this category will delete its related records as well. Are you sure?'));?>
		</td>
	</tr>
	<?php $i++; $row_count++;  endforeach; ?>
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
	<?php
      	
	} ?>
	</table>
	   </td>
	</tr>
</table>
