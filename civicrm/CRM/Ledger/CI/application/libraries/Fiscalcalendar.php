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
 *  Fiscal Calendar class
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
if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php

class FiscalCalendar {

    const FY_CAL = 0;       //  Unmodified calendar year     
    const FY_544 = 1;       //  5-4-4 week quarters
    const FY_454 = 2;       //  4-5-4 week quarters
    const FY_445 = 4;       //  4-4-5 week quarters
    
    var $start_date;
    var $end_date;
    var $fiscal_year;
    
    function FiscalCalendar(){}
    
    // --------------------------------------------------------------------

    /**
     * Initialize the calendar
     *
     * Accepts  calendar end date
     *
     * @access  public
     * @param   string   Fiscal Calendar End Date
     * @return  void
     */
    function init($end_date) {
        
        $d = new DateTime($end_date);
        $this->end_date = $d->format('Y-m-d');
        $d->modify('-1 year')->modify('+1 day');
        $this->start_date = $d->format('Y-m-d');
    }
    
    // --------------------------------------------------------------------

    /**
     * Get Calendar
     *
     * Returns full calendar array
     *
     * @access  public
     * @param   integer Calendar type
     * @param   boolean Use 53rd Week
     * @return  array
     */
    function get_calendar($fy_type = FiscalCalendar::FY_CAL, $use_53_week = FALSE) {

        switch($fy_type) {
            case FiscalCalendar::FY_CAL:
                $m = array( '+1 month', '+1 month', '+1 month', 
                            '+1 month', '+1 month', '+1 month', 
                            '+1 month', '+1 month', '+1 month', 
                            '+1 month', '+1 month', '+1 month');
                break;
                
            case FiscalCalendar::FY_544;
                $m = array( '+5 weeks', '+4 weeks', '+4 weeks',
                            '+5 weeks', '+4 weeks', '+4 weeks',
                            '+5 weeks', '+4 weeks', '+4 weeks',
                            '+5 weeks', '+4 weeks', '+4 weeks');
                            
                break;
            
            case FiscalCalendar::FY_454:
                $m = array( '+4 weeks', '+5 weeks', '+4 weeks',
                            '+4 weeks', '+5 weeks', '+4 weeks',
                            '+4 weeks', '+5 weeks', '+4 weeks',
                            '+4 weeks', '+5 weeks', '+4 weeks');
                            
                break;
                
            case FiscalCalendar::FY_455:
                $m = array( '+4 weeks', '+4 weeks', '+5 weeks',
                            '+4 weeks', '+4 weeks', '+5 weeks',
                            '+4 weeks', '+4 weeks', '+5 weeks',
                            '+4 weeks', '+4 weeks', '+5 weeks');
                            
                break;
                
        }
        
        $calendar = array();
        $year = substr($this->start_date, 0, 4);
        $next_date = new DateTime($this->start_date);
        
        for ($period = 0; $period < 12; $period++) {
            
            $start_date = new DateTime($next_date->format('Y-m-d'));
            $next_date->modify($m[$period]);
            $end_date = new DateTime($next_date->format('Y-m-d'));
            $end_date->modify('-1 day');
         
            $calendar[] = array(
                'year' => $year,
                'period' => $period + 1,
                'start' => $start_date->format('Y-m-d'),
                'end' => $end_date->format('Y-m-d'),
                'opened' => FALSE,
                'closed' => FALSE
            );   
        }

        if ($fy_type != FiscalCalendar::FY_CAL AND $use_53_week == FALSE) {
            
            $calendar[] = array(
                'year' => $year,
                'period' => 13,
                'start' => $next_date->format('Y-m-d'),
                'end' => $this->end_date,
                'opened' => FALSE,
                'closed' => FALSE
            );   
            
        }
        
        return $calendar;
    }
    
}
