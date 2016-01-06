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
class StatesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
    public $components = array('RequestHandler','Session','Common');
    public $helpers = array('Js','Paginator');
	public $uses = array('State');
	public $paginate = array('limit' => 1);
	public $allowedAction=array();
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
    public function admin_list($search=null){
		 $this->set('title','Category list');
		 
		
		 $conditions=array();
		if(!empty($this->params->query['search'])){
			$conditions['State.name LIKE']=$this->params->query['search'].'%';
			
		}
	     $this->paginate = array('conditions' => $conditions,'limit'=>LIMIT10,'order'=>array('State.name'=>'asc')); 
		 $State=$this->paginate('State');
		 //pr($State); die;
		 $this->set('States',$State);
	}
/**
 * function name                admin_add
 * passing parameter            null
 * auther                       anil kumar
 * created                      01/04/2015
 * updated                      
**/	
	 public function admin_add() {
		$this->set('title','Add Category');
	   if(!empty($this->request->data)){
	    $chk_unique = $this->State->find('count' , array('conditions'=>array('State.name' => $this->request->data['State']['name'])));
		 
		 if($chk_unique == 0){
			 if($this->State->save($this->request->data , false)){
				$this->Session->setFlash(__('New state added successfully'),'default',array('class' => 'success_message'));
				$this->redirect(array('controller'=>'states','action'=>'admin_list'));
			 }
		 }else{
			 $this->Session->setFlash('State name already exist','default',array('class' => 'error_message'));
		 }
	   }
	} 
	
	 public function admin_edit($id=null) {
		$this->set('title','edit state');
	    $this->State->id=$id;
		
		if(empty($this->request->data)){
			$this->request->data=$this->State->read();
			
		}
		else{
			if(!empty($this->request->data)){
				if($this->State->save($this->request->data)){
					$this->Session->setFlash(__('Record Successfully Updated!'),'default',array('class' => 'success_message'));
					$this->redirect(array('controller'=>'states','action'=>'list','admin'=>true));
				}
			}
		}
	} 
	public function admin_del($id) {
		
		if($this->State->deleteAll(array('State.id' => $id), true)){
			$this->Session->setFlash('State deleted successfully','default',array('class' => 'success_message'));
		}
		$this->redirect($this->referer()); 
	}
}
