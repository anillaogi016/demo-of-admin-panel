<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Manage Subcategories
			<a class="back_btn" href="<?php echo WWW_BASE."admin/subcategories/add" ?>">Add Sub-Category</a>
		</td>
	</tr>
	<tr><td align="center"> 
		<form method="GET" action="<?php echo WWW_BASE ?>admin/subcategories/list/">	
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
		<th><?php echo $this->Paginator->sort('Subcategory.name','Name'); ?></th>
		<th>Subsub Category</th>	
		<th><?php echo $this->Paginator->sort('Subcategory.status','Status'); ?></th>
		<th>Action</th>	
	</tr>
	<?php if(!empty($Subcategories)) { 
	$row_count = 1;
	$i=1;
	foreach ($Subcategories as $Subcategories): ?>
	<tr>
		<td  align="center"><?php echo $i; ?></td>
		<td  align="center"><?php echo $Subcategories['Subcategory']['name']; ?></td>
		<td  align="center"><?php echo $this->Html->link('View sub category','/admin/subcategories/subcatList/'.$Subcategories['Subcategory']['id'],array('escape'=>false));  ?></td>
		<td  align="center">
			<?php
				if($Subcategories['Subcategory']['status'] == 'Active') {
					 echo $this->Html->link('Active','/admin/subcategories/status/'.$Subcategories['Subcategory']['id'].'/Inactive',array('escape'=>false)); 	
				} 

				if($Subcategories['Subcategory']['status'] != 'Active') {
					 echo $this->Html->link('Not Active','/admin/subcategories/status/'.$Subcategories['Subcategory']['id'].'/Active',array('escape'=>false)); 	
				} 
			?>
		</td>
		
		<td align="center">
		<?php // echo $this->Html->link($this->html->image('add_disable.png',array('title'=>'Add Sub Category','alt'=>'Add Category','border'=>'0','escape'=>false,'height'=>'16','width'=>'16')),'/admin/categories/add_subcat/'.$Category['Category']['id'],array('escape'=>false));  ?>
		<?php // echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',array('controller'=>'categories','action'=>'admin_edit',$Category['Category']['id']),array('escape'=>false)); ?>
		<?php echo $this->Html->link('<i class="fa fa-trash-o"></i>',array('controller'=>'subcategories','action'=>'admin_del',$Subcategories['Subcategory']['id']),array('escape'=>false,'confirm'=>'Deleting this category will delete its related records as well. Are you sure?'));?>
		</td>
	</tr>
	<?php $i++; $row_count++;  endforeach; ?>
		<?php unset($cat); ?>
		<?php if($this->params['paging']['Subcategory']['pageCount']>1){?>
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
