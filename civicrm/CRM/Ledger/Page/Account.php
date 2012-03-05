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
 * This page is for Case Dashboard
 */
class CRM_Ledger_Page_Account extends CRM_Core_Page 
{
    /** 
     * CoA Listing
     * 
     * @return void 
     * @access public 
     * 
     */
    
    function preProcess( ) 
    {
        $segments = array('account');
        require 'CRM/Ledger/CI/start.php';
        return;
        
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