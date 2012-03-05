<?php
/*
+--------------------------------------------------------------------+
| CiviLedger version 0.1
+--------------------------------------------------------------------+
| Copyright DarkOverlordOfData (c) 2012
+--------------------------------------------------------------------+
|                                                                    |
| This file is a part of CiviLedger.                                 |
|                                                                    |
| CiviLedger is free software; you can copy, modify, and distribute  |
| it under the terms of the GNU General Public License Version 3     |
|                                                                    |
+--------------------------------------------------------------------+
*/
/**
 * 
 * @package Ledger
 * @copyright DarkOverlordOfData (c) 2012
 *
 */
?>
<div class="clear"></div>
<?php if (count($calendar) == 0) { ?>
<br>
<div class="messages status">
    <div class="icon inform-icon"></div>
    No current fiscal calendar found. You can <?php echo anchor("admin/calendar/create", "Create a New Celendar"); ?> now.            
    <table>
    <tbody><tr></tr>      
        <tr></tr>
    </tbody></table>
</div>
<?php echo anchor('admin', 'Back', array('title' => 'Back to admin'));
} else { ?>
<p>
    <b>Fiscal Year Start Date: </b><?php echo date_mysql_to_php(print_value($start_date)); ?>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <b>Fiscal Year End Date: </b><?php echo date_mysql_to_php(print_value($end_date)); ?>
</p>
<table border=0 cellpadding=5 class="simple-table calendar-table">
<thead><tr><th>Period</th><th>Year</th><th>Start Date</th><th>End Date</th><th>Open</th><th>Closed</th><th></th><th>Action</th></tr></thead>
<tbody>
    <?php
    $odd_even = "odd";
    $show_close = TRUE;
    $show_open = TRUE;
    $processed = 0;
    foreach ($calendar as $row) {
    
        echo "<tr class=\"tr-" . $odd_even . "\">";
        echo "<td>" . $row->period . "</td>";
        echo "<td>" . $row->year . "</td>";
        echo "<td>" . date_mysql_to_php(print_value($row->start)) . "</td>";
        echo "<td>" . date_mysql_to_php(print_value($row->end)) . "</td>";
        echo "<td>" . $row->opened . "</td>";
        echo "<td>" . $row->closed . "</td>";
        echo "<td>";
        echo "</td>";
        echo "<td>";
        $processed = $processed + $row->opened + $row->closed;
        if ($row->opened == 0 AND $show_open == TRUE) {
            $show_open = FALSE;
            echo anchor("admin/calendar/open/" . $row->period, 
                    img(array(
                        'src' => asset_url() . "images/icons/calendar.png", 
                        'border' => '0', 
                        'alt' => 'Open Period ' . $row->period, 
                        'class' => "confirmClick", 
                        'title' => "Open Period " . $row->period)));
        }
        if ($row->opened == TRUE AND $row->closed == 0 AND $show_close == TRUE) {
            $show_close = FALSE;
            $show_open = FALSE;
            echo anchor("admin/calendar/close/" . $row->period, 
                    img(array(
                        'src' => asset_url() . "images/icons/calendar.png", 
                        'border' => '0', 
                        'alt' => 'Close Period ' . $row->period, 
                        'class' => "confirmClick", 
                        'title' => "Close Period " . $row->period))); 
        }
        echo "</td>";
        
        echo "</tr>";
        $odd_even = ($odd_even == "odd") ? "even" : "odd";
    }
?>
</tbody>
</table>
<br />
<?php 
    echo anchor('admin', 'Back', array('title' => 'Back to admin'));
    if ($processed == 0) {
        echo " | " . anchor('admin/calendar/delete', 'Delete', array('title' => 'Delete Calendar'));
    }
} ?>


