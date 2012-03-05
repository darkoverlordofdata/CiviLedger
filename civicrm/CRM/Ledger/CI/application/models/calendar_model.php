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
 *  Table ledger_calendar
 * 
 *      id              unique key  
 *      year            YYYY fiscal year
 *      period          MM fiscal period
 *      start           Actual period start date
 *      end             Actual period end date
 *      opened          Period is opened for posting
 *      closed          Period is closed for posting
 *
 * 
 *
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?><?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar_model extends CI_Model {

    // --------------------------------------------------------------------

    /**
     * Get Fiscal Year Start
     *
     * Returns the current fiscal year start date
     *
     * @access  public
     * @return  integer Current fiscal year start date
     */
    function get_fy_start() {
        
        $this->db->select('period, start')->from('ledger_calendar')->order_by('period', 'asc')->limit(1);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $row = $result->row();
            return $row->start;
        }
        else {
            return -1;
        }
    }


    // --------------------------------------------------------------------

    /**
     * Get Fiscal Year End
     *
     * Returns the current fiscal year end date
     *
     * @access  public
     * @return  integer Current fiscal year end date
     */
    function get_fy_end() {
        
        $this->db->select('period, end')->from('ledger_calendar')->order_by('period', 'desc')->limit(1);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $row = $result->row();
            return $row->end;
        }
        else {
            return -1;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Get Current Year
     *
     * Returns the current fiscal year
     *
     * @access  public
     * @return  integer Current fiscal year
     */
    function get_current_year() {
        
        $this->db->select('year')->from('ledger_calendar')->limit(1);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $row = $result->row();
            return $row->year;
        }
        else {
            return -1;
        }
    }


    // --------------------------------------------------------------------

    /**
     * Get Current Period
     *
     * Returns the current open period
     *
     * @access  public
     * @return  integer Current period or 0
     */
    function get_current_period() {
        
        $this->db->select('opened')->from('ledger_calendar')->where('opened', 1);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $row = $result->row();
            return $row->opened;
        }
        else {
            return 0;
        }
    }
    
    // --------------------------------------------------------------------

    /**
     * Set Current Period
     *
     * Returns the current open period
     *
     * @access  public
     * @param   integer New current period
     * @return  void
     */
    function set_current_period($period) {
      
        $this->db->trans_start();
        $this->db->update('ledger_calendar', array('opened' => 0));
        $this->db->where('period', $period)->update('ledger_calendar', array('opened' => 1));
        $this->db->trans_complete();
      
    }
    
    // --------------------------------------------------------------------

    /**
     * Is Open?
     *
     * Returns True if the specified period is open for posting
     *
     * @access  public
     * @return  boolean False if period is closed
     */
    function is_open($period) {
            
        return ($this->db->select('opened')->from('ledger_calendar')
                ->where('period', $period)->where('opened', 1)->count_all_results() > 0);
        
        
    }
    
    // --------------------------------------------------------------------

    /**
     * Open Period
     *
     * Opens the specified period
     *
     * @access  public
     * @param   integer period to open
     * @return  void
     */
    function open_period($period) {
      
        $this->db->where('period', $period)->update('ledger_calendar', array('closed' => 0, 'opened' => 1));
      
    }

    // --------------------------------------------------------------------

    /**
     * Close Period
     *
     * Closes the specified period
     *
     * @access  public
     * @param   integer period to close
     * @return  void
     */
    function close_period($period) {
      
        $this->db->where('period', $period)->update('ledger_calendar', array('closed' => 1, 'opened' => 0));
      
    }

    // --------------------------------------------------------------------

    /**
     * Create
     *
     * Create a calendar
     *
     * @access  public
     * @param   string  Ending Date of Fiscal Year
     * @param   integer calendar type
     * @param   boolean use 53rd week
     * @return  void
     */
    function create($end_date, $fy_type = FiscalCalendar::FY_CAL, $use_53_week = FALSE) {
        
        $this->load->library('fiscalcalendar');
        $fy = new FiscalCalendar();
        $fy->init($end_date);
        $calendar = $fy->get_calendar($fy_type, $use_53_week);
        echo "<br>";
        print_r($calendar);
        echo "<br>";
        
        
        $this->db->trans_start();

        $this->db->truncate('ledger_calendar');
        for ($i = 0; $i < count($calendar); $i++) {
            $this->db->insert('ledger_calendar', $calendar[$i]);
        }

        $this->db->trans_complete();
        
    }

    // --------------------------------------------------------------------

    /**
     * Delete
     *
     * Delete a calendar
     *
     * @access  public
     * @return  void
     */
    function delete() {
        
        $this->db->truncate('ledger_calendar');
        
    }

    /**
     * Get Current
     *
     * Returns the current calendar
     *
     * @access  public
     * @return  array
     */
    function get_current() {

        $calendar = array();
        $this->db->from('ledger_calendar');
        $calendar_q = $this->db->get();
        foreach ($calendar_q->result() as $row) {
            $calendar[] = $row;
        }
        return $calendar;
    }
}