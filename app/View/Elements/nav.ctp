
        <nav id="top-navigation">
            <ul class="menu">
                <?php 
				if($user_type=="admin")
				{
					?>
					<li><a href="#">Employee</a>
						<ul>
						  <li><?php echo $this->html->link("Add Employee",  "/Admins/create_emp");?></a></li>
						  <li><?php echo $this->html->link("Employee List",  "/Admins/employee_list");?></a></li>
						</ul>
					</li>
					<li><?php echo $this->html->link("Tiles",  "/Admins/add_job");?></a></li>
					<?php 
				}
				else
				{
					?>
					<li><?php echo $this->html->link("Tiles",  "/Admins/job_tile");?></a></li>
					<?php 
				}
				?>
                <li><?php echo $this->html->link("Reports",  "/Admins/report");?></a></li>
                <li><?php echo $this->html->link("Feedback",  "/Admins/feedback");?></a></li>
            </ul>
         </nav> <!-- #top-nagivation -->
        