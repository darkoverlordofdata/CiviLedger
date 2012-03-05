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

/**
 * Form Declaration - Override
 *
 * Creates the opening portion of the form.
 *
 * @access  public
 * @param   string  the URI segments of the form destination
 * @param   array   a key/value pair of attributes
 * @param   array   a key/value pair hidden data
 * @return  string
 */
if ( ! function_exists('form_open'))
{
    function form_open($action = '', $attributes = '', $hidden = array())
    {
        $CI =& get_instance();

        if ($attributes == '')
        {
            $attributes = 'method="post"';
        }

        //  Reformat action url for Joomla:
        $action = civicrm_url( ( strpos($action, '://') === FALSE) ? $CI->config->site_url($action) : $action);

        //log_message('debug',"form_open action = $action");
        
        $form = '<form action="'.$action.'"';

        $form .= _attributes_to_string($attributes, TRUE);

        $form .= '>';

        // CSRF
        if ($CI->config->item('csrf_protection') === TRUE)
        {
            $hidden[$CI->security->csrf_token_name] = $CI->security->csrf_hash;
        }

        if (is_array($hidden) AND count($hidden) > 0)
        {
            $form .= sprintf("\n<div class=\"hidden\">%s</div>", form_hidden($hidden));
        }

        return $form;
    }
}


if ( ! function_exists('form_dropdown_dc'))
{
	function form_dropdown_dc($name, $selected = NULL, $extra = '')
	{
		$options = array("D" => "Dr", "C" => "Cr");

		// If no selected state was submitted we will attempt to set it automatically
		if ( ! ($selected == "D" || $selected == "C"))
		{
			// If the form name appears in the $_POST array we have a winner!
			if (isset($_POST[$name]))
			{
				$selected = $_POST[$name];
			}
		}

		if ($extra != '') $extra = ' '.$extra;

		$form = '<select name="'.$name.'"'.$extra.' class="dc-dropdown" >';

		foreach ($options as $key => $val)
		{
			$key = (string) $key;
			$sel = ($key == $selected) ? ' selected="selected"' : '';
			$form .= '<option value="'.$key.'"'.$sel.'>'.(string) $val."</option>\n";
		}

		$form .= '</select>';

		return $form;
	}
}

if ( ! function_exists('form_input_date'))
{
	function form_input_date($data = '', $value = '', $extra = '')
	{
		$defaults = array('type' => 'text', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);

		return "<input "._parse_form_attributes($data, $defaults).$extra." class=\"datepicker\"/>";
	}
}

if ( ! function_exists('form_input_date_restrict'))
{
	function form_input_date_restrict($data = '', $value = '', $extra = '')
	{
		$defaults = array('type' => 'text', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);

		return "<input "._parse_form_attributes($data, $defaults).$extra." class=\"datepicker-restrict\"/>";
	}
}

if ( ! function_exists('form_input_ledger'))
{
	function form_input_ledger($name, $selected = NULL, $extra = '', $type = 'all')
	{
		$CI =& get_instance();
		$CI->load->model('Ledger_model');

		if ($type == 'bankcash')
			$options = $CI->Ledger_model->get_all_ledgers_bankcash();
		else if ($type == 'nobankcash')
			$options = $CI->Ledger_model->get_all_ledgers_nobankcash();
		else if ($type == 'reconciliation')
			$options = $CI->Ledger_model->get_all_ledgers_reconciliation();
		else
			$options = $CI->Ledger_model->get_all_ledgers();

		// If no selected state was submitted we will attempt to set it automatically
		if ( ! ($selected))
		{
			// If the form name appears in the $_POST array we have a winner!
			if (isset($_POST[$name]))
			{
				$selected = $_POST[$name];
			}
		}

		if ($extra != '') $extra = ' '.$extra;

		$form = '<select name="'.$name.'"'.$extra.' class="ledger-dropdown">';

		foreach ($options as $key => $val)
		{
			$key = (string) $key;
			$sel = ($key == $selected) ? ' selected="selected"' : '';
			$form .= '<option value="'.$key.'"'.$sel.'>'.(string) $val."</option>\n";
		}

		$form .= '</select>';

		return $form;
	}
}



/* End of file MY_form_helper.php */
/* Location: ./system/application/helpers/MY_form_helper.php */
