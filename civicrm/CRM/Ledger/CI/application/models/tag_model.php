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

class Tag_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function get_all_tags($allow_none = TRUE)
	{
		$options = array();
		if ($allow_none)
			$options[0] = "(None)";
		$this->db->from('tags')->order_by('title', 'asc');
		$tag_q = $this->db->get();
		foreach ($tag_q->result() as $row)
		{
			$options[$row->id] = $row->title;
		}
		return $options;
	}

	function show_entry_tag($tag_id)
	{
		if ($tag_id < 1)
			return "";
		$this->db->from('tags')->where('id', $tag_id)->limit(1);
		$tag_q = $this->db->get();
		if ($tag = $tag_q->row())
			return "<span class=\"tags\" style=\"color:#" . $tag->color . "; background-color:#" . $tag->background . "\">" . $tag->title . "</span>";
		else
			return "";
	}

	function show_entry_tag_link($tag_id)
	{
		if ($tag_id < 1)
			return "";
		$this->db->from('tags')->where('id', $tag_id)->limit(1);
		$tag_q = $this->db->get();
		if ($tag = $tag_q->row())
			return "<span class=\"tags\" style=\"color:#" . $tag->color . "; background-color:#" . $tag->background . "\">" . anchor("entry/show/tag/" . $tag->id , $tag->title, array('style' => 'text-decoration:none;color:#' . $tag->color . ';')) . "</span>";
		else
			return "";
	}
	
	function tag_name($tag_id)
	{
		if ($tag_id < 1)
			return "";
		$this->db->from('tags')->where('id', $tag_id)->limit(1);
		$tag_q = $this->db->get();
		if ($tag = $tag_q->row())
			return $tag->title;
		else
			return "";
	}
}
