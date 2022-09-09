<?php

defined('BASEPATH') or exit('No direct script access allowed');

class StaffSalesReport extends Admin_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->model('Employee_model');
    }
   
    /* this function use for list of staff sales report */
    public function index() {
        check_permission(316,'view');
        $where = " staff_id = '".get_staff_user_id()."' ";
        if(!empty($_POST)){
            extract($this->input->post());
            
            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));           
                $to_date = date('Y-m-d',strtotime($t_date));

               $where .= " and salesdate  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
           } 
        }

        $data['sales_report'] = $this->db->query("SELECT * from tblstaffsalesreport where  ".$where." order by id desc ")->result();
        $data['title'] = 'Sales Reports';
        $this->load->view('admin/staff_sales_report/view', $data);
    }
    
    /* this function use for add staff sales report */
    public function add($id = '') {
        
        if ($this->input->post()) {
            $sales_data = $this->input->post();

            if ($id == '') {
                $insert_id = $this->Employee_model->add_sales_report($sales_data);
                if ($insert_id) {
                    set_alert('success', _l('added_successfully', 'Report'));
                    redirect(admin_url('staffSalesReport'));
                }
            } else {
                    
                $success = $this->Employee_model->edit_sales_report($sales_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Report'));
                    redirect(admin_url('staffSalesReport'));
                }
            }
        }

        if ($id == '') {
            check_permission(316,'create');
            $title = 'Add Sales Report';
            $data['btn_title'] = "Add Report";
            $data['section']   = "add";
        } else {
            check_permission(316,'edit');
        	$title = 'Edit Sales Report';
            $data['btn_title'] = "Update Report";
            $data['section']   = "update";
            $data['sales_report_info'] = $this->home_model->get_row('tblstaffsalesreport', array('id'=> $id), array("*"));
            $data['sales_details'] = $this->home_model->get_result('tblstaffsalesreportdetails', array('staffsalesreport_id'=> $id), array("*"));
            if ($data['sales_details']){
                foreach ($data['sales_details'] as $val) {
                    $files = $this->home_model->get_row('tblfiles', array('rel_id'=> $val->id, 'rel_type' => 'sales_report'), array("file_name"));
                    $path = get_upload_path_by_type('sales_report') ;
                    $val->upload_file = ($files) ? $files->file_name : "";
                }
            }
        }
        
        $data['client_list'] = $this->home_model->get_result('tblclientbranch', array('client_status'=> 1), array("userid,client_branch_name"));
        $data['sales_product'] = $this->home_model->get_result('tblsalesproductmaster', array('status'=> 1), array("id,product_name"));
        $data['title']     = $title;
        $this->load->view('admin/staff_sales_report/add', $data);
    }

    /* this function use for get client details */
    public function getclientdetails($id){
        $data = $this->home_model->get_row('tblclientbranch', array('userid'=> $id), array("email_id,address"));
        $response = array("address" => "", "email_id" => "");
        if (!empty($data)){
            $response = array("address" => $data->address, "email_id" => $data->email_id);
        }
        echo json_encode($response);
    }

    public function view($id){
        check_permission(316,'view');
        $data['title']     = "View Sales Report";
        $data['section']   = "view";
        $data['sales_report_info'] = $this->home_model->get_row('tblstaffsalesreport', array('id'=> $id), array("*"));
        $data['sales_details'] = $this->home_model->get_result('tblstaffsalesreportdetails', array('staffsalesreport_id'=> $id), array("*"));
        if ($data['sales_details']){
            foreach ($data['sales_details'] as $val) {
                $files = $this->home_model->get_row('tblfiles', array('rel_id'=> $val->id, 'rel_type' => 'sales_report'), array("file_name"));
                $val->upload_file = ($files) ? $files->file_name : "";
            }
        }
        $data['client_list'] = $this->home_model->get_result('tblclientbranch', array('client_status'=> 1), array("userid,client_branch_name"));
        $data['product_category'] = $this->home_model->get_result('tblproductcategory', array('status'=> 1), array("id,name"));
        $this->load->view('admin/staff_sales_report/report_view', $data);
    }

    /* this function use for delete */
    public function delete($id) {
        check_permission(316,'delete');
        $delete = $this->home_model->delete('tblstaffsalesreport',array('id'=>$id));

        if($delete == true){

            /* delete files */
            $this->Employee_model->delete_files($id);

            set_alert('success', 'Report deleted successfully');
            redirect(admin_url('staffSalesReport'));
        }       

    }


    /* this function use for employee sales report */
    public function employeeSalesReport(){
        check_permission(317,'view');
        $where = "salesdate = '".db_date(date("Y-m-d"))."'";
        if(!empty($_POST)){
            extract($this->input->post());
            
            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));           
                $to_date = date('Y-m-d',strtotime($t_date));

               $where = "salesdate  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
           }
           if(!empty($staff_id)) {
            
                $data['s_staffId'] = $staff_id;
                $where .= " and staff_id = '".$staff_id."' ";
           } 
        }
        $data['employee_info'] = $this->db->query("SELECT * FROM `tblstaff` where active = 1 order by firstname asc")->result_array();
        $data['sales_report'] = $this->db->query("SELECT * from tblstaffsalesreport where  ".$where." order by salesdate desc ")->result();
        $data['title'] = 'Employee Sales Reports';
        $this->load->view('admin/staff_sales_report/sales_list', $data);
    }

    public function sales_product($id = '') {
        if ($this->input->post()) {
            extract($this->input->post());
            if ($id == '') {

                $ad_data = array(                            
                    'product_name' => $product_name,
                    'description' => $description,
                    'created_at' => date('Y-m-d H:i:s')
                 ); 

                $id = $this->home_model->insert('tblsalesproductmaster', $ad_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', 'Sales Product'));
                    redirect(admin_url('staffSalesReport/sales_product_list'));
                }
            } else {
                $ad_data = array(                            
                            'product_name' => $product_name,
                            'description' => $description,
                            'updated_at' => date('Y-m-d H:i:s')
                            );
                    
                $update = $this->home_model->update('tblsalesproductmaster', $ad_data,array('id'=>$id));
                if ($update) {
                    set_alert('success', _l('updated_successfully', 'Sales Product'));
                }

                redirect(admin_url('staffSalesReport/sales_product_list'));
            }
        }

        if ($id == '') {
            check_permission(317,'create');
            $title = 'Add Sales Product Master';
        } else {
            check_permission(317,'edit');
            $data['sales_product'] = $this->db->query("SELECT * FROM `tblsalesproductmaster` Where id = '".$id."' ")->row_array(); 
            $title = 'Edit Sales Product Master';
        }

        $data['title'] = $title;
        $this->load->view('admin/staff_sales_report/sales_product', $data);
    }

    public function change_sales_product_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $update_data = array(
                'status' => $status
            );
            
            $this->home_model->update('tblsalesproductmaster',$update_data,array('id'=>$id));
        }
    }

    public function sales_product_list() {
        check_permission(320,'view');
        $data['sales_product_data'] = $this->db->query("SELECT * FROM `tblsalesproductmaster` order by id desc ")->result();

        $data['title'] = 'Sales Product Master';
        $this->load->view('admin/staff_sales_report/sales_product_list', $data);
    }

    public function delete_sales_product($id) {
        check_permission(320,'delete');
        $response = $this->home_model->delete('tblsalesproductmaster', array('id'=>$id));
        if ($response == true) {
            set_alert('success', 'Sales Product Deleted Successfully');
            redirect(admin_url('staffSalesReport/sales_product_list'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('staffSalesReport/sales_product_list'));
        }
        
    }

}
