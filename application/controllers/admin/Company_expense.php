<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Company_expense extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function index()
    {

        check_permission('135,267','view');

        $data['category_info']  = $this->db->query("SELECT * FROM tblcompanyexpensecatergory  order by id desc ")->result();

        $data['title'] = 'Expense Category List';
        $this->load->view('admin/company_expense/manage', $data);

    }

    public function add($id="")
    {
        check_permission('135,267','create');

        if(!empty($_POST)){
            extract($this->input->post());


            $date = str_replace("/","-",$date);
            $date = date("Y-m-d",strtotime($date));


            $ad_data = array(
                            'name' => $name,
                            'show_date' => $show_date,
                            'show_deposit' => $show_deposit,
                            'status' => 1
                        );



            $insert = $this->home_model->insert('tblcompanyexpensecatergory', $ad_data);

            if($insert){

                set_alert('success', 'Category added Successfully');
                redirect(admin_url('company_expense'));
            }
        }

        if(!empty($id)){
            $data['category_info']  = $this->db->query("SELECT * FROM tblcompanyexpensecatergory WHERE id = '".$id."'")->row();
            $data['id'] = $id;
            $data['title'] = 'Edit Expense Category';
        }else{
            $data['title'] = 'Add Expense Category';
        }


        $this->load->view('admin/company_expense/add', $data);

    }


    public function edit($id="")
    {

        check_permission('135,267','edit');
        if(!empty($_POST)){
            extract($this->input->post());


            $date = str_replace("/","-",$date);
            $date = date("Y-m-d",strtotime($date));



           $ad_data = array(
                            'name' => $name,
                            'show_date' => $show_date,
                            'show_deposit' => $show_deposit,
                            'status' => 1
                        );


            $update = $this->home_model->update('tblcompanyexpensecatergory', $ad_data,array('id'=>$id));

            if($update){

                set_alert('success', 'Category updated Successfully');
                redirect(admin_url('company_expense'));
            }
        }


    }




    public function delete($id)
    {
        check_permission('135,267','delete');

        $companyexpenparties = $this->db->query("SELECT * FROM `tblcompanyexpenseparties` where category_id = '".$id."' ")->row();
        $bnkpaymentrequestdetails = $this->db->query("SELECT * FROM `tblbankpaymentrequestdetails` Where category_id = '".$id."' ")->row();
        $bnkpaymentdetails = $this->db->query("SELECT * FROM `tblbankpaymentdetails` Where category_id = '".$id."' ")->row();
        $heads = $this->db->query("SELECT * FROM `tblheads` Where category_id = '".$id."' ")->row();

        if (!empty($companyexpenparties) OR !empty($bnkpaymentrequestdetails) OR !empty($bnkpaymentdetails) OR !empty($heads)){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }

        $response = $this->home_model->delete('tblcompanyexpensecatergory', array('id'=>$id));
        if ($response == true) {
            set_alert('success', _l('deleted', 'category'));
        } else {
            set_alert('warning', _l('problem_deleting', 'category'));
        }
        redirect(admin_url('company_expense'));
    }






    public function party_list()
    {

        check_permission(92,'view');
        if(!empty($_POST)){
            extract($this->input->post());

            $data['scategory_id'] = $category_id;

            $data['party_info']  = $this->db->query("SELECT * FROM tblcompanyexpenseparties where category_id = '".$category_id."' order by id desc ")->result();

        }else{
             $data['party_info']  = $this->db->query("SELECT * FROM tblcompanyexpenseparties  order by id desc ")->result();
        }

        $data['category_info']  = $this->db->query("SELECT * FROM tblcompanyexpensecatergory where status = 1  order by id desc ")->result();
        $data['title'] = 'Expense Parties List';
        $this->load->view('admin/company_expense/manage_party', $data);

    }

    public function add_party($id="")
    {
        check_permission(92,'create');
        $data['category_info']  = $this->db->query("SELECT * FROM tblcompanyexpensecatergory where id NOT IN (1,2) and status = 1  order by name asc ")->result();

        if(!empty($_POST)){
            extract($this->input->post());


            $date = str_replace("/","-",$date);
            $date = date("Y-m-d",strtotime($date));


            $ad_data = array(
                            'name' => $name,
                            'category_id' => $category_id,
                            'head_id' => $head_id,
                            'sub_head_id' => $subhead_id,
                            'bank_name' => $bank_name,
                            'ifsc' => $ifsc,
                            'account_no' => $account_no,
                            'gst_no' => $gst_no,
                            'pan_no' => $pan_no,
                            'mobile_no' => $mobile_no,
                            'address' => $address,
                            'remark' => $remark,
                            'status' => $status,
                            'created_at' => date('Y-m-d')
                        );



            $insert = $this->home_model->insert('tblcompanyexpenseparties', $ad_data);

            if($insert){

                set_alert('success', 'Party added Successfully');
                redirect(admin_url('company_expense/party_list'));
            }
        }

        if(!empty($id)){
            $data['party_info']  = $this->db->query("SELECT * FROM tblcompanyexpenseparties WHERE id = '".$id."'")->row();
            $data['id'] = $id;
            $data['title'] = 'Edit Expense Party';
        }else{
            $data['title'] = 'Add Expense Party';
        }


        $this->load->view('admin/company_expense/add_party', $data);

    }


    public function edit_party($id="")
    {
        check_permission(92,'edit');

        if(!empty($_POST)){
            extract($this->input->post());


            $date = str_replace("/","-",$date);
            $date = date("Y-m-d",strtotime($date));



           $ad_data = array(
                            'name' => $name,
                            'category_id' => $category_id,
                            'head_id' => $head_id,
                            'sub_head_id' => $subhead_id,
                            'bank_name' => $bank_name,
                            'ifsc' => $ifsc,
                            'account_no' => $account_no,
                            'gst_no' => $gst_no,
                            'pan_no' => $pan_no,
                            'mobile_no' => $mobile_no,
                            'address' => $address,
                            'remark' => $remark,
                            'status' => $status
                        );


            $update = $this->home_model->update('tblcompanyexpenseparties', $ad_data,array('id'=>$id));

            if($update){

                set_alert('success', 'Category updated Successfully');
                redirect(admin_url('company_expense/party_list'));
            }
        }
    }

    public function delete_party($id)
    {
        check_permission(92,'delete');

        $bnk_payment_details = $this->db->query("SELECT * FROM `tblbankpaymentdetails` Where payee_id = '".$id."' ")->row();
        $paymentrequest = $this->db->query("SELECT * FROM `tblpaymentrequest` Where party_id = '".$id."' ")->row();
        if (!empty($bnk_payment_details) OR !empty($paymentrequest)){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }

        $response = $this->home_model->delete('tblcompanyexpenseparties', array('id'=>$id));
        if ($response == true) {
            set_alert('success', _l('deleted', 'party'));
        } else {
            set_alert('warning', _l('problem_deleting', 'party'));
        }
        redirect(admin_url('company_expense/party_list'));
    }

    //By Safiya
    public function headmaster_view() {
        check_permission(326,'view');
        if(!empty($_POST)){
            extract($this->input->post());

            $data['scategory_id'] = $category_id;

            $data['headmaster_info']  = $this->db->query("SELECT * FROM tblheads where category_id = '".$category_id."' order by id desc ")->result();

        }else{
             $data['headmaster_info'] = $this->db->query("SELECT * from tblheads order by id desc")->result();
        }


        $data['category_info']  = $this->db->query("SELECT * FROM tblcompanyexpensecatergory where status = 1  order by id desc ")->result();
        $data['title'] = 'Head Master';
        $this->load->view('admin/company_expense/headmaster_view', $data);
    }

    public function head_master($id = '') {
        
        if ($this->input->post()) {
            extract($this->input->post());
            if ($id == '') {

                $ad_data = array(
                    'category_id' => $category_id,
                    'name' => $name
                );

                $insert = $this->home_model->insert('tblheads',$ad_data);
                if ($insert) {
                    set_alert('success', _l('added_successfully', 'Head master'));
                    redirect(admin_url('company_expense/headmaster_view'));
                }
            } else {
                $up_data = array(
                    'category_id' => $category_id,
                    'name' => $name
                );

                $update = $this->home_model->update('tblheads',$up_data,array('id'=>$id));
                if ($update) {
                    set_alert('success', _l('updated_successfully', 'Head master'));
                }

                redirect(admin_url('company_expense/headmaster_view'));
            }
        }

        if ($id == '') {
            $title = 'Add Head';
            check_permission(326,'create');
        } else {
            $data['heads_info'] = $this->db->query("SELECT * from tblheads WHERE id = '".$id."' ")->row();
            $title = 'Edit Head';
            check_permission(326,'edit');
        }

        $data['category_info']  = $this->db->query("SELECT * FROM tblcompanyexpensecatergory where id NOT IN (1,2,7) and status = 1  order by name asc ")->result();
        $data['title'] = $title;
        $this->load->view('admin/company_expense/head_master', $data);
    }

    public function change_head_status($id, $status) {
        $this->load->model('home_model');
        if ($this->input->is_ajax_request()) {

            $update_data = array(
                'status' => $status
            );

            $this->home_model->update('tblheads',$update_data,array('id'=>$id));
        }
    }

    public function delete_head_master($id) {
        check_permission(326,'delete');
        $query = $this->db->query("SELECT * FROM `tblsubheads` Where head_id = '".$id."' ");
        if($query)
        {
           set_alert('warning', 'This Head exist in Sub Head');
           redirect(admin_url('company_expense/headmaster_view'));
        }
        else
        {
           $response = $this->home_model->delete('tblheads', array('id'=>$id));
        if ($response == true) {
            set_alert('success', 'Head Deleted Successfully');
            redirect(admin_url('company_expense/headmaster_view'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('company_expense/headmaster_view'));
        }
        }
     }



    public function subheadmaster_view() {
        check_permission(327,'view');
        if(!empty($_POST)){
            extract($this->input->post());

            $data['shead_id'] = $head_id;

            $data['subheadmaster_info']  = $this->db->query("SELECT * FROM tblsubheads where head_id = '".$head_id."' order by id desc ")->result();

        }else{
             $data['subheadmaster_info'] = $this->db->query("SELECT * from tblsubheads order by id desc")->result();
        }



        $data['head_info']  = $this->db->query("SELECT * FROM tblheads where status = 1  order by id desc ")->result();
        $data['title'] = 'Sub Head Master';
        $this->load->view('admin/company_expense/subheadmaster_view', $data);
    }

    public function subhead_master($id = '') {

        if ($this->input->post()) {
            extract($this->input->post());
            if ($id == '') {

                $ad_data = array(
                    'head_id' => $head_id,
                    'name' => $name
                );

                $insert = $this->home_model->insert('tblsubheads',$ad_data);
                if ($insert) {
                    set_alert('success', _l('added_successfully', 'Sub Head master'));
                    redirect(admin_url('company_expense/subheadmaster_view'));
                }
            } else {
                $up_data = array(
                    'head_id' => $head_id,
                    'name' => $name
                );

                $update = $this->home_model->update('tblsubheads',$up_data,array('id'=>$id));
                if ($update) {
                    set_alert('success', _l('updated_successfully', 'Sub Head master'));
                }

                redirect(admin_url('company_expense/subheadmaster_view'));
            }
        }

        if ($id == '') {
            check_permission(327,'create');
            $title = 'Add Sub Head';
        } else {
            check_permission(327,'edit');
            $data['subheads_info'] = $this->db->query("SELECT * from tblsubheads WHERE id = '".$id."' ")->row();
            $title = 'Edit Sub Head';
        }

        $data['head_info']  = $this->db->query("SELECT * FROM tblheads where status = 1  order by name asc ")->result();
        $data['title'] = $title;
        $this->load->view('admin/company_expense/subhead_master', $data);
    }

    public function change_subhead_status($id, $status) {
        $this->load->model('home_model');
        if ($this->input->is_ajax_request()) {

            $update_data = array(
                'status' => $status
            );

            $this->home_model->update('tblsubheads',$update_data,array('id'=>$id));
        }
    }

   public function delete_subhead_master($id) {
    check_permission(327,'delete');
        $this->load->model('home_model');

        $response = $this->home_model->delete('tblsubheads', array('id'=>$id));
        if ($response == true) {
            set_alert('success', 'Sub Head Deleted Successfully');
            redirect(admin_url('company_expense/subheadmaster_view'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('company_expense/subheadmaster_view'));
        }

    }

    public function get_head()

    {

        if ($this->input->post()) {

            extract($this->input->post());

            $head_info = $this->db->query("SELECT * FROM `tblheads` where category_id = '".$category_id."' order by name asc")->result();

            $html = '<option value="">--Select One-</option>';

            if(!empty($head_info)){

                foreach ($head_info as $key => $value) {

                    $html .= '<option value="'.$value->id.'">'.cc($value->name).'</option>';

                }

            }



            echo $html;

        }

    }

    public function get_subhead()

    {

        if ($this->input->post()) {

            extract($this->input->post());

            $subhead_info = $this->db->query("SELECT * FROM `tblsubheads` where head_id = '".$head_id."' order by name asc")->result();

            $html = '<option value="">--Select One-</option>';

            if(!empty($subhead_info)){

                foreach ($subhead_info as $key => $value) {

                    $html .= '<option value="'.$value->id.'">'.cc($value->name).'</option>';

                }

            }



            echo $html;

        }

    }

    public function paymentrequest_list() {
        check_permission(329,'view');
    	$where = 'id > 0 ';
    	if(is_admin() != 1){
    		$where .= ' and user_id = "'.get_staff_user_id().'" ';
    	}
        $data['payment_list'] = $this->db->query("SELECT * from tblpaymentrequest where ".$where." order by id desc")->result();
        $data['title'] = 'Payment Request Details';
        $this->load->view('admin/company_expense/paymentrequest_list', $data);
    }


    public function add_paymentrequest($id="")
    {

        if ($this->input->post()) {
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

            $fromdate = '0000-00-00';
            $todate = '0000-00-00';

            if(!empty($from_date) && $from_date != '0000-00-00'){
                $fdate_arr = explode("/",$from_date);
                $fromdate = $fdate_arr[2].'-'.$fdate_arr[1].'-'.$fdate_arr[0];
           }

           if(!empty($to_date) && $to_date != '0000-00-00'){
                $tdate_arr = explode("/",$to_date);
                $todate = $tdate_arr[2].'-'.$tdate_arr[1].'-'.$tdate_arr[0];
           }

			if(!empty($document_id)){
				$document_str = implode(",",$document_id);
			}else{
				$document_str = '';
			}

            if ($id == '') {
                $party_id = (isset($party_id)) ? $party_id : 0;
                $ad_data = array(
                    'user_id'           => get_staff_user_id(),
                    'category_id'       => $category_id,
                    'billing_branch_id' => get_login_branch(),
                    'type'              => $type,
                    'from_date'         => $fromdate,
                    'to_date'           => $todate,
                    'deposit_amount'    => $deposit_amount,
                    'transport_against' => $transport_against,
                    'document_id'       => $document_str,
                    'head_id'           => $head_id,
                    'sub_head_id'       => $sub_head_id,
                    'party_id'          => $party_id,
                    'party_name'        => $party_name,
                    'amount'            => $amount,
                    'tds_amt'           => $tds_amt,
                    'remark'            => $remark,
                    'created_at'        => date('Y-m-d H:i:s')
                );

                $insert = $this->home_model->insert('tblpaymentrequest', $ad_data);
                if($insert == true){

                    $pay_id = $this->db->insert_id();

                    /* this is for upload file on server against to payment request */
                    handle_multi_attachments($pay_id,'payment_request');

                    /* this is for delete reminder record from notification table */
                    if (isset($reminder_id) && !empty($reminder_id)){
                        $this->home_model->delete("tblmasterapproval", array("module_id" => 49, "table_id" => $reminder_id));
                    }
                    if(!empty($staff_id)){
                        foreach ($staff_id as $staffid) {

                            $ad_field = array(
                                'staffid' => $staffid,
                                'payment_id' => $pay_id,
                                'status' => 1,
                                'approve_status' => 0,
                                'created_at' => date('Y-m-d H:i:s')
                            );
                            $this->home_model->insert('tblpaymentrequestapproval',$ad_field);

                            $message = 'Payment Request send you for approval';
                            $adata = array(
                                'staff_id' => $staffid,
                                'fromuserid'      => get_staff_user_id(),
                                'module_id' => 16,
                                'table_id' => $pay_id,
                                'approve_status' => 0,
                                'status' => 0,
                                'description'     => $message,
                                'link' => 'company_expense/paymentrequest_approval/'.$pay_id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tblmasterapproval', $adata);

                            //Sending Mobile Intimation
                            $token = get_staff_token($staffid);
                            $title = 'Schach';
                            $message = 'Payment Request send you for approval';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                        }
                    }

                    set_alert('success', _l('added_successfully', 'Payment Request'));
                    redirect(admin_url('company_expense/paymentrequest_list'));
                }
            }else{
                // echo "<pre>";
                // print_r($_POST);exit;
                $document_str = (!empty($document_id)) ? implode(",",$document_id) : "";

                if ($category_id == 4){
                    $document_str = '';
                    $transport_against = 0;
                    $deposit_amount = 0;
                    $party_name = "";
                }else if ($category_id == 6){
                    $deposit_amount = 0;
                    if ($type == 1){
                        $party_name = "";
                    }
                }else if ($category_id == 5){
                    $deposit_amount = 0;
                    $document_str = '';
                    $transport_against = 0;
                    $party_name = "";
                    $type = 0;
                }else if ($category_id == 3){
                    $document_str = '';
                    $transport_against = 0;
                    $party_name = "";
                    if ($type == 1){
                        $deposit_amount = 0;
                    }else if ($type == 2){
                        $fromdate = "";
                        $todate = "";
                    }
                }
                $party_id = (isset($party_id)) ? $party_id : 0;
                $ad_data = array(
                    'category_id'       => $category_id,
                    'type'              => $type,
                    'from_date'         => $fromdate,
                    'to_date'           => $todate,
                    'deposit_amount'    => $deposit_amount,
                    'transport_against' => $transport_against,
                    'document_id'       => $document_str,
                    'head_id'           => $head_id,
                    'sub_head_id'       => $sub_head_id,
                    'party_id'          => $party_id,
                    'party_name'        => $party_name,
                    'amount'            => $amount,
                    'tds_amt'           => $tds_amt,
                    'remark'            => $remark,
                );

                $update = $this->home_model->update('tblpaymentrequest', $ad_data, array('id' => $id));
                if ($update == true){
                    if(!empty($staff_id)){

                        if (!empty($_FILES['file']['name'][0])){
                            
                            /* this is for upload file on server against to payment request */
                            $files_info = $this->db->query("SELECT * FROM tblfiles WHERE `rel_type`='payment_request' AND `rel_id`=".$id." ")->result();
                            if (!empty($files_info)){
                                foreach ($files_info as $value) {
                                    $path = get_upload_path_by_type('payment_request') . $id . '/'.$value->file_name;
                                    unlink($path);
                                    $this->home_model->delete('tblfiles',array("id" => $value->id));
                                }
                            }
                            handle_multi_attachments($id,'payment_request');
                        }

                        /* this is for delete old record for add new approval */
                        $this->home_model->delete("tblpaymentrequestapproval", array('payment_id' => $id));
                        $this->home_model->delete("tblmasterapproval", array('module_id' => 16, 'table_id' => $id));

                        foreach ($staff_id as $staffid) {

                            $ad_field = array(
                                'staffid' => $staffid,
                                'payment_id' => $id,
                                'status' => 1,
                                'approve_status' => 0,
                                'created_at' => date('Y-m-d H:i:s')
                            );
                            $this->home_model->insert('tblpaymentrequestapproval',$ad_field);

                            $message = 'Payment Request send you for approval';
                            $adata = array(
                                'staff_id' => $staffid,
                                'fromuserid'      => get_staff_user_id(),
                                'module_id' => 16,
                                'table_id' => $id,
                                'approve_status' => 0,
                                'status' => 0,
                                'description'     => $message,
                                'link' => 'company_expense/paymentrequest_approval/'.$id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tblmasterapproval', $adata);

                            //Sending Mobile Intimation
                            $token = get_staff_token($staffid);
                            $title = 'Schach';
                            $message = 'Payment Request send you for approval';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                        }
                    }

                    set_alert('success', 'Payment Request Update Successfully');
                    redirect(admin_url('company_expense/paymentrequest_list'));
                }
            }
        }

    	$data['category_info']  = $this->db->query("SELECT * FROM tblcompanyexpensecatergory where id NOT IN (1,2,7) and status = 1  order by name ASC ")->result();
        if(!empty($id)){
            check_permission(329,'edit');
            $data['payment_info']  = $this->db->query("SELECT * FROM tblpaymentrequest WHERE id = '".$id."'")->row();
            $data['id'] = $id;
            $data['title'] = 'Edit Payment Request';
        }else{
            check_permission(329,'create');
            $data['title'] = 'Add Payment Request';
            if (isset($_GET["reminder_id"])){
                $data['payment_info']  = $this->db->query("SELECT * FROM tblpaymentrequestreminder WHERE id = '".$_GET["reminder_id"]."'")->row();
            }
        }

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
        $data['approved_by'] = $this->db->query("SELECT * FROM `tblpaymentrequestapproval` where payment_id = '".$id."' ")->result_array();

        $this->load->view('admin/company_expense/add_paymentrequest', $data);

    }

    public function get_type()
    {
        if ($this->input->post()) {

            extract($this->input->post());

            if($category_id == 3)
            {
            	$html = '<option value="">--Select One-</option>';
            	$html .= '<option value="1">Rent</option>';
            	$html .= '<option value="2">Deposit</option>';
            	$html .= '<option value="3">Both</option>';
            }
            else if($category_id == 4)
            {
            	$html = '<option value="">--Select One-</option>';
            	$html .= '<option value="1">Recurring</option>';
            	$html .= '<option value="2">Onetime</option>';
            }
            else if($category_id == 6)
            {
            	$html = '<option value="">--Select One-</option>';
            	$html .= '<option value="1">Regular</option>';
            	$html .= '<option value="2">Onetime</option>';
            }
            else
            {
            	$html = $category_id;
            }


            echo $html;

        }

    }

    public function get_party()
    {
        if ($this->input->post()) {
            extract($this->input->post());
            if (isset($head_id) && isset($category_id)){
              $party_info = $this->db->query("SELECT * FROM `tblcompanyexpenseparties` where category_id = '".$category_id."' and head_id = '".$head_id."' order by name asc")->result();
            }else{
              $party_info = $this->db->query("SELECT * FROM `tblcompanyexpenseparties` where category_id = '".$category_id."'")->result();
            }

            $html = '<option value="">--Select One-</option>';
            if(!empty($party_info)){
                foreach ($party_info as $key => $value) {
                    $html .= '<option value="'.$value->id.'">'.cc($value->name).'</option>';
                }
            }
            echo $html;
        }
    }

    public function get_subparty()

    {

        if ($this->input->post()) {

            extract($this->input->post());

            $party_sub_info = $this->db->query("SELECT * FROM `tblcompanyexpenseparties` where category_id = '".$category_id."' and head_id = '".$head_id."' and sub_head_id = '".$subhead_id."' order by name asc")->result();

            $html = '<option value="">--Select One-</option>';

            if(!empty($party_sub_info)){

                foreach ($party_sub_info as $key => $value) {

                    $html .= '<option value="'.$value->id.'">'.cc($value->name).'</option>';

                }

            }



            echo $html;

        }

    }

    public function get_transportagainst()

    {

        if ($this->input->post()) {

            extract($this->input->post());

            if($transport_id == 1)
            {
            	$invoice_info = $this->db->query("SELECT * FROM `tblinvoices` where status != 5 and year_id = '".financial_year()."' ")->result();
               
	            $html = '<option value="">--Select One-</option>';

	            if(!empty($invoice_info)){

	                foreach ($invoice_info as $key => $value) {
                        $client_info = $this->db->query("SELECT `client_branch_name` FROM `tblclientbranch` where userid = '".$value->clientid."' ")->row();
                        $client = $value->number.' '.'('.$client_info->client_branch_name.')';
	                    $html .= '<option value="'.$value->id.'">'.$client.'</option>';

	                }

	            }
            }
            else if($transport_id == 2)
            {
            	$po_info = $this->db->query("SELECT * FROM `tblpurchaseorder` where status = 1 and show_list = 1 and year_id = '".financial_year()."'")->result();

	            $html = '<option value="">--Select One-</option>';

	            if(!empty($po_info)){

	                foreach ($po_info as $key => $value) {
                        $vendor_info = value_by_id('tblvendor',$value->vendor_id,'name');
                        $vendor = 'PO-'.$value->number.' '.'('.$vendor_info.')';
	                    $html .= '<option value="'.$value->id.'">'.$vendor.'</option>';

	                }

	            }
            }
            else
            {
            	$html = '<option value="0">--Select One-</option>';
            }

            echo $html;

        }

    }

    public function paymentrequest_approval($id){

        /*$info = $this->db->query("SELECT * from tblpaymentrequest  where id = '".$id."' and approved_status > 0 ")->row();
	        if(!empty($info)){
	            set_alert('warning', 'Action already taken!');
	             redirect(admin_url('approval/notifications'));
	        }*/

        if(!empty($_POST)){
            extract($this->input->post());

            //Update master approval
            update_masterapproval_single(get_staff_user_id(),16,$id,$submit);
            

            $ad_data = array('approve_status' => $submit,
                            'approvereason' => $remark
                        );
            $this->load->model('home_model');
            $update = $this->home_model->update('tblpaymentrequestapproval', $ad_data,array('payment_id'=>$id,'staffid'=>get_staff_user_id()));
            
            //Getting Reject Info
            $approve_status = 0;
            $reject_info = $this->db->query("SELECT * FROM `tblpaymentrequestapproval` where payment_id='".$id."' and approve_status = 2 ")->row_array();
            if(!empty($reject_info)){
                $approve_status = 2;
                $this->db->query("UPDATE tblpaymentrequest SET approved_status='".$approve_status."' WHERE id='".$id."' ");
            }else{
                $approval_count = $this->db->query("SELECT count(id) as ttl_count  FROM `tblpaymentrequestapproval` where payment_id='".$id."' and approve_status = 1 ")->row()->ttl_count;
                if($approval_count >= 2){
                    $approve_status = 1;
                    $this->db->query("UPDATE tblpaymentrequest SET approved_status='".$approve_status."' WHERE id='".$id."' ");
                }
            }

            $approval_info = $this->db->query("SELECT * FROM `tblpaymentrequestapproval` where payment_id='".$id."' and ( approve_status = 0 || approve_status = 2 || approve_status = 5) ")->row_array();
            if(empty($approval_info)){
                $approve_status = 1;
            	$this->db->query("UPDATE tblpaymentrequest SET approved_status='".$approve_status."' WHERE id='".$id."' ");
            }

            $hold_info = $this->db->query("SELECT * FROM `tblpaymentrequestapproval` where payment_id='".$id."' and approve_status = 5 ")->row_array();
            if(!empty($hold_info)){
                $approve_status = 5;
                $this->db->query("UPDATE tblpaymentrequest SET approved_status='".$approve_status."' WHERE id='".$id."' ");
            }

            update_masterapproval_all(16,$id,$approve_status);

            if($update){
                /* this section use for store TDS Deduction */
                if ($approve_status == 1){
                    $payrequest = $this->db->query("SELECT * from tblpaymentrequest  where id = '".$id."' ")->row();
                    if (!empty($payrequest->tds_amt) && $payrequest->tds_amt > 0){
                        $party_name = $payrequest->party_name;
                        $party_pan_no = '';
                        if ($payrequest->party_id > 0){
                            $party_name = value_by_id("tblcompanyexpenseparties", $payrequest->party_id, "name");
                            $party_pan_no = value_by_id("tblcompanyexpenseparties", $payrequest->party_id, "pan_no");
                        }
                        $tds_data["addedby"] = get_staff_user_id();
                        $tds_data["party_id"] = $payrequest->party_id;
                        $tds_data["party_name"] = $party_name;
                        $tds_data["rel_type"] = 2;
                        $tds_data["rel_id"] = $id;
                        $tds_data["taxable_amount"] = $payrequest->amount;
                        $tds_data["tds_amount"] = $payrequest->tds_amt;
                        $tds_data["pan_no"] = $party_pan_no;
                        $tds_data["date"] = db_date($payrequest->created_at);
                        $tds_data["created_at"] = date("Y-m-d h:i:s");
                        $this->home_model->insert("tbltdsdeduction", $tds_data);
                    }
                }
                 set_alert('success', 'Payment Request taken approval succesfully');
                 redirect(admin_url('approval/notifications'));
            }


        }


        $data["title"] = "Payment Request Details";

        $paymentrequest_info = $this->home_model->get_row("tblpaymentrequest", array("id" => $id), array("*"));

        $data['appvoal_info'] = $this->db->query("SELECT * from tblpaymentrequestapproval where payment_id = '".$id."' and staffid = '".get_staff_user_id()."' and approve_status != 0 ")->row();
        /*echo '<pre/>';
        print_r($data['appvoal_info']);
        die;*/
        $data["id"] = $id;
        $data["paymentrequest_info"] = $paymentrequest_info;
        $this->load->view('admin/company_expense/paymentrequest_approval', $data);
    }

    public function paymentrequest_view($id){


        $data["title"] = "Payment Request Details";

        $paymentrequest_info = $this->home_model->get_row("tblpaymentrequest", array("id" => $id), array("*"));

        $data["id"] = $id;
        $data["paymentrequest_info"] = $paymentrequest_info;
        $this->load->view('admin/company_expense/paymentrequest_view', $data);
    }

    public function get_status() {


        if(!empty($_POST)){
            extract($this->input->post());

            $assign_info = $this->db->query("SELECT * from tblpaymentrequestapproval  where payment_id = '".$id."' ")->result();
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
                                                    }elseif($value->approve_status == 5){
                                                        $status = 'On Hold';
                                                        $color = '#e8bb0b;';
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo get_employee_name($value->staffid); ?></td>
                                                    <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                                    <td><?php echo $value->approvereason; ?></td>
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

    public function delete_paymentrequest($id)
    {

        $response = $this->home_model->delete('tblpaymentrequest', array('id'=>$id));
        if ($response == true) {

            /* this is for upload file on server against to payment request */
            $files_info = $this->db->query("SELECT * FROM tblfiles WHERE `rel_type`='payment_request' AND `rel_id`=".$id." ")->result();
            if (!empty($files_info)){
                foreach ($files_info as $value) {
                    $path = get_upload_path_by_type('payment_request') . $id . '/'.$value->file_name;
                    unlink($path);
                    $this->home_model->delete('tblfiles',array("id" => $value->id));
                }
            }
            
            $this->home_model->delete('tblpaymentrequestapproval',array('payment_id'=>$id));
            $this->home_model->delete('tblmasterapproval',array('module_id'=>16,'table_id'=>$id));
            set_alert('success', 'Payment Request Deleted Successfully');
        } else {
            set_alert('warning', _l('problem_deleting', 'Payment Request'));
        }
        redirect(admin_url('company_expense/paymentrequest_list'));
    }

    /* this function use for daily opening & closing balance */
    public function daily_opening_closing_bal(){
        check_permission(360,'view');
        $data["title"] = "Daily Opening & Closing Balance";
        $data['s_fdate'] = date("d/m/Y");
        if (!empty($_POST)){
            extract($this->input->post());

            if (isset($f_date) && !empty($f_date)){
                $data['s_fdate'] = $f_date;
            }else{
                if (isset($baldata)) {

                    foreach ($baldata as $value) {
                        $bdata["staff_id"] = get_staff_user_id();
                        $bdata["bank_id"] = $value["bank_id"];
                        $bdata["date"] =  db_date($date);
                        $bdata["opening_bal"] = $value["opening_bal"];
                        $bdata["closing_bal"] = $value["closing_bal"];
                        $bdata["status"] = 1;

                        $chk_bal = $this->db->query("SELECT * FROM `tbldailyopeningclosingbalance` WHERE bank_id = " . $value["bank_id"] . " AND date = '" . db_date($date) . "'")->row();
                        if (!empty($chk_bal)) {
                            $this->home_model->update("tbldailyopeningclosingbalance", $bdata, array("id" => $chk_bal->id));
                        } else {
                            $this->home_model->insert("tbldailyopeningclosingbalance", $bdata);
                        }
                    }
                }

                set_alert('success', 'Balance update succesfully');
                redirect(admin_url('company_expense/daily_opening_closing_bal'));
            }
        }

        $data["bank_list"] = $this->db->query("SELECT * FROM `tblbankmaster` WHERE id != 1 AND status = 1")->result();
        $this->load->view('admin/company_expense/opening_closing_bal', $data);
    }

    /* this function use for bank statements */
    public function bank_statement(){
        $data["title"] = "Bank Statements";

        if(!empty($_POST)){
            extract($this->input->post());

            if (!empty($f_date) && !empty($t_date)){
                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = db_date($f_date);
                $t_date = db_date($t_date);
            }

            if (!empty($bank_id)){
                $data["sbank_id"] = $bank_id;
                $bank_name = value_by_id_empty("tblbankmaster", $bank_id, "name");
                $data["title"] = "Bank Statements (".$bank_name.")";
            }

            $data["bank_statement"] = array();
            $chk_fdate = $this->db->query("SELECT `id`,`date`,`opening_bal`,`staff_id` FROM `tbldailyopeningclosingbalance` WHERE bank_id = ".$bank_id." AND date = '".$f_date."' AND opening_bal > '0.00'")->row();
            $chk_tdate = $this->db->query("SELECT `id`,`date`,`closing_bal`,`staff_id` FROM `tbldailyopeningclosingbalance` WHERE bank_id = ".$bank_id." AND date = '".$t_date."' AND closing_bal > '0.00'")->row();
            if (!empty($chk_fdate) && !empty($chk_tdate)){

                $data["opening_bal"] = $chk_fdate->opening_bal;
                $data["closing_bal"] = $chk_tdate->closing_bal;
                $data["opening_added_by"] = $chk_fdate->staff_id;
                $data["closing_added_by"] = $chk_tdate->staff_id;

                $breceiving_list = $this->db->query("SELECT * FROM `tblclientpayment` WHERE `bank_id` = ".$bank_id." AND `date` BETWEEN '".$f_date."' and '".$t_date."' AND `status` = 1 ORDER BY date ASC")->result();
                $bsend_list = $this->db->query("SELECT bp.* FROM `tblbankpayment` as b LEFT JOIN `tblbankpaymentdetails` as bp ON b.id = bp.main_id WHERE bp.`bank_id` = ".$bank_id." AND bp.`utr_date` BETWEEN '".$f_date."' and '".$t_date."' AND b.`status` = 1 ORDER BY bp.`utr_date` ASC")->result();

                if (!empty($breceiving_list)){
                    foreach ($breceiving_list as $rval) {
                        $data["bank_statement"][strtotime($rval->date)][] = array(
                                                            "id" => $rval->id,
                                                            "date" => $rval->date,
                                                            "description" => client_info($rval->client_id)->company,
                                                            "ref" => $rval->reference_no,
                                                            "debit_amt" => 0.00,
                                                            "credit_amt" => $rval->ttl_amt
                                                        );
                    }
                }

                if (!empty($bsend_list)){
                    foreach ($bsend_list as $sval) {

                        $payee_name = $sval->payee_name;
                        $payee_info = '';
                        if($sval->category_id == 1){
                            $payee_info = $this->db->query("SELECT staffid as id,firstname as name FROM `tblstaff` where staffid = '".$sval->payee_id."' ")->row();
                        }elseif($sval->category_id == 2){
                            $payee_info = $this->db->query("SELECT id,name FROM `tblvendor` where id = '".$sval->payee_id."' ")->row();
                        }elseif($sval->category_id == 7){
                            $payee_info = $this->db->query("SELECT userid as id,client_branch_name as name FROM `tblclientbranch` where userid = '".$sval->payee_id."' ")->row();
                        }else{
                            if($sval->payee_id > 0){
                               $payee_info = $this->db->query("SELECT id,name FROM `tblcompanyexpenseparties` where id = '".$sval->payee_id."' ")->row();
                            }
                        }

                        $category_name = value_by_id('tblcompanyexpensecatergory',$sval->category_id,'name');
                        if(!empty($payee_info)){
                            $payee_name = $payee_info->name;
                        }
                        $ref = (!empty($sval->utr_no)) ? $sval->utr_no : $sval->first_remark;
                        $data["bank_statement"][strtotime($sval->utr_date)][] = array(
                                                            "id" => $sval->id,
                                                            "date" => $sval->utr_date,
                                                            "description" => $payee_name." (".$category_name.")",
                                                            "ref" => $ref,
                                                            "debit_amt" => $sval->amount,
                                                            "credit_amt" => 0.00
                                                        );
                    }
                }
                ksort($data["bank_statement"]);
            }else{
                set_alert('warning', 'Record not found beetween date');
                redirect(admin_url('company_expense/bank_statement'));
            }
        }

        $data["bank_list"] = $this->db->query("SELECT * FROM `tblbankmaster` WHERE id != 1 AND status = 1")->result();
        $this->load->view('admin/company_expense/bank_statements', $data);
    }

    /* this function use for make master of cheque */
    public function cheque_book(){
        check_permission(382,'view');
        $where = "status IN (1,0) ";
        if(!empty($_POST)){
            extract($this->input->post());

            if (!empty($f_date) && !empty($t_date)){
                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = db_date($f_date);
                $t_date = db_date($t_date);
                $where .= " AND created_at BETWEEN '".$f_date."' and '".$t_date."' ";
            }

            if (!empty($bank_id)){
                $data["bank_id"] = $bank_id;
                $where .= " AND bank_id = '".$bank_id."'";
            }
        }
        $data['cheque_book_list']  = $this->db->query("SELECT * FROM tblchequebook WHERE ".$where." ORDER BY id DESC")->result();
        $data["bank_list"] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = 1 AND id !=1 ")->result();
        $data['title'] = 'Cheque Book List';
        $this->load->view('admin/company_expense/cheque_book_list', $data);
    }

    /* this function use for add cheque book */
    public function addchequebook($id = ''){
        
        $data['title'] = 'Add Cheque Book';
        if(!empty($_POST)){
            extract($this->input->post());

            $ad_data = array(
                            'bank_id' => $bank_id,
                            'chequebook_name' => $chequebook_name,
                            'from_page' => $from_page,
                            'to_page' => $to_page,
                            'description' => $description,
                            'status' => 1,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s"),
                        );
            if ($id != ''){
                unset($ad_data["created_at"]);
                $update = $this->home_model->update('tblchequebook', $ad_data,array('id'=>$id));
                if($update){
                    set_alert('success', 'Cheque Book Updated Successfully');
                    redirect(admin_url('company_expense/cheque_book'));
                }
            }else{
                $insert = $this->home_model->insert('tblchequebook', $ad_data);
                if($insert){
                    set_alert('success', 'Cheque Book Added Successfully');
                    redirect(admin_url('company_expense/cheque_book'));
                }
            }
        }

        if(!empty($id)){
            check_permission(382,'edit');
            $data['cheque_book_info']  = $this->db->query("SELECT * FROM tblchequebook WHERE id = '".$id."'")->row();
            $data['id'] = $id;
            $data['title'] = 'Edit Cheque Book';
        }else{
            check_permission(382,'create');
            $data['title'] = 'Add Cheque Book';
        }

        $data["bank_list"] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = 1 AND id !=1 order by name asc ")->result();
        $this->load->view('admin/company_expense/addchequebook', $data);
    }

    public function deletechequebook($id)
    {   
        check_permission(382,'delete');
        $query = $this->db->query("SELECT * FROM `tblbankpaymentdetails` Where cheque_id = '".$id."' ")->row();
        if($query)
        {
           set_alert('warning', "Can't be deleted! This is used somewhere.");
           redirect(admin_url('company_expense/cheque_book'));
        }

        $response = $this->home_model->delete('tblchequebook', array('id'=>$id));
        if ($response == true) {
            set_alert('success', 'Cheque Book Deleted Successfully');
        } else {
            set_alert('warning', _l('problem_deleting', 'chequebook'));
        }
        redirect(admin_url('company_expense/cheque_book'));
    }

    public function getchequebookreport($id){

        $data['payment_info'] = $this->db->query("SELECT * FROM tblbankpaymentdetails WHERE cheque_id=".$id." ")->result();
        $data['title'] = 'Cheque Book Reports';
        $this->load->view('admin/company_expense/chequebookreport', $data);
    }

    public function change_chequebook_status($id, $status){
        $this->load->model('Home_model');
        if ($this->input->is_ajax_request()) {

            $unit_data = array(
                'status' => $status
            );
            $this->Home_model->update("tblchequebook", $unit_data, array("id" => $id));
        }
    }

    public function expense_vendor_ledger($category_id = 0, $party_id = 0){
        check_permission(403,'view');

        $where = "r.payfile_done = '1' and pd.utr_no != '' ";
        if ($category_id > 0 && $party_id > 0){

            $year_id = financial_year();
            $from_date = value_by_id_empty("tblfinancialyear", $year_id, "from_date");
            $to_date = value_by_id_empty("tblfinancialyear", $year_id, "to_date");

            $data["party_id"] = $party_id;
            $data["category_id"] = $category_id;
            $data['s_fdate'] = $from_date;
            $data['s_tdate'] = $to_date;
            $where .= " and r.party_id = '".$party_id."' and r.category_id = '".$category_id."' and pd.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."'";
            $data["party_list"] = $this->db->query("SELECT * FROM `tblcompanyexpenseparties` WHERE `id`= '".$party_id."' ")->result();
            $data['expense_info'] = $this->db->query("SELECT r.*, pd.date, pd.amount, pd.method, pd.payee_name, pd.utr_no from tblpaymentrequest as r RIGHT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'pay_request' where ".$where." order by r.id desc")->result();
        }

        if(!empty($_POST)){
            extract($this->input->post());

              if (!empty($from_date) && !empty($to_date)){
                  $data['s_fdate'] = $from_date;
                  $data['s_tdate'] = $to_date;
                  $where .= " and pd.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."' ";
              }else{
                  $where .= " and MONTH(pd.date) ='".date('m')."' and YEAR(pd.date) ='".date('Y')."' ";
              }
              if (!empty($party_id)){
                  $data["party_id"] = $party_id;
                  $where .= " and r.party_id = '".$party_id."'";
                  $data["party_list"] = $this->db->query("SELECT * FROM `tblcompanyexpenseparties` WHERE `id`= '".$party_id."' ")->result();
              }
              if (!empty($category_id)){
                  $data["category_id"] = $category_id;
                  $where .= " and r.category_id = '".$category_id."'";
              }
              $data['expense_info'] = $this->db->query("SELECT r.*, pd.date, pd.amount, pd.method, pd.payee_name, pd.utr_no from tblpaymentrequest as r RIGHT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'pay_request' where ".$where." order by r.id desc")->result();
        }
        // else{
        //     $where .= " and MONTH(pd.date) ='".date('m')."' and YEAR(pd.date) ='".date('Y')."' ";
        // }
        
        $data['category_info']  = $this->db->query("SELECT * FROM tblcompanyexpensecatergory where id NOT IN (1,2,7) and status = 1  order by id desc ")->result();
        $data['title'] = 'Expense Vendor Ledger';
        $this->load->view('admin/company_expense/expense_vendor_ledger', $data);
    }

    public function expense_vendor_details($payment_id){
        check_permission(403,'view');
        $select_fileds = "r.*, pd.date, pd.amount, pd.method, pd.bank_id, pd.category_id, pd.ifsc, pd.account, pd.method, pd.type as btype, pd.amount, pd.first_remark
        , pd.deposit, pd.utr_no, pd.utr_date, pd.cheque_id, pd.cheque_no, pd.payee_name";
        $expense_info = $this->db->query("SELECT $select_fileds from tblpaymentrequest as r RIGHT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'pay_request' where r.id='".$payment_id."' order by r.id desc")->row();
        if (!empty($expense_info)){
    ?>
    <div class="row">
        <div class="col-md-12">
           <div class="col-md-6">
              <label for="bank" class="text-info">Party Name : </label>
              <h4 style="color:red"><?php
                  if ($expense_info->type == 2 && $expense_info->category_id == 6) {
                      $party_name = $expense_info->party_name;
                  } else {
                      $party_name = value_by_id('tblcompanyexpenseparties', $expense_info->party_id, 'name');
                  }
                  echo $party_name = (empty($party_name)) ? $expense_info->payee_name : $party_name;;
              ?></h4>
           </div>
           <div class="col-md-6">
              <label for="bank" class="text-info"> Date : </label>
              <h4 style="color:red"><?php echo _d($expense_info->date); ?></h4 >
           </div>
        </div>
        <div class="col-md-12">
            <div >
                <hr>
                <h4>Payment Details</h4>
                <hr>
                <div class="col-md-3">
                    <label for="bank" class="text-info">Bank</label>
                    <div class="form-group">
                        <span><?php echo ($expense_info->bank_id > 0) ? value_by_id('tblbankmaster', $expense_info->bank_id, 'name') : 'CASH'; ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="category" class="text-info">Category</label>
                    <div class="form-group">
                        <span><?php echo value_by_id('tblcompanyexpensecatergory', $expense_info->category_id, 'name'); ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="ifsc" class="text-info">IFSC</label>
                    <div class="form-group">
                        <span><?php echo (!empty($expense_info->ifsc)) ? $expense_info->ifsc : "--"; ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="account" class="text-info">Account</label>
                    <div class="form-group">
                        <span><?php echo (!empty($expense_info->account)) ? $expense_info->account : "--"; ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="method" class="text-info">Method</label>
                    <div class="form-group">
                        <span><?php echo (!empty($expense_info->method)) ? $expense_info->method : "--"; ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="type" class="text-info">Type</label>
                    <div class="form-group">
                        <span><?php echo (!empty($expense_info->btype)) ? $expense_info->btype : "--"; ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="amount" class="text-info">Amount</label>
                    <div class="form-group">
                        <span><?php echo (!empty($expense_info->amount)) ? $expense_info->amount : "--"; ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="remark" class="text-info">Remark</label>
                    <div class="form-group">
                        <span><?php echo (!empty($expense_info->first_remark)) ? $expense_info->first_remark : "--"; ?></span>
                    </div>
                </div>
                <?php if ($expense_info->deposit > 0){ ?>
                  <div class="col-md-3">
                      <label for="deposit" class="text-info">Deposit</label>
                      <div class="form-group">
                          <span><?php echo $expense_info->deposit; ?></span>
                      </div>
                  </div>
                <?php } ?>
                <div class="col-md-3">
                    <label for="remark" class="text-info">UTR NO.</label>
                    <div class="form-group">
                        <span><?php echo (!empty($expense_info->utr_no)) ? $expense_info->utr_no : "--"; ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="remark" class="text-info">UTR Date.</label>
                    <div class="form-group">
                        <span><?php echo (!empty($expense_info->utr_date)) ? _d($expense_info->utr_date) : "--"; ?></span>
                    </div>
                </div>
                <?php if ($expense_info->cheque_id > 0){ ?>
                  <div class="col-md-3">
                      <label for="deposit" class="text-info">Cheque Book</label>
                      <div class="form-group">
                          <span><?php echo value_by_id('tblchequebook', $expense_info->cheque_id, 'chequebook_name'); ?></span>
                      </div>
                  </div>
                <?php } ?>
                <?php if ($expense_info->cheque_no > 0){ ?>
                  <div class="col-md-3">
                      <label for="deposit" class="text-info">Cheque No</label>
                      <div class="form-group">
                          <span><?php echo $expense_info->cheque_no; ?></span>
                      </div>
                  </div>
                <?php } ?>
            </div>

        </div>
        <div class="col-md-12">
          <div >
              <hr>
              <h4>Payment Request</h4>
              <hr>
              <div class="col-md-3">
                  <label for="category" class="text-info">Category</label>
                  <div class="form-group">
                      <span><?php echo value_by_id('tblcompanyexpensecatergory', $expense_info->category_id, 'name'); ?></span>
                  </div>
              </div>
              <div class="col-md-3">
                  <label for="head" class="text-info">Head</label>
                  <div class="form-group">
                      <span><?php echo value_by_id('tblheads', $expense_info->head_id, 'name'); ?></span>
                  </div>
              </div>
              <div class="col-md-3">
                  <label for="sub head" class="text-info">Sub Head</label>
                  <div class="form-group">
                      <span><?php echo value_by_id('tblsubheads', $expense_info->sub_head_id, 'name'); ?></span>
                  </div>
              </div>
              <div class="col-md-3">
                  <label for="billing branch" class="text-info">Billing Branch</label>
                  <div class="form-group">
                      <span><?php echo value_by_id('tblcompanybranch', $expense_info->billing_branch_id, 'comp_branch_name'); ?></span>
                  </div>
              </div>
              <div class="col-md-3">
                  <label for="amount" class="text-info">Amount</label>
                  <div class="form-group">
                      <span><?php echo $expense_info->amount; ?></span>
                  </div>
              </div>
              <div class="col-md-3">
                  <label for="tds amount" class="text-info">TDS Amount</label>
                  <div class="form-group">
                      <span><?php echo $expense_info->tds_amt; ?></span>
                  </div>
              </div>
              <div class="col-md-3">
                  <label for="remark" class="text-info">Remark</label>
                  <div class="form-group">
                      <span><?php echo $expense_info->remark; ?></span>
                  </div>
              </div>
              <div class="col-md-3">
                  <label for="type" class="text-info">Type</label>
                  <div class="form-group">
                      <span><?php
                          if ($expense_info->category_id == 3){
                              if ($expense_info->type == 1){
                                  echo 'Rent';
                              }else if($expense_info->type == 2){
                                  echo 'Deposit';
                              }else{
                                 echo 'Rent & Deposit';
                              }
                          }else if($expense_info->category_id == 4){
                              echo ($expense_info->type == 1) ? 'Recurring' : 'Onetime';
                          }else if($expense_info->category_id == 6){
                              echo ($expense_info->type == 1) ? 'Regular' : 'Onetime';
                          }
                      ?></span>
                  </div>
              </div>
              <?php if ($expense_info->from_date != '0000-00-00'){ ?>
                  <div class="col-md-3">
                      <label for="from_date" class="text-info">From Date</label>
                      <div class="form-group">
                          <span><?php echo _d($expense_info->from_date); ?></span>
                      </div>
                  </div>
              <?php } ?>
              <?php if ($expense_info->to_date != '0000-00-00'){ ?>
                  <div class="col-md-3">
                      <label for="from_date" class="text-info">To Date</label>
                      <div class="form-group">
                          <span><?php echo _d($expense_info->to_date); ?></span>
                      </div>
                  </div>
              <?php } ?>
              <?php if ($expense_info->deposit_amount > 0){ ?>
                  <div class="col-md-3">
                      <label for="from_date" class="text-info">Deposit Amount</label>
                      <div class="form-group">
                          <span><?php echo $expense_info->deposit_amount; ?></span>
                      </div>
                  </div>
              <?php } ?>
              <?php if ($expense_info->transport_against > 0){ ?>
                  <div class="col-md-3">
                      <label for="from_date" class="text-info">Transport Against</label>
                      <div class="form-group">
                          <span><?php echo $expense_info->transport_against; ?></span>
                      </div>
                  </div>
              <?php } ?>
          </div>
        </div>
    </div>
    <?php
        }
    }

    /* this function use for payment request reminder list */
    public function paymentrequestreminder_list() {
        check_permission(407,'view');

    	$where = 'id > 0 ';
    	if(is_admin() != 1){
    		$where .= ' and user_id = "'.get_staff_user_id().'" ';
    	}
        $data['paymentreminder_list'] = $this->db->query("SELECT * FROM tblpaymentrequestreminder WHERE ".$where." order by id desc")->result();
        $data['title'] = 'Payment Request Reminder List';
        $this->load->view('admin/company_expense/paymentrequestreminder_list', $data);
    }

    /* this function use for add payment request reminder */
    public function add_paymentrequestreminder($id="")
    {
        
        if ($this->input->post()) {
            extract($this->input->post());

            $document_str = (!empty($document_id)) ? implode(",",$document_id) : "";
            $reminderids_str = (!empty($reminder_send_to)) ? implode(",",$reminder_send_to) : "";

            if ($category_id == 4){
                $document_str = '';
                $transport_against = 0;
                $deposit_amount = 0;
                $party_name = "";
            }else if ($category_id == 6){
                $deposit_amount = 0;
                if ($type == 1){
                    $party_name = "";
                }
            }else if ($category_id == 5){
                $deposit_amount = 0;
                $document_str = '';
                $transport_against = 0;
                $party_name = "";
                $type = 0;
            }else if ($category_id == 3){
                $document_str = '';
                $transport_against = 0;
                $party_name = "";
                if ($type == 1){
                    $deposit_amount = 0;
                }
            }

            $ad_data = array(
                'category_id'       => $category_id,
                'type'              => $type,
                'deposit_amount'    => $deposit_amount,
                'transport_against' => $transport_against,
                'document_id'       => $document_str,
                'head_id'           => $head_id,
                'sub_head_id'       => $sub_head_id,
                'party_id'          => $party_id,
                'party_name'        => $party_name,
                'amount'            => $amount,
                'tds_amt'           => $tds_amt,
                'reminderdays'      => $reminderdays,
                'reminder_send_to'  => $reminderids_str
            );
            
            if ($id == '') {
                $ad_data['user_id'] = get_staff_user_id();
                $ad_data['billing_branch_id'] = get_login_branch();
                $ad_data['created_at'] = date('Y-m-d H:i:s');
                
                $insert = $this->home_model->insert('tblpaymentrequestreminder', $ad_data);
                if($insert == true){
                    set_alert('success', _l('added_successfully', 'Payment Request Reminder'));
                    redirect(admin_url('company_expense/paymentrequestreminder_list'));
                }
            }else{
                $update = $this->home_model->update('tblpaymentrequestreminder', $ad_data, array('id' => $id));
                if($update == true){
                    set_alert('success', 'Payment Request Reminder Update Successfully');
                    redirect(admin_url('company_expense/paymentrequestreminder_list'));
                }
            }
        }

    	$data['category_info']  = $this->db->query("SELECT * FROM tblcompanyexpensecatergory where id NOT IN (1,2,7) and status = 1  order by name ASC ")->result();
        if(!empty($id)){
            check_permission(407,'edit');
            $data['payment_info']  = $this->db->query("SELECT * FROM tblpaymentrequestreminder WHERE id = '".$id."'")->row();
            $data['id'] = $id;
            $data['title'] = 'Edit Payment Request Reminder';
        }else{
            check_permission(407,'create');
            $data['title'] = 'Add Payment Request Reminder';
        }
        $data["staff_list"] = $this->db->query("SELECT `staffid`,`firstname` FROM `tblstaff` WHERE `active`=1 ORDER BY firstname ASC")->result();
        $this->load->view('admin/company_expense/add_paymentrequestreminder', $data);
    }

    /* this is use for update payment request reminder status */
    public function change_paymentreminder_status($id, $status){
        $this->load->model('Home_model');
        if ($this->input->is_ajax_request()) {

            $unit_data = array(
                'status' => $status
            );
            $this->Home_model->update("tblpaymentrequestreminder", $unit_data, array("id" => $id));
        }
    }

    /* this is use for delete payment request reminder */
    public function delete_paymentrequestreminder($id)
    {
        check_permission(407,'delete');
        $response = $this->home_model->delete('tblpaymentrequestreminder', array('id'=>$id));
        if ($response == true) {
            set_alert('success', 'Payment Request Reminder Deleted Successfully');
        } else {
            set_alert('warning', _l('problem_deleting', 'Payment Request Reminder'));
        }
        redirect(admin_url('company_expense/paymentrequestreminder_list'));
    }

    public function paymentrequestreminder_view($id){
        check_permission(407,'view');
        $data["title"] = "Payment Request Reminder Details";
        $paymentrequest_info = $this->home_model->get_row("tblpaymentrequestreminder", array("id" => $id), array("*"));

        $data["id"] = $id;
        $data["paymentrequest_info"] = $paymentrequest_info;
        $this->load->view('admin/company_expense/paymentrequestreminder_view', $data);
    }

    
    /* this function use for Transport Overhead Added */
    public function transport_overhead_list() {
        
        $where = " id > 0";
        if (!empty($_POST)) {
            extract($this->input->post());
            
            if (!empty($f_date) && !empty($t_date)) {

                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and date  BETWEEN  '" . db_date($f_date) . "' and  '" . db_date($t_date) . "' ";
            }
        }

        $data['overhead_list'] = $this->db->query("SELECT * from tbltransportoverhead where  " . $where . " order by id desc ")->result();

        $data['title'] = 'Transport Overhead List';
        $this->load->view('admin/transport_overhead/list', $data);
    }

    /* this function uas for transport overhead add */
    public function transport_overhead_add($id = ''){

        if(!empty($_POST)){
            extract($this->input->post());
            
            $remark = (!empty($remark)) ? $remark : '';
            $insert_data["head"] = $head;
            $insert_data["amount"] = $amount;
            $insert_data["date"] = db_date($date);
            $insert_data["remark"] = $remark;
            
            if ($id !=''){
                
                $insert_id = $this->home_model->update("tbltransportoverhead", $insert_data, array("id" => $id));
                if ($insert_id){
                    set_alert("success", "Transport Overhead update successfully");
                }else{
                    set_alert("danger", "Something went wroung.");
                }
            }else{
                $insert_data["added_by"] = get_staff_user_id();
                $insert_data["created_at"] = date("Y-m-d H:i:s");
                
                $insert_id = $this->home_model->insert("tbltransportoverhead", $insert_data);
                if ($insert_id){
                    set_alert("success", "Transport Overhead Add successfully");
                }else{
                    set_alert("danger", "Something went wroung.");
                }
            }
            
            redirect(admin_url('company_expense/transport_overhead_list'));
        }

        $data['title'] = 'Add Transport Overhead';
        if ($id != ''){
            $data['title'] = 'Edit Transport Overhead';
            $data["overhead_info"] = $this->db->query("SELECT * FROM tbltransportoverhead WHERE id =".$id."")->row();
        }
        
        $this->load->view('admin/transport_overhead/add', $data);
    }

    /* this is function use for delete transport overhead */
    public function transport_overhead_delete($id){
        $response = $this->home_model->delete('tbltransportoverhead', array('id'=>$id));
        if ($response == true) {
            set_alert('success', 'Transport Overhead Deleted Successfully');
        } else {
            set_alert("danger", "Something went wroung.");
        }
        redirect(admin_url('company_expense/transport_overhead_list'));
    }
}
