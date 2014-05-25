        
        <div id="r_wrapper">
            <div id="r_header">
               <div id="logo-container">
            		<img class="image-margin" src="<?php echo $this->webroot; ?>img/tileclock-logo.png" />
               </div>
            </div>
            <?php if(!empty($emp_id)): ?>
            <div id="l_header">
             <div class="name-con">
					<?php $user_type; if($user_type=='Admin')
                    {
                        echo "ADMIN PANEL"."<br/>";
                    }
                    ?>
                    <?php echo $this->viewVars['first_name']; ?> <?php echo $this->viewVars['last_name']; ?>
                </div>
              
                <div class="name-con">
                	 <?php echo $this->html->link('LOGOUT', array('controller' => 'Users', 'action' => 'logout')); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>