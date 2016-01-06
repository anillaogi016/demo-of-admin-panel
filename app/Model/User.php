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
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class User extends AppModel {
	var $name = 'User';
    var $useTable = 'users';
	public $actsAs = array('Containable');    	  
	public $hasOne = array(
	    'Otp' => array(
            'className' => 'Otp',
            'foreignKey' => 'user_id'
        ),
	);
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
        }
		
        return true;
    }
	
	public $validate = array(
	
		'email' => array(
			'notEmpty' => array(
				'rule' => 'notBlank',				
				'message' => 'Please enter an email.'
			),
			'email' => array(
				'rule' => '/^[A-Za-z0-9._%+-]+@([A-Za-z0-9-]+\.)+([A-Za-z0-9]{2,4}|museum)$/',
				'message' => 'Please enter a valid email.'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'on' => 'create',
				'message' => 'Email already exists.'
		   ),
           'edit_unique'=>array(
		        'rule'=>array('check_unique','email'),
				'on'=>'update',
				'message'=>'Email already exists.'
		   )		   
		),
		'mobile' => array(
			'notEmpty' => array(
				'rule' => 'notBlank',				
				'message' => 'Please enter mobile number.'
			),			
			'unique' => array(
				'rule' => 'isUnique',
				'on' => 'create',
				'message' => 'Mobile already exists.'
		   ),
           'edit_unique'=>array(
		        'rule'=>array('check_unique','mobile'),
				'on'=>'update',
				'message'=>'Mobile already exists.'
		   )		   
		)
	);
	function check_unique($field = array(), $compareField = null){		
		$condition = array(
		        $this->name.".".$compareField => $this->data[$this->name][$compareField]            
                );
		if (isset($this->data[$this->name]['id'])) {
			$condition[$this->name.".id <>"] = $this->data[$this->name]['id'];			
		}		
		$result = $this->find("count", array("conditions" => $condition));		
		return ($result == 0);
	}	
	function setPass($field = array(), $compareField = null) {
		if($compareField =='conf_password')  {
			if($this->data[$this->name]['password'] != $this->data[$this->name]['conf_password'])
			{
				$this->validationErrors['conf_password'] = 'Passwords doesn\'t match.';
				return $this->validationErrors;
			}
			else{
				//$this->data[$this->name]['password'] = md5($this->data[$this->name]['password']);
				$this->data[$this->name]['password'] = $this->data[$this->name]['password'];
			}			
		}
		return true;
	}
}
