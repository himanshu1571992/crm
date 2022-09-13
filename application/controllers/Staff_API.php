<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Staff_API extends CI_Controller {
    
    private $get_junior_staff_list = [];
    
    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->library('form_validation');
        $this->load->helper('captcha');
        $this->load->library('session');
        
    }

    /* this function use for staff attendance */
    public function mark_attendance() {
        if(!empty($_GET))
        {
            extract($this->input->get());   
        }
        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }
        $return_arr = array("status" => false, "message" => "Please send all required parameters", "data" => []);
        if (!empty($user_id)){
            
            $return_arr = array("status" => false, "message" => "Staff doesn't exist in system", "data" => []);
            $staff_data = get_employee_info($user_id);
            if (!empty($staff_data)){
                $return_arr = array("status" => false, "message" => "Aleady attendance marked", "data" => []);
                $check_attendance = $this->db->query("SELECT `id`,`status` FROM `tblstaffattendance` WHERE `staff_id` = '".$user_id."' and date = '".date("Y-m-d")."'")->row();
                if (empty($check_attendance)){
                    $insertarr["staff_id"] = $user_id;
                    $insertarr["date"] = date("Y-m-d");
                    $insertarr["status"] = 1;
                    $insertarr["updated_at"] = date("Y-m-d H:i:s");
                    $insertarr["created_at"] = date("Y-m-d H:i:s");
                    $insertarr["marked_at"] = date("Y-m-d H:i:s");
                    
                    $this->db->insert("tblstaffattendance", $insertarr);
                    $return_arr = array("status" => true, "message" => "Attendance marked successfully", "data" => []);
                }
                elseif ($check_attendance->status != 1){
                    $updatearr["date"] = date("Y-m-d");
                    $updatearr["status"] = 1;
                    $updatearr["updated_at"] = date("Y-m-d H:i:s");
                    $updatearr["created_at"] = date("Y-m-d H:i:s");
                    $updatearr["marked_at"] = date("Y-m-d H:i:s");
                    $this->db->where(array("id" => $check_attendance->id));
                    $this->db->update("tblstaffattendance", $updatearr);
                    $return_arr = array("status" => true, "message" => "Attendance marked successfully", "data" => []);
                }
            }
        }
        header('Content-type: application/json');
        echo json_encode($return_arr);
        // http://localhost/crm/Staff_API/mark_attendance?user_id=1
    }


    public function getGroupAttendance()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }



        if(!empty($user_id)){
            $data_arr = [];
            if(!empty($date)){
                $date = str_replace("/","-",$date);
                $date = date('Y-m-d',strtotime($date));
             }else{
                $date = date('Y-m-d');
             }

             //check if attendace is marked 
             $today_attendance = $this->db->query("SELECT * from tblstaffattendance where  staff_id = '".$user_id."' and date = '".date('Y-m-d')."' ")->row();
             $today_attendance_status = 0;   
             if(!empty($today_attendance)){
                if($today_attendance->status > 0){
                    $today_attendance_status = $today_attendance->status;
                }
                
             }

             $staff_data = get_employee_info($user_id);

             if($staff_data->superior_id > 0){                
                $user_info = $this->db->query("SELECT * from tblstaff where  superior_id = '".$staff_data->superior_id."' and active = 1 ")->result();
             }

             if(!empty($user_info)){
                foreach ($user_info as $row) {

                    $affattendance_info = $this->db->query("SELECT * from tblstaffattendance where  staff_id = '".$row->staffid."' and date = '".$date."' ")->row();

                    $status = '';
                    $created_at = '';
                    $updated_at = '';
                    $marked_at = '';
                    $approved_by = '';
                    $status_id = '0';
                    if(!empty($affattendance_info)){
                        if($affattendance_info->status == 1){
                            $status = 'Present';
                            $status_id = '1';
                        }elseif($affattendance_info->status == 2){
                            $status = 'Leave';
                            $status_id = '2';
                        }elseif($affattendance_info->status == 3){
                            $status = 'Off';
                            $status_id = '3';
                        }elseif($affattendance_info->status == 4){
                            $status = 'Halfday';
                            $status_id = '4';
                        }elseif($affattendance_info->status == 5){
                            $status = 'Overtime';
                            $status_id = '5';
                        }elseif($affattendance_info->status == 6){
                            $status = 'Paid leave';
                            $status_id = '6';
                        }

                        $created_at = _d($affattendance_info->created_at);
                        $updated_at = _d($affattendance_info->updated_at);
                        $marked_at = _d($affattendance_info->marked_at);
                        

                        if($affattendance_info->approved_by > 0){
                            $approved_by = get_employee_name($affattendance_info->approved_by);
                        }
                        
                    }

                    $data_arr[] = array(
                      'name' => $row->firstname,
                      'designation' => value_by_id('tbldesignation',$row->designation_id,'designation'),
                      'date' => _d($date),
                      'status' => $status,
                      'status_id' => $status_id,
                      'created_at' => $created_at,
                      'updated_at' => $updated_at,
                      'marked_at' => $marked_at,
                      'approved_by' => $approved_by
                   );
                }
             }

            if(!empty($data_arr)){
                $return_arr['status'] = true;
                $return_arr['message'] = "Success";
                $return_arr['data'] = $data_arr;
                $return_arr['today_attendance_status'] = $today_attendance_status;
            }else{
                $return_arr['status'] = false;
                $return_arr['message'] = "Record Not Found!";
                $return_arr['data'] = [];
                $return_arr['today_attendance_status'] = $today_attendance_status;
            }
            
        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are missing!";
            $return_arr['data'] = [];
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/Staff_API/getGroupAttendance?user_id=1&date=01-10-2020

    }
    
    public function getAttendance() {
        $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }
        elseif(!empty($_POST)){
            extract($this->input->post());  
        }
        
        if(!empty($user_id)){
            $data_arr = [];
            if(!empty($date)){
                $date = str_replace("/","-",$date);
                $date = date('Y-m-d',strtotime($date));
             }else{
                $date = date('Y-m-d');
             }

            $check_time = date('Y-m-d'). ' 17:30:00';
            if(date('Y-m-d H:i:s') >= $check_time){
                $can_verify = 1;
            }else{
                $can_verify = 0;
            }

            if(empty($show_all)){
                $show_all = 0;
            }

            $this->getJuniorStaff($user_id, $date, $show_all); 
            
            if (!empty($this->get_junior_staff_list)){
                $return_arr['status'] = true;
                $return_arr['message'] = "Success";
                $return_arr['data'] = $this->get_junior_staff_list;
                $return_arr['can_verify'] = $can_verify;
            }else{
                $return_arr['status'] = false;
                $return_arr['message'] = "Record Not Found!";
                $return_arr['data'] = [];
                $return_arr['can_verify'] = 0;
            }
        }
        else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are missing!";
            $return_arr['data'] = [];
            $return_arr['can_verify'] = 0;
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);
        //http://localhost/crm/Staff_API/getAttendance?user_id=1&date=01-10-2020
    }
    
    private function getJuniorStaff($user_id, $date, $show_all){
        
        $user_info = $this->db->query("SELECT * from tblstaff where  superior_id = '".$user_id."' and active = 1 ")->result();
        if(!empty($user_info)){
            foreach ($user_info as $row) {
                if ($user_id != $row->staffid){
                    $affattendance_info = $this->db->query("SELECT * from tblstaffattendance where  staff_id = '".$row->staffid."' and date = '".$date."' and status != '0' ")->row();
                    $status = '';
                    $status_id = '0';
                    $updated_at = '';
                    $marked_at = '';
                    $created_at = $approved_by = '';

                    if(!empty($affattendance_info)){
                        $status_id = $affattendance_info->status;

                        $created_at = _d($affattendance_info->created_at);
                        $updated_at = _d($affattendance_info->updated_at);
                        $marked_at = _d($affattendance_info->marked_at);

                        if($affattendance_info->approved_by > 0){
                            $approved_by = get_employee_name($affattendance_info->approved_by);
                        }
                    }else{
                        
                        if($date < date('Y-m-d')){
                            // check joining date
                            $status_id = 2;
                            $join_date = get_employee_joindate($row->staffid);
                            if($join_date <= $date){
                                $day = date('D', strtotime($date));
                                $status_id = ($day == 'Sun') ? 3 : 1;
                            }
                        }
                        
                        $exist_info = $this->db->query("SELECT * from tblstaffattendance where  staff_id = '".$row->staffid."' and date = '".$date."'")->row();
                        if (empty($exist_info)){
                            $insert_data = array(
                                    'staff_id'=>$row->staffid,
                                    'date'=>$date,
                                    'status'=> 0
                            );
                            $this->home_model->insert('tblstaffattendance',$insert_data);
                        }else{
                            $up_data = array(
                                    'status'=> 0,
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s'),
                            );
                            $this->home_model->update('tblstaffattendance',$up_data,array('id'=>$exist_info->id));
                        }
                        
                        //Checking Paid Leave
                        $paidleave_info = $this->db->query("SELECT * from tblleaves where  `approved_status` = '1' and `is_paid_leave` = '1' and `addedfrom` = '".$row->staffid."' and `from_date` <= '".$date."' and `to_date` >= '".$date."'")->row();
                        if(!empty($paidleave_info)){
                            $status_id = 6;
                            $up_data["status"] = $status_id;
                            $up_data["updated_at"] = date("Y-m-d H:i:s");
                            $update = $this->home_model->update('tblstaffattendance',$up_data, array('staff_id'=>$row->staffid, 'date' => $date));
                        }
                        
                        //Checking UnPaid Leave
                        $leave_info = $this->home_model->get_row('tblleaves', array('approved_status'=>1,'is_paid_leave'=>0,'addedfrom'=>$row->staffid,'from_date <='=>$date,'to_date >='=>$date), '');
                        if(!empty($leave_info)){
                            $status_id = 2;
                            $up_data["status"] = $status_id;
                            $up_data["updated_at"] = date("Y-m-d H:i:s");
                            $update = $this->home_model->update('tblstaffattendance',$up_data, array('staff_id'=>$row->staffid, 'date' => $date));
                        }
                        
                        //Checking Holydays
			$holyday_info = $this->home_model->get_row('tblholidays', array('status'=>1,'date'=>$date), '');
                        if (!empty($holyday_info)){
                            $status_id = 3;
                            $up_data["status"] = $status_id;
                            $up_data["updated_at"] = date("Y-m-d H:i:s");
                            $update = $this->home_model->update('tblstaffattendance',$up_data, array('staff_id'=>$row->staffid, 'date' => $date));
                        }
                        
                        //Checking Sunday Leave (sendwitch case)
                        if($date < date('Y-m-d')){
                            // check joining date
                            $day = date('D', strtotime($date));
                            $d = date('d', strtotime($date));
                            if ($day == 'Sun' && $d != '01'){
                                $past_date = date('Y-m-d',strtotime("-1 days"));
                                $next_date = date('Y-m-d',strtotime("+1 days"));
                                $past_info = $this->home_model->get_row('tblstaffattendance', array('staff_id'=>$row->staffid,'date'=>$past_date,'status'=>2), ''  );
                                $next_info = $this->home_model->get_row('tblstaffattendance', array('staff_id'=>$row->staffid,'date'=>$next_date,'status'=>2), ''  );
                                
                                if(!empty($past_info) OR !empty($next_info)){
                                    $status_id = 2;
                                    $up_data["status"] = $status_id;
                                    $up_data["updated_at"] = date("Y-m-d H:i:s");
                                    $update = $this->home_model->update('tblstaffattendance',$up_data, array('staff_id'=>$row->staffid, 'date' => $date));
                                }
                            }
                        }
                    }
                    
                    if($status_id == 1){
                        $status = 'Present';
                    }elseif($status_id == 2){
                        $status = 'Leave';
                    }elseif($status_id == 3){
                        $status = 'Off';
                    }elseif($status_id == 4){
                        $status = 'Halfday';
                    }elseif($status_id == 5){
                        $status = 'Overtime';
                    }elseif($status_id == 6){
                        $status = 'Paid leave';
                    }
                    $superior_name = get_employee_fullname($row->superior_id);
                    $this->get_junior_staff_list[] = array(
                                                         'staff_name' => $row->firstname,
                      									 'designation' => value_by_id('tbldesignation',$row->designation_id,'designation'),
                                                         'staff_id' => $row->staffid,
                                                         'superior_name' => $superior_name,
                                                         'status_id' => ($status_id == 6) ? '2' : $status_id,
                                                         'date' => _d($date),
                                                         'status' => $status,
                                                         'created_at' => $created_at,
                                                         'updated_at' => $updated_at,
                                                         'marked_at' => $marked_at,
                                                         'approved_by' => $approved_by
                                                     );
                    if($show_all == 1){
                        $this->getJuniorStaff($row->staffid, $date, $show_all); 
                    }
                    
               }
           }
        }
    }



    public function submitAttendance() {
        $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }
        elseif(!empty($_POST)){
            extract($this->input->post());  
        }
        
        if(!empty($user_id) && !empty($attendance_info)){
            
            $attendance_info = json_decode($attendance_info);

            if(!empty($date)){
                $date = str_replace("/","-",$date);
                $date = date('Y-m-d',strtotime($date));
             }else{
                $date = date('Y-m-d');
             }

            if(!empty($attendance_info)){
                foreach ($attendance_info as $row) {
                    $up_data = array(
                            'status'=> $row->status,
                            'approved_by'=> $user_id,
                            'updated_at'=>date('Y-m-d H:i:s'),
                    );
                    $this->home_model->update('tblstaffattendance',$up_data,array('staff_id'=>$row->staff_id,'date'=>$date));
                }
            } 
            
            $return_arr['status'] = true;
            $return_arr['message'] = "Record Updated successfully";
            $return_arr['data'] = [];
        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are missing!";
            $return_arr['data'] = [];
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);
        //http://localhost/crm/Staff_API/submitAttendance?user_id=1&date=31-03-2021&attendance_info=[{"staff_id":"25","status":"1"},{"staff_id":"27","status":"2"}]
    }


    public function getAttendanceReport()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }



        $data_arr = [];

        $where = 'id > 0 ';

        if(!empty($staff_id)){
        	$where .= " and staff_id = '".$staff_id."' ";
        }

        if(!empty($from_date) && !empty($to_date)){
            $from_date = str_replace("/","-",$from_date);
            $from_date = date('Y-m-d',strtotime($from_date));

            $to_date = str_replace("/","-",$to_date);
            $to_date = date('Y-m-d',strtotime($to_date));  

            $where .= " and date between '".$from_date."' and '".$to_date."'  "; 
         }else{
            $where .= "and date = '".date('Y-m-d')."' ";
         }
         /*echo $where;
         die;*/
         //check if attendace is marked 
         $attendance_info = $this->db->query("SELECT * from tblstaffattendance where  ".$where." order by date desc ")->result();
         

         $ttl_present = 0;
         $ttl_leave = 0;
         if(!empty($attendance_info)){
            foreach ($attendance_info as $row) {

               $staff_data = get_employee_info($row->staff_id);
               
               if($staff_data->active == 1){

                $status = 'Not Marked';
                $approved_at = '';
                $marked_at = '';
                $approved_by = '';
                $status_id = '0';

                if($row->status == 1){
                    $status = 'Present';
                    $status_id = '1';
                    $ttl_present++; 
                }elseif($row->status == 2){
                    $status = 'Leave';
                    $status_id = '2';
                    $ttl_leave++; 
                }elseif($row->status == 3){
                    $status = 'Off';
                    $status_id = '3';
                }elseif($row->status == 4){
                    $status = 'Halfday';
                    $status_id = '4';
                }elseif($row->status == 5){
                    $status = 'Overtime';
                    $status_id = '5';
                }elseif($row->status == 6){
                    $status = 'Paid leave';
                    $status_id = '6';
                }

                    $approved_at = _d($row->updated_at);
                    $marked_at = _d($row->marked_at);
                    

                    if($row->approved_by > 0){
                        $approved_by = get_employee_name($row->approved_by);
                    }

                    
                    $staff_info = $this->db->query("SELECT superior_id FROM `tblstaff` where staffid = '".$row->staff_id."' ")->row();
                    $superior_name = '--';
                    if($staff_info->superior_id){
                        $superior_name = get_employee_name($staff_info->superior_id);
                    }
                
                
                    $data_arr[] = array(
                      'name' => get_employee_name($row->staff_id),
                      'designation' => value_by_id('tbldesignation',$staff_data->designation_id,'designation'),
                      'date' => _d($row->date),
                      'status' => $status,
                      'status_id' => $status_id,
                      'superior_name' => $superior_name,
                      'by_biomax' => $row->by_biomax,
                      'approved_at' => $approved_at,
                      'marked_at' => $marked_at,
                      'approved_by' => $approved_by
                   );
                }
                
            }
         }

        if(!empty($data_arr)){
            $return_arr['status'] = true;
            $return_arr['message'] = "Success";
            $return_arr['data'] = $data_arr;
            $return_arr['ttl_present'] = $ttl_present;
            $return_arr['ttl_leave'] = $ttl_leave;
        }else{
            $return_arr['status'] = false;
            $return_arr['message'] = "Record Not Found!";
            $return_arr['data'] = [];
            $return_arr['ttl_present'] = $ttl_present;
            $return_arr['ttl_leave'] = $ttl_leave;
        }
            
    

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/Staff_API/getAttendanceReport?staff_id=1&from_date=01-04-2021&to_date=19-04-2021

    }

    /* this function use for udpate account number and IFSC code ih the system */
    public function updateStaffAccountDetails()
    {
        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        


       $return_arr = array('status' => false, 'message' => "Required Parameters are missing!", 'data' => []); 

        if (!empty($user_id) && !empty($account_no) && !empty($ifsc_code) && !empty($bank_name)){
            $staffinfo = $this->db->query("SELECT * FROM `tblstaff` WHERE staffid = '".$user_id."'")->row();
            if (!empty($staffinfo)){

                /* delete All Old pending data */
                $this->load->model('home_model');
                $exist_info = $this->home_model->get_result('tblstafflog', array('staffid'=>$user_id, 'approval_status' => 0), array('id'));
                if ($exist_info){
                    foreach ($exist_info as $ex_info) {

                        $this->home_model->delete('tblstafflogapprovalsend', array('stafflog_id'=>$ex_info->id, 'approve_status' => 0));
                        $this->home_model->delete('tblmasterapproval', array('table_id'=>$ex_info->id, 'module_id'=> 20));
                        $this->home_model->delete('tblstafflog', array('id'=>$ex_info->id, 'approval_status' => 0));
                    }
                }

                $insert_data['staffid'] = $user_id;
                $insert_data['account_no'] = $account_no;
                $insert_data['ifsc_code'] = $ifsc_code;
                $insert_data['bank_name'] = $bank_name;
                $insert_data['reg_id'] = $staffinfo->reg_id;
                $insert_data['email'] = $staffinfo->email;
                $insert_data['firstname'] = $staffinfo->firstname;
                $insert_data['employee_id'] = $staffinfo->employee_id;
                $insert_data['branch_id'] = $staffinfo->branch_id;
                $insert_data['staff_type_id'] = $staffinfo->staff_type_id;
                $insert_data['contract_to_date'] = $staffinfo->contract_to_date;
                $insert_data['contract_from_date'] = $staffinfo->contract_from_date;
                $insert_data['designation_id'] = $staffinfo->designation_id;
                $insert_data['birth_date'] = $staffinfo->birth_date;
                $insert_data['joining_date'] = $staffinfo->joining_date;
                $insert_data['pan_card_no'] = $staffinfo->pan_card_no;
                $insert_data['adhar_no'] = $staffinfo->adhar_no;
                $insert_data['epf_no'] = $staffinfo->epf_no;
                $insert_data['epic_no'] = $staffinfo->epic_no;
                $insert_data['permenent_address'] = $staffinfo->permenent_address;
                $insert_data['permenent_state'] = $staffinfo->permenent_state;
                $insert_data['permenent_city'] = $staffinfo->permenent_city;
                $insert_data['permenent_pincode'] = $staffinfo->permenent_pincode;
                $insert_data['residential_address'] = $staffinfo->residential_address;
                $insert_data['residential_state'] = $staffinfo->residential_state;
                $insert_data['residential_city'] = $staffinfo->residential_city;
                $insert_data['residential_pincode'] = $staffinfo->residential_pincode;
                $insert_data['lastname'] = $staffinfo->lastname;
                $insert_data['facebook'] = $staffinfo->facebook;
                $insert_data['linkedin'] = $staffinfo->linkedin;
                $insert_data['phonenumber'] = $staffinfo->phonenumber;
                $insert_data['alternatenumber'] = $staffinfo->alternatenumber;
                $insert_data['skype'] = $staffinfo->skype;
                $insert_data['user_id'] = $staffinfo->user_id;
                $insert_data['password'] = $staffinfo->password;
                $insert_data['datecreated'] = $staffinfo->datecreated;
                $insert_data['profile_image'] = $staffinfo->profile_image;
                $insert_data['staff_document'] = $staffinfo->staff_document;
                $insert_data['new_pass_key'] = $staffinfo->new_pass_key;
                $insert_data['new_pass_key_requested'] = $staffinfo->new_pass_key_requested;
                $insert_data['admin'] = $staffinfo->admin;
                $insert_data['role'] = $staffinfo->role;
                $insert_data['active'] = $staffinfo->active;
                $insert_data['default_language'] = $staffinfo->default_language;
                $insert_data['direction'] = $staffinfo->direction;
                $insert_data['hourly_rate'] = $staffinfo->hourly_rate;
                $insert_data['two_factor_auth_enabled'] = $staffinfo->two_factor_auth_enabled;
                $insert_data['two_factor_auth_code'] = $staffinfo->two_factor_auth_code;
                $insert_data['two_factor_auth_code_requested'] = $staffinfo->two_factor_auth_code_requested;
                $insert_data['email_signature'] = $staffinfo->email_signature;
                $insert_data['father_husband_name'] = $staffinfo->father_husband_name;
                $insert_data['token_id'] = $staffinfo->token_id;
                $insert_data['monthly_salary'] = $staffinfo->monthly_salary;
                $insert_data['gross_salary'] = $staffinfo->gross_salary;
                $insert_data['working_from'] = $staffinfo->working_from;
                $insert_data['working_to'] = $staffinfo->working_to;
                $insert_data['paid_leave_time'] = $staffinfo->paid_leave_time;
                $insert_data['gender'] = $staffinfo->gender;
                $insert_data['payment_mode'] = $staffinfo->payment_mode;
                $insert_data['warehouse_id'] = $staffinfo->warehouse_id;
                $insert_data['employee_group'] = $staffinfo->employee_group;
                $insert_data['taxable'] = $staffinfo->taxable;
                $insert_data['relieving_reason'] = $staffinfo->relieving_reason;
                $insert_data['relieving_date'] = $staffinfo->relieving_date;
                $insert_data['last_expense_date_limit'] = $staffinfo->last_expense_date_limit;
                $insert_data['superior_id'] = $staffinfo->superior_id;
                $insert_data['department_id'] = $staffinfo->department_id;
                $insert_data['location_id'] = $staffinfo->location_id;
                $insert_data['reporting_branch_id'] = $staffinfo->reporting_branch_id;
                $insert_data['canBackDateEntry'] = $staffinfo->canBackDateEntry;
                $insert_data['status'] = 1;
                $insert_data['approval_status'] = 0;
                $insert_data['callingnumber'] = $staffinfo->callingnumber;
                $insert_data['attendance_from'] = $staffinfo->attendance_from;
                $insert_data['bm_branch_id'] = $staffinfo->bm_branch_id;
                $insert_data['cashier_branch_id'] = $staffinfo->cashier_branch_id;
                $insert_data['store_manager_branch_id'] = $staffinfo->store_manager_branch_id;
                $insert_data['dispatch_manager_branch_id'] = $staffinfo->dispatch_manager_branch_id;
                $insert_data['religion_id'] = $staffinfo->religion_id;
                $insert_data['division_id'] = $staffinfo->division_id;
                $insert_data['createdirectquote'] = $staffinfo->createdirectquote;
                $insert_data['createdirectinvoice'] = $staffinfo->createdirectinvoice;
                $insert_data['createdirectrequirement'] = $staffinfo->createdirectrequirement;
                $insert_data['createdirectdesignrequisition'] = $staffinfo->createdirectdesignrequisition;
                $insert_data['company_facilities'] = $staffinfo->company_facilities;

                $this->db->insert('tblstafflog', $insert_data);
                $insert_id = $this->db->insert_id();
                if ($insert_id) {

                    $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='22'")->result_array();
                    $i = 0;
                    foreach ($Staffgroup as $singlestaff) {
                        $i++;
                        $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . $user_id . "' order by s.firstname asc")->result_array();
                        foreach ($query as $staffdata) {
                            $sdata['staff_id'] = $staffdata['staffid'];
                            $sdata['stafflog_id'] = $insert_id;
                            $sdata['status'] = '1';
                            $sdata['created_at'] = date("Y-m-d H:i:s");
                            $sdata['updated_at'] = date("Y-m-d H:i:s");
                            $this->db->insert('tblstafflogapprovalsend', $sdata);
            
                            $adata = array(
                                'staff_id' => $staffdata['staffid'],
                                'fromuserid' => $user_id,
                                'module_id' => 20,
                                'table_id' => $insert_id,
                                'approve_status' => 0,
                                'status' => 0,
                                'description'     => 'Staff Info Changes For Approval',
                                'link' => 'staff/staff_info_approval/'.$insert_id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tblmasterapproval', $adata);
            
                            //Sending Mobile Intimation
                                $token = get_staff_token($staffdata['staffid']);
                                $title = 'Schach';
                                $message = 'Staff Member ('.$staffinfo->firstname.') Info Changes For Approval';
                                $send_intimation = sendFCM($message, $title, $token, $page = 2);
                        }
                        
                    }
                    $return_arr["status"] = true;
                    $return_arr["message"] = "Staff Information send for approval";
                }else{
                    $return_arr["message"] = "Somthing Went Wrong!";
                }
            }else{
                $return_arr["message"] = "Invaild User ID";
            }
        }
    

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/Staff_API/updateStaffAccountDetails?user_id=1&account_no=115425858585&ifsc_code=IFG12544&bank_name=kotak mahindra bank

    }


    public function getDepartmentAndBranchMaster()
    {
       
      $return_arr = array();
        if(!empty($_GET))
        {
            extract($this->input->get());   
        }
        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }

        

      $department_info  = $this->db->query("SELECT id,name FROM `tbldepartmentsmaster` where status = 1 order by name asc  ")->result_array();
      $branch_info  = $this->db->query("SELECT id,comp_branch_name FROM `tblcompanybranch` where status = 1 order by id asc  ")->result_array();

      if(!empty($department_info)){
            
            $return_arr['status'] = true;   
            $return_arr['message'] = "Successfully";
            $return_arr['data']['company_department'] = $department_info;
            $return_arr['data']['company_branch'] = $branch_info;
      }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Record Not Found!";
            $return_arr['data'] = [];
      }

      
       header('Content-type: application/json');
       echo json_encode($return_arr);

       //https://mustafa-pc/crm/Staff_API/getDepartmentAndBranchMaster

    }


}