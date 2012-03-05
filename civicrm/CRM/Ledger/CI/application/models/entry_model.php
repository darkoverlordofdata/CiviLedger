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

class Entry_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
	}

	function next_entry_number($entry_type_id)
	{
		$this->db->select_max('number', 'lastno')->from('entries')->where('entry_type', $entry_type_id);
		$last_no_q = $this->db->get();
		if ($row = $last_no_q->row())
		{
			$last_no = (int)$row->lastno;
			$last_no++;
			return $last_no;
		} else {
			return 1;
		}
	}

	function get_entry($entry_id, $entry_type_id)
	{
		$this->db->from('entries')->where('id', $entry_id)->where('entry_type', $entry_type_id)->limit(1);
		$entry_q = $this->db->get();
		return $entry_q->row();
	}
}
