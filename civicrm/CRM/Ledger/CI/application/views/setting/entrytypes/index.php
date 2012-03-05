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
?><table border=0 cellpadding=5 class="simple-table">
	<thead>
		<tr>
			<th>Label</th>
			<th>Name</th>
			<th>Description</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php
		foreach ($entry_type_data->result() as $row)
		{
			echo "<tr>";

			echo "<td>" . $row->label . "</td>";
			echo "<td>" . $row->name . "</td>";
			echo "<td>" . $row->description . "</td>";
			echo "<td>" . anchor('setting/entrytypes/edit/' . $row->id , "Edit", array('title' => 'Edit ' . $row->name . ' Entry Type', 'class' => 'red-link')) . " ";
			echo " &nbsp;" . anchor('setting/entrytypes/delete/' . $row->id , img(array('src' => asset_url() . "images/icons/delete.png", 'border' => '0', 'alt' => 'Delete ' . $row->name . ' Entry Type', 'class' => "confirmClick", 'title' => "Delete Entry Type")), array('title' => 'Delete ' . $row->name . ' Entry Type')) . " ";
			echo "</tr>";
		}
	?>
	</tbody>
</table>
<p>
<?php
echo anchor('setting', 'Back', array('title' => 'Back to Settings'));
?></p>
