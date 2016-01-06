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
class ProductsController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
    public $components = array('RequestHandler','Session','Common','Upload');
    public $helpers = array('Js','Paginator');
	public $uses = array('Category','Product','State','City');
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
    public function admin_list(){ 
		
		// start all category
		$allCategory=$this->Category->find('all',array('conditions'=>array('Category.parent_id'=>null),'order'=>array('Category.name'=>'ASC')));
		$this->set('allCategory',$allCategory);
		//end
		
		//start subcategory
		$Allsubcategory=$this->Category->find('all',array('conditions'=>array('Category.parent_id'=>@$this->params->query['category'])));
		 $this->set('Allsubcategory',$Allsubcategory); 
		 //end
		 
		// start code for city
		$Allcity=$this->City->find('all',array('recursive'=>-1));
		$this->set('Allcity',$Allcity);
		//end
		 
		 
		$conditions=array();
		$category_name=@$_GET['category'];
		$subcategory_name=@$_GET['subcategory'];
		$city_name=@$_GET['city'];
		if(!empty($this->params->query['search'])){
			$conditions['OR']['Product.name LIKE']= '%'.$this->params->query['search'].'%';
		}
		if(!empty($category_name)){
			$conditions['Product.category_id']=$category_name;
		}
		if(!empty($subcategory_name)){
			$conditions['Product.subcat_id']=$subcategory_name;
		}
		if(!empty($city_name)){
			$conditions['Product.city_id']=$city_name;
		}
	
		$this->paginate = array('conditions' => $conditions,'limit'=>LIMIT10,'order'=>array('Product.name'=>'asc')); 
		$data=$this->paginate('Product');
		//pr($data); die;
		$this->set(compact("data")); 
	}
    public function admin_subcategory(){
		$this->render=false;
		$this->layout='';
		$parent=$_GET['data'];
		$data = $this->Category->find('all',array('fields'=>array('Category.id','Category.name'),'conditions'=>array('Category.parent_id'=>$parent,'Category.active'=>'Yes'),'order'=>array('Category.name'=>'ASC')));
	    
		$arr = '<option value=""> Select One</option>';
    	foreach($data as $datas){
			$arr .= "<option value='".$datas['Category']['id']."'>".$datas['Category']['name']."</option>";
		} 
		echo $arr;
		exit;
	}
	public function admin_city(){
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
	public function admin_add() {
		$this->set('title','Add Product');
		//Start all state
		 $all_State = $this->State->find('all', array('order'=>array('State.name'=>'ASC')));
		$allState = array();
		foreach($all_State as $all){
			$allState[$all['State']['id'] ] = $all['State']['name'];
		}
		
		$this->set('allState' , $allState);
		//end
		
		// start All category
		$all_category = $this->Category->find('all', array('conditions' => array('Category.active' => 'Yes','Category.parent_id'=>null),'order'=>array('Category.name'=>'ASC')));
		$allCategory = array();
		foreach($all_category as $all){
			$allCategory[$all['Category']['id'] ] = $all['Category']['name'];
		}
	    $this->set('allCategory' , $allCategory);
		// end 
		
		
		if(!empty($this->request->data)){
				
			$p_state=$this->request->data['Product']['state_id'];
			$p_city=$this->request->data['Product']['city_id'];
			$p_category=$this->request->data['Product']['category_id'];
			$p_subcategory=$this->request->data['Product']['subcat_id'];
			$p_code=$this->request->data['Product']['product_code'];
			
			$chk_product = $this->Product->find('count',array('conditions'=>        array(
						'Product.product_code' =>$p_code,
						 'Product.state_id' =>$p_state,
						'Product.city_id' =>$p_city,
						'Product.category_id' =>$p_category,
						'Product.subcat_id' =>$p_subcategory
					)
				)
			);
			//echo $chk_product; die;
			if($chk_product==0){
				if(!empty($_FILES['image']['name']))	{
					$result="";				
					if(!empty($Product['Product']['image'])){
						unlink('../webroot/img/product_img/'.$Product['Product']['image']);
					}
					if (!empty($_FILES['image']['name'])) {
						$imgName1 = pathinfo($_FILES['image']['name']);
						$ext = $imgName1['extension'];
						if($ext=='jpg' || $ext=='jpeg' || $ext=='png' || $ext=='gif'){
								$time = explode(" ",microtime());
								$newImgName = md5($time[1]);
								$tempFile = $_FILES['image']['tmp_name'];
								$destOrignal = realpath('../webroot/img/product_img/') . '/'; 
								$file = $_FILES['image'];
								$result = $this->Upload->upload($file, $destOrignal,$newImgName.".".$ext ,NULL,array($ext));
								
								$result = $this->Common->resize($destOrignal.$newImgName.".".$ext,$destOrignal.$newImgName.".".$ext, '200','200','200');
						}
						$this->request->data['Product']['image']=	$newImgName.".".$ext;
					}	
				}
				else{
				$this->request->data['Product']['image']='default'.'.'.'jpg';	
				}
				
				if ($this->Product->save($this->request->data['Product'])) {
				
					$this->Session->setFlash('Successfully Updated!!','default',array('class'=>'success_message'));
					$this->redirect(array('controller'=>'products','action' => 'list','admin'=>'true'));

				} 
			}else{
				$this->Session->setFlash('This Product already exist','default',array('class' => 'error_message'));
			}
			
		}
	} 
    /* public function admin_subsubcategory($parent=null){
		$this->render=false;
		$this->layout='';
		$parent=$_GET['data'];
		$data = $this->Subsubcategory->find('all',array('fields'=>array('Subsubcategory.id','Subsubcategory.name'),'conditions'=>array('Subsubcategory.subcat_id'=>$parent,'Subsubcategory.status'=>'Yes'),'order'=>array('Subsubcategory.name'=>'ASC')));
	    
		$arr = '<option value=""> Select One</option>';
    	foreach($data as $datas){
			$arr .= "<option value='".$datas['Subsubcategory']['id']."'>".$datas['Subsubcategory']['name']."</option>";
			
		} 
		echo $arr;
		exit;
	}
	public function admin_view_product_image($id=null) {
       $image=$this->Product->find('first',array('conditions'=>array('Product.id'=>$id),'fields'=>array('id','image')));
	   $this->set('image',$image);
	}*/
   public function admin_edit($id=null) {
	   
	   
	    if(!empty($id)){
			$product_image=$this->Product->find('first',array('conditions'=>array('Product.id'=>$id)));
			$this->set('image',$product_image['Product']['image']);
		}
	    /*$all_category = $this->Category->find('all', array('conditions' => array('Category.status' => 'Active'),'order'=>array('Category.name'=>'ASC')));
		$allCategory = array();
		foreach($all_category as $all){
			$allCategory[$all['Category']['id'] ] = $all['Category']['name'];
		}
		$allsubCategory ='';
		$this->set('allCategory' , $allCategory);
		// code for product unit
		$all_Unit = $this->Unit->find('all');
		$allUnit = array();
		foreach($all_Unit as $all){
			$allUnit[$all['Unit']['id'] ] = $all['Unit']['name'];
		}
		$this->set('allUnit' , $allUnit);
	    */
		//Start all state
		 $all_State = $this->State->find('all', array('order'=>array('State.name'=>'ASC')));
		$allState = array();
		foreach($all_State as $all){
			$allState[$all['State']['id'] ] = $all['State']['name'];
		}
		
		$this->set('allState' , $allState);
		//end
		
		// start All category
		$all_category = $this->Category->find('all', array('conditions' => array('Category.active' => 'Yes','Category.parent_id'=>null),'order'=>array('Category.name'=>'ASC')));
		$allCategory = array();
		foreach($all_category as $all){
			$allCategory[$all['Category']['id'] ] = $all['Category']['name'];
		}
	    $this->set('allCategory' , $allCategory);
		// end 
	    $this->Product->id=$id;
		if(empty($this->request->data)){
			$this->request->data=$this->Product->read();
			//pr($this->request->data); die;
			//start all sub category
			$all_subcategory = $this->Category->find('all', array('conditions' => array('Category.parent_id'=>$this->request->data['Product']['category_id']),'order'=>array('Category.name'=>'ASC')));
			if(!empty($all_subcategory)){
				$allsubCategory = array();
				foreach($all_subcategory as $all){
					$allsubCategory[$all['Category']['id'] ] = $all['Category']['name'];
				}
				$this->set('allsubCategory' , $allsubCategory);
			}
			// end
			
			//start all city selected state
			//pr($this->request->data);die;
			$all_city = $this->City->find('all', array('conditions' => array('City.state_id'=>$this->request->data['Product']['state_id']),'order'=>array('City.name'=>'ASC')));
			if(!empty($all_city)){
				$allCity = array();
				foreach($all_city as $all){
					$allCity[$all['City']['id'] ] = $all['City']['name'];
				}
				$this->set('allCity' , $allCity);
			}
			//end
		}
		else{
			
		    if(!empty($this->request->data)){
				$p_state        = $this->request->data['Product']['state_id'];
				$p_city         = $this->request->data['Product']['city_id'];
				$p_category     = $this->request->data['Product']['category_id'];
				$p_subcategory  = $this->request->data['Product']['subcat_id'];
				$p_code         = $this->request->data['Product']['product_code'];
				$p_id           = $this->request->data['Product']['id'];
				$chk_product = $this->Product->find('count',array('conditions'=>        array(
							'Product.product_code' =>$p_code,
							 'Product.state_id' =>$p_state,
							'Product.city_id' =>$p_city,
							'Product.category_id' =>$p_category,
							'Product.subcat_id' =>$p_subcategory,
							'Product.id !='=>$p_id
						)
					)
				);
					//echo $chk_product; die;
				if($chk_product==0){
					if(!empty($_FILES['image']['name'])){
						$result="";				
						if(!empty($Product['Product']['image'])){
							unlink('../webroot/img/product_img/'.$Product['Product']['image']);
						}
						if (!empty($_FILES['image']['name'])) {
							$imgName1 = pathinfo($_FILES['image']['name']);
							$ext = $imgName1['extension'];
							if($ext=='jpg' || $ext=='jpeg' || $ext=='png' || $ext=='gif'){
								
									$time = explode(" ",microtime());
									$newImgName = md5($time[1]);
									$tempFile = $_FILES['image']['tmp_name'];
									$destOrignal = realpath('../webroot/img/product_img/') . '/'; 
									$file = $_FILES['image'];
									$result = $this->Upload->upload($file, $destOrignal,$newImgName.".".$ext ,NULL,array($ext));
									
									$result = $this->Common->resize($destOrignal.$newImgName.".".$ext,$destOrignal.$newImgName.".".$ext, '200','200','200');
							}
							$this->request->data['Product']['image']=	$newImgName.".".$ext;
						}	
					}
					else{
					    $this->request->data['Product']['image']='default'.'.'.'jpg';	
					}
					
					if ($this->Product->save($this->request->data['Product'])) {
					
						$this->Session->setFlash('Successfully Updated!!','default',array('class'=>'success_message'));
						$this->redirect(array('controller'=>'products','action' => 'list','admin'=>'true'));

					} 
				}else{
					$this->Session->setFlash('This Product already exist','default',array('class' => 'error_message'));
				}
					
			}
		} 
	}
	
	//start delete prodct
	public function admin_delete_product($product_id = null){
		if($product_id != null){
			if($this->Product->deleteAll(array('Product.id' => $product_id), false))
			{
				$this->Session->setFlash('Product deleted successfully.','default',array('class' => 'success_message'));
			}else{
				$this->Session->setFlash('No associated product found','default',array('class' => 'error_message'));
			}	
		}else{
			$this->Session->setFlash('No product found to delete','default',array('class' => 'error_message'));
		}
	    $this->redirect($this->referer());
	}
	//end
}
