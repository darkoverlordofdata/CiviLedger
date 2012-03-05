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

echo "<div class=\"tag-title\">Tags<span class=\"float-right\">" . anchor("tag", "Edit") . "</span></div>";
	echo "<div class=\"tag-content\">";
	$tags = $this->Tag_model->get_all_tags($allow_none = FALSE);
	echo "<ul id=\"tag-list\">";
	if ($tags)
	{
		foreach ($tags as $id => $title)
		{

			echo "<li>" . $this->Tag_model->show_entry_tag_link($id) . "</li>";
		}
	} else {
		echo "<li>No tags defined</li>";
		echo "<li>" . anchor("tag/add", "Add one", array('title' => 'Add tag', 'class' => 'anchor-link-a')) . "</li>";
	}
	echo "</ul>";
	echo "</div>";
