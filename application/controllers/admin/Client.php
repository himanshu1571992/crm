<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Client extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Client_model');
        $this->load->model('home_model');
        $this->load->model('Clientdeposits_model');
    }

    /* List all Component Data */

    public function index() {
        check_permission(79,'view');

        $data['client_data'] = $this->Client_model->get();

        $this->load->view('admin/client/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('client');
    }

    public function client($id = '') {

         check_permission(79,'create');
        if ($this->input->post()) {
            $client_data = $this->input->post();

            if ($id == '') {

                $id = $this->Client_model->add($client_data);
                if ($id) {
                  //  handle_client_image_upload($id);
                    set_alert('success', _l('added_successfully', _l('client')));
                    redirect(admin_url('client'));
                }
            } else {
                 check_permission(79,'edit');
               // handle_client_image_upload($id);
                $success = $this->Client_model->edit($client_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('client')));
                }
                redirect(admin_url('client'));
            }
        }

      //  $this->load->model('Clients_model');
       // $data['client_branch_data'] = $this->Clients_model->get();

		$this->load->model('Taxes_model');
        $data['tax_data'] = $this->Taxes_model->get();

		$this->load->model('Component_model');
        $data['component_data'] = $this->Component_model->get();

        if ($id == '') {
            $title = _l('add_new', _l('client_lowercase'));
            $data["section"] = "add";
        } else {

			$this->load->model('Client_model');
           // $data['client'] = (array) $this->Client_model->get($id);
            $data['client'] = $this->db->query("SELECT * FROM `tblclients` where userid = '".$id."' order by company asc ")->row_array();
            //$data['clientcomponent'] = (array) $this->Client_model->getcomponentdata($id);

            $title = _l('edit', _l('client_lowercase'));
            $data["section"] = "edit";
        }
		$this->load->model('Site_manager_model');
		$data['state_data'] = $this->Site_manager_model->get_state();
		$data['allcity'] = $this->Site_manager_model->get_city();
        $data['city_data'] = array();
		 if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
            $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
        }
        $data['title'] = $title;
        $this->load->model('Client_category_model');
        $data['client_category_data'] = $this->Client_category_model->get();
        $data['sales_person_info'] = $this->db->query("SELECT `sales_person_id` from `tblleadstaffgroup` where status = 1  ")->result();
        $data['vendor_list'] = $this->db->query("SELECT * FROM `tblvendor` WHERE `status` = 1 ORDER BY name ASC")->result();

        $this->load->view('admin/client/client', $data);
    }

    public function delete($id) {
         check_permission(79,'delete');
        $success = $this->Client_model->delete($id);

        if ($success) {
            set_alert('success', _l('deleted', _l('client')));
            if (strpos($_SERVER['HTTP_REFERER'], 'client/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('client'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('component_lowercase')));
            redirect(admin_url('client/client/' . $id));
        }
    }

    /* Change Component status / active / inactive */

    public function change_client_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $client_data = array(
                'status' => $status
            );

            $this->Client_model->edit($client_data, $id);
        }
    }


	public function imagedelete() {

		$id=$this->input->post('proid');
        $success = $this->Client_model->imagedelete($id);

        if ($success) {
            set_alert('success', _l('deleted', _l('client')));
            if (strpos($_SERVER['HTTP_REFERER'], 'client/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('client/client/' . $id));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('component_lowercase')));
            redirect(admin_url('client/client/' . $id));
        }
    }


    public function change_followup_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $update_data = array(
                'followup' => $status
            );

            $this->home_model->update('tblclients',$update_data,array('userid'=>$id));
        }
    }

    public function change_branchfollowup_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $update_data = array(
                'followup' => $status
            );

            $this->home_model->update('tblclientbranch',$update_data,array('userid'=>$id));
        }
    }




    //by safiya

    public function clientsecuritycheue($id = '') {

        if ($this->input->post()) {
            extract($this->input->post());
            if ($id == '') {

                $c_date = null;
                if(!empty($cheque_date)){
                    $c_date = db_date($cheque_date);
                }
                $ad_data = array(
                    'added_by' => get_staff_user_id(),
                    'client_id' => $client_id,
                    'cheque_amount' => $cheque_amount,
                    'cheque_number' => $cheque_number,
                    'cheque_date' => $c_date,
                    'created_date' => date('Y-m-d H:i:s')
                );

                $insert = $this->home_model->insert('tblclientsecuritycheque',$ad_data);
                if ($insert) {
                    client_security_cheque_image_upload($insert);
                    set_alert('success', _l('added_successfully', 'client security cheque'));
                    redirect(admin_url('client/clientsecuritycheque_view'));
                }
            } else {
                $up_data = array(
                    'client_id' => $client_id,
                    'cheque_amount' => $cheque_amount,
                    'cheque_number' => $cheque_number,
                    'cheque_date' => db_date($cheque_date)
                );

                $update = $this->home_model->update('tblclientsecuritycheque',$up_data,array('id'=>$id));
                if ($update) {
                    if(!empty($_FILES['cheque_image']['name']))
                    {
                      client_security_cheque_image_upload($id);
                    }
                    set_alert('success', _l('updated_successfully', 'client security cheque'));
                }

                redirect(admin_url('client/clientsecuritycheque_view'));
            }
        }

        if ($id == '') {
            $title = 'Add Client Security Cheque';
        } else {
            $data['clientsecurity_info'] = $this->db->query("SELECT * from tblclientsecuritycheque WHERE id = '".$id."' ")->row();
            $title = 'Edit Client Security Cheque';
        }

        $data['client_data'] = $this->db->query("SELECT * FROM `tblclientbranch` where active = 1 and client_branch_name != '' order by client_branch_name asc")->result_array();

        $data['title'] = $title;
        $this->load->view('admin/client/clientsecuritycheue', $data);
    }

    public function return_clientsecuritycheue($id) {

        if ($this->input->post()) {
            extract($this->input->post());
            if($return_cheque == 1)
            {
                $cou_date = null;
                if(!empty($courier_date)){
                    $cou_date = db_date($courier_date);
                }

                $up_data = array(
                    'return_type' => $return_cheque,
                    'courier_name' => $courier_name,
                    'courier_tracking' => $courier_tracking,
                    'courier_date' => db_date($cou_date)
                );

                courier_return_image_upload($id);
            }
            else
            {
                $up_data = array(
                    'return_type' => $return_cheque,
                    'courier_name' => '',
                    'courier_tracking' => '',
                    'courier_date' => null
                );

                courier_return_image_upload($id);
            }


                $update = $this->home_model->update('tblclientsecuritycheque',$up_data,array('id'=>$id));
                if ($update) {
                    set_alert('success', _l('updated_successfully', 'client security cheque'));
                }

                redirect(admin_url('client/clientsecuritycheque_view'));
        }

        $data['clientsecurity_info'] = $this->db->query("SELECT * from tblclientsecuritycheque WHERE id = '".$id."' ")->row();
        $data['title'] = 'Return Details';
        $this->load->view('admin/client/return_clientsecuritycheue', $data);
    }


    public function clientsecuritycheque_view() {
       $where = "status = 1 ";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($client_id)){
                $data['client_id'] = $client_id;
                $where .= "and client_id = '".$client_id."'";
            }
        }

        $data['securitycheque_info'] = $this->db->query("SELECT * from tblclientsecuritycheque where ".$where." order by id desc ")->result();
        $data['client_data'] = $this->db->query("SELECT * FROM `tblclientbranch` where active = 1 ORDER BY client_branch_name ASC")->result_array();
        $data['title'] = 'Client Security Cheque';
        $this->load->view('admin/client/clientsecuritycheque_view', $data);
    }

    public function waveoff_list()
    {
        $data['waveoff_info'] = $this->db->query("SELECT * FROM tblclientwaveoff order by id desc")->result();

        $data['title'] = 'Client Waive Off List';
        $this->load->view('admin/client/waveoff_list', $data);
    }

    // By safiya
    public function add_waveoff($id="")
    {

        if(!empty($_POST)){
            extract($this->input->post());

            $assignstaff=$assign['assignid'];
            $staff_id = array();
            foreach($assignstaff as $s_id)
            {
               if($s_id > 0){
                $staff_id[]=$s_id;
               }

            }
            $staff_id=array_unique($staff_id);

            $ad_data = array(
                'client_id' => $client_id,
                'service_type' => $service_type,
                'staff_id' => get_staff_user_id(),
                'amount' => $amount,
                'remark' => $remark,
                'created_date' => date('Y-m-d H:i:s')
            );

            $insert = $this->home_model->insert('tblclientwaveoff',$ad_data);

            if($insert){

            $insert_id = $this->db->insert_id();

            if(!empty($staff_id)){
                    foreach ($staff_id as $staffid) {

                        $ad_field = array(
                            'staff_id' => $staffid,
                            'client_id' => $client_id,
                            'waveoff_id' => $insert_id,
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        $this->home_model->insert('tblclientwaveoffapproval',$ad_field);

                        $message = 'Client Waveoff send you for Approval';


                            $adata = array(
                                'staff_id' => $staffid,
                                'fromuserid'      => get_staff_user_id(),
                                'module_id' => 12,
                                'table_id' => $insert_id,
                                'approve_status' => 0,
                                'status' => 0,
                                'description'     => $message,
                                'link' => 'client/waveoff_approval/'.$insert_id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tblmasterapproval', $adata);

                            //Sending Mobile Intimation
                            $token = get_staff_token($staffid);
        //                    $message = $message;
                            $title = 'Schach';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                    }
                }

                set_alert('success', 'Client Waveoff Inserted Successfully');
                redirect(admin_url('client/waveoff_list'));

            }
        }

        $data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid` from `tblclientbranch`  WHERE client_branch_name != '' order by client_branch_name asc  ")->result();

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='20'")->result_array();
        $i=0;
        foreach($Staffgroup as $singlestaff)
        {
            $i++;
            $stafff[$i]['id']=$singlestaff['id'];
            $stafff[$i]['name']=$singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."' order by s.firstname asc")->result_array();
            $stafff[$i]['staffs']=$query;
        }
        $data['allStaffdata'] = $stafff;

        $data['approved_by'] = $this->db->query("SELECT * FROM `tblclientwaveoffapproval` where waveoff_id = '".$id."' ")->result_array();

        $data['title'] = 'Client Waive Off';
        $this->load->view('admin/client/add_waveoff', $data);

    }

    public function get_balance()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            echo client_balance_amt($client_id);
        }
    }

    public function delete_waveoff($id) {

        $delete = $this->home_model->delete('tblclientwaveoff',array('id'=>$id));

        if($delete == true){
            $this->home_model->delete('tblclientwaveoffapproval',array('waveoff_id'=>$id));
            $this->home_model->delete('tblmasterapproval',array('table_id'=>$id,'module_id'=>12));
            set_alert('success', 'Waveoff deleted successfully');
            redirect(admin_url('client/waveoff_list'));
        }

    }



    //By Safiya
    function waveoff_approval($id)
    {
        if(!empty($_POST)){
            extract($this->input->post());

            //Update master approval
            update_masterapproval_single(get_staff_user_id(),12,$id,$submit);
            update_masterapproval_all(12,$id,1);

            $ad_data = array('approve_status' => $submit,
                            'approve_date' => date('Y-m-d H:i:s'),
                            'approve_remark' => $remark
                        );
            $this->load->model('home_model');
            $update = $this->home_model->update('tblclientwaveoffapproval', $ad_data,array('waveoff_id'=>$id,'staff_id'=>get_staff_user_id()));
            $this->db->query("UPDATE tblclientwaveoff SET status='".$submit."' WHERE id='".$id."' ");



            if($update){
                if ($submit == 1){
                    set_alert('success', 'Client Waveoff approved succesfully');
                }else if($submit == 2){
                    set_alert('success', 'Client Waveoff Rejected succesfully');
                }else if($submit == 4){
                    set_alert('success', 'Client Waveoff Reconciliation succesfully');
                }else if($submit == 5){
                    set_alert('success', 'Client Waveoff Hold succesfully');
                }
                 redirect(admin_url('approval/notifications'));
            }


        }


        $data['info']  = $this->db->query("SELECT * FROM tblclientwaveoff where id = '".$id."'  ")->row();

        $staff  = $this->db->query("SELECT * FROM tblclientwaveoff where id = '".$id."'  ")->row();

        $data['appvoal_info'] = $this->db->query("SELECT * from tblclientwaveoffapproval where waveoff_id = '".$id."' and staff_id = '".get_staff_user_id()."' and approve_status != 0 ")->row();

        $data['id'] = $id;
        $data['staff_id'] = $staff->staff_id;

        $data['title'] = 'Client Waveoff Approval';
        $this->load->view('admin/client/waveoff_approval', $data);
    }

    //By Safiya

    public function waveoff_status() {


        if(!empty($_POST)){
            extract($this->input->post());
            $approval_info = $this->db->query("SELECT * from tblclientwaveoffapproval  where waveoff_id = '".$id."'  ")->result();
            ?>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="no-mtop mrg3">Approval Detail List</h4>
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
                            if(!empty($approval_info)){
                                $i = 1;
                                foreach ($approval_info as $key => $value) {

                                        if($value->approve_status == 0){
                                            $status = 'Pending';
                                            $color = 'Darkorange';
                                        }elseif($value->approve_status == 1){
                                            $status = 'Approved';
                                            $color = 'green';
                                        }elseif($value->approve_status == 2){
                                            $status = 'Reject';
                                            $color = 'red';
                                        }elseif($value->approve_status == 5){
                                            $status = 'Hold';
                                            $color = '#e8bb0b';
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo get_employee_name($value->staff_id); ?></td>
                                        <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                        <td><?php echo ($value->approve_remark != '') ?  $value->approve_remark : '--';  ?></td>
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

    /* this function use for client deposits list */
    public function client_deposits() {
        check_permission(332,'view');
        $data['client_info'] = $this->db->query("SELECT i.client_id, c.* FROM tblclientdeposits as  i LEFT JOIN tblclientbranch as c ON i.client_id = c.userid  GROUP By i.client_id")->result();
        $where = "id > 0";
        if ($this->input->post()) {
            extract($this->input->post());

            if (!empty($f_date) && !empty($t_date)) {
                $data['sf_date'] = $f_date;
                $data['st_date'] = $t_date;

                $where .= " and date between '" . db_date($f_date) . "' and '" . db_date($t_date) . "'";
            }

            if (!empty($client_id)) {
                $data['s_client'] = $client_id;
                $where .= " and client_id = '" . $client_id . "' ";
            }
            if ($status != '') {
                $data['s_status'] = $status;
                $where .= " and status = '" . $status . "'";
            }
            if ($deposit_return != '') {
                $data['return_status'] = $deposit_return;
                $where .= " and isReturn = '" . $deposit_return . "'";
            }
        }

        $data['title'] = 'Client Deposits';
        $data['table_data'] = $this->db->query("SELECT * from tblclientdeposits where " . $where . " order by date desc ")->result();
        $this->load->view('admin/client_deposits/on_account_list', $data);
    }

    /* this function use for add client deposit */
    public function client_deposits_add($id = ""){

        if ($this->input->post()){
            extract($this->input->post());
            $postdata = $this->input->post();
            if ($id == ""){

                /* this function use for check */
                $query = $this->db->query("SELECT * FROM tblclientdeposits WHERE payment_mode = '".$payment_mode."' and cheque_no = '".$cheque_no."' and ttl_amt = '".$ttl_amt."' ")->row();
                if(!empty($query))
                {
                    set_alert('warning', 'Already exist!');
                    redirect(admin_url('client/client_deposits'));
                    die;
                }

                $insert_id = $this->Clientdeposits_model->add($postdata);
                if ($insert_id){
                    set_alert('success', 'Client Deposits Add Successfully.');
                    redirect(admin_url('client/client_deposits'));
                    die;
                }
                else{
                    set_alert('danger', 'Somthing went wrong.');
                    redirect(admin_url('client/client_deposits'));
                    die;
                }
            }else{
                $update_id = $this->Clientdeposits_model->update($postdata, $id);
                if ($update_id){
                    set_alert('success', 'Client Deposits Update Successfully.');
                    redirect(admin_url('client/client_deposits'));
                    die;
                }
            }


        }

        if ($id != ""){
            check_permission(332,'edit');
            $data["title"] = "Edit Client Deposits";
            $data['client_deposits'] = $this->db->query("SELECT * from tblclientdeposits where id = '".$id."' ")->row();
            $data['file_info'] = $this->db->query("SELECT * FROM tblfiles WHERE rel_id = '".$id."' and rel_type = 'client_deposit'  ")->result();
        }else{
            check_permission(332,'create');
            $data["title"] = "Client Deposits";
        }

        $data['client_info'] = $this->db->query("SELECT * FROM tblclientbranch where active = 1 and client_branch_name != '' order by client_branch_name asc")->result();
        $data['service_type'] = get_service_type();
        $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' order by name asc")->result();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
        $i=0;
        foreach($Staffgroup as $singlestaff)
        {
            $i++;
            $stafff[$i]['id']=$singlestaff['id'];
            $stafff[$i]['name']=$singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."' order by s.firstname asc")->result_array();
            $stafff[$i]['staffs']=$query;
        }
        $data['allStaffdata'] = $stafff;
        $data['approved_by'] = $this->db->query("SELECT * FROM `tblclientdepositsapproval` where clientdeposits_id = '".$id."' ")->result();
        $this->load->view('admin/client_deposits/add', $data);
    }

    /* this function use for client deposit approval */
    public function clientdeposit_approval($id = ""){

        if ($this->input->post()){
            extract($this->input->post());


            //Update master approval
            update_masterapproval_single(get_staff_user_id(),19,$id,$submit);
            update_masterapproval_all(19,$id,1);

            $ad_data = array('approve_status' => $submit,
                            'approve_date' => date('Y-m-d H:i:s'),
                            'approve_remark' => $remark
                        );
            $this->load->model('home_model');
            $update = $this->home_model->update('tblclientdepositsapproval', $ad_data,array('clientdeposits_id'=>$id,'staff_id'=>get_staff_user_id()));
            $this->db->query("UPDATE tblclientdeposits SET status='".$submit."' WHERE id='".$id."' ");

            if($update){
                if ($submit == 1){
                    set_alert('success', 'Client Deposit taken approval succesfully');
                }else if ($submit == 4){
                    set_alert('success', 'Client Deposit Status update succesfully');
                }else if ($submit == 5){
                    set_alert('success', 'Client Deposit Status update succesfully');
                }
                 
                 redirect(admin_url('approval/notifications'));
            }

        }

        $data["title"] = "Client Deposits Approval";

        $data['client_deposits']  = $this->db->query("SELECT * FROM tblclientdeposits where id = '".$id."'  ")->row();

        if(!empty($data['client_deposits']) && $data['client_deposits']->status > 0 && $data['client_deposits']->status != 5){
            set_alert('warning', 'Action already taken!');
            redirect(admin_url('approval/notifications'));
            
        }

        $data['client_info'] = $this->db->query("SELECT * FROM tblclientbranch where active = 1")->result();
        $data['service_type'] = get_service_type();
        $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' ")->result();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
        $i=0;
        foreach($Staffgroup as $singlestaff)
        {
            $i++;
            $stafff[$i]['id']=$singlestaff['id'];
            $stafff[$i]['name']=$singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."'")->result_array();
            $stafff[$i]['staffs']=$query;
        }
        $data['allStaffdata'] = $stafff;
        $data['id'] = $id;
        $data['appvoal_info'] = $this->db->query("SELECT * from tblclientdepositsapproval where clientdeposits_id = '".$id."' and staff_id = '".get_staff_user_id()."' and approve_status != 0 ")->row();
//        $data['approved_by'] = $this->db->query("SELECT * FROM `tblclientdepositsapproval` where clientdeposits_id = '".$id."' ")->result_array();
        $this->load->view('admin/client_deposits/clientdeposit_approval', $data);
    }

    /* this function use for get approval status */
    public function get_status() {

        if(!empty($_POST)){
            extract($this->input->post());
            if (isset($type) && $type=="client_refund"){
                $assign_info = $this->db->query("SELECT * from tblclientrefundapproval  where clientrefund_id = '".$id."' ")->result();
            }else{
                $assign_info = $this->db->query("SELECT * from tblclientdepositsapproval  where clientdeposits_id = '".$id."' ")->result();
            }
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
                                        <td>Status</td>
                                        <td>Remark</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($assign_info)) {
                                        $i = 1;
                                        foreach ($assign_info as $key => $value) {

                                            if ($value->approve_status == 0) {
                                                $status = 'Pending';
                                                $color = 'Darkorange';
                                            } elseif ($value->approve_status == 1) {
                                                $status = 'Approved';
                                                $color = 'green';
                                            } elseif ($value->approve_status == 2) {
                                                $status = 'Reject';
                                                $color = 'red';
                                            }elseif ($value->approve_status == 4) {
                                                $status = 'Reconciliation';
                                                $color = 'brown';
                                            }elseif ($value->approve_status == 5) {
                                                $status = 'ON Hold';
                                                $color = '#e8bb0b;';
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                                <td><?php echo $value->approve_remark; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
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

    /* this function use for delete client deposit */
    public function delete_client_deposit($id){
        check_permission(332,'delete');
        $delete = $this->home_model->delete('tblclientdeposits',array('id'=>$id));

        if($delete == true){
            $this->home_model->delete('tblclientdepositsapproval',array('clientdeposits_id'=>$id));
            $this->home_model->delete('tblmasterapproval',array('table_id'=>$id,'module_id'=>19));
            $files_info = $this->db->query("SELECT * FROM tblfiles WHERE `rel_type`='client_deposit' AND `rel_id`=".$id." ")->result();
            if (!empty($files_info)){
                foreach ($files_info as $value) {
                    $path = get_upload_path_by_type('client_deposit') . $id . '/'.$value->file_name;
                    unlink($path);
                    $this->home_model->delete('tblfiles',array("id" => $value->id));
                }
            }

            set_alert('success', 'Client Deposit deleted successfully');
            redirect(admin_url('client/client_deposits'));
        }
    }

    /* this function use for get invoice assign */
    public function get_invoice_assign() {

        if(!empty($_POST)){
            extract($this->input->post());

            $deposit_info = $this->db->query("SELECT * from tblclientdeposits WHERE id = '".$id."' ")->row();
            $invoice_list = $this->db->query("SELECT * FROM `tblinvoices` WHERE clientid = '".$deposit_info->client_id."' and parent_id = 0 ORDER BY id DESC")->result();
            ?>
            <div class="row">
                <div class="col-md-12">

                    <div class="form-group col-md-12" app-field-wrapper="date">
                        <label for="date" class="control-label"><?php echo 'Invoice List'; ?></label>
                        <select class="form-control selectpicker" multiple="" id="invoice_id" name="invoice_id[]" data-live-search="true">
                            <option value="" disabled="" selected=""></option>
                            <?php
                                if (!empty($invoice_list)) {
                                    foreach ($invoice_list as $row) {
                                        $invoice_data = explode(",", $deposit_info->invoice_ids);
                            ?>
                                    <option value="<?php echo $row->id; ?>" <?php echo (isset($deposit_info) && in_array($row->id, $invoice_data)) ? 'selected' : "" ?>><?php echo $row->number; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <input type="hidden" name="clientdeposit_id" class="clientdeposit_id" value="<?php echo $id; ?>">
                    </div>
                </div>
            </div>
            <?php
        }
    }

    /* this function use for assign invoice to client deposit */
    public function assign_invoice(){
        if(!empty($_POST)){
            extract($this->input->post());
            if (isset($clientdeposit_id)){

                $invoice_id = implode(",", $invoice_id);
                $this->home_model->update('tblclientdeposits', array("invoice_ids" => $invoice_id), array('id'=>$clientdeposit_id));

                set_alert('success', 'Assign Invoice Successfully');
                redirect(admin_url('client/client_deposits'));
            }
        }
    }

    /* this function use for client deposit return */
    public function client_deposits_return($id){
        $response = $this->home_model->update("tblclientdeposits", array("isReturn" => 1), array('id'=>$id));
        if($response){
            set_alert('success', 'Deposit Return Successfully');
        }else{
            set_alert('warning', 'Something went wrong');
        }
        redirect(admin_url('client/client_deposits'));
    }

    /* this function use for client refund list */
    public function client_refund(){
        check_permission(402,'view');
        $data['client_info'] = $this->db->query("SELECT i.client_id, c.* FROM tblclientrefund as  i LEFT JOIN tblclientbranch as c ON i.client_id = c.userid  GROUP By i.client_id")->result();
        $where = "r.id > 0";
        if ($this->input->post()) {
            extract($this->input->post());

            if (!empty($f_date) && !empty($t_date)) {
                $data['sf_date'] = $f_date;
                $data['st_date'] = $t_date;

                $where .= " and r.date between '" . db_date($f_date) . "' and '" . db_date($t_date) . "'";
            }

            if (!empty($client_id)) {
                $data['s_client'] = $client_id;
                $where .= " and r.client_id = '" . $client_id . "' ";
            }
            if ($status != '') {
                $data['s_status'] = $status;
                $where .= " and r.status = '" . $status . "'";
            }
            if ($service_type != '') {
                $data['service_type'] = $service_type;
                $where .= " and r.service_type = '" . $service_type . "'";
            }
        }else{
            // $where = "status = 1 and itc_status =  0 ";
            $from_date_year = value_by_id_empty('tblfinancialyear',getCurrentFinancialYear(),'from_date');
            $to_date_year = value_by_id_empty('tblfinancialyear',getCurrentFinancialYear(),'to_date');
            $where .= " and r.date BETWEEN '".$from_date_year."' AND '".$to_date_year."' ";
            $data['sf_date'] = _d($from_date_year);
            $data['st_date'] = _d($to_date_year);
        }

        $data['title'] = 'Client Refund';
        // $data['table_data'] = $this->db->query("SELECT * from tblclientrefund where " . $where . " order by date desc ")->result();
        $data['table_data'] = $this->db->query("SELECT r.*, pd.utr_no, pd.utr_date from  tblclientrefund as r LEFT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'client_refund' where ".$where." order by r.id desc")->result();
        $this->load->view('admin/client/client_refund_list', $data);
    }

    /* this function use for client refund request add */
    public function client_refund_add($id = ""){

       if (!empty($_POST)){
            $postdata = $this->input->post();
            if ($id == ""){
               $insert_id = $this->Clientdeposits_model->add_client_refund($postdata);
               if ($insert_id){
                   set_alert('success', 'Client Refund Add Successfully.');
               }
               else{
                   set_alert('danger', 'Somthing went wrong.');
               }
               redirect(admin_url('client/client_refund'));
               die;
           }else{
               $update_id = $this->Clientdeposits_model->update_client_refund($postdata, $id);
               if ($update_id){
                   set_alert('success', 'Client refund Update Successfully.');
                   redirect(admin_url('client/client_refund'));
                   die;
               }
           }
       }

       /* this is for assign staff list */
       $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='20'")->result_array();
       $i=0;
       foreach($Staffgroup as $singlestaff)
       {
           $i++;
           $stafff[$i]['id']=$singlestaff['id'];
           $stafff[$i]['name']=$singlestaff['name'];
           $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."'")->result_array();
           $stafff[$i]['staffs']=$query;
       }
       $data['allStaffdata'] = $stafff;

       /* this is return whoes those people which is balance amount have minus  */
       $data["client_branch_data"] = array();
       $clientdata = $this->db->query("SELECT `client_branch_name`,`userid` FROM `tblclientbranch` WHERE `active`=1")->result();
       $k=0;
       if (!empty($clientdata)){
          foreach ($clientdata as $value) {
             $clientbalamt = client_balance_amt($value->userid);
             if ($id==""){
                 $clientrefund = $this->db->query("SELECT * FROM `tblclientrefund` WHERE `client_id`='".$value->userid."' AND `payfile_done`=0")->row();
                 if ($clientbalamt < 0 && empty($clientrefund)){
                    $k++;
                    $data["client_branch_data"][] = $value;
                 }
             }else{
                 if ($clientbalamt < 0){
                    $k++;
                    $data["client_branch_data"][] = $value;
                 }
             }
          }
       }

       if ($id != ""){
           $data["title"] = "Edit Client Refund";
           $data['client_refund_info'] = $this->db->query("SELECT * from tblclientrefund where id = '".$id."' ")->row();
       }else{
           $data["title"] = "Add Client Refund";
       }
       $this->load->view('admin/client/add_client_refund', $data);
    }

    /* this function use for delete client refund */
    public function delete_client_refund($id){
        $delete = $this->home_model->delete('tblclientrefund',array('id'=>$id));
        if($delete == true){
            $this->home_model->delete('tblclientrefundapproval',array('clientrefund_id'=>$id));
            $this->home_model->delete('tblmasterapproval',array('table_id'=>$id,'module_id'=>47));

            set_alert('success', 'Client Refund deleted successfully');
            redirect(admin_url('client/client_refund'));
        }
    }

    public function getclientbalanceamount($client_id){
        echo abs(client_balance_amt($client_id));
    }

    public function client_refund_approval($id){
      if ($this->input->post()){
          extract($this->input->post());
          //Update master approval
          update_masterapproval_single(get_staff_user_id(),47,$id,$submit);
          update_masterapproval_all(47,$id,$submit);

          $ad_data = array('approve_status' => $submit,
                          'approve_date' => date('Y-m-d H:i:s'),
                          'approve_remark' => $remark
                      );
          $this->db->query("UPDATE tblclientrefund SET status='".$submit."' WHERE id='".$id."' ");
          $update = $this->home_model->update('tblclientrefundapproval', $ad_data,array('clientrefund_id'=>$id,'staff_id'=>get_staff_user_id()));
          if ($submit == 1){
               set_alert('success', 'Client refund approvad succesfully');
          }else if($submit == 4){
                set_alert('success', 'Client refund Reconciliation succesfully');
          }else if($submit == 5){
            set_alert('success', 'Client refund Hold succesfully');
          }else{
              set_alert('danger', 'Client refund rejected succesfully');
          }
          redirect(admin_url('approval/notifications'));
      }

      $data["title"] = "Client Refund Approval";

      $data['client_refund_info']  = $this->db->query("SELECT * FROM tblclientrefund where id = '".$id."'  ")->row();

    //   if(!empty($data['client_refund_info']) && $data['client_refund_info']->status > 0){
    //       set_alert('warning', 'Action already taken!');
    //        redirect(admin_url('approval/notifications'));
    //   }

      $data['id'] = $id;
      $data['appvoal_info'] = $this->db->query("SELECT * from tblclientrefundapproval where clientrefund_id = '".$id."' and approve_status !=0 ")->row();
      $this->load->view('admin/client/clientrefund_approval', $data);
    }
}
