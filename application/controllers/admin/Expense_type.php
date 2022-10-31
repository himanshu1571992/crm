<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Expense_type extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function index()
    {
       check_permission('138,270','view');
        //check_permission(104,'view');
        $data['type_info']  = $this->db->query("SELECT * FROM tblexpensetype order by id DESC ")->result();

        $data['title'] = 'Expense Type List';
        $this->load->view('admin/expense_type/manage', $data);
    }

    public function add($id="")
    {

        check_permission('138,270','create');

        if(!empty($_POST)){
            extract($this->input->post());
            
            $designationids = (!empty($designation_ids)) ? implode(",", $designation_ids) : "";
            $ad_data = array(
                'added_by' => get_staff_user_id(),
                'head_id' => $head_id,
                'name' => $name,
                'expense_for' => $expense_for,
                'category_id' => $category_id,
                'designation_ids' => $designationids,
                'default_sub_category' => 0,
                'description' => $description,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            );

            $insert = $this->home_model->insert('tblexpensetype', $ad_data);
            if($insert){
                set_alert('success', 'Expense type added Successfully');
                redirect(admin_url('expense_type'));
            }
        }

        if(!empty($id)){
            $data['type_info']  = $this->db->query("SELECT * FROM tblexpensetype WHERE id = '".$id."'")->row();
            $data['default_type_info']  = $this->db->query("SELECT * FROM tblexpensetypesub where type_id = '".$id."' and status = 1 order by id ASC ")->result();
            $data['id'] = $id;
            $data['title'] = 'Edit Expense Type';
        }else{
            $data['title'] = 'Add Expense Type';
        }

        $data['expensehead_list']  = $this->db->query("SELECT * FROM tblexpensehead order by name ASC ")->result();
        $data['category_info']  = $this->db->query("SELECT * FROM tblexpensescategories where status = 1 order by name ASC ")->result();
        $data['designation_list'] = $this->db->query("SELECT * FROM tbldesignation WHERE status = 1 order by designation ASC")->result();
        $this->load->view('admin/expense_type/add', $data);
    }


    public function edit($id="")
    {
        check_permission('138,270','edit');

        if(!empty($_POST)){
            extract($this->input->post());

            if(empty($default_sub_category)){
                $default_sub_category = 0;
            }
            $designationids = (!empty($designation_ids)) ? implode(",", $designation_ids) : "";
            $ad_data = array(
                'head_id' => $head_id,
                'name' => $name,
                'expense_for' => $expense_for,
                'category_id' => $category_id,
                'designation_ids' => $designationids,
                'default_sub_category' => $default_sub_category,
                'description' => $description,
                'status' => 1
            );
            $update = $this->home_model->update('tblexpensetype', $ad_data,array('id'=>$id));
            if($update){
                set_alert('success', 'Expense Type updated Successfully');
                redirect(admin_url('expense_type'));
            }
        }
    }
    public function delete($id)
    {
        check_permission('138,270','delete');

        $expenses = $this->db->query("SELECT * FROM `tblexpenses` where type_id = '".$id."' ")->row();
        $expensetypesub = $this->db->query("SELECT * FROM `tblexpensetypesub` where type_id = '".$id."' ")->row();

        if (!empty($expenses) OR (!empty($expensetypesub))){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }

        $response = $this->home_model->delete('tblexpensetype', array('id'=>$id));
        if ($response == true) {
            $this->home_model->delete('tblexpensetypesub', array('type_id'=>$id));
            set_alert('success', _l('deleted', 'expense type'));
        } else {
            set_alert('warning', _l('problem_deleting', 'expense type'));
        }
        redirect(admin_url('expense_type'));
    }
    public function sub_list()
    {
        check_permission('140,272','view');
        //check_permission(104,'view');
        if(!empty($_POST)){
            extract($this->input->post());

            $data['s_type_id'] = $type_id;
            $data['type_info']  = $this->db->query("SELECT * FROM tblexpensetypesub WHERE type_id = '".$type_id."' order by id DESC ")->result();
        }else{
             $data['type_info']  = $this->db->query("SELECT * FROM tblexpensetypesub order by id DESC ")->result();
        }

        $data['type_data']  = $this->db->query("SELECT * FROM tblexpensetype where status = 1 order by id ASC ")->result();
        $data['title'] = 'Expense Sub-Type List';
        $this->load->view('admin/expense_type/sub_list', $data);
    }

    public function add_subtype($id="")
    {
        check_permission('140,272','create');
        if(!empty($_POST)){
            extract($this->input->post());
            $designationids = (!empty($designation_ids)) ? implode(",", $designation_ids) : '';
            $ad_data = array(
                'added_by' => get_staff_user_id(),
                'name' => $name,
                'type_id' => $type_id,
                'designation_ids' => $designationids,
                'description' => $description,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            );
            $insert = $this->home_model->insert('tblexpensetypesub', $ad_data);
            if($insert){
                set_alert('success', 'Expense type added Successfully');
                redirect(admin_url('expense_type/sub_list'));
            }
        }

        if(!empty($id)){
            $data['type_info']  = $this->db->query("SELECT * FROM tblexpensetypesub WHERE id = '".$id."'")->row();
            $expensetype = $data['type_info']->type_id;
            /*$expensedesignation_ids = value_by_id_empty("tblexpensetype", $data['type_info']->type_id, "designation_ids");
            if (!empty($expensedesignation_ids)){
                $data['designation_list'] = $this->db->query("SELECT * FROM tbldesignation WHERE id IN (".$expensedesignation_ids.") AND status = 1 order by designation ASC")->result();
            }*/

            $data['id'] = $id;
            $data['title'] = 'Edit Expense Sub-Type';
        }else{
            $data['title'] = 'Add Expense Sub-Type';
        }
        $data['designation_list'] = $this->db->query("SELECT * FROM tbldesignation WHERE  status = 1 order by designation ASC")->result();

        $data['type_data']  = $this->db->query("SELECT * FROM tblexpensetype where status = 1 order by id ASC ")->result();

        $this->load->view('admin/expense_type/add_subtype', $data);
    }


    public function edit_subtype($id="")
    {
        check_permission('140,272','edit');

        if(!empty($_POST)){
            extract($this->input->post());

            $designationids = (!empty($designation_ids)) ? implode(",", $designation_ids) : '';
            $ad_data = array(
                'name' => $name,
                'type_id' => $type_id,
                'designation_ids' => $designationids,
                'description' => $description,
                'status' => 1
            );
            $update = $this->home_model->update('tblexpensetypesub', $ad_data,array('id'=>$id));
            if($update){
                set_alert('success', 'Expense Sub-Type updated Successfully');
                redirect(admin_url('expense_type/sub_list'));
            }
        }

    }
    public function delete_subtype($id)
    {
        check_permission('140,272','delete');

        $expenses = $this->db->query("SELECT * FROM `tblexpenses` where typesub_id = '".$id."' ")->row();
        $expensetype = $this->db->query("SELECT * FROM `tblexpensetype` where default_sub_category = '".$id."' ")->row();

        if (!empty($expenses) OR (!empty($expensetype))){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }
        $response = $this->home_model->delete('tblexpensetypesub', array('id'=>$id));
        if ($response == true) {
            set_alert('success', _l('deleted', 'expense type'));
        } else {
            set_alert('warning', _l('problem_deleting', 'expense type'));
        }
        redirect(admin_url('expense_type/sub_list'));
    }
    public function getExpenseDesignationList(){
      if(!empty($_POST)){
          extract($this->input->post());
          $expensetype = $this->db->query("SELECT `designation_ids` FROM `tblexpensetype` where id = '".$type_id."' ")->row();
          $html = '<option value="">--Select One--</option>';
          if(!empty($expensetype) && !empty($expensetype->designation_ids)){
             $designation_list = $this->db->query("SELECT * FROM tbldesignation WHERE id IN (".$expensetype->designation_ids.") AND status = 1 order by designation ASC")->result();
             if (!empty($designation_list)){
                foreach ($designation_list as $value) {
                   $html .= '<option value="'.$value->id.'">'.$value->designation.'</option>';
                }
             }
          }
          echo $html;
      }
    }

}
