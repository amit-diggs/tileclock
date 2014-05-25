<div id="content-wrapper">
    <div id="heading">Search Employee</div>
    <div class="clear"></div>
    <?php echo $this->Session->flash(); ?>
    <div id="form-holder" style="background:none" class="form-margin">
       <?php echo $this->Form->create('Admins',array('action' => 'employee_list'));?>	
        
        <div class="left">
        	<div class="searchLabel">First Name:</div>
            <div class="searchTextbox"><?php echo $this->Form->input('User.first_name',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'First Name..','style'=>'width:135px')); ?></div>
        </div>
        <div class="right">
        	<div class="searchLabel">Last Name:</div>
            <div class="searchTextbox"><?php echo $this->Form->input('User.last_name',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'Last Name..','style'=>'width:135px')); ?></div>
        </div>
        <div class="right">
        	<div class="searchLabel">Hourly Rate :</div>
            <div class="searchTextbox"><?php echo $this->Form->input('User.hourly_rate',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'Hourly Rate..','style'=>'width:135px','type'=>'text')); ?></div>
        </div>
        
        <?php echo $this->Form->submit('Search', array('div' => false,'formnovalidate' => true,'class'=>'submitButton','style'=>'margin:20px 0 0 810px'));?>
        <input type="hidden" name="searchEmployee" />
       <?php print $this->Form->end();?>
    </div>
	<div id="heading">Employee List</div>
	<div id="form-holder" style="background:none">
		<table>
        	<tbody>
            	<th>SL</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Address</th>
                <th>Location</th>
                <th>Hourly Rate($)</th>
                <th>Action</th>
            </tbody>
            <tbody>
              <?php 
			  $i=1;
			  foreach($employeeList as $tempEmp):
			    ?>
            	<tr>
                    <td><?php echo $i; ?></td>
                	<td><?php echo $tempEmp['User']['first_name']; ?></td>
                    <td><?php echo $tempEmp['User']['last_name']; ?></td>
                    <td><?php echo $tempEmp['User']['email_address']; ?></td>
                    <td><?php echo $tempEmp['User']['address']; ?></td>
                    <td><?php echo $tempEmp['User']['location']; ?></td>
                    <td><?php echo $tempEmp['User']['hourly_rate']; ?></td>
                    <td>
						<?php echo $this->html->link("Edit",  "/Admins/edit_emp/{$tempEmp['User']['id']}");?> || 
						<?php 
						if($tempEmp['User']['status']=='0')
						{
							echo $this->Form->postLink('Delete', array('action' => 'delete_emp', $tempEmp['User']['id']), array('class' => 'btn btn-mini btn-danger'), __('Are you sure you want to Delete this record?', $tempEmp['User']['id'])); 
						}
						else
						{
							echo $this->Form->postLink('Active', array('action' => 'active_emp', $tempEmp['User']['id']), array('class' => 'btn btn-mini btn-danger'), __('Are you sure you want to Active this record?', $tempEmp['User']['id'])); 	
						}
						?>
                    </td>
                </tr>
              <?php $i++; endforeach; ?>
            </tbody>
        </table>
	</div>
    
    <div class="paging"> <!--Pagination Start -->
        <!-- Shows the next and previous links -->
        <?php echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled')); ?>
        <!-- Shows the page numbers -->
        <?php echo $this->Paginator->numbers(array('separator' => '','class'=>'paging-margin')); ?>
        <?php echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled')); ?>
        <!-- prints X of Y, where X is current page and Y is number of pages -->
        <?php echo $this->Paginator->counter(); ?>
    </div> <!--Pagination End -->
    
</div>