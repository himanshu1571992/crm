<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Designrequisition extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("home_model");
    }

    /* List all  */
    public function index()
    {
        check_permission(393,'view');
        $data['section'] = (!empty($_GET['section'])) ? $_GET['section'] : 1;
        $where = "id > 0 ";
        $where1 = "id > 0 AND status=1";
        if(!empty($_POST)){
            extract($this->input->post());
            $data['section'] = $section;
            if ($section == 1){
                if(!empty($f_date) && !empty($t_date)){
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;

                    $where .= " and date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
                }
                if (isset($status) && strlen($status) > 0){
                    $data['status'] = $status;
                    $where .= " and status = '".$status."'";
                }
            }elseif ($section == 2) {
                if(!empty($f_date) && !empty($t_date)){
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;

                    $where1.= " and date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
                }
                if (isset($status) && strlen($status) > 0){
                    $data['status'] = $status;
                    if ($status == 3){
                        $where1 .= " and design_status = 0 and show_status NOT IN (3,4)";
                    }elseif($status == 0){
                        $where1 .= " and design_status = 0 and show_status = 3";
                    }else{
                        $where1 .= " and design_status = '".$status."'";
                    }
                }
            }
        }

        /* all design requisition list */
        $data['drequisition_list'] = $this->db->query("SELECT * FROM `tbldesignrequisition` WHERE $where ORDER BY id DESC")->result();
        /* all design department list */
        $data['design_departmentlist'] = $this->db->query("SELECT * FROM `tbldesignrequisition` WHERE $where1 ORDER BY id DESC")->result();
        $data['title'] = "Design Requisition List";
        $this->load->view('admin/designrequisition/list', $data);
    }

    public function add($id='', $stype=""){
        
        if ($this->input->post()) {
            $this->load->model("Designrequisition_model");

            $post_data = $this->input->post();
            if (isset($post_data["sendapproval"]) && empty($post_data["assignproductionid"])){
                set_alert('warning', "Please select assign parson");
                redirect(admin_url('designrequisition/add'));
            }
            if ($id != '' && $stype == "") {
                $update_id = $this->Designrequisition_model->update($id, $post_data);
                if ($update_id) {
                    handle_multi_attachments($id,'design_requisition');
                    set_alert('success', "Design Requisition update successfully");
                    redirect(admin_url('designrequisition'));
                }
            }else{
                $insert_id = $this->Designrequisition_model->add($post_data);
                if ($insert_id) {
                    handle_multi_attachments($insert_id,'design_requisition');
                    set_alert('success', "Design Requisition added successfully");
                    redirect(admin_url('designrequisition'));
                }
            }
        }

        if ($id !="" && $stype == ""){
            check_permission(393,'edit');
            $data['title'] = "Edit Design Requisition";
            $data["drequisition_info"] = $this->home_model->get_row("tbldesignrequisition", array("id" => $id), array("*"));
            $data["drequisition_remarks"] = $this->home_model->get_result("tbldesignrequisitionremark", array("designrequisition_id" => $id), array("*"));
            $data["design_id"] = "DR-".str_pad($id, 3, '0', STR_PAD_LEFT);
        }else{
            check_permission(393,'create');
            $data['title'] = "Add Design Requisition";
            $last_id = $this->db->query("SELECT COUNT(id) as last_id FROM `tbldesignrequisition`")->row()->last_id;
            $data["design_id"] = "DR-".str_pad($last_id+1, 4, '0', STR_PAD_LEFT);
        }

        /* this is for assign staff list */
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='12' ORDER BY st.name ASC")->result_array();
        $i=0;
        foreach($Staffgroup as $singlestaff)
        {
            $i++;
            $stafff[$i]['id']=$singlestaff['id'];
            $stafff[$i]['name']=$singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."' ORDER BY s.firstname ASC")->result_array();
            $stafff[$i]['staffs']=$query;
        }
        $data['allStaffdata'] = $stafff;

        /* this is for client list */
        $data['client_branch_data'] = $this->db->query("SELECT `client_branch_name`,`userid`,`email_id`,`phone_no_1` FROM `tblclientbranch` WHERE `active`=1 AND `client_branch_name` !='' ORDER BY `client_branch_name` ASC")->result();
        $data["staff_list"] = $this->db->query("SELECT * FROM `tblstaff` WHERE `active` = 1 ORDER BY firstname ASC ")->result();
        $data["enquirycall_id"] = ($stype == "enquirycall") ? $id : 0;
        $this->load->view('admin/designrequisition/add', $data);
    }

    public function view($id){
        check_permission(393,'view');

        $data["title"] = "View Design Requisition";
        $data["section"] = "View";

        /* This code use for revert notification */
        $notification_type = $this->uri->segment(5);
        if ($notification_type == 'revert'){
            
            /* this is for check notification uodate */
            $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$id."' and staff_id = '".get_staff_user_id()."' and module_id = 43")->row();
            if (!empty($chk_notification)){
                $this->home_model->delete("tblmasterapproval", array("id" => $chk_notification->id));
            }
        }
        
        $drequisition_info = $this->home_model->get_row("tbldesignrequisition", array("id" => $id), array("*"));
        if (empty($drequisition_info)){
            redirect(admin_url('Designrequisition'));
        }
        $data["drequisition_info"] = $drequisition_info;
        $data["drequisition_remarks"] = $this->home_model->get_result("tbldesignrequisitionremark", array("designrequisition_id" => $id), array("*"));
        $data["design_id"] = "DR-".str_pad($id, 3, '0', STR_PAD_LEFT);
        $this->load->view('admin/designrequisition/view', $data);
    }

    /* this is a delete function use for delete design requisition */
    public function delete($id){
        check_permission(393,'delete');

        $chk_data = $this->db->query("SELECT * FROM `tbldesignrequisition` WHERE `id` = $id")->row();
        if (!empty($chk_data)){
            $response = $this->home_model->delete("tbldesignrequisition", array("id" => $id));
            if ($response){
                $getfile = $this->db->query("SELECT file_name FROM `tblfiles` WHERE `rel_id`= $id AND `rel_type` = 'design_requisition'")->row();
                if (!empty($getfile)){
                    $path = get_upload_path_by_type('design_requisition') . $id . '/'.$getfile->file_name;
                    unlink($path);
                    $this->home_model->delete("tblfiles", array("rel_id"=> $id, "rel_type"=> 'design_requisition'));
                }

                $chk_remarkdata = $this->db->query("SELECT * FROM `tbldesignrequisitionremark` WHERE `designrequisition_id` = $id")->result();
                if (!empty($chk_remarkdata)){
                   foreach ($chk_remarkdata as $value) {
                      if (!empty($data->files)){
                          $filesdecode = json_decode($data->files, TRUE);
                          if (!empty($filesdecode)){
                             foreach ($filesdecode as $file) {
                                 $path = get_upload_path_by_type('design_requisition') . $id . '/'.$file;
                                 unlink($path);
                                 $this->home_model->delete("tbldesignrequisition", array("designrequisition_id" => $id));
                             }
                          }
                      }
                   }
                }
                $this->home_model->delete("tbldesignrequisitionapproval", array("designrequisition_id" => $id));
                $this->home_model->delete("tbldesignrequisitionactivity", array("designrequisition_id" => $id));
                set_alert('success', "Design Requisition remove successfully");
                redirect(admin_url('designrequisition'));
            }else{
              set_alert('danger', "Something Went wrong.");
              redirect(admin_url('designrequisition'));
            }
        }
    }

    public function designrequisition_approval($id){

        if ($this->input->post()){
            $data = $this->input->post();
            
            $ad_data = array(
                'approvereason' => $data["remark"],
                'approve_status' => $data["submit"],
                'created_at' => date('Y-m-d H:i:s')
            );
            $response = $this->home_model->update('tbldesignrequisitionapproval', $ad_data,array('designrequisition_id'=>$id,'staff_id'=>get_staff_user_id()));
            if ($response){

                update_masterapproval_single(get_staff_user_id(),41,$id,$data["submit"]);
                update_masterapproval_all(41,$id,$data["submit"]);

                $this->home_model->update('tbldesignrequisition', array("status" => $data["submit"]),array('id'=>$id));
                if ($data["submit"] == 1){
                    set_alert('success', "Design Requisition approvad successfully");
                }else if($data["submit"] == 4){
                    set_alert('success', "Design Requisition Status Update successfully");
                }else if($data["submit"] == 5){
                    set_alert('success', "Design Requisition On Hold successfully");
                }else{
                    $this->home_model->update('tbldesignrequisition', array("show_status" => 2),array('id'=>$id));
                    set_alert('danger', "Design Requisition rejected successfully");
                }
                redirect(admin_url('approval/notifications'));
            }
        }

        $data['title'] = "Design Requisition For Approval";
        $data["section"] = "approval";
        $data["design_id"] = "DR-".str_pad($id, 3, '0', STR_PAD_LEFT);
        $data["drequisition_info"] = $this->home_model->get_row("tbldesignrequisition", array("id" => $id), array("*"));
        $data["drequisition_remarks"] = $this->home_model->get_result("tbldesignrequisitionremark", array("designrequisition_id" => $id), array("*"));
        $data["check_approval"] = $this->db->query("SELECT COUNT(id) as count FROM tbldesignrequisitionapproval WHERE `designrequisition_id` = '".$id."' AND `approve_status` = 1")->row();
        $data['appvoal_info'] = $this->db->query("SELECT * from tbldesignrequisitionapproval where designrequisition_id = '".$id."' and staff_id = '".get_staff_user_id()."' and approve_status != 0 ")->row();
        $data['approval_details'] = $this->db->query("SELECT * from tblmasterapproval where module_id = '41' and table_id = '".$id."' ")->result();
        
        $this->load->view('admin/designrequisition/view', $data);
    }

    public function get_assign_status($id, $section) {
        if ($section == 'designsubmission'){
            $getapproval = $this->db->query("SELECT * FROM `tblmasterapproval`  where table_id = '" . $id . "' and module_id = 43")->result();
        }else{
            $getapproval = $this->db->query("SELECT * FROM `tblmasterapproval`  where table_id = '" . $id . "' and module_id = 41")->result();
            if (empty($getapproval)){
                $added_by = value_by_id_empty("tbldesignrequisition", $id, "added_by");
                $approvestatus = value_by_id_empty("tbldesignrequisition", $id, "status");
                if (!empty($added_by) && $approvestatus == 1){
                    $staff_name = get_employee_fullname($added_by);
                    echo '<div class="row"><div class="col-md-12"><h2 class="text-center text-success">Direct Approved By '.$staff_name.'</h2></div></div>';
                    exit;
                }
            }
        }
        
        echo '<div class="form-group">
                                    <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                        <thead>
                                            <tr>
                                                <td>S.No</td>
                                                <td>Name</td>
                                                <td>Action</td>
                                                <td>Read At</td>
                                            </tr>
                                        </thead>
                                        <tbody>';
        $status_arr = array('<p class="text-warning">Pending</p>' => '0', '<p class="text-success">Approved</p>' => '1', '<p class="text-danger">Rejected</p>' => '2', '<p class="text-danger" style="color:brown">Reconciliation</p>' => '4', '<p style="color: #e8bb0b;" class="text-pending">Hold</p>' => '5');
        if (!empty($getapproval)){
            foreach ($getapproval as $key => $value) {
                $readdate = ($value->isread == 1) ? _d($value->readdate) : "--";
                echo '<tr>
                        <td>'.++$key.'</td>
                        <td>'.get_employee_fullname($value->staff_id).'</td>
                        <td>'.array_search($value->approve_status, $status_arr).'</td>
                        <td>'.$readdate.'</td>
                     </tr>';
            }
        }else{
            echo '<tr><td colspan="4" class="text-center">No Record Found</td><tr>';
        }
        echo'</tbody></table></div>';
    }

    /* this is for design requisition call activity */
    public function designrequisition_activity($id){
        $data['title'] = 'Design Requisition Activities';
        $reinfo = $this->home_model->get_row("tbldesignrequisition", array("id" => $id), array("*"));
        if (!empty($reinfo)){
           if ($reinfo->type == 1){
              $data["parsonname"] = get_employee_name($reinfo->staff_id);
           }else{
              $data["parsonname"] = $reinfo->client_name;
              if ($reinfo->client_id > 0){
                  $data["parsonname"] = client_info($reinfo->client_id)->client_branch_name;
              }
           }
        }
        if(!empty($_POST)){
            extract($this->input->post());
            
            /* this is for check notification uodate */
            $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$id."' and staff_id = '".get_staff_user_id()."' and module_id = 42")->result();
            if (!empty($chk_notification)){
                foreach ($chk_notification as $value) {
                    $this->home_model->update("tblmasterapproval", array("status" => 1), array("id" => $value->id));
                }
            }
            if(!empty($important_search)){
                 $data['activity_log'] = $this->db->query("SELECT * FROM `tbldesignrequisitionactivity` where designrequisition_id = '".$id."' and priority = '1' and parent_id = '0' order by id asc")->result();
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
                          'designrequisition_id' => $id,
                          'parent_id' => $parent_id,
                          'message' => $message,
                          'staffid' => get_staff_user_id(),
                          'date' => date('Y-m-d'),
                          'datetime' => date('Y-m-d H:i:s'),
                          'priority' => 0,
                          'status' => 1
                      );

                $insert_id = $this->home_model->insert('tbldesignrequisitionactivity',$ad_data);
                if (!empty($tag_staff_ids)){
                   $staff_ids = explode(",", $tag_staff_ids);
                   foreach ($staff_ids as $staff_id) {
                       $n_data = array(
                            'description' => 'You taged in design requisition activity',
                            'staff_id' => $staff_id,
                            'fromuserid' => get_staff_user_id(),
                            'table_id' => $id,
                            'isread' => 0,
                            'module_id' => 42,
                            'link'  => "designrequisition/designrequisition_activity/".$id,
                            'date' => date('Y-m-d H:i:s'),
                            'date_time' => date('Y-m-d H:i:s')
                        );

                        $this->home_model->insert('tblmasterapproval', $n_data);

                        //Sending Mobile Intimation
                            $token = get_staff_token($staff_id);
                            $title = 'Schach';
                            $message = 'You taged in design requisition activity';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                   }
                }

                set_alert('success', 'Activity Added successfully');
                redirect(admin_url('designrequisition/designrequisition_activity/' . $id));
            }
        }else{
            $data['activity_log'] = $this->db->query("SELECT * FROM `tbldesignrequisitionactivity` where designrequisition_id = '".$id."' and parent_id = '0' order by id desc LIMIT 10")->result();
        }
        $data['design_requisition_id'] = $id;
        $data['suggestion_info'] = $this->db->query("SELECT * FROM `tblsuggestion` where status = '1'")->result();
        krsort($data['activity_log']);
        $this->load->view('admin/designrequisition/designrequisition_activity', $data);
    }

    /* this is for design activity */
    public function design_activity($id){
        $data['title'] = 'Design Activities';
        $data["parsonname"] = "--";
        $design_remark = $this->db->query("SELECT `drawing_id`,`drawing_name` FROM `tbldesignrequisitionremark` WHERE `activity_id` = '".$id."' ")->row();
        if (!empty($design_remark)){
            $data["parsonname"] = $design_remark->drawing_id.' - '.cc($design_remark->drawing_name);
        }

        if(!empty($_POST)){
            extract($this->input->post());

            /* this is for check notification uodate */
            $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$id."' and staff_id = '".get_staff_user_id()."' and module_id = 48")->result();
            if (!empty($chk_notification)){
                foreach ($chk_notification as $value) {
                    $this->home_model->update("tblmasterapproval", array("status" => 1), array("id" => $value->id));
                }
            }
            if(!empty($important_search)){
                 $data['activity_log'] = $this->db->query("SELECT * FROM `tbldesignactivity` where remark_activity_id = '".$id."' and priority = '1' and parent_id = '0' order by id asc")->result();
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
                          'remark_activity_id' => $id,
                          'parent_id' => $parent_id,
                          'message' => $message,
                          'staffid' => get_staff_user_id(),
                          'date' => date('Y-m-d'),
                          'datetime' => date('Y-m-d H:i:s'),
                          'priority' => 0,
                          'status' => 1
                      );

                $insert_id = $this->home_model->insert('tbldesignactivity',$ad_data);
                if (!empty($tag_staff_ids)){
                   $staff_ids = explode(",", $tag_staff_ids);
                   foreach ($staff_ids as $staff_id) {
                       $n_data = array(
                            'description' => 'You taged in design activity',
                            'staff_id' => $staff_id,
                            'fromuserid' => get_staff_user_id(),
                            'table_id' => $id,
                            'isread' => 0,
                            'module_id' => 48,
                            'link'  => "designrequisition/design_activity/".$id,
                            'date' => date('Y-m-d H:i:s'),
                            'date_time' => date('Y-m-d H:i:s')
                        );
                        $this->home_model->insert('tblmasterapproval', $n_data);

                        //Sending Mobile Intimation
                            $token = get_staff_token($staff_id);
                            $title = 'Schach';
                            $message = 'You taged in design activity';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                   }
                }

                set_alert('success', 'Activity Added successfully');
                redirect(admin_url('designrequisition/design_activity/' . $id));
            }
        }else{
            $data['activity_log'] = $this->db->query("SELECT * FROM `tbldesignactivity` where remark_activity_id = '".$id."' and parent_id = '0' order by id desc LIMIT 5")->result();
        }
        $data['design_activity_id'] = $id;
        $data['suggestion_info'] = $this->db->query("SELECT * FROM `tblsuggestion` where status = '1'")->result();
        krsort($data['activity_log']);
        $this->load->view('admin/designrequisition/design_activity', $data);
    }

    public function cut_designrequisition_conversation($id) {

        $success = $this->home_model->update('tbldesignrequisitionactivity',array('status' => 2),array('id'=>$id));
        if ($success) {
            set_alert('success', 'Design Requisition Activity Conversation Removed');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function cut_designremark_conversation($id) {

        $success = $this->home_model->update('tbldesignactivity',array('status' => 2),array('id'=>$id));
        if ($success) {
            set_alert('success', 'Design Activity Conversation Removed');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete_designrequisition_conversation($id) {

        $success = $this->home_model->delete('tbldesignrequisitionactivity',array('id'=>$id));
        if ($success) {
            set_alert('success', _l('deleted', 'conversation'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete_designremark_conversation($id) {

        $success = $this->home_model->delete('tbldesignactivity',array('id'=>$id));
        if ($success) {
            set_alert('success', _l('deleted', 'conversation'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function udpate_designrequisition_priority() {
        if (!empty($_POST)) {
            extract($this->input->post());

            $pri = ($priority == 1) ? 0 : 1;
            $this->home_model->update('tbldesignrequisitionactivity', array('priority' => $pri), array('id' => $id));
        }
    }

    public function udpate_designremark_priority() {
        if (!empty($_POST)) {
            extract($this->input->post());

            $pri = ($priority == 1) ? 0 : 1;
            $this->home_model->update('tbldesignactivity', array('priority' => $pri), array('id' => $id));
        }
    }

    public function get_last_designrequisition_conversion(){
        if (!empty($_POST)) {
               extract($this->input->post());

               $activity_log = $this->db->query("SELECT * FROM `tbldesignrequisitionactivity` where id < '" . $id . "' and designrequisition_id = '" . $designrequisition_id . "' and `parent_id` = '0' order by id desc LIMIT 10")->result();
               krsort($activity_log);
               $html = '';
               if (!empty($activity_log)) {
                   $i = 0;
                   foreach ($activity_log as $key => $log) {

                       if ($i == 0) {
                           $last_id = $log->id;
                       }

                       $class = ($log->priority == 1) ? 'fa-star' : 'fa-star-o';
                       $cut = ($log->status == 2) ? 'line-throught' : '';
                       $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tbldesignrequisitionactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                       
                       $html .= '<div class="col-md-12 replyboxdiv'.$log->id.'">';
                            $html .= '<div class="feed-item">
                                        <div class="date"><span class="text-has-action" data-toggle="tooltip">' . _dt($log->datetime) . '</span></div>
                                        <div class="text ' . $cut . '">
                                            <a href="#" val="'.$log->id.'" pri="'.$log->priority.'" onclick="return false;" class="priority" ><i class="fa ' . $class . '" aria-hidden="true"></i></a>';
                                            if ((get_staff_user_id() == $log->staffid) && ($log->status == 1)) {
                                                $html .= ' <a href="' . admin_url('designrequisition/cut_designrequisition_conversation/' . $log->id) . '" ><i class="fa fa-ban" aria-hidden="true"></i></a>';
                                            }
                                            if (is_admin() == 1 && $ttl_reply == 0) {
                                                $html .= ' <a href="' . admin_url('designrequisition/delete_designrequisition_conversation/' . $log->id) . '" ><i class="fa fa-trash-o" aria-hidden="true"></i></a> ';
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

               if (!empty($html) && !empty($last_id)) {
                   $json_arr = array("html" => $html, "last_id" => $last_id);
                   echo json_encode($json_arr);
               }
           }
    }

    public function get_last_designremark_conversion(){
        if (!empty($_POST)) {
               extract($this->input->post());

               $activity_log = $this->db->query("SELECT * FROM `tbldesignactivity` where id < '" . $id . "' and remark_activity_id = '" . $design_activity_id . "' order by id desc LIMIT 10")->result();
               krsort($activity_log);
               $html = '';
               if (!empty($activity_log)) {
                   $i = 0;
                   foreach ($activity_log as $key => $log) {

                       if ($i == 0) {
                           $last_id = $log->id;
                       }

                       $class = ($log->priority == 1) ? 'fa-star' : 'fa-star-o';
                       $cut = ($log->status == 2) ? 'line-throught' : '';
                       $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tbldesignactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                       
                       $html .= '<div class="col-md-12 replyboxdiv'.$log->id.'">';
                            $html .= '<div class="feed-item">
                                        <div class="date"><span class="text-has-action" data-toggle="tooltip">' . _dt($log->datetime) . '</span></div>
                                        <div class="text ' . $cut . '">
                                            <a href="#" val="'.$log->id.'" pri="'.$log->priority.'" onclick="return false;" class="priority" ><i class="fa ' . $class . '" aria-hidden="true"></i></a>';
                                            if ((get_staff_user_id() == $log->staffid) && ($log->status == 1)) {
                                                $html .= ' <a href="' . admin_url('designrequisition/cut_designremark_conversation/' . $log->id) . '" ><i class="fa fa-ban" aria-hidden="true"></i></a>';
                                            }
                                            if (is_admin() == 1 && $ttl_reply == 0) {
                                                $html .= ' <a href="' . admin_url('designrequisition/delete_designremark_conversation/' . $log->id) . '" ><i class="fa fa-trash-o" aria-hidden="true"></i></a> ';
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

               if (!empty($html) && !empty($last_id)) {
                   $json_arr = array("html" => $html, "last_id" => $last_id);
                   echo json_encode($json_arr);
               }
           }
    }
    public function get_production_remark($id){
        $html = '';
        $getremarks = $this->home_model->get_result("tbldesignrequisitionremark", array("designrequisition_id" => $id), array("*"));
        if (!empty($getremarks)){
            $chkprocess = $this->db->query("SELECT COUNT(*) as ttl_row FROM `tbldesignrequisitionremark` WHERE `designrequisition_id` = ".$id." AND `complete_by_design` = 1")->row()->ttl_row;
            $count = count($getremarks);
            if ($count > 0){
                $percentage = round(($chkprocess / $count) * 100); // 20
            }else{
                $percentage = 0;
            }
    ?>
            <div class="col-md-12">
                <div class="progress">
                    <input type="hidden" class="totalcomplete" value="<?php echo $chkprocess; ?>">
                    <input type="hidden" class="totalstep" value="<?php echo $count; ?>">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage; ?>%">
                        <span class="process-per"><?php echo $percentage; ?></span>%
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Drawing ID</th>
                                <th>Drawing Name</th>
                                <th>Description</th>
                                <th>Remark</th>
                                <th>Uploaded Images</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($getremarks as $key => $value) { ?>
                              <tr>
                                  <td><?php echo ++$key; ?></td>
                                  <td><?php echo (!empty($value->drawing_id)) ? cc($value->drawing_id) : '--'; ?></td>
                                  <td><?php echo (!empty($value->drawing_name)) ? cc($value->drawing_name) : '--'; ?></td>
                                  <td><?php echo (!empty($value->description)) ? cc($value->description) : '--'; ?></td>
                                  <td><?php echo (!empty($value->remark)) ? cc($value->remark) : '--'; ?></td>
                                  <td>
                                      <div class="form-group">
                                         <?php
                                              if (!empty($value->files)){
                                                  $filesdata = json_decode($value->files);
                                                  foreach ($filesdata as $k => $file) {
                                                      $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                      if (in_array($extension, ["jpg", "png"])){
                                         ?>
                                                        <a href="<?php echo base_url('uploads/design_requisition') . "/" . $file; ?>" target="_blank"><img src="<?php echo base_url('uploads/design_requisition') ."/". $file; ?>" width="50px" height="50px" style="border: 1px solid;"></a>
                                                   <?php }else{ ?>
                                                         <a href="<?php echo base_url('uploads/design_requisition') . "/" . $file; ?>" target="_blank"><i class="fa-2x fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                   <?php  }
                                                   }
                                               }
                                          ?>
                                      </div>
                                  </td>
                                  <td>
                                      <input type="hidden" name="productionremark[<?php echo $key; ?>][remark_id]" value="<?php echo $value->id; ?>">
                                      <input type="checkbox" class="processcheck" name="productionremark[<?php echo $key; ?>][complete]" <?php echo ($value->complete_by_design == 1) ? 'checked':''; ?>>
                                      <a href="<?php echo admin_url('designrequisition/design_activity/' . $value->activity_id); ?>" target="_blank" class="btn-sm btn-info" title="activity" >Activity</a>
                                  </td>
                              </tr>
                          <?php } ?>
                          </tbody>
                      </table>
                  </div>
              </div>
    <?php
        }
    }

    public function update_remark(){
        if(!empty($_POST)){
            extract($this->input->post());
            if (isset($productionremark)){
                foreach ($productionremark as $key => $value) {
                    if (isset($value["complete"]) && $value["complete"] == 'on'){
                        $status = 1;
                    }else{
                        $status = 0;
                    }
                    $this->home_model->update("tbldesignrequisitionremark", array("complete_by_design" => $status), array("id" => $value["remark_id"]));
                }
            }
            set_alert('success', 'Remark update successfully');
        }
        redirect(admin_url('designrequisition?section=2'));
    }

    /* this function use for get design submission */
    public function get_design_submission($id){
        $data["title"] = "Add Design Submission";
        $data['design_requisition_id'] = $id;
        $data['checkdesign'] = $this->db->query("SELECT COUNT(*) as ttl_row FROM `tbldesignsubmission` WHERE `designrequisition_id` = ".$id." AND `status` IN ('0','1')")->row()->ttl_row;
        if ($data['checkdesign'] > 0){
           $data["title"] = "List Design Submission";
        }

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='12'")->result_array();
        $i=0;
        foreach($Staffgroup as $singlestaff)
        {
            $i++;
            $stafff[$i]['id']=$singlestaff['id'];
            $stafff[$i]['name']=$singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."' ORDER BY s.firstname ASC")->result_array();
            $stafff[$i]['staffs']=$query;
        }
        $data['allStaffdata'] = $stafff;
        $data["drequisition_remarks"] = $this->home_model->get_result("tbldesignrequisitionremark", array("designrequisition_id" => $id), array("*"));
        $data['designsubmission_list'] = $this->db->query("SELECT * FROM `tbldesignsubmission` WHERE `designrequisition_id` ='".$id."' ORDER BY id DESC")->result();
        $this->load->view('admin/designrequisition/add_design_submission', $data);
    }

    /* this function use for add design Submission */
    public function add_design_submission(){
      if(!empty($_POST)){
          $this->load->model("Designrequisition_model");

          $post_data = $this->input->post();
          $insert_id = $this->Designrequisition_model->addDesignSubmission($post_data);
          if ($insert_id) {
              set_alert('success', "Design Submission added successfully");
              redirect(admin_url('designrequisition?section=2'));
          }
      }
    }
    /* this function use for add remark upload Submission by design */
    public function add_remark_upload(){
      if(!empty($_POST)){
          $this->load->model("Designrequisition_model");

          $post_data = $this->input->post();
          $response = $this->Designrequisition_model->upload_remark_drawing($post_data);
          if ($response) {
              set_alert('success', "Design remark upload successfully");
              redirect(admin_url('designrequisition?section=2'));
          }
      }
    }

    public function designsubmission_approval($id){

        $dsubmission_info = $this->home_model->get_row("tbldesignsubmission", array("id" => $id), array("*"));
        if (empty($dsubmission_info)){
            set_alert('warning', "Invalid Record");
            redirect(admin_url('approval/notifications'));
        }
        if ($this->input->post()){
            $data = $this->input->post();

            $ad_data = array(
                'approvereason' => $data["remark"],
                'approve_status' => $data["submit"],
                'created_at' => date('Y-m-d H:i:s')
            );
            $response = $this->home_model->update('tbldesignsubmissionapproval', $ad_data,array('designsubmission_id'=>$id,'staff_id'=>get_staff_user_id()));
            if ($response){

                update_masterapproval_single(get_staff_user_id(),43,$id,$data["submit"]);
                update_masterapproval_all(43,$id,$data["submit"]);

                /* THIS CODE USE FOR REVERT NOTIFICATION */
                $chk_sender_details = $this->db->query("SELECT `fromuserid` FROM `tblmasterapproval` WHERE `table_id` = '".$id."' and `staff_id` = '".get_staff_user_id()."' and `module_id` = 43 ORDER BY id DESC")->row();
                if (!empty($chk_sender_details)){
                    $staff_id = $chk_sender_details->fromuserid;
                    $n_data = array(
                        'description' => 'Your Design Submission Request is -'.get_approve_status($data["submit"]),
                        'staff_id' => $staff_id,
                        'fromuserid' => get_staff_user_id(),
                        'table_id' => $id,
                        'isread' => 0,
                        'module_id' => 43,
                        'link'  => "designrequisition/view/".$id."/revert",
                        'date' => date('Y-m-d H:i:s'),
                        'date_time' => date('Y-m-d H:i:s')
                    );

                    $this->home_model->insert('tblmasterapproval', $n_data);

                    //Sending Mobile Intimation
                    $token = get_staff_token($staff_id);
                    $title = 'Schach';
                    $message = 'Your Design Submission Request is -'.get_approve_status($data["submit"]);
                    sendFCM($message, $title, $token, $page = 2);
                }

                $this->home_model->update('tbldesignsubmission', array("status" => $data["submit"]),array('id'=>$id));
                $this->home_model->update('tbldesignrequisition', array("design_status" => $data["submit"]),array('id'=>$dsubmission_info->designrequisition_id));
                if ($data["submit"] == 1){
                    $this->home_model->update('tbldesignrequisition', array("show_status" => 4),array('id'=>$dsubmission_info->designrequisition_id));
                    set_alert('success', "Design Submission approvad successfully");
                }else{
                    set_alert('danger', "Design Submission rejected successfully");
                }

                redirect(admin_url('approval/notifications'));
            }
        }

        $data['title'] = "Design Requisition";
        $data["section"] = "designapproval";
        $data["dsubmission_info"] = $dsubmission_info;
        $data["design_id"] = "DR-".str_pad($id, 3, '0', STR_PAD_LEFT);
        $data["drequisition_info"] = $this->home_model->get_row("tbldesignrequisition", array("id" => $dsubmission_info->designrequisition_id), array("*"));
        $data["drequisition_remarks"] = $this->home_model->get_result("tbldesignrequisitionremark", array("designrequisition_id" => $dsubmission_info->designrequisition_id), array("*"));
        $data["check_approval"] = $this->db->query("SELECT COUNT(id) as count FROM tbldesignsubmissionapproval WHERE `designsubmission_id` = '".$id."' AND `approve_status` = 1")->row();
        $this->load->view('admin/designrequisition/view', $data);
    }

    public function convert_to_master($design_req_id){

        if ($this->input->post()) {
            $this->load->model("Designrequisition_model");

            $post_data = $this->input->post();
            $insert_id = $this->Designrequisition_model->convert_to_master($design_req_id, $post_data);
            if ($insert_id) {
                set_alert('success', "Design Master converted successfully");
                redirect(admin_url('designrequisition'));
            }else{
                set_alert('danger', "something went wrong.");
                redirect(admin_url('designrequisition/convert_to_master/'.$design_req_id));
            }
        }

        $data['title'] = "Convert To Master";
        $data["design_id"] = "DR-".str_pad($design_req_id, 3, '0', STR_PAD_LEFT);
        $data["drequisition_info"] = $this->home_model->get_row("tbldesignrequisition", array("id" => $design_req_id), array("*"));
        $data["submission_info"] = $this->home_model->get_row("tbldesignsubmission", array("designrequisition_id" => $design_req_id, "status"=>1), array("drawing_name, drawing_id"));
        $data["drequisition_remarks"] = $this->home_model->get_result("tbldesignrequisitionremark", array("designrequisition_id" => $design_req_id), array("*"));

        /* this is for assign staff list */
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='12'")->result_array();
        $i=0;
        foreach($Staffgroup as $singlestaff)
        {
            $i++;
            $stafff[$i]['id']=$singlestaff['id'];
            $stafff[$i]['name']=$singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."' ORDER BY s.firstname ASC")->result_array();
            $stafff[$i]['staffs']=$query;
        }
        $data['allStaffdata'] = $stafff;

        $this->load->view('admin/designrequisition/addmasterdesign', $data);
    }

    /*this function use for design master approval */
    public function design_master_approval($id){
      $designmaster_info = $this->home_model->get_row("tbldesignmaster", array("id" => $id), array("*"));
      if (empty($designmaster_info)){
          set_alert('warning', "Invalid Record");
          redirect(admin_url('approval/notifications'));
      }
      if ($this->input->post()){
          $data = $this->input->post();

          $ad_data = array(
              'approvereason' => $data["remark"],
              'approve_status' => $data["submit"],
              'created_at' => date('Y-m-d H:i:s')
          );
          $response = $this->home_model->update('tbldesignmasterapproval', $ad_data,array('designmaster_id'=>$id,'staff_id'=>get_staff_user_id()));
          if ($response){

              update_masterapproval_single(get_staff_user_id(),46,$id,$data["submit"]);
              update_masterapproval_all(46,$id,$data["submit"]);

              if ($data["submit"] == 1){
                  $this->home_model->update('tbldesignmaster', array("date" => date("Y-m-d"), "status" => 1, "approved_by" => get_staff_user_id()),array('id'=>$id));
                  $this->home_model->update('tbldesignrequisition', array("show_status" => 4),array('id'=>$dsubmission_info->designrequisition_id));
                  set_alert('success', "Design master approvad successfully");
              }else{
                  $this->home_model->delete("tbldesignmaster", array('id'=>$id));
                  $this->home_model->delete("tbldesignmasterapproval", array('designmaster_id'=>$id));
                  $this->home_model->delete("tblmasterapproval", array('table_id'=>$id, 'module_id'=>46));
                  set_alert('danger', "Design master rejected successfully");
              }
              redirect(admin_url('approval/notifications'));
          }
      }

      $data['title'] = "Design Master Approval";
      $data["dsubmission_info"] = $designmaster_info;
      $data["check_approval"] = $this->db->query("SELECT COUNT(id) as count FROM tbldesignsubmissionapproval WHERE `designsubmission_id` = '".$id."' AND `approve_status` = 1")->row();
      $this->load->view('admin/designrequisition/design_master_approval', $data);
    }

    public function design_master_list(){
      $where = "id > 0 and status=1";
      if(!empty($_POST)){
          extract($this->input->post());

          if(!empty($f_date) && !empty($t_date)){
              $data['f_date'] = $f_date;
              $data['t_date'] = $t_date;

              $where .= " and date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
          }
      }

      /* all design master list */
      $data['designmaster_list'] = $this->db->query("SELECT * FROM `tbldesignmaster` WHERE $where ORDER BY id DESC")->result();

      $data['title'] = "Drawing Master List";
      $this->load->view('admin/designrequisition/design_master_list', $data);
    }

    public function cancel($id) {

        $cancel = $this->home_model->update('tbldesignrequisition', array('status'=>6,'show_status'=>6),array('id'=>$id));

        if($cancel == true){           

            //$this->home_model->delete('tblpurchaseorderapproval',array('po_id'=>$id));
            $this->home_model->delete('tblmasterapproval',array('module_id'=>41,'table_id'=>$id));
            set_alert('success', 'Design Requisition cancel successfully');
            redirect(admin_url('designrequisition'));
        }

    }
}
