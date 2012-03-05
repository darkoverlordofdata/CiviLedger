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

class Group_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function get_all_groups($id = NULL)
	{
		$options = array();
		if ($id == NULL)
			$this->db->from('groups')->where('id >', 0)->order_by('name', 'asc');
		else
			$this->db->from('groups')->where('id >', 0)->where('id !=', $id)->order_by('name', 'asc');
		$group_parent_q = $this->db->get();
		foreach ($group_parent_q->result() as $row)
		{
			$options[$row->id] = $row->name;
		}
		return $options;
	}

	function get_ledger_groups()
	{
		$options = array();
		$this->db->from('groups')->where('id >', 4)->order_by('name', 'asc');
		$group_parent_q = $this->db->get();
		foreach ($group_parent_q->result() as $row)
		{
			$options[$row->id] = $row->name;
		}
		return $options;
	}
}
