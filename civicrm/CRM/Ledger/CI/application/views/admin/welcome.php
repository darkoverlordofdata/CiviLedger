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
				<?php echo anchor('admin/create', 'Create Account', array('title' => 'Create a new account')); ?>
			</div>
			<div class="settings-desc">
				Create a new account
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo anchor('admin/manage', 'Manage Accounts', array('title' => 'Manage existing accounts')); ?>
			</div>
			<div class="settings-desc">
				Manage existing accounts
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo anchor('admin/user', 'Manage Users', array('title' => 'Manage users')); ?>
			</div>
			<div class="settings-desc">
				Manage users and permissions
			</div>
		</div>
        <div class="settings-container">
            <div class="settings-title">
                <?php echo anchor('admin/calendar', 'Fiscal Calendar', array('title' => 'Calendar')); ?>
            </div>
            <div class="settings-desc">
                Open and close periods
            </div>
        </div>
	</div>
	<div id="right-col">
		<div class="settings-container">
			<div class="settings-title">
				<?php echo anchor('admin/setting', 'General Settings', array('title' => 'General Application Settings')); ?>
			</div>
			<div class="settings-desc">
				General application settings
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo anchor('admin/status', 'Status Report', array('title' => 'Status Report')); ?>
			</div>
			<div class="settings-desc">
				Status report of the application
			</div>
		</div>
	</div>
</div>
<div class="clear">
</div>
