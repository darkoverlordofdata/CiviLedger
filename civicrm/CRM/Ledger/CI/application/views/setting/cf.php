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

	echo form_open('setting/cf');

	echo "<p>";
	echo form_label('C/F Label', 'account_label');
	echo "<br />";
	echo form_input($account_label);
	echo "<br />";
	echo "<span class=\"form-help-text\">Example : prashant0708</span>";
	echo "</p>";

	echo "<p>";
	echo form_label('C/F Account Name', 'account_name');
	echo "<br />";
	echo form_input($account_name);
	echo "</p>";

	echo "<p>";
	echo form_label('C/F Financial Year Start', 'fy_start');
	echo "<br />";
	echo form_input_date($fy_start);
	echo "<br />";
	echo "<span class=\"form-help-text\">Foramt : " . $this->config->item('account_date_format') . "</span>";
	echo "</p>";

	echo "<p>";
	echo form_label('C/F Financial Year End', 'fy_end');
	echo "<br />";
	echo form_input_date($fy_end);
	echo "<br />";
	echo "<span class=\"form-help-text\">Format : " . $this->config->item('account_date_format') . "</span>";
	echo "</p>";

	echo "<p>";
	echo form_submit('submit', 'Carrfy forward');
	echo " ";
	echo anchor('setting', 'Back', array('title' => 'Back to settings'));
	echo "</p>";

	echo form_close();

