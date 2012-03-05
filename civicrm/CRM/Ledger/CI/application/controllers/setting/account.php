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
		$this->load->model('Setting_model');

		/* Check access */
		if ( ! check_access('change account settings'))
		{
			$this->messages->add('Permission denied.', 'error');
			redirect('');
			return;
		}

		return;
	}

	function index()
	{
		$this->template->set('page_title', 'Account Settings');
		$account_data = $this->Setting_model->get_current();

		/* Form fields */
		$data['account_name'] = array(
			'name' => 'account_name',
			'id' => 'account_name',
			'maxlength' => '100',
			'size' => '40',
			'value' => '',
		);
		$data['account_address'] = array(
			'name' => 'account_address',
			'id' => 'account_address',
			'rows' => '4',
			'cols' => '47',
			'value' => '',
		);
		$data['account_email'] = array(
			'name' => 'account_email',
			'id' => 'account_email',
			'maxlength' => '100',
			'size' => '40',
			'value' => '',
		);
        $data['fy_start'] = array(
            'name' => 'fy_start',
            'id' => 'fy_start',
            'maxlength' => '11',
            'size' => '11',
            'value' => '',
        );
        $data['fy_end'] = array(
            'name' => 'fy_end',
            'id' => 'fy_end',
            'maxlength' => '11',
            'size' => '11',
            'value' => '',
        );
		$data['account_currency'] = array(
			'name' => 'account_currency',
			'id' => 'account_currency',
			'maxlength' => '10',
			'size' => '10',
			'value' => '',
		);
		$data['account_date_options'] = array(
			'dd/mm/yyyy' => 'Day / Month / Year',
			'mm/dd/yyyy' => 'Month / Day / Year',
			'yyyy/mm/dd' => 'Year / Month / Day',
		);
		$data['account_date'] = 'dd/mm/yyyy';
		$data['account_timezone'] = 'UTC';
		$data['account_locked'] = FALSE;

		/* Current account settings */
		if ($account_data)
		{
			$data['account_name']['value'] = print_value($account_data->name);
			$data['account_address']['value'] = print_value($account_data->address);
			$data['account_email']['value'] = print_value($account_data->email);
			$data['account_currency']['value'] = print_value($account_data->currency_symbol);
			$data['account_date'] = print_value($account_data->date_format);
			$data['account_timezone'] = print_value($account_data->timezone);
			$data['fy_start']['value'] = date_mysql_to_php(print_value($account_data->fy_start));
			$data['fy_end']['value'] = date_mysql_to_php(print_value($account_data->fy_end));
			$data['account_locked'] = print_value($account_data->account_locked);
		}

		/* Form validations */
		$this->form_validation->set_rules('account_name', 'Account Name', 'trim|required|min_length[2]|max_length[100]');
		$this->form_validation->set_rules('account_address', 'Account Address', 'trim|max_length[255]');
		$this->form_validation->set_rules('account_email', 'Account Email', 'trim|valid_email');
		$this->form_validation->set_rules('account_currency', 'Currency', 'trim|max_length[10]');
		$this->form_validation->set_rules('account_date', 'Date', 'trim|max_length[10]');
		$this->form_validation->set_rules('account_timezone', 'Timezone', 'trim|max_length[6]');
		$this->form_validation->set_rules('account_locked', 'Account Locked', 'trim');
        if ($_POST)
        {
            $this->config->set_item('account_date_format', $this->input->post('account_date', TRUE));
            $this->form_validation->set_rules('fy_start', 'Account Start Date', 'trim|required|is_date');
            $this->form_validation->set_rules('fy_end', 'Account End Date', 'trim|required|is_date');
        }

		/* Repopulating form */
		if ($_POST)
		{
			$data['account_name']['value'] = $this->input->post('account_name', TRUE);
			$data['account_address']['value'] = $this->input->post('account_address', TRUE);
			$data['account_email']['value'] = $this->input->post('account_email', TRUE);
			$data['account_currency']['value'] = $this->input->post('account_currency', TRUE);
			$data['account_date'] = $this->input->post('account_date', TRUE);
			$data['account_timezone'] = $this->input->post('account_timezone', TRUE);
			$data['account_locked'] = $this->input->post('account_locked', TRUE);
            $data['fy_start']['value'] = $this->input->post('fy_start', TRUE);
            $data['fy_end']['value'] = $this->input->post('fy_end', TRUE);
		}

		/* Validating form */
		if ($this->form_validation->run() == FALSE)
		{
			$this->messages->add(validation_errors(), 'error');
			$this->template->load('template', 'setting/account', $data);
			return;
		}
		else
		{
			$data_account_name = $this->input->post('account_name', TRUE);
			$data_account_address = $this->input->post('account_address', TRUE);
			$data_account_email = $this->input->post('account_email', TRUE);
            $data_fy_start = date_php_to_mysql($this->input->post('fy_start', TRUE));
            $data_fy_end = date_php_to_mysql_end_time($this->input->post('fy_end', TRUE));
			$data_account_currency = $this->input->post('account_currency', TRUE);
			$data_account_date_form = $this->input->post('account_date', TRUE);
			/* Checking for valid format */
			if ($data_account_date_form == "dd/mm/yyyy")
				$data_account_date = "dd/mm/yyyy";
			else if ($data_account_date_form == "mm/dd/yyyy")
				$data_account_date = "mm/dd/yyyy";
			else if ($data_account_date_form == "yyyy/mm/dd")
				$data_account_date = "yyyy/mm/dd";
			else
				$data_account_date = "dd/mm/yyyy";

			$data_account_timezone = $this->input->post('timezones', TRUE);

			$data_account_locked = $this->input->post('account_locked', TRUE);
			if ($data_account_locked != 1)
				$data_account_locked = 0;

			/* Update settings */
			$this->db->trans_start();
			$update_data = array(
				'name' => $data_account_name,
				'address' => $data_account_address,
				'email' => $data_account_email,
				'currency_symbol' => $data_account_currency,
				'date_format' => $data_account_date,
				'timezone' => $data_account_timezone,
				'account_locked' => $data_account_locked,
				'fy_start' => $data_fy_start,
				'fy_end' => $data_fy_end,
				
			);
			if ( ! $this->db->where('id', 1)->update('settings', $update_data))
			{
				$this->db->trans_rollback();
				$this->messages->add('Error updating account settings.', 'error');
				$this->logger->write_message("error", "Error updating account settings");
				$this->template->load('template', 'setting/account', $data);
				return;
			} else {
				$this->db->trans_complete();
				$this->messages->add('Account settings updated.', 'success');
				$this->logger->write_message("success", "Updated account settings");
				redirect('setting');
				return;
			}
		}
		return;
	}
}

/* End of file account.php */
/* Location: ./system/application/controllers/setting/account.php */
