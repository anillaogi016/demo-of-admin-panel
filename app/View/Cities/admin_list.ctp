<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Manage Cities <?php if(isset($state_name)) { echo "of ".$state_name; } ?>
			<a class="back_btn" href="<?php echo WWW_BASE."admin/cities/add" ?>">Add City</a>
		</td>
	</tr>
	<tr><td align="center"> 
		<form method="GET" action="<?php echo WWW_BASE ?>admin/cities/list/">	
			<div class="search_box">
			<input type="text" name="search" id="search" placeholder="Search City" value="<?php echo @$_GET['search']; ?>">
			<input type="submit"  value="Search" id="searchbtn" class="btn-common">
			</div>
			<div class="search_box2">
				    <label>State</label>
					<select name='state' id="categoryid12">
						     <option value="">All</option>
							<?php 
							if(!empty($allState)){
								
								foreach($allState as $state){
							?>
							<option value="<?php echo $state['State']['id']; ?>" <?php if(isset($_GET['state']) && ($state['State']['id']==$_GET['state'])){echo 'selected';}?>>
								   <?php echo $state['State']['name']; ?>
								</option>
							<?php 
								} 
							}
							?>
					</select>
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
		<th><?php echo $this->Paginator->sort('City.name','City Name'); ?></th>
		<th><?php echo $this->Paginator->sort('State.name','State Name'); ?></th>
		
		<th>Manage locality</th>	
		<th>Action</th>	
	</tr>
	<?php if(!empty($Cities)) { 
	$row_count = 1;
	$i=1;
	foreach ($Cities as $City): ?>
	<tr>
		<td  align="center"><?php echo $i; ?></td>
		<td  align="center"><?php echo $City['City']['name']; ?></td>
		<td  align="center"><?php echo $City['State']['name']; ?></td>
		<td  align="center"><?php echo $this->Html->link('View locality','/admin/localities/localityList/?city_id='.$City['City']['id'].'&state='.$City['State']['id'],array('escape'=>false));  ?></td>
		
		<td align="center">
		<?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',array('controller'=>'cities','action'=>'admin_edit',$City['City']['id']),array('escape'=>false)); ?>
		<?php echo $this->Html->link('<i class="fa fa-trash-o"></i>',array('controller'=>'cities','action'=>'admin_del',$City['City']['id']),array('escape'=>false,'confirm'=>'Deleting this category will delete its related records as well. Are you sure?'));?>
		</td>
	</tr>
	<?php $i++; $row_count++;  endforeach; ?>
		<?php unset($cat); ?>
		<?php if($this->params['paging']['City']['pageCount']>1){?>
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
<style>
 .btn-common1 {
	float: right;
    padding: 9px 30px;
    color: #fff!important;
    background: #02121f;
    border-radius: 21px;
    border: none;
    font-size: 14px;
    cursor: pointer;
    margin-left: 10px; 
	}
</style>