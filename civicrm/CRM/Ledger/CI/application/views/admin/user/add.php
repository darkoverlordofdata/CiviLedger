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

	echo form_open('admin/user/add');

	echo "<p>";
	echo form_label('Username', 'user_name');
	echo "<br />";
	echo form_input($user_name);
	echo "</p>";

	echo "<p>";
	echo form_label('Password', 'user_password');
	echo "<br />";
	echo form_password($user_password);
	echo "</p>";

	echo "<p>";
	echo form_label('Email', 'user_email');
	echo "<br />";
	echo form_input($user_email);
	echo "</p>";

	echo "<p>";
	echo form_label('Role', 'user_role');
	echo "<br />";
	echo form_dropdown('user_role', $user_roles, $active_user_role);
	echo "</p>";

    echo "<p>";
 	echo form_checkbox($user_status) . " Active?";
	echo "</p>";

	echo "<p>";
	echo form_label('Select accounts', 'accounts[]');
	echo "<br />";
	echo form_multiselect('accounts[]', $accounts,  $accounts_active);
	echo "</p>";

    echo "<p>";
    echo form_label('Active account', 'user_account');
    echo "<br />";
    echo form_dropdown('user_account', $user_accounts, $active_user_account);
    echo "</p>";

	echo "<p>";
	echo form_submit('submit', 'Add');
	echo " ";
	echo anchor('admin/user', 'Back', array('title' => 'Back to user list'));
	echo "</p>";

	echo form_close();

