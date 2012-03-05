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
class Calendar extends CI_Controller {
    
    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * check for permission to execute Calendar methods
     *
     * @access  public
     * @return  void
     */
    function __construct() {
        
        parent::__construct();

        /* Check access */
        if ( ! check_access('administer'))
        {
            $this->messages->add('Permission denied.', 'error');
            redirect('');
            return;
        }

        return;
    }
    
    // --------------------------------------------------------------------

    /**
     * Index
     *
     * Display the current calendar
     *
     * @access  public
     * @return  void
     */
    function index() {
        
        log_message('debug', '***Calendar::login');
        $this->template->set('page_title', 'Fiscal Calendar');
        $this->load->model('Calendar_model');
        

        $data['calendar'] = $this->Calendar_model->get_current();
        $data['start_date'] =  $data['calendar'][0]->start;
        $data['end_date'] =  $data['calendar'][count($data['calendar'])-1]->end;
    

        $this->template->load('admin_template', 'admin/calendar/index', $data);

    }
    
    // --------------------------------------------------------------------

    /**
     * Create
     *
     * Create a new calendar
     *
     * @access  public
     * @return  void
     */
    function create() {
        
        log_message('debug', '***Calendar::create');
        $this->template->set('page_title', 'Fiscal Calendar');

        /* Form fields */
        $data['start_date'] = array(
            'name' => 'start_date',
            'id' => 'start_date',
            'maxlength' => '11',
            'size' => '11',
            'value' => '',
        );
        
        $data['end_date'] = array(
            'name' => 'end_date',
            'id' => 'end_date',
            'maxlength' => '11',
            'size' => '11',
            'value' => '',
        );

        $data['calendar_types'] = array(
            "standard" => "standard",
            "4-4-5" => "4-4-5",
            "4-5-4" => "4-5-4",
            "5-4-4" => "5-4-4",
        );
        
        $data['calendar_type'] = 'standard';

        $data['use_53_week'] = array(
            'name' => 'use_53_week',
            'id' => 'use_53_week',
            'value' => 'True',
            'checked' => set_checkbox('use_53_week', 'yes'),
        );

        /* Repopulating form */
        if ($_POST)
        {
            $data['start_date']['value'] = $this->input->post('start_date', TRUE);
            $data['end_date']['value'] = $this->input->post('end_date', TRUE);
            $data['calendar_type'] = $this->input->post('user_role', TRUE);
            $data['use_53_week']['checked'] = $this->input->post('user_status', TRUE);
        }

        /* Form validations */
        $this->form_validation->set_rules('start_date', 'Username', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('end_date', 'Password', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('calendar_type', 'Role', 'trim|required');
        $this->form_validation->set_rules('use_53_week', 'Status', 'trim');

        /* Validating form */
        if ($this->form_validation->run() == FALSE)
        {
            $this->messages->add(validation_errors(), 'error');
            $this->template->load('admin_template', 'admin/calendar/create', $data);
            return;
        }
        else
        {
            $data_start_date = $this->input->post('start_date', TRUE);
            $data_end_date = $this->input->post('end_date', TRUE);
            $data_calendar_type = $this->input->post('calendar_type', TRUE);
            $data_use_53_week = $this->input->post('use_53_week', TRUE);
            $data_use_53_week = ($data_use_53_week == '') ? 'no' : $data_use_53_week;
            
            $this->load->model('Calendar_model');
            $this->Calendar_model->create($data_end_date, $data_calendar_type, $data_use_53_week);
            redirect('admin/calendar');

        }

    }

    // --------------------------------------------------------------------

    /**
     * Delete
     *
     * Delete the calendar
     *
     * @access  public
     * @return  void
     */
    function delete() {
        
        log_message('debug', '***Calendar::delete');
        $this->template->set('page_title', 'Fiscal Calendar');
        $this->load->model('Calendar_model');
        $this->Calendar_model->delete();
        redirect('admin/calendar');

    }

    // --------------------------------------------------------------------

    /**
     * Open
     *
     * Open calendar period
     *
     * @access  public
     * @param   integer Period to open
     * @return  void
     */
    function open($period) {
        
        log_message('debug', '***Calendar::open');
        $this->template->set('page_title', 'Fiscal Calendar');
        $this->load->model('Calendar_model');
        $this->Calendar_model->open_period($period);
        redirect('admin/calendar');

    }

    // --------------------------------------------------------------------

    /**
     * Close
     *
     * Close calendar period
     *
     * @access  public
     * @param   integer Period to close
     * @return  void
     */
    function close($period) {
        
        log_message('debug', '***Calendar::close');
        $this->template->set('page_title', 'Fiscal Calendar');
        $this->load->model('Calendar_model');
        $this->Calendar_model->close_period($period);
        redirect('admin/calendar');

    }

}