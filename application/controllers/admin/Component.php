<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Component extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Component_model');
    }

    /* List all Component Data */

    public function index() {
        if (!has_permission('customers', '', 'view')) {
            if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
                access_denied('customers');
            }
        }

        $data['component_data'] = $this->Component_model->get();

        $this->load->view('admin/component/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('component');
    }

    public function component($id = '') {
        if ($this->input->post()) {
            $component_data = $this->input->post();
            if ($id == '') {

                $id = $this->Component_model->add($component_data);
                if ($id) {
                    handle_component_image_upload($id);
                    set_alert('success', _l('added_successfully', _l('component')));
                    redirect(admin_url('component'));
                }
            } else {
                handle_component_image_upload($id);
                $success = $this->Component_model->edit($component_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('component')));
                }

                redirect(admin_url('component'));
            }
        }

        $this->load->model('Unit_model');
        $data['unit_data'] = $this->Unit_model->get();
        
        if ($id == '') {
            $title = _l('add_new', _l('component_lowercase'));
        } else {
            $data['component'] = (array) $this->Component_model->get($id);
            $title = _l('edit', _l('component_lowercase'));
        }

        $data['title'] = $title;
        $this->load->view('admin/component/component', $data);
    }

    public function delete($id) {

        $success = $this->Component_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('component')));
            if (strpos($_SERVER['HTTP_REFERER'], 'component/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('component'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('component_lowercase')));
            redirect(admin_url('component/component/' . $id));
        }
    }
    
    /* Change Component status / active / inactive */

    public function change_component_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $component_data = array(
                'status' => $status
            );
            
            $this->Component_model->edit($component_data, $id);
        }
    }
	
	 public function imagedelete() {

		$id=$this->input->post('compnent');
        $success = $this->Component_model->imagedelete($id);
		
        if ($success) {
            set_alert('success', _l('deleted', _l('product')));
            if (strpos($_SERVER['HTTP_REFERER'], 'product/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('component/component/' . $id));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('component_lowercase')));
            redirect(admin_url('component/component/' . $id));
        }
    }

}
