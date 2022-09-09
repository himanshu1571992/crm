<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Follow_up extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    /*public function index()
    {

        check_permission(79,'view');

        $this->load->model('follow_up_model');

        if ($this->input->is_ajax_request()) {
            echo json_encode($this->follow_up_model->get_todo_items($this->input->post('finished'), $this->input->post('todo_page')));
            exit;
        }

        //deleteing last lead records
        $this->db->query("DELETE FROM tblpaymentfollowupclients where date < '".date('Y-m-d')."' ");

        $clients_info = get_staff_clients(get_staff_user_id());
        if(!empty($clients_info)){
        	foreach ($clients_info as $client_id){
		        		$exist_info = $this->db->query("SELECT `id` FROM `tblpaymentfollowupclients` where client_id = '".$client_id."' and staffid = '".get_staff_user_id()."' and date = '".date('Y-m-d')."' ")->row();
		        		if(empty($exist_info)){
                            $client_info = $this->db->query("SELECT `client_status` FROM `tblclientbranch` where userid = '".$client_id."'  ")->row();
		        			 $ad_data = array(
		                                'client_id' => $client_id,
		                                'staffid' => get_staff_user_id(),
		                                'date' => date('Y-m-d'),
		                                'finished' => 0,
                                        'status' => $client_info->client_status,
		                            );

		                 	$this->home_model->insert('tblpaymentfollowupclients',$ad_data);
		        		}
		        }
        }

        $data['bodyclass']            = 'main-todo-page';
        $data['total_pages_finished'] = ceil(total_rows('tblpaymentfollowupclients', [
            'finished' => 1,
            'staffid'  => get_staff_user_id(),
            'date'  => date('Y-m-d'),
        ]) / $this->follow_up_model->getTodosLimit());
        $data['total_pages_unfinished'] = ceil(total_rows('tblpaymentfollowupclients', [
            'finished' => 0,
            'staffid'  => get_staff_user_id(),
            'date'  => date('Y-m-d'),
        ]) / $this->follow_up_model->getTodosLimit());
        $data['title'] = 'My Payment Follow Up';

        $this->load->view('admin/follow_up/follow_up', $data);
    }*/

    public function index()
    {
        check_permission(145,'view');


        //deleteing last lead records
        $this->db->query("DELETE FROM tblpaymentfollowupclients where date < '".date('Y-m-d')."' ");

        if(is_admin() == 0){
            $clients_info = get_staff_clients(get_staff_user_id());
        }else{
            $clients_info = array();
            $clients_data = $this->db->query("SELECT `userid` FROM `tblclientbranch` where active = '1' and followup = '1' ")->result();
            if(!empty($clients_data)){
                foreach ($clients_data as $value) {
                    $clients_info[] = $value->userid;
                }
            }
        }

        if(!empty($clients_info)){
            foreach ($clients_info as $client_id){
                        $exist_info = $this->db->query("SELECT `id` FROM `tblpaymentfollowupclients` where client_id = '".$client_id."' and staffid = '".get_staff_user_id()."' and date = '".date('Y-m-d')."' ")->row();
                        if(empty($exist_info)){
                            $client_info = $this->db->query("SELECT `client_status`,`other_collection` FROM `tblclientbranch` where userid = '".$client_id."'  ")->row();

                            if($client_info->other_collection == 0){
                                $ad_data = array(
                                        'client_id' => $client_id,
                                        'staffid' => get_staff_user_id(),
                                        'date' => date('Y-m-d'),
                                        'finished' => 0,
                                        'status' => $client_info->client_status,
                                    );

                                $this->home_model->insert('tblpaymentfollowupclients',$ad_data);
                            }


                        }
                }
        }



        $where = " staffid = '".get_staff_user_id()."' and date = '".date('Y-m-d')."' ";

        if(!empty($_POST)){
            extract($this->input->post());

            if(isset($finished) && $finished != ''){
                $data['s_finished'] = $finished;
                $where .= " and finished = '".$finished."'";
            }
            if(isset($status) && $status != ''){
                $data['s_status'] = $status;
                $status_str = implode(',', $status);
                $where .= " and status IN (".$status_str.")";
            }
            if(!empty($client_branch)){
                $data['client_id'] = $client_id;
                $data['s_client_branch'] = $client_branch;

                $client_str = implode(',', $client_branch);
                $where .= " and client_id IN (".$client_str.") ";

            }

            if(!empty($employee_id)){
                $data['employee_id'] = $employee_id;
                $employee_clients_info = get_staff_clients($employee_id);
                $employee_cliets_str = 0;
                if(!empty($employee_clients_info)){
                    foreach ($employee_clients_info as $c_id) {
                        $employee_cliets_str .= ','.$c_id;
                    }
                }
                $where .= " and client_id IN (".$employee_cliets_str.") ";

            }


            if(!empty($group_id)){
                $data['group_id'] = $group_id;

                $group_client_info = $this->db->query("SELECT `userid` FROM `tblclientbranch` where `active`='1' and FIND_IN_SET('".$group_id."', staff_group)")->result();

                $group_cliets_str = 0;
                if(!empty($group_client_info)){
                    foreach ($group_client_info as $row) {
                        $group_cliets_str .= ','.$row->userid;
                    }
                }
                $where .= " and client_id IN (".$group_cliets_str.") ";

            }
        }



        if(financial_year() == 1){
            $where_invoice = "service_type = 1 and renewal = 0 and rental_status  = 0 and duedate >= '".date('Y-m-d')."' and year_id = '".financial_year()."' ";
        }else{
            $where_invoice = "service_type = 1 and renewal = 0 and rental_status  = 0 and year_id = '".financial_year()."' ";
        }

        $client_ids = 0;
        $invoice_client = $this->db->query("SELECT clientid from `tblinvoices` where ".$where_invoice." group by clientid")->result();
        if(!empty($invoice_client)){
            foreach ($invoice_client as $key => $value) {
                if($key == 0){
                    $client_ids = $value->clientid;
                }else{
                    $client_ids .= ','.$value->clientid;
                }
            }
        }

        $sales_client_ids = 0;
        $sales_invoice = $this->db->query("SELECT clientid from `tblinvoices` where service_type = 2 and status != '5' group by clientid")->result();
        if(!empty($sales_invoice)){
            foreach ($sales_invoice as $key => $value) {
                if($key == 0){
                    $sales_client_ids = $value->clientid;
                }else{
                    $sales_client_ids .= ','.$value->clientid;
                }
            }
        }
        $data['client_ids'] = $client_ids;
        $data['sales_client_ids'] = $sales_client_ids;

        $data['followup_info'] = $this->db->query("SELECT * from tblpaymentfollowupclients where  ".$where." order by finished asc ")->result();
        $data['status_info'] = $this->db->query("SELECT * from tblclientstatus where  status = 1 ORDER BY name ASC")->result();
        $data['client_data'] = $this->db->query('SELECT * FROM tblclientbranch WHERE active = 1 and followup = 1 ORDER BY client_branch_name ASC')->result();
        $data['group_data'] = $this->db->query("SELECT * FROM `tblstaffgroup` where `status`='1' and FIND_IN_SET(17, multiselect_id)")->result();
        $data['employee_data'] = $this->db->query('SELECT * FROM tblstaff WHERE active = 1 ORDER BY firstname ASC ')->result();
        $data['client_info'] = $this->db->query("SELECT * FROM tblclients ORDER BY company ASC")->result();


        $data['title'] = 'Payment Followup List';
        $this->load->view('admin/follow_up/follow_up', $data);
    }

    /*public function allotted_group()
    {
        check_permission(147,'view');
        $data['title'] = 'Alloted Groups';
        $this->load->view('admin/follow_up/allotted_group', $data);
    }*/

    //By Safiya
    public function allotted_group()
    {
        check_permission(147,'view');
        $data['title'] = 'Alloted Groups';
        $data['alloted_group_info'] = $this->db->query("SELECT * FROM tblclientbranch  where staff_group != '' and followup = 1 ")->result();
        $this->load->view('admin/follow_up/allotted_group', $data);
    }

    public function allotted_table(){

        $this->app->get_table_data('client_group');

    }


    /*public function not_allotted()
    {
        $data['title'] = 'Not Alloted Clients';
        $this->load->view('admin/follow_up/not_allotted', $data);
    }*/

    //By Safiya
    public function not_allotted()
    {
        $data['title'] = 'Not Alloted Clients';
        $data['not_alloted_info'] = $this->db->query("SELECT * FROM tblclientbranch  where staff_group = '' and followup = 1 ")->result();
        $this->load->view('admin/follow_up/not_allotted', $data);
    }

    public function not_allotted_table(){

        $this->app->get_table_data('client_notallotted');

    }


    public function allot_group($id = '')
    {
       check_permission(147,'create');
        if ($this->input->post()) {
            extract($this->input->post());

            $staff_string = implode(',', $staff_group);

            if ($this->home_model->update('tblclientbranch',array('staff_group'=>$staff_string),array('userid'=>$userid))) {

                set_alert('success', 'Group alloted successfully');
                redirect(admin_url('follow_up/allotted_group/'));
            }

        }

        if(!empty($id)){
             $data['client']  = $this->db->query("SELECT * FROM tblclientbranch WHERE userid = '".$id."'")->row_array();
             if (!$data['client']) {
                blank_page('Client Not Found', 'danger');
            }
        }


        $data['client_info'] = $this->db->query('SELECT * FROM tblclientbranch WHERE active = 1 and followup = 1 order by client_branch_name asc')->result_array();
        $data['group_info'] = $this->db->query('SELECT * FROM tblstaffgroup WHERE status = 1 and FIND_IN_SET(17, multiselect_id) order by name asc ')->result_array();

        $data['title'] = 'Staff Group Allotment';
        $this->load->view('admin/follow_up/allot_group', $data);
    }


    public function suggestion()
    {
       check_permission('151,277','view');
        $data['title'] = 'Suggestion List';
        $this->load->view('admin/follow_up/suggestion', $data);
    }

    public function suggestion_table(){

        $this->app->get_table_data('suggestion');

    }


    public function suggestion_add($id = '')
    {
       check_permission('151,277','create');
        if ($this->input->post()) {
            extract($this->input->post());

            if($id == ''){
                $ad_data = array(
                                'suggestion' => $suggestion,
                                'status' => $status,
                                'created_at' => date('Y-m-d H:i:s'),
                            );

                 if ($this->home_model->insert('tblsuggestion',$ad_data)) {

                    set_alert('success', 'Suggestion added successfully');
                    redirect(admin_url('follow_up/suggestion/'));
                }
            }else{
                check_permission('151,277','edit');
                $ad_data = array(
                                'suggestion' => $suggestion,
                                'status' => $status
                            );

                 if ($this->home_model->update('tblsuggestion',$ad_data,array('id'=>$id))) {

                    set_alert('success', 'Suggestion udpated successfully');
                    redirect(admin_url('follow_up/suggestion/'));
                }
            }



        }

        if(!empty($id)){
            $data['title'] = 'Edit Suggestion';

             $data['suggestion']  = $this->db->query("SELECT * FROM tblsuggestion WHERE id = '".$id."'")->row_array();
             if (!$data['suggestion']) {
                blank_page('Suggestion Not Found', 'danger');
            }
        }else{
            $data['title'] = 'Add New Suggestion';
        }

        $this->load->view('admin/follow_up/suggestion_add', $data);
    }

    public function change_suggestion_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $this->home_model->update('tblsuggestion',array('status'=>$status),array('id'=>$id));
        }
    }

    public function delete_suggestion($id) {
        check_permission('151,277','delete');
        $success = $this->home_model->delete('tblsuggestion',array('id'=>$id));
        if ($success) {
            set_alert('success', _l('deleted', 'suggestion'));
            redirect(admin_url('follow_up/suggestion'));
        }
    }

    public function client_activity($client_id = '')
    {
        if(!empty($client_id)){
            //$number_list = $this->db->query("SELECT c.phonenumber from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$client_id."' ")->result();
            $number_list = $this->db->query("SELECT phonenumber from tblcontacts  where userid = '".$client_id."' ")->result();

            $numbers = '';
            if(!empty($number_list)){
                $i = 0;
                foreach ($number_list as $no) {
                    if($i == 0){
                        $numbers .= $no->phonenumber;
                    }else{
                        $numbers .= ','.$no->phonenumber;
                    }
                    $i++;
                }
            }

            if(!empty($numbers)){
                $data['numbers'] = $numbers;
                /*$where = "customer_number IN (".$numbers.")";
                $data['call_history'] = $this->db->query("SELECT * from tblcalloutgoing where ".$where." order by id desc ")->result();*/
            }
        }

        if(!empty($_POST)){
            extract($this->input->post());

           /* this is for check notification update */
            $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$client_id."' and staff_id = '".get_staff_user_id()."' and module_id = 31")->result();
            if (!empty($chk_notification)){
                foreach ($chk_notification as $value) {
                    $this->home_model->update("tblmasterapproval", array("status" => 1), array("id" => $value->id));
                }
            }

            if(!empty($important_search)){
                 $data['activity_log'] = $this->db->query("SELECT * FROM `tblfollowupclientactivity` where client_id = '".$client_id."' and priority = '1' and `parent_id`='0'  order by id desc")->result();
            }else{
                  if(!empty($suggestion)){
                    $message = $suggestion;
                }else{
                    $message = $description;
                }

                $parent_id = (!empty($parent_id)) ? $parent_id : 0;
                if ($parent_id > 0){
                    $message = $activity_reply[$parent_id];
                }

                if(empty($message)){
                    set_alert('danger', 'Activity cannot be empty!');
                    redirect($_SERVER['HTTP_REFERER']);
                    die;
                }

                 $ad_data = array(
                            'client_id' => $client_id,
                            'parent_id' => $parent_id,
                            'message' => $message,
                            'staffid' => get_staff_user_id(),
                            'date' => date('Y-m-d'),
                            'datetime' => date('Y-m-d H:i:s'),
                            'priority' => 0,
                            'status' => 1
                        );

               $insert_id = $this->home_model->insert('tblfollowupclientactivity',$ad_data);

               if (!empty($tag_staff_ids)){
                   $staff_ids = explode(",", $tag_staff_ids);
                   foreach ($staff_ids as $staff_id) {
                       $n_data = array(
                            'description' => 'You taged in client activity follow up',
                            'staff_id' => $staff_id,
                            'fromuserid' => get_staff_user_id(),
                            'table_id' => $client_id,
                            'isread' => 0,
                            'module_id' => 31,
                            'link'  => "follow_up/client_activity/".$client_id,
                            'date' => date('Y-m-d H:i:s'),
                            'date_time' => date('Y-m-d H:i:s')
                        );

                        $this->home_model->insert('tblmasterapproval', $n_data);

                        //Sending Mobile Intimation
                            $token = get_staff_token($staff_id);
                            $title = 'Schach';
                            $message = 'You taged in client activity follow up';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                   }
               }

                set_alert('success', 'Activity Added successfully');
                redirect(admin_url('follow_up/client_activity/' . $client_id));
            }

        }else{
            $data['activity_log'] = $this->db->query("SELECT * FROM `tblfollowupclientactivity` where client_id = '".$client_id."' and `parent_id`='0' order by id desc LIMIT 10")->result();
        }

        $companyName = get_company_name($client_id);
        $data['client_id'] = $client_id;
        $data['suggestion_info'] = $this->db->query("SELECT * FROM `tblsuggestion` where status = '1'")->result();
        krsort($data['activity_log']);

        $data['title'] = $companyName.' - Followup Activities';
        $this->load->view('admin/follow_up/client_activity', $data);
    }

    public function udpate_priority()
    {
        if(!empty($_POST)){
            extract($this->input->post());

            $pri = ($priority == 1) ? 0 : 1;
            if($this->home_model->update('tblfollowupclientactivity',array('priority'=>$pri),array('id'=>$id))){

            }
        }
    }

    public function get_last_conversion()
    {
       if(!empty($_POST)){
            extract($this->input->post());

            $activity_log = $this->db->query("SELECT * FROM `tblfollowupclientactivity` where id < '".$id."' and client_id = '".$client_id."'  and `parent_id`='0' order by id desc LIMIT 10")->result();
            krsort($activity_log);

            $html = '';
            if(!empty($activity_log)){
                $i = 0;
                foreach ($activity_log as $key => $log) {

                       if($i == 0){
                            $last_id = $log->id;
                        }

                    if($log->priority == 1){
                        $class = 'fa-star';
                    }else{
                        $class = 'fa-star-o';
                    }

                    if($log->status == 2){
                        $cut = 'line-throught';
                    }else{
                        $cut = '';
                    }
                    $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblfollowupclientactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                    $html .= '<div class="col-md-12 replyboxdiv'.$log->id.'">';
                            $html .= '<div class="feed-item">
                                        <div class="date"><span class="text-has-action" data-toggle="tooltip">' . _dt($log->datetime) . '</span></div>
                                        <div class="text ' . $cut . '">
                                            <a href="#" val="'.$log->id.'" pri="'.$log->priority.'" onclick="return false;" class="priority" ><i class="fa ' . $class . '" aria-hidden="true"></i></a>';
                                            if ((get_staff_user_id() == $log->staffid) && ($log->status == 1)) {
                                                $html .= ' <a href="' . admin_url('follow_up/cut_client_conversation/' . $log->id) . '" ><i class="fa fa-ban" aria-hidden="true"></i></a>';
                                            }
                                            if (is_admin() == 1 && $ttl_reply == 0) {
                                                $html .= ' <a href="' . admin_url('follow_up/delete_client_conversation/' . $log->id) . '" ><i class="fa fa-trash-o" aria-hidden="true"></i></a> ';
                                            }

                                            if ($log->staffid != 0) {
                                                $html .= '<a href="' . admin_url('profile/' . $log->staffid) . '">' . staff_profile_image($log->staffid, array('staff-profile-xs-image pull-left mright5')) . '</a>';
                                                $html .= get_employee_name($log->staffid) . ' - ' . _l($log->message, '', false);
                                                $html .=' <a href="#" class="reply_comment" val="'.$log->id.'" title="Reply on activity"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>';
                                                if ($ttl_reply > 0){
                                                    $html .=' |<a href="javascript:void(0);" class="view_reply" val="'.$log->id.'" data-type="1" data-last_id="0" > '.$ttl_reply.' Replies</a>';
                                                }
                                            }
                            $html .='</div></div>
                                        <div class="col-md-12 reply-div reply-box'.$log->id.'" style="display: none;"><div class="form-group mtop15" app-field-wrapper="description"><input type="text" name="activity_reply['.$log->id.']" val="'.$log->id.'" id="description'.$log->id.'" class="form-control description_box"></div>
                                           <div class="text-right">
                                                <a href="javascript:void(0);" id="tag_employee_btn" value="'.$log->id.'" class="btn btn-success tag_employee_btn">@ Tag Someone</a>
                                              <button class="btn btn-info">Reply</button>
                                              <a href="javascript:void(0);" onclick="close_reply_activity();" class="btn btn-danger">Close</a>
                                           </div><br>
                                        </div><div class="reply-view'.$log->id.'"></div>';        
                       $html .= '</div>';  

                    $i++;

                }
            }

            /*echo $last_id;
            die;

            echo '<pre/>';
            print_r($activity_log);
            die;*/

            if(!empty($html) && !empty($last_id)){
                $json_arr = array( "html" => $html, "last_id" => $last_id);

                echo json_encode( $json_arr );
            }

       }

    }

    //Lead Followup Setarts
   /* public function lead_followup()
    {
       check_permission(80,'view');

        $this->load->model('follow_up_model');

        if ($this->input->is_ajax_request()) {
            echo json_encode($this->follow_up_model->get_lead_items($this->input->post('finished'), $this->input->post('todo_page')));
            exit;
        }


        //deleteing last lead records
        $this->db->query("DELETE FROM tblleadfollowup where date < '".date('Y-m-d')."' ");

        if(get_staff_user_id() == 1){
            $lead_info = $this->db->query("SELECT l.* from tblleadassignstaff as la LEFT JOIN tblleads as l ON l.id = la.lead_id where l.followup = 1 GROUP by la.lead_id")->result();
        }else{
            $lead_info = $this->db->query("SELECT l.* from tblleadassignstaff as la LEFT JOIN tblleads as l ON l.id = la.lead_id where la.staff_id = '".get_staff_user_id()."' and l.followup = 1 GROUP by la.lead_id")->result();
        }

        if(!empty($lead_info)){
        	foreach ($lead_info as $row){
		        		$exist_info = $this->db->query("SELECT `id` FROM `tblleadfollowup` where lead_id = '".$row->id."' and staffid = '".get_staff_user_id()."' and date = '".date('Y-m-d')."' ")->row();
		        		if(empty($exist_info)){
                            $leadproduct_info = $this->db->query("SELECT `enquiry_for_id` FROM `tblproductinquiry` where enquiry_id = '".$row->id."' and enquiry_for_id > '0' ")->row();
                                if(!empty($leadproduct_info)){
                                    $type = $leadproduct_info->enquiry_for_id;
                                }else{
                                    $type = 0;
                                }

		        			$ad_data = array(
	                                'lead_id' => $row->id,
	                                'staffid' => get_staff_user_id(),
	                                'date' => date('Y-m-d'),
	                                'finished' => 0,
                                    'status' => $row->enquiry_type_id,
                                    'type' => $type,
	                            );

		                 	$this->home_model->insert('tblleadfollowup',$ad_data);
		        		}
		        }
        }

        $data['bodyclass']            = 'main-todo-page';
        $data['total_pages_finished'] = ceil(total_rows('tblleadfollowup', [
            'finished' => 1,
            'staffid'  => get_staff_user_id(),
            'date'  => date('Y-m-d'),
        ]) / $this->follow_up_model->getTodosLimit());
        $data['total_pages_unfinished'] = ceil(total_rows('tblleadfollowup', [
            'finished' => 0,
            'staffid'  => get_staff_user_id(),
            'date'  => date('Y-m-d'),
        ]) / $this->follow_up_model->getTodosLimit());
        $data['title'] = 'My Lead Follow Up';

        $this->load->view('admin/follow_up/lead_follow_up', $data);
    }*/


    public function lead_followup()
    {
        check_permission(146,'view');


        //deleteing last lead records
        $this->db->query("DELETE FROM tblleadfollowup where date < '".date('Y-m-d')."' ");

        if(get_staff_user_id() == 1){
            $lead_info = $this->db->query("SELECT l.* from tblleadassignstaff as la LEFT JOIN tblleads as l ON l.id = la.lead_id where l.followup = 1 GROUP by la.lead_id")->result();
        }else{
            $lead_info = $this->db->query("SELECT l.* from tblleadassignstaff as la LEFT JOIN tblleads as l ON l.id = la.lead_id where la.staff_id = '".get_staff_user_id()."' and l.followup = 1 GROUP by la.lead_id")->result();
        }

        if(!empty($lead_info)){
            foreach ($lead_info as $row){
                        $exist_info = $this->db->query("SELECT `id` FROM `tblleadfollowup` where lead_id = '".$row->id."' and staffid = '".get_staff_user_id()."' and date = '".date('Y-m-d')."' ")->row();
                        if(empty($exist_info)){
                            $leadproduct_info = $this->db->query("SELECT `enquiry_for_id` FROM `tblproductinquiry` where enquiry_id = '".$row->id."' and enquiry_for_id > '0' ")->row();
                                if(!empty($leadproduct_info)){
                                    $type = $leadproduct_info->enquiry_for_id;
                                }else{
                                    $type = 0;
                                }

                            $ad_data = array(
                                    'lead_id' => $row->id,
                                    'staffid' => get_staff_user_id(),
                                    'date' => date('Y-m-d'),
                                    'finished' => 0,
                                    'status' => $row->enquiry_type_id,
                                    'type' => $type,
                                );

                            $this->home_model->insert('tblleadfollowup',$ad_data);
                        }
                }
        }



        $where = " staffid = '".get_staff_user_id()."' and date = '".date('Y-m-d')."' ";

        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/

            if(isset($finished) && $finished != ''){
                $data['s_finished'] = $finished;
                $where .= " and finished = '".$finished."'";
            }
            if(isset($status) && $status != ''){
                $data['s_status'] = $status;
                $where .= " and status = '".$status."'";
            }
            if(isset($type) && $type != ''){
                $data['s_type'] = $type;
                $where .= " and type = '".$type."'";
            }

        }


        $data['followup_info'] = $this->db->query("SELECT * from tblleadfollowup where  ".$where." order by finished asc ")->result();
        $data['status_info'] = $this->db->query("SELECT * from tblenquirytypemaster where  status = 1 ")->result();


        $data['title'] = 'Lead Followup List';
        $this->load->view('admin/follow_up/lead_follow_up', $data);
    }



    public function lead_activity($lead_id = '')
    {
        if(!empty($lead_id)){
            $number_list = $this->db->query("SELECT c.phonenumber from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$lead_id."' ")->result();

            $numbers = '';
            if(!empty($number_list)){
                $i = 0;
                foreach ($number_list as $no) {
                    if($i == 0){
                        $numbers .= $no->phonenumber;
                    }else{
                        $numbers .= ','.$no->phonenumber;
                    }
                    $i++;
                }
            }

            if(!empty($numbers)){
                $data['numbers'] = $numbers;
                /*$where = "customer_number IN (".$numbers.")";
                $data['call_history'] = $this->db->query("SELECT * from tblcalloutgoing where ".$where." order by id desc ")->result();*/
            }
        }

        if(!empty($_POST)){
            extract($this->input->post());
            // echo "<pre>";
            // print_r($_POST);
            // exit;
            /* this is for check notification uodate */
            $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$lead_id."' and staff_id = '".get_staff_user_id()."' and module_id = 30")->result();
            if (!empty($chk_notification)){
                foreach ($chk_notification as $value) {
                    $this->home_model->update("tblmasterapproval", array("status" => 1), array("id" => $value->id));
                }
            }
            if(!empty($important_search)){
                 $data['activity_log'] = $this->db->query("SELECT * FROM `tblfollowupleadactivity` where lead_id = '".$lead_id."' and priority = '1' and parent_id = '0' order by id asc")->result();
            }else{

                if(!empty($suggestion)){
                    $message = $suggestion;
                }else{
                    $message = $description;
                }
                $parent_id = (!empty($parent_id)) ? $parent_id : 0;
                if ($parent_id > 0){
                    $message = $activity_reply[$parent_id];
                }

                if(empty($message)){
                    set_alert('danger', 'Activity cannot be empty!');
                    redirect($_SERVER['HTTP_REFERER']);
                    die;
                }

                 $ad_data = array(
                            'lead_id' => $lead_id,
                            'parent_id' => $parent_id,
                            'message' => $message,
                            'staffid' => get_staff_user_id(),
                            'date' => date('Y-m-d'),
                            'datetime' => date('Y-m-d H:i:s'),
                            'priority' => 0,
                            'status' => 1
                        );

                $insert_id = $this->home_model->insert('tblfollowupleadactivity',$ad_data);

                /* this for update last activity date of lead */
                $this->home_model->update('tblleads',array('last_activity_date'=>date('Y-m-d')),array('id'=>$lead_id));

                if (!empty($tag_staff_ids)){
                   $staff_ids = explode(",", $tag_staff_ids);
                   foreach ($staff_ids as $staff_id) {
                       $n_data = array(
                            'description' => 'You taged in leads activity follow up',
                            'staff_id' => $staff_id,
                            'fromuserid' => get_staff_user_id(),
                            'table_id' => $lead_id,
                            'isread' => 0,
                            'module_id' => 30,
                            'link'  => "follow_up/lead_activity/".$lead_id,
                            'date' => date('Y-m-d H:i:s'),
                            'date_time' => date('Y-m-d H:i:s')
                        );

                        $this->home_model->insert('tblmasterapproval', $n_data);

                        //Sending Mobile Intimation
                            $token = get_staff_token($staff_id);
                            $title = 'Schach';
                            $message = 'You taged in leads activity follow up';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                   }
                }

                set_alert('success', 'Activity Added successfully');
                redirect(admin_url('follow_up/lead_activity/' . $lead_id));
            }

        }else{
            $data['activity_log'] = $this->db->query("SELECT * FROM `tblfollowupleadactivity` where lead_id = '".$lead_id."' and parent_id = '0' order by id desc LIMIT 10")->result();
        }

        $LeadNumber = value_by_id('tblleads',$lead_id,'leadno');
        $data['contact_info'] = $this->db->query("SELECT c.id from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$lead_id."' and c.phonenumber != '' ")->row();
        $data['lead_id'] = $lead_id;

        $data['suggestion_info'] = $this->db->query("SELECT * FROM `tblsuggestion` where status = '1'")->result();
        krsort($data['activity_log']);

        $data['title'] = $LeadNumber.' - Followup Activities';
        // $data['branch_list'] = $this->db->query("SELECT * FROM `tblcompanybranch` WHERE `status` = 1 ")->result();
        // $data['department_list'] = $this->db->query("SELECT * FROM `tbldepartmentsmaster` WHERE `status` = 1 ")->result();
        
        $this->load->view('admin/follow_up/lead_activity', $data);
    }


    public function udpate_lead_priority()
    {
       if(!empty($_POST)){
            extract($this->input->post());

            if($priority == 1){
                $pri = 0;
            }else{
                $pri = 1;
            }

           if($this->home_model->update('tblfollowupleadactivity',array('priority'=>$pri),array('id'=>$id))){

           }

       }

    }

    public function udpate_po_priority()
    {

        if(!empty($_POST)){
            extract($this->input->post());

            $pri = ($priority == 1) ? 0 : 1;
            $this->home_model->update('tblpurchaseorderactivity',array('priority'=>$pri),array('id'=>$id));
        }
    }
    public function udpate_estimate_priority()
    {

        if(!empty($_POST)){
            extract($this->input->post());

            $pri = ($priority == 1) ? 0 : 1;
            $this->home_model->update('tblproformainvoiceactivity',array('priority'=>$pri),array('id'=>$id));
        }
    }
    public function udpate_requirement_priority()
    {

        if(!empty($_POST)){
            extract($this->input->post());

            $pri = ($priority == 1) ? 0 : 1;
            $this->home_model->update('tblcandidaterequirementactivity',array('priority'=>$pri),array('id'=>$id));
        }
    }

    public function get_last_lead_conversion()
    {
       if(!empty($_POST)){
            extract($this->input->post());

            $activity_log = $this->db->query("SELECT * FROM `tblfollowupleadactivity` where id < '".$id."' and lead_id = '".$lead_id."' and `parent_id` = '0' order by id desc LIMIT 10")->result();

            krsort($activity_log);

            $html = '';
            if(!empty($activity_log)){
                $i = 0;
                foreach ($activity_log as $key => $log) {

                    if($i == 0){
                        $last_id = $log->id;
                    }
                    $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblfollowupleadactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                    $class = ($log->priority == 1) ? 'fa-star' : 'fa-star-o';

                    $cut = ($log->status == 2) ? 'line-throught' : '';

                            $html .= '<div class="col-md-12 replyboxdiv'.$log->id.'">';
                              $html .= '<div class="feed-item">
                                          <div class="date"><span class="text-has-action" data-toggle="tooltip">'._d($log->datetime).'</span></div>
                                          <div class="text '.$cut.'">
                                              <a href="#" val="'.$log->id.'" pri="'.$log->priority.'" onclick="return false;" class="priority" ><i class="fa '.$class.'" aria-hidden="true"></i></a> ';
  
                                              if((get_staff_user_id() == $log->staffid) && ($log->status == 1) ){
                                                    $html .= '<a href="'.admin_url('follow_up/cut_lead_conversation/'.$log->id).'" ><i class="fa fa-ban" aria-hidden="true"></i></a>';
                                              }
  
                                               if(is_admin() == 1 && $ttl_reply == 0){
                                                    $html .= '<a href="'.admin_url('follow_up/delete_lead_conversation/'.$log->id).'" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                                               }
  
                                              if($log->staffid != 0){
                                                  $html .= '<a href="'.admin_url('profile/'.$log->staffid).'">'.staff_profile_image($log->staffid,array('staff-profile-xs-image pull-left mright5')).'</a>';
                                                  $html .= get_employee_name($log->staffid) . ' - '. _l(str_replace("@", '<span style="color:red;">@</span>', $log->message),'',false);
                                                  $html .=' <a href="#" class="reply_comment" val="'.$log->id.'" title="Reply on activity"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>';
                                                  if ($ttl_reply > 0){
                                                      $html .=' |<a href="javascript:void(0);" class="view_reply" val="'.$log->id.'" data-type="1" data-last_id="0" > '.$ttl_reply.' Replies</a>';
                                                  }
                                              }
                                      $html .='</div></div>
                                        <div class="col-md-12 reply-div reply-box'.$log->id.'" style="display: none;"><div class="form-group mtop15" app-field-wrapper="description"><input type="text" name="activity_reply['.$log->id.']" val="'.$log->id.'" id="description'.$log->id.'" class="form-control description_box"></div>
                                           <div class="text-right">
                                              <a href="javascript:void(0);" id="tag_employee_btn" value="'.$log->id.'" class="btn btn-success tag_employee_btn">@ Tag Someone</a>
                                              <button class="btn btn-info">Reply</button>
                                              <a href="javascript:void(0);" onclick="close_reply_activity();" class="btn btn-danger">Close</a>
                                           </div><br>
                                        </div><div class="reply-view'.$log->id.'"></div>';
                      $html .= '</div>';    
                    $i++;

                }
            }

            if(!empty($html) && !empty($last_id)){
                $json_arr = array( "html" => $html, "last_id" => $last_id);

                echo json_encode( $json_arr );
            }

       }

    }


    public function cut_client_conversation($id) {

        $success = $this->home_model->update('tblfollowupclientactivity',array('status' => 2),array('id'=>$id));
        if ($success) {
            set_alert('success', 'Client Conversation Removed');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function cut_po_conversation($id) {

        $success = $this->home_model->update('tblpurchaseorderactivity',array('status' => 2),array('id'=>$id));
        if ($success) {
            set_alert('success', 'Purchase Order Conversation Removed');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function cut_estimate_conversation($id) {

        $success = $this->home_model->update('tblproformainvoiceactivity',array('status' => 2),array('id'=>$id));
        if ($success) {
            set_alert('success', 'Proforma Invoice Conversation Removed');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function cut_requirement_conversation($id) {

        $success = $this->home_model->update('tblcandidaterequirementactivity',array('status' => 2),array('id'=>$id));
        if ($success) {
            set_alert('success', 'Candidate Requirement Conversation Removed');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function cut_lead_conversation($id) {

        $success = $this->home_model->update('tblfollowupleadactivity',array('status' => 2),array('id'=>$id));
        if ($success) {
            set_alert('success', 'Lead Conversation Removed');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete_po_conversation($id) {

        $success = $this->home_model->delete('tblpurchaseorderactivity',array('id'=>$id));
        if ($success) {
            set_alert('success', _l('deleted', 'Purchase Order conversation'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function delete_estimate_conversation($id) {

        $success = $this->home_model->delete('tblproformainvoiceactivity',array('id'=>$id));
        if ($success) {
            set_alert('success', _l('deleted', 'Proforma Invoice conversation'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function delete_requirement_conversation($id) {

        $success = $this->home_model->delete('tblcandidaterequirementactivity',array('id'=>$id));
        if ($success) {
            set_alert('success', _l('deleted', 'Candidate Requirement conversation'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function delete_client_conversation($id) {

        $success = $this->home_model->delete('tblfollowupclientactivity',array('id'=>$id));
        if ($success) {
            set_alert('success', _l('deleted', 'conversation'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete_lead_conversation($id) {

        $success = $this->home_model->delete('tblfollowupleadactivity ',array('id'=>$id));
        if ($success) {
            set_alert('success', _l('deleted', 'conversation'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function payment_contact($id = '')
    {

    	$data['contact_info'] = $this->db->query("SELECT * from tblcontacts  where userid = '".$id."' and phonenumber > 0 group by phonenumber")->result();
    	$number_list = $this->db->query("SELECT phonenumber from tblcontacts  where userid = '".$id."'  and phonenumber > 0 group by phonenumber")->result();


    	$numbers = '';
    	if(!empty($number_list)){
    		$i = 0;
    		foreach ($number_list as $no) {
                if(!empty($no->phonenumber)){
                    $phonenumber = trim($no->phonenumber," .,/-");
                   if($i == 0){
                    $numbers .= $phonenumber;
                    }else{
                        $numbers .= ','.$phonenumber;
                    }
                    $i++;
                }

    		}
    	}

        if(!empty($numbers)){
            $where = "customer_number IN (".$numbers.")";
            /*echo "SELECT * from tblcalloutgoing where ".$where." order by id desc ";
            die;*/
        $data['call_history'] = $this->db->query("SELECT * from tblcalloutgoing where ".$where." order by id desc ")->result();
        }

        $keys_info  = $this->db->query("SELECT `staffid`,`callingnumber` FROM tblstaff WHERE staffid = '".get_staff_user_id()."' ")->row();
        if(!empty($keys_info) && !empty($keys_info->callingnumber)){
            $data['calling_numbes'] = $this->db->query("SELECT * from tblvagentnumbers  where status = 1 and id IN (".$keys_info->callingnumber.") group by exotel_number order by id asc")->result();
        }
    	$data['lead_id'] = $id;
    	$data['title'] = 'Client Contacts';
        $this->load->view('admin/follow_up/paymentfollowup_contact', $data);
    }

    public function add_contact()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/
             $ad_data = array(
                        'userid' => $id,
                        'firstname' => $firstname,
                        'designation_id' => $designation_id,
                        'email' => $email,
                        'phonenumber' => $phonenumber,
                        'added_by' => get_staff_user_id(),
                        'datecreated' => date('Y-m-d H:i:s'),
                        'active' => 1,
                        'contact_type' => 1
                    );

            if($this->home_model->insert('tblcontacts',$ad_data)){
                set_alert('success', 'New Contact added successfully!');
                redirect($_SERVER['HTTP_REFERER']);
                die;
            }

        }

    }

    public function acton_lead_followup($id, $status) {
        if ($this->input->is_ajax_request()) {

            $update_data = array(
                'finished' => $status
            );

            $this->home_model->update('tblleadfollowup',$update_data,array('id'=>$id));
        }
    }

    public function action_payment_followup($id, $status) {
        if ($this->input->is_ajax_request()) {

            $update_data = array(
                'finished' => $status
            );

            $this->home_model->update('tblpaymentfollowupclients',$update_data,array('id'=>$id));
        }
    }

    public function change_client_status()
    {
        if ($this->input->post() && $this->input->is_ajax_request()) {
            extract($this->input->post());

            $client_id = value_by_id('tblpaymentfollowupclients',$id,'client_id');
            $last_status = value_by_id('tblpaymentfollowupclients',$id,'status');
            $last_status_name = value_by_id('tblclientstatus',$last_status,'name');
            $new_status_name = value_by_id('tblclientstatus',$status,'name');

            $message = 'Client status changed from '.$last_status_name.' to '.$new_status_name.' dated on '.date('d/m/Y H:i A');
            $ad_data = array(
                'client_id' => $client_id,
                'message' => $message,
                'staffid' => get_staff_user_id(),
                'date' => date('Y-m-d'),
                'datetime' => date('Y-m-d H:i:s'),
                'priority' => 0,
                'status' => 1
            );

            $this->home_model->insert('tblfollowupclientactivity',$ad_data);

            $this->home_model->update('tblclientbranch',array('client_status'=>$status),array('userid'=>$client_id));
            $this->home_model->update('tblpaymentfollowupclients',array('status'=>$status),array('client_id'=>$client_id));

        }
    }

    public function get_staff_list(){
        $staff_list = $this->db->query("SELECT * FROM tblstaff WHERE active = 1")->result();
        if (!empty($staff_list)){
            echo '<select class="form-control selectpicker" onchange="get_tag_staffid(this);" id="staffuserlist" data-live-search="true" name="finished"><option value=""></option>';
            foreach ($staff_list as $value) {
                echo '<option data-staff_id="'.$value->staffid.'" value="@'.$value->firstname.' ">'.$value->firstname.'</option>';
            }
            echo '</select>';
        }
    }
    public function get_branch_employees(){
        if(!empty($_POST)){
            extract($this->input->post()); 

            if ($branch_id != '' && $department_id != ''){
                $staff_list = $this->db->query("SELECT * FROM tblstaff WHERE `reporting_branch_id` = ".$branch_id." AND `department_id` = ".$department_id." AND `staffid` != ".get_staff_user_id()." AND `active` = 1")->result();
                echo '<div class="form-group" app-field-wrapper="staff">
                        <label for="staff" class="control-label">Staff</label>
                        <select class="form-control selectpicker" onchange="showtag_btn(this);" id="staffuserlist" data-live-search="true" name="finished" multiple=""><option value=""></option>';
                        if (!empty($staff_list)){
                            foreach ($staff_list as $value) {
                                $designation_name = get_designation($value->designation_id);
                                $sval = '@'.$value->firstname.' ('.$designation_name.')';
                                echo '<option data-staff_id="'.$value->staffid.'" value="'.$sval.'">'.$value->firstname.' ('.$designation_name.')'.'</option>';
                            }
                        }
                    echo '</select></div>';
            }
        }
    }

    public function po_activity($po_id = '')
    {

        if(!empty($_POST)){
            extract($this->input->post());

            /* this is for check notification uodate */
            $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$po_id."' and staff_id = '".get_staff_user_id()."' and module_id = '33'")->result();
            if (!empty($chk_notification)){
                foreach ($chk_notification as $value) {
                    $this->home_model->update("tblmasterapproval", array("status" => 1, "approve_status" => 1), array("id" => $value->id));
                }
            }

            if(!empty($important_search)){
                 $data['activity_log'] = $this->db->query("SELECT * FROM `tblpurchaseorderactivity` where po_id = '".$po_id."' and priority = '1' and `parent_id`='0' order by id asc")->result();
            }else{

                $message = (!empty($suggestion)) ? $suggestion : $description;
                $parent_id = (!empty($parent_id)) ? $parent_id : 0;
                if ($parent_id > 0){
                    $message = $activity_reply[$parent_id];
                }
                if(empty($message)){
                    set_alert('danger', 'Activity cannot be empty!');
                    redirect($_SERVER['HTTP_REFERER']);
                    die;
                }

                 $ad_data = array(
                            'po_id' => $po_id,
                            'parent_id' => $parent_id,
                            'message' => $message,
                            'staffid' => get_staff_user_id(),
                            'date' => date('Y-m-d'),
                            'datetime' => date('Y-m-d H:i:s'),
                            'priority' => 0,
                            'status' => 1
                        );

                $insert_id = $this->home_model->insert('tblpurchaseorderactivity',$ad_data);

                /* this for update last activity date of lead */
                $this->home_model->update('tblpurchaseorder',array('last_activity_date'=>date('Y-m-d')),array('id'=>$po_id));

                if (!empty($tag_staff_ids)){
                   $staff_ids = explode(",", $tag_staff_ids);
                   foreach ($staff_ids as $staff_id) {
                       $n_data = array(
                            'description' => 'You taged in purchase order activity follow up',
                            'staff_id' => $staff_id,
                            'fromuserid' => get_staff_user_id(),
                            'table_id' => $po_id,
                            'isread' => 0,
                            'module_id' => 33,
                            'link'  => "follow_up/po_activity/".$po_id,
                            'date' => date('Y-m-d H:i:s'),
                            'date_time' => date('Y-m-d H:i:s')
                        );

                        $this->home_model->insert('tblmasterapproval', $n_data);

                        //Sending Mobile Intimation
                            $token = get_staff_token($staff_id);
                            $title = 'Schach';
                            $message = 'You taged in purchase order activity follow up';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                   }
                }

                set_alert('success', 'Activity Added successfully');
                redirect(admin_url('follow_up/po_activity/' . $po_id));
            }
        }else{
            $data['activity_log'] = $this->db->query("SELECT * FROM `tblpurchaseorderactivity` where po_id = '".$po_id."' and `parent_id`='0'  order by id desc LIMIT 10")->result();
        }


        $po_number = value_by_id('tblpurchaseorder',$po_id,'number');
        $data['po_id'] = $po_id;
        $data['suggestion_info'] = $this->db->query("SELECT * FROM `tblsuggestion` where status = '1'")->result();

        krsort($data['activity_log']);

        $data['title'] = $po_number.' - Followup Activities';
        $this->load->view('admin/follow_up/purchaseorder_activity', $data);
    }

    public function get_last_po_conversion()
    {
       if(!empty($_POST)){
            extract($this->input->post());

            $activity_log = $this->db->query("SELECT * FROM `tblpurchaseorderactivity` where id < '".$id."' and po_id = '".$po_id."' and `parent_id`='0'  order by id desc LIMIT 10")->result();

            krsort($activity_log);

            $html = '';
            if(!empty($activity_log)){
                $i = 0;
                foreach ($activity_log as $key => $log) {

                    if($i == 0){
                        $last_id = $log->id;
                    }

                    $class = ($log->priority == 1) ? 'fa-star' : 'fa-star-o';

                    $cut = ($log->status == 2) ? 'line-throught' : '';
                    $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblpurchaseorderactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                    $html .= '<div class="col-md-12 replyboxdiv'.$log->id.'">';
                        $html .= '<div class="feed-item">
                                    <div class="date"><span class="text-has-action" data-toggle="tooltip">' . _dt($log->datetime) . '</span></div>
                                    <div class="text ' . $cut . '">
                                        <a href="#" val="'.$log->id.'" pri="'.$log->priority.'" onclick="return false;" class="priority" ><i class="fa ' . $class . '" aria-hidden="true"></i></a>';
                                        if ((get_staff_user_id() == $log->staffid) && ($log->status == 1)) {
                                            $html .= ' <a href="' . admin_url('follow_up/cut_po_conversation/' . $log->id) . '" ><i class="fa fa-ban" aria-hidden="true"></i></a>';
                                        }
                                        if (is_admin() == 1) {
                                            $html .= ' <a href="' . admin_url('follow_up/delete_po_conversation/' . $log->id) . '" ><i class="fa fa-trash-o" aria-hidden="true"></i></a> ';
                                        }

                                        if ($log->staffid != 0) {
                                            $html .= '<a href="' . admin_url('profile/' . $log->staffid) . '">' . staff_profile_image($log->staffid, array('staff-profile-xs-image pull-left mright5')) . '</a>';
                                            $html .= get_employee_name($log->staffid) . ' - ' . _l($log->message, '', false);
                                            $html .=' <a href="#" class="reply_comment" val="'.$log->id.'" title="Reply on activity"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>';
                                            if ($ttl_reply > 0){
                                                $html .=' |<a href="javascript:void(0);" class="view_reply" val="'.$log->id.'" data-type="1" data-last_id="0" > '.$ttl_reply.' Replies</a>';
                                            }
                                        }
                        $html .='</div></div>
                                    <div class="col-md-12 reply-div reply-box'.$log->id.'" style="display: none;"><div class="form-group mtop15" app-field-wrapper="description"><input type="text" name="activity_reply['.$log->id.']" val="'.$log->id.'" id="description'.$log->id.'" class="form-control description_box"></div>
                                        <div class="text-right">
                                            <a href="javascript:void(0);" id="tag_employee_btn" value="'.$log->id.'" class="btn btn-success tag_employee_btn">@ Tag Someone</a>
                                            <button class="btn btn-info">Reply</button>
                                            <a href="javascript:void(0);" onclick="close_reply_activity();" class="btn btn-danger">Close</a>
                                        </div><br>
                                    </div><div class="reply-view'.$log->id.'"></div>';        
                    $html .= '</div>';  

                    $i++;
                }
            }

            if(!empty($html) && !empty($last_id)){
                $json_arr = array( "html" => $html, "last_id" => $last_id);

                echo json_encode( $json_arr );
            }

       }
    }

    public function estimates_activity($estimate_id = '')
    {
        if(!empty($_POST)){
            extract($this->input->post());

            /* this is for check notification uodate */
            $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$estimate_id."' and staff_id = '".get_staff_user_id()."' and module_id = '37'")->result();
            if (!empty($chk_notification)){
                foreach ($chk_notification as $value) {
                    $this->home_model->update("tblmasterapproval", array("status" => 1, "approve_status" => 1), array("id" => $value->id));
                }
            }

            if(!empty($important_search)){
                 $data['activity_log'] = $this->db->query("SELECT * FROM `tblproformainvoiceactivity` where estimate_id = '".$estimate_id."' and priority = '1' and `parent_id`='0' order by id asc")->result();
            }else{

                $message = (!empty($suggestion)) ? $suggestion : $description;

                /* THIS CODE USE IN CASE OF ACTIVITY REPLY */
                $parent_id = (!empty($parent_id)) ? $parent_id : 0;
                if ($parent_id > 0){
                    $message = $activity_reply[$parent_id];
                }

                if(empty($message)){
                    set_alert('danger', 'Activity cannot be empty!');
                    redirect($_SERVER['HTTP_REFERER']);
                    die;
                }

                 $ad_data = array(
                            'estimate_id' => $estimate_id,
                            'parent_id' => $parent_id,
                            'message' => $message,
                            'staffid' => get_staff_user_id(),
                            'date' => date('Y-m-d'),
                            'datetime' => date('Y-m-d H:i:s'),
                            'priority' => 0,
                            'status' => 1
                        );

                $insert_id = $this->home_model->insert('tblproformainvoiceactivity',$ad_data);

                /* this for update last activity date of lead */
                $this->home_model->update('tblestimates',array('last_activity_date'=>date('Y-m-d')),array('id'=>$estimate_id));

                if (!empty($tag_staff_ids)){
                   $staff_ids = explode(",", $tag_staff_ids);
                   foreach ($staff_ids as $staff_id) {
                       $n_data = array(
                            'description' => 'You taged in proforma invoice activity follow up',
                            'staff_id' => $staff_id,
                            'fromuserid' => get_staff_user_id(),
                            'table_id' => $estimate_id,
                            'isread' => 0,
                            'module_id' => 37,
                            'link'  => "follow_up/estimates_activity/".$estimate_id,
                            'date' => date('Y-m-d H:i:s'),
                            'date_time' => date('Y-m-d H:i:s')
                        );

                        $this->home_model->insert('tblmasterapproval', $n_data);

                        //Sending Mobile Intimation
                            $token = get_staff_token($staff_id);
                            $title = 'Schach';
                            $message = 'You taged in proforma invoice activity follow up';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                   }
                }

                set_alert('success', 'Activity Added successfully');
                redirect(admin_url('follow_up/estimates_activity/' . $estimate_id));
            }
        }else{
            $data['activity_log'] = $this->db->query("SELECT * FROM `tblproformainvoiceactivity` where estimate_id = '".$estimate_id."' and `parent_id`='0' order by id desc LIMIT 10")->result();
        }


        $estimate_number = value_by_id('tblestimates',$estimate_id,'number');
        $clientid = value_by_id('tblestimates',$estimate_id,'clientid');
        $client_info = $this->db->query("SELECT `client_branch_name` FROM `tblclientbranch` where userid = '".$clientid."'  ")->row();

        $data['estimate_id'] = $estimate_id;
        $data['suggestion_info'] = $this->db->query("SELECT * FROM `tblsuggestion` where status = '1'")->result();

        krsort($data['activity_log']);

        $data['title'] = $client_info->client_branch_name.' (' .$estimate_number.') - Followup Activities';
        $this->load->view('admin/follow_up/estimate_activity', $data);
    }

    public function get_last_estimate_conversion()
    {
       if(!empty($_POST)){
            extract($this->input->post());

            $activity_log = $this->db->query("SELECT * FROM `tblproformainvoiceactivity` where id < '".$id."' and estimate_id = '".$estimate_id."' and `parent_id` = '0'  order by id desc LIMIT 10")->result();

            krsort($activity_log);


            $html = '';
            if(!empty($activity_log)){
                $i = 0;
                foreach ($activity_log as $key => $log) {

                    if($i == 0){
                        $last_id = $log->id;
                    }

                    $class = ($log->priority == 1) ? 'fa-star' : 'fa-star-o';

                    $cut = ($log->status == 2) ? 'line-throught' : '';
                    $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblproformainvoiceactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                    $html .= '<div class="col-md-12 replyboxdiv'.$log->id.'">';
                            $html .= '<div class="feed-item">
                                        <div class="date"><span class="text-has-action" data-toggle="tooltip">' . _dt($log->datetime) . '</span></div>
                                        <div class="text ' . $cut . '">
                                            <a href="#" val="'.$log->id.'" pri="'.$log->priority.'" onclick="return false;" class="priority" ><i class="fa ' . $class . '" aria-hidden="true"></i></a>';
                                            if ((get_staff_user_id() == $log->staffid) && ($log->status == 1)) {
                                                $html .= ' <a href="' . admin_url('follow_up/cut_estimate_conversation/' . $log->id) . '" ><i class="fa fa-ban" aria-hidden="true"></i></a>';
                                            }
                                            if (is_admin() == 1) {
                                                $html .= ' <a href="' . admin_url('follow_up/delete_estimate_conversation/' . $log->id) . '" ><i class="fa fa-trash-o" aria-hidden="true"></i></a> ';
                                            }

                                            if ($log->staffid != 0) {
                                                $html .= '<a href="' . admin_url('profile/' . $log->staffid) . '">' . staff_profile_image($log->staffid, array('staff-profile-xs-image pull-left mright5')) . '</a>';
                                                $html .= get_employee_name($log->staffid) . ' - ' . _l($log->message, '', false);
                                                $html .=' <a href="#" class="reply_comment" val="'.$log->id.'" title="Reply on activity"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>';
                                                if ($ttl_reply > 0){
                                                    $html .=' |<a href="javascript:void(0);" class="view_reply" val="'.$log->id.'" data-type="1" data-last_id="0" > '.$ttl_reply.' Replies</a>';
                                                }
                                            }
                            $html .='</div></div>
                                        <div class="col-md-12 reply-div reply-box'.$log->id.'" style="display: none;"><div class="form-group mtop15" app-field-wrapper="description"><input type="text" name="activity_reply['.$log->id.']" val="'.$log->id.'" id="description'.$log->id.'" class="form-control description_box"></div>
                                           <div class="text-right">
                                                <a href="javascript:void(0);" id="tag_employee_btn" value="'.$log->id.'" class="btn btn-success tag_employee_btn">@ Tag Someone</a>
                                                <button class="btn btn-info">Reply</button>
                                                <a href="javascript:void(0);" onclick="close_reply_activity();" class="btn btn-danger">Close</a>
                                           </div><br>
                                        </div><div class="reply-view'.$log->id.'"></div>';        
                       $html .= '</div>';  
                    $i++;
                }
            }

            if(!empty($html) && !empty($last_id)){
                $json_arr = array( "html" => $html, "last_id" => $last_id);

                echo json_encode( $json_arr );
            }

       }
    }

    public function candidate_requirement_activity($requirement_id = '')
    {

        if(!empty($_POST)){
            extract($this->input->post());

            /* this is for check notification uodate */
            $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$requirement_id."' and staff_id = '".get_staff_user_id()."' and module_id = '39'")->result();
            if (!empty($chk_notification)){
                foreach ($chk_notification as $value) {
                    $this->home_model->update("tblmasterapproval", array("status" => 1, "approve_status" => 1), array("id" => $value->id));
                }
            }

            if(!empty($important_search)){
                 $data['activity_log'] = $this->db->query("SELECT * FROM `tblcandidaterequirementactivity` where requirement_id = '".$requirement_id."' and priority = '1' and `parent_id` = '0' order by id asc")->result();
            }else{

                $message = (!empty($suggestion)) ? $suggestion : $description;

                /* THIS CODE USE IN CASE OF ACTIVITY REPLY */
                $parent_id = (!empty($parent_id)) ? $parent_id : 0;
                if ($parent_id > 0){
                    $message = $activity_reply[$parent_id];
                }
                if(empty($message)){
                    set_alert('danger', 'Activity cannot be empty!');
                    redirect($_SERVER['HTTP_REFERER']);
                    die;
                }

                 $ad_data = array(
                            'requirement_id' => $requirement_id,
                            'parent_id' => $parent_id,
                            'message' => $message,
                            'staffid' => get_staff_user_id(),
                            'date' => date('Y-m-d'),
                            'datetime' => date('Y-m-d H:i:s'),
                            'priority' => 0,
                            'status' => 1
                        );

                $insert_id = $this->home_model->insert('tblcandidaterequirementactivity',$ad_data);

                /* this for update last activity date of lead */
                $this->home_model->update('tblcandidaterequirement',array('last_activity_date'=>date('Y-m-d')),array('id'=>$requirement_id));

                if (!empty($tag_staff_ids)){
                   $staff_ids = explode(",", $tag_staff_ids);
                   foreach ($staff_ids as $staff_id) {
                       $n_data = array(
                            'description' => 'You taged in candidate requirement activity follow up',
                            'staff_id' => $staff_id,
                            'fromuserid' => get_staff_user_id(),
                            'table_id' => $requirement_id,
                            'isread' => 0,
                            'module_id' => 39,
                            'link'  => "follow_up/candidate_requirement_activity/".$requirement_id,
                            'date' => date('Y-m-d H:i:s'),
                            'date_time' => date('Y-m-d H:i:s')
                        );

                        $this->home_model->insert('tblmasterapproval', $n_data);

                        //Sending Mobile Intimation
                            $token = get_staff_token($staff_id);
                            $title = 'Schach';
                            $message = 'You taged in candidate requirement activity follow up';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                   }
                }

                set_alert('success', 'Activity Added successfully');
                redirect(admin_url('follow_up/candidate_requirement_activity/' . $requirement_id));
            }
        }else{
            $data['activity_log'] = $this->db->query("SELECT * FROM `tblcandidaterequirementactivity` where requirement_id = '".$requirement_id."' and `parent_id` = '0' order by id desc LIMIT 10")->result();
        }


        $data['requirement_id'] = $requirement_id;
        $data['suggestion_info'] = $this->db->query("SELECT * FROM `tblsuggestion` where status = '1'")->result();

        krsort($data['activity_log']);

        $data['title'] = ' Candidate Requirement Followup Activities';
        $this->load->view('admin/follow_up/candidate_requirement_activity', $data);
    }

    public function get_last_requirement_conversion()
    {
       if(!empty($_POST)){
            extract($this->input->post());

            $activity_log = $this->db->query("SELECT * FROM `tblcandidaterequirementactivity` where id < '".$id."' and requirement_id = '".$requirement_id."'  and `parent_id` = '0'  order by id desc LIMIT 10")->result();

            krsort($activity_log);

            $html = '';
            if(!empty($activity_log)){
                $i = 0;
                foreach ($activity_log as $key => $log) {

                    if($i == 0){
                        $last_id = $log->id;
                    }

                    $class = ($log->priority == 1) ? 'fa-star' : 'fa-star-o';
                    $cut = ($log->status == 2) ? 'line-throught' : '';
                    $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblcandidaterequirementactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;

                    $html .= '<div class="col-md-12 replyboxdiv'.$log->id.'">';
                        $html .= '<div class="feed-item">
                                    <div class="date"><span class="text-has-action" data-toggle="tooltip">' . _dt($log->datetime) . '</span></div>
                                    <div class="text ' . $cut . '">
                                        <a href="#" val="'.$log->id.'" pri="'.$log->priority.'" onclick="return false;" class="priority" ><i class="fa ' . $class . '" aria-hidden="true"></i></a>';
                                        if ((get_staff_user_id() == $log->staffid) && ($log->status == 1)) {
                                            $html .= ' <a href="' . admin_url('follow_up/cut_requirement_conversation/' . $log->id) . '" ><i class="fa fa-ban" aria-hidden="true"></i></a>';
                                        }
                                        if (is_admin() == 1) {
                                            $html .= ' <a href="' . admin_url('follow_up/delete_requirement_conversation/' . $log->id) . '" ><i class="fa fa-trash-o" aria-hidden="true"></i></a> ';
                                        }

                                        if ($log->staffid != 0) {
                                            $html .= '<a href="' . admin_url('profile/' . $log->staffid) . '">' . staff_profile_image($log->staffid, array('staff-profile-xs-image pull-left mright5')) . '</a>';
                                            $html .= get_employee_name($log->staffid) . ' - ' . _l($log->message, '', false);
                                            $html .=' <a href="#" class="reply_comment" val="'.$log->id.'" title="Reply on activity"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>';
                                            if ($ttl_reply > 0){
                                                $html .=' |<a href="javascript:void(0);" class="view_reply" val="'.$log->id.'" data-type="1" data-last_id="0" > '.$ttl_reply.' Replies</a>';
                                            }
                                        }
                        $html .='</div></div>
                                    <div class="col-md-12 reply-div reply-box'.$log->id.'" style="display: none;"><div class="form-group mtop15" app-field-wrapper="description"><input type="text" name="activity_reply['.$log->id.']" val="'.$log->id.'" id="description'.$log->id.'" class="form-control description_box"></div>
                                        <div class="text-right">
                                            <a href="javascript:void(0);" id="tag_employee_btn" value="'.$log->id.'" class="btn btn-success tag_employee_btn">@ Tag Someone</a>
                                            <button class="btn btn-info">Reply</button>
                                            <a href="javascript:void(0);" onclick="close_reply_activity();" class="btn btn-danger">Close</a>
                                        </div><br>
                                    </div><div class="reply-view'.$log->id.'"></div>';        
                    $html .= '</div>';

                    $i++;
                }
            }

            if(!empty($html) && !empty($last_id)){
                $json_arr = array( "html" => $html, "last_id" => $last_id);

                echo json_encode( $json_arr );
            }

       }
    }

    /* this function use for get activities reply */
    public function get_activities_reply(){
        if(!empty($_POST)){
            extract($this->input->post());

            $activity_log = array();
            $delete_url = $cut_url = "#";
            if ($section == 'lead_activity'){

                $activity_log = $this->db->query("SELECT * FROM `tblfollowupleadactivity` where id > '".$id."' and parent_id = '".$logid."' order by id asc LIMIT 5")->result();
                $cut_url = admin_url('follow_up/cut_lead_conversation/');
                $delete_url = admin_url('follow_up/delete_lead_conversation/');
            }else if($section == "enquirycall_activity"){

                $activity_log = $this->db->query("SELECT * FROM `tblenquirycall_activity` where id > '".$id."' and parent_id = '".$logid."' order by id asc LIMIT 5")->result();
                $cut_url = admin_url('enquirycall/cut_enquirycall_conversation/');
                $delete_url = admin_url('enquirycall/delete_enquirycall_conversation/');
            }else if($section == "estimate_activity"){
                
                $activity_log = $this->db->query("SELECT * FROM `tblproformainvoiceactivity` where id > '".$id."' and parent_id = '".$logid."' order by id asc LIMIT 5")->result();
                $cut_url = admin_url('follow_up/cut_estimate_conversation/');
                $delete_url = admin_url('follow_up/delete_estimate_conversation/');
            }else if($section == "designrequisition"){
                
                $activity_log = $this->db->query("SELECT * FROM `tbldesignrequisitionactivity` where id > '".$id."' and parent_id = '".$logid."' order by id asc LIMIT 5")->result();
                $cut_url = admin_url('designrequisition/cut_designrequisition_conversation/');
                $delete_url = admin_url('designrequisition/delete_designrequisition_conversation/');
            }else if($section == "design_activity"){
                
                $activity_log = $this->db->query("SELECT * FROM `tbldesignactivity` where id > '".$id."' and parent_id = '".$logid."' order by id asc LIMIT 5")->result();
                $cut_url = admin_url('designrequisition/cut_designremark_conversation/');
                $delete_url = admin_url('designrequisition/delete_designremark_conversation/');
            }else if($section == "candidate_requirement"){
                
                $activity_log = $this->db->query("SELECT * FROM `tblcandidaterequirementactivity` where id > '".$id."' and parent_id = '".$logid."' order by id asc LIMIT 5")->result();
                $cut_url = admin_url('follow_up/cut_requirement_conversation/');
                $delete_url = admin_url('follow_up/delete_requirement_conversation/');
            }else if($section == "client_activity"){
                
                $activity_log = $this->db->query("SELECT * FROM `tblfollowupclientactivity` where id > '".$id."' and parent_id = '".$logid."' order by id asc LIMIT 5")->result();
                $cut_url = admin_url('follow_up/cut_client_conversation/');
                $delete_url = admin_url('follow_up/delete_client_conversation/');
            }else if($section == "po_activity"){
                
                $activity_log = $this->db->query("SELECT * FROM `tblpurchaseorderactivity` where id > '".$id."' and parent_id = '".$logid."' order by id asc LIMIT 5")->result();
                $cut_url = admin_url('follow_up/cut_po_conversation/');
                $delete_url = admin_url('follow_up/delete_po_conversation/');
            }else if($section == "requirement_activity"){
                
                $activity_log = $this->db->query("SELECT * FROM `tblrequirmentactivity` where id > '".$id."' and parent_id = '".$logid."' order by id asc LIMIT 5")->result();
                $cut_url = admin_url('requirement/cut_requirement_conversation/');
                $delete_url = admin_url('requirement/delete_requirement_conversation/');
            }
            // krsort($activity_log);

            $html = '';
            $last_id = 0;
            if(!empty($activity_log)){
                $i = 0;
                foreach ($activity_log as $key => $log) {

                    if($i == 0){
                        
                        $html .= '<br>';
                    }
                    if ($section == 'lead_activity'){
                        $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblfollowupleadactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                    }else if($section == "enquirycall_activity"){
                        $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblenquirycall_activity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                    }else if($section == "estimate_activity"){
                        $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblproformainvoiceactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                    }else if($section == "designrequisition"){
                        $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tbldesignrequisitionactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                    }else if($section == "design_activity"){
                        $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tbldesignactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                    }else if($section == "candidate_requirement"){
                        $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblcandidaterequirementactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                    }else if($section == "client_activity"){
                        $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblfollowupclientactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                    }else if($section == "po_activity"){
                        $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblpurchaseorderactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                    }else if($section == "requirement_activity"){
                        $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblrequirmentactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                    }
                    $class = ($log->priority == 1) ? 'fa-star' : 'fa-star-o';

                    $cut = ($log->status == 2) ? 'line-throught' : '';
                    $html .= '<div class="col-md-12 replyboxdiv'.$log->id.'">
                          <div class="col-md-1"><i class="fa fa-long-arrow-right pull-right" aria-hidden="true"></i></div>
                          <div class="col-md-11">
                          <div class="panel-body1">';
                            $html .= '<div class="feed-item">
                                        <div class="date"><span class="text-has-action" data-toggle="tooltip">'._d($log->datetime).'</span></div>
                                        <div class="text '.$cut.'">
                                            <a href="#" val="'.$log->id.'" section="'.$section.'" pri="'.$log->priority.'" onclick="return false;" class="priority" ><i class="fa '.$class.'" aria-hidden="true"></i></a> ';

                                            if((get_staff_user_id() == $log->staffid) && ($log->status == 1) ){
                                                $html .= '<a href="'.$cut_url.$log->id.'" ><i class="fa fa-ban" aria-hidden="true"></i></a> ';
                                            }

                                             if(is_admin() == 1 && $ttl_reply == 0){
                                                 $html .= '<a href="'.$delete_url.$log->id.'" ><i class="fa fa-trash-o" aria-hidden="true"></i></a> ';
                                             }

                                            if($log->staffid != 0){
                                                $html .= '<a href="'.admin_url('profile/'.$log->staffid).'">'.staff_profile_image($log->staffid,array('staff-profile-xs-image pull-left mright5')).'</a>';
                                                $html .= get_employee_name($log->staffid) . ' - '. _l(str_replace("@", '<span style="color:red;">@</span>', $log->message),'',false);
                                                $html .=' <a href="#" class="reply_comment"  val="'.$log->id.'" title="Reply on activity"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>';
                                                if ($ttl_reply > 0){
                                                    $html .=' |<a href="javascript:void(0);" class="view_reply" section="'.$section.'" val="'.$log->id.'" data-type="1" data-last_id="0" > '.$ttl_reply.' Replies</a>';
                                                }
                                            }
                                    $html .='</div></div>
                                      <div class="col-md-12 reply-div reply-box'.$log->id.'" style="display: none;"><div class="form-group mtop15" app-field-wrapper="description"><input type="text" name="activity_reply['.$log->id.']" val="'.$log->id.'" id="description'.$log->id.'" class="form-control description_box"></div>
                                         <div class="text-right">
                                            <a href="javascript:void(0);" id="tag_employee_btn" value="'.$log->id.'" class="btn btn-success tag_employee_btn">@ Tag Someone</a>
                                            <button class="btn btn-info">Reply</button>
                                            <a href="javascript:void(0);" onclick="close_reply_activity();" class="btn btn-danger">Close</a>
                                         </div><br>
                                      </div><div class="reply-view'.$log->id.'"></div>';
                                
                                $i++;
                    $html .= '
                                </div>
                          </div><br>
                      </div>';
                    $last_id = $log->id;
                }
                
            if ($id == 0){
                $html .= '<div class="col-md-12" style="margin-bottom: 2%;"><div class="col-md-1"></div><a href="javascript:void(0);" class="text-center btn-sm btn-info view_more_reply replymore'.$logid.'  col-md-11" section="'.$section.'" val="'.$logid.'" last_id="'.$last_id.'"> View More Reply</a><br></div>';
            }
        }
            if(!empty($html) && !empty($last_id)){
                $json_arr = array( "html" => $html, "last_id" => $last_id);

                echo json_encode( $json_arr );
            }
        }   
    }

    /* This is for special lead activity */
    public function special_lead_activity($lead_id){

        if(!empty($_POST)){
            extract($this->input->post());

            // echo "<pre>";
            // print_r($_POST);
            // exit;
            $message = (!empty($suggestion)) ? $suggestion : $description;

            /* THIS CODE USE IN CASE OF ACTIVITY REPLY */
            $parent_id = (!empty($parent_id)) ? $parent_id : 0;
            if ($parent_id > 0){
                $message = $activity_reply[$parent_id];
            }
            if(empty($message)){
                set_alert('danger', 'Activity cannot be empty!');
                redirect($_SERVER['HTTP_REFERER']);
                die;
            }

            $ad_data = array(
                    'parent_id' => $parent_id,
                    'message' => $message,
                    'staffid' => get_staff_user_id(),
                    'date' => date('Y-m-d'),
                    'datetime' => date('Y-m-d H:i:s'),
                    'priority' => 0,
                    'status' => 1
                );
            if ($avtivity_type == 2){
                $table_id = $enquirycall_id;
                $module_id = 18;
                $tag_message = 'You taged in enquirycall activity';
                // $tag_message = 'You taged in enquirycall activity <br><small class="text-danger">Message: '.$message.'</small>';
                $action_url = "enquirycall/enquirycall_activity/".$enquirycall_id;
                $ad_data['enquirycall_id'] = $enquirycall_id;
                $this->home_model->insert('tblenquirycall_activity',$ad_data);
            }else if ($avtivity_type == 3){
                $table_id = $design_requisition_id;
                $module_id = 42;
                // $tag_message = 'You taged in design requisition activity <br><small class="text-danger">Message: '.$message.'</small>';
                $tag_message = 'You taged in design requisition activity';
                $action_url = "designrequisition/designrequisition_activity/".$design_requisition_id;
                $ad_data['designrequisition_id'] = $design_requisition_id;
                $this->home_model->insert('tbldesignrequisitionactivity',$ad_data);
            }else if ($avtivity_type == 4){
                $table_id = $estimate_id;
                $module_id = 37;
                // $tag_message = 'You taged in proforma invoice activity <br><small class="text-danger">Message: '.$message.'</small>';
                $tag_message = 'You taged in proforma invoice activity';
                $action_url = "follow_up/estimates_activity/".$estimate_id;
                $ad_data['estimate_id'] = $estimate_id;
                $this->home_model->insert('tblproformainvoiceactivity',$ad_data);
            }else{
                $table_id = $lead_id;
                $module_id = 30;
                // $tag_message = 'You taged in leads activity follow up <br><small class="text-danger">Message: '.$message.'</small>';
                $tag_message = 'You taged in leads activity follow up';
                $action_url = "follow_up/lead_activity/".$lead_id;
                $ad_data['lead_id'] = $lead_id;
                $this->home_model->insert('tblfollowupleadactivity',$ad_data);
            }        

            if (!empty($tag_staff_ids)){
                $staff_ids = explode(",", $tag_staff_ids);
                foreach ($staff_ids as $staff_id) {
                    $n_data = array(
                        'description' => $tag_message,
                        'staff_id' => $staff_id,
                        'fromuserid' => get_staff_user_id(),
                        'table_id' => $table_id,
                        'isread' => 0,
                        'module_id' => $module_id,
                        'link'  => $action_url,
                        'date' => date('Y-m-d H:i:s'),
                        'date_time' => date('Y-m-d H:i:s')
                    );

                    $this->home_model->insert('tblmasterapproval', $n_data);

                    //Sending Mobile Intimation
                    $token = get_staff_token($staff_id);
                    $title = 'Schach';
                    $message = $tag_message;
                    sendFCM($message, $title, $token, $page = 2);
                }
            }

            set_alert('success', 'Activity Added successfully');
            redirect($_SERVER['HTTP_REFERER']);
        }    
        $enquirycall_id = value_by_id('tblleads',$lead_id,'enquirycall_id');
        $designrequision_data = $this->db->query("SELECT id FROM `tbldesignrequisition` WHERE `enquirycall_id`='".$enquirycall_id."' ")->row();
        $enquirycall_data = $this->db->query("SELECT `id`,`company_name`,`clientid` FROM `tblenquirycall` WHERE `id`='".$enquirycall_id."' ")->row();
        $designrequision_id = (!empty($designrequision_data)) ? $designrequision_data->id : 0;
        $estimate_data = $this->db->query("SELECT id FROM `tblestimates` WHERE `lead_id`='".$lead_id."' ")->row();
        $estimate_id = (!empty($estimate_data)) ? $estimate_data->id : 0;

        $data['lead_activity_log'] = $this->db->query("SELECT * FROM `tblfollowupleadactivity` where lead_id = '".$lead_id."' and parent_id = '0' order by id ASC")->result();
        $data['call_activity_log'] = $this->db->query("SELECT * FROM `tblenquirycall_activity` where enquirycall_id = '".$enquirycall_id."' and parent_id = '0' order by id ASC")->result();
        $data['design_activity_log'] = $this->db->query("SELECT * FROM `tbldesignrequisitionactivity` where designrequisition_id = '".$designrequision_id."' and parent_id = '0' order by id ASC")->result();
        $data['estimate_activity_log'] = $this->db->query("SELECT * FROM `tblproformainvoiceactivity` where estimate_id = '".$estimate_id."' and `parent_id`='0' order by id ASC")->result();
        $data["lead_number"] = value_by_id('tblleads',$lead_id,'leadno');
        $data["estimate_number"] = value_by_id('tblestimates',$estimate_id,'number');
        $data["lead_id"] = $lead_id;
        $data["designrequision_id"] = $designrequision_id;
        $data["estimate_id"] = $estimate_id;
        $data["enquirycall_id"] = $enquirycall_id;
        $data["title"] = "Special Lead Activity";
        
        $this->load->view('admin/follow_up/special_lead_activity', $data);
    }
}
