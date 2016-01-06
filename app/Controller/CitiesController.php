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
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class CitiesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
    public $components = array('RequestHandler','Session','Common');
    public $helpers = array('Js','Paginator');
	public $uses = array('City','State');
	public $paginate = array('limit' => 1);
	public $allowedAction=array('app_parentcategory','app_childcategory');
/**
 * function name                admin_login
 * passing parameter            null
 * auther                       anil kumar
 * created                      01/04/2015
 * updated                      
**/	
	public function beforeFilter() {
        parent::beforeFilter();
		$this->Auth->allow($this->allowedAction);
       
	}

/**
 * function name                admin_login
 * passing parameter            null
 * auther                       anil kumar
 * created                      01/04/2015
 * updated                      
**/
    public function admin_list($search=null , $category = null ){
		$this->loadModel('Cities'); 
		$this->set('title','Cities list');
		
		$allState=$this->State->find('all',array('order'=>array('State.name'=>'ASC')));
		$this->set('allState',$allState);
		$conditions=array();
		if(!empty($this->params->query['search'])){
			$conditions['City.name LIKE']=$this->params->query['search'].'%';
		}
		if(!empty($this->params->query['state'])){
			$conditions['City.state_id'] = $this->params->query['state'];
			
			$state_detail = $this->State->find('first' , array('conditions' => array('State.id' => $this->params->query['state'])));
			//echo '<pre>'; print_r($category_detail); die;
			$state_name = $state_detail['State']['name'];
			$this->set('state_name' , $state_name);
			
			$this->Session->write('state_id' , $state_detail['State']['id']);
		}
		if(empty($this->params->query['state'])){
			
			$this->Session->delete('state_id');
		}
		
	     $this->paginate = array('conditions' => $conditions,'limit'=>LIMIT10,'order'=>array('City.name'=>'asc')); 
		 $Cities=$this->paginate('City');
		 
		 $this->set('Cities',$Cities);
	}
/**
 * function name                admin_add
 * passing parameter            null
 * auther                       anil kumar
 * created                      01/04/2015
 * updated                      
**/	
	 public function admin_add() {
		$all_state = $this->State->find('all');
		$allState = array();
		foreach($all_state as $all){
			$allState[  $all['State']['id'] ] = $all['State']['name'];
		}
		//sort($allCategory); 
		$this->set('allState' , $allState);
		$this->set('title','Add cities');
	   
		if(!empty($this->request->data)){
			
			if($this->request->data['City']['state_id'] != null && $this->request->data['City']['name'] != null){
				
				$chk_subcat = $this->City->find('count' , array('conditions' => array('City.name' => $this->request->data['City']['name'] , 'City.state_id' => $this->request->data['City']['state_id'])));
				
				if($chk_subcat == 0){
					
					if($this->City->save($this->request->data , false)){
						$this->Session->setFlash('New Record Successfully Added!','default',array('class' => 'success_message'));
						$this->redirect(array('controller'=>'cities','action'=>'list','admin'=>true));
					}
				}else{
					$this->Session->setFlash('City already exist','default',array('class' => 'error_message'));
				}
				
			}else{
				 $this->Session->setFlash('Please enter all required fields','default',array('class' => 'error_message'));
			}
			
		}
	} 
	
	 public function admin_edit($id=null) {
		$this->set('title','edit city');
		
		$all_state = $this->State->find('all');
		$allState = array();
		foreach($all_state as $all){
			$allState[  $all['State']['id'] ] = $all['State']['name'];
		}
		$this->set('allState' , $allState);
	    $this->City->id=$id;
		if(empty($this->request->data)){
			$this->request->data=$this->City->read();
			
		}
		else{
			if(!empty($this->request->data)){
				if($this->City->save($this->request->data)){
					$this->Session->setFlash(__('Record Successfully Updated!'),'default',array('class' => 'success_message'));
					$this->redirect(array('controller'=>'cities','action'=>'list','admin'=>true));
				}
			}
		}
	} 
	public function admin_del($id) {
		if($this->City->deleteAll(array('City.id' => $id), true)){
			$this->Session->setFlash('City deleted successfully','default',array('class' => 'success_message'));
		}
		$this->redirect($this->referer()); 
	}
}
