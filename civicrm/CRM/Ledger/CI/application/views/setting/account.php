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
?><style type="text/css">
#main-content textarea {
    font-size: .9em;
}    
</style>

<script type='text/javascript'>
cj(function() {
    cj( "#fy_start" ).datepicker();
    cj( "#fy_end" ).datepicker();
});
    
</script>

<?php
    echo form_open('setting/account');

    echo '<div id="left-col">';

	echo "<p>";
	echo form_label('Account Name', 'account_name');
	echo "<br />";
	echo form_input($account_name);
	echo "</p>";

	echo "<p>";
	echo form_label('Account Address', 'account_address');
	echo "<br />";
	echo form_textarea($account_address);
	echo "</p>";

	echo "<p>";
	echo form_label('Account Email', 'account_email');
	echo "<br />";
	echo form_input($account_email);
	echo "</p>";


    echo "<p>";
    echo "<span id=\"tooltip-target-1\">";
    echo form_checkbox('account_locked', 1, $account_locked) . " Account Locked";
    echo "</span>";
    echo "<span id=\"tooltip-content-1\">If enabled prevents any further modifications to the account. Makes the account read-only.</span>";
    echo "</p>";

    echo "<p>";
    echo form_submit('submit', 'Update');
    echo " ";
    echo anchor('setting', 'Back', 'Back to Settings');
    echo "</p>";


    echo '</div>';
    echo '<div id="right-col">';

	echo "<p>";
	echo form_label('Currency', 'account_currency');
	echo "<br />";
	echo form_input($account_currency);
	echo "</p>";

	echo "<p>";
	echo form_label('Date Format', 'account_date');
	echo "<br />";
	echo form_dropdown('account_date', $account_date_options, $account_date);
	echo "</p>";

	echo "<p>";
	echo form_label('Account Start Date', 'fy_start');
	echo "<br />";
    echo form_input_date($fy_start);
	echo "</p>";

	echo "<p>";
	echo form_label('Account End Date', 'fy_end');
	echo "<br />";
    echo form_input_date($fy_end);
	echo "</p>";

	echo "<p>";
	echo form_label('Timezone');
	echo "<br />";
	echo timezone_menu($account_timezone);
	echo "</p>";

    echo '</div>';

	echo form_close();

