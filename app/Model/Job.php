<?php
App::uses('AppModel', 'Model');
/**
 * Admin Login Model
 *
 */
 class Job extends AppModel
 {
 	public $name='Job';
	public $usetables='jobs';
	public $validate = array(
	
		'company_name' => array(
		 'company_name_not_empty' => array(
		  'rule' => 'notEmpty',
		   'message' => 'This field is required!',
		    'last' => true
		  ),
		  'unique_company_name' => array(
                'rule' => 'isUnique',
                'message' => 'Company name already exists'
            ),
		 ),
		 
		 'bg_color' => array(
		 'bg_color_not_empty' => array(
		  'rule' => 'notEmpty',
		   'message' => 'This field is required!',
		    'last' => true
		  ),
		  /*'unique_bg_color' => array(
                'rule' => 'isUnique',
                'message' => 'Background color already exists'
            ),*/
		 ),
    );
	var $belongsTo = 
	array('User' => array(
	   'className'    => 'User',
	    'foreignKey'    => 'created_by'
	  )
	);
 }
?>