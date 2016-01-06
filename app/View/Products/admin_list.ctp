<script>
$(document).ready(function(){
	//$('a[rel*=facebox]').facebox() 
	$(".selectcategory").change(function(){
		var formData =$("#categoryid12").val();
		var formUrl   = "<?php echo WWW_BASE_ADMIN.'/products/subcategory';?>";
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
	/* $(".selectsubcategory").change(function(){
        var formData =$("#categoryid1").val();
		var formUrl   = "<?php echo WWW_BASE_ADMIN.'/products/subsubcategory';?>";
	 	$.ajax({ 
			type: 'GET',
			url: formUrl,
			data: {'data':formData},
			success: function(msg){
				$("#categoryid0").show();
				$("#categoryid0").html(msg);
				
			}
		}); 
		return false;
     });  */
});
</script>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Manage Product
			<a class="back_btn" href="<?php echo WWW_BASE."admin/products/add" ?>">Add product</a>
		</td>
	</tr>
	<tr><td align="center"> 
		<form method="GET" action="<?php echo WWW_BASE ?>admin/products/list/">	
			<div class="search_box">
			<input type="text" name="search" id="search" placeholder="Search" value="<?php echo @$_GET['search']; ?>">
			<input type="submit"  value="Search" id="searchbtn" class="btn-common">
			</div>
			<div class="search_box2">
				<label>Sub Category</label>
				<select name='subcategory' id="categoryid1" class="selectsubcategory">
						 <option value="">All</option>
						 <?php 
					if(!empty($Allsubcategory)){
						foreach($Allsubcategory as $subcategory){
					?>
					<option value="<?php echo $subcategory['Category']['id']; ?>"<?php if(isset($_GET['category']) && ($subcategory['Category']['id']==(int)$_GET['subcategory'])){echo 'selected';}?>>
						   <?php echo $subcategory['Category']['name']; ?>
						</option>
					<?php 
						} 
					}
					?>
				</select>
			</div>
			<div class="search_box2">
				<label>Category</label>
				<select name='category' id="categoryid12" class="selectcategory">
						 <option value="">All</option>
					<?php 
					if(!empty($allCategory)){
						foreach($allCategory as $category){
					?>
					<option value="<?php echo $category['Category']['id']; ?>" <?php if(isset($_GET['category']) && ($category['Category']['id']==$_GET['category'])){echo 'selected';}?>>
						   <?php echo $category['Category']['name']; ?>
						</option>
					<?php 
						} 
					}
					?>
				</select>
			</div>
			<div class="search_box2">
				<label>City</label>
				<select name='city' id="categoryid0">
						 <option value="">All</option>
						 <?php 
							if(!empty($Allcity)){
								$city=array();
								foreach($Allcity as $Allcitys){
									$subsub[]=$Allcitys;
							?>
							<option value="<?php echo $Allcitys['City']['id']; ?>" <?php if(isset($_GET['city']) && ($Allcitys['City']['id']==(int)$_GET['city'])){echo 'selected';}?>>
								   <?php 
								   echo $Allcitys['City']['name']; ?>
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
		<th><?php echo $this->Paginator->sort('Product.name','Product name'); ?></th>
		<th><?php echo $this->Paginator->sort('Category.name','Category'); ?></th>
		<th><?php echo $this->Paginator->sort('Category.name','Sub category'); ?></th>
		<th><?php echo $this->Paginator->sort('City.name','City'); ?></th>
		<th><?php echo $this->Paginator->sort('Product.quantity','Quantity'); ?></th>
		<th><?php echo $this->Paginator->sort('Product.price','Price'); ?></th>
		<!--<th> View Image </th>-->
		<th><?php echo $this->Paginator->sort('Product.createdon','Created Date'); ?></th>
		<th>Action</th>	
	</tr>
	<?php if(!empty($data)) { 
	$row_count = 1;
	foreach ($data as $rec):
        
	?>
	<tr>
		<td align="center"><?php echo $rec['Product']['name']; ?></td>
		<td align="center"><?php echo $rec['Category']['name']; ?></td>
		<td align="center"><?php echo $rec['SubCategory']['name']; ?></td>
		<td align="center"><?php echo $rec['City']['name']; ?></td>
		<td align="center"><?php echo $rec['Product']['quantity'];?></td>
        <td align="center"><?php echo $rec['Product']['price'];?></td>		
		<!--<td align="center"><a href="<?php echo WWW_BASE_ADMIN; ?>/products/view_product_image/<?php echo $rec['Product']['id'] ; ?>" rel="facebox">View Image</a></td>-->
		<td align="center"><?php echo date('m-d-Y',strtotime($rec['Product']['createdon'])) ?></td>
		<td align="center">
		<?php  echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',array('controller'=>'products','action'=>'edit',$rec['Product']['id']),array('escape'=>false));?>
		<?php echo $this->Html->link('<i class="fa fa-trash-o"></i>',array('controller'=>'products','action'=>'admin_delete_product',$rec['Product']['id']),array('escape'=>false,'confirm'=>'Do you really wish to delete this Product?'));?>
		</td>
	</tr>
	<?php $row_count++;  endforeach; ?>
		<?php unset($cat); ?>
		<?php if($this->params['paging']['Product']['pageCount']>1){?>
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
		<td align="center" colspan="7">No product found.</td>
	</tr>
	<?php } ?>
	</table>
	   </td>
	</tr>
</table>
