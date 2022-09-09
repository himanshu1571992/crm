<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Defaultsettingcategory extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Defaultsettingcategory_model');
    }

    /* List all Clientcategory Master */

    public function index() {
        check_permission(20,'view');

        $data['client_category_data'] = $this->Defaultsettingcategory_model->get();

        $this->load->view('admin/default_setting_category/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('defaultsettingcategory');
    }

    public function Defaultsettingcategory($id = '') {
        check_permission(20,'create');
        if ($this->input->post()) {
            $default_setting_category_data = $this->input->post();
            if ($id == '') {

                $id = $this->Defaultsettingcategory_model->add($default_setting_category_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('default_setting_category')));
                    redirect(admin_url('Defaultsettingcategory'));
                }
            } else {
                check_permission(20,'edit');
                $success = $this->Defaultsettingcategory_model->edit($default_setting_category_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('default_setting_category')));
                }

                redirect(admin_url('Defaultsettingcategory'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('default_setting_category_lowercase'));
        } else {
            $data['defaultsettingcategory'] = (array) $this->Defaultsettingcategory_model->get($id);
            $title = _l('edit', _l('default_setting_category_lowercase'));
        }

        $data['title'] = $title;
        $this->load->view('admin/default_setting_category/default_setting_category', $data);
    }

    public function delete($id) {
        check_permission(20,'delete');
        $success = $this->Defaultsettingcategory_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('default_setting_category')));
            if (strpos($_SERVER['HTTP_REFERER'], 'Defaultsettingcategory/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('Defaultsettingcategory'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('default_setting_category_lowercase')));
            redirect(admin_url('Defaultsettingcategory/Defaultsettingcategory/' . $id));
        }
    }
    
    /* Change Unit status / active / inactive */

    public function change_defaultsettingcategory_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $client_category_data = array(
                'status' => $status
            );
            
            $this->Defaultsettingcategory_model->edit($client_category_data, $id);
        }
    }

}
