<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Unit_model');
    }

    /* List all Unit Master */

    public function index() {
        check_permission('73,244','view');

        $data['unit_data'] = $this->Unit_model->get();

        $this->load->view('admin/unit_master/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('units');
    }

    public function unit($id = '') {
        check_permission('73,244','create');
        if ($this->input->post()) {
            $unit_data = $this->input->post();
            if ($id == '') {

                $id = $this->Unit_model->add($unit_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('unit')));
                    redirect(admin_url('unit'));
                }
            } else {
                check_permission('73,244','edit');
                $success = $this->Unit_model->edit($unit_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('unit')));
                }

                redirect(admin_url('unit'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('unit_lowercase'));
        } else {
            $data['unit'] = (array) $this->Unit_model->get($id);
            $title = _l('edit', _l('unit_lowercase'));
        }

        $data['title'] = $title;
        $this->load->view('admin/unit_master/unit', $data);
    }

    public function delete($id) {
        check_permission('73,244','delete');
        
        /* this is checked used anywhere or not */
        $check_component = $this->db->query("SELECT `id` FROM `tblcomponents` WHERE `unit_id` = '".$id."'")->row();
        $check_products = $this->db->query("SELECT `id` FROM `tblproducts` WHERE `unit_id` = '".$id."' or `unit_1` = '".$id."' or `unit_2` = '".$id."'")->row();
        $check_products_log = $this->db->query("SELECT `id` FROM `tblproducts_log` WHERE `unit_id` = '".$id."' or `unit_1` = '".$id."' or `unit_2` = '".$id."'")->row();
        $check_vendorproducts = $this->db->query("SELECT `id` FROM `tblvendorproducts` WHERE `unit_id` = '".$id."'")->row();
        $temp_product = $this->db->query("SELECT * FROM `tbltemperoryproduct` Where unit = '".$id."' ");
        
        if (!empty($check_component) OR !empty($check_products) OR !empty($check_products_log) OR !empty($check_vendorproducts) OR !empty($temp_product)){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }
        
        $success = $this->Unit_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('unit')));
            if (strpos($_SERVER['HTTP_REFERER'], 'unit/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('unit'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('unit_lowercase')));
            redirect(admin_url('unit/unit/' . $id));
        }
    }
    
    /* Change Unit status / active / inactive */

    public function change_unit_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $unit_data = array(
                'status' => $status
            );
            
            $this->Unit_model->edit($unit_data, $id);
        }
    }

}
