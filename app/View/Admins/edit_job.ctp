<div id="content-wrapper">
<?php 
echo $this->Form->create('Admins',array('url' => $this->params['id'])); 
echo $this->Form->hidden('Job.id');
?>
	<div id="heading">Create Employee</div>
    <?php echo $this->Session->flash(); ?>
	<div id="form-holder">
		<div id="label">First Name :</div>
		<div id="textbox"><?php echo $this->Form->input('Job.company_name',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'First Name..')); ?></div>
	</div>
    
    <div id="form-holder">
		<div id="label">Background Color :</div>
		<div id="textbox"><?php echo $this->Form->input('Job.bg_color',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'Tile Color..')); ?></div>
	</div>
    <input type="hidden" name="edit" />
	<?php echo $this->Form->submit('Edit', array('div' => false,'formnovalidate' => true,'class'=>'submitButton'));?><br/>
<?php print $this->Form->end();?> 
</div>