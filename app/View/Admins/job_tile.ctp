<script type="text/javascript">
$(document).ready(function(){
setTimeout("ReloadPage()", 60000); //Force Browser to relaod page
});
</script>
<div id="content-wrapper-wide">
	<div id="heading" style="width:861px;margin-left:9px;">JOB TILE</div>
	<div class="clear"></div>
    <div id="reload">
		<?php echo $this->element( 'job' ); ?>
    </div>
</div>