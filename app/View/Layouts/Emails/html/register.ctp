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
 * @package       app.View.Layouts.Email.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Training.MU</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body style="margin:0; padding:0; background-color:#f2f2f2;">
<table width="600" border="0" cellpadding="0" cellspacing="0" bgcolor="#fff" style="margin:0 auto">
  <tr>
    <td width="50px">&nbsp;</td>
    <td><a href="<?php echo WWW_BASE?>" style="float:left; margin:30px 0 20px;">
	<?php //echo $this->html->image('logo.png',array('width'=>'219','height'=>'60','alt'=>'my training'));?>
	<img src="http://braintechnosys.net/cmyco/img/logo.png" width="219" height="60" alt="my trainning" />
	</a></td>
    <td width="50px">&nbsp;</td>
  </tr>
  
	  
		<?php echo $this->fetch('content'); ?>

	
  <tr>
    <td colspan="3" align="center" style="background:#f2f2f2; font-family:Arial, Helvetica, sans-serif; font-size:10px; line-height:14px; color:#999999; padding:15px 0 20px;">
    Sent to <?php echo $user['Trainer']['email'];?><br />
    
    </td>
  </tr>  
</table>

</body>
</html>








