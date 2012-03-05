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

class Setting extends CI_Controller {

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
		$this->template->set('page_title', 'General Settings');

        $ini_file = $this->config->item('config_path') . "settings/general.ini";

		/* Default settings */
		$data['row_count'] = 20;

		$data['log'] = array(
            'name' => 'log',
            'id' => 'log',
            'value' => '1',
            'checked' => set_checkbox('log', '1', TRUE),
		);
        
        $data['userlogin'] = array(
            'name' => 'userlogin',
            'id' => 'userlogin',
            'value' => 'CMS',
            'checked' => set_checkbox('userlogin', 'CMS', TRUE),
        );

		/* Form fields */
		$data['row_count_options'] = array(
			'10' => 10,
			'20' => 20,
			'50' => 50,
			'100' => 100,
			'200' => 200,
		);

        /* Repopulating form */
        if ($_POST) {
            $data['row_count'] = $this->input->post('row_count', TRUE);
            $data['log']['checked'] = $this->input->post('log', TRUE);
            $data['userlogin']['checked'] = $this->input->post('userlogin', TRUE);
        } 
        else {
            /* Check if user ini file exists */
            if (get_file_info($ini_file)) {
                /* Parsing database ini file */
                $cur_setting = parse_ini_file($ini_file);
                if ($cur_setting) {
                    
                    /* Check if all needed variables are set in ini file */
                    if (isset($cur_setting['row_count']))
                        $data['row_count'] = $cur_setting['row_count'];
                    else
                        $this->messages->add('Row count missing from settings file.', 'error');

                    if (isset($cur_setting['log']))
                        $data['log']['checked'] = $cur_setting['log'];
                    else
                        $this->messages->add('Logging flag missing from settings file.', 'error');

                    if (isset($cur_setting['userlogin']))
                        $data['userlogin']['checked'] = $cur_setting['userlogin'] == "CMS";
                    else
                        $this->messages->add('Authentication type missing from settings file.', 'error');
                }
            } 
        }

		/* Form validations */
		$this->form_validation->set_rules('row_count', 'Row Count', 'trim');
		$this->form_validation->set_rules('log', 'Log Messages', 'trim');
        $this->form_validation->set_rules('userlogin', 'Authentication type', 'trim');

		/* Validating form */
		if ($this->form_validation->run() == FALSE)
		{
			$this->messages->add(validation_errors(), 'error');
			$this->template->load('admin_template', 'admin/setting', $data);
			return;
		}
		else
		{
			$data_row_count = $this->input->post('row_count', TRUE);
			$data_log = $this->input->post('log', TRUE);
            $data_log = ($data_log == '') ? '0' : $data_log;
            $data_userlogin = $this->input->post('userlogin', TRUE);
            $data_userlogin = ($data_userlogin == '') ? 'CodeIgniter' : $data_userlogin;

            $new_setting['general'] = array(
                'row_count' => $data_row_count,
                'log' => $data_log,
                'userlogin' => $data_userlogin
            );
			$new_setting_html = '[general]<br />row_count = "' . $data_row_count . '"<br />' . "log = \"" . $data_log . "\"" . "<br />";

			/* Writing the connection string to end of file - writing in 'a' append mode */
            if ( ! write_ini_file($new_setting, $ini_file, TRUE))
			{
				$this->messages->add('Failed to update settings file. Check if "' . $ini_file . '" file is writable.', 'error');
				$this->messages->add('You can manually create a text file "' . $ini_file . '" with the following content :<br /><br />' . $new_setting_html, 'error');
				$this->template->load('admin_template', 'admin/setting', $data);
				return;
			} else {
				$this->messages->add('General settings updated.', 'success');
				redirect('admin/setting');
				return;
			}
		}
		return;
	}
}

/* End of file setting.php */
/* Location: ./system/application/controllers/admin/setting.php */
