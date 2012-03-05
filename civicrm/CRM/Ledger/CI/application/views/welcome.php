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
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?><div id="dashboard-summary">
	<div id="dashboard-welcome-back" class="dashboard-item">
		<div class="dashboard-title"><?php echo anchor('setting', 'Account Details'); ?>
		</div>
		<div class="dashboard-content">
			<table class="dashboard-summary-table">
				<tbody>
					<tr>
						<td><div>Name: <strong><?php echo $this->config->item('account_name'); ?></strong></div></td>
					</tr>
					<tr>
						<td><div>Financial Year: <strong><?php echo date_mysql_to_php_display($this->config->item('fy_start')) . " - " . date_mysql_to_php_display($this->config->item('fy_end')); ?></strong></div></td>
					</tr>
					<?php if ($this->config->item('account_locked') == 1) { ?>
						<tr>
							<td><div>Account is currently <strong>locked</strong> to prevent any further modifications.</div></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div> <div id="dashboard-summary" class="dashboard-item">
        <div class="dashboard-title"><?php echo anchor('account', 'Account Summary'); ?></div>
        <div class="dashboard-content">
            <?php
                echo "<table class=\"dashboard-summary-table\">";
                echo "<tbody>";
                echo "<tr><td>Assets Total</td><td align=\"right\">" . convert_amount_dc($asset_total) . "</td></tr>";
                echo "<tr><td>Liabilities Total</td><td align=\"right\">" . convert_amount_dc($liability_total) . "</td></tr>";
                echo "<tr><td>Incomes Total</td><td align=\"right\">" . convert_amount_dc($income_total) . "</td></tr>";
                echo "<tr><td>Expenses Total</td><td align=\"right\">" . convert_amount_dc($expense_total) . "</td></tr>";
                echo "</tbody>";
                echo "</table>";
            ?>
        </div>
    </div>

</div>
<?php if (check_access('view log')) { ?>
	<div id="dashboard-log">
		<div id="dashboard-recent-log" class="dashboard-log-item">
			<div class="dashboard-log-title"><?php echo anchor('log', 'Recent Activity'); ?></div>
			<div class="dashboard-log-content">
				<?php
				if ($logs)
				{
					echo "<ul id=\"recent-activity-list\">";
					foreach ($logs->result() as $row)
					{
						echo "<li>" . $row->message_title . "</li>";
					}
					echo "</ul>";
				} else {
					echo "No Recent Activity";
				}
				?>
			</div>
		</div>
	</div>
<?php } ?>
<div class="clear"></div>
