<?php
App::uses('Helper', 'View');
class CommonHelper extends AppHelper
{
	var $helpers = array ('Session'); 
	function parent_category_name ($id) 
	{
 		App::import("Model", "Category");
        $model = new Category();
		$model->Behaviors->load('Tree');
        $data = $model->getParentNode($id);
		$ret_value = !empty($data['Category']['id'])?$data['Category']['id']:'';
        return $ret_value;
 	}
}