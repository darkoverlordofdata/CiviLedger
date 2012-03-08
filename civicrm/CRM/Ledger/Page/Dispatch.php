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
 * This class introduces component to the system and provides all the 
 * information about it. It needs to extend CRM_Core_Component_Info
 * abstract class.
 * 
 * @package Ledger
 * @copyright DarkOverlordOfData (c) 2012
 *
 */

 
require_once 'CRM/Core/Page.php';

/**
 * This page is for CiviLedger Dashboard
 */
class CRM_Ledger_Page_Dispatch extends CRM_Core_Page 
{

    static $instance;
    
    function __construct() {
        parent::__construct();
        self::$instance = $this;
    }
    
    
    /** 
     * Summarize the Ledger
     * 
     * @return void 
     * @access public 
     * 
     */
    function preProcess() 
    {
        /* Initialize CodeIgniter. 
         * CiviCRM has already routed us here by parsing: 
         * 
         *      ?option=com_civicrm&task=civicrm/ledger&reset=1
         * 
         * Based on the parsing the remainder of the url, this class
         * will route to the ci controller classes. The ci view class will
         * return the content as a string wich is then passed to the smarty 
         * template for presentation.
         * 
         * Example routing:
         * 
         * DashBoard    ?option=com_civicrm&task=civicrm/ledger
         * CoA          ?option=com_civicrm&task=civicrm/ledger/account
         * NewReciept   ?option=com_civicrm&task=civicrm/ledger/entry/add/receipt
         * EditReceipt  ?option=com_civicrm&task=civicrm/ledger/entry/edit/receipt/42
         *           
         */
                
        $task = $_GET['task'];
        switch($task) {
        /* Fix up TASK */
            
            case 'civicrm/ledger':
            /* Null segments = DashBoard                         */
                $task = 'welcome';
                break;
                
            case 'civicrm/ledger/log': 
            /* Name collison on log - call txnlog instead        */
                $task = "txnlog";
                break;
              
            case 'civicrm/ledger/log/clear':
            /* Name collison on log - call txnlog instead        */
                $task = "txnlog/clear";
                break;
                
            default:
                $task = substr($task,15);
        }
            
        $segments = $this->explode_segments($task);
        require 'CRM/Ledger/CI/controller.php';
        /*
        $CI =& get_instance();
        if (stripos($task, "report/download") == 1) {
            echo($CI->output->get_output());
        }
        else {
            $this->assign('civiledger', $CI->output->get_output());
        }*/
        return;
        
    }

    // --------------------------------------------------------------------

    /**
     * Explode the URI Segments. The individual segments will
     * be returned in an array.
     *
     * @access  private
     * @return  array
     */
    function explode_segments($uri_string)
    {
        $segments = array();
        
        foreach (explode("/", preg_replace("|/*(.+?)/*$|", "\\1", $uri_string)) as $val)
        {
            // Filter segments for security
            $val = trim($this->filter_uri($val));

            if ($val != '')
            {
                $segments[] = $val;
            }
        }
        return $segments;
    }

    /**
     * Filter segments for malicious characters
     *
     * @access  private
     * @param   string
     * @return  string
     */
    function filter_uri($str)
    {
        // preg_quote() in PHP 5.3 escapes -, so the str_replace() and addition of - to preg_quote() is to maintain backwards
        // compatibility as many are unaware of how characters in the permitted_uri_chars will be parsed as a regex pattern
        if ( ! preg_match("|^[".str_replace(array('\\-', '\-'), '-', preg_quote('a-z 0-9~%.:_\-', '-'))."]+$|i", $str))
        {
            show_error('The URI you submitted has disallowed characters.', 400);
        }

        // Convert programatic characters to entities
        $bad    = array('$',        '(',        ')',        '%28',      '%29');
        $good   = array('&#36;',    '&#40;',    '&#41;',    '&#40;',    '&#41;');

        return str_replace($bad, $good, $str);
    }


     /** 
     * This function is the main function that is called when the page loads, 
     * it decides the which action has to be taken for the page. 
     *                                                          
     * return null        
     * @access public 
     */                                                          
    function run( ) 
    {
        $this->preProcess( );
        
        return parent::run( );
    }

    
}