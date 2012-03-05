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
class CRM_Ledger_DAO_LedgerLog extends CRM_Core_DAO
{
    /**
     * static instance to hold the table name
     *
     * @var string
     * @static
     */
    static $_tableName = 'webzash_logs';
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
     *
     * @var int unsigned
     */
    public $id;
    /**
     *
     * @var date
     */
    public $date;
    /**
     *
     * @var int unsigned
     */
    public $level;
    /**
     *
     * @var string
     */
    public $host_ip;
    /**
     *
     * @var string
     */
    public $user;
    /**
     *
     * @var string
     */
    public $url;
    /**
     *
     * @var string
     */
    public $user_agent;
    /**
     *
     * @var string
     */
    public $message_title;
    /**
     *
     * @var mediumtext
     */
    public $message_desc;
    /**
     * class constructor
     *
     * @access public
     * @return webzash_logs
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
                'id' => array(
                    'name' => 'id',
                    'type' => CRM_Utils_Type::T_INT,
                    'required' => true,
                ) ,
                'date' => array(
                    'name' => 'date',
                    'type' => CRM_Utils_Type::T_DATE,
                    'title' => ts('Date') ,
                    'required' => true,
                ) ,
                'level' => array(
                    'name' => 'level',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Level') ,
                    'required' => true,
                ) ,
                'host_ip' => array(
                    'name' => 'host_ip',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Host Ip') ,
                    'maxlength' => 25,
                    'size' => CRM_Utils_Type::MEDIUM,
                ) ,
                'user' => array(
                    'name' => 'user',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('User') ,
                    'maxlength' => 25,
                    'size' => CRM_Utils_Type::MEDIUM,
                ) ,
                'url' => array(
                    'name' => 'url',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Url') ,
                    'maxlength' => 255,
                    'size' => CRM_Utils_Type::HUGE,
                ) ,
                'user_agent' => array(
                    'name' => 'user_agent',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('User Agent') ,
                    'maxlength' => 100,
                    'size' => CRM_Utils_Type::HUGE,
                ) ,
                'message_title' => array(
                    'name' => 'message_title',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Message Title') ,
                    'maxlength' => 255,
                    'size' => CRM_Utils_Type::HUGE,
                ) ,
                'message_desc' => array(
                    'name' => 'message_desc',
                    'type' => CRM_Utils_Type::T_MEDIUMTEXT,
                    'title' => ts('Message Desc') ,
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
                        self::$_import['logs'] = & $fields[$name];
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
                        self::$_export['logs'] = & $fields[$name];
                    } else {
                        self::$_export[$name] = & $fields[$name];
                    }
                }
            }
        }
        return self::$_export;
    }
}
