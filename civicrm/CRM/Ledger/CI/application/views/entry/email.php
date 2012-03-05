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
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?><style type=text/css>
/* MESSAGE BOX */
#message-box {
    border:solid 1px #787878;
    background:#F0F0F0;
    color:#222222;
    margin:5px 0 12px 0px;
    text-align:left;
    display:block;
    padding-right:20px;
}

#error-box {
    border:solid 1px #C34A2C;
    background:#FFBABA;
    color:#222222;
    margin:5px 0 12px 0px;
    text-align:left;
    display:block;
    padding-right:20px;
}

#success-box {
    border:solid 1px #FFEC8B;
    background:#FFF8C6;
    color:#222222;
    margin:5px 0 12px 0px;
    text-align:left;
    display:block;
    padding-right:20px;
}

    
</style><?php
 
	if (isset($error) && $error)
	{
		echo "<div id=\"error-box\">";
		echo "<ul>";
		echo ($error);
		echo "</ul>";
		echo "</div>";
	}

	if (isset($message) && $message)
	{
		echo "<div id=\"message-box\">";
		echo "<ul>";
		echo ($message);
		echo "</ul>";
		echo "</div>";
	}

	echo form_open('entry/email/' . $current_entry_type['label'] . "/" . $entry_id);

	echo "Emailing " .  $current_entry_type['name'] . " Entry No. " . $entry_number . "<br />";

	echo "<p>";
	echo form_label('Email to', 'email_to');
	echo "<br />";
	echo form_input($email_to);
	echo "</p>";

	echo "<p>";
	echo form_submit('submit', 'Send Email');
	echo "</p>";

	echo form_close();

