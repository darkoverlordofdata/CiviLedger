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
require_once 'CRM/Ledger/BAO/Ledger.php';

class CRM_Ledger_BAO_ChartOfAccounts {

    var $id = 0;
    var $name = "";
    var $total = 0;
    var $optype = "";
    var $opbalance = 0;
    var $children_groups = array();
    var $children_ledgers = array();
    var $counter = 0;

    function init($id)
    {
        if ($id == CRM_Ledger_BAO_Ledger::ALL) {
            
            $this->id = 0;
            $this->name = "None";
            $this->total = 0;
        } 
        else {
            
            $group = CRM_Core_DAO::executeQuery( 
                        "SELECT  id, name
                           FROM  webzash_groups
                          WHERE  id = $id
                          LIMIT  1", 
                        CRM_Core_DAO::$_nullArray );

                        

            $group->fetch();
            $this->id = $group->id;
            $this->name = $group->name;
            $this->total = 0;
        }
        $this->add_sub_ledgers();
        $this->add_sub_groups();
    }
        
    function add_sub_groups()
    {
        $row = CRM_Core_DAO::executeQuery(
                    "SELECT  id
                       FROM  webzash_groups
                      WHERE  parent_id = " . $this->id,  
                        CRM_Core_DAO::$_nullArray );


        $counter = 0;
        while ($row->fetch()) {

            $this->children_groups[$counter] = new CRM_Ledger_BAO_ChartOfAccounts();
            $this->children_groups[$counter]->init($row->id);
            $this->total = round($this->total + $this->children_groups[$counter]->total, 2);
            $counter++;
        }
        
    }
    
    function add_sub_ledgers()
    {
        $row = CRM_Core_DAO::executeQuery(
                    "SELECT  id, name
                       FROM  webzash_ledgers
                      WHERE  group_id = " . $this->id,  
                        CRM_Core_DAO::$_nullArray );

        $counter = 0;
        while ($row->fetch()) {
            
            $this->children_ledgers[$counter]['id'] = $row->id;
            $this->children_ledgers[$counter]['name'] = $row->name;
            $this->children_ledgers[$counter]['total'] = CRM_Ledger_BAO_Ledger::getLedgerBalance($row->id);
            list ($this->children_ledgers[$counter]['opbalance'], $this->children_ledgers[$counter]['optype']) = CRM_Ledger_BAO_Ledger::getOpBalance($row->id);
            $this->total = round($this->total +  $this->children_ledgers[$counter]['total'], 2);
            $counter++;
        }

    }
   
    
    
        /* Display chart of accounts view */
    function account_st_main($c = 0)
    {
        require_once 'CRM/Utils/Money.php';
        
        $this->counter = $c;
        if ($this->id != 0) {
            
            echo "<tr class=\"tr-group\">";
            echo "<td class=\"td-group\">";
            echo $this->print_space($this->counter);
            if ($this->id <= 4)
                echo "&nbsp;<strong>" .  $this->name. "</strong>";
            else
                echo "&nbsp;" .  $this->name;
            echo "</td>";
            echo "<td>Group Account</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";

            if ($this->id <= 4) {
                echo "<td class=\"td-actions\"></tr>";
            } 
            else {
                
                echo "<td class=\"td-actions\">" . anchor('ledger/group/edit' . $this->id , "Edit", array('title' => 'Edit Group', 'class' => 'red-link'));
                echo " &nbsp;" . anchor('ledger/group/delete' . $this->id, img(array('src' => asset_url() . "Ledger/delete.png", 'border' => '0', 'alt' => 'Delete group')), array('class' => "confirmClick", 'title' => "Delete Group")) . "</td>";

            }
            echo "</tr>";
        }
        foreach ($this->children_groups as $id => $data)
        {
            $this->counter++;
            $data->account_st_main($this->counter);
            $this->counter--;
        }

        if (count($this->children_ledgers) > 0)
        {
            $this->counter++;
            foreach ($this->children_ledgers as $id => $data)
            {
                
                echo "<tr class=\"tr-ledger\">";
                echo "<td class=\"td-ledger\">";
                echo $this->print_space($this->counter);
                echo "&nbsp;" . anchor('ledger/report/ledgerst/' . $data['id'], $data['name'], array('title' => $data['name'] . ' Ledger Statement', 'style' => 'color:#000000'));
                echo "</td>";
                echo "<td>Ledger Account</td>";
                echo "<td>" . convert_opening($data['opbalance'], $data['optype']) . "</td>";
                echo "<td>" . convert_amount_dc($data['total']) . "</td>";
                echo "<td class=\"td-actions\">" . anchor('ledger/edit/' . $data['id'], 'Edit', array('title' => "Edit Ledger", 'class' => 'red-link'));
                echo " &nbsp;" . anchor('ledger/ledger/delete/' . $data['id'], img(array('src' => asset_url() . "Ledger/delete.png", 'border' => '0', 'alt' => 'Delete Ledger')), array('class' => "confirmClick", 'title' => "Delete Ledger")) . "</td>";
                echo "</tr>";

            }
            $this->counter--;
        }
    }

    function print_space($count)
    {
        $html = "";
        for ($i = 1; $i <= $count; $i++)
        {
            $html .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        }
        return $html;
    }
       
}

