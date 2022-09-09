<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Enquiryfor extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Enquiryfor_model');
    }

    /* List all Enquiry type Master */

    public function index() {
        check_permission('12,240','view');

        $data['unit_data'] = $this->Enquiryfor_model->get();

        $this->load->view('admin/enquiry_for_master/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('enquiryfor');
    }

    public function enquiryfor($id = '') {
        check_permission('12,240','create');
        if ($this->input->post()) {
            $enquiryfor_data = $this->input->post();
            if ($id == '') {

                $id = $this->Enquiryfor_model->add($enquiryfor_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('enquiry_for')));
                    redirect(admin_url('enquiryfor'));
                }
            } else {
                check_permission('12,240','edit');
                $success = $this->Enquiryfor_model->edit($enquiryfor_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('enquiry_for')));
                }

                redirect(admin_url('enquiryfor'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('enquiry_for_lowercase'));
        } else {
            $data['enquiryfor'] = (array) $this->Enquiryfor_model->get($id);
            $title = _l('edit', _l('enquiry_for_lowercase'));
        }

        $data['title'] = $title;
        $this->load->view('admin/enquiry_for_master/enquiryfor', $data);
    }

    public function delete($id) {
        check_permission('12,240','delete');
        $success = $this->Enquiryfor_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('enquiry_for')));
            if (strpos($_SERVER['HTTP_REFERER'], 'enquiryfor/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('enquiryfor'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('enquiry_for_lowercase')));
            redirect(admin_url('enquiryfor/enquiryfor/' . $id));
        }
    }
    
    /* Change enquiry type status / active / inactive */

    public function change_enquiryfor_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $unit_data = array(
                'status' => $status
            );
            
            $this->Enquiryfor_model->edit($unit_data, $id);
        }
    }

}
