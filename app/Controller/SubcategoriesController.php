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
class SubcategoriesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
    public $components = array('RequestHandler','Session','Common');
    public $helpers = array('Js','Paginator');
	public $uses = array('Category','Subcategory');
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
		$this->loadModel('Subcategory'); 
		$this->set('title','Sub Category list');
		
		$allCategory=$this->Category->find('all',array('order'=>array('Category.name'=>'ASC')));
		$this->set('allCategory',$allCategory);
		$conditions=array();
		if(!empty($this->params->query['search'])){
			$conditions['Subcategory.name LIKE']=$this->params->query['search'].'%';
		}
		if(!empty($this->params->query['category'])){
			$conditions['Subcategory.category_id'] = $this->params->query['category'];
			
			$category_detail = $this->Category->find('first' , array('conditions' => array('Category.id' => $this->params->query['category'])));
			$category_name = $category_detail['Category']['name'];
			$this->set('category_name' , $category_name);
			
			$this->Session->write('category_id' , $category_detail['Category']['id']);
		}
		if(empty($this->params->query['category'])){
			
			$this->Session->delete('category_id');
		}
		
	    $this->paginate = array('conditions' => array($conditions,'not'=>array('Category.parent_id'=>0)),'limit'=>LIMIT10,'order'=>array('Subcategory.name'=>'asc' , 'group' => 'Subcategory.category_id')); 
		$Subcategories=$this->paginate('Subcategory');
		$this->set('Subcategories',$Subcategories);
	}
/**
 * function name                admin_add
 * passing parameter            null
 * auther                       anil kumar
 * created                      01/04/2015
 * updated                      
**/	
	 public function admin_add() {
		
		$all_category = $this->Category->find('all', array('conditions' => array('Category.status' => 'Active')));
		$allCategory = array();
		foreach($all_category as $all){
			$allCategory[  $all['Category']['id'] ] = $all['Category']['name'];
		}
		$this->set('allCategory' , $allCategory);
		$this->set('title','Add Subcategory');
	   
		if(!empty($this->request->data)){
			if($this->request->data['Subcategory']['category_id'] != null && $this->request->data['Subcategory']['name'] != null){
				$this->request->data['Subcategory']['status'] = 'Active';
				
				$chk_subcat = $this->Subcategory->find('count' , array('conditions' => array('Subcategory.name' => $this->request->data['Subcategory']['name'] , 'Subcategory.category_id' => $this->request->data['Subcategory']['category_id'])));
				
				if($chk_subcat == 0){
					if($this->Subcategory->save($this->request->data , false)){
						$this->Session->setFlash('New Record Successfully Added!','default',array('class' => 'success_message'));
						$this->redirect(array('controller'=>'subcategories','action'=>'list','admin'=>true));
					}
				}else{
					$this->Session->setFlash('Subcategory already exist','default',array('class' => 'error_message'));
				}
				
			}else{
				 $this->Session->setFlash('Please enter all required fields','default',array('class' => 'error_message'));
			}
			
		}
	} 
	
	 public function admin_edit($id=null) {
		$this->set('title','edit subcategory');
	    $this->Subcategory->id=$id;
		
		if(empty($this->request->data)){
			$this->request->data=$this->Subcategory->read();
			
		}
		else{
			if(!empty($this->request->data)){
				if($this->Subcategory->save($this->request->data)){
					$this->Session->setFlash(__('Record Successfully Updated!'),'default',array('class' => 'success_message'));
					$this->redirect(array('controller'=>'subcategories','action'=>'list','admin'=>true));
				}
			}
		}
	} 
	public function admin_status($id,$status) {
		$this->loadModel("Subcategory");
		$this->layout = false;
		$new_status = $status;
		$category_id = $id;
		
		$data['Subcategory']['id'] = $category_id;
		$data['Subcategory']['status'] = $status;
		if($this->Subcategory->save( $data,false ))
		{
			$this->Session->setFlash('Status updated successfully.','default',array('class' => 'success_message'));
			$this->redirect($this->referer());
			
		}
	}

	public function admin_del($id) {
		
		$this->loadModel('Subcategory');
		if($this->Subcategory->deleteAll(array('Subcategory.id' => $id), false)){
			$this->Session->setFlash('Sub-Category deleted successfully','default',array('class' => 'success_message'));
		}
		$this->redirect($this->referer()); 
	}
}
