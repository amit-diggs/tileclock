
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
        