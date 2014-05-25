<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class User extends AppModel {

    var $name = 'User';
    var $displayField = 'email_address';
    var $validate = array(
	'first_name' => array(
		 'first_name_not_empty' => array(
		  'rule' => 'notEmpty',
		   'message' => 'This field is required!',
		    'last' => true
		  ),
		 ),
		 
		'last_name' =>array(
		  'rule'       => 'notEmpty', // or: array('ruleName', 'param1', 'param2' ...)
		   'allowEmpty' => false,
		    'message'    => 'This field is required!'
		),
		/*'username' => array(
		 'username_not_empty' => array(
		  'rule' => 'notEmpty',
		   'message' => 'This field is required!',
		    'last' => true
		  ),
		  'username_unique' => array(
		  'rule' => 'isUnique',
		   'message' => 'Username already exists!',
		    'last' => true
		  ),
		 ),*/
        'email_address' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Email of Administrator cannot be left empty.'
            ), 'required' => array(
                'rule' => array('email'),
                'message' => 'Invalid email address.'
            ),
			'isUnique' => array(
				'rule' => 'isUnique',
				'required' => 'create',
				'message' => 'Email address already used.',
			),
        ),
        'confirm_email_address' => array(
            'identicalFieldValues' => array(
                'rule' => array('identicalFieldValues', 'email_address'),
                'message' => 'Both Email and cofirm Email must be same.'
            )
        ),
		
	    'password' => array(
            'notempty' => array(
              'rule' => array('notempty'),
                'message' => 'Password cannot be left empty.'
            ), 
        ),
	
        'confirm_password' => array(
            'identicalFieldValues' => array(
                'rule' => array('identicalFieldValues', 'password'),
                'message' => 'Both password and cofirm password must be same.'
            )
        ),
		
		'address' =>array(
		  'rule'       => 'notEmpty', // or: array('ruleName', 'param1', 'param2' ...)
		   'allowEmpty' => false,
		    'message'    => 'This field is required!'
		),
		'location' =>array(
		  'rule'       => 'notEmpty', // or: array('ruleName', 'param1', 'param2' ...)
		   'allowEmpty' => false,
		    'message'    => 'This field is required!'
		),
		
		'hourly_rate' => array(
		 'hourly_rate_not_empty' => array(
		  'rule' => 'notEmpty',
		   'message' => 'This field is required!',
		    'last' => true
		  ),
		  
		  'hourly_rate_numeric' => array(
		   'rule' => 'Numeric',
		    'message' => 'Hourly rate must me in number!',
		     'last' => true
		  )
		 ),
		
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
            );
        }
        return true;
    }

    

    function identicalFieldValues($field = array(), $compare_field = null) {
        foreach ($field as $key => $value) {
            $v1 = $value;
            $v2 = $this->data[$this->name][$compare_field];
            if ($v1 !== $v2) {
                return FALSE;
            } else {
                continue;
            }
        }
        return TRUE;
    }

    function generatePassword($length = 8) {
        // inicializa variables 
        $password = "";
        $i = 0;
        $possible = "0123456789bcdfghjkmnpqrstvwxyz";

        // agrega random 
        while ($i < $length) {
            $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);

            if (!strstr($password, $char)) {
                $password .= $char;
                $i++;
            }
        }
        return $password;
    }

    public function send_user_access($to_email,$pass) {
		$options =  array();
		$defaults = array(
			'from' => Configure::read('App.defaultEmail'),
			'subject' => __d('users', 'Access Information'),
			'template' => 'send_password',
			'emailFormat' => CakeEmail::MESSAGE_TEXT,
			'layout' => 'default'
		);
		

		$options = array_merge($defaults, $options);
		$Email = $this->_getMailInstance();
			$Email->to($to_email)
				  ->from($options['from']);
			$Email->emailFormat($options['emailFormat'])        
					->subject($options['subject'])
					->template($options['template'], $options['layout'])
					->viewVars(array(
						'email' => $to_email,
						'password' => $pass
					))
					->send();
     }

    /**
     * Checks the token for a password change
     * 
     * @param string $token Token
     * @return mixed False or user data as array
     */
    public function checkPasswordToken($token = null) {
        $user = $this->find('first', array(
            'contain' => array(),
            'conditions' => array(
                $this->alias . '.password_token' => $token,
                $this->alias . '.email_token_expires >=' => date('Y-m-d H:i:s'))));
        if (empty($user)) {
            return false;
        }
        return $user;
    }

    /**
     * Checks if an email is in the system, validated and if the user is active so that the user is allowed to reste his password
     *
     * @param array $postData post data from controller
     * @return mixed False or user data as array on success
     */
    public function passwordReset($postData = array()) {
        $user = $this->find('first', array(
            //'contain' => array(),
            'conditions' => array(
                $this->alias . '.email_address' => $postData[$this->alias]['email_address'])
        ));

        if (!empty($user)) {
            $sixtyMins = time() + 43000;
            $token = $this->generateToken();
            $user[$this->alias]['password_token'] = $token;
            $user[$this->alias]['email_token_expires'] = date('Y-m-d H:i:s', $sixtyMins);
            $user = $this->save($user, false);
            $this->data = $user;
            return $user;
        } elseif (!empty($user) && $user[$this->alias]['email_verified'] == 0) {
            $this->invalidate('email', __d('users', 'This Email Address exists but was never validated.'));
        } else {
            $this->invalidate('email', __d('users', 'This Email Address does not exist in the system.'));
        }

        return false;
    }

    /**
     * Generate token used by the user registration system
     *
     * @param int $length Token Length
     * @return string
     */
    public function generateToken($length = 10) {
        $possible = '0123456789abcdefghijklmnopqrstuvwxyz';
        $token = "";
        $i = 0;

        while ($i < $length) {
            $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            if (!stristr($token, $char)) {
                $token .= $char;
                $i++;
            }
        }
        return $token;
    }

    
/**
 * Resets the password
 * 
 * @param array $postData Post data from controller
 * @return boolean True on success
 */
	public function resetPassword($postData = array()) {
		$result = false;
		$this->set($postData);
		
		if ($this->data[$this->alias]['password'] == $this->data[$this->alias]['confirm_password']) {
			$passwordHasher = new SimplePasswordHasher();
			//$password = $passwordHasher->hash($this->data[$this->alias]['password']);
		   //$this->data[$this->alias]['password'] = $password;
		   //echo "Password".$this->data[$this->alias]['password'];
		   //exit();
		$this->data[$this->alias]['password_token'] = null;
				$result = $this->save($this->data, array('validate' => false));
		}else{$this->validates();}
		return $result;
	}
	
	protected function _getMailInstance() {
        $emailConfig = Configure::read('Users.emailConfig');
        if ($emailConfig) {
            return new CakeEmail($emailConfig);
        } else {
            return new CakeEmail('default');
        }
    }
}

?>