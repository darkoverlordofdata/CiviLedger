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
?><script type='text/javascript'>
cj(function() {
    cj( "#start_date" ).datepicker();
    cj( "#end_date" ).datepicker();
});
</script><?php
    echo form_open('admin/calendar/create');

    echo "<p>";
    echo form_label('Start Date', 'start_date');
    echo "<br />";
    echo form_input($start_date);
    echo "<br />";
    echo "</p>";

    echo "<p>";
    echo form_label('End Date', 'end_date');
    echo "<br />";
    echo form_input($end_date);
    echo "<br />";
    echo "</p>";

    echo "<p>";
    echo form_label('Calendar type', 'calendar_type');
    echo "<br />";
    echo form_dropdown('calendar_type', $calendar_types, $calendar_type);
    echo "</p>";

    echo "<p>";
    echo form_checkbox($use_53_week) . " 53 Week Calendar?";
    echo "</p>";

    echo "<p>";
    echo form_submit('submit', 'Create');
    echo " ";
    echo anchor('admin/manage', 'Back', array('title' => 'Back to active account list'));
    echo "</p>";

    echo form_close();

?>