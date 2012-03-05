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

class Account extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
    }
    
	function index()
	{
		$this->load->model('Ledger_model');
		$this->template->set('page_title', 'Chart Of Accounts');
		$this->template->set('nav_links', array('group/add' => 'Add Group', 'ledger/add' => 'Add Ledger'));

		/* Calculating difference in Opening Balance */
		$total_op = $this->Ledger_model->get_diff_op_balance();
		if ($total_op > 0)
		{
			$this->messages->add('Difference in Opening Balance is Dr ' . convert_cur($total_op) . '.', 'error');
		} else if ($total_op < 0) {
			$this->messages->add('Difference in Opening Balance is Cr ' . convert_cur(-$total_op) . '.', 'error');
		}

		$this->template->load('template', 'account/index');
	}
}

/* End of file account.php */
/* Location: ./system/application/controllers/account.php */
