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

	echo form_open('tag/edit/' . $tag_id);

	echo "<p>";
	echo form_label('Tag Title', 'tag_title');
	echo "<br />";
	echo form_input($tag_title);
	echo "</p>";

	echo "<p>";
	echo form_label('Tag Color', 'tag_color');
	echo "<br />";
	echo "#" . form_input($tag_color);
	echo " &nbsp&nbsp";
	echo "<span id=\"preview_tag_color\" style=\"padding:3px 20px 3px 20px;\"></span>";
	echo "</p>";

	echo "<p>";
	echo form_label('Background Color', 'tag_background');
	echo "<br />";
	echo "#" . form_input($tag_background);
	echo " &nbsp&nbsp";
	echo "<span id=\"preview_tag_background\" style=\"padding:3px 20px 3px 20px;\"></span>";
	echo "</p>";

	echo "<p>";
	echo form_hidden('tag_id', $tag_id);
	echo form_submit('submit', 'Update');
	echo " ";
	echo anchor('tag', 'Back', 'Back to Tags');
	echo "</p>";

	echo form_close();

