<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Manage Customers
		</td>
	</tr>
	<tr><td align="center"> <form method="GET" action="<?php echo WWW_BASE ?>admin/users/list/">
	<!--div class="xls_wrap"> <span>Export AS:</span> 
					<?php /*echo $this->html->link('<img src="'.WWW_BASE.'images/xls-icon.png">',array('controller'=>'users','action'=>'admin_export_excel','User'),array('escape'=>false,'title'=>'Export Members As Excel', 'class'=>'excel_icon'));*/?>&nbsp;
					<?php echo $this->html->link('<img src="'.WWW_BASE.'images/csv-icon.png">',array('controller'=>'users','action'=>'admin_export_csv','User'),array('escape'=>false,'title'=>'Export Members As CSV', 'class'=>'csv_icon')); ?>
				</div-->
				<div class="search_box">
                <input type="text" name="search" id="search" placeholder="Search" value="<?php echo @$_GET['search']; ?>">
			    <input type="submit"  value="Search" name="sort" id="searchbtn" class="btn-common">
                </div>
			</form></td></tr>
    <tr><td height="10px"> </td></tr>
	<tr>
		<td align="center">
	
	<table border="1" class="table_section">
<h2><?php echo $this->Session->flash();?></h2>
	<tr class="th_align">
		<th><?php echo $this->Paginator->sort('User.name','Name'); ?></th>
		<th><?php echo $this->Paginator->sort('User.phone','Telephone'); ?></th>		
		<th><?php echo 'District'; ?></th>
		
		<th>Status</th>
		<th>Action</th>	
	</tr>
	<?php if(!empty($data)) { 
	$row_count = 1;
	foreach ($data as $rec): ?>
	<tr>
		<td><?php echo $rec['User']['name']; ?></td>
		<td><?php echo $rec['User']['phone']; ?></td>		
		<td><?php echo $rec['Town']['name']; ?></td>
		
		<td><a href="<?php if($rec['User']['status']=='Active'){$status = 'Inactive';}else{$status = 'Active';}echo WWW_BASE."admin/users/changestatus/".$rec['User']['id']."/status:".$status; ?>"><?php echo $rec['User']['status']; ?></a></td>
		<td align="center">
		<?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',array('controller'=>'users','action'=>'admin_edit_customer',$rec['User']['slug']),array('escape'=>false));?>
		<?php echo $this->Html->link('<i class="fa fa-trash-o"></i>',array('controller'=>'users','action'=>'admin_delete_customer',$rec['User']['id']),array('escape'=>false,'confirm'=>'Do you really wish to delete this customer?'));?>
		</td>
	</tr>
	<?php $row_count++;  endforeach; ?>
		<?php unset($cat); ?>
		<?php if($this->params['paging']['User']['pageCount']>1){?>
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
