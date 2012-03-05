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
class CRM_Ledger_DAO_Ledger extends CRM_Core_DAO
{
    /**
     * static instance to hold the table name
     *
     * @var string
     * @static
     */
    static $_tableName = 'webzash_ledgers';
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
     * Ledger Id
     *
     * @var int unsigned
     */
    public $id;
    /**
     * FK to Group ID
     *
     * @var int unsigned
     */
    public $group_id;
    /**
     *
     * @var string
     */
    public $name;
    /**
     * Opening ledger balance
     *
     * @var float
     */
    public $op_balance;
    /**
     * Opening ledger balance debit or credit (d/c)
     *
     * @var string
     */
    public $op_balance_dc;
    /**
     * Bank or Cash Account
     *
     * @var int unsigned
     */
    public $type;
    /**
     * Reconciliation Account
     *
     * @var int unsigned
     */
    public $reconciliation;
    /**
     * class constructor
     *
     * @access public
     * @return webzash_ledgers
     */
    function __construct()
    {
        parent::__construct();
    }
    /**
     * return foreign links
     *
     * @access public
     * @return array
     */
    function &links()
    {
        if (!(self::$_links)) {
            self::$_links = array(
                'group_id' => 'webzash_groups:id',
            );
        }
        return self::$_links;
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
                'ledger_id' => array(
                    'name' => 'id',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Ledger ID') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'webzash_ledgers.id',
                    'headerPattern' => '/^(l(edger\s)?id)$/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'ledger_group_id' => array(
                    'name' => 'group_id',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Group ID') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'webzash_ledgers.group_id',
                    'headerPattern' => '/^(group)?(id)$/i',
                    'dataPattern' => '/^\d+$/',
                    'export' => true,
                    'FKClassName' => 'CRM_Ledger_DAO_LedgerGroup',
                ) ,
                'name' => array(
                    'name' => 'name',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Ledger Name') ,
                    'required' => true,
                    'maxlength' => 100,
                    'size' => CRM_Utils_Type::HUGE,
                    'import' => true,
                    'where' => 'webzash_ledgers.name',
                    'headerPattern' => '/^(ledger)?(name)$/i',
                    'dataPattern' => '',
                    'export' => false,
                ) ,
                'op_balance' => array(
                    'name' => 'op_balance',
                    'type' => CRM_Utils_Type::T_MONEY,
                    'title' => ts('Opening Balance') ,
                    'import' => true,
                    'where' => 'webzash_ledgers.op_balance',
                    'headerPattern' => '/^(opening)?(balance)$/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'op_balance_dc' => array(
                    'name' => 'op_balance_dc',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Opening Balance DC') ,
                    'maxlength' => 1,
                    'size' => CRM_Utils_Type::TWO,
                    'import' => true,
                    'where' => 'webzash_ledgers.op_balance_dc',
                    'headerPattern' => '/^(opening)?(balance)$/i',
                    'dataPattern' => '/^\d+(\.\d{2})?$/',
                    'export' => true,
                ) ,
                'type' => array(
                    'name' => 'type',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Ledger Type') ,
                    'import' => true,
                    'where' => 'webzash_ledgers.type',
                    'headerPattern' => '/^(ledger)?(type)$/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'reconciliation' => array(
                    'name' => 'reconciliation',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Reconciliation') ,
                    'import' => true,
                    'where' => 'webzash_ledgers.reconciliation',
                    'headerPattern' => '/^(reconciliation)$/i',
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
                        self::$_import['ledgers'] = & $fields[$name];
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
                        self::$_export['ledgers'] = & $fields[$name];
                    } else {
                        self::$_export[$name] = & $fields[$name];
                    }
                }
            }
        }
        return self::$_export;
    }
}
