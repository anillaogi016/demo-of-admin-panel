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
class LocalitiesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
    public $components = array('RequestHandler','Session','Common');
    public $helpers = array('Js','Paginator');
	public $uses = array('State','City','Locality');
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


	 public function admin_add() {
		
		$all_state = $this->State->find('all');
		$all_city = $this->City->find('all');
		$allState = array();
		$allCity=array();
		foreach($all_state as $all){
			$allState[$all['State']['id'] ] = $all['State']['name'];
		}
		
		foreach($all_city as $all){
			$allCity[$all['City']['id'] ] = $all['City']['name'];
		}
		$this->set('allState' , $allState);
		$this->set('allCity' , $allCity);
		$this->set('title','Add Locality');
	   
		if(!empty($this->request->data)){
			//pr($this->request->data); die;
			if($this->request->data['Locality']['state_id'] != null &&  $this->request->data['Locality']['name'] != null && $this->request->data['Locality']['city_id'] != null ){
				
				$chk_city = $this->Locality->find('count',array('conditions' => array('Locality.name' => $this->request->data['Locality']['name'] , 'Locality.city_id' => $this->request->data['Locality']['city_id'])));
				
				if($chk_city == 0){
				 	if($this->Locality->save($this->request->data , false)){
						$this->Session->setFlash('New Record Successfully Added!','default',array('class' => 'success_message'));
						$this->redirect(array('controller'=>'localities','action'=>'localityList','admin'=>true));
					}
				}else{
					$this->Session->setFlash('Locality already exist','default',array('class' => 'error_message'));
				}
				
			}else{
				 $this->Session->setFlash('Please enter all required fields','default',array('class' => 'error_message'));
			}
			
		}
	} 
	 public function admin_edit($id=null) {
		$all_state = $this->State->find('all');
		$all_city = $this->City->find('all');
		$allState = array();
		$allCity=array();
		foreach($all_state as $all){
			$allState[$all['State']['id'] ] = $all['State']['name'];
		}
		
		foreach($all_city as $all){
			$allCity[$all['City']['id'] ] = $all['City']['name'];
		}
		$this->set('allState' , $allState);
		$this->set('allCity' , $allCity);
		$this->set('title','Add Locality');
		$this->Locality->id=$id;
	    if(empty($this->request->data)){
			$this->request->data=$this->Locality->read();
		}else{
			if(!empty($this->request->data)){
				//pr($this->request->data); die;
				if($this->request->data['Locality']['state_id'] != null &&  $this->request->data['Locality']['name'] != null && $this->request->data['Locality']['city_id'] != null ){
					
					 $chk_city = $this->Locality->find('count',array('conditions' => array('Locality.name' => $this->request->data['Locality']['name'] , 'Locality.city_id' => $this->request->data['Locality']['city_id'],'Locality.id !='=>$this->request->data['Locality']['id'])));
					
					if($chk_city == 0){ 
						if($this->Locality->save($this->request->data , false)){
							$this->Session->setFlash('New Record Successfully Added!','default',array('class' => 'success_message'));
							$this->redirect(array('controller'=>'localities','action'=>'localityList','admin'=>true));
						}
					 }else{
						$this->Session->setFlash('Locality already exist','default',array('class' => 'error_message'));
					}
					
				}else{
					 $this->Session->setFlash('Please enter all required fields','default',array('class' => 'error_message'));
				}
				
			}
		}
	} 
	public function admin_localityList($search=null , $city = null) 
	{
		$allState=$this->State->find('all',array('order'=>array('State.name'=>'ASC')));
		$this->set('allState',$allState);
		$conditions=array();
		
		if(!empty($this->params->query['search'])){
			$conditions['Locality.name LIKE']=$this->params->query['search'].'%';
			
		}
		if(!empty($this->params->query['city_id'])){
			
		   $conditions['Locality.city_id'] = $this->params->query['city_id'];
		   $sub_cities=$this->City->find('first',array('conditions'=>array('City.id'=>$this->params->query['city_id'])));
		   $this->Session->write('city_ids', $sub_cities['City']['id']);
		}
		if(!empty($this->params->query['state'])){
			$conditions['Locality.state_id'] = $this->params->query['state'];
			$states=$this->State->find('first',array('conditions'=>array('State.id'=>$this->params->query['state'])));
			$this->Session->write('state_id',$states['State']['id']);
		}
		if(empty($this->params->query['state'])){
			$this->Session->delete('state_id');
		}
		if(empty($this->params->query['city_id'])){
			$this->Session->delete('city_ids');
		}
		$allCity=$this->City->find('all',array('condtions'=>array('City.state_id'=>@$this->params->query['state'])));
		$this->set('allCity',$allCity);
		$this->paginate=array('conditions'=>$conditions,'limit'=>LIMIT10,'order'=>array('Locality.name'=>'asc'));
		$listing = $this->paginate('Locality');
		$this->set('data', $listing);
    }
	public function admin_del($id) {
		if($this->Locality->deleteAll(array('Locality.id' => $id), false)){
			$this->Session->setFlash('Locality deleted successfully','default',array('class' => 'success_message'));
		}
		$this->redirect($this->referer()); 
	}
	public function admin_city($parent=null){
		$this->render=false;
		$this->layout='';
		$parent=$_GET['data'];
		$data = $this->City->find('all',array('fields'=>array('City.id','City.name'),'conditions'=>array('City.state_id'=>$parent),'order'=>array('City.name'=>'ASC')));
	    
		$arr = '<option value=""> Select One</option>';
    	foreach($data as $datas){
			$arr .= "<option value='".$datas['City']['id']."'>".$datas['City']['name']."</option>";
			
		} 
		echo $arr;
		exit;
	}
}
