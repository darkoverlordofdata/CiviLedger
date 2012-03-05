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
require_once 'CRM/Core/DAO.php';
require_once 'CRM/Utils/Type.php';
class CRM_Ledger_DAO_LedgerGroup extends CRM_Core_DAO
{
    /**
     * static instance to hold the table name
     *
     * @var string
     * @static
     */
    static $_tableName = 'webzash_groups';
    /**
     * static instance to hold the field values
     *
     * @var array
     * @static
     */
    static $_fields = null;
    /**
     * static instance to hold the FK relationships
     *
     * @var string
     * @static
     */
    static $_links = null;
    /**
     * static instance to hold the values that can
     * be imported / apu
     *
     * @var array
     * @static
     */
    static $_import = null;
    /**
     * static instance to hold the values that can
     * be exported / apu
     *
     * @var array
     * @static
     */
    static $_export = null;
    /**
     * static value to see if we should log any modifications to
     * this table in the civicrm_log table
     *
     * @var boolean
     * @static
     */
    static $_log = true;
    /**
     * Group Id
     *
     * @var int unsigned
     */
    public $id;
    /**
     *
     * @var int unsigned
     */
    public $parent_id;
    /**
     *
     * @var string
     */
    public $name;
    /**
     * Affects Gross
     *
     * @var int unsigned
     */
    public $affects_gross;
    /**
     * class constructor
     *
     * @access public
     * @return webzash_groups
     */
    function __construct()
    {
        parent::__construct();
    }
    /**
     * returns all the column names of this table
     *
     * @access public
     * @return array
     */
    function &fields()
    {
        if (!(self::$_fields)) {
            self::$_fields = array(
                'ledger_group_id' => array(
                    'name' => 'id',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Group ID') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'webzash_groups.id',
                    'headerPattern' => '/^(g(roup\s)?id)$/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'parent_id' => array(
                    'name' => 'parent_id',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Parent ID') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'webzash_groups.parent_id',
                    'headerPattern' => '/parent/i',
                    'dataPattern' => '/^\d+$/',
                    'export' => true,
                ) ,
                'name' => array(
                    'name' => 'name',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Ledger Group Name') ,
                    'required' => true,
                    'maxlength' => 12,
                    'size' => CRM_Utils_Type::TWELVE,
                    'import' => true,
                    'where' => 'webzash_groups.name',
                    'headerPattern' => '/name/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'affects_gross' => array(
                    'name' => 'affects_gross',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Affects Gross') ,
                    'import' => true,
                    'where' => 'webzash_groups.affects_gross',
                    'headerPattern' => '/^(affects)?(gross)$/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
            );
        }
        return self::$_fields;
    }
    /**
     * returns the names of this table
     *
     * @access public
     * @return string
     */
    function getTableName()
    {
        return self::$_tableName;
    }
    /**
     * returns if this table needs to be logged
     *
     * @access public
     * @return boolean
     */
    function getLog()
    {
        return self::$_log;
    }
    /**
     * returns the list of fields that can be imported
     *
     * @access public
     * return array
     */
    function &import($prefix = false)
    {
        if (!(self::$_import)) {
            self::$_import = array();
            $fields = & self::fields();
            foreach($fields as $name => $field) {
                if (CRM_Utils_Array::value('import', $field)) {
                    if ($prefix) {
                        self::$_import['groups'] = & $fields[$name];
                    } else {
                        self::$_import[$name] = & $fields[$name];
                    }
                }
            }
        }
        return self::$_import;
    }
    /**
     * returns the list of fields that can be exported
     *
     * @access public
     * return array
     */
    function &export($prefix = false)
    {
        if (!(self::$_export)) {
            self::$_export = array();
            $fields = & self::fields();
            foreach($fields as $name => $field) {
                if (CRM_Utils_Array::value('export', $field)) {
                    if ($prefix) {
                        self::$_export['groups'] = & $fields[$name];
                    } else {
                        self::$_export[$name] = & $fields[$name];
                    }
                }
            }
        }
        return self::$_export;
    }
}
