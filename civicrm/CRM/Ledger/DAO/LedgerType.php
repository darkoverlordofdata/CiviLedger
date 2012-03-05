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
class CRM_Ledger_DAO_LedgerType extends CRM_Core_DAO
{
    /**
     * static instance to hold the table name
     *
     * @var string
     * @static
     */
    static $_tableName = 'webzash_entry_types';
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
     * Type Id
     *
     * @var int unsigned
     */
    public $id;
    /**
     *
     * @var string
     */
    public $label;
    /**
     *
     * @var string
     */
    public $name;
    /**
     *
     * @var string
     */
    public $description;
    /**
     * Base Type
     *
     * @var int unsigned
     */
    public $base_type;
    /**
     * Numbering
     *
     * @var int unsigned
     */
    public $numbering;
    /**
     *
     * @var string
     */
    public $prefix;
    /**
     *
     * @var string
     */
    public $suffix;
    /**
     * Zero Padding
     *
     * @var int unsigned
     */
    public $zero_padding;
    /**
     * Restriction
     *
     * @var int unsigned
     */
    public $bank_cash_ledger_restriction;
    /**
     * class constructor
     *
     * @access public
     * @return webzash_entry_types
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
                'ledger_type_id' => array(
                    'name' => 'id',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Item ID') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'webzash_entry_types.id',
                    'headerPattern' => '/^(t(ype\s)?id)$/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'label' => array(
                    'name' => 'label',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Label') ,
                    'required' => true,
                    'maxlength' => 15,
                    'size' => CRM_Utils_Type::TWELVE,
                    'import' => true,
                    'where' => 'webzash_entry_types.label',
                    'headerPattern' => '/label/i',
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
                    'where' => 'webzash_entry_types.name',
                    'headerPattern' => '/name/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'description' => array(
                    'name' => 'description',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('DEescription') ,
                    'required' => true,
                    'maxlength' => 255,
                    'size' => CRM_Utils_Type::HUGE,
                    'import' => true,
                    'where' => 'webzash_entry_types.description',
                    'headerPattern' => '/desc/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'base_type' => array(
                    'name' => 'base_type',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Base Type') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'webzash_entry_types.base_type',
                    'headerPattern' => '/(base)?(type)/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'numbering' => array(
                    'name' => 'numbering',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Numbering') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'webzash_entry_types.numbering',
                    'headerPattern' => '/numbering/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'prefix' => array(
                    'name' => 'prefix',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Prefix') ,
                    'required' => true,
                    'maxlength' => 10,
                    'size' => CRM_Utils_Type::TWELVE,
                    'import' => true,
                    'where' => 'webzash_entry_types.prefix',
                    'headerPattern' => '/prefix/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'suffix' => array(
                    'name' => 'suffix',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Suffix') ,
                    'required' => true,
                    'maxlength' => 10,
                    'size' => CRM_Utils_Type::TWELVE,
                    'import' => true,
                    'where' => 'webzash_entry_types.suffix',
                    'headerPattern' => '/suffix/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'zero_padding' => array(
                    'name' => 'zero_padding',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Zero Padding') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'webzash_entry_types.zero_padding',
                    'headerPattern' => '/padding/i',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'bank_cash_ledger_restriction' => array(
                    'name' => 'bank_cash_ledger_restriction',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Restriction') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'webzash_entry_types.bank_cash_ledger_restriction',
                    'headerPattern' => '/restriction/i',
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
                        self::$_import['entry_types'] = & $fields[$name];
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
                        self::$_export['entry_types'] = & $fields[$name];
                    } else {
                        self::$_export[$name] = & $fields[$name];
                    }
                }
            }
        }
        return self::$_export;
    }
}
