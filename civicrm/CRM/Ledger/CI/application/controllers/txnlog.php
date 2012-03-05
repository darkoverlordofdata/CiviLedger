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
?><?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TxnLog extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

	function index()
	{
		$this->load->helper('text');
		$this->template->set('page_title', 'Logs');
		$this->template->set('nav_links', array('log/clear' => 'Clear Log'));
		$this->template->load('template', 'log/index');

		/* Check access */
		if ( ! check_access('view log'))
		{
			$this->messages->add('Permission denied.', 'error');
			redirect('');
			return;
		}
		return;
	}

	function clear()
	{
		/* Check access */
		if ( ! check_access('clear log'))
		{
			$this->messages->add('Permission denied.', 'error');
			redirect('log');
			return;
		}

		/* Check for account lock */
		if ($this->config->item('account_locked') == 1)
		{
			$this->messages->add('Account is locked.', 'error');
			redirect('log');
			return;
		}

		if ($this->db->truncate('logs'))
		{
			$this->messages->add('Log cleared.', 'success');
			redirect('log');
		} else {
			$this->messages->add('Error clearing Log.', 'error');
			redirect('log');
		}
		return;
	}
}

/* End of file log.php */
/* Location: ./system/application/controllers/log.php */
