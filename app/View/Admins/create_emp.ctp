<?php 
$location = array(
	"Pacific/Kwajalein" => "(GMT -12:00) Eniwetok, Kwajalein",
	"Pacific/Samoa" => "(GMT -11:00) Midway Island, Samoa",
	"Pacific/Honolulu" => "(GMT -10:00) Hawaii",
	"America/Anchorage" => "(GMT -9:00) Alaska",
	"America/Los_Angeles" => "(GMT -8:00) Pacific Time (US & Canada)",
	"America/Denver" => "(GMT -7:00) Mountain Time (US & Canada)",
	"America/Chicago" => "(GMT -6:00) Central Time (US & Canada), Mexico City",
	"America/New_York" => "(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima",
	"Atlantic/Bermuda" => "(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz",
	"Canada/Newfoundland" => "(GMT -3:30) Newfoundland",
	"Brazil/East" => "(GMT -3:00) Brazil, Buenos Aires, Georgetown",
	"Atlantic/Azores" => "(GMT -2:00) Mid-Atlantic",
	"Atlantic/Cape_Verde" => "(GMT -1:00 hour) Azores, Cape Verde Islands",
	"Europe/London" => "(GMT) Western Europe Time, London, Lisbon, Casablanca",
	"Europe/Brussels" => "(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris",
	"Europe/Helsinki" => "(GMT +2:00) Kaliningrad, South Africa",
	"Asia/Baghdad" => "(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg",
	"Asia/Tehran" => "(GMT +3:30) Tehran",
	"Asia/Baku" => "(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi",
	"Asia/Kabul" => "(GMT +4:30) Kabul",
	"Asia/Karachi" => "(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent",
	"Asia/Calcutta" => "(GMT +5:30) Bombay, Calcutta, Madras, New Delhi",
	"Asia/Dhaka" => "(GMT +6:00) Almaty, Dhaka, Colombo",
	"Asia/Bangkok" => "(GMT +7:00) Bangkok, Hanoi, Jakarta",
	"Asia/Hong_Kong" => "(GMT +8:00) Beijing, Perth, Singapore, Hong Kong",
	"Asia/Tokyo" => "(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk",
	"Australia/Adelaide" => "(GMT +9:30) Adelaide, Darwin",
	"Pacific/Guam" => "(GMT +10:00) Eastern Australia, Guam, Vladivostok",
	"Asia/Magadan" => "(GMT +11:00) Magadan, Solomon Islands, New Caledonia",
	"Pacific/Fiji" => "(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka"
);
?>
<div id="content-wrapper">
<?php echo $this->Form->create('Admins',array('action' => 'create_emp'));?>
	<div id="heading">Create Employee</div>
    <div class="clear"></div>
    <?php echo $this->Session->flash(); ?>
	<div id="form-holder" class="form-margin">
		<div id="label">First Name :</div>
		<div id="textbox"><?php echo $this->Form->input('User.first_name',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'First Name..')); ?></div>
        <div class="asterisk">(*)</div>
	</div>
	
	<div id="form-holder">
		<div id="label">Last Name :</div>
		<div id="textbox"><?php echo $this->Form->input('User.last_name',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'Last Name..')); ?></div>
        <div class="asterisk">(*)</div>
	</div>
    
    <!--<div id="form-holder">
		<div id="label">User Name :</div>
		<div id="textbox"><?php //echo $this->Form->input('User.username',array('label'=>false,'div'=>false,'size'=>50,'maxLength'=>'50','placeholder'=>'User Name..')); ?></div>
        <div class="asterisk">(*)</div>
	</div>-->
    
    <div id="form-holder">
		<div id="label">Email Address :</div>
		<div id="textbox"><?php echo $this->Form->input('User.email_address',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'Enter a valid email address..')); ?><?php echo $this->Form->input('User.user_type',array('type'=>'hidden','value'=>'user')); ?><?php echo $this->Form->input('User.created_by',array('type'=>'hidden','value'=>$emp_id)); ?> <?php echo $this->Form->input('User.status',array('type'=>'hidden','value'=>0)); ?></div>
        <div class="asterisk">(*)</div>
	</div>
    
    <div id="form-holder">
		<div id="label">Password :</div>
		<div id="textbox"><?php echo $this->Form->input('User.password',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'Password..')); ?></div>
        <div class="asterisk">(*)</div>
	</div>
	
	<div id="form-holder">
		<div id="label">Address :</div>
		<div id="textbox"><?php echo $this->Form->input('User.address',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'Enter address here...','type'=>'textarea')); ?></div>
        <div class="asterisk">(*)</div>
	</div>
    
    <div id="form-holder">
		<div id="label">Location :</div>
		<div id="textbox"><?php echo $this->Form->input("User.location",array('type'=>'select',"options"=>array($location),'empty'=>'Select Timezone','div'=>false,'label'=>false,'style'=>'width:330px'));?></div>
        <div class="asterisk">(*)</div>
	</div>
	
	<div id="form-holder">
		<div id="label">Hourly Rate($):</div>
		<div id="textbox"><?php echo $this->Form->input('User.hourly_rate',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'Hourly Rate..','type'=>'text')); ?></div>
        <div class="asterisk">(*)</div>
	</div>
	<?php echo $this->Form->submit('Save', array('div' => false,'formnovalidate' => true,'class'=>'submitButton'));?><br/>
<?php print $this->Form->end();?> 
</div>