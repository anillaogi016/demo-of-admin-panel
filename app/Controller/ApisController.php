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

App::uses('AppController', 'Controller');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class ApisController extends AppController {
	public $components = array('Auth','Session','Email','Upload'/* ,'Image' */);
	public $uses = array('Location','User','Area');
    var $helpers = array('Html','Form');
	
	function beforeFilter() 
	{
		parent::beforeFilter();
		$this->Auth->allow();
	}
	function beforeRender() 
	{
		parent::beforeRender();
		$this->autoRender=false;
	}
	/* APP FUNCTIONS */

	
	function states(){
		$response = array();
		$states = $this->Location->findAllByStatusAndParentId('Active',0,array('id','name'),array(),0,0,0);		
		//pr($states);die;
		if(!empty($states)){
			$records = array();
			$i=0;
			foreach($states as $rec){
				$records[$i]['id'] = $rec['Location']['id'];
				$records[$i]['name'] = $rec['Location']['name'];
				$i++;
			}
			$response['data']=$records;
			$response['result']=1;
			echo json_encode($response);
			exit;
		}else{
			$response['message']='No record found';
			$response['result']=0;
			echo json_encode($response);
			exit;
		}
	}
	function cities(){
		$response = array();
		if(empty($this->params->query['state_id'])){ 
			$response['message']='Please enter state_id';
			$response['result']=0;
			echo json_encode($response);
			exit;
		}
		$id = $this->params->query['state_id'];
		$cities = $this->Location->findAllByStatusAndParentId('Active',$id,array('id','name'),array(),0,0,0);		
		//pr($cities);die;
		if(!empty($cities)){
			$records = array();
			$i=0;
			foreach($cities as $rec){
				$records[$i]['id'] = $rec['Location']['id'];
				$records[$i]['name'] = $rec['Location']['name'];
				$i++;
			}
			$response['data']=$records;
			$response['result']=1;
			echo json_encode($response);
			exit;
		}else{
			$response['message']='No record found';
			$response['result']=0;
			echo json_encode($response);
			exit;
		}
	}
	function localities(){
		$response = array();
		if(empty($this->params->query['city_id'])){ 
			$response['message']='Please enter city_id';
			$response['result']=0;
			echo json_encode($response);
			exit;
		}
		$id = $this->params->query['city_id'];
		$localities = $this->Area->findAllByStatusAndLocationId('Active',$id,array('id','name'),array(),0,0,0);		
		//pr($localities);die;
		if(!empty($localities)){
			$records = array();
			$i=0;
			foreach($localities as $rec){
				$records[$i]['id'] = $rec['Area']['id'];
				$records[$i]['name'] = $rec['Area']['name'];
				$i++;
			}
			$response['data']=$records;
			$response['result']=1;
			echo json_encode($response);
			exit;
		}else{
			$response['message']='No record found';
			$response['result']=0;
			echo json_encode($response);
			exit;
		}
	}
	
    function registration(){
		$response = array();
		if(empty($this->params->query['mobile'])){ 
			$response['message']='Please enter mobile';
			$response['result']=0;
			echo json_encode($response);
			exit;
		}
		$mobile = $this->params->query['mobile'];
		$user = $this->User->findByMobileAndRole($mobile,'User');
		if(!empty($user)){
			$response = array('message'=>'User already exists','result'=>1,'user_id'=>$user['User']['id']);
			echo json_encode($response);
			exit;
		}
		$data['User']['mobile'] = $this->params->query['mobile'];
		$data['User']['status'] = 'Active';
		$data['User']['role'] = 'User';
		$data['Otp']['otp'] = 1234;
		//pr($data);die;
		if($this->User->saveAssociated($data)){
			$id = $this->User->id;
			$response = array('message'=>'User Registered successfully','result'=>1,'user_id'=>$id);
		}else{
			$varr = '';
			if(!empty($this->User->validationErrors))
			{
				foreach($this->User->validationErrors as $key=>$value)
				{
					$varr .= $value[0].", ";
				}
				$varr = rtrim($varr, ", ");
			}
			$response = array('message'=>$varr,'result'=>0);
		}
		header('Content-type: application/json');
		echo json_encode($response);
		exit;
	}
	function login(){
		$response = array();
		if(empty($this->params->query['mobile'])){ 
			$response['message']='Please enter mobile';
			$response['result']=0;
			echo json_encode($response);
			exit;
		}
		if(empty($this->params->query['otp'])){ 
			$response['message']='Please enter otp';
			$response['result']=0;
			echo json_encode($response);
			exit;
		}
		$mobile = $this->params->query['mobile'];
		$otp = $this->params->query['otp'];
		$user = $this->User->findByMobileAndRole($mobile,'User');
		if(!empty($user)){
			if($otp == $user['Otp']['otp']){
				$response = array('message'=>'User Logged in successfully','result'=>1,'user_id'=>$user['User']['id']);
			}else{
				$response['message']='Invalid Otp';
			    $response['result']=0;
			}
		}else{
			$response['message']='Mobile not registered';
			$response['result']=0;
		}
		echo json_encode($response);
		exit;
	}
}