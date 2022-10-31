<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Production_department extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function index()
    {
        check_permission(170,'view');
        $data['department_info']  = $this->db->query("SELECT * FROM tblproduction_department order by id asc ")->result();

        $data['title'] = 'Production Department';
        $this->load->view('admin/production_department/manage', $data);

    }

    public function add($id="")
    {
        check_permission(170,'create');
        $data['staff_info']  = $this->db->query("SELECT * FROM tblstaff WHERE active =  '1' order by firstname asc ")->result();
        $data['department_list']  = $this->db->query("SELECT * FROM tblproduction_department where status = 1 order by name asc ")->result();

        if(!empty($_POST)){
            extract($this->input->post());

            $staff_str=implode(',',$staff_ids);
            if(!empty($superior_ids)){
                $superior_str=implode(',',$superior_ids);
            }else{
                $superior_str= '';
            }

            $ad_data = array(
                    'name' => $name,
                    'staff_ids' => $staff_str,
                    'superior_ids' => $superior_str,
                    'remark' => $remark,
                    'created_at' => date('Y-m-d H:i:s'),
                    'status' => 1
                );

            $insert = $this->home_model->insert('tblproduction_department', $ad_data);
            if($insert){
                set_alert('success', 'Department added Successfully');
                redirect(admin_url('production_department'));
            }
        }

        if(!empty($id)){
            $data['depatment_info']  = $this->db->query("SELECT * FROM tblproduction_department WHERE id = '".$id."'")->row();
            $data['id'] = $id;
            $data['title'] = 'Edit Production Department';
        }else{
            $data['title'] = 'Add Production Department';
        }

        $this->load->view('admin/production_department/add', $data);
    }



    public function edit($id="")
    {

        check_permission(170,'edit');

        if(!empty($_POST)){
            extract($this->input->post());

            $staff_str=implode(',',$staff_ids);
            if(!empty($superior_ids)){
                $superior_str=implode(',',$superior_ids);
            }else{
                $superior_str= '';
            }

            $ad_data = array(
                'name' => $name,
                'staff_ids' => $staff_str,
                'superior_ids' => $superior_str,
                'remark' => $remark,
                'created_at' => date('Y-m-d H:i:s'),
                'status' => 1
            );


            $update = $this->home_model->update('tblproduction_department', $ad_data,array('id'=>$id));

            if($update){

                set_alert('success', 'Department updated Successfully');
                redirect(admin_url('production_department'));
            }
        }
    }

    /* this is for machine master list */
    public function machinemaster_list() {

        check_permission(410,'view');
        $data['machinemaster_info']  = $this->db->query("SELECT * FROM tblmachinemaster order by id DESC ")->result();

        $data['title'] = 'Machine Master List';
        $this->load->view('admin/production_department/machinemaster_list', $data);
    }

    public function change_machinemaster_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $update_data = array(
                'status' => $status
            );

            $this->home_model->update('tblmachinemaster',$update_data,array('id'=>$id));
        }
    }

    public function addmachinemaster($id = '') {
        
        if ($this->input->post()) {
            extract($this->input->post());

            if ($id == '') {

                $ad_data = array(
                    'added_by' => get_staff_user_id(),
                    'name' => $name,
                    'department' => $department,
                    'created_at' => date('Y-m-d H:i:s'),
                    'status' => 1
                );
                $insert = $this->home_model->insert('tblmachinemaster', $ad_data);
                if ($insert) {
                    set_alert('success', _l('added_successfully', 'New Machine Master added successfully'));
                    redirect(admin_url('production_department/machinemaster_list'));
                }
            } else {

                $ad_data = array(
                    'name' => $name,
                    'department' => $department,
                );
                $update = $this->home_model->update('tblmachinemaster', $ad_data,array('id'=>$id));
                if ($update) {
                    set_alert('success', 'Machine Master updated successfully');
                }
                redirect(admin_url('production_department/machinemaster_list'));
            }
        }

        if ($id == '') {
            check_permission(410,'create');

            $title = 'Add Machine Master';
        } else {
            check_permission(410,'edit');

            $data['machinemaster_info'] = $this->db->query("SELECT * FROM tblmachinemaster where id = '".$id."' ")->row();
            $title = 'Edit Machine Master';
        }

        $data['division_info'] = $this->db->query("SELECT * FROM tbldivisionmaster where status = '1' ")->result();

        $data['title'] = $title;
        $this->load->view('admin/production_department/addmachinemaster', $data);
    }

    public function delete_machinemaster($id) {
        check_permission(410,'delete');

        $chkoperation = $this->db->query("SELECT * FROM tbloperationsmaster WHERE machine_id = '".$id."' ")->row();
        if (!empty($chkoperation)){
            set_alert('warning', "Its can't be deleted, Already used somewhere");
            redirect(admin_url('production_department/machinemaster_list'));
        }
        $response = $this->home_model->delete('tblmachinemaster', array('id'=>$id));
        if ($response == true) {
            set_alert('success', 'Machine Deleted Successfully');
            redirect(admin_url('production_department/machinemaster_list'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('production_department/machinemaster_list'));
        }
    }

    /* this is for operation master list */
    public function operationmaster_list() {
        check_permission(411,'view');

        $data['machinemaster_info']  = $this->db->query("SELECT * FROM tbloperationsmaster order by id DESC ")->result();

        $data['title'] = 'Operation Master List';
        $this->load->view('admin/production_department/operationmaster_list', $data);
    }

    public function change_operationmaster_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $update_data = array(
                'status' => $status
            );

            $this->home_model->update('tbloperationsmaster',$update_data,array('id'=>$id));
        }
    }

    public function addoperationmaster($id = '') {
        
        if ($this->input->post()) {
            extract($this->input->post());

            if ($id == '') {

                $machine_id = implode(',', $machine_id);
                $ad_data = array(
                    'added_by' => get_staff_user_id(),
                    'name' => $name,
                    'department' => $department,
                    'machine_id' => $machine_id,
                    'cycle_time' => $cycle_time,
                    'created_at' => date('Y-m-d H:i:s'),
                    'status' => 1
                );
                $insert = $this->home_model->insert('tbloperationsmaster', $ad_data);
                if ($insert) {
                    set_alert('success', _l('added_successfully', 'New Operation Master added successfully'));
                    redirect(admin_url('production_department/operationmaster_list'));
                }
            } else {
                $machine_id = implode(',', $machine_id);
                $ad_data = array(
                    'name' => $name,
                    'department' => $department,
                    'machine_id' => $machine_id,
                    'cycle_time' => $cycle_time,
                );
                $update = $this->home_model->update('tbloperationsmaster', $ad_data,array('id'=>$id));
                if ($update) {
                    set_alert('success', 'Operation Master updated successfully');
                }
                redirect(admin_url('production_department/operationmaster_list'));
            }
        }

        if ($id == '') {
            check_permission(411,'create');
            $title = 'Add Operation Master';
        } else {
            check_permission(411,'edit');
            $title = 'Edit Operation Master';
            $data['operationmaster_info'] = $this->db->query("SELECT * FROM tbloperationsmaster where id = '".$id."' ")->row();
            $data['machinemaster_list'] = $this->db->query("SELECT * FROM tblmachinemaster where department = '".$data['operationmaster_info']->department."' ")->result();
        }

        $data['division_info'] = $this->db->query("SELECT * FROM tbldivisionmaster where status = '1' ")->result();
        $data['title'] = $title;
        $this->load->view('admin/production_department/addoperationmaster', $data);
    }

    public function delete_operationmaster($id) {
        check_permission(411,'delete');
        
        $response = $this->home_model->delete('tbloperationsmaster', array('id'=>$id));
        if ($response == true) {
            set_alert('success', 'Operation master Deleted Successfully');
            redirect(admin_url('production_department/operationmaster_list'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('production_department/operationmaster_list'));
        }
    }

    public function get_machinelist(){
        if ($this->input->post()) {
            extract($this->input->post());

            $machine_list = $this->db->query("SELECT * FROM tblmachinemaster where department = '".$departmentid."' ")->result();
            $html = '<option value=""></option>';
            if (isset($machine_list)){
                foreach ($machine_list as $value) {
                    $html .= '<option value="'.$value->id.'">'.cc($value->name).'</option>';
                }
            }
            echo $html;
        }    
    }


    /* this fuctio use for production plan list */
    public function production_report(){
        //check_permission(375,'view');

        $data["filterdata"] = '';
        $where = "status = '1' ";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;
                $data["filterdata"] .= 'f_date='.$f_date.'&t_date='.$t_date;
                $where .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
            }
            if (!empty($operator1_id)){
                $data['operator1_id'] = $operator1_id;
                $data["filterdata"] .= '&operator1_id='.$operator1_id;
                $where .= " and operator1_id ='".$operator1_id."' ";
            }
            if (!empty($department)){
                $data['department'] = $department;
                $data["filterdata"] .= '&department_id='.$department;
                $where .= " and department_id ='".$department."' ";
                $data["machinemaster_list"] = $this->db->query("SELECT * FROM tblmachinemaster where department = '".$department."' ")->result();
            }
            if (!empty($machine_id)){
                $data['machine_id'] = $machine_id;
                $data["filterdata"] .= '&machine_id='.$machine_id;
                $where .= " and machine_id ='".$machine_id."' ";
            }
            
        }else{
            $where .= " and MONTH(date) = '".date('m')."' and YEAR(date) = '".date('Y')."' "; 
        }
        // Get records
        $data['division_info'] = $this->db->query("SELECT * FROM tbldivisionmaster where status = '1' ")->result();
        $data['production_list']  = $this->db->query("SELECT * FROM tblproductionsubmission WHERE ".$where." order by id desc ")->result();
        $data['staff_list']  = $this->db->query("SELECT * FROM tblstaff order by firstname ASC ")->result();
        $data['title'] = 'Production Report';
        $this->load->view('admin/production_department/production_report', $data);
    }

    /* this function use for production chart report */
    public function production_chart_report(){

        $where = "status = '1' ";
        if(!empty($_GET)){
            extract($this->input->get());

            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
            }
            if (!empty($operator1_id)){
                $data['operator1_id'] = $operator1_id;

                $where .= " and operator1_id ='".$operator1_id."' ";
            }
            if (!empty($department)){
                $data['department'] = $department;
                
                $where .= " and department_id ='".$department."' ";
                $data["machinemaster_list"] = $this->db->query("SELECT * FROM tblmachinemaster where department = '".$department."' ")->result();
            }
            if (!empty($machine_id)){
                $data['machine_id'] = $machine_id;

                $where .= " and machine_id ='".$machine_id."' ";
            }
            
        }else{
            $where .= " and MONTH(date) = '".date('m')."' and YEAR(date) = '".date('Y')."' "; 
        }

        
        // Get records
        $data['production_list']  = $this->db->query("SELECT * FROM tblproductionsubmission WHERE ".$where." order by id desc ")->result();
        $data['title'] = 'Production Chart Report';
        $this->load->view('admin/includes/head');
        $this->load->view('admin/production_department/production_chart_report', $data);
    }
}
