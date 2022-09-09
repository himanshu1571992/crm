<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Leads_API extends CRM_Controller

{

    public function __construct()

    {

        parent::__construct();

        

		$this->load->model('home_model');

		$this->load->model('Leads_model');

		

    }



    public function get_masters(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($user_id)){

			

			//Client 

			$client_info= $this->db->query("SELECT `userid` as id,`company`,`client_branch_name` FROM `tblclientbranch` WHERE `active`='1'")->result_array();

			

			//Client Categories

			$this->load->model('Client_category_model');

			$client_category_data = $this->Client_category_model->get();

			

			//State & City

			$this->load->model('Site_manager_model');

			$state_data = $this->Site_manager_model->get_state();

			$allcity = $this->Site_manager_model->get_city();

			

			//Sites

			$all_site = $this->Site_manager_model->get();

			

			//Designation

			$this->load->model('Designation_model');

			$designation_data = $this->Designation_model->get();

			

			//Contact Type

			$this->load->model('Contact_type_model');

			$contact_type_data = $this->Contact_type_model->get();

			

			//Lead Souce			

			$lead_source = $this->Leads_model->get_source();

			

			//$Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Lead'")->result_array();

			$Staffgroup =  get_staff_group(7,$user_id);

			foreach($Staffgroup as $singlestaff)

			{

				$query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='".$user_id."'")->result_array();

				$stafff['staffs'][]=$query;

				

				$staff_arr[] = array(

					'id' =>  $singlestaff['id'],

					'name' =>  $singlestaff['name'],

					'staffs' =>  $query,

				);

				

				

			}

			$allStaffdata = $staff_arr;

			

			//Lead Status

			$lead_status = $this->Leads_model->get_status();

			

			//Product

			 $product_data = $this->db->query("SELECT p.id,name FROM `tblproducts` p LEFT JOIN `tblcategorymultiselect` cm ON p.`product_cat_id`=cm.category_id LEFT JOIN `tblmultiselectmaster` ms ON cm.multiselect_id=ms.id WHERE ms.multiselect='Lead' group by p.id")->result_array();

			 

			 //Enquiryfor

			 $this->load->model('Enquiryfor_model');

			 $enquiry_for = $this->Enquiryfor_model->get();

			

			

			$new_arr = array();

			if(!empty($client_info)){

				$new_arr['client_info'] = $client_info;

			}else{

				$new_arr['client_info'] = [];

			}

			

			if(!empty($client_category_data)){

				$new_arr['company_category'] = $client_category_data;

			}else{

				$new_arr['company_category'] = [];

			}

			

			if(!empty($state_data)){

				$new_arr['state_list'] = $state_data;

			}else{

				$new_arr['state_list'] = [];

			}

			

			if(!empty($allcity)){

				$new_arr['city_list'] = $allcity;

			}else{

				$new_arr['city_list'] = [];

			}

			

			if(!empty($all_site)){

				$new_arr['site_info'] = $all_site;

			}else{

				$new_arr['site_info'] = [];

			}

			

			if(!empty($designation_data)){

				$new_arr['designations'] = $designation_data;

			}else{

				$new_arr['designations'] = [];

			}

			

			if(!empty($contact_type_data)){

				$new_arr['contact_type'] = $contact_type_data;

			}else{

				$new_arr['contact_type'] = [];

			}

			

			if(!empty($lead_source)){

				$new_arr['lead_source'] = $lead_source;

			}else{

				$new_arr['lead_source'] = [];

			}

			

			if(!empty($allStaffdata)){

				$new_arr['group_info'] = $allStaffdata;

			}else{

				$new_arr['group_info'] = [];

			}

			

			if(!empty($lead_status)){

				$new_arr['lead_status'] = $lead_status;

			}else{

				$new_arr['lead_status'] = [];

			}

			

			if(!empty($product_data)){

				$new_arr['product_info'] = $product_data;

			}else{

				$new_arr['product_info'] = [];

			}

			

			if(!empty($enquiry_for)){

				$new_arr['enquiry_for'] = $enquiry_for;

			}else{

				$new_arr['enquiry_for'] = [];

			}

			

			

			

			

			$return_arr['status'] = true;	

			$return_arr['message'] = "Success";

			$return_arr['data'] = $new_arr;

		

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		

		//http://it-mustafa/schach/Leads_API/get_masters?user_id=2

	}

	

	

	public function get_client_branch_details(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($client_branch_id)){

			$this->db->where('userid', $client_branch_id);

			

			$clientbranchdata= $this->db->get('tblclientbranch')->row();			

			$clientbranchdata= (array) $clientbranchdata;

			$arr = array('website'=>$clientbranchdata['website'],'client_cat_id'=>$clientbranchdata['client_cat_id'],'vat'=>$clientbranchdata['vat'],'city'=>$clientbranchdata['city'],'state'=>$clientbranchdata['state'],'cin_no'=>$clientbranchdata['cin_no'],'email_id'=>$clientbranchdata['email_id'],'phone_no_1'=>$clientbranchdata['phone_no_1'],'phone_no_2'=>$clientbranchdata['phone_no_2'],'address'=>$clientbranchdata['address'],'location'=>$clientbranchdata['location'],'landmark'=>$clientbranchdata['landmark'],'zip'=>$clientbranchdata['zip'],'pan_no'=>$clientbranchdata['pan_no']);

		

			$return_arr['status'] = True;	

			$return_arr['message'] = "success";

			$return_arr['data'] = $arr;

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		

		//http://it-mustafa/schach/Leads_API/get_client_branch_details?client_branch_id=5

		

	}

	

	public function get_site_details(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($site_id)){

			$this->db->where('id', $site_id);

			$sitedata= $this->db->get('tblsitemanager')->row();

			$sitedata= (array) $sitedata;

			$arr = array('name'=>$sitedata['name'],'location'=>$sitedata['location'],'address'=>$sitedata['address'],'description'=>$sitedata['description'],'state_id'=>$sitedata['state_id'],'city_id'=>$sitedata['city_id'],'landmark'=>$sitedata['landmark'],'pincode'=>$sitedata['pincode']);

		

			$return_arr['status'] = True;	

			$return_arr['message'] = "success";

			$return_arr['data'] = $arr;

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		

		//http://it-mustafa/schach/Leads_API/get_site_details?site_id=1

		

	}

	

	public function get_leads(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($user_id)){

			

			/*$test = $this->Leads_model->get(1);

			echo '<pre/>';

			print_r($test);

			die;*/

			

			$lead_info = $this->home_model->get_result('tblleads', array('addedfrom'=>$user_id), '',array('id','desc'));

			if(!empty($lead_info)){

				foreach($lead_info as $row){

					if($row->client_id > 0){

						$client_info = $this->home_model->get_row('tblclientbranch', array('userid'=>$row->client_id), '');

						if(!empty($client_info)){

							$client = $client_info->company;

						}else{

							$client = '--';

						}

					}else{

						$client = $row->company;

					}

					

					

					if($row->source > 0){

						$source_info = $this->home_model->get_row('tblleadssources', array('id'=>$row->source), '');

						if(!empty($source_info)){

							$source = $source_info->name;

						}else{

							$source = '--';

						}

					}else{

						$source = '--';

					}

					

					if($row->status > 0){

						$status_info = $this->home_model->get_row('tblleadsstatus', array('id'=>$row->status), '');

						if(!empty($status_info)){

							$status = $status_info->name;

						}else{

							$status = '--';

						}

					}else{

						$status = '--';

					}

					

					$arr[] = array(

						'id' => $row->id,

						'lead_id' => 'LEAD-'.number_series($row->id),

						'date' => date('d/m/Y',strtotime($row->enquiry_date)),

						'staff_name' => get_staff_full_name($row->staff),

						'source' => $source,

						'status' => $status,

					);

					

				}

				

				$return_arr['status'] = True;	

				$return_arr['message'] = "Success";

				$return_arr['data'] = $arr;

			}else{

				$return_arr['status'] = false;	

				$return_arr['message'] = "Record Not Found!";

				$return_arr['data'] = '';

			}

			

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		//http://it-mustafa/schach/Leads_API/get_leads?user_id=1

	}		

	

	

	public function add_lead(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($user_id) && !empty($lead_data)){

			

			$data = json_decode($lead_data, true);

			/*echo '<pre/>';

			print_r($data);

			die;*/

			$id = $this->Leads_model->add($data,$user_id);

			if($id){				

				$new_arr['lead_id'] = $id;

				

				$return_arr['status'] = true;	

				$return_arr['message'] = "Success";

				$return_arr['data'] = $new_arr;

			}else{

				$return_arr['status'] = false;	

				$return_arr['message'] = "Something went wrong";

				$return_arr['data'] = '';

			}

			

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		//http://it-mustafa/schach/Leads_API/add_lead?user_id=2&lead_data={"enquiry":{"enquiry_type_id":"2","site_id":"3","enquiry_date":"20/10/2018","source":"1","reminder_date":"22/10/2018","reference":"333","remark":"R1","product_remark":"R2","status":"3"},"clients":{"phone_no_1":"022 42505555","phone_no_2":"022 42505577","website":"www.narsi.in","address":"522,Laxmi Mall, Bldg No. 5 , Laxmi Industrial Estate , New Link Road, Andheri (w),Maharashtra , Mumb","state":"21","landmark":"Laxmi Industrial Estate","email_id":"procurement@narsi.in ; ma","client_cat_id":"1","pan_no":"","vat":"27AARPS9656F1ZU","cin_no":"123","city":"364","zip":"400053"},"clientbranch":{"client_branch_id":"5"},"newclient":{"client_branch_name":""},"name":"","location":"","description":"","address":"","state_id":"","city_id":"","landmark":"","pincode":"","site":{"location":"Site location","description":"desc","address":"address","state_id":"4","city_id":"35","landmark":"dafrd","pincode":"234"},"clientdata":[{"firstname":"Mustafa","email":"test@gmail.com","phonenumber":"975206709","designation_id":"1","contact_type":"1"}],"assign":{"assignid":["group8","staff7","staff25","staff8"]},"proenqdata":[{"product_id":"10","product_remarks":"ad","qty":"1","enquiry_for_id":"2","remarks":"re"}]}

	}

	

	

	public function edit_lead(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($id) && !empty($lead_data)){

			

			$data = json_decode($lead_data, true);

			/*echo '<pre/>';

			print_r($data);

			die;*/

			$id = $this->Leads_model->update($data,$id);

			if($id){				

				$new_arr['lead_id'] = $id;

				

				$return_arr['status'] = true;	

				$return_arr['message'] = "Lead Updated Successfully";

				$return_arr['data'] = '';

			}else{

				$return_arr['status'] = false;	

				$return_arr['message'] = "Something went wrong";

				$return_arr['data'] = '';

			}

			

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		//http://it-mustafa/schach/Leads_API/edit_lead?id=3&lead_data={"enquiry":{"enquiry_type_id":"2","site_id":"2","enquiry_date":"22\/10\/2018","source":"2","reminder_date":"24\/10\/2018","reference":"333","remark":"R","product_remark":"A","status":"3"},"clients":{"phone_no_1":"022 40166421","phone_no_2":"022 67413789","website":"www.bnpinteriors.com","address":"519-520,Laxmi Mall,Laxmi Industrial Estate, New Link Road, Andheri (W), Mumbai-400053","state":"21","landmark":"Laxmi Industrial Estate","email_id":"purchase@bnpinteriors.com","client_cat_id":"1","pan_no":"","vat":"27AHHPK2614G1ZK","cin_no":"123","city":"364","zip":"400053"},"clientbranch":{"client_branch_id":"6"},"newclient":{"client_branch_name":""},"name":"","location":"","description":"","address":"","state_id":"","city_id":"","landmark":"","pincode":"","site":{"location":"surat","description":"","address":"surat","state_id":"12","city_id":"169","landmark":"surat","pincode":"395002"},"clientexitingdata":{"1":{"contactid":"3","email":"test@gmail.com","phonenumber":"975206709","designation_id":"30"},"2":{"contactid":"4","email":"tdd@gmail.com","phonenumber":"85652553","designation_id":""}},"assign":{"assignid":["staff7","staff25","staff8"]},"proenqdata":[{"product_id":"10","product_remarks":"As","qty":"1","enquiry_for_id":"2","remarks":"RRE"}]}

	}

	

	public function add_reminder(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($user_id) && !empty($date) && !empty($description) && !empty($lead_id) && !empty($staff_id)){

			$data = array(

				'creator' => $user_id,

				'date' => $date,

				'description' => $description,

				'rel_type' => 'lead',

				'rel_id' => $lead_id,

				'notify_by_email' => $notify_by_email,

				'staff' => $staff_id,

			);

			$success = $this->Leads_model->add_reminder($data);	

			

			if($success){				

				

				$return_arr['status'] = true;	

				$return_arr['message'] = "Reminder Added Successfully";

				$return_arr['data'] = [];

			}else{

				$return_arr['status'] = false;	

				$return_arr['message'] = "Something went wrong";

				$return_arr['data'] = [];

			}

			

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		//http://it-mustafa/schach/Leads_API/add_reminder?user_id=2&date=21/10/2018 4:00 PM&description=Remainder&lead_id=2&staff_id=25&notify_by_email=1

	}

		

	public function get_reminder(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($lead_id)){

			$reminder_info = $this->home_model->get_result('tblreminders', array('rel_id'=>$lead_id,'rel_type'=>'lead'), '','');

			

			if(!empty($reminder_info)){

				foreach($reminder_info as $row){

					$arr[] = array(

						'id' => $row->id,

						'description' => $row->description,

						'date' => date('d/m/Y h:i A',strtotime($row->date)),

						'staff_name' => get_staff_full_name($row->staff),

						'notify_by_email' => $row->notify_by_email,

						'creator' => $row->creator,

					);

				}

				

				$return_arr['status'] = True;	

				$return_arr['message'] = "Success";

				$return_arr['data'] = $arr;

			}else{

				$return_arr['status'] = false;	

				$return_arr['message'] = "No Recored Found!";

				$return_arr['data'] = [];

			}

			

			

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		//http://it-mustafa/schach/Leads_API/get_reminder?lead_id=2

	}

	

	public function edit_reminder(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($date) && !empty($description) && !empty($id) && !empty($staff_id)){

			$data = array(

				'date' => $date,

				'description' => $description,

				'notify_by_email' => $notify_by_email,

				'staff' => $staff_id,

			);

			$success = $this->Leads_model->edit_reminder($data,$id);	

			

			if($success){				

				

				$return_arr['status'] = true;	

				$return_arr['message'] = "Recored Updated Successfully";

				$return_arr['data'] = [];

			}else{

				$return_arr['status'] = false;	

				$return_arr['message'] = "Something went wrong";

				$return_arr['data'] = [];

			}

			

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		//http://it-mustafa/schach/Leads_API/edit_reminder?id=6&date=21/10/2018 5:00 PM&description=Reminder&lead_id=2&staff_id=25&notify_by_email=0

	}

	

	public function delete_reminder(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($id)){

			$delete = $this->Leads_model->delete_reminder($id);

			if($delete){				

				

				$return_arr['status'] = true;	

				$return_arr['message'] = "Recored Deleted Successfully";

				$return_arr['data'] = [];

			}else{

				$return_arr['status'] = false;	

				$return_arr['message'] = "Something went wrong";

				$return_arr['data'] = [];

			}

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		//http://it-mustafa/schach/Leads_API/delete_reminder?id=6

	}

	

	public function add_note(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($user_id) && !empty($description) && !empty($lead_id) ){

			

			$data = array(

				'rel_id' => $lead_id,

				'rel_type' => 'lead',

				'description' => $description,

				'addedfrom' => $user_id,

				'dateadded' => date('Y-m-d H:i:s')

			);

			

			if(!empty($date_contacted)){

				$date_contacted = str_replace("/","-",$date_contacted);

				$data['date_contacted'] = date("Y-m-d H:i:s",strtotime($date_contacted));

			}

			

			$success = $this->home_model->insert('tblnotes',$data);	

			

			if($success){				

				

				$return_arr['status'] = true;	

				$return_arr['message'] = "Note Added Successfully";

				$return_arr['data'] = [];

			}else{

				$return_arr['status'] = false;	

				$return_arr['message'] = "Something went wrong";

				$return_arr['data'] = [];

			}

			

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		//http://it-mustafa/schach/Leads_API/add_note?user_id=2&date_contacted=21/10/2018 5:30 PM&description=Lead Note&lead_id=2

	}

	

	

	public function get_note(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($lead_id)){

			$note_info = $this->home_model->get_result('tblnotes', array('rel_id'=>$lead_id,'rel_type'=>'lead'), '',array('id','desc'));

			

			if(!empty($note_info)){

				foreach($note_info as $row){

					

					if(!empty($row->date_contacted)){

						$date_contacted = date('d/m/Y h:i A',strtotime($row->date_contacted));

					}else{

						$date_contacted = '--';

					}

					

					$arr[] = array(

						'id' => $row->id,

						'description' => $row->description,

						'date_contacted' => $date_contacted,

						'addedfrom_name' => get_staff_full_name($row->addedfrom),

						'addedfrom_id' => $row->addedfrom,

						'dateadded' => date('d/m/Y H:i a', strtotime($row->dateadded)),

					);

				}

				

				$return_arr['status'] = True;	

				$return_arr['message'] = "Success";

				$return_arr['data'] = $arr;

			}else{

				$return_arr['status'] = false;	

				$return_arr['message'] = "No Recored Found!";

				$return_arr['data'] = [];

			}

			

			

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		//http://it-mustafa/schach/Leads_API/get_note?lead_id=2

	}

	

	

	public function edit_note(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($description) && !empty($id) ){

			

			$data = array(

				'description' => $description,

			);

			

			if(!empty($date_contacted)){

				$date_contacted = str_replace("/","-",$date_contacted);

				$data['date_contacted'] = date("Y-m-d H:i:s",strtotime($date_contacted));

			}

			

			$update = $this->home_model->update('tblnotes',$data,array('id'=>$id));	

			

			if($update){				

				

				$return_arr['status'] = true;	

				$return_arr['message'] = "Note Updated Successfully";

				$return_arr['data'] = [];

			}else{

				$return_arr['status'] = false;	

				$return_arr['message'] = "Something went wrong";

				$return_arr['data'] = [];

			}

			

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		//http://it-mustafa/schach/Leads_API/edit_note?date_contacted=21/10/2018 6:30 PM&description=Edit Lead Note&id=8

	}

	

	public function delete_note(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($id) ){

			

			

			$delete = $this->home_model->delete('tblnotes',array('id'=>$id));	

			

			if($delete){				

				

				$return_arr['status'] = true;	

				$return_arr['message'] = "Note Deleted Successfully";

				$return_arr['data'] = [];

			}else{

				$return_arr['status'] = false;	

				$return_arr['message'] = "Something went wrong";

				$return_arr['data'] = [];

			}

			

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		//http://it-mustafa/schach/Leads_API/delete_note?id=8

	}

	

	

	public function get_lead_details(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($id)){

			$data['lead'] = $this->db->query('SELECT * FROM `tblleads` WHERE `id`="'.$id.'"')->row_array();

            $lead = $this->db->query('SELECT * FROM `tblleads` WHERE `id`="'.$id.'"')->row_array();

			$this->db->where('userid', $lead['client_id']);

			$clientbranchdata= $this->db->get('tblclientbranch')->row();

			$this->db->where('userid', $lead['client_id']);

			$data['contactall']= $this->db->get('tblcontacts')->result_array();

			

			$this->db->where('enquiry_id', $id);

			$data['productqnq']= $this->db->get('tblproductinquiry')->result_array();

			

			$this->db->where('lead_id', $id);

			$assignlist= $this->db->get('tblleadassignstaff')->result_array();

			

			$assignlist = array_column($assignlist, 'staff_id');

			$data['assignlist']= $assignlist;

			$this->db->where('id', $lead['site_id']);

			$sitedata= $this->db->get('tblsitemanager')->row();

			

			

			$this->db->where('enquiry_id', $id);

			$contactpersondata= $this->db->get('tblenquiryclientperson')->result_array();

			$contactpersondata=(array) $contactpersondata;

			$contactpersondata = array_column((array)$contactpersondata, 'contact_id');

		

			foreach($contactpersondata as $singleperson)

			{

				$this->db->where('id', $singleperson);

				$contactdata[]= $this->db->get('tblcontacts')->row_array();

				$contactdata= (array) $contactdata;

			}

			$data['contactdata']=$contactdata;

			$this->db->where('lead_id', $id);

			$staffassigndata= $this->db->get('tblleadassignstaff')->result_array();

			$staffassigndata=array_column($staffassigndata,'staff_id');

			$data['staffassigndata']=$staffassigndata;

			$data['lead_id']=$lead['id'];

			$data['lead']['clientbranch']=(array) $clientbranchdata;

			

			

			$data['lead']['sitedata']= $sitedata;

			

			$return_arr['status'] = true;	

			$return_arr['message'] = "success";

			$return_arr['data'] = $data;

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		//http://it-mustafa/schach/Leads_API/get_lead_details?id=1

	}

	

	

	public function get_staff_list(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		if(!empty($user_id)){

			$staff_list = array();

			$branch_str = get_staff_info($user_id)->branch_id;

			$branch_arr = explode(',',$branch_str);

			

			if(!empty($branch_arr)){

				

				$query = $this->db->query("SELECT staffid as id,firstname FROM `tblstaff` where staffid !=  '".$user_id."' and FIND_IN_SET('".$branch_arr[0]."', branch_id)");

				if($query->num_rows()>0){

					$staff_list = $query->result();

				}

				

			}else{

				$query = $this->db->query("SELECT staffid as id,firstname FROM `tblstaff` where staffid !=  '".$user_id."' ");

				if($query->num_rows()>0){

					$staff_list = $query->result();

				}

			}

			

			$return_arr['status'] = true;	

			$return_arr['message'] = "Success";

			$return_arr['data'] = $staff_list;			

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		//http://it-mustafa/schach/Leads_API/get_staff_list?user_id=1

		

	}

	

	public function get_lead_profile(){

		

		$return_arr = array();

		if(!empty($_GET)){

			extract($this->input->get());

		}

		elseif(!empty($_POST)){

			extract($this->input->post());		

		}

		

		

		if(!empty($id)){

			$lead_data = $this->db->query("SELECT cb.client_branch_name,cb.company,cb.website,cb.email_id,cb.phone_no_1,cb.address,cb.state,cb.city,cb.zip,l.`source`,l.`status`,l.`created_at`,l.`site_id`,s.name as site_name,l.`reference`,l.`remark`,l.`product_remark`,l.enquiry_type_id,lt.name as lead_type,st.name as state_name,ct.name as city_name,ls.name as source,lst.name as statusname FROM `tblleads` l LEFT JOIN `tblclientbranch` cb ON l.`client_id`=cb.userid  LEFT JOIN `tblsitemanager` s ON s.`id`=l.`site_id` LEFT JOIN `tblenquirytypemaster` lt ON lt.`id`=l.`enquiry_type_id` LEFT JOIN `tblstates` st ON st.id=cb.`state` LEFT JOIN `tblcities` ct ON ct.id=cb.`city`  LEFT JOIN `tblleadssources` ls ON ls.id=l.`source` LEFT JOIN `tblleadsstatus` lst ON lst.id=l.`status` WHERE l.`id`='".$id."'")->row();

			

			$assign_data = $this->db->query("SELECT s.firstname,s.email FROM `tblleadassignstaff` ast LEFT JOIN `tblstaff` s ON s.staffid=ast.`staff_id` WHERE `lead_id`='".$id."'")->result();

			

			$info_arr = array(

				'client_branch_name' => $lead_data->client_branch_name,

				'website' => $lead_data->website,

				'email_id' => $lead_data->email_id,

				'phone_no' => $lead_data->phone_no_1,

				'company' => $lead_data->company,

				'address' => $lead_data->address,

				'state' => get_state($lead_data->state),

				'city' => get_city($lead_data->city),

				'zip_code' =>$lead_data->zip,

				'status' =>$lead_data->statusname,

				'source' =>$lead_data->source,

				'remark' =>$lead_data->remark,

				'product_remark' =>$lead_data->product_remark,

				'created_at' =>$lead_data->created_at,

				'lead_assign_data' =>$assign_data

				

			);

			

			$return_arr['status'] = true;	

			$return_arr['message'] = "success";

			$return_arr['data'] = $info_arr;

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

		header('Content-type: application/json');

	    echo json_encode($return_arr);

		

		//http://it-mustafa/schach/Leads_API/get_lead_profile?id=1

		

	}


	public function get_lead_contacts(){		

		$return_arr = array();
		if(!empty($_GET)){
			extract($this->input->get());
		}
		elseif(!empty($_POST)){
			extract($this->input->post());		
		}

		if(!empty($id)){
			$contact_info = $this->db->query("SELECT c.* from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$id."' and c.phonenumber != ''")->result();
			 if(!empty($contact_info)){
                foreach ($contact_info as $key => $value) {
                	$contact_type = '--';
                    if($value->contact_type == 1){
                        $contact_type = 'OFFICE';
                    }elseif($value->contact_type == 2){
                        $contact_type = 'SITE';    
                    }

                    $designation = '';
                    if(!empty($value->designation_id)){
                    	$designation = value_by_id('tbldesignation',$value->designation_id,'designation');
                    }

                    $arr[] = array(
						'id' => $value->id,
						'contact_name' => $value->firstname,
						'mobile' => $value->phonenumber,
						'contact_type' => $contact_type,
						'designation' => $designation
					);
                }


				$return_arr['status'] = true;
				$return_arr['message'] = "Success";
				$return_arr['data'] = $arr;
            }else{
            	$return_arr['status'] = false;	
				$return_arr['message'] = "Record Not found!";
				$return_arr['data'] = [];
            }


		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = [];
		}


		header('Content-type: application/json');
	    echo json_encode($return_arr);

		//http://it-mustafa/schach/Leads_API/get_lead_contacts?id=13


	}

    

}

