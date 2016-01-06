<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array('Acl','Auth'=>array('authorize' => array('Controller')),'Cookie','Session');
	public $uses = array('User','Admin');
    var $helpers = array('Html','Form');
	public $BlowFish;	
	
	public function beforeRender()	{
		//pr($this->Auth->user);die
		$id = $this->Auth->user('id');
		$user = $this->Auth->user();
		$this->set('check_login',$id);
		$this->set('user',$user); 		
		
	}
	
	function beforeFilter()
	{
	    $this->BlowFish = new BlowfishPasswordHasher();		
		if($this->request->prefix=="admin")
		{
			//Security::setHash('md5');
			AuthComponent::$sessionKey = 'Auth.Admin';
			$this->Auth->loginAction = array('controller' => 'users', 'action'=> 'admin_login');
			$this->Auth->loginRedirect = array('controller' => 'users', 'action'=> 'admin_dashboard');
			$this->Auth->logoutRedirect = array('controller' => 'users', 'action'=> 'admin_login');
			$this->Auth->authenticate = array(
				'Form' => array(				
					'userModel' => 'User',
					'passwordHasher' => 'Blowfish',
					'fields' => array(
						'username' => 'email',
						'password' => 'password'
					),
                    'scope' => array('User.role' => 'Admin')
				)
			);
            if (!$this->Auth->loggedIn()) {
				$this->Auth->authError = false;
			}
			$this->Auth->allow('admin_login');
			$this->layout = 'admin_default';
		}
		if($this->request->prefix=="")
		{
			//Security::setHash('md5');
			AuthComponent::$sessionKey = 'Auth.User';
			$this->Auth->loginAction = array('controller' => 'users', 'action'=> 'login');
			$this->Auth->loginRedirect = array('controller' => 'users', 'action'=> 'dashboard');
			$this->Auth->logoutRedirect = array('controller' => 'users', 'action'=> 'login');
			$this->Auth->authenticate = array(
				'Form' => array(				
					'userModel' => 'User',
					'passwordHasher' => 'Blowfish',
					'fields' => array(
						'username' => 'email',
						'password' => 'password'
					),
                    'scope' => array('User.role' => 'User')
				)
			);
            if (!$this->Auth->loggedIn()) {
				$this->Auth->authError = false;
			}
			$this->Auth->allow('login');
			$this->layout = 'default';
		}
	}
	function isAuthorized($user) {
    // return false;
		return $this->Auth->loggedIn();
	}
	function generateRandomString($length = null) {
		if(empty($length)){
			$length = 10;
		}
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
	function _date($format="r", $timestamp=false, $timezone=false)
{
    $userTimezone = new DateTimeZone(!empty($timezone) ? $timezone : 'GMT');
    $gmtTimezone = new DateTimeZone('GMT');
    $myDateTime = new DateTime(($timestamp!=false?date("r",(int)$timestamp):date("r")), $gmtTimezone);
    $offset = $userTimezone->getOffset($myDateTime);
    return date($format, ($timestamp!=false?(int)$timestamp:$myDateTime->format('U')) + $offset);
}
}