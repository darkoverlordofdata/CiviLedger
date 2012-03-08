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
    /* Show and Hide affects_gross */
    cj('.group-parent').change(function() {
//      if (cj(this).val() == "3" || cj(this).val() == "4") {
        if (cj(this).val() > "2"  {
            cj('.affects-gross').show();
        } else {
            cj('.affects-gross').hide();
        }
    });
    cj('.group-parent').trigger('change');
});
</script>
<?php
    echo form_open('group/add');

    echo "<table>";

    echo "<tr><th width=\"25%\"  style=\"font-size:100%\">";
    echo form_label('Ledger id', 'ledger_id');
    echo "</th><th style=\"font-size:100%\">";
    echo form_input($group_id);
    echo "</th></tr>";

    echo "<tr><td>";
    echo form_label('Group name', 'group_name');
    echo "</td><td>";
    echo form_input($group_name);
    echo "</th></tr>";

    echo "<tr><td>";
    echo form_label('Parent group', 'group_parent');
    echo "</td><td>";
    echo form_dropdown('group_parent', $group_parent, $group_parent_active, "class = \"group-parent\"");
    echo "</th></tr>";

    echo "<tr><td>";
    echo " Affects Gross Profit/Loss Calculations";
    echo "</td><td class=\"affects-gross\">";
    echo "<span id=\"tooltip-target-1\">";
    echo form_checkbox('affects_gross', 1, $affects_gross);
    echo "</span>";
    echo "<span id=\"tooltip-content-1\">If selected the Group account will affect Gross Profit and Loss calculations, otherwise it will affect only Net Profit and Loss calculations.</span>";
    echo "</th></tr>";
    echo "</table>";

    echo "<p>";
    echo form_submit('submit', 'Create');
    echo " ";
    echo anchor('account', 'Back', 'Back to Chart of Accounts');
    echo "</p>";

    echo form_close();
