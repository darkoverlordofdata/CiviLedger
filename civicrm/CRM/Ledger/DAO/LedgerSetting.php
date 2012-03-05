<?php
/*
+--------------------------------------------------------------------+
| CiviCRM version 3.4                                                |
+--------------------------------------------------------------------+
| Copyright CiviCRM LLC (c) 2004-2011                                |
+--------------------------------------------------------------------+
| This file is a part of CiviCRM.                                    |
|                                                                    |
| CiviCRM is free software; you can copy, modify, and distribute it  |
| under the terms of the GNU Affero General Public License           |
| Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
|                                                                    |
| CiviCRM is distributed in the hope that it will be useful, but     |
| WITHOUT ANY WARRANTY; without even the implied warranty of         |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
| See the GNU Affero General Public License for more details.        |
|                                                                    |
| You should have received a copy of the GNU Affero General Public   |
| License and the CiviCRM Licensing Exception along                  |
| with this program; if not, contact CiviCRM LLC                     |
| at info[AT]civicrm[DOT]org. If you have questions about the        |
| GNU Affero General Public License or the licensing of CiviCRM,     |
| see the CiviCRM license FAQ at http://civicrm.org/licensing        |
+--------------------------------------------------------------------+
*/
/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2011
 * $Id$
 *
 */
require_once 'CRM/Core/DAO.php';
require_once 'CRM/Utils/Type.php';
class CRM_Ledger_DAO_LedgerSetting extends CRM_Core_DAO
{
    /**
     * static instance to hold the table name
     *
     * @var string
     * @static
     */
    static $_tableName = 'webzash_settings';
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
     * @var string
     */
    public $name;
    /**
     *
     * @var string
     */
    public $address;
    /**
     *
     * @var string
     */
    public $email;
    /**
     * Fiscal year start date
     *
     * @var date
     */
    public $fy_start;
    /**
     * Fiscal year end date
     *
     * @var date
     */
    public $fy_end;
    /**
     *
     * @var string
     */
    public $currency_symbol;
    /**
     *
     * @var string
     */
    public $date_format;
    /**
     *
     * @var string
     */
    public $timezone;
    /**
     * Manage Inventory
     *
     * @var int unsigned
     */
    public $manage_inventory;
    /**
     * Account Locked
     *
     * @var int unsigned
     */
    public $account_locked;
    /**
     *
     * @var string
     */
    public $email_protocol;
    /**
     *
     * @var string
     */
    public $email_host;
    /**
     * Email Port
     *
     * @var int unsigned
     */
    public $email_port;
    /**
     *
     * @var string
     */
    public $email_username;
    /**
     *
     * @var string
     */
    public $email_password;
    /**
     *
     * @var float
     */
    public $print_paper_height;
    /**
     *
     * @var float
     */
    public $print_paper_width;
    /**
     *
     * @var float
     */
    public $print_margin_top;
    /**
     *
     * @var float
     */
    public $print_margin_bottom;
    /**
     *
     * @var float
     */
    public $print_margin_left;
    /**
     *
     * @var float
     */
    public $print_margin_right;
    /**
     *
     * @var string
     */
    public $print_orientation;
    /**
     *
     * @var string
     */
    public $print_page_format;
    /**
     *
     * @var int unsigned
     */
    public $database_version;
    /**
     * class constructor
     *
     * @access public
     * @return webzash_settings
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
                'ledger_setting_id' => array(
                    'name' => 'id',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Group ID') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'webzash_settings.id',
                    'headerPattern' => '/^(g(roup\s)?id)$/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'name' => array(
                    'name' => 'name',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Name') ,
                    'required' => true,
                    'maxlength' => 100,
                    'size' => CRM_Utils_Type::HUGE,
                    'import' => true,
                    'where' => 'webzash_settings.name',
                    'headerPattern' => '/name/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'address' => array(
                    'name' => 'address',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Address') ,
                    'required' => true,
                    'maxlength' => 255,
                    'size' => CRM_Utils_Type::HUGE,
                    'import' => true,
                    'where' => 'webzash_settings.address',
                    'headerPattern' => '/address/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'email' => array(
                    'name' => 'email',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Email') ,
                    'required' => true,
                    'maxlength' => 100,
                    'size' => CRM_Utils_Type::HUGE,
                    'import' => true,
                    'where' => 'webzash_settings.email',
                    'headerPattern' => '/email/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'fy_start' => array(
                    'name' => 'fy_start',
                    'type' => CRM_Utils_Type::T_DATE,
                    'title' => ts('FY Start') ,
                    'import' => true,
                    'where' => 'webzash_settings.fy_start',
                    'headerPattern' => '/^(start)?(date)$/i',
                    'dataPattern' => '/\d{4}-?\d{2}-?\d{2}/',
                    'export' => true,
                ) ,
                'fy_end' => array(
                    'name' => 'fy_end',
                    'type' => CRM_Utils_Type::T_DATE,
                    'title' => ts('FY End') ,
                    'import' => true,
                    'where' => 'webzash_settings.fy_end',
                    'headerPattern' => '/^(end)?(date)$/i',
                    'dataPattern' => '/\d{4}-?\d{2}-?\d{2}/',
                    'export' => true,
                ) ,
                'currency_symbol' => array(
                    'name' => 'currency_symbol',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Currency Symbol') ,
                    'required' => true,
                    'maxlength' => 10,
                    'size' => CRM_Utils_Type::TWELVE,
                    'import' => true,
                    'where' => 'webzash_settings.currency_symbol',
                    'headerPattern' => '/currency/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'date_format' => array(
                    'name' => 'date_format',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Date Format') ,
                    'required' => true,
                    'maxlength' => 30,
                    'size' => CRM_Utils_Type::MEDIUM,
                    'import' => true,
                    'where' => 'webzash_settings.date_format',
                    'headerPattern' => '/format/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'timezone' => array(
                    'name' => 'timezone',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Timezone') ,
                    'required' => true,
                    'maxlength' => 255,
                    'size' => CRM_Utils_Type::HUGE,
                    'import' => true,
                    'where' => 'webzash_settings.timezone',
                    'headerPattern' => '/timezone/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'manage_inventory' => array(
                    'name' => 'manage_inventory',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Manage Inventory') ,
                    'import' => true,
                    'where' => 'webzash_settings.manage_inventory',
                    'headerPattern' => '/inventory/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'account_locked' => array(
                    'name' => 'account_locked',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Account Locked') ,
                    'import' => true,
                    'where' => 'webzash_settings.account_locked',
                    'headerPattern' => '/locked/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'email_protocol' => array(
                    'name' => 'email_protocol',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Email Protocol') ,
                    'required' => true,
                    'maxlength' => 9,
                    'size' => CRM_Utils_Type::TWELVE,
                    'import' => true,
                    'where' => 'webzash_settings.email_protocol',
                    'headerPattern' => '/protocol/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'email_host' => array(
                    'name' => 'email_host',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Email Host') ,
                    'required' => true,
                    'maxlength' => 255,
                    'size' => CRM_Utils_Type::HUGE,
                    'import' => true,
                    'where' => 'webzash_settings.email_host',
                    'headerPattern' => '/host/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'email_port' => array(
                    'name' => 'email_port',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Email Port') ,
                    'import' => true,
                    'where' => 'webzash_settings.email_port',
                    'headerPattern' => '/port/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'email_username' => array(
                    'name' => 'email_username',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Email Username') ,
                    'required' => true,
                    'maxlength' => 255,
                    'size' => CRM_Utils_Type::HUGE,
                    'import' => true,
                    'where' => 'webzash_settings.email_username',
                    'headerPattern' => '/username/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'email_password' => array(
                    'name' => 'email_password',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Email Password') ,
                    'required' => true,
                    'maxlength' => 255,
                    'size' => CRM_Utils_Type::HUGE,
                    'import' => true,
                    'where' => 'webzash_settings.email_password',
                    'headerPattern' => '/password/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'print_paper_height' => array(
                    'name' => 'print_paper_height',
                    'type' => CRM_Utils_Type::T_FLOAT,
                    'title' => ts('Print Paper Height') ,
                    'import' => true,
                    'where' => 'webzash_settings.print_paper_height',
                    'headerPattern' => '/height/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'print_paper_width' => array(
                    'name' => 'print_paper_width',
                    'type' => CRM_Utils_Type::T_FLOAT,
                    'title' => ts('Print Paper width') ,
                    'import' => true,
                    'where' => 'webzash_settings.print_paper_width',
                    'headerPattern' => '/width/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'print_margin_top' => array(
                    'name' => 'print_margin_top',
                    'type' => CRM_Utils_Type::T_FLOAT,
                    'title' => ts('Print Margin Top') ,
                    'import' => true,
                    'where' => 'webzash_settings.print_margin_top',
                    'headerPattern' => '/top/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'print_margin_bottom' => array(
                    'name' => 'print_margin_bottom',
                    'type' => CRM_Utils_Type::T_FLOAT,
                    'title' => ts('Print Margin Bottom') ,
                    'import' => true,
                    'where' => 'webzash_settings.print_margin_bottom',
                    'headerPattern' => '/bottom/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'print_margin_left' => array(
                    'name' => 'print_margin_left',
                    'type' => CRM_Utils_Type::T_FLOAT,
                    'title' => ts('Print Margin Left') ,
                    'import' => true,
                    'where' => 'webzash_settings.print_margin_left',
                    'headerPattern' => '/left/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'print_margin_right' => array(
                    'name' => 'print_margin_right',
                    'type' => CRM_Utils_Type::T_FLOAT,
                    'title' => ts('Print Margin Right') ,
                    'import' => true,
                    'where' => 'webzash_settings.print_margin_right',
                    'headerPattern' => '/right/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'print_orientation' => array(
                    'name' => 'print_orientation',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Print Orientation') ,
                    'required' => true,
                    'maxlength' => 1,
                    'size' => CRM_Utils_Type::TWO,
                    'import' => true,
                    'where' => 'webzash_settings.print_orientation',
                    'headerPattern' => '/orientation/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'print_page_format' => array(
                    'name' => 'print_page_format',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Print Page Format') ,
                    'required' => true,
                    'maxlength' => 1,
                    'size' => CRM_Utils_Type::TWO,
                    'import' => true,
                    'where' => 'webzash_settings.print_page_format',
                    'headerPattern' => '/format/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'database_version' => array(
                    'name' => 'database_version',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Database Version') ,
                    'import' => true,
                    'where' => 'webzash_settings.database_version',
                    'headerPattern' => '/version/i',
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
                        self::$_import['settings'] = & $fields[$name];
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
                        self::$_export['settings'] = & $fields[$name];
                    } else {
                        self::$_export[$name] = & $fields[$name];
                    }
                }
            }
        }
        return self::$_export;
    }
}
