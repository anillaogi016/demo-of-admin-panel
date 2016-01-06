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
class CategoriesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
    public $components = array('RequestHandler','Session','Common');
    public $helpers = array('Js','Paginator');
	public $uses = array('Category');
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
		$conditions=array('Category.parent_id'=>NULL);
		if(!empty($this->params->query['search'])){
			$conditions['Category.name LIKE']= '%'.$this->params->query['search'].'%';
			
		}
	     $this->paginate = array('conditions' => $conditions,'limit'=>LIMIT10,'order'=>array('Category.name'=>'ASC')); 
		 $Categories=$this->paginate('Category');
		 $this->set('Categories',$Categories);
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
			if($this->Category->save($this->request->data)){
				$this->Session->setFlash('New category successfully added!','default',array('class' => 'success_message'));
				$this->redirect(array('controller'=>'categories','action'=>'list','admin'=>true));
			}
			
		}
	} 
	
	 public function admin_edit($id=null) {
		$this->set('title','edit Category');
	    $this->Category->id=$id;
		
		if(empty($this->request->data)){
			$this->request->data=$this->Category->read();
			
		}
		else{
			if(!empty($this->request->data)){
				if($this->Category->save($this->request->data)){
					$this->Session->setFlash(__('Category successfully updated.'),'default',array('class' => 'success_message'));
					$p_id = $this->Common->parent_category_name($id);
					if($p_id)
						$this->redirect(array('controller'=>'categories','action'=>'subcatList/'.$p_id,'admin'=>true));
					else
						$this->redirect(array('controller'=>'categories','action'=>'list','admin'=>true));
						
				}
			}
		}
	} 
	
	public function admin_add_subcat($id=null) 
	{
		if(!empty($this->request->data))
		{
			$this->Category->set($this->request->data);	
			
			if($this->data['Category']['parent_id']==0 || $this->data['Category']['parent_id']==NULL)
			{
				 $data2['Category']['parent_id']=NULL;
			}
			else
			{
				$data2['Category']['parent_id']=$this->data['Category']['parent_id'];
			}
			$data1['Category']['parent_id']=$data2['Category']['parent_id'];
			$data1['Category']['name']=$this->data['Category']['name'];
			$deal_category_uri=$this->Common->uri($this->data['Category']['name']);
			if($data1['Category']['parent_id']!=0 && $data1['Category']['parent_id']!='' && (trim(strtolower($this->data['Category']['name'])=='others') || trim(strtolower($this->data['Category']['name'])=='other')))
			{
			 $deal_category_uri=$deal_category_uri."_".$data1['Category']['parent_id'];
			}
			$data1['Category']['uri'] =$deal_category_uri;
			$data1['Category']['custom_id'] =$id;
			
			
			if($this->Category->save($data1))
			{
				$this->Session->setFlash('Category successfully added.','default',array('class' => 'success_message'));
				$this->redirect(array('action'=>'subcatList',$id));
			}
				
		}
		
		$parent = $this->Category->find('first',array('fields'=>array('Category.id','Category.parent_id','Category.name'),'conditions'=>array('Category.id'=>$id)));
		$this->set('parent',$parent);
	}

	
	public function admin_subcatList($parent) 
	{
		$conditions=array('Category.parent_id'=>$parent);
		if(!empty($this->params->query['search'])){
			$conditions['Category.name LIKE']= '%'.$this->params->query['search'].'%';
			
		}
		
		$this->paginate=array('conditions'=>$conditions,'limit'=>LIMIT10,'order'=>array('Category.name'=>'ASC'));
		$listing = $this->paginate('Category');
		$this->set('data', $listing);

		$data = $this->Category->find('first',array('fields'=>array('Category.id','Category.name'),'conditions'=>array('Category.id'=>$parent)));
		$this->set('parent',$data);
	}
	
	public function admin_status($id,$status) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			 $this->Session->setFlash('Invalid category entry.','default',array('class' => 'success_message'));	
		     $this->redirect($this->referer());
		}
		
	    $this->request->data['Category']['id'] = $id;
		
		//........
			$this->Category->Behaviors->load('Tree');
			$parents_child=$this->Category->children($id);
			if(!empty($parents_child))
			{
				$childs=array();
				if(count($parents_child)>1)
				{
					foreach($parents_child as $cat_childd)
					{
					 $childs[]=$cat_childd['Category']['id'];
					}
					$this->Category->updateAll(array('Category.active'=>"'".$status."'"),array('Category.id in'=>$childs));
				}
				else 
				{
					foreach($parents_child as $cat_childd)
					{
					 $childs[]=$cat_childd['Category']['id'];
					}
				   $this->Category->updateAll(array('Category.active'=>"'".$status."'"),array('Category.id'=>$childs));
				}
				
			}
		//..........
		
		$this->request->data['Category']['active'] = $status;
		//echo "<pre>";print_r($this->request->data);die;
		if ($this->Category->save($this->request->data)) 
		{
			 $this->Session->setFlash('Status changed successfully.','default',array('class' => 'success_message'));	
		     $this->redirect($this->referer());
		}
	}


	public function admin_del($id) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			 $this->Session->setFlash('Invalid category entry.','default',array('class' => 'error_message'));	
		     $this->redirect($this->referer());
		}

		if ($this->Category->exists()) {
			$this->Category->delete($id);
			$this->Category->deleteAll(array('Category.parent_id' => $id), false);
			 $this->Session->setFlash('Category successfully deleted.','default',array('class' => 'success_message'));	
		      $this->redirect($this->referer());
		}
	}
}
