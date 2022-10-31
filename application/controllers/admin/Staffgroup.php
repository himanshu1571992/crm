<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Staffgroup extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Staffgroup_model');
        $this->load->model('home_model');
    }

    /* List all Staffgroup  */

    public function index() {
        check_permission('127,259','view');

        $data['unit_data'] = $this->Staffgroup_model->get();

        $this->load->view('admin/staffgroup/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('staffgroups');
    }

    public function staffgroup($id = '') {
        check_permission('127,259','create');
        if ($this->input->post()) {
            $unit_data = $this->input->post();
            if ($id == '') {

                $id = $this->Staffgroup_model->add($unit_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('staff_group')));
                    redirect(admin_url('staffgroup'));
                }
            } else {
                check_permission('127,259','edit');
                $success = $this->Staffgroup_model->edit($unit_data, $id);				
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('staff_group')));
                }

                redirect(admin_url('staffgroup'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('staff_group_lowercase'));
        } else {
            $data['staffgroup'] = (array) $this->Staffgroup_model->get($id);
            $title = _l('edit', _l('staff_group_lowercase'));
        }
		/*$this->load->model('Staff_model');
        $data['staff_data'] = $this->Staff_model->get();*/
        $data['staff_data'] = $this->db->query("SELECT * FROM `tblstaff` where active = 1")->result_array();
		$this->load->model('Departments_model');
        $data['department_data'] = $this->Departments_model->get();
        $data['title'] = $title;
		$this->load->model('Multiselect_model');
		$data['multiselect_data'] = $this->Multiselect_model->get();
        $this->load->view('admin/staffgroup/staffgroup', $data);
    }

    public function delete($id) {
        check_permission('127,259','delete');
        
        $pettycashrequest = $this->db->query("SELECT * FROM `tblpettycashrequest` where group_ids IN (".$id.") ")->row();
        if (!empty($pettycashrequest)){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }
        
        $success = $this->Staffgroup_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('staff_group')));
            if (strpos($_SERVER['HTTP_REFERER'], 'staffgroup/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('staffgroup'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('staff_group_lowercase')));
            redirect(admin_url('staffgroup/staffgroup/' . $id));
        }
    }
    
    /* Change staffgroup status / active / inactive */

    public function change_staff_group_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $staff_group_data = array(
                'status' => $status
            );
            
            $this->Staffgroup_model->edit($staff_group_data, $id);
        }
    }

    public function leadstaff_list() {

        $data['leadstaff_info']  = $this->db->query("SELECT * FROM tblleadstaffgroup order by id DESC ")->result();


        $data['title'] = 'Lead Staff Master List'; 
        $this->load->view('admin/staffgroup/leadstaff_list', $data);
    }

    //Lead Staff
    public function leadstaff($id = '') {

        if ($this->input->post()) {
            extract($this->input->post()); 
            $superior = implode(',', $superior_ids);
            $quote_person = implode(',', $quote_person_ids);
            
            if ($id == '') { 

                $ad_data = array(                            
                    'added_by' => get_staff_user_id(),
                    'name' => $name,
                    'superior_ids' => $superior,
                    'sales_person_id' => $sales_person_id,
                    'quote_person_ids' => $quote_person,
                    'created_date' => date('Y-m-d H:i:s'),
                    'status' => 1
                );  
                $insert = $this->home_model->insert('tblleadstaffgroup', $ad_data);
                if ($insert) {
                    set_alert('success', _l('added_successfully', 'Lead Staff added successfully'));
                    redirect(admin_url('staffgroup/leadstaff_list'));
                }
            } else {

                $ad_data = array(                            
                    'name' => $name,
                    'superior_ids' => $superior,
                    'sales_person_id' => $sales_person_id,
                    'quote_person_ids' => $quote_person
                );   
                $update = $this->home_model->update('tblleadstaffgroup', $ad_data,array('id'=>$id));
                if ($update) {
                    set_alert('success', 'Lead Staff updated successfully');
                }
                redirect(admin_url('staffgroup/leadstaff_list'));
            }
        }

        if ($id == '') {
            $title = 'Add Lead Staff Master';
        } else {
            $data['lead_staff_info'] = $this->db->query("SELECT * FROM tblleadstaffgroup where id = '".$id."' ")->row_array();
            $data['superiordata'] = explode(',', $data['lead_staff_info']['superior_ids']);
            $data['quotedata'] = explode(',', $data['lead_staff_info']['quote_person_ids']);
            $title = 'Edit Lead Staff Master';
        }

        $data['employee_info'] = $this->db->query("SELECT * FROM `tblstaff` where active = 1 order by firstname asc")->result_array();

        $data['title'] = $title;
        
        $this->load->view('admin/staffgroup/leadstaff', $data);
    }

    public function change_leadstaff_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $update_data = array(
                'status' => $status
            );
            
            $this->home_model->update('tblleadstaffgroup',$update_data,array('id'=>$id));
        }
    }

    public function delete_leadstaff($id) {

        $leadstaffgroup = $this->db->query("SELECT * FROM `tblleadstaffgroup` where id = '".$id."' ")->row();
        if (!empty($leadstaffgroup)){
            
            $superior = $this->db->query("SELECT * FROM `tblleadassignstaff` where `staff_id` IN ('".$leadstaffgroup->superior_ids."') and `type` = 1 ")->row();
            $sales_person = $this->db->query("SELECT * FROM `tblleadassignstaff` where `staff_id` IN ('".$leadstaffgroup->sales_person_id."') and `type` = 2 ")->row();
            $quote_person = $this->db->query("SELECT * FROM `tblleadassignstaff` where `staff_id` IN ('".$leadstaffgroup->quote_person_ids."') and `type` = 3 ")->row();
            if (!empty($superior) OR !empty($sales_person) OR !empty($quote_person)){
                set_alert('warning', "Can't be delete, its using anywhere.");
                redirect($_SERVER['HTTP_REFERER']); die;
            }
        }
        
        $response = $this->home_model->delete('tblleadstaffgroup', array('id'=>$id));
        if ($response == true) {
            set_alert('success', 'Lead Staffe Deleted Successfully');
            redirect(admin_url('staffgroup/leadstaff_list'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('staffgroup/leadstaff_list'));
        }
        
    }

}
