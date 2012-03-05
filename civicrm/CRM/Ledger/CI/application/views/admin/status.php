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

	if (is_array($error_messages))
	{
		if (count($error_messages) > 0)
		{
			echo "<div id=\"error-box\">";
			echo "<ul>";
			foreach ($error_messages as $message)
			{
				echo ('<li>' . $message . '</li>');
			}
			echo "</ul>";
			echo "</div>";
		} else {
			echo "<div id=\"success-box\">";
			echo "<ul>";
			echo "<li>Everything is configured correctly.</li>";
			echo "</ul>";
			echo "</div>";

		}
	}

	echo "<p>";
	echo anchor('admin', 'Back', 'Back to admin');
	echo "</p>";
