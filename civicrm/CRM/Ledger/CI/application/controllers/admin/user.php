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

class User extends CI_Controller {

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
		$this->load->helper('file');
		$this->template->set('page_title', 'Manage users');
		$this->template->set('nav_links', array('admin/user/add' => 'Add user'));

		/* Getting list of files in the config - users directory */
		$users_list = get_filenames($this->config->item('config_path') . 'users');
		$data['users'] = array();
		if ($users_list)
		{
			foreach ($users_list as $row)
			{
				/* Only include file ending with .ini */
				if (substr($row, -4) == ".ini")
				{
					$ini_label = substr($row, 0, -4);
					$data['users'][$ini_label] = $ini_label;
				}
			}
		}

		$this->template->load('admin_template', 'admin/user/index', $data);
		return;
	}

	function add()
	{
		$this->template->set('page_title', 'Add user');

		/* Form fields */
		$data['user_name'] = array(
			'name' => 'user_name',
			'id' => 'user_name',
			'maxlength' => '100',
			'size' => '40',
			'value' => '',
		);

		$data['user_password'] = array(
			'name' => 'user_password',
			'id' => 'user_password',
			'maxlength' => '100',
			'size' => '40',
			'value' => '',
		);

		$data['user_email'] = array(
			'name' => 'user_email',
			'id' => 'user_email',
			'maxlength' => '100',
			'size' => '40',
			'value' => '',
		);

		$data['user_roles'] = array(
			"administrator" => "administrator",
			"manager"=> "manager",
			"accountant" => "accountant",
			"dataentry" => "dataentry",
			"guest" => "guest",
		);

		$data['active_user_role'] = "administrator";
        
		$data['user_status'] = array(
            'name' => 'user_status',
            'id' => 'user_status',
            'value' => 'Active',
            'checked' => set_checkbox('user_status', 'Active', TRUE),
        );


		/* Accounts Form fields */
		$data['accounts_active'] = array('(All Accounts)');
        $data['active_user_account'] = 'default';
        
		/* Getting list of files in the config - accounts directory */
		$accounts_list = get_filenames($this->config->item('config_path') . 'accounts');
		$data['accounts'] = array('(All Accounts)' => '(All Accounts)');
        $data['user_accounts'] = array();
		if ($accounts_list)
		{
			foreach ($accounts_list as $row)
			{
				/* Only include file ending with .ini */
				if (substr($row, -4) == ".ini")
				{
					$ini_label = substr($row, 0, -4);
					$data['accounts'][$ini_label] = $ini_label;
                    $data['user_accounts'][$ini_label] = $ini_label;
				}
			}
		}


		/* Repopulating form */
		if ($_POST)
		{
			$data['user_name']['value'] = $this->input->post('user_name', TRUE);
			$data['user_password']['value'] = $this->input->post('user_password', TRUE);
			$data['user_email']['value'] = $this->input->post('user_email', TRUE);
			$data['active_user_role'] = $this->input->post('user_role', TRUE);
			$data['user_status']['checked'] = $this->input->post('user_status', TRUE);
			$data['accounts_active'] = $this->input->post('accounts', TRUE);
            $data['active_user_account'] = $this->input->post('user_account', TRUE);
		}

		/* Form validations */
		$this->form_validation->set_rules('user_name', 'Username', 'trim|required|min_length[2]|max_length[30]|alpha_numeric');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required');
		$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('user_role', 'Role', 'trim|required');
		$this->form_validation->set_rules('user_status', 'Status', 'trim');
        $this->form_validation->set_rules('user_account', 'Account', 'trim|required');

		/* Validating form */
		if ($this->form_validation->run() == FALSE)
		{
			$this->messages->add(validation_errors(), 'error');
			$this->template->load('admin_template', 'admin/user/add', $data);
			return;
		}
		else
		{
			$data_user_name = $this->input->post('user_name', TRUE);
			$data_user_password = $this->input->post('user_password', TRUE);
			$data_user_email = $this->input->post('user_email', TRUE);
			$data_user_role = $this->input->post('user_role', TRUE);
            $data_user_status = $this->input->post('user_status', TRUE);  
            $data_user_status = ($data_user_status == '') ? 'Inactive' : $data_user_status;
			$data_accounts = $this->input->post('accounts', TRUE);

			/* Forming account querry string */
			$data_accounts_string = '';
			if ( ! $data_accounts)
			{
				$this->messages->add('Please select account.', 'error');
				$this->template->load('admin_template', 'admin/user/add', $data);
				return;
			} else {
				if (in_array('(All Accounts)', $data_accounts))
				{
					$data_accounts_string = '*';
				} else {
					/* Filtering out bogus accounts */
					$data_accounts_valid = array_intersect($data['accounts'], $data_accounts);
					$data_accounts_string = implode(",", $data_accounts_valid);
				}
			}
            
            $data_user_account = $this->input->post('user_account', TRUE);

			$ini_file = $this->config->item('config_path') . "users/" . $data_user_name . ".ini";

			/* Check if user ini file exists */
			if (get_file_info($ini_file))
			{
				$this->messages->add('Username already exists.', 'error');
				$this->template->load('admin_template', 'admin/user/add', $data);
				return;
			}

            $user_details['user'] = array(
                'username'  => $data_user_name,
                'password'  => $data_user_password,
                'email'     => $data_user_email,
                'role'      => $data_user_role,
                'status'    => $data_user_status,
                'accounts'  => $data_accounts_string,
                'account'   => $data_user_account
            );

			$user_details_html = "[user]" . "<br />" . "username = \"" . $data_user_name . "\"" . "<br />" . "password = \"" . $data_user_password . "\"" . "<br />" . "email = \"" . $data_user_email . "\"" . "<br />" . "role = \"" . $data_user_role . "\"" . "<br />" . "status = \"" . $data_user_status . "\"" . "<br />" . "accounts = \"" . $data_accounts_string . "\"" . "<br />";

			/* Writing the connection string to end of file - writing in 'a' append mode */

            if ( ! write_ini_file($user_details, $ini_file, TRUE))
			{
				$this->messages->add('Failed to add user. Check if "' . $ini_file . '" file is writable.', 'error');
				$this->messages->add('You can manually create a text file "' . $ini_file . '" with the following content :<br /><br />' . $user_details_html, 'error');
				$this->template->load('admin_template', 'admin/user/add', $data);
				return;
			} else {
				$this->messages->add('Added user.', 'success');
				redirect('admin/user');
				return;
			}
		}
		return;
	}

	function edit($user_name)
	{
		$this->template->set('page_title', 'Edit user');

		$ini_file = $this->config->item('config_path') . "users/" . $user_name . ".ini";

		/* Form fields */
		$data['user_password'] = array(
			'name' => 'user_password',
			'id' => 'user_password',
			'maxlength' => '100',
			'size' => '40',
			'value' => '',
		);

		$data['user_email'] = array(
			'name' => 'user_email',
			'id' => 'user_email',
			'maxlength' => '100',
			'size' => '40',
			'value' => '',
		);

		$data['user_roles'] = array(
			"administrator" => "administrator",
			"manager"=> "manager",
			"accountant" => "accountant",
			"dataentry" => "dataentry",
			"guest" => "guest",
		);

		$data['user_name'] = $user_name;
		$data['active_user_role'] = "";
        
        $data['user_status'] = array(
            'name' => 'user_status',
            'id' => 'user_status',
            'value' => 'Active',
            'checked' => set_checkbox('user_status', 'Active'),
        );
        
        $data['active_user_account'] = '';
        

		/* Accounts Form fields */
		$data['accounts_active'] = array('(All Accounts)');
		/* Getting list of files in the config - accounts directory */
		$accounts_list = get_filenames($this->config->item('config_path') . 'accounts');
		$data['accounts'] = array('(All Accounts)' => '(All Accounts)');
        $data['user_accounts'] = array();
				if ($accounts_list)
		{
			foreach ($accounts_list as $row)
			{
				/* Only include file ending with .ini */
				if (substr($row, -4) == ".ini")
				{
					$ini_label = substr($row, 0, -4);
					$data['accounts'][$ini_label] = $ini_label;
                    $data['user_accounts'][$ini_label] = $ini_label;
				}
			}
		}

		/* Repopulating form */
		if ($_POST)
		{
			$data['user_password']['value'] = $this->input->post('user_password', TRUE);
			$data['user_email']['value'] = $this->input->post('user_email', TRUE);
			$data['active_user_role'] = $this->input->post('user_role', TRUE);
			$data['user_status']['checked'] = $this->input->post('user_status', TRUE);
			$data['accounts_active'] = $this->input->post('accounts', TRUE);
            $data['active_user_account'] = $this->input->post('user_account', TRUE);
		} else {
			/* Check if user ini file exists */
			if ( ! get_file_info($ini_file))
			{
				$this->messages->add('User file "' . $ini_file . '" does not exists.', 'error');
				redirect('admin/user');
				return;
			} else {
				/* Parsing user ini file */
				$active_users = parse_ini_file($ini_file);
				if ( ! $active_users)
				{
					$this->messages->add('Invalid user file.', 'error');
				} else {
					/* Check if all needed variables are set in ini file */
					if (isset($active_users['username']))
						$data['user_name'] = $user_name;
					else
						$this->messages->add('Username missing from user file.', 'error');

					if (isset($active_users['password']))
						$data['user_password']['value'] = $active_users['password'];
					else
						$this->messages->add('Password missing from user file.', 'error');

					if (isset($active_users['email']))
						$data['user_email']['value'] = $active_users['email'];
					else
						$this->messages->add('Email missing from user file.', 'error');

					if (isset($active_users['role']))
						$data['active_user_role'] = $active_users['role'];
					else
						$this->messages->add('Role missing from user file.', 'error');

					if (isset($active_users['status']))
						$data['user_status']['checked'] = $active_users['status'] == 'Active';
					else
						$this->messages->add('Status missing from user file.', 'error');

					if (isset($active_users['accounts']))
					{
						if ($active_users['accounts'] == "*")
						{
							$data['accounts_active'] = array('(All Accounts)');
						} else {
							$data['accounts_active'] = explode(",", $active_users['accounts']);
						}
					} else {
						$this->messages->add('Accounts missing from user file.', 'error');
					}
                    
                    if (isset($active_users['account']))
                        $data['active_user_account'] = $active_users['account'];
                    else
                        $this->messages->add('Role missing from user file.', 'error');

				}
			}
		}

		/* Form validations */
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required');
		$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('user_role', 'Role', 'trim|required');
		$this->form_validation->set_rules('user_status', 'Active', 'trim');
        $this->form_validation->set_rules('user_account', 'Account', 'trim|required');

		/* Validating form */
		if ($this->form_validation->run() == FALSE)
		{
			$this->messages->add(validation_errors(), 'error');
			$this->template->load('admin_template', 'admin/user/edit', $data);
			return;
		}
		else
		{
			$data_user_password = $this->input->post('user_password', TRUE);
			$data_user_email = $this->input->post('user_email', TRUE);
			$data_user_role = $this->input->post('user_role', TRUE);
            $data_user_status = $this->input->post('user_status', TRUE);  
            $data_user_status = ($data_user_status == '') ? 'Inactive' : $data_user_status;

			$data_accounts = $this->input->post('accounts', TRUE);

			/* Forming account querry string */
			$data_accounts_string = '';
			if ( ! $data_accounts)
			{
				$this->messages->add('Please select account.', 'error');
				$this->template->load('admin_template', 'admin/user/edit', $data);
				return;
			} else {
				if (in_array('(All Accounts)', $data_accounts))
				{
					$data_accounts_string = '*';
				} else {
					/* Filtering out bogus accounts */
					$data_accounts_valid = array_intersect($data['accounts'], $data_accounts);
					$data_accounts_string = implode(",", $data_accounts_valid);
				}
			}

            $data_user_account = $this->input->post('user_account', TRUE);

			$ini_file = $this->config->item('config_path') . "users/" . $user_name . ".ini";

            $user_details['user'] = array(
                'username'  => $user_name,
                'password'  => $data_user_password,
                'email'     => $data_user_email,
                'role'      => $data_user_role,
                'status'    => $data_user_status,
                'accounts'  => $data_accounts_string,
                'account'   => $data_user_account
            );

			$user_details_html = "[user]" . "<br />" . "username = \"" . $user_name . "\"" . "<br />" . "password = \"" . $data_user_password . "\"" . "<br />" . "email = \"" . $data_user_email . "\"" . "<br />" . "role = \"" . $data_user_role . "\"" . "<br />" . "status = \"" . $data_user_status . "\"" . "<br />" . "accounts = \"" . $data_accounts_string . "\"" . "<br />";

			/* Writing the connection string to end of file - writing in 'a' append mode */
            if ( ! write_ini_file($user_details, $ini_file, TRUE))
			{
				$this->messages->add('Failed to edit user. Check if "' . $ini_file . '" file is writable.', 'error');
				$this->messages->add('You can manually edit the text file "' . $ini_file . '" with the following content :<br /><br />' . $user_details_html, 'error');
				$this->template->load('admin_template', 'admin/user/edit', $data);
				return;
			} else {
				$this->messages->add('Updated user.', 'success');
				redirect('admin/user');
				return;
			}
		}
		return;
	}

	function delete($user_name)
	{
		$this->template->set('page_title', 'Delete user');

		if ($this->session->userdata('user_name') == $user_name)
		{
			$this->messages->add('Cannot delete currently logged in user.', 'error');
			redirect('admin/user');
			return;
		}
		$ini_file = $this->config->item('config_path') . "users/" . $user_name . ".ini";
		$this->messages->add('Delete ' . $ini_file . ' file manually.', 'error');
		redirect('admin/user');
		return;
	}
}

/* End of file user.php */
/* Location: ./system/application/controllers/admin/user.php */
