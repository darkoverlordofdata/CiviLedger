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
 * Hooks
 * 
 * @package Ledger
 * @copyright DarkOverlordOfData (c) 2012
 *
 */
function display_override() {
    
    /*
     *  Divert ths browser output to the CiviCRM template
     */
  
    $CI =& get_instance();
    CRM_Ledger_Page_Dispatch::$instance->assign('civiledger', $CI->output->get_output());

}

