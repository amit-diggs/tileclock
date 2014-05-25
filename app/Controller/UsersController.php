<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of owners_controller
 *
 * @author Amit Chowdhury
 */
App::uses('CakeEmail', 'Network/Email');
class UsersController extends AppController
{
	public $name="Users";
	public $helpers=array('Html','Form','Paginator' );
	public $uses=array("User");
	
	public function beforeFilter() 
    {
        $this->Auth->allow('login', 'logout', 'registration','forgot_password','reset_password');
    }
		
	public function login() {
    	$this->layout="login";
        if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash('Invalid email address or password, try again', 'default', array('class' => 'errormsg'));
        }
    }
	
	public function registration()
    {
		
		$this->layout='admin';
		$title = "Add Employee | Registration";
		$this->set("title",$title);
		if (!empty($this->request->data)) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('Your registration for admin is successfully done','flash_okay');
				$this->User->send_user_access($this->request->data['User']['email_address'],$this->request->data['User']['password']);
				$this->redirect(array('action' => 'registration'));
			} else {
				$this->Session->setFlash('Registration is not done successfully. Please, try again.','flash_error');
			}
		}
    }
	   
	
	function forgot_password($token = null, $user = null) {
    	
		$title = "Forgot Password | TileClock";
        if (empty($token)) {
            $admin = false;
            if ($user) {
                $this->request->data = $user;
                $admin = true;
            }
            $this->_sendPasswordReset($admin);
        } else {
            $this->_resetPassword($token);
        }
    }
     
	
	public function logout() {
    	$this->Session->delete('redirect.controller');
        return $this->redirect($this->Auth->logout());
    }
	
	 protected function _sendPasswordReset($admin = null, $options = array()) {
    	$defaults = array(
            'from' => Configure::read('App.defaultEmail'),
            'subject' => __d('users', 'Password Reset'),
            'template' => 'password_reset_request',
            'emailFormat' => CakeEmail::MESSAGE_TEXT,
            'layout' => 'default'
        );

        $options = array_merge($defaults, $options);

        if (!empty($this->request->data)) {
            $user = $this->{$this->modelClass}->passwordReset($this->request->data);
            if (!empty($user)) {

                
                $Email = $this->_getMailInstance();
                $Email->to($user[$this->modelClass]['email_address'])
                        ->from($options['from']);
                $Email->emailFormat($options['emailFormat'])        
                        ->subject($options['subject'])
                        ->template($options['template'], $options['layout'])
                        ->viewVars(array(
                            'model' => $this->modelClass,
                            'user' => $this->{$this->modelClass}->data,
                            'token' => $this->{$this->modelClass}->data[$this->modelClass]['password_token']))
                        ->send();

                if ($admin) {
                    $this->Session->setFlash(sprintf(
                                    __d('users', '%s has been sent an email with instruction to reset their password.'), $user[$this->modelClass]['email']));
                    $this->redirect(array('action' => 'index', 'admin' => true));
                } else {
                    //$this->Session->setFlash(__d('users', 'You should receive an email with further instructions shortly'));
                    //$this->redirect(array('action' => 'login'));
                    $this->set('message',"Your email is on its way!<br>For your security, the reset email is only active for the next 24 hours. if you don't see the email in next 10 minutes, check your spam folder first then try <a href='javascript:history.go(-1);'>sending it again</a>. Still don't see it? Plese <a href='#'>Contact Us</a>. ");
                
                }
            } else {
                //$this->Session->setFlash(__d('users', 'No user was found with that email.'));
                $this->set('message',"<b>We could't find this email in the system</b><br>Please <a href='javascript:history.go(-1)'>go back</a> and check the email you entered.");
                //$this->redirect($this->referer('/'));
                //$this->redirect(array('action' => "showmessage"));
                
            }
        }
        $this->render('request_password_change');
    }
     /**
     * This method allows the user to change his password if the reset token is correct
     *
     * @param string $token Token
     * @return void
     */
    protected function _resetPassword($token) {
        $user = $this->{$this->modelClass}->checkPasswordToken($token);
        if (empty($user)) {
            $this->Session->setFlash(__d('users', 'Invalid password reset token, try again.','flash_okay'));
            $this->redirect(array('action' => 'forgot_password'));
        }
        //pr($this->request->data);
        if (!empty($this->request->data) && $this->{$this->modelClass}->resetPassword(Set::merge($user, $this->request->data))) {
            $this->Session->setFlash(__d('users', 'Password changed, you can now login with your new password.','flash_okay'));
            
           $this->redirect($this->Auth->loginAction);
        }
        $this->set('token', $token);
    }
    
    /**
     * Returns a CakeEmail object
     *
     * @return object CakeEmail instance
     * @link http://book.cakephp.org/2.0/en/core-utility-libraries/email.html
     */
    protected function _getMailInstance() {
        $emailConfig = Configure::read('Users.emailConfig');
        if ($emailConfig) {
            return new CakeEmail($emailConfig);
        } else {
            return new CakeEmail('default');
        }
    }
	
	public function reset_password($token = null, $user = null) {
		$title = "Reset Password | TileClock";
        if (empty($token)) {
            $admin = false;
            if ($user) {
                $this->request->data = $user;
                $admin = true;
            }
            $this->_sendPasswordReset($admin);
        } else {
            $this->_resetPassword($token);
        }
    }
	
}


	?>