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

	echo "<p>";
	echo "You are currently logged in as: " . "<strong>" .  $this->session->userdata('user_name') . "</strong>";
	echo " (";
	echo anchor('user/logout', 'Logout', array('title' => 'Logout', 'class' => 'anchor-link-a'));
	echo ")";
	echo "</p>";

	echo "<p>";
	echo "Your current role is: " . "<strong>" .  $this->session->userdata('user_role') . "</strong>";
	echo "</p>";

	echo "<p>";
	echo "Currently active account is: " . "<strong>";
	if ($this->session->userdata('active_account'))
		echo $this->session->userdata('active_account');
	else
		echo "(None)";
	echo "</strong>";
	echo " (";
	echo anchor('user/account', 'Change', array('title' => 'Change Account', 'class' => 'anchor-link-a'));
	echo ")";
	echo "</p>";

	echo "<p>";
	echo "Application version is: " . "<strong>" .  $this->config->item('application_version') . "</strong>";
	echo "</p>";
