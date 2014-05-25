<div id="content-wrapper">
<?php 
echo $this->Form->create('Admins',array('url' => $this->params['id'])); 
echo $this->Form->input('Tile.id',array('label'=>false,'div'=>false,'size'=>50,'type'=>'hidden','value'=>$tile['Tile']['id']));
$timeIn = explode(' ',$tile['Tile']['in_time']);
$timeInArr = explode(':',$timeIn[0]);

$timeOut = explode(' ',$tile['Tile']['out_time']);
$timeOutArr = explode(':',$timeOut[0]);
?>
	<div id="heading">Edit Time</div>
    <?php echo $this->Session->flash(); ?>
	<div id="form-holder">
		<div id="label">Start Date/Time:</div>
		<div id="textbox" style="width:144px"><?php echo $this->Form->input('Tile.in_date',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'Start Time','class'=>'tcal','value'=>$tile['Tile']['in_date'],'type'=>'text')); ?></div> 
        <div id="textbox" style="width:55px"><?php echo $this->Form->input('Tile.in_hr',array('label'=>false,'div'=>false,'size'=>50,'style'=>'width:55px','value'=>$timeInArr[0])); ?></div> 
        <div id="textbox" style="width:55px"><?php echo $this->Form->input('Tile.in_min',array('label'=>false,'div'=>false,'size'=>50,'style'=>'width:55px','value'=>$timeInArr[1])); ?></div>
        <div id="textbox" style="width:55px"><?php echo $this->Form->input('Tile.in_sec',array('label'=>false,'div'=>false,'size'=>50,'style'=>'width:55px','value'=>$timeInArr[2]));?></div>
        <div id="textbox" style="width:50px;margin: 2px 0 0 10px">
        	<select name="data[Tile][in_type]" id="TileInType" style="width:50px">
               <?php 
			   $inType = array("AM"=>"AM","PM"=>"PM");
			   foreach($inType as $key =>$val)
			   {
				   if($val == $timeIn[1]) 
				   {
					?>
            		<option selected="selected"><?php echo $val; ?></option>
                    <?php 
				   }
				   else
				   {
					?>
                    <option><?php echo $val; ?></option>
                	<?php 
				   }
			   }
			   		?>
            </select>
        </div>
	</div>
    
    <div id="form-holder">
		<div id="label">End Date/Time:</div>
		<div id="textbox" style="width:144px"><?php echo $this->Form->input('Tile.out_date',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'Start Time','class'=>'tcal','value'=>$tile['Tile']['out_date'],'type'=>'text')); ?></div> 
        <div id="textbox" style="width:55px"><?php echo $this->Form->input('Tile.out_hr',array('label'=>false,'div'=>false,'size'=>50,'style'=>'width:55px','value'=>$timeOutArr[0])); ?></div> 
        <div id="textbox" style="width:55px"><?php echo $this->Form->input('Tile.out_min',array('label'=>false,'div'=>false,'size'=>50,'style'=>'width:55px','value'=>$timeOutArr[1])); ?></div>
        <div id="textbox" style="width:55px"><?php echo $this->Form->input('Tile.out_sec',array('label'=>false,'div'=>false,'size'=>50,'style'=>'width:55px','value'=>$timeOutArr[2]));?></div>
        <div id="textbox" style="width:50px;margin: 2px 0 0 10px">
        	<select name="data[Tile][out_type]" id="TileOutType" style="width:50px">
            	<?php 
			   $inType = array("AM"=>"AM","PM"=>"PM");
			   foreach($inType as $key =>$val)
			   {
				   if($val == $timeOut[1]) 
				   {
					?>
            		<option selected="selected"><?php echo $val; ?></option>
                    <?php 
				   }
				   else
				   {
					?>
                    <option><?php echo $val; ?></option>
                	<?php 
				   }
			   }
			   		?>
            </select>
        </div>
	</div>
    <input type="hidden" name="data[Tile][in_time]" id="TileOutTime" />
    <input type="hidden" name="data[Tile][out_time]" />
    <input type="hidden" name="edit" />
    <br/>
	<?php echo $this->Form->submit('Edit', array('div' => false,'formnovalidate' => true,'class'=>'submitButton'));?>
<?php print $this->Form->end();?> 
</div>