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
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?><?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/
$active_record = TRUE;

/*
| -------------------------------------------------------------------
|   $active_group corresponds to the ledger account
| -------------------------------------------------------------------
*/
$active_group = 'default';

/*
| -------------------------------------------------------------------
|   Use the Jommla! database
| -------------------------------------------------------------------
*/
$conf =& JFactory::getConfig();

/*
| -------------------------------------------------------------------
|   config/accounts/default.ini - $this->load->database('default');
| -------------------------------------------------------------------
*/
$db['default']['hostname'] = $conf->getValue('config.host');
$db['default']['username'] = $conf->getValue('config.user');
$db['default']['password'] = $conf->getValue('config.password');
$db['default']['database'] = $conf->getValue('config.db');
$db['default']['dbdriver'] = $conf->getValue('config.dbtype');
$db['default']['dbprefix'] = 'webzash_';
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

/*
| -------------------------------------------------------------------
|   config/accounts/sample.ini - $this->load->database('sample');
| -------------------------------------------------------------------
*/
$db['sample']['hostname'] = $conf->getValue('config.host');
$db['sample']['username'] = $conf->getValue('config.user');
$db['sample']['password'] = $conf->getValue('config.password');
$db['sample']['database'] = $conf->getValue('config.db');
$db['sample']['dbdriver'] = $conf->getValue('config.dbtype');
$db['sample']['dbprefix'] = 'webzash00_';
$db['sample']['pconnect'] = FALSE;
$db['sample']['db_debug'] = TRUE;
$db['sample']['cache_on'] = FALSE;
$db['sample']['cachedir'] = '';
$db['sample']['char_set'] = 'utf8';
$db['sample']['dbcollat'] = 'utf8_general_ci';
$db['sample']['swap_pre'] = '';
$db['sample']['autoinit'] = TRUE;
$db['sample']['stricton'] = FALSE;

/*
| -------------------------------------------------------------------
|   config/accounts/template.ini - $this->load->database('template');
| -------------------------------------------------------------------
*/
$db['template']['hostname'] = $conf->getValue('config.host');
$db['template']['username'] = $conf->getValue('config.user');
$db['template']['password'] = $conf->getValue('config.password');
$db['template']['database'] = $conf->getValue('config.db');
$db['template']['dbdriver'] = $conf->getValue('config.dbtype');
$db['template']['dbprefix'] = '';
$db['template']['pconnect'] = FALSE;
$db['template']['db_debug'] = TRUE;
$db['template']['cache_on'] = FALSE;
$db['template']['cachedir'] = 'webzash01_';
$db['template']['char_set'] = 'utf8';
$db['template']['dbcollat'] = 'utf8_general_ci';
$db['template']['swap_pre'] = '';
$db['template']['autoinit'] = TRUE;
$db['template']['stricton'] = FALSE;



/* End of file database.php */
/* Location: ./application/config/database.php */