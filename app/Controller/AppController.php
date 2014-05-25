<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {

    public $components = array(
        'Session',
        'Paginator',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'Admins',
                'action' => 'job_tile'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email_address'),
					'scope' => array('status' => '0')
                )
            )
        ),
    );
	
	public function beforeFilter() {
		$sessionData = $this->Auth->user();
	    $emp_id = $sessionData['id'];
		$user_type = $sessionData['user_type'];
		$first_name = $sessionData['first_name'];
		$last_name = $sessionData['last_name'];
		$created_by = $sessionData['created_by'];
		if($created_by=='0')
		{
			$created_by = $emp_id;
		}
		else
		{
			$created_by = $created_by;
		}
		$this->set(compact('emp_id','user_type','first_name','last_name','created_by'));
    }
}
