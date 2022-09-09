<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Clientcategory extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Client_category_model');
    }

    /* List all Clientcategory Master */

    public function index() {
        check_permission('87,251','view');

        $data['client_category_data'] = $this->Client_category_model->get();

        $this->load->view('admin/client_category/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('clientcategory');
    }

    public function clientcategory($id = '') {
        check_permission('87,251','create');
        if ($this->input->post()) {
            $client_category_data = $this->input->post();
            if ($id == '') {

                $id = $this->Client_category_model->add($client_category_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('client_category')));
                    redirect(admin_url('clientcategory'));
                }
            } else {
                check_permission('87,251','edit');
                $success = $this->Client_category_model->edit($client_category_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('client_category')));
                }

                redirect(admin_url('Clientcategory'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('unit_lowercase'));
        } else {
            $data['clientcategory'] = (array) $this->Client_category_model->get($id);
            $title = _l('edit', _l('unit_lowercase'));
        }

        $data['title'] = $title;
        $this->load->view('admin/client_category/client_category', $data);
    }

    public function delete($id) {
        check_permission('87,251','delete');
        $success = $this->Client_category_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('client_category')));
            if (strpos($_SERVER['HTTP_REFERER'], 'Clientcategory/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('Clientcategory'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('client_category_lowercase')));
            redirect(admin_url('Clientcategory/Clientcategory/' . $id));
        }
    }
    
    /* Change Unit status / active / inactive */

    public function change_clientcategory_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $client_category_data = array(
                'status' => $status
            );
            
            $this->Client_category_model->edit($client_category_data, $id);
        }
    }

}
