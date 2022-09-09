
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Defaultsetting extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Defaultsetting_model');
    }

    /* List all Defaultsetting  */

    public function index() {
        check_permission(21,'view');

        $data['unit_data'] = $this->Defaultsetting_model->get();

        $this->load->view('admin/default_setting/manage', $data);
    }

    public function table() {
		$defaultsettingdata['defaultsettingdata']=$this->db->query("SELECT ds.*,dsc.category_name FROM `tbldefaultsetting` ds LEFT JOIN `tbldefaultsettingcategory` dsc ON ds.`default_setting_category_id`=dsc.id")->result_array();
	   $this->app->get_table_data('defaultsetting',$defaultsettingdata);
	   
    }

    public function default_setting($id = '') {
        check_permission(21,'create');
        if ($this->input->post()) {
            $unit_data = $this->input->post();
            if ($id == '') {

                $id = $this->Defaultsetting_model->add($unit_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('default_setting')));
                    redirect(admin_url('Defaultsetting'));
                }
            } else {
                check_permission(21,'edit');
                $success = $this->Defaultsetting_model->edit($unit_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('default_setting')));
                }
                redirect(admin_url('Defaultsetting'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('default_setting_lowercase'));
        } else {
            $data['default_setting'] = (array) $this->Defaultsetting_model->get($id);
            $title = _l('edit', _l('default_setting_lowercase'));
        }
		$this->load->model('Defaultsettingcategory_model');
        $data['default_setting_category_data'] = $this->Defaultsettingcategory_model->get();
        $data['default_setting_fields'] = $this->db->query("SELECT * FROM `tbldefaultsettingfields`")->result_array();
		
        $data['title'] = $title;
		
        $this->load->view('admin/default_setting/default_setting', $data);
    }

    public function delete($id) {
        check_permission(21,'delete');
        $success = $this->Defaultsetting_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('default_setting')));
            if (strpos($_SERVER['HTTP_REFERER'], 'Defaultsetting/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('Defaultsetting'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('default_setting_lowercase')));
            redirect(admin_url('Defaultsetting/Defaultsetting/' . $id));
        }
    }
    
    /* Change Defaultsetting status / active / inactive */

    public function change_defaultsetting_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $staff_group_data = array(
                'status' => $status
            );
            
            $this->Defaultsetting_model->edit($staff_group_data, $id);
        }
    }

}
