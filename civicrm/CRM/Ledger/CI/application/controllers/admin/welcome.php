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

class Welcome extends CI_Controller {

    function __construct()
    {
        parent::__construct();

		/* Check access */
		if ( ! check_access('administer'))
		{
			$this->messages->add('Permission denied.', 'error');
			redirect('');
			return;
		}

		return;
	}
	
	function index()
	{
		$this->template->set('page_title', 'Administer Webzash');

		/* Check status report */
		$this->load->library('statuscheck');
		$statuscheck = new Statuscheck(); 
		$statuscheck->check_permissions();
		if (count($statuscheck->error_messages) > 0)
		{
			$this->messages->add('One or more problems were detected with your installation. Check the ' . anchor('admin/status', 'Status report', array('title' => 'Check Status report', 'class' => 'anchor-link-a')) . ' for more information.', 'error');
		}

//		$this->template->load('admin_template', 'admin/welcome');
        $this->template->load('admin_template', 'admin/welcome');
		return;
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/admin/welcome.php */
