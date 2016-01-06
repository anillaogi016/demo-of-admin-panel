<script>
$(document).ready(function(){
	$(".selectcategory").change(function(){
        var formData =$("#categoryid12").val();
		var formUrl   = "<?php echo WWW_BASE_ADMIN.'/subsubcategories/subsubcategory';?>";
	 	$.ajax({ 
			type: 'GET',
			url: formUrl,
			data: {'data':formData},
			success: function(msg){
				$("#categoryid1").show();
				$("#categoryid1").html(msg);
				
			}
		}); 
		return false;
     });
});
</script>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	
	<tr>
		<td class="page-title change_password_title">
			Manage Locality <?php if(isset($city_name)) { echo "of ".$city_name; } ?>
			<a class="back_btn" href="<?php echo WWW_BASE."admin/localities/add" ?>">Add Locality</a>
		</td>
	</tr>
	<tr><td align="center"> 
		<form method="GET" action="<?php echo WWW_BASE ?>admin/localities/localityList/">	
			<div class="search_box">
			    <input type="text" name="search" id="search" placeholder="Search Locality" value="<?php echo @$_GET['search']; ?>">
			    <input type="submit"  value="Search" id="searchbtn" class="btn-common">
			</div>
			<div class="search_box2">
				<label>City</label>
				<select name='city_id' id="categoryid1" class="selectsubcategory">
						<option value="">All</option>
						<?php  if(!empty($allCity)){
							foreach($allCity as $allCities){
						?>
						<option value="<?php echo $allCities['City']['id']; ?>" <?php if(isset($_GET['city_id']) && ($allCities['City']['id']==$_GET['city_id'])){echo 'selected';}?>>
							   <?php echo $allCities['City']['name']; ?>
							</option>
						<?php 
							} 
						}
						?>
				</select>
			</div>
			<div class="search_box2">
				<label>State</label>
				<select name='state' id="categoryid12" class="selectcategory">
						 <option value="">All </option>
					<?php 
					if(!empty($allState)){
						foreach($allState as $allStates){
					?>
					<option value="<?php echo $allStates['State']['id']; ?>" <?php if(isset($_GET['state']) && ($allStates['State']['id']==$_GET['state'])){echo 'selected';}?>>
						   <?php echo $allStates['State']['name']; ?>
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
	  <th><?php echo $this->Paginator->sort('Locality.name','Locality Name'); ?></th>
	  <th><?php echo $this->Paginator->sort('City.name','City Name'); ?></th>
	  <th><?php echo $this->Paginator->sort('State.name','State Name'); ?></th>
	  <th>Action</th>
	</tr>
	<?php if(!empty($data)) { 
	$row_count = 1;
	foreach ($data as $rec) { 
	//pr($rec);die;
		?>
	<tr>
	    <td align="center"><?php echo $rec['Locality']['name']; ?></td>
		 <td align="center"><?php echo $rec['City']['name']; ?></td>
	    <td align="center"><?php echo $rec['State']['name']; ?></td>
		<td align="center">
		    <?php  echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',array('controller'=>'localities','action'=>'admin_edit',$rec['Locality']['id']),array('escape'=>false)); ?>
		   <?php echo $this->Html->link('<i class="fa fa-trash-o"></i>',array('controller'=>'localities','action'=>'admin_del',$rec['Locality']['id']),array('escape'=>false,'confirm'=>'Deleting this category will delete its related records as well. Are you sure?'));?>
		</td>
		
	</tr>
	<?php $row_count++;  }; ?>
		<?php unset($cat); ?>
		<?php if($this->params['paging']['Locality']['pageCount']>1){?>
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