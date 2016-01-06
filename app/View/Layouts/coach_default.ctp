<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CMYCO :: Coach Panel');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
<?php echo $this->Html->charset(); ?>
<title>
<?php echo $cakeDescription ?>:
<?php //echo $title; ?>
</title>
<?php
echo $this->Html->meta('icon');
echo $this->Html->css(array('bootstrap','admin/style','jquery-ui','font-awesome','jquery-ui-timepicker-addon'));
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>

<!-- JQuery engine script-->
<?php echo $this->Html->Script(array('jquery_1.11.1.min','/js/ckeditor/ckeditor','jquery.validate','bootstrap.min','jquery-ui','jquery-ui-timepicker-addon')); ?>      

</head>
<body>
<div class="main_wrapper">
	<div class="main_header">
	<div class="wrapper">
		<?php echo $this->Element("coach_header"); ?> 
		</div>
	</div>
    
<div class="wrapper">
    <div class="container">
		<?php if(!empty($check_login)){ ?>
			<div class="left_side">
				<?php echo $this->Element("coach_left_nav"); ?> 
			</div>
			<div class="content_right"> 
				<?php echo $this->fetch('content'); ?>
			</div>
		<?php } else {?>	
			<div class="content"> 
				<?php echo $this->fetch('content'); ?>
			</div>
        <?php } ?>
    </div>

	<div class="clr"></div>
	<div class="testing_text">
		<?php //echo $this->element('sql_dump'); ?> 
	</div>
    <div class="clr"></div>
</div> 
    
	<div class="clr"></div>
    <?php echo $this->Element("coach_footer"); ?>
</div>
</body>
</html>