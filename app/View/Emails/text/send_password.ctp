<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo __d('users', 'Thank you for the registration!');
echo "\n";
echo "Your email id is ".$email." And your password : ".$password;
echo "\n";
echo "You can login using the link below :";
echo "\n";
echo Router::url(array('admin' => false,'controller' => 'users', 'action' => 'login'), true);