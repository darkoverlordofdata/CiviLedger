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

	echo form_open('user/account');

	echo "<p>";
	echo "<b>Currently active account : </b>";
	$current_active_account = $this->session->userdata('active_account');
	echo ($current_active_account) ? $current_active_account : "(None)";
	echo "</p>";

	echo "<p>";
	echo "Select account";
	echo "<br />";
	echo form_dropdown('account', $accounts, $active_account);
	echo "</p>";

	echo "<p>";
	echo form_submit('submit', 'Activate');
	echo " ";
	echo anchor('', 'Back', array('title' => 'Back to accounts'));
	echo "</p>";

	echo form_close();

