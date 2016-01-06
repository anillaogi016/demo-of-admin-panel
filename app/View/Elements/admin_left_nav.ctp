<?php echo $this->Html->Script(array('/js/admin/jquery.tablesorter.min.js', '/js/admin/scriptbreaker-multiple-accordion-1.js')); ?> 
<script language="JavaScript">

$(document).ready(function() {
	$(".admin-left-menu").accordion({
		accordion:false,
		speed: 500,
		closedSign: '+',
		openedSign: '-'
	});

var errorDiv = $('.active:visible').first();
var scrollPos = errorDiv.offset().top;
$('#menu').scrollTop(scrollPos - 300);
});

</script>
<?php echo $this->Html->Script('/js/admin/menu.js'); ?> 
<div class="left_nav">   
    <ul id="menu" class="admin-left-menu">
        <li>
            <a href="#">Dashboard</a>
            <ul>
                <li <?php if ($this->params['action'] == "admin_dashboard" && $this->params['controller'] == "users") { ?>class="active" <?php } ?>><a href="<?php echo WWW_BASE.'admin/users/dashboard'; ?>">Control Panel</a>
				</li>
				<li <?php if ((($this->params['action'] == "admin_edit")) && $this->params['controller'] == "users") { ?>class="active" <?php } ?>><a href="<?php echo WWW_BASE.'admin/users/edit'; ?>">Edit Profile</a></li>
				<li <?php if ($this->params['action'] == "admin_change_password" && $this->params['controller'] == "users") { ?>class="active" <?php } ?>><a href="<?php echo WWW_BASE.'admin/users/change_password'; ?>">Change Password</a></li>
			</ul>
        </li>
		</li>
        	<li>
            <a href="#">Manage Users</a>
             <ul>
				<li <?php if(in_array($this->params['action'],array("admin_list","admin_add",'admin_edit_user')) && $this->params['controller'] == "users") { ?>class="active" <?php } ?>><a href="<?php echo $this->HTML->url('/admin/users/list'); ?>">Browse Users</a></li>			
            </ul>

        </li>
       <li>
            <a href="#">Manage Location</a>
             <ul>
				<li <?php if(in_array($this->params['action'],array("admin_list","admin_add","admin_edit")) && $this->params['controller'] == "states") { ?>class="active" <?php } ?>><a href="<?php echo $this->HTML->url('/admin/states/list'); ?>">Browse States</a></li>			
                <li <?php if(in_array($this->params['action'],array("admin_list","admin_add","admin_edit")) && $this->params['controller'] == "cities") { ?>class="active" <?php } ?>><a href="<?php echo $this->HTML->url('/admin/cities/list'); ?>">Browse Cities</a></li>			
            	<li <?php if(in_array($this->params['action'],array("admin_localityList","admin_add","admin_edit")) && $this->params['controller'] == "localities") { ?>class="active" <?php } ?>><a href="<?php echo $this->HTML->url('/admin/localities/localityList'); ?>">Browse localities</a></li>			
            </ul>
        </li>
        </li>
        	<li>
            <a href="#">Manage Categories</a>
             <ul>
				<li <?php if(in_array($this->params['action'],array("admin_list","admin_add","admin_edit","admin_subcatList","admin_add_subcat")) && $this->params['controller'] == "categories") { ?>class="active" <?php } ?>><a href="<?php echo $this->HTML->url('/admin/categories/list'); ?>">Browse Categories</a></li>
			</ul>

        </li>
		 </li>
        	<li>
            <a href="#">Manage Products</a>
             <ul>
				<li <?php if(in_array($this->params['action'],array("admin_list","admin_add","admin_edit")) && $this->params['controller'] == "products") { ?>class="active" <?php } ?>><a href="<?php echo $this->HTML->url('/admin/products/list'); ?>">Browse Products</a></li>
			</ul>
        </li>
		 </li>
        	<li>
            <a href="#">Manage Coupons</a>
             <ul>
				<li <?php if(in_array($this->params['action'],array("admin_list","admin_add","admin_edit")) && $this->params['controller'] == "coupons") { ?>class="active" <?php } ?>><a href="<?php echo $this->HTML->url('/admin/coupons/list'); ?>">Browse Coupons</a></li>
			</ul>

        </li>
    </ul>
</div>