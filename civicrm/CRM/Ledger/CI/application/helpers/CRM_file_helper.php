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
?><?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------
/**
 *  Write Ini File - write a configuration file 
 * 
 * 
 * @access  public
 * @param   array  an associative as returned by parse_ini_file.
 * @param   string  The filename of the ini file being parsed.
 * @param   boolean If TRUE, section names are used.
 * @return  TRUE if sucess.
 * 
 *  
 */
if ( ! function_exists('write_ini_file'))
{


    function write_ini_file($settings, $filename, $process_sections=FALSE) { 
        $content = ""; 
        if ($process_sections) { 
            foreach ($settings as $key=>$elem) { 
                $content .= "[".$key."]\n"; 
                foreach ($elem as $key2=>$elem2) { 
                    if(is_array($elem2)) 
                    { 
                        for($i=0;$i<count($elem2);$i++) 
                        { 
                            $content .= $key2."[] = \"".$elem2[$i]."\"\n"; 
                        } 
                    } 
                    else if($elem2=="") $content .= $key2." = \n"; 
                    else $content .= $key2." = \"".$elem2."\"\n"; 
                } 
            } 
        } 
        else { 
            foreach ($settings as $key=>$elem) { 
                if(is_array($elem)) 
                { 
                    for($i=0;$i<count($elem);$i++) 
                    { 
                        $content .= $key."[] = \"".$elem[$i]."\"\n"; 
                    } 
                } 
                else if($elem=="") $content .= $key." = \n"; 
                else $content .= $key." = \"".$elem."\"\n"; 
            } 
        } 
    
        if (!$handle = fopen($filename, 'w')) { 
            return false; 
        } 
        if (!fwrite($handle, $content)) {
            fclose($handle); 
            return false; 
        } 
        fclose($handle); 
        return true; 
    }
}