<script type="text/javascript">
    function getDateValue(value)
        {
            date_range = value.split(",");
            date1 = date_range[0];
            date2 = date_range[1];
            $("#TileFrom").val(date1);
            if (date2 != '0')
            {
                $("#TileTo").val(date2);
            }
            else
            {
                $("#TileTo").val("");
            }
        }
</script>
<?php
//This is for Week Start

$current = date('N');
    $DaysToSunday = 7 - $current;
    $DaysFromMonday = $current - 1;
    $Sunday = date('Y-m-d', strtotime("+ {$DaysToSunday} Days"));
    $Monday = date('Y-m-d', strtotime("- {$DaysFromMonday} Days"));
//This is for Week Start
//This is for Month Start
    $date = date('Y-m-d');
    $firstDay = date('Y-m-01');
//This is for Month End
    ?>
<div id="content-wrapper">
    <div id="heading">Time Tracking Report</div>
    <div class="clear"></div>
    <div id="form-holder" style="background:none">
      <?php echo $this->Form->create('Admins', array('action' => 'report')); ?>
        <?php echo $this->Session->flash(); ?>
        <div id="form-holder" class="form-margin padding top-radius">
            <div id="label">Range </div>
            <div id="textbox" style="width:479px"><?php echo $this->Form->input('Tile.from', array('label' => false, 'div' => false, 'size' => 50, 'placeholder' => 'From Date', 'class' => 'tcal', 'readonly' => 'readonly')); ?>-<?php echo $this->Form->input('Tile.to', array('label' => false, 'div' => false, 'size' => 50, 'placeholder' => 'To Date', 'class' => 'tcal', 'readonly' => 'readonly')); ?>
                <input type="button" class="dateButton" value="Today" onclick='getDateValue("<?php echo date('Y-m-d'); ?>,0")' />
                <input type="button" class="dateButton" value="This week" onclick='getDateValue("<?php echo $Monday; ?>,<?php echo $Sunday; ?>")' />
                <input type="button" class="dateButton" value="This Month" onclick='getDateValue("<?php echo $firstDay; ?>,<?php echo $date; ?>")' />
            </div>
        </div>
        <?php if ($user_type == "admin") { ?>
            <div id="form-holder" class="padding">
            <?php } else { ?>
            <div id="form-holder" style="display:none">
                <?php } ?>
                <div id="label"> Team Member </div>
                <?php if ($user_type == "admin") { ?>
                    <div id="textbox" class="newt"><?php echo $this->Form->input("Tile.emp_id", array('type' => 'select', "options" => array($employee), 'empty' => 'All', 'div' => false, 'label' => false, 'style' => 'width:165px')); ?></div>
                <?php } else { ?>
                    <div id="textbox" class="newt"><?php echo $this->Form->input("Tile.emp_id", array('type' => 'select', "options" => array($employee), 'div' => false, 'label' => false, 'style' => 'width:165px')); ?></div>
                <?php } ?>
                <div id="label" class="newl"> Tile Name </div>
                <div id="textbox"><?php echo $this->Form->input("Tile.job_id", array('type' => 'select', "options" => array($job), 'empty' => 'All', 'div' => false, 'label' => false, 'style' => 'width:145px')); ?>
                    <?php echo $this->Form->submit('Submit', array('div' => false, 'formnovalidate' => true, 'class' => 'submitButton', 'name' => 'search')); ?>


                    <?php if ($user_type == 'admin') { ?>
                        <div class="export_report">
                            <a href="#" class="export">Export</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="timereport">
                <div class="tfirst">
                    <label for="thours">Total Hours: </label>
                    <span class="tvalue">32.85&nbsp;&nbsp;&nbsp;&nbsp;32 hr 52 min</span>
                </div>
                
                <div class="hinside">
                    <label for="hour">Hour: </label>
                    <span class="tvalue">20</span>
                    <label for="payment">Payment: </label>
                    <span class="tvalue">657</span>
                </div>
            </div>
            <!-- <div id="form-holder" class="padding bottom-radius">
                
                
            </div> -->
            <?php print $this->Form->end(); ?>

        </div>
        <div class="clear"></div>
        <div id="form-holder" style="background:none">
            <div id="dvData">
                <table class="border-none" style="background-color:#E0E0E0">
<?php if (!empty($emp)) {
                        if ($emp_name != "empty") {
                            ?> 
                            <tr>
                                <td colspan="2" class="border-none">Team Member :  <?php echo $emp_name; ?> </td>
                            </tr>
                        <?php }
                    }
                    ?>
                    <?php
                    if (!empty($from) && empty($to)) {
                        ?>
                        <tr>
                            <td colspan="2" class="border-none">From :<?php echo $from; ?></td>
                        </tr>
                       <?php
                    }
                    if (empty($from) && !empty($to)) {
                        ?>
                        <tr>
                            <td colspan="2" class="border-none">To :<?php echo $to; ?></td>
                        </tr>
                        <?php
                    }
                    if (!empty($from) && !empty($to)) {
                        ?>
                        <tr>
                            <td colspan="2" class="border-none">Date Range : <?php echo $from; ?> To <?php echo $to; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <table>
                    <tr>
                        <?php if (empty($emp)) { ?>
                            <th class="emp-name">Team Member: </th><?php } else { ?>
                            <th style="display:none"> </th>
                        <?php } ?>
                        <th class="in_date">InDate</th>
                        <th>InTime</th>
                        <th>OutTime</th>
                        <th class="hrs">Hours</th>
                        <th>Hours (hours:minutes)</th>
                        <th class="j-code">Tile Name</th>
                        <?php if ($user_type == 0) { ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
<?php
    $totalTime1 = 0;
    $totalTime2 = 0;
    $thour = 0;
    $t_hr = 0;
    $t_min = 0;
    $i = 1;
    if (!empty($tile)) {
        foreach ($tile as $tempTile) :
            $time1 = $tempTile['Tile']['in_date'] . " " . $tempTile['Tile']['in_time'];
            if ($tempTile['Tile']['out_date']) {
                $time2 = $tempTile['Tile']['out_date'] . " " . $tempTile['Tile']['out_time'];
                $out_time = $tempTile['Tile']['out_time'];
            } else {
                date_default_timezone_set($tempTile['User']['location']);
                $time2 = date("Y-m-d h:i:s A");
                $out_time = date('h:i:s A');
            }

            $datetime1 = new DateTime($time1);
            $datetime2 = new DateTime($time2);
            $interval = $datetime1->diff($datetime2);
            $timer = $interval->format('%h') . " hrs. " . $interval->format('%i') . " min";
            $totalHour = round($interval->format('%h') + ($interval->format('%i') / 60), 2);

            $hour = $interval->format('%h');
            $min = $interval->format('%i');

            $thour+=$totalHour;
            $t_hr+=$hour;
            $t_min+=$min;
            $date_in = $tempTile['Tile']['in_date'];
            $in_date_format = date('m/d/Y', strtotime($date_in));
            //$out_date_format = date('m/d/Y',strtotime($out_time));
        ?>
                            <tr>
                                <?php if (empty($emp)) { ?>
                                <td class="emp-name"><?php echo $tempTile['User']['first_name'] ?> <?php echo $tempTile['User']['last_name']; ?></td><?php } else { ?>
                                <td style="display:none"> </td>
                                <?php } ?>
                                <td class="in_date"><?php echo $in_date_format; ?></td>
                                <td><?php echo $tempTile['Tile']['in_time']; ?></td>
                                <td><?php echo $out_time; ?></td>
                                <td class="hrs"><?php echo $totalHour; ?></td>
                                <td><?php echo $timer; ?></td>
                                <td class="j-code"><?php echo $tempTile['Job']['company_name']; ?></td>
                                <?php if ($user_type == 0) { ?>
                                    <td><?php echo $this->html->link("Edit", "/Admins/edit_time/{$tempTile['Tile']['id']}"); ?> || <?php echo $this->Form->postLink('Delete', array('action' => 'delete_time', $tempTile['Tile']['id']), array('class' => 'btn btn-mini btn-danger'), __('Are you sure you want to Delete this record?', $tempTile['Tile']['id'])); ?></td>
                                <?php } ?> 
                            </tr>
                            <?php $i++;
                            endforeach; ?>
                            <?php if ($count == '0') { ?>
                            <tr>
                                <td colspan="7" align="center" style="color:#F00">Nothing found in this search criteria!</td>
                            </tr>
                            <?php
                            }
                            $t_val = $thour * $tempTile['User']['hourly_rate'];
                            $r_hr = floor($t_min / 60);
                            $tr_hr = $t_hr + $r_hr;
                            ?>

                        <tr>
                            <td colspan="5" align="right" style="background-color:#E0E0E0">Total Hours : <?php echo $thour; ?></td>
                            <td colspan="2" style="background-color:#E0E0E0"><?php echo $tr_hr . " hr " . ($t_min % 60) . " min"; ?></td>
                        </tr>
                        <?php if ($user_type == 0) { ?>
                            <tr>
                                <td colspan="6" align="right" style="background-color:#E0E0E0">Hour : <?php echo $tempTile['User']['hourly_rate']; ?></td>
                                <td colspan="2" style="background-color:#E0E0E0">Payment : <?php echo abs($t_val); ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7" align="center" style="color:#F00">Nothing found in this search criteria!</td>
                        </tr>
                        <?php
                    }
                    ?>

                </table>
            </div>
        </div>

        <?php if ($page != "no_paging") : ?>
            <div class="paging"> <!--Pagination Start -->
                <!-- Shows the next and previous links -->
                <?php echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled')); ?>
                <!-- Shows the page numbers -->
                <?php echo $this->Paginator->numbers(array('separator' => '', 'class' => 'paging-margin')); ?>
                <?php echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled')); ?>
                <!-- prints X of Y, where X is current page and Y is number of pages -->
                <?php echo $this->Paginator->counter(); ?>
            </div> <!--Pagination End -->
        <?php endif;  ?>
    </div>