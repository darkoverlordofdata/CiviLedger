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

	/* Add row ledger type */
	if ($current_entry_type['bank_cash_ledger_restriction'] == '4')
		$add_type = "bankcash";
	else if ($current_entry_type['bank_cash_ledger_restriction'] == '5')
		$add_type = "nobankcash";
	else
		$add_type = "all";
?>
<script type="text/javascript">
cj(document).ready(function() {

    /* javascript floating point operations */
    var jsFloatOps = function(param1, param2, op) {
        param1 = param1 * 100;
        param2 = param2 * 100;
        param1 = param1.toFixed(0);
        param2 = param2.toFixed(0);
        param1 = Math.floor(param1);
        param2 = Math.floor(param2);
        var result = 0;
        if (op == '+') {
            result = param1 + param2;
            result = result/100;
            return result;
        }
        if (op == '-') {
            result = param1 - param2;
            result = result/100;
            return result;
        }
        if (op == '!=') {
            if (param1 != param2)
                return true;
            else
                return false;
        }
        if (op == '==') {
            if (param1 == param2)
                return true;
            else
                return false;
        }
        if (op == '>') {
            if (param1 > param2)
                return true;
            else
                return false;
        }
        if (op == '<') {
            if (param1 < param2)
                return true;
            else
                return false;
        }
    }

    cj( "#entry_date" ).datepicker();

    /* Calculating Dr and Cr total */
    cj('.dr-item').live('change', function() {
        var drTotal = 0;
        cj("table tr .dr-item").each(function() {
            var curDr = cj(this).attr('value');
            curDr = parseFloat(curDr);
            if (isNaN(curDr))
                curDr = 0;
            drTotal = jsFloatOps(drTotal, curDr, '+');
        });
        cj("table tr #dr-total").text(drTotal);
        var crTotal = 0;
        cj("table tr .cr-item").each(function() {
            var curCr = cj(this).attr('value');
            curCr = parseFloat(curCr);
            if (isNaN(curCr))
                curCr = 0;
            crTotal = jsFloatOps(crTotal, curCr, '+');
        });
        cj("table tr #cr-total").text(crTotal);

        if (jsFloatOps(drTotal, crTotal, '==')) {
            cj("table tr #dr-total").css("background-color", "#FFFF99");
            cj("table tr #cr-total").css("background-color", "#FFFF99");
            cj("table tr #dr-diff").text("-");
            cj("table tr #cr-diff").text("");
        } else {
            cj("table tr #dr-total").css("background-color", "#FFE9E8");
            cj("table tr #cr-total").css("background-color", "#FFE9E8");
            if (jsFloatOps(drTotal, crTotal, '>')) {
                cj("table tr #dr-diff").text("");
                cj("table tr #cr-diff").text(jsFloatOps(drTotal, crTotal, '-'));
            } else {
                cj("table tr #dr-diff").text(jsFloatOps(crTotal, drTotal, '-'));
                cj("table tr #cr-diff").text("");
            }
        }
    });

    cj('.cr-item').live('change', function() {
        var drTotal = 0;
        cj("table tr .dr-item").each(function() {
            var curDr = cj(this).attr('value')
            curDr = parseFloat(curDr);
            if (isNaN(curDr))
                curDr = 0;
            drTotal = jsFloatOps(drTotal, curDr, '+');
        });
        cj("table tr #dr-total").text(drTotal);
        var crTotal = 0;
        cj("table tr .cr-item").each(function() {
            var curCr = cj(this).attr('value')
            curCr = parseFloat(curCr);
            if (isNaN(curCr))
                curCr = 0;
            crTotal = jsFloatOps(crTotal, curCr, '+');
        });
        cj("table tr #cr-total").text(crTotal);

        if (jsFloatOps(drTotal, crTotal, '==')) {
            cj("table tr #dr-total").css("background-color", "#FFFF99");
            cj("table tr #cr-total").css("background-color", "#FFFF99");
            cj("table tr #dr-diff").text("-");
            cj("table tr #cr-diff").text("");
        } else {
            cj("table tr #dr-total").css("background-color", "#FFE9E8");
            cj("table tr #cr-total").css("background-color", "#FFE9E8");
            if (jsFloatOps(drTotal, crTotal, '>')) {
                cj("table tr #dr-diff").text("");
                cj("table tr #cr-diff").text(jsFloatOps(drTotal, crTotal, '-'));
            } else {
                cj("table tr #dr-diff").text(jsFloatOps(crTotal, drTotal, '-'));
                cj("table tr #cr-diff").text("");
            }
        }
    });

    /* Dr - Cr dropdown changed */
    cj('.dc-dropdown').live('change', function() {
        var drValue = cj(this).parent().next().next().children().attr('value');
        var crValue = cj(this).parent().next().next().next().children().attr('value');

        if (cj(this).parent().next().children().val() == "0") {
            return;
        }

        drValue = parseFloat(drValue);
        if (isNaN(drValue))
            drValue = 0;

        crValue = parseFloat(crValue);
        if (isNaN(crValue))
            crValue = 0;

        if (cj(this).attr('value') == "D") {
            if (drValue == 0 && crValue != 0) {
                cj(this).parent().next().next().children().attr('value', crValue);
            }
            cj(this).parent().next().next().next().children().attr('value', "");
            cj(this).parent().next().next().next().children().attr('disabled', 'disabled');
            cj(this).parent().next().next().children().attr('disabled', '');
        } else {
            if (crValue == 0 && drValue != 0) {
                cj(this).parent().next().next().next().children().attr('value', drValue);
            }
            cj(this).parent().next().next().children().attr('value', "");
            cj(this).parent().next().next().children().attr('disabled', 'disabled');
            cj(this).parent().next().next().next().children().attr('disabled', '');
        }
        /* Recalculate Total */
        cj('.dr-item:first').trigger('change');
        cj('.cr-item:first').trigger('change');
    });

    /* Ledger dropdown changed */
    cj('.ledger-dropdown').live('change', function() {
        if (cj(this).val() == "0") {
            cj(this).parent().next().children().attr('value', "");
            cj(this).parent().next().next().children().attr('value', "");
            cj(this).parent().next().children().attr('disabled', 'disabled');
            cj(this).parent().next().next().children().attr('disabled', 'disabled');
        } else {
            cj(this).parent().next().children().attr('disabled', '');
            cj(this).parent().next().next().children().attr('disabled', '');
            cj(this).parent().prev().children().trigger('change');
        }
        cj(this).parent().next().children().trigger('change');
        cj(this).parent().next().next().children().trigger('change');

        var ledgerid = cj(this).val();
        var rowid = cj(this);
        if (ledgerid > 0) {
            cj.ajax({
                url: <?php echo '\'' . site_url('ledger/balance') . '/\''; ?> + ledgerid,
                success: function(data) {
                    var ledger_bal = parseFloat(data);
                    if (isNaN(ledger_bal))
                        ledger_bal = 0;
                    if (jsFloatOps(ledger_bal, 0, '=='))
                        rowid.parent().next().next().next().next().next().children().text("0");
                    else if (jsFloatOps(ledger_bal, 0, '<'))
                        rowid.parent().next().next().next().next().next().children().text("Cr " + -data);
                    else
                        rowid.parent().next().next().next().next().next().children().text("Dr " + data);
                }
            });
        } else {
            rowid.parent().next().next().next().next().next().children().text("");
        }
    });

    /* Recalculate Total */
    cj('table td .recalculate').live('click', function() {
        /* Recalculate Total */
        cj('.dr-item:first').trigger('change');
        cj('.cr-item:first').trigger('change');
    });

    /* Delete ledger row */
    cj('table td .deleterow').live('click', function() {
        cj(this).parent().parent().remove();
        /* Recalculate Total */
        cj('.dr-item:first').trigger('change');
        cj('.cr-item:first').trigger('change');
    });

    /* Add ledger row */
    cj('table td .addrow').live('click', function() {
        var cur_obj = this;
        var add_image_url = cj(cur_obj).attr('src');
        cj(cur_obj).attr('src', <?php echo '\'' . asset_url() . 'images/icons/ajax.gif' . '\''; ?>);
        cj.ajax({
            url: <?php echo '\'' . site_url('entry/addrow/' . $add_type) . '\''; ?>,
            success: function(data) {
                cj(cur_obj).parent().parent().after(data);
                cj(cur_obj).attr('src', add_image_url);
            }
        });
    });

    /* On page load initiate all triggers */
    cj('.dc-dropdown').trigger('change');
    cj('.ledger-dropdown').trigger('change');
    cj('.dr-item:first').trigger('change');
    cj('.cr-item:first').trigger('change');
});
</script>
<style type="text/css">
#main-content textarea {
    font-size: .9em;
}    
</style>
<?php
	echo form_open('entry/edit/' . $current_entry_type['label'] . "/" . $entry_id);
    
    echo "<p>";
    echo "<table><tr><td>";
    echo "<span id=\"tooltip-target-1\">";
    echo form_label('Entry Number', 'entry_number');
    echo " ";
    echo $current_entry_type['prefix'] . form_input($entry_number) . $current_entry_type['suffix'];
    echo "</span></td>";
    echo "<span id=\"tooltip-content-1\">Leave Entry Number empty for auto numbering</span>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<td><span id=\"tooltip-target-2\">";
    echo form_label('Entry Date', 'entry_date');
    echo " ";
    echo form_input_date_restrict($entry_date);
    echo "</span></td>";
    echo "<span id=\"tooltip-content-2\">Date format is " . $this->config->item('account_date_format') . ".</span>";

    echo "<td width=\"25%\"></td><td align=\"right\">";
    echo form_label('Posting Period: ', 'posting_period');
    echo "<b>".$fiscal_period . "</b> / <b>" . $fiscal_year . "</b>";
    echo "</td></tr></table>";
    echo "</p>";

	echo "<table class=\"entry-table\">";
	echo "<thead><tr><th>Type</th><th>Ledger Account</th><th>Dr Amount</th><th>Cr Amount</th><th colspan=2>Actions</th><th colspan=2>Cur Balance</th></tr></thead>";

	foreach ($ledger_dc as $i => $ledger)
	{
		$dr_amount_item = array(
			'name' => 'dr_amount[' . $i . ']',
			'id' => 'dr_amount[' . $i . ']',
			'maxlength' => '15',
			'size' => '15',
			'value' => isset($dr_amount[$i]) ? $dr_amount[$i] : "",
			'class' => 'dr-item',
		);
		$cr_amount_item = array(
			'name' => 'cr_amount[' . $i . ']',
			'id' => 'cr_amount[' . $i . ']',
			'maxlength' => '15',
			'size' => '15',
			'value' => isset($cr_amount[$i]) ? $cr_amount[$i] : "",
			'class' => 'cr-item',
		);
		echo "<tr>";

		echo "<td>" . form_dropdown_dc('ledger_dc[' . $i . ']', isset($ledger_dc[$i]) ? $ledger_dc[$i] : "D") . "</td>";

		if ($current_entry_type['bank_cash_ledger_restriction'] == '4')
			echo "<td>" . form_input_ledger('ledger_id[' . $i . ']', isset($ledger_id[$i]) ? $ledger_id[$i] : 0, '', $type = 'bankcash') . "</td>";
		else if ($current_entry_type['bank_cash_ledger_restriction'] == '5')
			echo "<td>" . form_input_ledger('ledger_id[' . $i . ']', isset($ledger_id[$i]) ? $ledger_id[$i] : 0, '', $type = 'nobankcash') . "</td>";
		else
			echo "<td>" . form_input_ledger('ledger_id[' . $i . ']', isset($ledger_id[$i]) ? $ledger_id[$i] : 0) . "</td>";

		echo "<td>" . form_input($dr_amount_item) . "</td>";
		echo "<td>" . form_input($cr_amount_item) . "</td>";

		echo "<td>" . img(array('src' => asset_url() . "images/icons/add.png", 'border' => '0', 'alt' => 'Add Ledger', 'class' => 'addrow')) . "</td>";
		echo "<td>" . img(array('src' => asset_url() . "images/icons/delete.png", 'border' => '0', 'alt' => 'Remove Ledger', 'class' => 'deleterow')) . "</td>";

		echo "<td class=\"ledger-balance\"><div></div></td>";

		echo "</tr>";
	}

	echo "<tr><td colspan=7></td></tr>";
	echo "<tr id=\"total\"><td colspan=2><strong>Total</strong></td><td id=\"dr-total\">0</td><td id=\"cr-total\">0</td><td>" . img(array('src' => asset_url() . "images/icons/gear.png", 'border' => '0', 'alt' => 'Recalculate Total', 'class' => 'recalculate', 'title' => 'Recalculate Total')) . "</td><td></td><td></td></tr>";
	echo "<tr id=\"difference\"><td colspan=2><strong>Difference</strong></td><td id=\"dr-diff\"></td><td id=\"cr-diff\"></td><td></td><td></td><td></td></tr>";

	echo "</table>";

	echo "<p>";
	echo form_label('Narration', 'entry_narration');
	echo "<br />";
    //$entry_narration = array('name' => 'Narraration', 'style' => 'font-size: 0.9em', 'cols' => '50', 'rows' => '4');
	echo form_textarea($entry_narration);
	echo "</p>";

	echo "<p>";
	echo form_label('Tag', 'entry_tag');
	echo " ";
	echo form_dropdown('entry_tag', $entry_tags, $entry_tag);
	echo "</p>";

	echo form_hidden('has_reconciliation', $has_reconciliation);

	echo "<p>";
	echo form_submit('submit', 'Update');
	echo " ";
	echo anchor('entry/edit/' . $current_entry_type['label'] . "/" . $entry_id, 'Reload', array('title' => 'Reload ' . $current_entry_type['name'] . ' Entry Original Data'));
	echo " | ";
	echo anchor('entry/show/' . $current_entry_type['label'], 'Back', array('title' => 'Back to ' . $current_entry_type['name'] . ' Entries'));
	echo "</p>";

	echo form_close();

