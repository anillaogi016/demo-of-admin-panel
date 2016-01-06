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
<title>CMYCO</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
<table width="600" border="0" cellspacing="0" align="center" style="font-family: 'Open Sans', sans-serif; border:1px solid #f1f1f1;">
	  <tr>
	    <td style="padding:0 20px;"><img src="http://braintechnosys.net/cmyco/img/logo.png" alt="" style="float: left; padding-bottom: 30px; padding-top: 15px;"/></td>
	  </tr>
	  <tr>
	    <td style="color:#ffffff; background:#405e73; padding:10px 20px; border-bottom:5px solid #3fbeb5;  font-size:18px;" width="100%"></td>
	    <td style=" background:#405e73; border-bottom:5px solid #3fbeb5;" width="100%"></td>
	    <td style="background:#405e73; border-bottom:5px solid #3fbeb5;" width="100%"></td>
	  </tr>
	  
		<?php echo $this->fetch('content'); ?>
		
	  <tr>
	    <td style="color:#ffffff; background:#3fbeb5; padding:10px 20px; border-top:5px solid #405e73; font-size:12px; text-align:center;" width="100%">&copy; 2011-2015 My Training.MU</td>
	    <td style=" background:#3fbeb5; border-top:5px solid #405e73;" width="100%"></td>
	    <td style="background:#3fbeb5; border-top:5px solid #405e73;" width="100%"></td>
	  </tr>
	  
	</table>
	
</body>
</html>








