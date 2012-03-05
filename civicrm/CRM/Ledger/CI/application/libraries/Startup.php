<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Startup:: a class that is loaded everytime the application is accessed
 *
 * Setup all the initialization routines that the application uses in this
 * class. It is autoloaded evertime the application is accessed.
 *
 */

class Startup
{
	function Startup()
	{
		$CI =& get_instance();
		$CI->db->trans_strict(FALSE);
		$CI->load->library('general');

		/* Skip checking if accessing admin section*/
		if ($CI->uri->segment(1) == "admin")
			return;

		/* Skip checking if accessing updated page */
		if ($CI->uri->segment(1) == "update")
			return;

		/* Skip checking if accessing user section*/
		if ($CI->uri->segment(1) == "user")
			return;

		/* Check if user is logged in */
		if ( ! $CI->session->userdata('user_name'))
		{
			redirect('user/login');
			return;
		}

		/* Reading database settings ini file */
		if ($CI->session->userdata('active_account'))
		{
			/* Fetching database label details from session and checking the database ini file */
			if ( ! $active_account = $CI->general->check_account($CI->session->userdata('active_account')))
			{
				$CI->session->unset_userdata('active_account');
				redirect('user/account');
				return;
			}


			/* Preparing database settings *//*
            $conf =& JFactory::getConfig();
			$db_config['hostname'] = $conf->getValue('config.host');
            $db_config['database'] = $conf->getValue('config.db');
            $db_config['dbdriver'] = $conf->getValue('config.dbtype');
			$db_config['username'] = $conf->getValue('config.user');
			$db_config['password'] = $conf->getValue('config.password');
			$db_config['dbprefix'] = "webzash_";
			$db_config['pconnect'] = FALSE;
			$db_config['db_debug'] = FALSE;
			$db_config['cache_on'] = FALSE;
			$db_config['cachedir'] = "";
			$db_config['char_set'] = "utf8";
			$db_config['dbcollat'] = "utf8_general_ci";
			$CI->load->database($db_config, FALSE, TRUE);*/
			
			
            $CI->load->database($CI->session->userdata('active_account'), FALSE, TRUE);

			/* Checking for valid database connection */
			if ( ! $CI->db->conn_id)
			{
				$CI->session->unset_userdata('active_account');
				$CI->messages->add('Error connecting to database server. Check whether database server is running.', 'error');
				redirect('user/account');
				return;
			}
			/* Check for any database connection error messages */
			if ($CI->db->_error_message() != "")
			{
				$CI->session->unset_userdata('active_account');
				$CI->messages->add('Error connecting to database server. ' . $CI->db->_error_message(), 'error');
				redirect('user/account');
				return;
			}
		} else {
			$CI->messages->add('Select a account.', 'error');
			redirect('user/account');
			return;
		}

		/* Checking for valid database connection */
		if ( ! $CI->general->check_database())
		{
			$CI->session->unset_userdata('active_account');
			redirect('user/account');
			return;
		}

		/* Loading account data */
		$CI->db->from('settings')->where('id', 1)->limit(1);
		$account_q = $CI->db->get();
		if ( ! ($account_d = $account_q->row()))
		{
			$CI->messages->add('Invalid account settings.', 'error');
			redirect('user/account');
			return;
		}
		$CI->config->set_item('account_name', $account_d->name);
		$CI->config->set_item('account_address', $account_d->address);
		$CI->config->set_item('account_email', $account_d->email);
		$CI->config->set_item('account_fy_start', $account_d->fy_start);
		$CI->config->set_item('account_fy_end', $account_d->fy_end);
		$CI->config->set_item('account_currency_symbol', $account_d->currency_symbol);
		$CI->config->set_item('account_date_format', $account_d->date_format);
		$CI->config->set_item('account_timezone', $account_d->timezone);
		$CI->config->set_item('account_locked', $account_d->account_locked);
		$CI->config->set_item('account_database_version', $account_d->database_version);

        $current_date_format = $CI->config->item('account_date_format');
        log_message('debug', "Startup: current_date_format=$current_date_format");

        /* Load general application settings */
        $CI->general->check_setting();

		/* Load entry types */
		$CI->general->setup_entry_types();

        /* get current fiscal period */
        $CI->load->model('Calendar_model');
        $CI->config->set_item('fiscal_year', $CI->Calendar_model->get_current_year());
        $CI->config->set_item('fiscal_period', $CI->Calendar_model->get_current_period());
        $CI->config->set_item('fy_start', $CI->Calendar_model->get_fy_start());
        $CI->config->set_item('fy_end', $CI->Calendar_model->get_fy_end());
		return;
	}
}

/* End of file startup.php */
/* Location: ./system/application/libraries/startup.php */
