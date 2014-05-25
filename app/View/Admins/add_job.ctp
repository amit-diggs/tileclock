<div id="content-wrapper" style='margin-top:20px;'>
<?php echo $this->Form->create('Admins',array('action' => 'add_job'));?>
	<div id="heading">Add New Job</div>
    <?php echo $this->Session->flash(); ?>
	<div id="form-holder">
		<div id="label">Company Name :</div>
		<div id="textbox"><?php echo $this->Form->input('Job.company_name',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'Company Name..')); ?></div>
        <div class="asterisk">(*)</div>
	</div>
    <div id="form-holder">
		<div id="label">Tile Color :</div>
		<div id="textbox"><?php echo $this->Form->input('Job.bg_color',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'Tile color..')); ?><?php echo $this->Form->input('Job.created_by',array('value'=>$emp_id,'type'=>'hidden')); ?></div>
        <div class="asterisk">(*)</div>
	</div>
	<?php echo $this->Form->submit('Save', array('div' => false,'formnovalidate' => true,'class'=>'submitButton'));?><br/>
<?php print $this->Form->end();?> 
</div>

<div id='center'>
    <div id="form-holder" style="background:none">
            <table>
                <tbody>
                    <th>SL</th>
                    <th>First Name</th>
                    <th>Tile Color</th>
                    <th>Action</th>
                </tbody>
                <tbody>
                  <?php $i=1;foreach($jobList as $tempJob):?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $tempJob['Job']['company_name']; ?></td>
                        <td><?php echo $tempJob['Job']['bg_color']; ?></td>
                        <td>
                            <?php echo $this->html->link("Edit",  "/Admins/edit_job/{$tempJob['Job']['id']}");?> || 
                            <?php 
                            if($tempJob['Job']['status']=='0')
                            {
                                echo $this->Form->postLink('Delete', array('action' => 'delete_job', $tempJob['Job']['id']), array('class' => 'btn btn-mini btn-danger'), __('Are you sure you want to Delete this record?', $tempJob['Job']['id'])); 
                            }
                            else
                            {
                                echo $this->Form->postLink('Active', array('action' => 'active_job', $tempJob['Job']['id']), array('class' => 'btn btn-mini btn-danger'), __('Are you sure you want to Active this record?', $tempJob['Job']['id'])); 	
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
