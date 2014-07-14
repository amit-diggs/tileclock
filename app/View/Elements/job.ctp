<?php
if (!empty($active)) {
    $fetchDate1 = $active['Tile']['in_date'] . " " . $active['Tile']['in_time'];
    date_default_timezone_set($active['User']['location']);
    $fetchDate2 = date('Y-m-d h:i:s A');
    $datetime1 = new DateTime($fetchDate1);

    $datetime2 = new DateTime($fetchDate2);
    $interval = $datetime1->diff($datetime2);
    $min = $interval->format('%i');
    $countMin = strlen($min);
    if ($countMin == 1) {
        $min = "0" . $min;
    }
    $totalHour = $interval->format('%h') . ":" . $min;
}
?>
<div id="form-holder" class="wide" style="background:none">
    <div id="clock1" class="inactive"></div>
<?php
if (!empty($active)) {
    ?>
        <div onclick="canceTimer()" id="cancelJob">Stop</div>
        <?php
    }
    if (!empty($active)) {
        ?>
        <div id="jobStatus">Job Code : <?php echo $active['Job']['company_name']; ?><br/>Timeclock : <?php echo $totalHour; ?></div>
    <?php } else { ?>
        <div id="jobStatus">Job Code : Not Selected<br/>Timeclock : 0:00</div>
    <?php } ?>
    <div class="clear"></div>
    <ul class="job-tile">
        <input type="hidden" name="in_date" id="in_date" />
        <span class="inactive"><div class="clock1"></div></span>
        <input type="hidden" name="out_date" id="out_date" />
        <input type="hidden" name="out_time" id="out_time"/>
        <input type="hidden" name="status" id="status" value="1"/>
        <input type="hidden" name="created_by" id="created_by" value="<?php echo $created_by; ?>"/>
        <?php
        foreach ($job_tile as $tempJob):
            $status = $this->requestAction('Admins/getJobId/' . $tempJob['Job']['id']);
            if (!empty($status)) {
                ?> 
                <li onclick="timer(<?php echo $tempJob['Job']['id']; ?>)" style="background-color: <?php echo "#" . $tempJob['Job']['bg_color']; ?>" class="active" id="sw_start">
                    <div class="line-br"><?php echo $tempJob['Job']['company_name']; ?></div></li>
                <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $emp_id; ?>"/>
        <?php
    } else {
        ?>
                <li onclick="timer(<?php echo $tempJob['Job']['id']; ?>)" style="background-color:<?php echo "#" . $tempJob['Job']['bg_color']; ?>">
                    <div class="line-br"><?php echo $tempJob['Job']['company_name']; ?></div></li>
                <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $emp_id; ?>"/>
                <?php
            }
            ?>
        <?php endforeach; ?>
    </ul>
</div>