<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Approval extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function index($id = '')
    {
        check_permission(213,'view');   

        $where = " staff_id = '".get_staff_user_id()."' ";

        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/
            
            if($status != ''){
                $data['s_status'] = $status;
                $where .= " and status = '".$status."'";
            }

            if($module_id != ''){
                $data['s_module'] = $module_id;
                $where .= " and module_id = '".$module_id."'";
            }

            
            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));           
                $to_date = date('Y-m-d',strtotime($t_date));

               $where .= " and date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }
        }else{
            $where .= " and YEAR(date) = '".date('Y')."' AND MONTH(date) = '".date('m')."' ";
        }


        $data['approval_list'] = $this->db->query("SELECT * from tblmasterapproval where  ".$where." order by id desc ")->result();

        
        $data['title'] = 'Approval List';
        $this->load->view('admin/approval/view', $data); 
    }


    public function get_status() {


        if(!empty($_POST)){
            extract($this->input->post());
            $approval_info = $this->db->query("SELECT * from tblmasterapproval  where id = '".$id."'  ")->row();

            $assign_info = $this->db->query("SELECT * from tblmasterapproval  where module_id = '".$approval_info->module_id."' and table_id = '".$approval_info->table_id."'  ")->result();
            ?>
            <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Assign Detail List</h4>
                                <?php
                                if($approval_info->module_id == 3 || $approval_info->module_id == 4 || $approval_info->module_id == 6){
                                    ?>
                                    <h5 style="color: red;">Minimum <?php echo (count($assign_info) > 1 ) ? 2 : 1; ?> Approval is Required</h5>
                                    <?php
                                }
                                ?>
                                
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
                                                <td>Read At</td>
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
                                                    }elseif($value->approve_status == 4){
                                                        $status = 'Reconciliation';
                                                        $color = 'brown';
                                                    }
                                                ?>
                                                <tr>                                                      
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                    <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>   
                                                    <td><?php if(!empty($value->readdate)){ echo _d($value->readdate); }else{ echo 'Not Yet'; }   ?></td>                                                       
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


    public function get_product_details() {
    	extract($this->input->post());
    	$product_info = $this->db->query("SELECT * from tblproducts where  id = '".$id."' ")->row_array();
    	echo json_encode($product_info);
    }
	

    public function notifications($id = '')
    {
        //check_permission(213,'view');   

        $where = " staff_id = '".get_staff_user_id()."' ";

        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/
            
            if($status != ''){
                $data['s_status'] = $status;
                $where .= " and status = '".$status."' and approve_status = '".$status."' ";
            }

            if($module_id != ''){
                $data['s_module'] = $module_id;
                $where .= " and module_id = '".$module_id."'";
            }

            
            if(!empty($f_date) && !empty($t_date)){
                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

               $where .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
           }
        }else{
            $where .= " and status = 0 and approve_status = 0 ";
        }

        $data['notification_list'] = $this->db->query("SELECT * FROM tblmasterapproval WHERE ".$where." and `module_id` NOT IN (18,30,31,33,37,39,42,45,48,58,59) order by id desc ")->result();
        $data['module_info'] = $this->db->query("SELECT * FROM tblcrmmodules WHERE `id` NOT IN (18,30,31,33,37,39,42,45,48,58,59) AND `status` = 1 ")->result();
        
        $data['title'] = 'Approval Notificatoin List';
        $this->load->view('admin/approval/notifications', $data); 
    }

    public function getNotificationLink()
    {
        if(!empty($_POST)){
            extract($this->input->post());

            $notification_info = $this->db->query("SELECT * from tblmasterapproval where  id = '".$id."' ")->row();

            $ad_data = array( 
                            'readdate' => date('Y-m-d H:i:s'),
                            'isread' => 1
                        );                    
            $update = $this->home_model->update('tblmasterapproval', $ad_data,array('id'=>$id));  

            echo admin_url($notification_info->link);

        }

    }

    /* this is for staff notification list */
    public function staff_notification_list($id = '')
    {
        $module_ids = array(1,2,3,9);
        $where = "n.id > 0";
        if(!empty($_POST)){
            extract($this->input->post());
            if($status != ''){
                $data['s_status'] = $status;
                $where .= " and r.approved_status = '".$status."'";
            }

            if($module_id != ''){
                $data['s_module'] = $module_id;
                $module_ids = [$module_id];
            }
            
            if(!empty($f_date) && !empty($t_date)){
                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;
                $where .= " and n.date between '".db_date($f_date)." 00:00:00' and '".db_date($t_date)." 23:59:59'";
            }
        }else{
            $where .= " and r.approved_status = '0'";
        }
        
        $notification_info = array();
        $pending_request = array();
        
        if (!empty($module_ids) && in_array(1, $module_ids)){
            $pending_request = $this->db->query("SELECT n.*,r.approved_status from `tblnotifications` as n LEFT JOIN tblrequests as r ON n.table_id = r.id LEFT JOIN tblrequestapproval as ra ON r.id = ra.request_id WHERE $where and ra.staff_id = '".get_staff_user_id()."' and n.touserid = '".get_staff_user_id()."' and n.module_id = 1 ORDER BY n.id DESC")->result();
            if(!empty($pending_request)){
                foreach($pending_request as $row){
                    $notification_info[] = $row;
                }
            }
        }
        
        if (!empty($module_ids) && in_array(2, $module_ids)){
            $pending_request = $this->db->query("SELECT n.*,r.approved_status from `tblnotifications` as n LEFT JOIN tblexpenses as r ON n.table_id = r.id LEFT JOIN tblexpensesapproval as ea ON r.id = ea.expense_id WHERE $where and ea.staff_id = '".get_staff_user_id()."' and n.touserid = '".get_staff_user_id()."' and n.module_id = 2 ORDER BY n.id DESC")->result();
            if(!empty($pending_request)){
                foreach($pending_request as $row){
                    $notification_info[] = $row;
                }
            }
        }
        
        if (!empty($module_ids) && in_array(3, $module_ids)){
            $pending_request = $this->db->query("SELECT n.*,r.approved_status from `tblnotifications` as n LEFT JOIN tblleaves as r ON n.table_id = r.id LEFT JOIN tblleaveapproval as la ON r.id = la.leave_id WHERE $where and la.staff_id = '".get_staff_user_id()."' and n.touserid = '".get_staff_user_id()."' and n.module_id = 3 ORDER BY n.id DESC")->result();
            if(!empty($pending_request)){
                foreach($pending_request as $row){
                    $notification_info[] = $row;
                }
            }
        }

        if (!empty($module_ids) && in_array(8, $module_ids)){
            $pending_request = $this->db->query("SELECT n.*,r.staff_confirmed as approved_status from `tblnotifications` as n LEFT JOIN tblpettycashmaster as r ON n.table_id = r.id where $where and r.staff_id = '".get_staff_user_id()."' and n.touserid = '".get_staff_user_id()."' and n.module_id = 8 ORDER BY n.id DESC")->result();
            if(!empty($pending_request)){
                foreach($pending_request as $row){
                    $notification_info[] = $row;
                }
            }
        }
        if (!empty($module_ids) && in_array(9, $module_ids)){
            $pending_request = $this->db->query("SELECT n.*,r.approved_status from `tblnotifications` as n LEFT JOIN tblpettycashrequest as r ON n.table_id = r.id LEFT JOIN tblpettycashrequestapproval as pa ON r.id = pa.pettycash_id where $where and pa.staff_id = '".get_staff_user_id()."' and n.touserid = '".get_staff_user_id()."' and n.module_id = 9 ORDER BY n.id DESC")->result();
            if(!empty($pending_request)){
                foreach($pending_request as $row){
                    $notification_info[] = $row;
                }
            }
        }
        usort($notification_info, "desc_id_compare");
        $data["notification_list"] = $notification_info;
        $data['title'] = 'Notificatoin List';
        $this->load->view('admin/approval/staff_notifications_list', $data); 
    }
    
    public function getStaffNotificationLink()
    {
        if(!empty($_POST)){
            extract($this->input->post());

            $notification_info = $this->db->query("SELECT * FROM tblnotifications WHERE  id = '".$id."' ")->row();

            $ad_data = array( 
                            'readdate' => date('Y-m-d H:i:s'),
                            'isread' => 1
                        );                    
            $this->home_model->update('tblnotifications', $ad_data,array('id'=>$id)); 
            if ($notification_info->module_id == "2") {

                $notification_id = ($notification_info->old_id > 0) ? $notification_info->old_id : $notification_info->id;
                echo admin_url('expenses/get_multiple_expense/'.$notification_id);
            }else if ($notification_info->module_id == "1" && $notification_info->type == "2") { 

                echo admin_url('requests/request_comfirm/'.$notification_info->table_id);
            }else if ($notification_info->module_id == "9" && $notification_info->type == "1"){
                
                if ($notification_info->for_manager_approval == "1"){
                    echo admin_url("petty_cash/manager_request_approval/".$notification_info->table_id);
                }else{
                    echo admin_url("petty_cash/petty_cash_approval/".$notification_info->table_id);
                }
            }else if ($notification_info->module_id == "9" && $notification_info->type == "2"){
                
                echo admin_url("petty_cash/request_confirmation/".$notification_info->table_id);
            }else{
                echo admin_url($notification_info->link);
            }            
        }
    }

    /* this notification use for activity notification */
    public function activity_notifications($id = '')
    {
        $where = " staff_id = '".get_staff_user_id()."' ";
        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/
            
            if($status != ''){
                $data['s_status'] = $status;
                $where .= " and status = '".$status."' and approve_status = '".$status."' ";
            }

            if($module_id != ''){
                $data['s_module'] = $module_id;
                $where .= " and module_id = '".$module_id."'";
            }
            
            if(!empty($f_date) && !empty($t_date)){
                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

               $where .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
           }
        }else{
            $where .= " and status = 0 and approve_status = 0 ";
        }

        $data['notification_list'] = $this->db->query("SELECT * FROM tblmasterapproval WHERE ".$where." and `module_id` IN (18,30,31,33,37,39,42,45,48,58,59) order by id desc ")->result();
        $data['module_info'] = $this->db->query("SELECT * FROM tblcrmmodules WHERE `id` IN (18,30,31,33,37,39,42,45,48,58,59) AND `status` = 1 ")->result();
        
        $data['title'] = 'Activity Tag Notificatoin List';
        $this->load->view('admin/approval/activity_notifications_list', $data); 
    }
}