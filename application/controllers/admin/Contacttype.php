<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contacttype extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Contact_type_model');
    }

    /* List all Contacttype Master */

    public function index() {
        check_permission('89,253','view');

        $data['Contact_type_data'] = $this->Contact_type_model->get();

        $this->load->view('admin/contact_type/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('contacttype');
    }

    public function contacttype($id = '') {
        check_permission('89,253','create');
        if ($this->input->post()) {
            $Contact_type_data = $this->input->post();
            if ($id == '') {

                $id = $this->Contact_type_model->add($Contact_type_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('contact_type')));
                    redirect(admin_url('contacttype'));
                }
            } else {
                check_permission('89,253','edit');
                $success = $this->Contact_type_model->edit($Contact_type_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('contact_type')));
                }

                redirect(admin_url('contacttype'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('contact_type_lowercase'));
        } else {
            $data['contacttype'] = (array) $this->Contact_type_model->get($id);
            $title = _l('edit', _l('contact_type_lowercase'));
        }

        $data['title'] = $title;
        $this->load->view('admin/contact_type/contact_type', $data);
    }

    public function delete($id) {
        check_permission('89,253','delete');
        $success = $this->Contact_type_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('contact_type')));
            if (strpos($_SERVER['HTTP_REFERER'], 'contacttype/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('contacttype'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('client_category_lowercase')));
            redirect(admin_url('contacttype/contacttype/' . $id));
        }
    }
    
    /* Change Unit status / active / inactive */

    public function change_contacttype_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $Contact_type_data = array(
                'status' => $status
            );
            
            $this->Contact_type_model->edit($Contact_type_data, $id);
        }
    }

}
