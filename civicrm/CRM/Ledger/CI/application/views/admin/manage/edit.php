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
?><script type="text/javascript">
cj(function() {
    
    var toggle = function() {
      
        if (this.checked) {
            cj("input.database_usecms").attr("disabled", true);
        }
        else {
            cj("input.database_usecms").removeAttr("disabled");
        }
    };
    
    cj("#database_usecms").click(toggle);
    toggle.call(cj("#database_usecms").get(0));
    
    
});
</script><?php
	echo form_open('admin/manage/edit/' . $database_label);

	echo "<p>";
	echo "Account";
	echo "<br />";
	echo "<strong>".$database_label."<strong>";
	echo "</p>";

    echo "<p>";
    echo form_label('Database Prefix', 'database_prefix');
    echo "<br />";
    echo form_input($database_prefix);
    echo "</p>";

    echo "<p>";
    echo form_checkbox($database_usecms) . " Use CMS?";
    echo "</p>";

	echo "<p>";
	echo form_label('Database Name', 'database_name');
	echo "<br />";
	echo form_input($database_name);
	echo "</p>";

	echo "<p>";
	echo form_label('Database Username', 'database_username');
	echo "<br />";
	echo form_input($database_username);
	echo "</p>";

	echo "<p>";
	echo form_label('Database Password', 'database_password');
	echo "<br />";
	echo form_password($database_password);
	echo "</p>";

	echo "<p>";
	echo form_label('Database Host', 'database_host');
	echo "<br />";
	echo form_input($database_host);
	echo "</p>";

	echo "<p>";
	echo form_label('Database Port', 'database_port');
	echo "<br />";
	echo form_input($database_port);
	echo "</p>";

	echo "<p>";
	echo form_submit('submit', 'Update');
	echo " ";
	echo anchor('admin/manage', 'Back', array('title' => 'Back to active account list'));
	echo "</p>";

	echo form_close();
