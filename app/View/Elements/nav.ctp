        <div class="tilelogo">
            <img class="svglogo" src="<?php echo $this->webroot; ?>img/tileclock-logo.svg" alt="">
        </div>
        <nav id="top-navigation">
            <ul class="menu">
                <?php 
                if($user_type=="admin")
                {
                        ?>
                    <li><a href="#">TEAM</a>
                            <ul>
                              <li><?php echo $this->html->link("ADD MEMBER",  "/Admins/create_emp");?></a></li>
                              <li><?php echo $this->html->link("MEMBER LIST",  "/Admins/employee_list");?></a></li>
                            </ul>
                    </li>
                    <li><?php echo $this->html->link("Manage Tiles",  "/Admins/add_job");?></a></li>
                    <?php 
                }
                    ?>
                    <li><?php echo $this->html->link("Tiles",  "/Admins/job_tile");?></a></li>
                    <li><?php echo $this->html->link("Reports",  "/Admins/report");?></a></li>
                    <li><?php echo $this->html->link("Feedback",  "/Admins/feedback");?></a></li>
            </ul>
         </nav> <!-- #top-nagivation -->
        <?php if(!empty($emp_id)): ?>
        <div id="l_header">
            <div class="avatar">
                <img class="avimg" src="<?php echo $this->webroot; ?>img/avatar.png" />
            </div>
            <div class="name-con enam">
                <?php $user_type; if($user_type=='Admin')
                {
                    echo "ADMIN PANEL"."<br/>";
                }
                ?>
                <?php echo $this->viewVars['first_name']; ?> <?php echo $this->viewVars['last_name']; ?>
            </div>
          
            <div class="name-con lout">
                 <?php echo $this->html->link('LOGOUT', array('controller' => 'Users', 'action' => 'logout', array('class' => 'lclass'))); ?>
            </div>
        </div>
        <?php endif; ?>
        