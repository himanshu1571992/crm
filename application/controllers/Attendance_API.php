<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Attendance_API extends CRM_Controller

{

    public function __construct()

    {

        parent::__construct();

        

		$this->load->model('home_model');

		

    }



    public function mark_attendance(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($status) && !empty($location) && !empty($user_id)){

			

			

			if($status == 1){

				$add_data = array(

									'staff_id'     		 => $user_id,

									'date'   			 => date('Y-m-d'),

									'checkin_time'	     => date('H:i:s'),

									'checkin_location'   => $location,

									'status'    	     => $status,

						);

				$insert = $this->home_model->insert('tblmarkedattendance', $add_data);			

						

			}elseif($status == 2){

				$att_info = get_mark_out_info($user_id);

			

				if(!empty($att_info)){

					$timeFirst  = strtotime($att_info->checkin_time);

					$timeSecond = strtotime(date('H:i:s'));

					$working_time = $timeSecond - $timeFirst;

				

					

					$up_data = array(

									'checkout_time'	     => date('H:i:s'),

									'checkout_location'  => $location,

									'status'    	     => $status,

									'working_time'    	 => $working_time,

						);

				  $insert = $this->home_model->update('tblmarkedattendance', $up_data, array('id'=>$att_info->id));	

						

				}

			}

			

			if(!empty($insert) && $insert == true){

				if($status == 1){

					$msg = 'Check In Successfully';

				}else{

					$msg = 'Check Out Successfully';

				}

				

				

				$return_arr['status'] = true;	

				$return_arr['message'] = $msg;

				$return_arr['data'] = '';

			}else{

				$return_arr['status'] = false;	

				$return_arr['message'] = "Fail to update record!";

				$return_arr['data'] = '';

			}

			

		

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		//http://it-mustafa/schach/Attendance_API/mark_attendance?user_id=1&status=1&location=22.7196,75.8577

		//http://it-mustafa/schach/Attendance_API/mark_attendance?user_id=1&status=2&location=22.7196,75.8577

		

	}

	

	public function attendance_status(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($user_id)){

			$att_status = get_att_info($user_id);	

			$working_hr = employee_working_hour($user_id);	

			$day_working_hr = get_staff_day_work_hour($user_id);	

			

			

			$arr = array(

				'att_status'	 => $att_status,

				'working_hr'     => $working_hr,

				'day_working_hr' => $day_working_hr

			);

			

			

			$return_arr['status'] = true;	

			$return_arr['message'] = "Success";

			$return_arr['data'] = $arr;

		

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		

		//http://it-mustafa/schach/Attendance_API/attendance_status?user_id=1

	}

	

	

    public function get_location() {



        $return_arr = array();

        if (!empty($_GET)) {

            extract($this->input->get());
        } elseif (!empty($_POST)) {

            extract($this->input->post());
        }



        if (!empty($location) && !empty($user_id)) {

            $date = date('Y-m-d');

            $time = date('H:i:s');



            $exist_info = $this->home_model->get_row('tblstafflocations', array('staff_id' => $user_id, 'time' => $time, 'location' => $location), '');

            if (empty($exist_info)) {

                $add_data = array(
                    'staff_id' => $user_id,
                    'date' => $date,
                    'time' => $time,
                    'location' => $location,
                    'status' => 1
                );

                $insert = $this->home_model->insert('tblstafflocations', $add_data);



                if ($insert == true) {

                    $return_arr['status'] = true;

                    $return_arr['message'] = "Success";

                    $return_arr['data'] = [];
                } else {

                    $return_arr['status'] = false;

                    $return_arr['message'] = "Fail to add record!";

                    $return_arr['data'] = [];
                }
            } else {

                $return_arr['status'] = true;

                $return_arr['message'] = "Success";

                $return_arr['data'] = [];
            }
        } else {

            $return_arr['status'] = false;

            $return_arr['message'] = "Required Parameters are messing";

            $return_arr['data'] = '';
        }





        header('Content-type: application/json');

        echo json_encode($return_arr);



        //http://it-mustafa/schach/Attendance_API/get_location?user_id=1&location=22.7196,75.8577
    }

  
    /*public function biomaxprocess_call(){
        
        $output = array(); 
        
        $get_date =$this->db->query("SELECT * FROM `tblbiomax_log` WHERE `status` = 1 and `date` = '2021-09-22' ORDER BY `id` ASC ")->result();
        if(!empty($get_date)){
            foreach ($get_date as $value) {
                $output[$value->date][$value->user_id][] = $value;
            }
        }
        if (!empty($output)){
            foreach ($output as $date => $value) {
                foreach ($value as $user_id => $val) {
                    
                    if (count($val) > 1){
                        
                        $user_name = current($val)->user_name;
                        $start_time = current($val)->log_date_time;
                        $end_time = end($val)->log_date_time;
                        $add_data = array(
                            "user_id" => $user_id,
                            "user_name" => $user_name,
                            "start_time" => $start_time,
                            "end_time" => $end_time,
                            "created_at" => date("Y-m-d H:i:s")
                        );
                        $insert = $this->home_model->insert('tblbiomax_processdata', $add_data);
                        if($insert){
                            $this->home_model->update('tblbiomax_log', array("status" => 2), array('user_id'=> $user_id, 'date' => $date));
                        }
                    }
                }
            }
        }
        $return_arr = array("status" => true, "message" => "Success");
        header('Content-type: application/json');
        echo json_encode($return_arr);
    }*/

    public function biomaxprocess_call(){
    	$this->home_model->insert('test',array('date'=>date('Y-m-d H:i:s'), 'remark'=>'biomaxprocess_call'));
        //Insert Biomax record to the attendance table

        $output = array(); 
        
        $get_date =$this->db->query("SELECT * FROM `tblbiomax_log` WHERE `status` = 1  ORDER BY `id` ASC ")->result();
        if(!empty($get_date)){
            foreach ($get_date as $value) {
                $output[$value->date][$value->user_id][] = $value;
            }
        }
        if (!empty($output)){
            foreach ($output as $date => $value) {
                foreach ($value as $user_id => $val) {
                    
                    if (count($val) > 1){
                        
                        $date = current($val)->date;
                        $user_name = current($val)->user_name;
                        $start_time = current($val)->log_date_time;
                        $end_time = end($val)->log_date_time;

                        $exist_info =$this->db->query("SELECT * FROM `tblstaffattendance` WHERE `staff_id` = '".$user_id."' and `date` = '".$date."'  ")->row();
                        if(!empty($exist_info)){
                        	$add_data = array(
	                            "by_biomax" => 1,
	                            "status" => 1,
	                            "marked_at" => $start_time,
	                            "created_at" => date("Y-m-d H:i:s")
	                        );
	                        $record_update = $this->home_model->update('tblstaffattendance', $add_data, array('id'=>$exist_info->id));

                        }else{
                        	$add_data = array(
	                            "staff_id" => $user_id,
	                            "date" => $date,
	                            "by_biomax" => 1,
	                            "status" => 1,
	                            "marked_at" => $start_time,
	                            "created_at" => date("Y-m-d H:i:s")
	                        );
	                        $record_update = $this->home_model->insert('tblstaffattendance', $add_data);
                        }
                        
                        if($record_update){
                            $this->home_model->update('tblbiomax_log', array("status" => 2), array('user_id'=> $user_id, 'date' => $date));
                        }
                    }
                }
            }
        }
    }
	
	
	public function mark_attendance_cron_1(){

		$this->home_model->insert('test',array('date'=>date('Y-m-d H:i:s'), 'remark'=>'mark_attendance_cron_1'));	

    	//Mark absent, off, paidleave, sandwitch policy by system
    	$month = date("m");	
		$year = date("Y");
    	$j_date = date('Y-m-').'31';
		$staff_list = $this->db->query("SELECT * FROM `tblstaff` where active = 1 and staffid <= 180 and joining_date <= '".$j_date."' ")->result();


		if(!empty($staff_list)){
			$z=1;
			$c_day = date('d');
			$day = cal_days_in_month(CAL_GREGORIAN,$month,$year);

			foreach($staff_list as $staff){
				for($i=1;$i<=$day;$i++)
					{			
						$c_date = $year.'-'.$month.'-'.$i;
						$f_date = date('Y-m-d', strtotime($c_date));
						
						$att_info = $this->home_model->get_row('tblstaffattendance', array('staff_id'=>$staff->staffid,'date'=>$f_date,'status'=>0), ''  );
						
						if(!empty($att_info)){
							//if($i < $c_day)
							if($f_date < date('Y-m-d'))
							{
								
								
								//joining date must be smaller
								$join_date = get_employee_joindate($staff->staffid);
								if($join_date <= $f_date){
									$dy = date('D', strtotime($f_date));
									if($dy == 'Sun'){
										$at = 3;
									}else{
										$at = 2;
									}
								}else{
									$at = 2;
								}



								
								
								$up_data = array(
									'status'=>$at,
									'created_at'=>date('Y-m-d H:i:s')
								);
								$this->home_model->update('tblstaffattendance',$up_data,array('id'=>$att_info->id));										
							}
						}


						$exist_info = $this->home_model->get_row('tblstaffattendance', array('staff_id'=>$staff->staffid,'date'=>$f_date), ''  );
					
					
					if(empty($exist_info)){
							
						//if($i < $c_day)
						if($f_date < date('Y-m-d'))	
						{
							$dy = date('D', strtotime($f_date));
							if($dy == 'Sun'){
								$at = 3;
							}else{
								$at = 2;
							}

							//joining date logic
							$join_date = get_employee_joindate($staff->staffid);
							if($join_date > $f_date){
								$at = 2;
							}

							
							$in_data = array(
								'staff_id'=>$staff->staffid,
								'date'=>$f_date,
								'status'=>$at
							);
							$this->home_model->insert('tblstaffattendance',$in_data);	
							
						}else{
							$cd_data = array(
								'staff_id'=>$staff->staffid,
								'date'=>$f_date,
								'status'=>0
							);
							$this->home_model->insert('tblstaffattendance',$cd_data);	
																				
						}
					}
					
					
					//Checking Paid Leave
					$paidleave_info = $this->home_model->get_result('tblleaves', array('approved_status'=>1,'is_paid_leave'=>1,'addedfrom'=>$staff->staffid,'from_date <='=>$f_date,'to_date >='=>$f_date), ''  );
					
					if(!empty($paidleave_info)){
						foreach($paidleave_info as $leave){
							$begin = new DateTime($leave->from_date);
							$end = new DateTime($leave->to_date);
							$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);

							foreach($daterange as $dt){
								$dat = $dt->format("Y-m-d");
								if($dat == $f_date){
									
									$up_data = array(
													'staff_id'=>$staff->staffid,
													'date' => $f_date				
													);
									
									$update = $this->home_model->update('tblstaffattendance',array('status'=>6),$up_data);
								}
							}
							if($f_date == $leave->to_date){
								
								$up_data = array(
													'staff_id'=>$staff->staffid,
													'date' => $f_date									
													);
									
								$update = $this->home_model->update('tblstaffattendance',array('status'=>6),$up_data);
							}
						}
					}
					
					
					//Checking UnPaid Leave
					$leave_info = $this->home_model->get_result('tblleaves', array('approved_status'=>1,'is_paid_leave'=>0,'addedfrom'=>$staff->staffid,'from_date <='=>$f_date,'to_date >='=>$f_date), ''  );
					
					if(!empty($leave_info)){
						foreach($leave_info as $leave){
							$begin = new DateTime($leave->from_date);
							$end = new DateTime($leave->to_date);
							$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);

							foreach($daterange as $dt){
								$dat = $dt->format("Y-m-d");
								if($dat == $f_date){
									
									$up_data = array(
													'staff_id'=>$staff->staffid,
													'date' => $f_date				
													);
									
									$update = $this->home_model->update('tblstaffattendance',array('status'=>2),$up_data);
								}
							}
							if($f_date == $leave->to_date){
								
								$up_data = array(
													'staff_id'=>$staff->staffid,
													'date' => $f_date									
													);
									
								$update = $this->home_model->update('tblstaffattendance',array('status'=>2),$up_data);
							}
						}
					}
					
					
					//Checking Sunday Leave
					//if($i < $c_day)
					if($f_date < date('Y-m-d'))	
						{
							$dy = date('D', strtotime($f_date));
							if($dy == 'Sun'){
								if($i != 1){
									
									
									//last_date
									$j = ($i-1);
									$d_date = $year.'-'.$month.'-'.$j;
									$g_date = date('Y-m-d', strtotime($d_date));
									
									//next_date
									$k = ($i+1);
									$e_date = $year.'-'.$month.'-'.$k;
									$h_date = date('Y-m-d', strtotime($e_date));
									
									$last_info = $this->home_model->get_row('tblstaffattendance', array('staff_id'=>$staff->staffid,'date'=>$g_date,'status'=>2), ''  );
									
									$next_info = $this->home_model->get_row('tblstaffattendance', array('staff_id'=>$staff->staffid,'date'=>$h_date,'status'=>2), ''  );
									
									if(!empty($last_info) && !empty($next_info)){
										$up_data = array(
											'status'=>2,
											'created_at'=>date('Y-m-d H:i:s')
										);
										$this->home_model->update('tblstaffattendance',$up_data,array('staff_id'=>$staff->staffid,'date'=>$f_date));
									}
								}
								
									
								
							}
							
							// marking holiday
							$holiday_info = $this->home_model->get_row('tblholidays', array('date'=>$f_date,'status'=>1), ''  );
							if(!empty($holiday_info)){
								$up_data = array(
									'status'=>3,
									'created_at'=>date('Y-m-d H:i:s')
								);
								$this->home_model->update('tblstaffattendance',$up_data,array('staff_id'=>$staff->staffid,'date'=>$f_date));
							}

						}		
					}

			}

		}
		
	}
	
	
	
	public function mark_attendance_cron_2(){

		$this->home_model->insert('test',array('date'=>date('Y-m-d H:i:s'), 'remark'=>'mark_attendance_cron_2'));

    	//Mark absent, off, paidleave, sandwitch policy by system
    	$month = date("m");	
		$year = date("Y");
    	$j_date = date('Y-m-').'31';
		$staff_list = $this->db->query("SELECT * FROM `tblstaff` where active = 1 and staffid > 180 and joining_date <= '".$j_date."' ")->result();


		if(!empty($staff_list)){
			$z=1;
			$c_day = date('d');
			$day = cal_days_in_month(CAL_GREGORIAN,$month,$year);

			foreach($staff_list as $staff){
				for($i=1;$i<=$day;$i++)
					{			
						$c_date = $year.'-'.$month.'-'.$i;
						$f_date = date('Y-m-d', strtotime($c_date));
						
						$att_info = $this->home_model->get_row('tblstaffattendance', array('staff_id'=>$staff->staffid,'date'=>$f_date,'status'=>0), ''  );
						
						if(!empty($att_info)){
							//if($i < $c_day)
							if($f_date < date('Y-m-d'))
							{
								
								
								//joining date must be smaller
								$join_date = get_employee_joindate($staff->staffid);
								if($join_date <= $f_date){
									$dy = date('D', strtotime($f_date));
									if($dy == 'Sun'){
										$at = 3;
									}else{
										$at = 2;
									}
								}else{
									$at = 2;
								}



								
								
								$up_data = array(
									'status'=>$at,
									'created_at'=>date('Y-m-d H:i:s')
								);
								$this->home_model->update('tblstaffattendance',$up_data,array('id'=>$att_info->id));										
							}
						}


						$exist_info = $this->home_model->get_row('tblstaffattendance', array('staff_id'=>$staff->staffid,'date'=>$f_date), ''  );
					
					
					if(empty($exist_info)){
							
						//if($i < $c_day)
						if($f_date < date('Y-m-d'))	
						{
							$dy = date('D', strtotime($f_date));
							if($dy == 'Sun'){
								$at = 3;
							}else{
								$at = 2;
							}

							//joining date logic
							$join_date = get_employee_joindate($staff->staffid);
							if($join_date > $f_date){
								$at = 2;
							}

							
							$in_data = array(
								'staff_id'=>$staff->staffid,
								'date'=>$f_date,
								'status'=>$at
							);
							$this->home_model->insert('tblstaffattendance',$in_data);	
							
						}else{
							$cd_data = array(
								'staff_id'=>$staff->staffid,
								'date'=>$f_date,
								'status'=>0
							);
							$this->home_model->insert('tblstaffattendance',$cd_data);	
																				
						}
					}
					
					
					//Checking Paid Leave
					$paidleave_info = $this->home_model->get_result('tblleaves', array('approved_status'=>1,'is_paid_leave'=>1,'addedfrom'=>$staff->staffid,'from_date <='=>$f_date,'to_date >='=>$f_date), ''  );
					
					if(!empty($paidleave_info)){
						foreach($paidleave_info as $leave){
							$begin = new DateTime($leave->from_date);
							$end = new DateTime($leave->to_date);
							$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);

							foreach($daterange as $dt){
								$dat = $dt->format("Y-m-d");
								if($dat == $f_date){
									
									$up_data = array(
													'staff_id'=>$staff->staffid,
													'date' => $f_date				
													);
									
									$update = $this->home_model->update('tblstaffattendance',array('status'=>6),$up_data);
								}
							}
							if($f_date == $leave->to_date){
								
								$up_data = array(
													'staff_id'=>$staff->staffid,
													'date' => $f_date									
													);
									
								$update = $this->home_model->update('tblstaffattendance',array('status'=>6),$up_data);
							}
						}
					}
					
					
					//Checking UnPaid Leave
					$leave_info = $this->home_model->get_result('tblleaves', array('approved_status'=>1,'is_paid_leave'=>0,'addedfrom'=>$staff->staffid,'from_date <='=>$f_date,'to_date >='=>$f_date), ''  );
					
					if(!empty($leave_info)){
						foreach($leave_info as $leave){
							$begin = new DateTime($leave->from_date);
							$end = new DateTime($leave->to_date);
							$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);

							foreach($daterange as $dt){
								$dat = $dt->format("Y-m-d");
								if($dat == $f_date){
									
									$up_data = array(
													'staff_id'=>$staff->staffid,
													'date' => $f_date				
													);
									
									$update = $this->home_model->update('tblstaffattendance',array('status'=>2),$up_data);
								}
							}
							if($f_date == $leave->to_date){
								
								$up_data = array(
													'staff_id'=>$staff->staffid,
													'date' => $f_date									
													);
									
								$update = $this->home_model->update('tblstaffattendance',array('status'=>2),$up_data);
							}
						}
					}
					
					
					//Checking Sunday Leave
					//if($i < $c_day)
					if($f_date < date('Y-m-d'))	
						{
							$dy = date('D', strtotime($f_date));
							if($dy == 'Sun'){
								if($i != 1){
									
									
									//last_date
									$j = ($i-1);
									$d_date = $year.'-'.$month.'-'.$j;
									$g_date = date('Y-m-d', strtotime($d_date));
									
									//next_date
									$k = ($i+1);
									$e_date = $year.'-'.$month.'-'.$k;
									$h_date = date('Y-m-d', strtotime($e_date));
									
									$last_info = $this->home_model->get_row('tblstaffattendance', array('staff_id'=>$staff->staffid,'date'=>$g_date,'status'=>2), ''  );
									
									$next_info = $this->home_model->get_row('tblstaffattendance', array('staff_id'=>$staff->staffid,'date'=>$h_date,'status'=>2), ''  );
									
									if(!empty($last_info) && !empty($next_info)){
										$up_data = array(
											'status'=>2,
											'created_at'=>date('Y-m-d H:i:s')
										);
										$this->home_model->update('tblstaffattendance',$up_data,array('staff_id'=>$staff->staffid,'date'=>$f_date));
									}
								}
								
									
								
							}
							
							// marking holiday
							$holiday_info = $this->home_model->get_row('tblholidays', array('date'=>$f_date,'status'=>1), ''  );
							if(!empty($holiday_info)){
								$up_data = array(
									'status'=>3,
									'created_at'=>date('Y-m-d H:i:s')
								);
								$this->home_model->update('tblstaffattendance',$up_data,array('staff_id'=>$staff->staffid,'date'=>$f_date));
							}										
						}		
					}

			}

		}
		
	}

	public function mark_sundays_complimentary(){

		$this->home_model->insert('test',array('date'=>date('Y-m-d H:i:s'), 'remark'=>'mark_sundays_complimentary'));

		$month  = date('m');
		$year  = date('Y');
		$dates = [];
		$days = cal_days_in_month(CAL_GREGORIAN, $month,$year);
		for($i = 1; $i<= $days; $i++){
			$day  = date('Y-m-'.$i);
			$result = date("l", strtotime($day));
			if($result == "Sunday"){
				$dates[] = date("Y-m-d", strtotime($day))."<br>";
			}
		}

		if(!empty($dates)){
			foreach ($dates as $date) {
				if($date <= date('Y-m-d')){
					$attendance_info =$this->db->query("SELECT * FROM `tblstaffattendance` WHERE date = '".$date."' and status = 1 and approved_by > 0 and complimentary_status = 0 and staff_id > 0  ")->result();
					if(!empty($attendance_info)){
						foreach ($attendance_info as $value) {
							$complimentry_leaves = get_employee_info($value->staff_id)->complimentry_leaves;
							$updated_complimentry_leaves = ($complimentry_leaves+1);
							$this->home_model->update('tblstaff', array('complimentry_leaves'=>$updated_complimentry_leaves), array('staffid'=>$value->staff_id));
							$this->home_model->update('tblstaffattendance', array('complimentary_status'=>1), array('id'=>$value->id));

						}
					}
				}
				
			}
		}

		$this->marked_inactive_employee();
	}

	/* this is for marked inactive employee */
	public function marked_inactive_employee(){
		 
		$staff_list = $this->db->query("SELECT staffid,active FROM `tblstaff` WHERE active = 1 and staffid NOT IN (1,7,8,26,35)")->result();
		if ($staff_list){
			foreach ($staff_list as $staff) {
				
				$getAttendance_count = $this->db->query("SELECT COUNT(*) as ttl_row FROM tblstaffattendance WHERE `date` BETWEEN date_sub(curdate(),interval 29 day) AND curdate() AND `staff_id`= '".$staff->staffid."' AND (status = 2 || status = 0 || status = 3) ")->row()->ttl_row;

				if ($getAttendance_count == 30){

					$this->home_model->update("tblstaff", array('active'=> 0, 'inactive_by_system'=> 1), array('staffid' => $staff->staffid));
				}
			}
		}
	}

}

