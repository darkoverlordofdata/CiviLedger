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
 *  * This class introduces component to the system and provides all the 
 * information about it. It needs to extend CRM_Core_Component_Info
 * abstract class.
 */ 
/* @package Ledger
 * @copyright DarkOverlordOfData (c) 2012
 *
 */

require_once 'CRM/Core/Component/Info.php';

class CRM_Ledger_Info extends CRM_Core_Component_Info
{

    // docs inherited from interface
    protected $keyword = 'donor';

    // docs inherited from interface
    public function getInfo()
    {
        return array( 'name'                 => 'CiviLedger',
                      'translatedName'       => ts('CiviLedger'),
                      'title'                => 'CiviCRM Ledger Engine',
                      'search'               => 0,
                      'showActivitiesInCore' => 1 
                      );
    }


    // docs inherited from interface
    public function getPermissions()
    {
    	return;

    }


    // docs inherited from interface
    public function getUserDashboardElement()
    {
        // no dashboard element for this component
        return null;
    }

    public function getUserDashboardObject( )
    {
        // no dashboard element for this component
        return null;
    }
    
    // docs inherited from interface  
    public function registerTab()
    {
        // this component doesn't use contact record tabs
        return null;
    }
    
    // docs inherited from interface  
    public function registerAdvancedSearchPane()
    {
        // this component doesn't use advanced search
        return null;
    }    
    
    // docs inherited from interface    
    public function getActivityTypes()
    {
        return null;
    }

    // add shortcut to Create New
    public function creatNewShortcut( &$shortCuts ) {
    }
    
}
