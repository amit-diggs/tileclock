<?php
App::uses('AppModel', 'Model');
/**
 * Admin Login Model
 *
 */
 class Tile extends AppModel
 {
 	public $name='Tile';
	public $usetables='tiles';
	var $belongsTo = 
	array('Job' => array(
	 'className'    => 'Job',
	  'foreignKey'    => 'job_id'
	  ),
	  'User' => array(
	   'className'    => 'User',
	    'foreignKey'    => 'emp_id'
	  ),
	);
 }
?>