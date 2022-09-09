<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Attendance extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('attendance_model');
        $this->load->model('home_model');
    }

    public function index($id = '')
    {
        $this->mark_attendance();
    }

    public function mark_attendance($id = '')
    {
    	check_permission(103,'view');
	   
	   $data['att_date'] = date("Y-m-d");	
	   
	  /* if(is_admin() != 1){
		    access_denied('dashboard');
	   }*/
		$data['branch_info'] = $this->home_model->get_result('tblcompanybranch', array('status'=>1), '');
        if ($this->input->post()) {
			extract($this->input->post());
			
			if(!empty($date)){
				$data['s_date'] = $date;
				$date = str_replace("/","-",$date);
				$data['att_date'] = date("Y-m-d",strtotime($date));	
			}
			
			if(!empty($branch_id)){
				//$data['staff_list'] = get_staff_list($branch_id);
				$data['staff_list'] =  $this->db->query("SELECT * FROM `tblstaff` where active = 1 and joining_date <= '".$data['att_date']."' and FIND_IN_SET('".$branch_id."', branch_id) ")->result();
				$data['s_branch'] = $branch_id;
			}else{
				//$data['staff_list'] = get_staff_list();
				$data['staff_list'] = $this->db->query("SELECT * FROM `tblstaff` where active = 1 and joining_date <= '".$data['att_date']."' ")->result();
			}
			
			
			
			if(!empty($mark)){
				//Adding the Attendance Record			
				$date = str_replace("/","-",$date);
				$date = date("Y-m-d",strtotime($date));	
				
				if(!empty($staff_id)){
					foreach($staff_id as $id){
						
						
						
						//Start Adding Present fo last month of days
						/*for($i=1; $i<date('d',strtotime($date)); $i++){
							$y = date('Y',strtotime($date));
							$m = date('m',strtotime($date));
							$last_date = date("Y-m-d",strtotime($y.'-'.$m.'-'.$i));
							
							$deletelast_record = $this->home_model->delete('tblstaffattendance', array('staff_id'=>$id,'date'=>$last_date,'status'=>0), '');
							$exist = get_att_exist($last_date,$id);
							if($exist == 0){
								
								$day = date('D', strtotime($last_date));
								if($day == 'Sun'){
									$last_status = 3;
								}else{
									$last_status = 1;
								}
								$last_data = array(
									'staff_id' => $id,
									'date' => $last_date,
									'status' => $last_status,
									'working_to' => '',
									'extra_hours' => 0,
									'created_at' => date('Y-m-d H:i:s')
								);
								
								$last_insert = $this->home_model->insert('tblstaffattendance', $last_data);	
							}
							
						}*/
						//End Adding Present fo last month of days
						
						
						
						
						$delete_record = $this->home_model->delete('tblstaffattendance', array('staff_id'=>$id,'date'=>$date), '');
						
						$status = $_POST['status_'.$id];
						
						if($status == 5){
							$working_to = $_POST['working_to_'.$id];
							
							$staff_info = $this->home_model->get_row('tblstaff', array('staffid'=>$id), '');
							$work_to = $staff_info->working_to;
							
							if(!empty($work_to)){
								$time1 = strtotime($work_to);
								$time2 = strtotime($working_to);
								$extra_hours = round(abs($time2 - $time1) / 3600,2);								
							}else{
								$extra_hours = 0;
							}							
						}else{
							$extra_hours = 0;
							$working_to = '';
						}
						
						$ad_data = array(
								'staff_id' => $id,
								'date' => $date,
								'status' => $status,
								'working_to' => $working_to,
								'extra_hours' => $extra_hours,
								'created_at' => date('Y-m-d H:i:s')
							);
						$insert = $this->home_model->insert('tblstaffattendance', $ad_data);	
					}
				}
				if($insert == true){
					set_alert('success', 'Attendance Marked Successfully');
					redirect(admin_url('attendance/mark_attendance'));
				}else{
					set_alert('warning', 'Fail Mark Attendance');
					redirect(admin_url('attendance/mark_attendance'));
				}
			}
			
		}else{
			//$data['staff_list'] = get_staff_list();
			$data['staff_list'] = $this->db->query("SELECT * FROM `tblstaff` where active = 1 and joining_date <= '".date('Y-m-d')."' ")->result();
		}
		
         $data['title']  = 'Mark Attendance';
		
        $this->load->view('admin/attendance/mark_attendance', $data);
    }
	
	public function live_location()
    {               
		$data['staff_list'] = get_staff_list();
		
		if($this->input->post()) {
			extract($this->input->post());
			//$user_id = $this->session->userdata('staff_user_id');
			 
			$data['s_fromdate'] = $from_date;
			$data['s_todate'] = $to_date;
			$data['s_staff_id'] = $staff_id;

			$data['location_info'] = get_employee_locations($from_date,$to_date,$staff_id);
			
		 }	
		$data['title'] = 'Live Location';
		$this->load->view('admin/attendance/live_location', $data);
    }


	public function download_pdf()
    {
        require_once APPPATH.'third_party/pdfcrowd.php';
        
        $staff_id = $_GET['staff_id'];
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];

       

        $file_name = 'Location - '.$staff_id;

        /*echo $html = location_pdf($from_date,$to_date,$staff_id);
        die;*/

        $html = location_pdf($from_date,$to_date,$staff_id);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Parameters
        $x          = 280;
        $y          = 820;
        $text       = "{PAGE_NUM} of {PAGE_COUNT}";     
        $font       = $dompdf->getFontMetrics()->get_font('Helvetica', 'normal');   
        $size       = 8;    
        $color      = array(0,0,0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle      = 0.0;

        $dompdf->getCanvas()->page_text(
          $x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle
        );
        
        //$dompdf->stream($file_name);
        $dompdf->stream($file_name, array("Attachment" => false));
        
        
    }
	
	
	public function events()
    {       
       	check_permission('139,271','view');
        $data['title'] = 'Events';
        $this->load->view('admin/attendance/manage_events', $data);
    }
	
	public function event_table() {
        $this->app->get_table_data('company_events');
    }
	
	 public function add_event($id = '') {
	 	check_permission('139,271','create');
        if ($this->input->post()) {
			$event_data = $this->input->post();
            if ($id == '') {

                $id = $this->attendance_model->add_event($event_data);
                if ($id) {
					
                    set_alert('success', _l('added_successfully', 'Event'));
                    redirect(admin_url('attendance/events'));
                }
            } else {
            	check_permission('139,271','edit');
                $success = $this->attendance_model->update_event($event_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Event'));
                }

				
                redirect(admin_url('attendance/events'));
            }
        }

        if ($id == '') {
            $title = 'Add Event';
        } else {
            $data['event'] = (array) $this->attendance_model->get_event($id);
            $title = 'Edit Event';
        }

        $data['title'] = $title;
        $this->load->view('admin/attendance/add_event', $data);
    }
	

	public function change_event_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $unit_data = array(
                'status' => $status
            );
            
            $this->attendance_model->edit_event($unit_data, $id);
        }
    }
	
	
	public function delete_event($id)
    {
       check_permission('139,271','delete');
        $response = $this->attendance_model->delete_event($id);
        if ($response == true) {
            set_alert('success', 'Event Deleted Successfully');
        } else {
            set_alert('warning', 'Fail to Delete Event');
        }
        redirect(admin_url('attendance/events'));
    }
	
	public function location_map()
    {               
		$data['staff_list'] = get_staff_list();
		$marker_arr = array();
		if($this->input->post()) {
			extract($this->input->post());
			$data['s_date'] = $date;
			$data['s_staff'] = $staff_id;
			$location_info = get_staff_location($staff_id,$date);
			
			$date = str_replace("/","-",$date);
			$date = date("Y-m-d",strtotime($date));
			$data['att_info'] = $this->home_model->get_result('tblmarkedattendance', array('date'=>$date,'staff_id'=>$staff_id), '');
			
			if(!empty($location_info)){
				foreach($location_info as $row){
				
						$employee_name = get_employee_name($row->staff_id);
						
						
						$location = explode(',',$row->location);
						$lat = $location[0];
						$lng = $location[1];


						$location_name = get_location_name($lat,$lng);
						$title = '<li><h6>'.$employee_name.'</h6><p>Time :- '.date('h:i a',strtotime($row->time)).'</p><p>Location :- '.$location_name.'</p></li>';
						$marker_arr[] = '{
										"lat": '.$lat.',
										"lng": '.$lng.',
										"description": "<ul type=\'none\'>'.$title.'</ul>"
								},';
					
					
				}
			}
			
			
		 }	
		$data['marker'] = $marker_arr; 
		 
		$data['title'] = 'Location On Map';
		$this->load->view('admin/attendance/location_map', $data);
    }

    public function test()
    { 

    	$latitude = '22.7196';
		$longitude = '75.8577';

    	if(!empty($latitude) && !empty($longitude)){
	        //Send request and receive json data by address
	        $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false&key=AIzaSyCog0SwrdpgOuhxZ3ftbUhyJVKwWSTA0iI'); 
	        $output = json_decode($geocodeFromLatLong);
	        $status = $output->status;
	       	        //Get address from json data
	        $address = ($status=="OK")?$output->results[1]->formatted_address:'';
	        //Return address of the given latitude and longitude
	        if(!empty($address)){
	            return  $address;
	        }else{
	            return   'Not found';
	        }
	    }

    }


    public function employee_attendance()
    {               
		check_permission('122,232','view');
		$data['staff_list'] = get_staff_list();
		$data['month_list'] = $this->db->query("SELECT * FROM `tblmonths` order by id asc ")->result();
		$staff_id = (!empty($_GET["staff_id"])) ? $_GET["staff_id"] : 0;
		$month = (!empty($_GET["month"])) ? $_GET["month"] : 0;
		$year = (!empty($_GET["year"])) ? $_GET["year"] : 0;

		if($this->input->post()) {
			extract($this->input->post());
			$data['s_staffid'] = $staff_id;
			$data['s_year'] = $year;
			$data['s_month'] = $month;

			$data['attendance_info'] = $this->db->query("SELECT * FROM `tblstaffattendance` where staff_id = '".$staff_id."' and MONTH(date) = '".$month."' and YEAR(date) = '".$year."' order by date asc ")->result();
			
		}else{
			$data['s_staffid'] = $staff_id;
			$data['s_year'] = $year;
			$data['s_month'] = $month;
			$data['attendance_info'] = $this->db->query("SELECT * FROM `tblstaffattendance` where staff_id = '".$staff_id."' and MONTH(date) = '".$month."' and YEAR(date) = '".$year."' order by date asc ")->result();
		}	

		$data['title'] = 'Monthly Employee Attendance';
		$this->load->view('admin/attendance/employee_attendance', $data);
    }

	public function update_attendance()
    {               
		// check_permission('122,232','view');
		$data['staff_list'] = get_staff_list();
		$data['month_list'] = $this->db->query("SELECT * FROM `tblmonths` order by id asc ")->result();
		$staff_id = (!empty($_GET["staff_id"])) ? $_GET["staff_id"] : 0;
		$month = (!empty($_GET["month"])) ? $_GET["month"] : 0;
		$year = (!empty($_GET["year"])) ? $_GET["year"] : 0;

		if($this->input->post()) {
			extract($this->input->post());

			$data['s_staffid'] = $staff_id;
			$data['s_year'] = $year;
			$data['s_month'] = $month;
			$start_date = date('d/m/Y', strtotime($year."-".$month."-01"));
			$end_date = date('t/m/Y',strtotime($year."-".$month."-01"));

			$data["attendance_dates"] = getDatesFromRange(db_date($start_date), db_date($end_date));
			
			if (isset($attendance) && !empty($attendance)){
				foreach ($attendance as $key => $value) {
					if (isset($value["status"]) && !empty($value["status"])){
						$status = $value["status"];
						$date = $value["date"];
						$staff_id = $value["staff_id"];
						$chkattendance = $this->db->query("SELECT * FROM `tblstaffattendance` WHERE `staff_id` = '".$value["staff_id"]."' AND `date` = '".$value["date"]."' ")->row();
						if (!empty($chkattendance)){
							$this->home_model->update('tblstaffattendance', array("status" => $value["status"], "updated_at" => date("Y-m-d H:i:s")), array("id" => $chkattendance->id));
						}else{
							$ad_data = array(
								'staff_id' => $value["staff_id"],
								'date' => $value["date"],
								'status' => $value["status"],
								'created_at' => date('Y-m-d H:i:s')
							);
							$insert = $this->home_model->insert('tblstaffattendance', $ad_data);
						}
					}
				}
				set_alert('success', 'Attendance Marked Successfully');
				redirect(admin_url('attendance/update_attendance'));
			}
		}

		$data['title'] = 'Update Employee Attendance';
		$this->load->view('admin/attendance/update_employee_attendance', $data);
    }

	/* this is for attendance not marked for last 3 days */
	public function attendance_not_marked(){
		
		$start_date = date('Y-m-d',strtotime(' - 3 day', strtotime(date("Y-m-d"))));
		$end_date = date("Y-m-d");

		$data['leave_report'] = array();
		$staff_list = $this->db->query("SELECT staffid FROM tblstaff WHERE active = 1 and staffid NOT IN (1,7,8,26,35) ")->result();
		if (!empty($staff_list)){
			foreach ($staff_list as $staff) {
				$chk_leave = $this->db->query("SELECT count(t.id) as ttl_row FROM `tblstaffattendance` as t WHERE t.staff_id = '".$staff->staffid."' And t.date BETWEEN '".$start_date."' AND '".$end_date."' and (status = 2 || status = 0) GROUP BY staff_id;")->row();
				if (!empty($chk_leave) && $chk_leave->ttl_row == 4){
					$data['leave_report'][]['staff_id'] = $staff->staffid;
				}
			}
		}
		
		$data['title'] = 'Attendance Not Marked';
		$this->load->view('admin/attendance/attendance_not_marked', $data);
	}
}