<?php echo $this->Form->create('User');?>
<div id="topwrapper">
    <div id="wrapper">
        <div id="sign"><strong>SIGN IN</strong></div>
        <div id="textbox-holder">
           <?php echo $this->Session->flash(); ?>
		   <div id="login-textbox">
		   	  <?php echo $this->Form->input('email_address',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'Username','style'=>'height:53px;width:275px;border:none;background-color: #F8F8F8;font-size:18px;padding-left:10px')); ?>
           </div>
           <div id="img1"><img src="<?php echo $this->webroot;?>img/image/name.png" /></div>
        </div>
        <div id="textbox-holder">
		   <div id="login-textbox">
		   	  <?php echo $this->Form->input('password',array('label'=>false,'div'=>false,'size'=>50,'placeholder'=>'Password','style'=>'height:53px;width:275px;border:none;background-color: #F8F8F8;font-size:18px;padding-left:10px','type'=>'password')); ?>
           </div>
           <div id="img1"><img src="<?php echo $this->webroot;?>img/image/key.png" style="margin-left:3px" /></div>
        </div>

        <?php echo $this->Form->submit('SIGN IN', array('div' => false,'formnovalidate' => true,'class'=>'buttonSubmit'));?><br/>
        <div id="crear">
            <?php echo $this->Html->link(__('Forgote password?'), array('controller' => 'users', 'action' => 'forgot_password')); ?>
        </div>
    </div>
    
</div>
<?php print $this->Form->end();?>   

