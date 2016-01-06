    	<div class="wrapper">
	    	<div class="brand"><?php echo $this->Html->image('logo.png', array('url' =>  WWW_BASE ,'alt' => 'MyTraining','title'=>'MyTraining'));?></div>
			
			<?php echo $this->Session->flash(); ?>
			
    		<nav>
            	<ul>				    
				    <?php 
					    if(!$check_login){ 
					?>					
					<li><a id="register" href="javascript:void(0)">Register</a></li>
                    <li><a id="login" href="javascript:void(0)">Login</a></li>	
					<?php }else{
					if(isset($user['user_type'])){ ?>                	
					    <li><a href="<?php echo WWW_BASE.'users/dashboard'; ?>">My Account</a></li>
                    <? }else{ ?>
                        <li><a href="<?php echo WWW_BASE.'trainers/dashboard'; ?>">My Account</a></li>
					<? } }?>					
					<li><a href="<?php echo WWW_BASE.'users/contact_us'; ?>">Contact</a></li>					                  
                </ul>
            </nav>
        </div>