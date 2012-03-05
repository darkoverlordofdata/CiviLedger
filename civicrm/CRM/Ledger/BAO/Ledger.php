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
require_once 'CRM/Utils/Money.php';
require_once 'CRM/Ledger/DAO/LedgerSetting.php';

class CRM_Ledger_BAO_Ledger {
    
    const   ALL             = 0,
            ASSETS          = 1,
            LIABILITIES     = 2,
            INCOME          = 3,
            EXPENSE         = 4;
    
    private static $_cfg;
    
    static function getStartDate() {
        self::_init();
        return self::_format_date(self::$_cfg->date_format, self::$_cfg->fy_start);
    }
    
    static function getEndDate() {
        self::_init();
        return self::_format_date(self::$_cfg->date_format, self::$_cfg->fy_end);
    }
    
    static function getCurrency() {
        self::_init();
        return self::$_cfg->currency_symbol;
    }
    
    static function isLocked() {
        self::_init();
        return self::$_cfg->account_locked == 1 ? TRUE : FALSE;
    }

    static function formatAmount($amount)
    {
        self::_init();
        
        return CRM_Utils_Money::format($amount, self::$_cfg->currency_symbol);
    }
    
    static function formatAmountDC($amount)
    {
        self::_init();
        
        if ($amount == "0")
            return "   " . CRM_Utils_Money::format($amount, self::$_cfg->currency_symbol);
        else if ($amount < 0)
            return "Cr " . CRM_Utils_Money::format(-$amount, self::$_cfg->currency_symbol);
        else
            return "Dr " . CRM_Utils_Money::format($amount, self::$_cfg->currency_symbol);
    }

    static function formatOpening($amount, $dc)
    {
        self::_init();

        if ($amount == 0)
            return "   " . CRM_Utils_Money::format($amount, self::$_cfg->currency_symbol);
        else if ($dc == 'D')
            return "Dr " . CRM_Utils_Money::format($amount, self::$_cfg->currency_symbol);
        else
            return "Cr " . CRM_Utils_Money::format($amount, self::$_cfg->currency_symbol);
    }

    static function getLedgerBalance($ledger_id) {
        
        list ($op_bal, $op_bal_type) = self::getOpBalance($ledger_id);

        
        if ($op_bal_type == "C")
            $op_bal = $op_bal * -1;

        $dr_total = self::_get_dr_total($ledger_id);
        $cr_total = self::_get_cr_total($ledger_id);
        
        $total = round($dr_total - $cr_total, 2);
        if ($op_bal_type == "D")
            $total = round($total + $op_bal, 2);
        else
            $total = round($total - $op_bal, 2);

        return $total;
    }

    static function getOpBalance($ledger_id) {

        $row = CRM_Core_DAO::executeQuery( 
                    "SELECT  op_balance, op_balance_dc
                       FROM  webzash_ledgers
                      WHERE  id = $ledger_id
                      LIMIT  1", 
                        CRM_Core_DAO::$_nullArray );
                        
        if ($row->fetch()) {
            return array($row->op_balance, $row->op_balance_dc);
        }
        else {
            return array(0, "D");
        }
    }

    /* Return credit total as positive value */
    private static function _get_cr_total($ledger_id) {

        $row = CRM_Core_DAO::executeQuery(
                    "SELECT  sum(amount) as crtotal
                       FROM  webzash_entry_items
                 INNER JOIN  webzash_entries entries ON (entries.id = webzash_entry_items.entry_id)
                      WHERE  webzash_entry_items.ledger_id = $ledger_id
                        AND  webzash_entry_items.dc = 'C'", 
                        CRM_Core_DAO::$_nullArray );
        
        if ($row->fetch()) {
            return $row->crtotal;
        }
        else {
            return 0;
        }
    }

    /* Return debit total as positive value */
    private static function _get_dr_total($ledger_id) {
        
        $row = CRM_Core_DAO::executeQuery(
                    "SELECT  sum(amount) as drtotal
                       FROM  webzash_entry_items
                 INNER JOIN  webzash_entries entries ON (entries.id = webzash_entry_items.entry_id)
                      WHERE  webzash_entry_items.ledger_id = $ledger_id
                        AND  webzash_entry_items.dc = 'D'", 
                        CRM_Core_DAO::$_nullArray );
        
        if ($row->fetch()) {
            return $row->drtotal;
        }
        else {
            return 0;
        }
    }
    
    private static function _init() {

        //  Get ledger settings
        if (!isset($_cfg)) {
            self::$_cfg = new CRM_Ledger_DAO_LedgerSetting();
            self::$_cfg->get('id', 1);
        }
    }
    
    
    private static function _format_date($fmt, $value) {
    
        $y = substr($value, 0, 4);
        $m = substr($value, 5, 2);
        $d = substr($value, 8, 2);
        switch ($fmt)
        {
            case 'dd/mm/yyyy':
                return "$d/$m/$y";
                break;
            case 'mm/dd/yyyy':
                return "$m/$d/$y";
                break;
            case 'yyyy/mm/dd':
                return "$y/$m/$d";
                break;
            default:
                return $value;
        }
    }    
    
        
}