<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Live_location extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->model('live_location_model');
    }

    public function index($id = '')
    {
        $this->locations();
    }

	public function table() {
        $this->app->get_table_data('live_location');
    }

    public function locations()
    {
        check_permission('143,275','view');
        if ($this->input->is_ajax_request()){
            $this->app->get_table_data('live_location');
        }
        $data['title'] = 'Live Location';
        $this->load->view('admin/live_location/manage', $data);
    }
	
	
	 public function add_location($id = '') {
        check_permission('143,275','create');
        if ($this->input->post()) {
			$unit_data = $this->input->post();
            if ($id == '') {

                $id = $this->live_location_model->add($unit_data);
                if ($id) {
									
                    set_alert('success', _l('added_successfully', 'Live Location'));
                    redirect(admin_url('live_location/locations'));
                }
            } else {
                check_permission('143,275','edit');
                $success = $this->live_location_model->update($unit_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Live Location'));
                }

                redirect(admin_url('live_location/locations'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', 'live location');
        } else {
            $data['location'] = (array) $this->live_location_model->get_location($id);
            $title = _l('edit', 'live location');
        }

        $data['title'] = $title;
        $this->load->view('admin/live_location/add', $data);
    }

    

    public function delete($id)
    {
        check_permission('143,275','delete');
        if (!$id) {
            redirect(admin_url('live_location/locations'));
        }
        $response = $this->live_location_model->delete($id);
		
        if ($response == true) {
            set_alert('success', _l('deleted', 'live location'));
        } else {
            set_alert('warning', _l('problem_deleting', 'live location'));
        }
        redirect(admin_url('live_location/locations'));
    }


	
	 public function change_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $unit_data = array(
                'view_status' => $status,
                'admin_action' => 1
            );
            
            $this->live_location_model->edit($unit_data, $id);
        }
    }
	
	
}