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
				<?php echo anchor('setting/account', 'Account Settings', array('title' => 'Account Settings')); ?>
			</div>
			<div class="settings-desc">
				Setup account details, currency, time, etc.
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo anchor('setting/cf', 'C / F Account', array('title' => 'Carry Forward Account')); ?>
			</div>
			<div class="settings-desc">
				Carry forward account to next year
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo anchor('setting/email', 'Email Settings', array('title' => 'Email Settings')); ?>
			</div>
			<div class="settings-desc">
				Setup outgoing email
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo anchor('setting/printer', 'Printer Settings', array('title' => 'Printer Settings')); ?>
			</div>
			<div class="settings-desc">
				Setup printing options for entries, reports, etc.
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo anchor('setting/backup', 'Download Backup', array('title' => 'Download Backup')); ?>
			</div>
			<div class="settings-desc">
				Download backup of current accounts data
			</div>
		</div>
	</div>
	<div id="right-col">
		<div class="settings-container">
			<div class="settings-title">
				<?php echo anchor('tag', 'Tags', array('title' => 'Tags')); ?>
			</div>
			<div class="settings-desc">
				Manage Entry Tags
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo anchor('setting/entrytypes', 'Entry Types', array('title' => 'Entry Types')); ?>
			</div>
			<div class="settings-desc">
				Manage Entry Types
			</div>
		</div>
	</div>
</div>
<div class="clear">
</div>
