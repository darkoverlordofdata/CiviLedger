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
class CRM_Ledger_DAO_LedgerItem extends CRM_Core_DAO
{
    /**
     * static instance to hold the table name
     *
     * @var string
     * @static
     */
    static $_tableName = 'webzash_entry_items';
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
     * Entry Id
     *
     * @var int unsigned
     */
    public $id;
    /**
     * FK to Entry
     *
     * @var int unsigned
     */
    public $entry_id;
    /**
     * FK to Ledger
     *
     * @var int unsigned
     */
    public $ledger_id;
    /**
     * Item amount
     *
     * @var float
     */
    public $amount;
    /**
     * Debit/Credit
     *
     * @var string
     */
    public $dc;
    /**
     * Reconciliation Date
     *
     * @var date
     */
    public $reconciliation_date;
    /**
     * class constructor
     *
     * @access public
     * @return webzash_entry_items
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
                'entry_id' => 'webzash_entries:id',
                'ledger_id' => 'webzash_ledgers:id',
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
                'ledger_item_id' => array(
                    'name' => 'id',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Item ID') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'webzash_entry_items.id',
                    'headerPattern' => '/^(i(tem\s)?id)$/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'ledger_item_entry_id' => array(
                    'name' => 'entry_id',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Entry ID') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'webzash_entry_items.entry_id',
                    'headerPattern' => '/entry(.?id)?/i',
                    'dataPattern' => '/^\d+$/',
                    'export' => true,
                    'FKClassName' => 'CRM_Ledger_DAO_LedgerEntry',
                ) ,
                'ledger_item_ledger_id' => array(
                    'name' => 'ledger_id',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Ledger ID') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'webzash_entry_items.ledger_id',
                    'headerPattern' => '/ledger(.?id)?/i',
                    'dataPattern' => '',
                    'export' => false,
                    'FKClassName' => 'CRM_Ledger_DAO_Ledger',
                ) ,
                'amount' => array(
                    'name' => 'amount',
                    'type' => CRM_Utils_Type::T_MONEY,
                    'title' => ts('Item amount') ,
                    'import' => true,
                    'where' => 'webzash_entry_items.amount',
                    'headerPattern' => '/amount/i',
                    'dataPattern' => '/^\d+(\.\d{2})?$/',
                    'export' => true,
                ) ,
                'dc' => array(
                    'name' => 'dc',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('D/C') ,
                    'maxlength' => 1,
                    'size' => CRM_Utils_Type::TWO,
                    'import' => true,
                    'where' => 'webzash_entry_items.dc',
                    'headerPattern' => '/dc/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'reconciliation_date' => array(
                    'name' => 'reconciliation_date',
                    'type' => CRM_Utils_Type::T_DATE,
                    'title' => ts('Reconciliation Date') ,
                    'import' => true,
                    'where' => 'webzash_entry_items.reconciliation_date',
                    'headerPattern' => '/^reconciliation|(r(econciliation\s)?date)$/i',
                    'dataPattern' => '/\d{4}-?\d{2}-?\d{2}/',
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
                        self::$_import['entry_items'] = & $fields[$name];
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
                        self::$_export['entry_items'] = & $fields[$name];
                    } else {
                        self::$_export[$name] = & $fields[$name];
                    }
                }
            }
        }
        return self::$_export;
    }
}
