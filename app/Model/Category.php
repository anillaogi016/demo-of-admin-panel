<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppModel', 'Model');
/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class Category extends AppModel {
	var $name = 'Category';
    var $useTable = 'categories';
	public $actsAs = array('Containable','Tree');    	  
	
  
	public function beforeSave($options = array()) {
	  
	}
	public $validate = array(
	
		'name'=> array(
			'notEmpty' => array(
				'rule' => 'notBlank',
				'message' => 'Please enter category name.',
				'last' => true
			),
			'unique' => array(
				'rule' => 'isUnique',
				'on' => 'create',
				'message' => 'Category name already exists.'
		    ),
            'edit_unique'=>array(
		        'rule'=>array('check_unique','name'),
				'on'=>'update',
				'message'=>'category name already exists.'
		    )		
		)
	);
	function check_unique($field = array(), $compareField = null){
		$condition = array(
					$this->name.".".$compareField => $this->data[$this->name][$compareField]            
                );
	    if (isset($this->data[$this->name]["id"])) {
	        $condition[$this->name.".id <>"] = $this->data[$this->name]['id'];
	    }
	    $result = $this->find("count", array("conditions" => $condition));		
	    return ($result == 0);
	}
	
}
