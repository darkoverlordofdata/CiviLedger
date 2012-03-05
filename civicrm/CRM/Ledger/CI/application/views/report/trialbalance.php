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

	$temp_dr_total = 0;
	$temp_cr_total = 0;

	echo "<table border=0 cellpadding=5 class=\"simple-table trial-balance-table\">";
	echo "<thead><tr><th>Ledger Account</th><th>O/P Balance</th><th>C/L Balance</th><th>Dr Total</th><th>Cr Total</th></tr></thead>";
	$this->load->model('Ledger_model');
	$all_ledgers = $this->Ledger_model->get_all_ledgers();
	$odd_even = "odd";
	foreach ($all_ledgers as $ledger_id => $ledger_name)
	{
		if ($ledger_id == 0) continue;
		echo "<tr class=\"tr-" . $odd_even . "\">";

		echo "<td>";
		echo  anchor('report/ledgerst/' . $ledger_id, $ledger_name, array('title' => $ledger_name . ' Ledger Statement', 'class' => 'anchor-link-a'));
		echo "</td>";

		echo "<td align=\"right\">";
		list ($opbal_amount, $opbal_type) = $this->Ledger_model->get_op_balance($ledger_id);
		echo convert_opening($opbal_amount, $opbal_type);
		echo "</td>";

		echo "<td align=\"right\">";
		$clbal_amount = $this->Ledger_model->get_ledger_balance($ledger_id);
		echo convert_amount_dc($clbal_amount);
		echo "</td>";

		echo "<td align=\"right\">";
		$dr_total = $this->Ledger_model->get_dr_total($ledger_id);
		if ($dr_total)
		{
			echo $dr_total;
			$temp_dr_total = float_ops($temp_dr_total, $dr_total, '+');
		} else {
			echo "0";
		}
		echo "</td>";
		echo "<td align=\"right\">";
		$cr_total = $this->Ledger_model->get_cr_total($ledger_id);
		if ($cr_total)
		{
			echo $cr_total;
			$temp_cr_total = float_ops($temp_cr_total, $cr_total, '+');
		} else {
			echo "0";
		}
		echo "</td>";
		echo "</tr>";
		$odd_even = ($odd_even == "odd") ? "even" : "odd";
	}
	echo "<tr class=\"tr-total\"><td colspan=3>TOTAL ";
	if (float_ops($temp_dr_total, $temp_cr_total, '=='))
		echo "<img src=\"" . asset_url() . "images/icons/match.png\"></td>";
	else
		echo "<img src=\"" . asset_url() . "images/icons/nomatch.png\"></td>";
	echo "<td align=\"right\">Dr " . convert_cur($temp_dr_total) . "</td>";
	echo "<td align=\"right\">Cr " . convert_cur($temp_cr_total) . "</td></tr>";
	echo "</table>";
    echo '<p />';
    echo anchor('report', 'Back', array('title' => 'Back to Reports'));

