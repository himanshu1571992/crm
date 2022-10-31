<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();
        update_option('cron_has_run_from_cli', 1);
        $this->load->model('home_model');
    }

//    public function index($key = '')
//    {
//
//        if (defined('APP_CRON_KEY') && (APP_CRON_KEY != $key)) {
//            header('HTTP/1.0 401 Unauthorized');
//            die('Passed cron job key is not correct. The cron job key should be the same like the one defined in APP_CRON_KEY constant.');
//        }
//
//        $last_cron_run = get_option('last_cron_run');
//        if ($last_cron_run == '' || (time() > ($last_cron_run + do_action('cron_functions_execute_seconds', 300)))) {
//            do_action('before_cron_run');
//
//            $this->load->model('cron_model');
//            $this->cron_model->run();
//
//            do_action('after_cron_run');
//        }
//    }
    
    /* this is for task reapet */
    public function task_reapet(){
        
        $current_date = date("Y-m-d");
        
        /* this is for task repeat */
        $check_data = $this->db->query("SELECT * FROM `tbltaskrepeat` WHERE `date` = '".$current_date."' AND `status`= 1")->result();
        if (!empty($check_data)){
            foreach ($check_data as $value) {
                
                /* this function use for update status of task*/
                $this->home_model->update("tbltaskrepeat", array("status" => 2), array("id" => $value->id));
                
                /* this is for tasks info */
                $task_data = $this->home_model->get_row('tbltasks', array('id'=> $value->task_id), '');
                if (!empty($task_data)){
                    $add_data = array(
                        'title' => $task_data->title,
                        'description' => $task_data->description,
                        'start_date' => $task_data->start_date,
                        'due_date' => $task_data->due_date,
                        'is_repeat' => $task_data->is_repeat,
                        'repeat_type' => $task_data->repeat_type,
                        'repeat_every' => $task_data->repeat_every,
                        'task_for' => $task_data->task_for,
                        'assigned_to' => $task_data->assigned_to,
                        'user_ids' => $task_data->user_ids,
                        'related_to' => $task_data->related_to,
                        'from_date' => $task_data->from_date,
                        'to_date' => $task_data->to_date,
                        'clients' => $task_data->clients,
                        'challans' => $task_data->challans,
                        'expenses' => $task_data->expenses,
                        'invoices' => $task_data->invoices,
                        'leads' => $task_data->leads,
                        'perfoma_invoices' => $task_data->perfoma_invoices,
                        'quotation' => $task_data->quotation,
                        'product_data' => $task_data->product_data,
                        'priority' => $task_data->priority,
                        'client_name' => $task_data->client_name,
                        'client_id' => $task_data->client_id,
                        'service_type' => $task_data->service_type,
                        'product_details' => $task_data->product_details,
                        'other_date' => $task_data->other_date,
                        'state_id' => $task_data->state_id,
                        'city_id' => $task_data->city_id,
                        'added_by' => $task_data->added_by,
                        'task_file' => $task_data->task_file,
                        'status' => 1,
                    );
                    $insert = $this->home_model->insert('tbltasks', $add_data); 
                    if ($insert){
                        $task_id = $this->db->insert_id();
                        
                        /* this is for get taskusers */
                        $taskusers_data = $this->db->query("SELECT * FROM `tbltaskusers` WHERE `task_id` = '".$value->task_id."'")->result();
                        if($taskusers_data){
                            foreach ($taskusers_data as $val) {
                                
                                $add_data_2 = array(
		                    'task_id' => $task_id,
		                    'staff_id' => $val->staff_id
		                );

		                $this->home_model->insert('tbltaskusers', $add_data_2); 
                            }
                        }
                        
                        $taskassign_data = $this->db->query("SELECT * FROM `tbltaskassignees` WHERE `task_id` = '".$value->task_id."'")->result();
                        
                        if ($taskassign_data){
                            foreach ($taskassign_data as $sval) {
                                $add_data_1 = array(
		                    'task_id' => $task_id,
		                    'staff_id' => $sval->staff_id,
		                    'task_status' => 0,
		                    'updated_at' => date('Y-m-d H:i:s')
		                );

                                $this->home_model->insert('tbltaskassignees', $add_data_1);  
                                
                                $master_data = $this->home_model->get_row('tblmasterapproval', array('staff_id' =>  $sval->staff_id,'table_id'=> $value->task_id, 'module_id' => 25), '');
                                if ($master_data){
                                    $notified = add_notification([
                                        'description'     => 'New Task Alloted to you',
                                        'touserid'        => $sval->staff_id,
                                        'type'            => 0,
                                        'module_id'       => 4,
                                        'table_id'        => $task_id,
                                        'category_id'     => 0,
                                        'fromuserid'      => $master_data->fromuserid,
                                        'link'            => 'Task/task_details/' . $task_id.'',

                                    ]);
                                    if ($notified) {
                                        pusher_trigger_notification([$sval->staff_id]);
                                    } 
                                    
                                    //adding on master log
                                    $adata = array(
                                        'staff_id' => $sval->staff_id,
                                        'fromuserid' => $master_data->fromuserid,
                                        'module_id' => 25,
                                        'description' => 'New Task Alloted to you',
                                        'table_id' => $task_id,
                                        'approve_status' => 0,
                                        'status' => 0,
                                        'link' => 'Task/task_details/' . $task_id,
                                        'date' => date('Y-m-d'),
                                        'date_time' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s')
                                    );  
                                    $this->db->insert('tblmasterapproval', $adata); 

                                    //Sending Mobile Intimation
                                    $token = get_staff_token($sval->staff_id);
                                    $message = 'New Task Alloted to you';
                                    $title = 'Schach';
                                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
	
	
	
	public function attendance_alert(){
		
		$current_date = date("Y-m-d");

        $day = date('D', strtotime($current_date));
		$holiday_info = $this->db->query("SELECT * FROM `tblholidays` WHERE `date` = '".date("Y-m-d")."' and status = 1 ")->row();
       
        if(empty($holiday_info) && $day != 'Sun'){
            
            $staff_info = $this->db->query("SELECT s.staffid, s.working_from, s.working_to, s.token_id FROM `tblstaff` as s LEFT JOIN tblstaffattendance as a ON s.staffid = a.staff_id WHERE s.attendance_from = 1 and s.active = 1 and a.date = '".date("Y-m-d")."' and a.status = 0 ")->result();

            if(!empty($staff_info)){
                foreach ($staff_info as $staff) {

                    $leave_info = $this->db->query("SELECT * FROM `tblleaves` where addedfrom = '".$staff->staffid."' and (from_date >= '".date("Y-m-d")."' && to_date <= '".date("Y-m-d")."') and approved_status != 2 ")->row();

                        if(empty($leave_info)){
                                $working_from = date('Y-m-d').' '.$staff->working_from.':00';
                                $working_to = date('Y-m-d').' '.$staff->working_to.':00';


                                if((date('Y-m-d H:i:s') >= $working_from) && (date('Y-m-d H:i:s') <= $working_to)){

                                 
                                    $oneHourTime = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($working_from)));                     
                                    

                                    

                                    if((date('Y-m-d H:i:s') >= $working_from) && (date('Y-m-d H:i:s') <= $oneHourTime)){
                                        $message = "Please Mark Your Attendance"; 
                                    }else{
                                        $message = "Your Leave Marked Today!";
                                    }
                                    $title = 'Schach';
                                    sendFCM($message, $title, $staff->token_id, $page = 3);
                            }
                        
                            
                        }
                }
            }

        }

	}


    /* this function use for send reminder to selected parson */
    public function send_payment_reminder(){
        $this->home_model->insert('test',array('date'=>date('Y-m-d H:i:s'), 'remark'=>'send_payment_reminder'));
        $currentday = date('d');
        $reminderlist = $this->home_model->get_result("tblpaymentrequestreminder", array("reminderdays" => $currentday), array("*"));
        if (!empty($reminderlist)){
            
            foreach ($reminderlist as $value) {
                $this->home_model->delete("tblmasterapproval", array("module_id" => 49, "table_id" => $value->id));
                
                $reminder_send = explode(',', $value->reminder_send_to);
                if (!empty($reminder_send)){
                    foreach ($reminder_send as $key => $staff_id) {

                        $message = 'Reminder for payment';
                        $adata = array(
                            'staff_id' => $staff_id,
                            'fromuserid'      => $value->user_id,
                            'module_id' => 49,
                            'table_id' => $value->id,
                            'approve_status' => 0,
                            'status' => 0,
                            'description'     => $message,
                            'link' => 'company_expense/add_paymentrequest?reminder_id='.$value->id,
                            'date' => date('Y-m-d'),
                            'date_time' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tblmasterapproval', $adata);

                        //Sending Mobile Intimation
                        $token = get_staff_token($staff_id);
                        $title = 'Schach';
                        $message = 'Payment Request send you for aaproval';
                        $send_intimation = sendFCM($message, $title, $token, $page = 2);
                    }
                }
                
            }
        }
        echo "ok";
    }

    /* this function use for send notification of cheque */
    public function send_cheque_notification(){ 
        $this->home_model->insert('test',array('date'=>date('Y-m-d H:i:s'), 'remark'=>'send_cheque_notification'));
        /* this function use for get pending cheque for current date */
        $pending_cheque = $this->db->query("SELECT * FROM `tblclientpayment` WHERE `cheque_date` = '".date('Y-m-d')."'  AND `payment_mode` = 1 AND `chaque_status` = 0 AND `status` = 1")->result();
        if (!empty($pending_cheque)){
            foreach ($pending_cheque as $value) {
                $this->home_model->delete("tblmasterapproval", array("module_id" => 50, "table_id" => $value->id));

                $getstaff = $this->db->query("SELECT `staffid` FROM `tblstaff` WHERE (designation_id  IN (12,28,52) OR admin = 1 OR staffid = ".$value->staff_id.") and active = 1")->result();

                if (!empty($getstaff)){
                    foreach ($getstaff as $staff) {

                        $message = 'Alert for Deposit Cheque';
                        $adata = array(
                            'staff_id' => $staff->staffid,
                            'fromuserid' => $value->staff_id,
                            'module_id' => 50,
                            'table_id' => $value->id,
                            'approve_status' => 0,
                            'status' => 0,
                            'description'     => $message,
                            'link' => 'manage_cheque/chequedepositrequest/deposit/'.$value->id,
                            'date' => date('Y-m-d'),
                            'date_time' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tblmasterapproval', $adata);

                        //Sending Mobile Intimation
                        $token = get_staff_token($staff->staffid);
                        $title = 'Schach';
                        $send_intimation = sendFCM($message, $title, $token, $page = 2);
                    }
                }
            }
        }

        /* this function use for get client cheque which is have pending for clearance */
        $pending_cheque = $this->db->query("SELECT * FROM `tblclientpayment` WHERE Date(`chaque_clear_date`) + 3 <= CURRENT_DATE() AND `payment_mode` = 1 AND `chaque_status` = 5 AND `status` = 1")->result();
        if (!empty($pending_cheque)){
            foreach ($pending_cheque as $value) {
                $this->home_model->delete("tblmasterapproval", array("module_id" => 51, "table_id" => $value->id));

                $getstaff = $this->db->query("SELECT `staffid` FROM `tblstaff` WHERE (designation_id  IN (12,28,52) OR admin = 1 OR staffid = ".$value->staff_id.") and active = 1")->result();
                if (!empty($getstaff)){
                    foreach ($getstaff as $staff) {

                        $message = 'Alert for deposited Cheque Clearance';
                        $adata = array(
                            'staff_id' => $staff->staffid,
                            'fromuserid' => $value->staff_id,
                            'module_id' => 51,
                            'table_id' => $value->id,
                            'approve_status' => 0,
                            'status' => 0,
                            'description'     => $message,
                            'link' => 'manage_cheque/chequedepositrequest/clearance/'.$value->id,
                            'date' => date('Y-m-d'),
                            'date_time' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tblmasterapproval', $adata);

                        //Sending Mobile Intimation
                        $token = get_staff_token($staff->staffid);
                        $title = 'Schach';
                        $send_intimation = sendFCM($message, $title, $token, $page = 2);
                    }
                }
            }
        }
        echo "OK";
    }


    public function general_cron(){
        /* this is for send staff updation notification */
        $this->send_staff_updation_notification();

        /* send notification to sales parson for next month lead projection */
        $this->send_projection_notification();

        /* send notification to accountent, admin, created person for suspense receipts */
        $this->send_suspense_receipts_notification();

        /* send notification to creator and assigned person for task overdue */
        $this->send_task_overdue_notification();

        echo 'ok';
    }


    /* this function use for send notification for staff updation */
    private function send_staff_updation_notification(){
        $this->load->model('home_model');

       // $get_staff = $this->db->query("SELECT * FROM `tblstaff` WHERE added_by > 0 and active = 1 and taxable = 1 and (epf_no = '' || epf_no = 0 || epic_no = '' || epic_no = 0)")->result();
        $get_staff = $this->db->query("SELECT * FROM `tblstaff` WHERE added_by > 0 and active = 1 and taxable = 1 and (epf_no = '' ||  epic_no = '')")->result();
        if (!empty($get_staff)){
            foreach ($get_staff as $value) {
                $register_date = $value->datecreated;
                $current_date = date("Y-m-d");
                $diffdays = dateDiffInDays($register_date, $current_date);
                
                if ($diffdays >= 3){

                    $check_notification = $this->db->query("SELECT * FROM `tblmasterapproval` WHERE `module_id`='53' AND `table_id`= '".$value->staffid."' AND `date`='".date("Y-m-d")."' ")->row();
                    if (empty($check_notification)){

                        /* this is for delete old record of this module */
                        $this->home_model->delete('tblmasterapproval', array('module_id' => '53', 'table_id' => $value->staffid));

                        /*if (empty($value->epf_no) && empty($value->epic_no)){
                            $message = "Employee ESIC and EPF update Pending";
                        }else if($value->epf_no == 0 && $value->epic_no == 0){
                            $message = "Employee ESIC and EPF update Pending";
                        }else if (empty($value->epf_no) && $value->epf_no == 0){
                            $message = "Employee EPF update Pending";
                        }else{
                            $message = "Employee ESIC update Pending";
                        }*/
                        $send_notification = 1;
                        if (empty($value->epf_no) && empty($value->epic_no)){
                            $message = "Employee ESIC and EPF update Pending";
                        }else{
                            $message = "Employee ESIC update Pending";
                            if($value->gross_salary >= 21000){
                                $send_notification = 0;
                            }
                        }

                        if($send_notification == 1){                       


                          $adata = array(
                            'staff_id' => $value->added_by,
                            'fromuserid'      => 0,
                            'module_id' => 53,
                            'table_id' => $value->staffid,
                            'approve_status' => 0,
                            'status' => 0,
                            'description'     => $message,
                            'link' => 'staff/member/'.$value->staffid,
                            'date' => date('Y-m-d'),
                            'date_time' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tblmasterapproval', $adata);

                        //Sending Mobile Intimation
                        $token = get_staff_token($value->added_by);
                        $title = 'Schach';
                        $send_intimation = sendFCM($message, $title, $token, $page = 2);  
                        }
                        
                    }
                }
            }
        }
    }

    /* THIS CODE USE FOR SEND NOTIFICATION TO SALES PARSON NEXT MONTH PROJECTION */
    public function send_projection_notification(){
        $this->load->model('home_model');

        $projection_day = 14;
        $current_day = date('d');
        $next_month_year = date('m-Y', strtotime('+1 month'));
        $next_month = date('m', strtotime($projection_day.'-'.$next_month_year));
        $next_year = date('Y', strtotime($projection_day.'-'.$next_month_year));

        /* this condition use for check day of execuation */
        if ($projection_day <= $current_day){
            
            $sales_parson = $this->db->query("SELECT `sales_person_id` from `tblleadstaffgroup` where status = 1 ORDER BY name ASC ")->result();
            if (!empty($sales_parson)){
                
                foreach ($sales_parson as $parson) {
                    
                    $chk_projection = $this->db->query("SELECT * FROM `tblleadprojection` WHERE `salesperson_id`= '".$parson->sales_person_id."' AND `month`='".$next_month."' AND `year`='".$next_year."'")->row();
                    if (empty($chk_projection)){

                        /* store lead projection of next month of sales parson */
                        $insert_projection["salesperson_id"] = $parson->sales_person_id;
                        $insert_projection["month"] = $next_month;
                        $insert_projection["year"] = $next_year;
                        $insert_projection["created_at"] = date('Y-m-d H:i:s');
                        
                        $insert_id = $this->home_model->insert("tblleadprojection", $insert_projection);
                        if ($insert_id){
                            $message = 'Send you next month lead projection submission';
                            $adata = array(
                                'staff_id' => $parson->sales_person_id,
                                'fromuserid' => 0,
                                'module_id' => 57,
                                'table_id' => $insert_id,
                                'approve_status' => 0,
                                'status' => 0,
                                'description'     => $message,
                                'link' => 'leads/lead_projection_submission/'.$insert_id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tblmasterapproval', $adata);
    
                            //Sending Mobile Intimation
                            $token = get_staff_token($parson->sales_person_id);
                            $title = 'Schach';
                            sendFCM($message, $title, $token, $page = 2);
                        }
                    }
                }
            }
        }
    }

    /* this function use for send notification for Suspense Receipts updation */
    private function send_suspense_receipts_notification(){
        $this->load->model('home_model');

        $get_suspense_account = $this->db->query("SELECT *  FROM `tblclientpayment` WHERE `is_suspense_account` = 1 and `unknown_suspense` = 0 AND `status` = 1")->result();
        if (!empty($get_suspense_account)){
            foreach ($get_suspense_account as $value) {
                
                $current_date = date("Y-m-d");
                $diffdays = dateDiffInDays($value->date, $current_date);
                if ($diffdays >= 2){
                    $getstaff = $this->db->query("SELECT `staffid` FROM `tblstaff` WHERE (designation_id  IN (12,28,52) OR admin = 1 OR staffid = ".$value->staff_id.") and active = 1")->result();
                    if (!empty($getstaff)){
                        $this->home_model->delete("tblmasterapproval", array("module_id" => 59, "table_id" => $value->id));

                        foreach ($getstaff as $staff) {
    
                            $message = 'Suspense receipts clearance is pending of amount '.$value->ttl_amt;
                            $adata = array(
                                'staff_id' => $staff->staffid,
                                'fromuserid' => $value->staff_id,
                                'module_id' => 59,
                                'table_id' => $value->id,
                                'approve_status' => 0,
                                'status' => 0,
                                'description'     => $message,
                                'link' => 'Invoice_payments/index/'.$value->id.'/suspense_account',
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tblmasterapproval', $adata);
    
                            //Sending Mobile Intimation
                            $token = get_staff_token($staff->staffid);
                            $title = 'Schach';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                        }
                    }
                }
            }
        }
    }

    /* this function use for send notification for over due over by me */
    public function send_task_overdue_notification(){
        $this->load->model('home_model');

        $get_overdue_task = $this->db->query("SELECT t.*  FROM `tbltasks` as t LEFT JOIN tbltaskassignees as ta ON t.id = ta.task_id WHERE t.added_by > 0  AND ta.task_status = 0 GROUP BY t.id")->result();
        if (!empty($get_overdue_task)){
            foreach ($get_overdue_task as $value) {
                
                
                $current_date = date("Y-m-d");
                $diff =  strtotime($current_date) - strtotime($value->due_date);
                $diffdays = (round($diff / 86400));

               //echo $diffdays = dateDiffInDays($value->due_date, $current_date);
                if ($diffdays >= 1){
                    $staff_ids = array();
                    if ($value->task_for == 1){
                        $staff_ids[] = $value->added_by;
                    }else{
                        $staff_ids = explode(',', $value->assigned_to);
                        $staff_ids[] = $value->added_by;
                        $staff_ids = array_unique($staff_ids);
                    }
                    
                    if (!empty($staff_ids)){
                        $this->home_model->delete("tblmasterapproval", array("module_id" => 58, "table_id" => $value->id));
                        foreach ($staff_ids as $staff_id) {
                            
                            if ($value->task_for == 1){
                                $message = 'Task is overdue assigned to you';
                            }else{
                                
                                if ($value->added_by == $staff_id){
                                    $message = 'Task is overdue given by you';
                                }else{
                                    $message = 'Task is overdue assigned to you';
                                }
                            }

                            $adata = array(
                                'staff_id' => $staff_id,
                                'fromuserid' => $value->added_by,
                                'module_id' => 58,
                                'table_id' => $value->id,
                                'approve_status' => 0,
                                'status' => 0,
                                'description'     => $message,
                                'link' => 'Task/task_details/'.$value->id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tblmasterapproval', $adata);
    
                            //Sending Mobile Intimation
                            $token = get_staff_token($staff_id);
                            $title = 'Schach';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                        }
                    }
                }
            }
        }
    }
}
