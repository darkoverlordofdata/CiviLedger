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

	echo form_open('admin/setting');

	echo "<p>";
	echo form_label('Number of rows to display per page', 'row_count');
	echo "<br />";
	echo form_dropdown('row_count', $row_count_options, $row_count);
	echo "</p>";

	echo "<p>";
	echo form_checkbox($log) . " Log Messages";
	echo "</p>";

    echo "<p>";
    echo form_checkbox($userlogin) . " Use CMS User Login";
    echo "</p>";

	echo "<p>";
	echo form_submit('submit', 'Update');
	echo " ";
	echo anchor('admin', 'Back', array('title' => 'Back to admin'));
	echo "</p>";

	echo form_close();

