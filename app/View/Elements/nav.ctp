        <div class="tilelogo">
            <img class="svglogo" src="<?php echo $this->webroot; ?>img/tileclock-logo.svg" alt="">
        </div>
        <nav id="top-navigation">
            <ul class="menu">
                <?php 
                if($user_type=="admin")
                {
                        ?>
                    <li class="team"><a href="#">TEAM</a>
                            <ul>
                              <li><?php echo $this->html->link("ADD MEMBER",  "/Admins/create_emp");?></li>
                              <li><?php echo $this->html->link("MEMBER LIST",  "/Admins/employee_list");?></li>
                            </ul>
                    </li>
                    <li><?php echo $this->html->link("Manage Tiles",  "/Admins/add_job");?></li>
                    <?php 
                }
                    ?>
                    <li class="tiles"><?php
                    echo $this->Html->link(
                    $this->Html->tag('span','')."Tiles", 
                    array('controller'=>'Admins','action'=>'job_tile'),
                    array('escape'=>false)
                    ); ?></li>
                    <li class="reports"><?php echo $this->html->link($this->html->tag('span','')."Reports",  "/Admins/report", array('escape' => false));?></li>
                    <li class="feedback"><?php echo $this->html->link($this->html->tag('span','')."Feedback",  "/Admins/feedback", array('escape' => false));?></li>
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
                 <?php echo $this->html->link($this->html->tag('span','').'LOGOUT', array('controller' => 'Users', 'action' => 'logout', array('class' => 'lclass')), array('escape' => false)); ?>
            </div>
        </div>
        <?php endif; ?>
        