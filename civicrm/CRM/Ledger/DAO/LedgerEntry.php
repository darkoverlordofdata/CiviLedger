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
class CRM_Ledger_DAO_LedgerEntry extends CRM_Core_DAO
{
    /**
     * static instance to hold the table name
     *
     * @var string
     * @static
     */
    static $_tableName = 'webzash_entries';
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
     * FK to Tag ID
     *
     * @var int unsigned
     */
    public $tag_id;
    /**
     * FK to Entry Type
     *
     * @var int unsigned
     */
    public $entry_type;
    /**
     * Entry number
     *
     * @var int unsigned
     */
    public $number;
    /**
     * Entry date
     *
     * @var date
     */
    public $date;
    /**
     * Debit total amount
     *
     * @var float
     */
    public $dr_total;
    /**
     * Credit total amount
     *
     * @var float
     */
    public $cr_total;
    /**
     * Narration
     *
     * @var text
     */
    public $narration;
    /**
     * class constructor
     *
     * @access public
     * @return webzash_entries
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
                'tag_id' => 'webzash_tags:id',
                'entry_type' => 'webzash_entry_types:id',
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
                'ledger_entry_id' => array(
                    'name' => 'id',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Entry ID') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'webzash_entries.id',
                    'headerPattern' => '/^(e(ntry\s)?id)$/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'ledger_tag_id' => array(
                    'name' => 'tag_id',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Tag ID') ,
                    'required' => false,
                    'import' => true,
                    'where' => 'webzash_entries.tag_id',
                    'headerPattern' => '/tag(.?id)?/i',
                    'dataPattern' => '/^\d+$/',
                    'export' => true,
                    'FKClassName' => 'CRM_Ledger_DAO_LedgerTag',
                ) ,
                'ledger_entry_type_id' => array(
                    'name' => 'entry_type',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Entry Type') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'webzash_entries.entry_type',
                    'headerPattern' => '/type(.?id)?/i',
                    'dataPattern' => '',
                    'export' => false,
                    'FKClassName' => 'CRM_Ledger_DAO_LedgerType',
                ) ,
                'number' => array(
                    'name' => 'number',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Entry Number') ,
                    'import' => true,
                    'where' => 'webzash_entries.number',
                    'headerPattern' => '/^(entry)?(number)$/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'date' => array(
                    'name' => 'date',
                    'type' => CRM_Utils_Type::T_DATE,
                    'title' => ts('Entry Date') ,
                    'import' => true,
                    'where' => 'webzash_entries.date',
                    'headerPattern' => '/^(entry)?(date)$/i',
                    'dataPattern' => '/\d{4}-?\d{2}-?\d{2}/',
                    'export' => true,
                ) ,
                'dr_total' => array(
                    'name' => 'dr_total',
                    'type' => CRM_Utils_Type::T_MONEY,
                    'title' => ts('Debit total') ,
                    'import' => true,
                    'where' => 'webzash_entries.dr_total',
                    'headerPattern' => '/^(debit)?(total)$/i',
                    'dataPattern' => '/^\d+(\.\d{2})?$/',
                    'export' => true,
                ) ,
                'cr_total' => array(
                    'name' => 'cr_total',
                    'type' => CRM_Utils_Type::T_MONEY,
                    'title' => ts('Credit total') ,
                    'import' => true,
                    'where' => 'webzash_entries.cr_total',
                    'headerPattern' => '/^(credit)?(total)$/i',
                    'dataPattern' => '/^\d+(\.\d{2})?$/',
                    'export' => true,
                ) ,
                'narration' => array(
                    'name' => 'narration',
                    'type' => CRM_Utils_Type::T_TEXT,
                    'title' => ts('Narration') ,
                    'import' => true,
                    'where' => 'webzash_entries.narration',
                    'headerPattern' => '/^(narration)$/i',
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
                        self::$_import['entries'] = & $fields[$name];
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
                        self::$_export['entries'] = & $fields[$name];
                    } else {
                        self::$_export[$name] = & $fields[$name];
                    }
                }
            }
        }
        return self::$_export;
    }
}
