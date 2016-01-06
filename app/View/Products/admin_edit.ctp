<?php echo $this->Form->create('Product', array('novalidate' => true, 'url'=>array('controller'=>'products','action'=>'admin_edit'),'enctype'=>'multipart/form-data','id'=>'productadd'));
?>
<?php //echo $this->Html->Script(array('jquery_1.11.1.min','bootstrap.min','jquery.validate')); ?>      

<script>
$(document).ready(function(){
	if($("#productadd").validate){
		$("#productadd").validate({
										
			 rules:{
			 'data[Product][name]':{
					required: true,
					maxlength: 60
				},
			'data[Product][product_code]':{
				    required: true,
                    maxlength:30					
			    }
			 },

			messages:{
				'data[Product][name]':{
					required: 'This field is required.',
					maxlength: 'Max Character length is 50 or less.'
				},
				'data[Product][product_code]':{
					required: 'Product code is required.',
					maxlength: 'Max lenght should be less then 30'
				}
			}						
	    });
	}
	$(".stateSelect").change(function(){
        var formData =$("#stateSelect").val();
	    var formUrl   = "<?php echo WWW_BASE_ADMIN.'/products/city';?>";
	 	$.ajax({ 
			type: 'GET',
			url: formUrl,
			data: {'data':formData},
			success: function(msg){
				$("#cityselect").show();
				$("#cityselect").html(msg);
				
			}
		}); 
		return false;
     });
	 $(".categorySelect").change(function(){
        var formData =$("#categorySelect").val();
	    var formUrl   = "<?php echo WWW_BASE_ADMIN.'/products/subcategory';?>";
	 	$.ajax({ 
			type: 'GET',
			url: formUrl,
			data: {'data':formData},
			success: function(msg){
				$("#subcategoryselect").show();
				$("#subcategoryselect").html(msg);
				
			}
		}); 
		return false;
     });
});
function goBack() {
		window.history.back();
}
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.user_dsply > img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<style>
label.error {
    color: red;
}
.form-control1{
	color: #555;
    display: block;
    font-size: 14px;
    height: 34px;
    line-height: 1.42857;
    margin-left: 9px;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 37%;
}
</style>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Edit Product
		</td>
	</tr>
	<tr><td height="10px"> </td></tr>
	<tr>
		<td align="center">
			<table cellpadding="0" cellspacing="0" border="0" class="change-password form_section">
				<h2><?php echo $this->Session->flash();?></h2>
				
				<tr>
					<td> Select State <span class="required">*</span>:</td>
					<td>
						<?php 
						echo $this->Form->hidden('id');
						echo $this->Form->input('state_id',array('type'=>'select', 'empty' => 'Select one' ,'options' => $allState ,'class' => 'required form-control stateSelect','id'=>'stateSelect','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td> Select City <span class="required">*</span>:</td>
					<td>
						<?php echo $this->Form->input('city_id',array('type'=>'select', 'empty' => 'Select one','options'=>$allCity,'class' => 'required form-control cityselect','id'=>'cityselect','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td> Select Category <span class="required">*</span>:</td>
					<td>
						<?php echo $this->Form->input('category_id',array('type'=>'select', 'empty' => 'Select one' ,'options' => $allCategory ,'class' => 'required form-control categorySelect','id'=>'categorySelect','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td> Select Subcategory <span class="required">*</span>:</td>
					<td>
						<?php echo $this->Form->input('subcat_id',array('type'=>'select', 'empty' => 'Select one','options'=>@$allsubCategory,'class' => 'required form-control subcategoryselect','id'=>'subcategoryselect','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td>Product Name<span class="required">*</span>: </td>
					<td>
						<?php echo $this->Form->input('name',array('type'=>'text','class' => 'required form-control','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td>Product Code<span class="required">*</span>: </td>
					<td>
						<?php echo $this->Form->input('product_code',array('type'=>'text','class' => 'required  form-control','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td>Quantity<span class="required">*</span>: </td>
					<td>
						<?php echo $this->Form->input('quantity',array('type'=>'text','class' => 'required  number form-control','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td>Price<span class="required">*</span>: </td>
					<td>
						<?php echo $this->Form->input('price',array('type'=>'text','class' => 'required  number form-control','label'=>false)); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td>Full Description: </td>
					<td>
						<?php echo $this->Form->input('full_description',array('type'=>'textarea','class' => 'form-control','label'=>false,'rows'=>'5','col'=>'20')); ?>
						<div class="clr10"></div>
					</td>
				</tr>
				<tr>
					<td>Product Image </td>
					&nbsp;
					<td>
						<?php echo $this->Form->file('Company.image',array('name'=>'image','class'=>'form-control1',"accept"=> "(jpe?g|gif|png)","size"=>"15",'onchange'=>'readURL(this)'));?>
						 <span class="user_dsply" style="margin: 10px 10px;float:left;">
						 <?php echo $this->Html->image("/img/product_img/".$image,array("width"=>200,"height"=>150,"escape"=>false)); ?>
						 </span>
					   <div class="clr10"></div>
					</td>
				</tr>
				<tr>
				   <td></td>
				   <td><button  class="btn-common" type="submit"  >Save</button>&nbsp;<button  class="btn-common" type="submit"  id="Back" onclick="goBack()">Cencel</button>
				   <?php //echo $this->Form->end(); ?></td>
				</tr>
			</table>
	   </td>
	</tr>
</table>
<?php echo $this->Form->end(); ?>