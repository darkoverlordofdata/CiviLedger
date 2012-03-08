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

class Ledger extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Ledger_model');
        $this->load->model('Group_model');
        return;
    }

    function index()
    {
        redirect('ledger/add');
        return;
    }

    function add()
    {
        $this->template->set('page_title', 'New Ledger');

        /* Check access */
        if ( ! check_access('create ledger'))
        {
            $this->messages->add('Permission denied.', 'error');
            redirect('account');
            return;
        }

        /* Check for account lock */
        if ($this->config->item('account_locked') == 1)
        {
            $this->messages->add('Account is locked.', 'error');
            redirect('account');
            return;
        }

        /* Form fields */
        $data['ledger_id'] = array(
            'name' => 'ledger_id',
            'id' => 'ledger_id',
            'maxlength' => '10',
            'size' => '10',
            'value' => '',
        );
        $data['ledger_name'] = array(
            'name' => 'ledger_name',
            'id' => 'ledger_name',
            'maxlength' => '100',
            'size' => '40',
            'value' => '',
        );
        $data['ledger_group_id'] = $this->Group_model->get_ledger_groups();
        $data['op_balance'] = array(
            'name' => 'op_balance',
            'id' => 'op_balance',
            'maxlength' => '15',
            'size' => '15',
            'value' => '',
        );
        $data['ledger_group_active'] = 0;
        $data['op_balance_dc'] = "D";
        $data['ledger_type_cashbank'] = FALSE;
        $data['reconciliation'] = FALSE;
        $data['form990'] = array(
            'name' => 'form990',
            'id' => 'form990',
            'maxlength' => '20',
            'size' => '20',
            'value' => '',
        );
        $data['form990ez'] = array(
            'name' => 'form990ez',
            'id' => 'form990ez',
            'maxlength' => '20',
            'size' => '20',
            'value' => '',
        );
        $data['omba122'] = array(
            'name' => 'omba122',
            'id' => 'omba122',
            'maxlength' => '20',
            'size' => '20',
            'value' => '',
        );

        /* Form validations */
        $this->form_validation->set_rules('ledger_id', 'Ledger id', 'trim|required|min_length[3]|max_length[10]|');
        $this->form_validation->set_rules('ledger_name', 'Ledger name', 'trim|required|min_length[2]|max_length[100]|unique[ledgers.name]');
        $this->form_validation->set_rules('ledger_group_id', 'Parent group', 'trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('op_balance', 'Opening balance', 'trim|currency');
        $this->form_validation->set_rules('op_balance_dc', 'Opening balance type', 'trim|required|is_dc');

        /* Re-populating form */
        if ($_POST)
        {
            $data['ledger_id']['value'] = $this->input->post('ledger_id', TRUE);
            $data['ledger_name']['value'] = $this->input->post('ledger_name', TRUE);
            $data['op_balance']['value'] = $this->input->post('op_balance', TRUE);
            $data['ledger_group_active'] = $this->input->post('ledger_group_id', TRUE);
            $data['op_balance_dc'] = $this->input->post('op_balance_dc', TRUE);
            $data['ledger_type_cashbank'] = $this->input->post('ledger_type_cashbank', TRUE);
            $data['reconciliation'] = $this->input->post('reconciliation', TRUE);
            $data['form990']['value'] = $this->input->post('form990', TRUE);
            $data['form990ez']['value'] = $this->input->post('form990ez', TRUE);
            $data['omba122']['value'] = $this->input->post('omba122', TRUE);
        }

        if ($this->form_validation->run() == FALSE)
        {
            $this->messages->add(validation_errors(), 'error');
            $this->template->load('template', 'ledger/add', $data);
            return;
        }
        else
        {
            $data_id = $this->input->post('ledger_id', TRUE);
            $data_name = $this->input->post('ledger_name', TRUE);
            $data_group_id = $this->input->post('ledger_group_id', TRUE);
            $data_op_balance = $this->input->post('op_balance', TRUE);
            $data_op_balance_dc = $this->input->post('op_balance_dc', TRUE);
            $data_ledger_type_cashbank_value = $this->input->post('ledger_type_cashbank', TRUE);
            $data_reconciliation = $this->input->post('reconciliation', TRUE);
            $data_form990 = $this->input->post('form990', TRUE);
            $data_form990ez = $this->input->post('form990ez', TRUE);
            $data_omba122 = $this->input->post('omba122', TRUE);

            if ($data_group_id < 5)
            {
                $this->messages->add('Invalid Parent group.', 'error');
                $this->template->load('template', 'ledger/add', $data);
                return;
            }

            /* Check if parent group id present */
            $this->db->select('id')->from('groups')->where('id', $data_group_id);
            if ($this->db->get()->num_rows() < 1)
            {
                $this->messages->add('Invalid Parent group.', 'error');
                $this->template->load('template', 'ledger/add', $data);
                return;
            }

            if ($data_ledger_type_cashbank_value == "1")
            {
                $data_ledger_type = 1;
            } else {
                $data_ledger_type = 0;
            }

            if ($data_reconciliation == "1")
            {
                $data_reconciliation = 1;
            } else {
                $data_reconciliation = 0;
            }

            $this->db->trans_start();
            $insert_data = array(
                'id' => $data_id, 
                'name' => $data_name,
                'group_id' => $data_group_id,
                'op_balance' => $data_op_balance,
                'op_balance_dc' => $data_op_balance_dc,
                'type' => $data_ledger_type,
                'reconciliation' => $data_reconciliation,
                'form990' => $data_form990, 
                'form990ez' => $data_form990ez, 
                'omba122' => $data_omba122, 
            );
            if ( ! $this->db->insert('ledgers', $insert_data))
            {
                $this->db->trans_rollback();
                $this->messages->add('Error addding Ledger account - ' . $data_name . '.', 'error');
                $this->logger->write_message("error", "Error adding Ledger account called " . $data_name);
                $this->template->load('template', 'group/add', $data);
                return;
            } else {
                $this->db->trans_complete();
                $this->messages->add('Added Ledger account - ' . $data_name . '.', 'success');
                $this->logger->write_message("success", "Added Ledger account called " . $data_name);
                redirect('account');
                return;
            }
        }
        return;
    }

    function edit($id)
    {
        $this->template->set('page_title', 'Edit Ledger');

        /* Check access */
        if ( ! check_access('edit ledger'))
        {
            $this->messages->add('Permission denied.', 'error');
            redirect('account');
            return;
        }

        /* Check for account lock */
        if ($this->config->item('account_locked') == 1)
        {
            $this->messages->add('Account is locked.', 'error');
            redirect('account');
            return;
        }

        /* Checking for valid data */
        //$id = $this->input->xss_clean($id);
        $id = (int)$id;
        if ($id < 1)
        {
            $this->messages->add('Invalid Ledger account.', 'error');
            redirect('account');
            return;
        }

        /* Loading current group */
        $this->db->from('ledgers')->where('id', $id);
        $ledger_data_q = $this->db->get();
        if ($ledger_data_q->num_rows() < 1)
        {
            $this->messages->add('Invalid Ledger account.', 'error');
            redirect('account');
            return;
        }
        $ledger_data = $ledger_data_q->row();

        /* Form fields */
        $data['ledger_id'] = array(
            'name' => 'ledger_id',
            'id' => 'ledger_id',
            'maxlength' => '10',
            'size' => '10',
            'value' => $ledger_data->id,
        );
        $data['ledger_name'] = array(
            'name' => 'ledger_name',
            'id' => 'ledger_name',
            'maxlength' => '100',
            'size' => '40',
            'value' => $ledger_data->name,
        );
        $data['ledger_group_id'] = $this->Group_model->get_ledger_groups();
        $data['op_balance'] = array(
            'name' => 'op_balance',
            'id' => 'op_balance',
            'maxlength' => '15',
            'size' => '15',
            'value' => $ledger_data->op_balance,
        );
        $data['ledger_group_active'] = $ledger_data->group_id;
        $data['op_balance_dc'] = $ledger_data->op_balance_dc;
        if ($ledger_data->type == 1)
            $data['ledger_type_cashbank'] = TRUE;
        else
            $data['ledger_type_cashbank'] = FALSE;
        $data['reconciliation'] = $ledger_data->reconciliation;
        $data['form990'] = array(
            'name' => 'form990',
            'id' => 'form990',
            'maxlength' => '20',
            'size' => '20',
            'value' => $ledger_data->form990,
        );
        $data['form990ez'] = array(
            'name' => 'form990ez',
            'id' => 'form990ez',
            'maxlength' => '20',
            'size' => '20',
            'value' => $ledger_data->form990ez,
        );
        $data['omba122'] = array(
            'name' => 'omba122',
            'id' => 'omba122',
            'maxlength' => '20',
            'size' => '20',
            'value' => $ledger_data->omba122,
        );
        

        /* Form validations */
        $this->form_validation->set_rules('ledger_id', 'Ledger id', 'trim|required|min_length[3]|max_length[10]|');
        $this->form_validation->set_rules('ledger_name', 'Ledger name', 'trim|required|min_length[2]|max_length[100]|uniquewithid[ledgers.name.' . $id . ']');
        $this->form_validation->set_rules('ledger_group_id', 'Parent group', 'trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('op_balance', 'Opening balance', 'trim|currency');
        $this->form_validation->set_rules('op_balance_dc', 'Opening balance type', 'trim|required|is_dc');

        /* Re-populating form */
        if ($_POST)
        {
            $data['ledger_id']['value'] = $this->input->post('ledger_id', TRUE);
            $data['ledger_name']['value'] = $this->input->post('ledger_name', TRUE);
            $data['ledger_group_active'] = $this->input->post('ledger_group_id', TRUE);
            $data['op_balance']['value'] = $this->input->post('op_balance', TRUE);
            $data['op_balance_dc'] = $this->input->post('op_balance_dc', TRUE);
            $data['ledger_type_cashbank'] = $this->input->post('ledger_type_cashbank', TRUE);
            $data['reconciliation'] = $this->input->post('reconciliation', TRUE);
            $data['form990']['value'] = $this->input->post('form990', TRUE);
            $data['form990ez']['value'] = $this->input->post('form990ez', TRUE);
            $data['omba122']['value'] = $this->input->post('omba122', TRUE);
        }

        if ($this->form_validation->run() == FALSE)
        {
            $this->messages->add(validation_errors(), 'error');
            $this->template->load('template', 'ledger/edit', $data);
            return;
        }
        else
        {
            $data_id = $this->input->post('ledger_id', TRUE);
            $data_name = $this->input->post('ledger_name', TRUE);
            $data_group_id = $this->input->post('ledger_group_id', TRUE);
            $data_op_balance = $this->input->post('op_balance', TRUE);
            $data_op_balance_dc = $this->input->post('op_balance_dc', TRUE);
            $data_id = $id;
            $data_ledger_type_cashbank_value = $this->input->post('ledger_type_cashbank', TRUE);
            $data_reconciliation = $this->input->post('reconciliation', TRUE);
            $data_form990 = $this->input->post('form990', TRUE);
            $data_form990ez = $this->input->post('form990ez', TRUE);
            $data_omba122 = $this->input->post('omba122', TRUE);

            if ($data_group_id < 5)
            {
                $this->messages->add('Invalid Parent group.', 'error');
                $this->template->load('template', 'ledger/edit', $data);
                return;
            }

            /* Check if parent group id present */
            $this->db->select('id')->from('groups')->where('id', $data_group_id);
            if ($this->db->get()->num_rows() < 1)
            {
                $this->messages->add('Invalid Parent group.', 'error');
                $this->template->load('template', 'ledger/edit', $data);
                return;
            }

            /* Check if bank_cash_ledger_restriction both entry present */
            if ($data_ledger_type_cashbank_value != "1")
            {
                $entry_type_all = $this->config->item('account_entry_types');
                foreach ($entry_type_all as $entry_type_id => $row)
                {
                    /* Check for Entry types where bank_cash_ledger_restriction is for all ledgers */
                    if ($row['bank_cash_ledger_restriction'] == 4)
                    {
                        $this->db->from('entry_items')->join('entries', 'entry_items.entry_id = entries.id')->where('entries.entry_type', $entry_type_id)->where('entry_items.ledger_id', $id);
                        $all_ledger_bank_cash_count = $this->db->get()->num_rows();
                        if ($all_ledger_bank_cash_count > 0)
                        {
                            $this->messages->add('Cannot remove the Bank or Cash Account status of this Ledger account since it is still linked with ' . $all_ledger_bank_cash_count . ' ' . $row['name'] . ' entries.', 'error');
                            $this->template->load('template', 'ledger/edit', $data);
                            return;
                        }
                    }
                }
            }

            if ($data_ledger_type_cashbank_value == "1")
            {
                $data_ledger_type = 1;
            } else {
                $data_ledger_type = 0;
            }

            if ($data_reconciliation == "1")
            {
                $data_reconciliation = 1;
            } else {
                $data_reconciliation = 0;
            }

            $this->db->trans_start();
            $update_data = array(
                'id' => $data_id, 
                'name' => $data_name,
                'group_id' => $data_group_id,
                'op_balance' => $data_op_balance,
                'op_balance_dc' => $data_op_balance_dc,
                'type' => $data_ledger_type,
                'reconciliation' => $data_reconciliation,
                'form990' => $data_form990, 
                'form990ez' => $data_form990ez, 
                'omba122' => $data_omba122, 
            );
            if ( ! $this->db->where('id', $data_id)->update('ledgers', $update_data))
            {
                $this->db->trans_rollback();
                $this->messages->add('Error updating Ledger account - ' . $data_name . '.', 'error');
                $this->logger->write_message("error", "Error updating Ledger account called " . $data_name . " [id:" . $data_id . "]");
                $this->template->load('template', 'ledger/edit', $data);
                return;
            } else {
                /* Deleting reconciliation data if reconciliation disabled */
                if (($ledger_data->reconciliation == 1) AND ($data_reconciliation == 0))
                {
                    $this->Ledger_model->delete_reconciliation($data_id);
                }
                $this->db->trans_complete();
                $this->messages->add('Updated Ledger account - ' . $data_name . '.', 'success');
                $this->logger->write_message("success", "Updated Ledger account called " . $data_name . " [id:" . $data_id . "]");
                redirect('account');
                return;
            }
        }
        return;
    }

    function delete($id)
    {
        /* Check access */
        if ( ! check_access('delete ledger'))
        {
            $this->messages->add('Permission denied.', 'error');
            redirect('account');
            return;
        }

        /* Check for account lock */
        if ($this->config->item('account_locked') == 1)
        {
            $this->messages->add('Account is locked.', 'error');
            redirect('account');
            return;
        }

        /* Checking for valid data */
        //$id = $this->input->xss_clean($id);
        $id = (int)$id;
        if ($id < 1)
        {
            $this->messages->add('Invalid Ledger account.', 'error');
            redirect('account');
            return;
        }
        $this->db->from('entry_items')->where('ledger_id', $id);
        if ($this->db->get()->num_rows() > 0)
        {
            $this->messages->add('Cannot delete non-empty Ledger account.', 'error');
            redirect('account');
            return;
        }

        /* Get the ledger details */
        $this->db->from('ledgers')->where('id', $id);
        $ledger_q = $this->db->get();
        if ($ledger_q->num_rows() < 1)
        {
            $this->messages->add('Invalid Ledger account.', 'error');
            redirect('account');
            return;
        } else {
            $ledger_data = $ledger_q->row();
        }

        /* Deleting ledger */
        $this->db->trans_start();
        if ( ! $this->db->delete('ledgers', array('id' => $id)))
        {
            $this->db->trans_rollback();
            $this->messages->add('Error deleting Ledger account - ' . $ledger_data->name . '.', 'error');
            $this->logger->write_message("error", "Error deleting Ledger account called " . $ledger_data->name . " [id:" . $id . "]");
            redirect('account');
            return;
        } else {
            /* Deleting reconciliation data if present */
            $this->Ledger_model->delete_reconciliation($id);
            $this->db->trans_complete();
            $this->messages->add('Deleted Ledger account - ' . $ledger_data->name . '.', 'success');
            $this->logger->write_message("success", "Deleted Ledger account called " . $ledger_data->name . " [id:" . $id . "]");
            redirect('account');
            return;
        }
        return;
    }

    function balance($ledger_id = 0)
    {
        if ($ledger_id > 0)
            echo $this->Ledger_model->get_ledger_balance($ledger_id);
        else
            echo "";
        return;
    }
}

/* End of file ledger.php */
/* Location: ./system/application/controllers/ledger.php */
