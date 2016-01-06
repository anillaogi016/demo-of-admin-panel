<!-- Header -->
<?php 
$url = WWW_BASE; 
//pr($this->Session->read('Auth.Admin'));die;
if(!empty($check_login)){ ?>
<div class="logo"> 
		<?php 
		
		//echo $this->Html->link($this->Html->image("logo.png", array("alt" => "KwikGrocery","border"=>"0","title"=>"KwikGrocery","style"=>"    width: 200px;    margin-top: 15px;")),$url."admin/users/dashboard",array('escape'=>false));
		?>
</div> 
 <div class="logout">
<div class="logout-text"><?php echo $this->Html->link('Logout',$url."admin/users/logout",array('escape'=>false));
		?></div></div> <span class="welcome_msg">Welcome <?php echo ucwords($this->Session->read('Auth.Admin.username')); ?></span>
<?php } else { ?>
<div class="login-header">
   <div class="logo">
		<?php //echo $this->Html->link($this->Html->image("logo.png", array("alt" => "KwikGrocery","border"=>"0","title"=>"KwikGrocery","style"=>"    width: 200px;    margin-top: 15px;")),$url."admin/users/login",array('escape'=>false));
		?>
   </div>
</div>
<?php } ?>