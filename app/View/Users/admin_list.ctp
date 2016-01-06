
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Manage Users
			<a class="back_btn" href="<?php echo WWW_BASE."admin/users/add" ?>">Add User</a>
		</td>
	</tr>
	<tr><td align="center"> 
		<form method="GET" action="<?php echo WWW_BASE ?>admin/users/list/">	
			<div class="search_box">
			<input type="text" name="search" id="search" placeholder="Search State" value="<?php echo @$_GET['search']; ?>">
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
		<!--<th><?php echo $this->Paginator->sort('User.email',' User Email'); ?></th>-->
		<th><?php echo $this->Paginator->sort('User.mobile',' User Mobile'); ?></th>	
		<th>Action</th>	
	</tr>
	<?php
	if(!empty($Users)) { 
    $row_count = 1;
	$i=1;
	foreach ($Users as $User): 
	?>
	<tr>
		<td  align="center"><?php echo $i; ?></td>
		<!--<td  align="center"><?php echo $User['User']['email']; ?></td>-->
		<td  align="center"><?php echo $User['User']['mobile']; ?></td>
		<td align="center">
		<?php  echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',array('controller'=>'users','action'=>'admin_edit_user',$User['User']['id']),array('escape'=>false)); ?>
		<?php echo $this->Html->link('<i class="fa fa-trash-o"></i>',array('controller'=>'users','action'=>'admin_del',$User['User']['id']),array('escape'=>false,'confirm'=>'Are you sure?'));?>
		</td>
	</tr>
	<?php $i++; $row_count++;  endforeach; ?>
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
	<?php
      	
	} ?>
	</table>
	   </td>
	</tr>
</table>
