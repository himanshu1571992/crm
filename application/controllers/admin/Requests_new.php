<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Requests_new extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('requests_model');
        $this->load->model('home_model');
    }
	
    /* this function use for index */
	public function index(){
		$this->salary_request_list();
	}

	/* THIS FUNCTION USE FOR SALARY REQUEST */
	public function salary_request_list(){

		$data["salary_request_list"] = $this->db->query("SELECT * FROM tblrequests WHERE `category`= '1' and (`addedfrom`= ".get_staff_user_id()." OR `addedby`= ".get_staff_user_id().") ")->result();
		$data["title"] = "Salary Request List";
		$this->load->view("admin/request_new/salary_request_list", $data); 
	}

	/* THIS FUNCTION USE FOR ADVANCE CONVEYANCE REQUEST */
	public function advance_conveyance_list(){

		$data["conveyance_request_list"] = $this->db->query("SELECT * FROM tblrequests WHERE `category`= '2' and (`addedfrom`= ".get_staff_user_id()." OR `addedby`= ".get_staff_user_id().") ")->result();
		$data["title"] = "Advance Conveyance Request List";
		$this->load->view("admin/request_new/advance_conveyance_list", $data); 
	}

	/* THIS FUNCTION USE FOR LOAN REQUEST */
	public function loan_request_list(){

		$data["loan_request_list"] = $this->db->query("SELECT * FROM tblrequests WHERE `category`= '3' and (`addedfrom`= ".get_staff_user_id()." OR `addedby`= ".get_staff_user_id().") ")->result();
		$data["title"] = "Loan Request List";
		$this->load->view("admin/request_new/loan_request_list", $data); 
	}

	/* THIS FUNCTION USE FOR TRANSFER REQUEST */
	public function transfer_request_list(){

		$data["transfer_request_list"] = $this->db->query("SELECT * FROM tblrequests WHERE `category`= '4' and (`addedfrom`= ".get_staff_user_id()." OR `addedby`= ".get_staff_user_id().") ")->result();
		$data["title"] = "Transfer Request List";
		$this->load->view("admin/request_new/transfer_request_list", $data); 
	}

	/* THIS FUNCTION USE FOR ADD REQUEST BY CATEGORY */
	function add_request($category_id){

		if ($this->input->post()) {
			extract($this->input->post());

			/* this is get group id */
			$group_ids = $this->get_assign_groupids();

			/* this is get parson id */
			$staff_ids = $this->get_assign_parsonids();
			
			$onbehalf = (!empty($onbehalf)) ? $onbehalf : 0;
			$person_id = (!empty($person_id)) ? $person_id : 0;
			$tenure_id = (!empty($tenure_id)) ? $tenure_id : 0;
			$payment_mode = (!empty($payment_mode)) ? $payment_mode : 0;
			$transfer_type = (!empty($transfer_type)) ? $transfer_type : 0;
			$pettycash_id = (!empty($pettycash_id)) ? $pettycash_id : 0;
			$trip_id = (!empty($trip_id)) ? $trip_id : 0;
			$branchid = (!empty($branch_id)) ? $branch_id : 0;
			$expenses_id = (!empty($expenses_id)) ? json_encode($expenses_id) : '';
			if ($transfer_type == '1'){
				$pettycash_id = 0;
			}else if ($transfer_type == '2' || $transfer_type == '3'){
				$branchid = 0;
				$person_id = 0;
			}
			$request = array(
				'user_id' => get_staff_user_id(),
				'amount' => $amount,
				'tenure' => $tenure_id,
				'category' => $category_id,
				'on_behalf' => $onbehalf,
				'branch' => $branchid,
				'person_id' => $person_id,
				'payment_mode' => $payment_mode,
				'reason' => $reason,
				'description' => $description,
				'group_ids' => json_encode($group_ids),
				'staffid' => json_encode($staff_ids),
				'transfer_type' => $transfer_type,
				'pettycash_id' => $pettycash_id,
				'trip_id' => $trip_id,
				'expenses_id' => $expenses_id,
			);
			
			/* call curl method for store request */
			$request_url = site_url()."Requests_API/add_request";
			$response = $this->curl_method($request_url, $request);
			if ($response === TRUE){
				set_alert('success', 'Request added successfully');
			}else{
				set_alert('warning', $response);
			}
			$redirect_url = '';
			if ($category_id == 2){
				$redirect_url = "/advance_conveyance_list";
			}else if ($category_id == 3){
				$redirect_url = "/loan_request_list";
			}else if ($category_id == 4){
				$redirect_url = "/transfer_request_list";
			}
			redirect(admin_url('requests_new'.$redirect_url));
		}
		
		//getting group info
		$data['Staffgroup'] = get_staff_group(14);
		$Staffgroup = get_staff_group(14,get_staff_user_id());
		
		$i=0;
		$stafff=array();
		if(!empty($Staffgroup)){
			foreach($Staffgroup as $singlestaff)
			{
				$i++;
				$stafff[$i]['id']=$singlestaff['id'];
				$stafff[$i]['name']=$singlestaff['name'];
				$query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."'")->result_array();
				$stafff[$i]['staffs']=$query;
			}
		}
		$data['allStaffdata'] = $stafff;
		$data["branch_list"] = $this->db->query("SELECT `id`,`comp_branch_name` FROM tblcompanybranch WHERE `status`='1'  ")->result();
        // $data['loan_tenues_list']    = $this->requests_model->get_tenues();
		$data['show_onbehalf_option'] = checkMenuPermission(get_staff_user_id(),'on_behalf');
		if ($category_id == 1){
			$data["title"] = "Add Salary Request";
			$this->load->view("admin/request_new/add_salary_request", $data); 
		}else if ($category_id == 2){

			$data["title"] = "Add Advance Conveyance Request";
			$data["approved_expenses_list"] = $this->curl_method(base_url()."Requests_API/expenseListForRequest", array("user_id" => get_staff_user_id()));
			$data["trip_list"] = $this->curl_method(base_url()."Challan_API/requestListForAdvance", array("user_id" => get_staff_user_id()));
			$this->load->view("admin/request_new/add_advance_conveyance", $data); 
		}else if ($category_id == 3){

			$data["title"] = "Add Loan Request";
			$data["tenure_list"] = $this->requests_model->get_tenues();
			$this->load->view("admin/request_new/add_loan_request", $data); 
		}else if ($category_id == 4){

			$data["wallet_amount"] = wallet_amount(get_staff_user_id(),'','');
			$department_info  = $this->db->query("SELECT * FROM tblpettycashmaster WHERE  staff_id = '".get_staff_user_id()."' and staff_confirmed = 1 and status = 1")->row();
			$data["pettycash_manager"] = (!empty($department_info)) ? 1 : 0;
			$data["payment_mode_list"] = $this->home_model->get_result('tblpaymentmode', array('status'=>1), '','');
			$data["pettycash_list"] = $this->db->query("SELECT * FROM tblpettycashmaster WHERE  status = '1' and staff_id > 0 and staff_confirmed = 1 and staff_id != '".get_staff_user_id()."' ")->result();
			$data["title"] = "Add Transfer Request";
			$this->load->view("admin/request_new/add_transfer_request", $data);
		}else{
			redirect(admin_url('requests_new'));
		}
	}

	/* THIS FUNCTION USE FOR GET BRANCH PERSON THOUGH OF BRANCH SELECTION */
	public function get_branch_person() {
		if(!empty($_POST)){
			extract($this->input->post());
			$staff_id = get_staff_user_id();
			$user_info = branch_employee($branch_id,$staff_id);
			
			if(!empty($user_info)){
					echo '<option value="" disabled selected >--Select Person-</option>';
				foreach($user_info as $row){
					echo "<option value='".$row->staffid."'>".$row->firstname.' ['.$row->email.']'."</option>";
				}
			}
		}
	}
	
	/* THIS FUNCTION USE FOR GET APPROVAL INFO */
	public function get_approval_info() {

    	if(!empty($_POST)){
       		extract($this->input->post());

       		$assign_info = $this->db->query("SELECT * FROM `tblrequestapproval` WHERE `request_id` = '".$id."'  ")->result();
       		?>
       		<div class="row">
                <div class="col-md-12">
                    <h4 class="no-mtop mrg3">Assign Detail List</h4>
                </div>
                    <hr/>
                <div class="col-md-12">
                    <div style="overflow-x:auto !important;">
                        <div class="form-group" >
                            <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                <thead>
                                    <tr>
                                        <td>S.No</td>
                                        <td>Name</td>
                                        <td>Action</td>
                                        <td>Remark</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if(!empty($assign_info)){
                                        $i = 1;
                                        foreach ($assign_info as $key => $value) {

                                            if($value->approve_status == 0){
                                                $status = 'Pending';
                                                $color = 'Darkorange';
                                            }elseif($value->approve_status == 1){
                                                $status = 'Approved';
                                                $color = 'green';
                                            }elseif($value->approve_status == 2){
                                                $status = 'Reject';
                                                $color = 'red';
                                            }elseif($value->approve_status == 4){
                                                $status = 'Reconciliation';
                                                $color = 'brown';
                                            }elseif($value->approve_status == 5){
                                                $status = 'On Hold';
                                                $color = '#e8bb0b;';
                                            }
                                ?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo get_employee_name($value->staff_id); ?></td>
                                            <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                            <td><?php echo ($value->approvereason != '') ?  $value->approvereason : '--';  ?></td>
                                        </tr>
                                <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
       		<?php
       	}
    }

	/* THIS FUNCTION USE FOR GET ASSIGN GROUP ID */
	function get_assign_groupids(){
		$group_ids = array();
		$assigngroup = $_POST['assignid'];
		if(!empty($assigngroup)){
			foreach ($assigngroup as $single_staff) {
				if (strpos($single_staff, 'group') !== false) {
					$group_ids[] = str_replace("group", "", $single_staff);
				}
			}
			$group_ids = array_unique($group_ids);
		}
		return $group_ids;
	}

	/* THIS FUNCTION USE FOR GET ASSIGN PARSON ID */
	function get_assign_parsonids(){
		$staff_ids = array();
		$assigngroup = $_POST['assignid'];
		
		if(!empty($assigngroup)){
			foreach ($assigngroup as $single_staff) {
				if (strpos($single_staff, 'staff') !== false) {
					$staff_ids[] = str_replace("staff", "", $single_staff);
				}
			}
			$staff_ids = array_unique($staff_ids);
		}
		return $staff_ids;
	}

	/* THIS FUNCTION USE FOR CALL POST CURL METHOD */
	function curl_method($request_url, $post_fields){

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $request_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));
		$response = curl_exec($ch);

		if (!empty($response)){
			$response_decode = json_decode($response, TRUE);
			if (!empty($response_decode) && isset($response_decode["error"])){
				return $response_decode["error"];
			}else if (!empty($response_decode) && isset($response_decode["success"])){
				return TRUE;
			}else if (!empty($response_decode) && isset($response_decode["data"])){
				return $response_decode["data"];
			}
		}
		return "Somthing went wrong!";
	}
}