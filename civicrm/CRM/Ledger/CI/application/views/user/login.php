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

	echo form_open('user/login');

	echo "<p>";
	echo form_label('User name', 'user_name');
	echo "<br />";
	echo form_input($user_name);
	echo "</p>";

	echo "<p>";
	echo form_label('Password', 'user_password');
	echo "<br />";
	echo form_password($user_password);
	echo "</p>";

	echo "<p>";
	echo "<span class=\"form-help-text\">Hint : You may login with user name as 'admin' and password as 'admin'</span>";
	echo "</p>";

	echo "<p>";
	echo form_submit('submit', 'Login');
	echo "</p>";

	echo form_close();

