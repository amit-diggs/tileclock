<?php 
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', '::Welcome to timeclock::');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title; ?>
	</title>
   <?php 
    echo $this->Html->meta('icon');
    echo $this->Html->css('style');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
    <script class="jsbin" src="<?php echo $this->webroot; ?>js/jquery.min.js"></script>
    <script class="jsbin" src="<?php echo $this->webroot; ?>js/tcal.js"></script>
    <script type="text/javascript">var myBaseUrl = '<?php echo $this->base;?>';</script>
    <script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot; ?>js/main.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot; ?>js/colpick.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot; ?>js/eye.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot; ?>js/utils.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot; ?>js/layout.js?ver=1.0.2"></script>
</head>

<body>
    <div id="whole-wrapper">
        <?php echo $this->element('header'); ?>
        <?php if(!empty($emp_id)): ?>
        <div id="menu-bg">
           <?php echo $this->element('nav'); ?>
        </div>
        <?php endif; ?>
        <div id="content">
           <?php echo $this->fetch('content'); ?>
        </div>
        <div id="footer">
            <div id="footer-bg">&copy; Copyright 2013,All right reserved</div>
        </div>
   </div>
   <?php echo $this->element('sql_dump'); ?>
</body>
</html>
