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

    echo form_open('ledger/add');

    echo "<table>";

    echo "<tr><th width=\"25%\"  style=\"font-size:100%\">";
    echo form_label('Ledger id', 'ledger_id');
    echo "</th><th style=\"font-size:100%\">";
    echo form_input($ledger_id);
    echo "</th></tr>";

    echo "<tr><td>";
    echo form_label('Ledger name', 'ledger_name');
    echo "</td><td>";
    echo form_input($ledger_name);
    echo "</td></tr>";

    echo "<tr><td>";
    echo form_label('Parent group', 'ledger_group_id');
    echo "</td><td>";
    echo form_dropdown('ledger_group_id', $ledger_group_id, $ledger_group_active);
    echo "</td></tr>";

    echo "<tr><td>";
    echo form_label('Opening balance', 'op_balance');
    echo "</td><td>";
    echo "<span id=\"tooltip-target-1\">";
    echo form_dropdown_dc('op_balance_dc', $op_balance_dc);
    echo " ";
    echo form_input($op_balance);
    echo "</span>";
    echo "<span id=\"tooltip-content-1\">&nbsp;&nbsp;Assets / Expenses => Dr. Balance<br />Liabilities / Incomes => Cr. Balance</span>";
    echo "</td></tr>";

    echo "<tr><td>";
    echo "Bank or Cash Account";
    echo "</td><td>";
    echo "<span id=\"tooltip-target-2\">";
    echo form_checkbox('ledger_type_cashbank', 1, $ledger_type_cashbank);
    echo "</span>";
    echo "<span id=\"tooltip-content-2\">Select if Ledger account is a Bank account or a Cash account.</span>";
    echo "</td></tr>";

    echo "<tr><td>";
    echo "Reconciliation";
    echo "</td><td>";
    echo "<span id=\"tooltip-target-3\">";
    echo form_checkbox('reconciliation', 1, $reconciliation);
    echo "</span>";
    echo "<span id=\"tooltip-content-3\">If enabled account can be reconciled from Reports > Reconciliation</span>";
    echo "</td></tr>";

    echo "<tr><td>";
    echo form_label('Form 990 Line item', 'form990');
    echo "</td><td>";
    echo form_input($form990);
    echo "</td></tr>";

    echo "<tr><td>";
    echo form_label('Form 990EZ Line item', 'form990ez');
    echo "</td><td>";
    echo form_input($form990ez);
    echo "</td></tr>";

    echo "<tr><td>";
    echo form_label('OMB Cost Principle', 'omba122');
    echo "</td><td>";
    echo form_input($omba122);
    echo "</td></tr>";
    echo "</table>";

    echo "<p>";
    echo form_submit('submit', 'Create');
    echo " ";
    echo anchor('account', 'Back', 'Back to Chart of Accounts');
    echo "<p />";

    echo form_close();

