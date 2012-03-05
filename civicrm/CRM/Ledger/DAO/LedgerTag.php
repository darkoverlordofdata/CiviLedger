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
class CRM_Ledger_DAO_LedgerTag extends CRM_Core_DAO
{
    /**
     * static instance to hold the table name
     *
     * @var string
     * @static
     */
    static $_tableName = 'webzash_tags';
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
     * Tag Id
     *
     * @var int unsigned
     */
    public $id;
    /**
     *
     * @var string
     */
    public $title;
    /**
     *
     * @var string
     */
    public $color;
    /**
     *
     * @var string
     */
    public $background;
    /**
     * class constructor
     *
     * @access public
     * @return webzash_tags
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
                'ledger_tag_id' => array(
                    'name' => 'id',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Tag ID') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'webzash_tags.id',
                    'headerPattern' => '/^(t(ag\s)?id)$/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'title' => array(
                    'name' => 'title',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Title') ,
                    'required' => true,
                    'maxlength' => 50,
                    'size' => CRM_Utils_Type::BIG,
                    'import' => true,
                    'where' => 'webzash_tags.title',
                    'headerPattern' => '/title/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'color' => array(
                    'name' => 'color',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Color') ,
                    'required' => true,
                    'maxlength' => 6,
                    'size' => CRM_Utils_Type::EIGHT,
                    'import' => true,
                    'where' => 'webzash_tags.color',
                    'headerPattern' => '/color/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'background' => array(
                    'name' => 'background',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Background') ,
                    'required' => true,
                    'maxlength' => 6,
                    'size' => CRM_Utils_Type::EIGHT,
                    'import' => true,
                    'where' => 'webzash_tags.background',
                    'headerPattern' => '/background/i',
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
                        self::$_import['tags'] = & $fields[$name];
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
                        self::$_export['tags'] = & $fields[$name];
                    } else {
                        self::$_export[$name] = & $fields[$name];
                    }
                }
            }
        }
        return self::$_export;
    }
}
