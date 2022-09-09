<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Bank_model');
    }

    /* List all Component Data */

    public function index() {
        if (!has_permission('customers', '', 'view')) {
            if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
                access_denied('customers');
            }
        }

        $data['bank_data'] = $this->Bank_model->get();

        $this->load->view('admin/bank/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('bank');
    }

    public function bank($id = '') {
        if ($this->input->post()) {
            $bank_data = $this->input->post();
			
            if ($id == '') {

                $id = $this->Bank_model->add($bank_data);
                if ($id) {
                  //  handle_bank_image_upload($id);
                    set_alert('success', _l('added_successfully', _l('bank')));
                    redirect(admin_url('bank'));
                }
            } else {
               // handle_bank_image_upload($id);
                $success = $this->Bank_model->edit($bank_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('bank')));
                }

                redirect(admin_url('bank'));
            }
        }

        $this->load->model('Clients_model');
        $data['bank_branch_data'] = $this->Clients_model->get();

		$this->load->model('Taxes_model');
        $data['tax_data'] = $this->Taxes_model->get();
		
		$this->load->model('Component_model');
        $data['component_data'] = $this->Component_model->get();
        
        if ($id == '') {
            $title = _l('add_new', _l('bank_lowercase'));
        } else {
            $data['bank_data'] = (array) $this->Bank_model->get($id);
			
            $title = _l('edit', _l('bank_lowercase'));
        }
		
        $data['title'] = $title;
        $this->load->view('admin/bank/bank', $data);
    }

    public function delete($id) {

        $success = $this->Bank_model->delete($id);
		
        if ($success) {
            set_alert('success', _l('deleted', _l('bank')));
            if (strpos($_SERVER['HTTP_REFERER'], 'bank/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('bank'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('component_lowercase')));
            redirect(admin_url('bank/bank/' . $id));
        }
    }
    
    /* Change Component status / active / inactive */

    public function change_bank_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $bank_data = array(
                'status' => $status
            );
            
            $this->Bank_model->edit($bank_data, $id);
        }
    }
	
	
	 public function imagedelete() {

		$id=$this->input->post('proid');
        $success = $this->Bank_model->imagedelete($id);
		
        if ($success) {
            set_alert('success', _l('deleted', _l('bank')));
            if (strpos($_SERVER['HTTP_REFERER'], 'bank/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('bank/bank/' . $id));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('component_lowercase')));
            redirect(admin_url('bank/bank/' . $id));
        }
    }

}
