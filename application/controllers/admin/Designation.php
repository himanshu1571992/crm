<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Designation extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Designation_model');
        $this->load->model('home_model');
    }

    /* List all Component Data */

    public function index() {
        check_permission('126,258','view');

        $data['designation_data'] = $this->Designation_model->get();

        $this->load->view('admin/designation/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('designation');
    }

    public function designation($id = '') {
        check_permission('126,258','create');
        if ($this->input->post()) {
            $designation_data = $this->input->post();

            if ($id == '') {

                $id = $this->Designation_model->add($designation_data);
                if ($id) {
                    //  handle_designation_image_upload($id);
                    set_alert('success', _l('added_successfully', _l('designation')));
                    redirect(admin_url('menu_master/designation_assign/'.$id));
                }
            } else {
                check_permission('126,258','edit');
                // handle_designation_image_upload($id);
                $success = $this->Designation_model->edit($designation_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('designation')));
                }

                redirect(admin_url('designation'));
            }
        }

        /*$this->load->model('Clients_model');
        $data['designation_branch_data'] = $this->Clients_model->get();

        $this->load->model('Taxes_model');
        $data['tax_data'] = $this->Taxes_model->get();

        $this->load->model('Component_model');
        $data['component_data'] = $this->Component_model->get();

        $this->load->model('Designation_model');
        $data['designation'] = $this->Designation_model->get();*/

        if ($id == '') {
            $title = _l('add_new', _l('designation_lowercase'));
        } else {
            $data['designation_data'] = (array) $this->Designation_model->get($id);

            $title = _l('edit', _l('designation_lowercase'));
        }

        $data['title'] = $title;
        $this->load->view('admin/designation/designation', $data);
    }

    public function delete($id) {
        check_permission('126,258','delete');

        $department = $this->db->query("SELECT * FROM `tblstaff` where department_id = '".$id."' ")->row();
        $lead_info  = $this->db->query("SELECT * FROM `tblappleads` WHERE  designation_id = '".$id."' ")->row();
        $registeredvendorcontact  = $this->db->query("SELECT * FROM `tblregisteredvendorcontact` WHERE  designation_id = '".$id."' ")->row();
        $registeredstaff  = $this->db->query("SELECT * FROM `tblregisteredstaff` WHERE  designation_id = '".$id."' ")->row();
        $contacts  = $this->db->query("SELECT * FROM `tblcontacts` WHERE  designation_id = '".$id."' ")->row();
        $warehouseperson  = $this->db->query("SELECT * FROM `tblwarehouseperson` WHERE  designation = '".$id."' ")->row();

        if (!empty($department) OR !empty($lead_info) OR !empty($registeredvendorcontact) OR !empty($registeredstaff) OR !empty($contacts) OR !empty($warehouseperson)){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }

        $success = $this->Designation_model->delete($id);

        if ($success) {
            set_alert('success', _l('deleted', _l('designation')));
            if (strpos($_SERVER['HTTP_REFERER'], 'designation/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('designation'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('component_lowercase')));
            redirect(admin_url('designation/designation/' . $id));
        }
    }

    /* Change Designation status / active / inactive */

    public function change_designation_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $designation_data = array(
                'status' => $status
            );

            $this->Designation_model->edit($designation_data, $id);
        }
    }

    public function imagedelete() {

        $id = $this->input->post('proid');
        $success = $this->Designation_model->imagedelete($id);

        if ($success) {
            set_alert('success', _l('deleted', _l('designation')));
            if (strpos($_SERVER['HTTP_REFERER'], 'designation/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('designation/designation/' . $id));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('component_lowercase')));
            redirect(admin_url('designation/designation/' . $id));
        }
    }


    public function department_list() {

        $data['departments_info']  = $this->db->query("SELECT * FROM tbldepartmentsmaster order by id DESC ")->result();


        $data['title'] = 'Department Master List';
        $this->load->view('admin/designation/department_list', $data);
    }

    public function departmentsmaster($id = '') {

        if ($this->input->post()) {
            extract($this->input->post());

            if ($id == '') {

                $ad_data = array(
                    'added_by' => get_staff_user_id(),
                    'name' => $name,
                    'created_at' => date('Y-m-d H:i:s')
                );
                $insert = $this->home_model->insert('tbldepartmentsmaster', $ad_data);
                if ($insert) {
                    set_alert('success', _l('added_successfully', 'Department Master added successfully'));
                    redirect(admin_url('designation/department_list'));
                }
            } else {

                $ad_data = array(
                    'name' => $name,
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $update = $this->home_model->update('tbldepartmentsmaster', $ad_data,array('id'=>$id));
                if ($update) {
                    set_alert('success', 'Department Master updated successfully');
                }
                redirect(admin_url('designation/department_list'));
            }
        }

        if ($id == '') {
            $title = 'Add Department Master';
        } else {
            $data['department_info'] = $this->db->query("SELECT * FROM tbldepartmentsmaster where id = '".$id."' ")->row_array();
            $title = 'Edit Department Master';
        }

        $data['title'] = $title;

        $this->load->view('admin/designation/departmentsmaster', $data);
    }

    public function change_department_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $update_data = array(
                'status' => $status
            );

            $this->home_model->update('tbldepartmentsmaster',$update_data,array('id'=>$id));
        }
    }

    public function delete_departmentsmaster($id) {

        $department = $this->db->query("SELECT * FROM `tblstaff` where department_id = '".$id."' ")->row();
        $registeredstaff = $this->db->query("SELECT * FROM `tblregisteredstaff` Where department_id = '".$id."' ")->row();

        if (!empty($department) OR !empty($registeredstaff)){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }

        $response = $this->home_model->delete('tbldepartmentsmaster', array('id'=>$id));
        if ($response == true) {
            set_alert('success', 'Department Master Deleted Successfully');
            redirect(admin_url('designation/department_list'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('designation/department_list'));
        }

    }

    /* this function use for designation question */
    public function designationquestion_list(){

        // $where = " staff_id = '".get_staff_user_id()."' ";
        $where = " id > 0 ";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($f_date) && !empty($t_date)){

              $data['f_date'] = $f_date;
              $data['t_date'] = $t_date;
              $where .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
           }
        }

        $data['question_list'] = $this->db->query("SELECT * FROM `tbldesignationquestion` WHERE ".$where." ORDER BY id DESC ")->result();

    	   $data['title'] = 'Designation Question List';
        $this->load->view('admin/designation/designationquestion_list', $data);
    }

    /* this function use for designation question add */
     public function designationquestion_add($id = '') {

        if ($this->input->post()) {
            $designation_data = $this->input->post();

            if ($id == '') {

                $id = $this->Designation_model->designationquestion_add($designation_data);
                if ($id) {
                    set_alert('success', "Add Designation Question");
                    redirect(admin_url('designation/designationquestion_list'));
                }
            } else {
                $success = $this->Designation_model->designationquestion_edit($designation_data, $id);
                if ($success) {
                    set_alert('success', "Edit Designation Question");
                }
                    redirect(admin_url('designation/designationquestion_list'));
            }
        }

        if ($id == '') {
            $title = "Add Designation Question";
        } else {

            $data['designationquestion_info'] = $this->db->query("SELECT * FROM `tbldesignationquestion` WHERE id = '".$id."'")->row();
            $data['dquestion_list'] = $this->db->query("SELECT * FROM `tbldesignationwisequestion` WHERE designationquestion_id = '".$id."'")->result();
            $title = "Edit Designation Question";
        }
        $data['designation_list'] = $this->db->query("SELECT * FROM `tbldesignation` WHERE status = 1")->result();
        $data['title'] = $title;
        $this->load->view('admin/designation/designationquestion_add', $data);
    }

    public function designationquestion_delete($id) {

        $response = $this->Designation_model->designationquestion_delete($id);
        if ($response == true) {
            set_alert('success', 'Designation Question Deleted Successfully');
            redirect(admin_url('designation/designationquestion_list'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('designation/designationquestion_list'));
        }

    }

    /* this function use for designation skill */
    public function designationskill_list(){

        // $where = " staff_id = '".get_staff_user_id()."' ";
        $where = " id > 0 ";
    	  if(!empty($_POST)){
       		  extract($this->input->post());
            if(!empty($f_date) && !empty($t_date)){

              $data['f_date'] = $f_date;
              $data['t_date'] = $t_date;
              $where .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
           }
    	  }

        $data['question_list'] = $this->db->query("SELECT * FROM `tbldesignationskills` WHERE ".$where." ORDER BY id DESC ")->result();
    	  $data['title'] = 'Designation Skills & Qualities';
        $this->load->view('admin/designation/designationskills_list', $data);
    }

    /* this function use for designation skill add */
     public function designationskill_add($id = '') {

        if ($this->input->post()) {
            $designation_data = $this->input->post();
            if ($id == '') {

                $id = $this->Designation_model->designationskill_add($designation_data);
                if ($id) {
                    set_alert('success', "Add Designation Skill");
                    redirect(admin_url('designation/designationskill_list'));
                }
            } else {
                $success = $this->Designation_model->designationskill_edit($designation_data, $id);
                if ($success) {
                    set_alert('success', "Edit Designation Skill");
                }
                redirect(admin_url('designation/designationskill_list'));
            }
        }

        if ($id == '') {
            $title = "Add Designation Skills & Qualities";
        } else {

            $data['designationskill_info'] = $this->db->query("SELECT * FROM `tbldesignationskills` WHERE id = '".$id."'")->row();
            $data['skill_details'] = $this->db->query("SELECT * FROM `tbldesignationskillsdetails` WHERE designationskills_id = '".$id."'")->result();
            $title = "Edit Designation Skills & Qualities";
        }
        $data['designation_list'] = $this->db->query("SELECT * FROM `tbldesignation` WHERE status = 1")->result();
        $data['title'] = $title;
        $this->load->view('admin/designation/designationskills_add', $data);
    }

    public function designationskills_delete($id) {

        $response = $this->Designation_model->designationskills_delete($id);
        if ($response == true) {
            set_alert('success', 'Designation skills & qualities deleted successfully');
            redirect(admin_url('designation/designationskill_list'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('designation/designationskill_list'));
        }

    }
}
