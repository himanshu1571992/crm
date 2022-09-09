<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Gst extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Gst_model');
    }

    /* List all Unit Master */

    public function index() {
        if (!has_permission('customers', '', 'view')) {
            if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
                access_denied('customers');
            }
        }

        $data['gst_data'] = $this->Gst_model->get();

        $this->load->view('admin/gst/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('gst');
    }

    public function gst($id = '') {
        if ($this->input->post()) {
            $gst_data = $this->input->post();
            if ($id == '') {

                $id = $this->Gst_model->add($gst_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('gst')));
                    redirect(admin_url('gst'));
                }
            } else {

                $success = $this->Gst_model->edit($gst_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('gst')));
                }

                redirect(admin_url('gst'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('gst_lowercase'));
        } else {
            $data['gst'] = (array) $this->Gst_model->get($id);
            $title = _l('edit', _l('gst_lowercase'));
        }

        $data['title'] = $title;
        $this->load->view('admin/gst/gst', $data);
    }

    public function delete($id) {

        $success = $this->Gst_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('gst')));
            if (strpos($_SERVER['HTTP_REFERER'], 'gst/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('gst'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('gst_lowercase')));
            redirect(admin_url('gst/gst/' . $id));
        }
    }
    
    /* Change Unit status / active / inactive */

    public function change_gst_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $gst_data = array(
                'status' => $status
            );
            
            $this->Gst_model->edit($gst_data, $id);
        }
    }

}
