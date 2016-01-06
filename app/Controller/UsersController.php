<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email'); 
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController {
	public $uses = array('User');
			
	var $helpers = array('Html', 'Form','Js' => array('Jquery'));

    public $components = array('Auth','Session','Email','Upload'/* ,'Image' */);
	public $allowedActions =array('admin_forgot_password','admin_login','app_lastactivity','app_login1','app_forgot_password1','app_user_registration1','app_settings1','app_active_users1','app_logout1');
    function beforeFilter() {
		parent::beforeFilter();
		if($this->Auth->loggedIn() && in_array($this->action,$this->allowedActions))
		{   
	        if($this->Auth->user('role') =='Admin'){
        	    //$this->redirect(array('controller'=>'users','action'=>'admin_dashboard'));
        	    $this->redirect(WWW_BASE.'admin/users/dashboard');
			}
			
		}
		$this->Auth->allow($this->allowedActions);	
		
		if ($this->request->is('ajax')) {
			$this->layout = '';
		}
	}
	
	
    public function index(){
		//pr($this->Session->read('Auth'));die;
	    //$this->Session->destroy();
		
	}

	public function dashboard(){
		$this->autoRender=false;
	}
	function logout(){
		$this->autoRender=false;
		$this->Auth->logout();
		$response['message']='Successfully LoggedOut';
		$response['result']='0';
		echo json_encode($response);
		exit;
	}
	public function admin_login(){
        /* $data['User']['email'] = 'ashwani@braintechnosys.com';
        $data['User']['password'] = 'admin';		
        $data['User']['mobile'] = '9876346348';
        $this->User->save($data); */		
		if($this->request->is(array('post','put'))){
			if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
			$this->Session->setFlash(__('Invalid Username/Password, try again.','flash_error'));
		}		
	}
	
	
		function admin_edit()
	{
		$id = $this->Auth->user('id');
		
		$data = $this->User->findById($id);
		$this->set(compact(array('data')));
		 if($this->request->is(array('post', 'put'))) {						
			$this->request->data['User']['id'] = $this->Auth->user('id');
			$this->User->id = $this->Auth->user('id');
			if ($this->User->save($this->request->data)) {
				
                $updated = $this->User->findById($this->Auth->user('id'));
				//pr($updated); die;
				$this->Session->write('Auth.Admin.email',$updated['User']['email']);				
				$this->Session->setFlash('Your profile has been updated successfully.','default',array('class' => 'success_message'));
			    //$this->redirect(array('controller'=>'users','action'=>'admin_edit'));
			    $this->redirect(WWW_BASE.'admin/users/edit');
			}

		}
		
	}
	
	
	function admin_dashboard(){
		
	}
	function admin_logout(){
		return $this->redirect($this->Auth->logout());
	}
	public function admin_forgot_password()
	{
		
		if($this->request->isPost()){
			if(!empty($this->data['User']['email'])){
				$email = $this->data['User']['email'];
				$user = array();
	
				//check the email
				$user = $this->User->find('first',array('conditions'=>array('email'=> $email,)));
		  
				if(!empty($user)){ 
					
					$password = $this->generateRandomString(); 
					//$pass=$this->BlowFish->hash($password);
					$this->User->id = $user['User']['id'];
					$this->User->saveField('password', $password);					
					$name = $user['User']['username'];
					$subject = "User Password Reset";
					$body ="Hi $name, <br/><br/>Your new paswword is:- ".$password;
					$body.="<br/><br/>Thanks & Regards,<br/>".SIGNATURE;
					$Email = new CakeEmail();
					//$Email->config('smtp');
					$Email->viewVars(array('name' => $name,'to'=>$user['User']['email'], 'password' => $password));
					$Email->template('forgot_password');
					$Email->from(array(FROM_EMAIL=>'CMYCO Admin'));
					$Email->to($user['User']['email']);
					$Email->subject($subject);
					$Email->emailFormat('html');
					$Email->send();
					//mail('ashwani@braintechnosys.com',)
					$this->data = array();
					$this->Session->setFlash('The password has been sent to your email.','default',array('class' => 'success_messag'));
                    $this->redirect($this->Auth->logout());					
				}
				else{
					$this->Session->setFlash("Email doesn't exist.",'default',array('class' => 'bt-error'));	
				}
			}else{
				
				$this->Session->setFlash('Please enter Email.','default',array('class' => 'bt-error'));
		   }
        }
	}
	function admin_change_password()
	{
		$uid = $this->Auth->user('id');
		
		$this->User->id = $uid;
		$user = $this->User->read();
		$this->set('user',$user);
		
		if($this->request->isPost())
		{   
			$userdata = $this->User->findById($uid);
			if(!empty($this->data['User']['oldpassword'])&& !empty($this->data['User']['password']) && !empty($this->data['User']['confirm_password'])){
				
				if(($this->data['User']['password']!=$this->data['User']['confirm_password']) || (($this->BlowFish->check( $this->data['User']['oldpassword'] , $userdata['User']['password'] )) == false) || ($this->data['User']['oldpassword'] == $this->data['User']['password']))
                {
					if($this->data['User']['oldpassword'] == $this->data['User']['password'])
					 $this->User->validationErrors['password'] = "New password cann't be same as old.";
						
					if($this->data['User']['password']!=$this->data['User']['confirm_password'])
					   $this->User->validationErrors['confirm_password'] = "Password's doesn't match.";

					if(($this->BlowFish->check( $this->data['User']['oldpassword'] , $userdata['User']['password'] )) == false)
						$this->User->validationErrors['oldpassword'] = "Old Password not correct.";
                } 
                else
				{
					$this->User->create();
					$this->User->id = $this->Auth->user('id');
					$password = $this->data['User']['password'];
                  
					if($this->User->saveField('password', $password)){
						 $this->Session->setFlash('Password changed successfully.','default',array('class' => 'success_message'));
						 //return $this->redirect(array('action' => 'change_password'));
						 return $this->redirect(WWW_BASE.'admin/users/change_password');
					}
					else{

						  $this->Session->setFlash('Some error occurred.','default',array('class' => 'error_message'));
					}
				}
			}
			else{
			    
				if(empty($this->data['User']['oldpassword']))
					$this->User->validationErrors['oldpassword'] = 'Please enter old password.';
				
				if(empty($this->data['User']['password']))
					$this->User->validationErrors['password'] = 'Please enter new password.';

				if(empty($this->data['User']['confirm_password']))
					$this->User->validationErrors['confirm_password'] = 'Please enter confirm password.';
			}

		}
	}
	 public function admin_list($search=null){
		 $this->set('title','Category list');
		 
		
		 $conditions=array();
		if(!empty($this->params->query['search'])){
			$conditions['OR']['User.email LIKE']=$this->params->query['search'].'%';
			$conditions['OR']['User.mobile LIKE']=$this->params->query['search'].'%';
			
			
		}
	    $this->paginate = array('conditions' => array(array('User.role'=>'User'),$conditions),'limit'=>LIMIT10,'order'=>array('User.email'=>'asc')); 
		$User=$this->paginate('User');
		$this->set('Users',$User);
	}
	 public function admin_del($id) {
		if($this->User->delete( $id)){
			$this->Session->setFlash('State deleted successfully','default',array('class' => 'success_message'));
		}
		$this->redirect($this->referer()); 
	}
    public function admin_add() {
        $this->set('title','Add User');
	   if(!empty($this->request->data)){
	    $chk_unique = $this->User->find('count' , array('conditions'=>array('User.mobile' => $this->request->data['User']['mobile'])));
		 
		 if($chk_unique == 0){
			 $this->request->data['User']['role']='User';
			 if($this->User->save($this->request->data , false)){
				$this->Session->setFlash(__('New record added successfully'),'default',array('class' => 'success_message'));
				$this->redirect(array('controller'=>'users','action'=>'admin_list'));
			 }
		 }else{
			 $this->Session->setFlash('Mobile already exist','default',array('class' => 'error_message'));
		 }
	   }
	}
    public function admin_edit_user($id=null) {
       $this->set('title','edit user');
	   $this->User->id=$id;
	   if(empty($this->request->data)){
		   $this->request->data=$this->User->read();
	   }
	   else{
		   if(!empty($this->request->data)){
			$chk_unique = $this->User->find('count' , array('conditions'=>array('User.mobile' => $this->request->data['User']['mobile'],'User.id !='=>$this->request->data['User']['id'])));
			 
			 if($chk_unique == 0){
				 $this->request->data['User']['role']='User';
				 if($this->User->save($this->request->data , false)){
					$this->Session->setFlash(__('New record added successfully'),'default',array('class' => 'success_message'));
					$this->redirect(array('controller'=>'users','action'=>'admin_list'));
				 }
			 }else{
				 $this->Session->setFlash('User email already exist','default',array('class' => 'error_message'));
			 }
		   }
	    }
	}		
}