<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Employees extends Admin_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->model('Employee_model');
    }


    public function index() {

        check_permission(283,'view');
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

               $where .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
           }
    	}else{
            $where .= " and MONTH(`date`) = '".date('m')."' and YEAR(`date`) = '".date('Y')."' ";
        }

        $data['work_list'] = $this->db->query("SELECT * from tblemployeeworkreport where  ".$where." order by id desc ")->result();


    	$data['title'] = 'Daily Work Report';
        $this->load->view('admin/employees/view', $data);
    }


    public function add($id = '') {
        check_permission(283,'create');
        if ($this->input->post()) {
            $proposal_data = $this->input->post();

            if ($id == '') {
                $exist_info = $this->db->query("SELECT * from tblemployeeworkreport where  staff_id = '".get_staff_user_id()."' and date = '".db_date($proposal_data['date'])."' ")->row();

                if(empty($exist_info)){
                    $id = $this->Employee_model->add_work_report($proposal_data);
                }else{
                    set_alert('warning', 'Your report is already submitted of that day! ');
                    redirect(admin_url('employees'));
                }


                if ($id) {
                    set_alert('success', _l('added_successfully', 'Report'));
                    redirect(admin_url('employees'));
                }
            } else {
                check_permission(283,'edit');
                $success = $this->Employee_model->edit_work_report($proposal_data, $id);

                // exit;
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Report'));
                    redirect(admin_url('employees'));
                }
            }
        }

        if ($id == '') {
            $title = 'Add Daily Report';
        } else {
        	$title = 'Edit Daily Report';
            $data['work_info'] = $this->db->query("SELECT * from tblemployeeworkreport where id = '".$id."' ")->row();
            $data['workListInfo'] = $this->db->query("SELECT * from tblemployeeworkreportlist where main_id = '".$id."' ")->result_array();
        }

        $data['title']     = $title;
        $this->load->view('admin/employees/add', $data);
    }


    public function delete_report($id) {
        check_permission(283,'delete');

        $delete = $this->home_model->delete('tblemployeeworkreport',array('id'=>$id));

        if($delete == true){
            $this->home_model->delete('tblemployeeworkreportlist',array('main_id'=>$id));
            set_alert('success', 'Report deleted successfully');
            redirect(admin_url('employees'));
        }

    }


    public function employee_work_report() {

        check_permission(285,'view');
        $where = " id > 0 ";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));

               $where .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
           }

           if(!empty($staff_id)) {

                $data['s_staffId'] = $staff_id;
                $where .= " and staff_id = '".$staff_id."' ";
           }
        }else{
            $where .= " and MONTH(`date`) = '".date('m')."' and YEAR(`date`) = '".date('Y')."' ";
        }

        $data['employee_info'] = $this->db->query("SELECT * FROM `tblstaff` where active = 1 order by firstname asc")->result_array();
        $data['work_list'] = $this->db->query("SELECT * from tblemployeeworkreport where  ".$where." order by date desc ")->result();


        $data['title'] = 'Employee Work Report';
        $this->load->view('admin/employees/employee_work_report', $data);
    }


   public function get_work_list()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            $list_info  = $this->db->query("SELECT * from tblemployeeworkreportlist where main_id = '".$id."' ")->result();
            ?>
            <div class="row">
                <div class="table-responsive">
                    <div class="col-md-12">
                        <table class="table ui-table">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">S.No.</th>
                                    <th style="width: 15%;">Project</th>
                                    <th style="width: 15%;">Module</th>
                                    <th style="width: 10%;">Start Time</th>
                                    <th style="width: 10%;">End Time</th>
                                    <th style="width: 45%;">Description</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if (!empty($list_info)) {
                                    $z = 1;
                                    foreach ($list_info as $row) {
                                        ?>

                                        <tr>
                                            <td><?php echo $z++; ?></td>
                                            <td><?php echo $row->project; ?></td>
                                            <td><?php echo $row->module; ?></td>
                                            <td><?php echo $row->start_time; ?></td>
                                            <td><?php echo $row->end_time; ?></td>
                                            <td><?php echo $row->description; ?></td>
                                        </tr>

                                        <?php
                                    }
                                } else {
                                    echo '<tr><td class="text-center" colspan="6"><h5>Record Not Found</h5></td></tr>';
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php
        }
    }

    /* this is for employee target */
    public function employee_target() {
        check_permission(334,'view');
        $data["title"] = "Employee Monthly Target";

        $where = "status = 1 ";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($division_id)) {

                $data['division_id'] = $division_id;
                $where .= " and product_category_id = '".$division_id."' ";
            }
            if(!empty($staff_id)) {

                $data['staff_id'] = $staff_id;
                $where .= " and staff_id = '".$staff_id."' ";
            }
        }

//        $data['employee_info'] = $this->db->query("SELECT * FROM `tblstaff` where active = 1 order by firstname asc")->result();
        $data['sales_person_info'] = $this->db->query("SELECT `sales_person_id` from `tblleadstaffgroup` where status = 1  ")->result();
        // $data['product_category'] = $this->db->query("SELECT * FROM `tblproductcategory` where status = 1 order by name asc")->result();
        $data['divisionmaster_list'] = $this->db->query("SELECT * FROM `tbldivisionmaster` where status = 1 order by title asc")->result();
        $data['employee_target'] = $this->db->query("SELECT * from tblemployeetarget where  ".$where." order by id desc ")->result();

        $this->load->view('admin/employees/employee_target_list', $data);
    }

    /* this function add new add monthly target of employee */
    public function add_monthly_target() {
        check_permission(334,'create');
        $data["title"] = "Add Monthly Target";

//        $data['employee_info'] = $this->db->query("SELECT * FROM `tblstaff` where active = 1 order by firstname asc")->result();
        $data['sales_person_info'] = $this->db->query("SELECT `sales_person_id` from `tblleadstaffgroup` where status = 1  ")->result();
        // $data['product_category'] = $this->db->query("SELECT * FROM `tblproductcategory` where status = 1 order by id asc")->result();
        $data['divisionmaster_list'] = $this->db->query("SELECT * FROM `tbldivisionmaster` where status = 1 order by title asc")->result();
        if(!empty($_POST)){
            extract($this->input->post());

            $insert_data = array(
                "added_by" => get_staff_user_id(),
                "staff_id" => $staff_id,
                "product_category_id" => $product_category_id,
                "amount" => $amount,
                "date" => date("Y-m-d"),
                "remark" => $remark,
                "status" => 1,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            );
            $insert_id = $this->home_model->insert("tblemployeetarget", $insert_data);
            if ($insert_id){
                set_alert('success', 'Target add successfully');
                redirect(admin_url('employees/employee_target'));
            }else{
                set_alert('danger', 'somthing went wrong');
                redirect(admin_url('employees/employee_target'));
            }
        }
        $this->load->view('admin/employees/employee_target_add', $data);
    }

    /* this function add new edit monthly target of employee */
    public function employee_target_edit($id) {
        $data["title"] = "Edit Monthly Target";
        check_permission(334,'edit');
//        $data['employee_info'] = $this->db->query("SELECT * FROM `tblstaff` where active = 1 order by firstname asc")->result();
        $data['sales_person_info'] = $this->db->query("SELECT `sales_person_id` from `tblleadstaffgroup` where status = 1  ")->result();
        // $data['product_category'] = $this->db->query("SELECT * FROM `tblproductcategory` where status = 1 order by id asc")->result();
        $data['employee_target'] = $this->db->query("SELECT * from tblemployeetarget where  `id`=".$id."")->row();
        $data['divisionmaster_list'] = $this->db->query("SELECT * FROM `tbldivisionmaster` where status = 1 order by title asc")->result();
        if(!empty($_POST)){
            extract($this->input->post());

            $insert_data = array(
                "staff_id" => $staff_id,
                "product_category_id" => $product_category_id,
                "amount" => $amount,
                "date" => date("Y-m-d"),
                "remark" => $remark,
                "updated_at" => date("Y-m-d H:i:s"),
            );
            $update_id = $this->home_model->update("tblemployeetarget", $insert_data, array("id" => $id));
            if ($update_id){

                $year = date("Y", strtotime($data['employee_target']->date));
                $month = date("m", strtotime($data['employee_target']->date));
                $oldamount = $data['employee_target']->amount;

                /* Start Employee Target Code Log */
                    $where = "`staff_id`='".$staff_id."' AND `product_category_id`='".$product_category_id."' AND `month`='".$month."' AND `year`='".$year."'";
                    $chk_log = $this->db->query("SELECT `id` FROM `tblemployeetarget_log` WHERE ".$where." ")->row();

                    $log_arr = array(
                        "staff_id" => $staff_id,
                        "product_category_id" => $product_category_id,
                        "month" => $month,
                        "year" => $year,
                        "amount" => $oldamount,
                        "remark" => $remark,
                        "created_at" => date("Y-m-d H:i:s"),
                        "updated_at" => date("Y-m-d H:i:s"),
                    );
                    if (!empty($chk_log)){
                        unset($chk_log["created_at"]);
                        $this->home_model->update("tblemployeetarget_log", $log_arr, array("id" => $chk_log->id));
                    }else{
                        $this->home_model->insert("tblemployeetarget_log", $log_arr);
                    }
                /* End Employee Target Code Log */

                set_alert('success', 'Target update successfully');
                redirect(admin_url('employees/employee_target'));
            }else{
                set_alert('danger', 'somthing went wrong');
                redirect(admin_url('employees/employee_target'));
            }
        }
        $this->load->view('admin/employees/employee_target_add', $data);
    }

    /* this is for employee target delete */
    public function employee_target_delete($id) {
        check_permission(334,'delete');
        $this->home_model->delete('tblemployeetarget',array('id'=>$id));
        set_alert('success', 'Employee target deleted successfully');
        redirect(admin_url('employees/employee_target'));
    }

    /* this function use for get staff target list */
    public function staff_target_list($id = 0) {
        //check_permission(335,'view');
        $data["title"] = "Monthly Target";
        $data["staff_id"] = $id;
        $data["check_staff_id"] = $id;

        $staff_id = ($id == 0) ? get_staff_user_id() : $id;
        $data['month_arr'][] = date("m");
        $data['year'] = date("Y");
        $where = "staff_id = '".$staff_id."'";
        if(!empty($_POST)){
            extract($this->input->post());
             
            $data['search_by'] = $search_by;
            if (!empty($staff_id)){
                $data["staff_id"] = $staff_id;
                $where = "staff_id = '".$staff_id."'";
            }
            if(!empty($month_arr) && !empty($year)){

                $data['month_arr'] = $month_arr;
                $data['year'] = $year;
            }
            if(!empty($f_date) && !empty($t_date)){

                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;
                $data['month_arr'] = getMonthsInRange(db_date($f_date), db_date($t_date));
                
            }
        }
        
        $data['employee_target'] = $this->db->query("SELECT * from tblemployeetarget where staff_id = '".$staff_id."'")->result();
        $data['employee_list'] = $this->db->query("SELECT staff_id from tblemployeetarget GROUP BY staff_id ")->result();
        $data['month_info'] = $this->home_model->get_result('tblmonths', '', '');
        $this->load->view('admin/employees/target_list', $data);
    }

    public function achievedTargetInvoiceList($staff_id, $month, $year, $pro_category_id) {
        $data["title"] = "Achieved Target Invoices";
        $f_date = $this->input->get("f_data");
        $t_date = $this->input->get("t_date");
        $orthercategoryid = $this->input->get("orthercategoryid");
        $service_type = $this->input->get("service_type");
        $invoice_ids = $this->input->get("invoice_ids");
        $invoice_ids = ($invoice_ids != "") ? $invoice_ids : "";
        $service_type = ($service_type != "") ? $service_type : 2;
        $data['target_invoice'] = getSaffArchiveTargetList($staff_id, $month, $year, $pro_category_id, $f_date, $t_date, $orthercategoryid, $service_type, $invoice_ids);
        
        $this->load->view('admin/employees/achievedTargetInvoiceList', $data);
    }

    public function pf_deduction_list(){
        $where = "status > 0 and contribution_for = 1";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($month) || !empty($month)){
                if(!empty($month)){
                    $data['month'] = $month;
                    $where .= " and month = ".$month;
                }
                if(!empty($year)){
                    $data['year'] = $year;
                    $where .= " and year = ".$year;
                }
            }
        }
        $data['month_info'] = $this->home_model->get_result('tblmonths', '', '');
        $data['tds_report'] = $this->db->query("SELECT * FROM tblemployee_pf_esic_deduction WHERE $where ORDER BY id DESC ")->result();
        $data['title'] = 'PF Deduction List';
        $this->load->view('admin/employees/pf_deduction_list', $data);
    }

    public function esic_deduction_list(){
        $where = "status > 0 and contribution_for = 2";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($month) || !empty($month)){
                if(!empty($month)){
                    $data['month'] = $month;
                    $where .= " and month = ".$month;
                }
                if(!empty($year)){
                    $data['year'] = $year;
                    $where .= " and year = ".$year;
                }
            }
        }
        $data['month_info'] = $this->home_model->get_result('tblmonths', '', '');
        $data['tds_report'] = $this->db->query("SELECT * FROM tblemployee_pf_esic_deduction WHERE $where ORDER BY id DESC ")->result();
        $data['title'] = 'ESIC Deduction List';
        $this->load->view('admin/employees/esic_deduction_list', $data);
    }

    /* this function use for pt deduction list */
    public function pt_deduction_list(){
        $where = "status > 0 and contribution_for = 3";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($month) || !empty($month)){
                if(!empty($month)){
                    $data['month'] = $month;
                    $where .= " and month = ".$month;
                }
                if(!empty($year)){
                    $data['year'] = $year;
                    $where .= " and year = ".$year;
                }
            }
        }
        $data['month_info'] = $this->home_model->get_result('tblmonths', '', '');
        $data['pt_report'] = $this->db->query("SELECT * FROM tblemployee_pf_esic_deduction WHERE $where ORDER BY id DESC ")->result();
        $data['title'] = 'PT Deduction List';
        $this->load->view('admin/employees/pt_deduction_list', $data);
    }

    public function update_pf_deduction(){
        if(!empty($_POST)){
            extract($this->input->post());

            $response = $this->home_model->update("tblemployee_pf_esic_deduction", array($contribute_field_type => $contribute_field_val), array("id" => $pf_defuction_id));
            if ($response){
                if ($section == "PF"){
                    set_alert('success', 'PF deduction update successfully');
                    redirect(admin_url('employees/pf_deduction_list'));
                }else if ($section == "PT"){
                    set_alert('success', 'PT deduction update successfully');
                    redirect(admin_url('employees/pt_deduction_list'));
                }else{
                    set_alert('success', 'ESIC deduction update successfully');
                    redirect(admin_url('employees/esic_deduction_list'));
                }
            }
        }    
    }
    /* this function use for pt challan list */
    public function pt_challan_list(){
        $where = "status > 0 and challan_for = 3";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and challan_date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }
        }

        $data['pf_challan_list'] = $this->db->query("SELECT * FROM tblemployee_pf_esic_challan WHERE $where ORDER BY id DESC ")->result();
       
        $data['title'] = 'PT Challan List';
        $this->load->view('admin/employees/pt_challan_list', $data);
    }

    /* this function use for pf challan list */
    public function pf_challan_list(){
        $where = "status > 0 and challan_for = 1";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and challan_date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }
        }

        $data['pf_challan_list'] = $this->db->query("SELECT * FROM tblemployee_pf_esic_challan WHERE $where ORDER BY id DESC ")->result();
       
        $data['title'] = 'PF Challan List';
        $this->load->view('admin/employees/pf_challan_list', $data);
    }

    /* this function use for esic challan list */
    public function esic_challan_list(){
        $where = "status > 0 and challan_for = 2";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and challan_date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }
        }

        $data['esic_challan_list'] = $this->db->query("SELECT * FROM tblemployee_pf_esic_challan WHERE $where ORDER BY id DESC ")->result();
       
        $data['title'] = 'ESIC Challan List';
        $this->load->view('admin/employees/esic_challan_list', $data);
    }

    public function add_pf_challan($id = ''){
        if(!empty($_POST)){
            extract($this->input->post());
           
            $late_fees_payment = (!empty($late_fees_payment) && $late_fees_payment == 'on') ? 1 : 0;
            $sdata = array(
                'added_by' => get_staff_user_id(),
                'challan_no' => $challan_no,
                'challan_date' => db_date($challan_date),
                'payment_date' => db_date($payment_date),
                'employee_contribution' => $employee_contribution,
                'employer_contribution' => $employer_contribution,
                'pf_admin' => $pf_admin,
                'pf_edli' => $pf_edli,
                'total_amount' => $ttl_challan_amt,
                'challan_for' => 1,
                'status' => 1,
                'Interested_late_fees_payment' => $late_fees_payment,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            
            if ($id != ''){
                unset($sdata["added_by"]);
                unset($sdata["created_at"]);
                $updateid = $this->home_model->update('tblemployee_pf_esic_challan', $sdata, array('id' => $id));
                if ($updateid){
                    set_alert('success', 'PF Challan update succesfully');
                    redirect(admin_url('employees/pf_challan_list'));
                }
            }else{
                $insert_id = $this->home_model->insert('tblemployee_pf_esic_challan', $sdata);
                if ($insert_id){
                    set_alert('success', 'PF Challan added succesfully');
                    redirect(admin_url('employees/pf_challan_list'));
                }
            }
        }

        if ($id != ''){
            $data["pf_challan_info"] = $this->db->query("SELECT * FROM tblemployee_pf_esic_challan WHERE id = '".$id."' AND challan_for = 1 ")->row();
            $data['title'] = 'Edit PF Challan';
        }else{
            $data['title'] = 'Add PF Challan';
        }
        
        $this->load->view('admin/employees/add_pf_challan', $data);
    }

    public function add_esic_challan($id = ''){
        if(!empty($_POST)){
            extract($this->input->post());
           
            $late_fees_payment = (!empty($late_fees_payment) && $late_fees_payment == 'on') ? 1 : 0;
            $sdata = array(
                'added_by' => get_staff_user_id(),
                'challan_no' => $challan_no,
                'challan_date' => db_date($challan_date),
                'payment_date' => db_date($payment_date),
                'employee_contribution' => $employee_contribution,
                'employer_contribution' => $employer_contribution,
                'total_amount' => $ttl_challan_amt,
                'challan_for' => 2,
                'status' => 1,
                'Interested_late_fees_payment' => $late_fees_payment,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            
            if ($id != ''){
                unset($sdata["added_by"]);
                unset($sdata["created_at"]);
                $updateid = $this->home_model->update('tblemployee_pf_esic_challan', $sdata, array('id' => $id));
                if ($updateid){
                    set_alert('success', 'ESIC Challan update succesfully');
                    redirect(admin_url('employees/esic_challan_list'));
                }
            }else{
                $insert_id = $this->home_model->insert('tblemployee_pf_esic_challan', $sdata);
                if ($insert_id){
                    set_alert('success', 'ESIC Challan added succesfully');
                    redirect(admin_url('employees/esic_challan_list'));
                }
            }
        }

        if ($id != ''){
            $data["pf_challan_info"] = $this->db->query("SELECT * FROM tblemployee_pf_esic_challan WHERE id = '".$id."' AND challan_for = 2 ")->row();
            $data['title'] = 'Edit ESIC Challan';
        }else{
            $data['title'] = 'Add ESIC Challan';
        }
        
        $this->load->view('admin/employees/add_esic_challan', $data);
    }

    public function add_pt_challan($id = ''){
        if(!empty($_POST)){
            extract($this->input->post());
           
            $late_fees_payment = (!empty($late_fees_payment) && $late_fees_payment == 'on') ? 1 : 0;
            $sdata = array(
                'added_by' => get_staff_user_id(),
                'challan_no' => $challan_no,
                'challan_date' => db_date($challan_date),
                'payment_date' => db_date($payment_date),
                'employee_contribution' => '0.00',
                'employer_contribution' => '0.00',
                'total_amount' => $ttl_challan_amt,
                'challan_for' => 3,
                'status' => 1,
                'Interested_late_fees_payment' => $late_fees_payment,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            
            if ($id != ''){
                unset($sdata["added_by"]);
                unset($sdata["created_at"]);
                $updateid = $this->home_model->update('tblemployee_pf_esic_challan', $sdata, array('id' => $id));
                if ($updateid){
                    set_alert('success', 'PT Challan update succesfully');
                    redirect(admin_url('employees/pt_challan_list'));
                }
            }else{
                $insert_id = $this->home_model->insert('tblemployee_pf_esic_challan', $sdata);
                if ($insert_id){
                    set_alert('success', 'PT Challan added succesfully');
                    redirect(admin_url('employees/pt_challan_list'));
                }
            }
        }

        if ($id != ''){
            $data["pt_challan_info"] = $this->db->query("SELECT * FROM tblemployee_pf_esic_challan WHERE id = '".$id."' AND challan_for = 3 ")->row();
            $data['title'] = 'Edit PT Challan';
        }else{
            $data['title'] = 'Add PT Challan';
        }
        
        $this->load->view('admin/employees/add_pt_challan', $data);
    }

    public function view_pt_challan($id){

        $pt_challan_info = $this->db->query("SELECT * FROM tblemployee_pf_esic_challan WHERE id = '".$id."' ")->row();
        $data["pt_deduction_list"] = $this->db->query("SELECT * FROM  tblemployee_pf_esic_deduction WHERE challan_id = '".$pt_challan_info->id."' ORDER BY id DESC ")->result();
        $data['pt_challan_info'] = $pt_challan_info;
        $data['title'] = 'View PT Challan';
        
        $this->load->view('admin/employees/view_pt_challan', $data);
    }

    public function view_pf_challan($id){

        $pf_challan_info = $this->db->query("SELECT * FROM tblemployee_pf_esic_challan WHERE id = '".$id."' ")->row();
        $data["pf_deduction_list"] = $this->db->query("SELECT * FROM  tblemployee_pf_esic_deduction WHERE challan_id = '".$pf_challan_info->id."' ORDER BY id DESC ")->result();
        $data['pf_challan_info'] = $pf_challan_info;
        if ($pf_challan_info->challan_for == 1){
            $data['title'] = 'View PF Challan';
        }else{
            $data['title'] = 'View ESIC Challan';
        }
        
        $this->load->view('admin/employees/view_pf_challan', $data);
    }

    public function delete_pf_challan($id){
        $response = $this->home_model->delete("tblemployee_pf_esic_challan", array("id" => $id));
        if ($response){
            $this->home_model->update("tblemployee_pf_esic_deduction", array("challan_id" => 0), array("challan_id" => $id));
            set_alert('success', 'Challan deleted succesfully');
            redirect(admin_url('employees/pf_challan_list'));
        }
    }
    public function delete_pt_challan($id){
        $response = $this->home_model->delete("tblemployee_pf_esic_challan", array("id" => $id));
        if ($response){
            $this->home_model->update("tblemployee_pf_esic_deduction", array("challan_id" => 0), array("challan_id" => $id));
            set_alert('success', 'Challan deleted succesfully');
            redirect(admin_url('employees/pt_challan_list'));
        }
    }

    public function get_pf_deduction(){
        if(!empty($_POST)){
            extract($this->input->post());
            
            $getDeduction = $this->db->query("SELECT * FROM tblemployee_pf_esic_deduction WHERE status = '1' AND contribution_for = 1")->result();
            echo "<option value=''></option>";
            if (!empty($getDeduction)){
                foreach ($getDeduction as $value) {
                    $employee_name = get_employee_fullname($value->employee_id);
                    $total_amount = ($value->employee_contribution+$value->employer_contribution+$value->pf_admin+$value->pf_edli);
                    $month = value_by_id("tblmonths", $value->month, "month_name");
                    $yearmonth = "<span>".$month." / ".$value->year."</span>";
                    if ($deduction_id == '0'){
                        if ($value->challan_id == '0'){
                            echo "<option value='".$value->id."'>".cc($employee_name).' - '.$total_amount.' - '.' ('.$yearmonth.')'."</option>";
                        }
                    }else{
                        if ($value->challan_id == $pfchallan_id || $value->challan_id == '0'){
                            $deductionarr = explode(',', $deduction_id);
                            $selectedcls = (in_array($value->id, $deductionarr)) ? 'selected=""' : '';
                            echo "<option value='".$value->id."' ".$selectedcls.">".cc($employee_name).' - '.$total_amount.' - '.' ('.$yearmonth.')'."</option>";
                        }
                    }
                }
            }
        }    
    }

    public function get_pt_deduction(){
        if(!empty($_POST)){
            extract($this->input->post());
            
            $getDeduction = $this->db->query("SELECT * FROM tblemployee_pf_esic_deduction WHERE status = '1' AND contribution_for = 3")->result();
            echo "<option value=''></option>";
            if (!empty($getDeduction)){
                foreach ($getDeduction as $value) {
                    $employee_name = get_employee_fullname($value->employee_id);
                    $total_amount = ($value->pt_amount);
                    $month = value_by_id("tblmonths", $value->month, "month_name");
                    $yearmonth = "<span>".$month." / ".$value->year."</span>";
                    if ($deduction_id == '0'){
                        if ($value->challan_id == '0'){
                            echo "<option value='".$value->id."'>".cc($employee_name).' - '.$total_amount.' - '.' ('.$yearmonth.')'."</option>";
                        }
                    }else{
                        if ($value->challan_id == $ptchallan_id || $value->challan_id == '0'){
                            $deductionarr = explode(',', $deduction_id);
                            $selectedcls = (in_array($value->id, $deductionarr)) ? 'selected=""' : '';
                            echo "<option value='".$value->id."' ".$selectedcls.">".cc($employee_name).' - '.$total_amount.' - '.' ('.$yearmonth.')'."</option>";
                        }
                    }
                }
            }
        }    
    }

    public function get_esic_deduction(){
        if(!empty($_POST)){
            extract($this->input->post());
            
            $getDeduction = $this->db->query("SELECT * FROM tblemployee_pf_esic_deduction WHERE status = '1' AND contribution_for = 2")->result();
            echo "<option value=''></option>";
            if (!empty($getDeduction)){
                foreach ($getDeduction as $value) {
                    $employee_name = get_employee_fullname($value->employee_id);
                    $total_amount = ($value->employee_contribution+$value->employer_contribution+$value->pf_admin+$value->pf_edli);
                    $month = value_by_id("tblmonths", $value->month, "month_name");
                    $yearmonth = "<span>".$month." / ".$value->year."</span>";
                    if ($deduction_id == '0'){
                        if ($value->challan_id == '0'){
                            echo "<option value='".$value->id."'>".cc($employee_name).' - '.$total_amount.' - '.' ('.$yearmonth.')'."</option>";
                        }
                    }else{
                        if ($value->challan_id == $esicchallan_id || $value->challan_id == '0'){
                            $deductionarr = explode(',', $deduction_id);
                            $selectedcls = (in_array($value->id, $deductionarr)) ? 'selected=""' : '';
                            echo "<option value='".$value->id."' ".$selectedcls.">".cc($employee_name).' - '.$total_amount.' - '.' ('.$yearmonth.')'."</option>";
                        }
                    }
                }
            }
        }    
    }

    /* this function use for pf / esic  deduction link */
    public function linkChallanDeduction(){
        if(!empty($_POST)){
            extract($this->input->post());
            
            $this->home_model->update("tblemployee_pf_esic_deduction", array("challan_id" => 0), array("challan_id" => $pfchallan_id));
            if (!empty($pf_deduction_id)){
                foreach($pf_deduction_id as $deduction_id){
                    $this->home_model->update("tblemployee_pf_esic_deduction", array("challan_id" => $pfchallan_id), array("id" => $deduction_id));
                }
            }
            set_alert('success', 'PF Deduction linked succesfully');
            redirect(admin_url('employees/pf_challan_list'));
        }    
    }

    public function linkPTChallanDeduction(){
        if(!empty($_POST)){
            extract($this->input->post());
            
            $this->home_model->update("tblemployee_pf_esic_deduction", array("challan_id" => 0), array("challan_id" => $ptchallan_id));
            if (!empty($pt_deduction_id)){
                foreach($pt_deduction_id as $deduction_id){
                    $this->home_model->update("tblemployee_pf_esic_deduction", array("challan_id" => $ptchallan_id), array("id" => $deduction_id));
                }
            }
            set_alert('success', 'PT Deduction linked succesfully');
            redirect(admin_url('employees/pt_challan_list'));
        }    
    }

    public function linkESICChallanDeduction(){
        if(!empty($_POST)){
            extract($this->input->post());
            
            $this->home_model->update("tblemployee_pf_esic_deduction", array("challan_id" => 0), array("challan_id" => $esicchallan_id));
            if (!empty($esic_deduction_id)){
                foreach($esic_deduction_id as $deduction_id){
                    $this->home_model->update("tblemployee_pf_esic_deduction", array("challan_id" => $esicchallan_id), array("id" => $deduction_id));
                }
            }
            set_alert('success', 'ESIC Deduction linked succesfully');
            redirect(admin_url('employees/esic_challan_list'));
        }    
    }

    public function get_pf_challan(){
        if(!empty($_POST)){
            extract($this->input->post());
            $pf_challan_list = $this->db->query("SELECT `tc`.`id`,`tc`.`challan_no`,`tc`.`challan_date`,`tc`.`total_amount` FROM tblemployee_pf_esic_challan as tc WHERE tc.Interested_late_fees_payment = 0 AND tc.challan_for = 1 ORDER BY tc.id ASC ")->result();
            echo "<option value=''></option>";
            if (!empty($pf_challan_list)){
                foreach ($pf_challan_list as $value) {
                    $selectedcls = ($challan_id == $value->id) ? 'selected=""' : '';
                    echo "<option value='".$value->id."' ".$selectedcls.">".cc($value->challan_no).' ('.$value->total_amount.') ('._d($value->challan_date).')'."</option>";
                }
            }
        }    
    }
    public function get_esic_challan(){
        if(!empty($_POST)){
            extract($this->input->post());
            $pf_challan_list = $this->db->query("SELECT `tc`.`id`,`tc`.`challan_no`,`tc`.`challan_date`,`tc`.`total_amount` FROM tblemployee_pf_esic_challan as tc WHERE tc.Interested_late_fees_payment = 0 AND tc.challan_for = 2 ORDER BY tc.id ASC ")->result();
            echo "<option value=''></option>";
            if (!empty($pf_challan_list)){
                foreach ($pf_challan_list as $value) {
                    $selectedcls = ($challan_id == $value->id) ? 'selected=""' : '';
                    echo "<option value='".$value->id."' ".$selectedcls.">".cc($value->challan_no).' ('.$value->total_amount.') ('._d($value->challan_date).')'."</option>";
                }
            }
        }    
    }
    public function get_pt_challan(){
        if(!empty($_POST)){
            extract($this->input->post());
            $pt_challan_list = $this->db->query("SELECT `tc`.`id`,`tc`.`challan_no`,`tc`.`challan_date`,`tc`.`total_amount` FROM tblemployee_pf_esic_challan as tc WHERE tc.Interested_late_fees_payment = 0 AND tc.challan_for = 3 ORDER BY tc.id ASC ")->result();
            echo "<option value=''></option>";
            if (!empty($pt_challan_list)){
                foreach ($pt_challan_list as $value) {
                    $selectedcls = ($challan_id == $value->id) ? 'selected=""' : '';
                    echo "<option value='".$value->id."' ".$selectedcls.">".cc($value->challan_no).' ('.$value->total_amount.') ('._d($value->challan_date).')'."</option>";
                }
            }
        }    
    }

    public function addPFChallan(){
        if(!empty($_POST)){
            extract($this->input->post());
            
            $response = $this->home_model->update("tblemployee_pf_esic_deduction", array("challan_id" => $challan_id), array("id" => $tds_id));
            if ($response){
                set_alert('success', 'PF challan linked succesfully');
                redirect(admin_url('employees/pf_deduction_list'));
            }
        }    
    }

    public function addPTChallan(){
        if(!empty($_POST)){
            extract($this->input->post());
            
            $response = $this->home_model->update("tblemployee_pf_esic_deduction", array("challan_id" => $challan_id), array("id" => $tds_id));
            if ($response){
                set_alert('success', 'PT challan linked succesfully');
                redirect(admin_url('employees/pt_deduction_list'));
            }
        }    
    }

    public function addESICChallan(){
        if(!empty($_POST)){
            extract($this->input->post());
            
            $response = $this->home_model->update("tblemployee_pf_esic_deduction", array("challan_id" => $challan_id), array("id" => $tds_id));
            if ($response){
                set_alert('success', 'ESIC challan linked succesfully');
                redirect(admin_url('employees/esic_deduction_list'));
            }
        }    
    }




    ///   Software Task Module ///

    public function software_task_list() {

        check_permission(444,'view');
        $where = " id > 0 ";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));

               $where .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
           }
           if(!empty($staff_id)){
                $data['staff_id'] = $staff_id;
                $where .= " and added_by = '".$staff_id."' ";
           }
           if(!empty($status)){
                $data['status'] = $status;
                $where .= " and status = '".$status."' ";
           }
           if(!empty($priority)){
                $data['priority'] = $priority;
                $where .= " and priority = '".$priority."' ";
           }
        }

        $data['employee_list'] = $this->db->query("SELECT staffid, firstname from tblstaff where active = 1 order by firstname asc ")->result_array();
        $data['status_list'] = $this->db->query("SELECT * from tblsoftwaretask_status where status = 1  ")->result_array();
        $data['task_list'] = $this->db->query("SELECT * from tblsoftwaretask where  ".$where." order by id desc ")->result();


        $data['title'] = 'Software Task List';
        $this->load->view('admin/employees/software_task_list', $data);
    }

    public function add_software_task($id = '') {
        //check_permission(283,'create');
        if ($this->input->post()) {
            $proposal_data = $this->input->post();

            if ($id == '') {
                 $id = $this->Employee_model->add_software_task($proposal_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', 'Software Task'));
                    redirect(admin_url('employees/software_task_list'));
                }
            } 
        }

        $data['title']     = 'Add Software Task';
        $this->load->view('admin/employees/add_software_task', $data);
    }

    public function get_edit_task_html($id = '') {
        if ($this->input->post()) {
            extract($this->input->post());
            $task_info = $this->db->query("SELECT * from tblsoftwaretask where id = '".$id."'  ")->row();    
            ?>
            <input type="hidden" name="id" value="<?php echo $task_info->id; ?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="source" class="control-label">Priority</label>
                            <select class="form-control selectpicker" id="priority" name="priority" required data-live-search="true">                             
                                <option value="1" <?php echo (isset($task_info->priority) && $task_info->priority == 1) ? 'selected' : ''; ?>>Low</option>
                                <option value="2" <?php echo (isset($task_info->priority) && $task_info->priority == 2) ? 'selected' : ''; ?>>Medium</option>
                                <option value="3" <?php echo (isset($task_info->priority) && $task_info->priority == 3) ? 'selected' : ''; ?>>High</option>
                                <option value="4" <?php echo (isset($task_info->priority) && $task_info->priority == 4) ? 'selected' : ''; ?>>Urgent</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="source" class="control-label">Module</label>
                            <input type="text" class="form-control" value="<?php echo $task_info->module; ?>" required="" name="module" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="target_date" class="control-label">Target Date</label>
                            <input type="date" class="form-control" name="target_date" id="target_date" value="<?php echo $task_info->target_date; ?>"  required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="source" class="control-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="5" required><?php echo $task_info->description; ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="source" class="control-label">File Upload</label>
                            <input type="file" class="form-control"  name="image">
                        </div>
                        <?php
                        if(!empty($task_info->image)){
                            $extension = pathinfo($task_info->image, PATHINFO_EXTENSION);
                            if (in_array(strtolower($extension), ["jpg", "jpeg", "png"])){
                                $img_url = base_url('uploads/software_task/') . $id . "/" . $task_info->image;
                                echo '<img src="' . $img_url . '" class="image-responsive" style="height: 100px; width : 100px;" alt="" />';
                            }else{
                                $img_url = base_url('uploads/software_task/') . $id . "/" . $task_info->image;
                                echo '<a href="'.$img_url.'" title="'.$task_info->image.'" target="_blank"><i class="fa-2x fa fa-file-pdf-o" aria-hidden="true"></i></a>';
                            }   
                            // $img_url = base_url('uploads/software_task/') . $id . "/" . $task_info->image;
                            // echo '<img src="' . $img_url . '" class="image-responsive" style="height: 100px; width : 100px;" alt="" />';
                        }
                        
                        ?>
                    </div>
                </div>

            <?php

        }
    }

    public function update_software_task() {
        check_permission(444,'create');
        if ($this->input->post()) {
            extract($this->input->post());
           
            $update_data = array(
                "priority" => $priority,
                "description" => $description,
                "module" => $module,
                "target_date" => db_date($target_date),
                "updated_at" => date("Y-m-d H:i:s"),
            );
            if($this->home_model->update("tblsoftwaretask", $update_data, array("id" => $id))){

                /* THIS CODE USE FOR DELETE OLD FILE IF UPLOAD NEW FILES */
                if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                    $getoldfile = value_by_id_empty('tblsoftwaretask', $id, 'image');
                    if (!empty($getoldfile)){
                        $path = get_upload_path_by_type('software_task') . $id . '/'.$getoldfile;
                        unlink($path);
                    }
                }
                software_task_image_upload($id);                
                set_alert('success', _l('updated_successfully', 'Software Task'));
                redirect(admin_url('employees/software_task_list'));
            }
            
        }
    }

    public function delete_task($id) {

        $getoldfile = value_by_id_empty('tblsoftwaretask', $id, 'image');
        if($this->home_model->delete("tblsoftwaretask", array("id" => $id))){

            /* THIS CODE USE FOR DELETE UPLOADED FILES */
            if (!empty($getoldfile)){
                $dirpath = get_upload_path_by_type('software_task') . $id;
                remove_all_uploaded_files($dirpath);
            }                
            set_alert('warning', _l('Software Task Deleted succesfully'));
            redirect(admin_url('employees/software_task_list'));
        }
    }

    public function software_task_report() {

        check_permission(445,'view');
        $where = " id > 0 ";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                // $f_date = str_replace("/","-",$f_date);
                // $t_date = str_replace("/","-",$t_date);

                // $from_date = date('Y-m-d',strtotime($f_date));
                // $to_date = date('Y-m-d',strtotime($t_date));

                $where .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
           }
           if(!empty($staff_id)){
                $data['staff_id'] = $staff_id;
                $where .= " and added_by = '".$staff_id."' ";
           }
           if(!empty($status)){
                $data['status'] = $status;
                $where .= " and status = '".$status."' ";
           }
           if(!empty($priority)){
                $data['priority'] = $priority;
                $where .= " and priority = '".$priority."' ";
           }
        }else{
            $where .= " and status != 1 ";
        }

        $data['employee_list'] = $this->db->query("SELECT staffid, firstname from tblstaff where active = 1 order by firstname asc ")->result_array();
        $data['status_list'] = $this->db->query("SELECT * from tblsoftwaretask_status where status = 1  ")->result_array();
        $data['task_list'] = $this->db->query("SELECT * from tblsoftwaretask where  ".$where." order by id desc ")->result();


        $data['title'] = 'Software Task Report';
        $this->load->view('admin/employees/software_task_report', $data);
    }

    public function chage_task_status_html($id = '') {
        if ($this->input->post()) {
            extract($this->input->post());
            $task_info = $this->db->query("SELECT * from tblsoftwaretask where id = '".$id."'  ")->row();    
            $task_status_info = $this->db->query("SELECT * from tblsoftwaretask_status where status = 1  ")->result();    
            ?>
            <input type="hidden" name="id" value="<?php echo $task_info->id; ?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="source" class="control-label">Select Status</label>
                            <select class="form-control selectpicker" id="priority" name="status" required data-live-search="true">    
                                <?php
                                if(!empty($task_status_info)){
                                    foreach ($task_status_info as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value->id; ?>" <?php echo ($task_info->status == $value->id) ? 'selected' : ''; ?>><?php echo $value->name ?></option>
                                        <?php
                                    }
                                }
                                ?> 
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6" app-field-wrapper="date">
                        <label for="start_date" class="control-label">Start Date</label>
                        <div class="input-group date">
                            <input id="start_date" name="start_date" class="form-control" value="<?php echo (!empty($task_info->start_date)) ? $task_info->start_date : ''; ?>" aria-invalid="false" type="date"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                        </div>
                    </div>
                    <div class="form-group col-md-6" app-field-wrapper="date">
                        <label for="end_date" class="control-label">End Date</label>
                        <div class="input-group date">
                            <input id="end_date" name="end_date" class="form-control" value="<?php echo (!empty($task_info->end_date)) ? $task_info->end_date : ''; ?>" aria-invalid="false" type="date"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                        </div>
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="source" class="control-label">Developer Remark</label>
                            <textarea class="form-control" name="developer_remark" id="developer_remark" rows="5"><?php echo $task_info->developer_remark; ?></textarea>
                        </div>
                    </div>
                </div>

            <?php

        }
    }

    public function update_task_status() {
        //check_permission(283,'create');
        if ($this->input->post()) {
            extract($this->input->post());
            
            $start_date = (!empty($start_date)) ? db_date($start_date) : '';
            $end_date = (!empty($end_date)) ? db_date($end_date) : '';

            $update_data = array(
                "developer_remark" => $developer_remark,
                "start_date" => $start_date,
                "end_date" => $end_date,
                "status" => $status,
                "status_updated_by" => get_staff_user_id(),
                "status_updated_at" => date("Y-m-d H:i:s"),
            );
            if($this->home_model->update("tblsoftwaretask", $update_data, array("id" => $id))){               
                set_alert('success', _l('updated_successfully', 'Software Task'));
                redirect(admin_url('employees/software_task_report'));
            }
            
        }
    }

    public function task_details_html($id = '') {
        if ($this->input->post()) {
            extract($this->input->post());
            $row = $this->db->query("SELECT * from tblsoftwaretask where id = '".$id."'  ")->row();    

            $priority = '';                                         
            if($row->priority == 1){
                $priority = '<span class="label label-warning">Low</span>';
            }elseif($row->priority == 2){
                $priority = '<span class="label label-success">Medium</span>';
            }elseif($row->priority == 3){
                $priority = '<span class="label label-info">High</span>';
            }elseif($row->priority == 4){
                $priority = '<span class="label label-danger">Urgent</span>';
            }
            ?>
                <div class="row">

                    <div class="col-md-3">
                         <h5 style="font-size:15px;color:red;"><u>Added By :</u></h5>
                         <span><?php echo get_employee_name($row->added_by); ?></span>
                     </div>

                     <div class="col-md-3">
                         <h5 style="font-size:15px;color:red;"><u>Date :</u></h5>
                         <span><?php echo _d($row->date); ?></span>
                     </div>
                     <div class="col-md-3">
                         <h5 style="font-size:15px;color:red;"><u>Target Date :</u></h5>
                         <span><?php echo _d($row->target_date); ?></span>
                     </div>

                     <div class="col-md-3">
                         <h5 style="font-size:15px;color:red;"><u>Priority :</u></h5>
                         <span><?php echo $priority; ?></span>
                     </div>

                     <div class="col-md-3">
                         <h5 style="font-size:15px;color:red;"><u>Status :</u></h5>
                         <span><?php echo value_by_id("tblsoftwaretask_status", $row->status, "name"); ?></span>
                     </div>


                      <div class="col-md-4">
                         <h5 style="font-size:15px;color:red;"><u>Module :</u></h5>
                         <span><?php echo $row->module; ?></span>
                     </div>

                      <div class="col-md-6">
                         <h5 style="font-size:15px;color:red;"><u>description :</u></h5>
                         <span><?php echo $row->description; ?></span>
                     </div>

                     <?php
                        if(!empty($row->image)){
                     ?>
                      <div class="col-md-2">
                        <h5 style="font-size:15px;color:red;"><u>Uploaded File :</u></h5>
                        <?php
                            if(!empty($row->image)){
                                $extension = pathinfo($row->image, PATHINFO_EXTENSION);
                                if (in_array(strtolower($extension), ["jpg", "jpeg", "png"])){
                                    $img_url = base_url('uploads/software_task/') . $id . "/" . $row->image;
                                    echo '<img src="' . $img_url . '" class="image-responsive image-thumbnail" style="height: 100px; width : 100px;" alt="" />';
                                }else{
                                    $img_url = base_url('uploads/software_task/') . $id . "/" . $row->image;
                                    echo '<a href="'.$img_url.'" title="'.$row->image.'" target="_blank"><i class="fa-2x fa fa-file-pdf-o" aria-hidden="true"></i></a>';
                                }    
                            }
                        ?>
                     </div>
                     <?php
                        }
                     ?>


                     <?php
                     if($row->status_updated_by > 0){
                        ?>
                        <div class="col-md-3">
                             <h5 style="font-size:15px;color:red;"><u>Status Changed By :</u></h5>
                             <span><?php echo get_employee_name($row->status_updated_by); ?></span>
                         </div>
                         <div class="col-md-3">
                             <h5 style="font-size:15px;color:red;"><u>Developer  Remark :</u></h5>
                             <span><?php echo $row->developer_remark; ?></span>
                         </div>
                        <?php
                     }
                     ?>


                </div>

            <?php

        }
    }
}
