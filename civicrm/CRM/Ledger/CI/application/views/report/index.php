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
?><div>
	<div id="left-col">
		<div class="settings-container">
			<div class="settings-title">
				<?php echo anchor('report/balancesheet', 'Balance Sheet', array('title' => 'Balance Sheet')); ?>
			</div>
			<div class="settings-desc">
				Statement of Financial Position 
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo anchor('report/profitandloss', 'Profit and Loss Statement', array('title' => 'Profit and Loss Statement')); ?>
			</div>
			<div class="settings-desc">
                Statement of Financial Activities 
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo anchor('report/trialbalance', 'Trial Balance', array('title' => 'Trial Balance')); ?>
			</div>
			<div class="settings-desc">
				Current credit and debit balances for all ledger accounts
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo anchor('report/ledgerst', 'Ledger Statement', array('title' => 'Ledger Statement')); ?>
			</div>
			<div class="settings-desc">
				Detail debit and credit entries to each ledger account
			</div>
		</div>
        <div class="settings-container">
            <div class="settings-title">
                <?php echo anchor('report/reconciliation/pending', 'Reconciliation', array('title' => 'Reconciliation')); ?>
            </div>
            <div class="settings-desc">
                Verify account activities
            </div>
        </div>
	</div>
	<div id="right-col">

	</div>
</div>
<div class="clear">
</div>
