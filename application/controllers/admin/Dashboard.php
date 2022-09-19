<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model');
    }

    /* This is admin dashboard view */
    public function index()
    {
        $user_info = $this->session->userdata();
        /*echo '<pre/>';
        print_r($user_info);
        die;*/

        

        close_setup_menu();
        $this->load->model('departments_model');
        $this->load->model('todo_model');
        $data['departments'] = $this->departments_model->get();

        $data['todos'] = $this->todo_model->get_todo_items(0);
        // Only show last 5 finished todo items
        $this->todo_model->setTodosLimit(5);
        $data['todos_finished']            = $this->todo_model->get_todo_items(1);
        $data['upcoming_events_next_week'] = $this->dashboard_model->get_upcoming_events_next_week();
        $data['upcoming_events']           = $this->dashboard_model->get_upcoming_events();
        $data['title']                     = _l('dashboard_string');
        $this->load->model('currencies_model');
        $data['currencies']    = $this->currencies_model->get();
        $data['base_currency'] = $this->currencies_model->get_base_currency();
        $data['activity_log']  = $this->misc_model->get_activity_log();
        // Tickets charts
        $tickets_awaiting_reply_by_status     = $this->dashboard_model->tickets_awaiting_reply_by_status();
        $tickets_awaiting_reply_by_department = $this->dashboard_model->tickets_awaiting_reply_by_department();

        $data['tickets_reply_by_status']              = json_encode($tickets_awaiting_reply_by_status);
        $data['tickets_awaiting_reply_by_department'] = json_encode($tickets_awaiting_reply_by_department);

        $data['tickets_reply_by_status_no_json']              = $tickets_awaiting_reply_by_status;
        $data['tickets_awaiting_reply_by_department_no_json'] = $tickets_awaiting_reply_by_department;

        $data['projects_status_stats'] = json_encode($this->dashboard_model->projects_status_stats());
        $data['leads_status_stats']    = json_encode($this->dashboard_model->leads_status_stats());
        $data['google_ids_calendars']  = $this->misc_model->get_google_calendar_ids();
        $data['bodyclass']             = 'dashboard invoices-total-manual';
        $this->load->model('announcements_model');
        $data['staff_announcements']             = $this->announcements_model->get();
        $data['total_undismissed_announcements'] = $this->announcements_model->get_total_undismissed_announcements();

        $data['goals'] = [];
        if (is_staff_member()) {
            $this->load->model('goals_model');
            $data['goals'] = $this->goals_model->get_staff_goals(get_staff_user_id());
        }

        $this->load->model('projects_model');
        $data['projects_activity'] = $this->projects_model->get_activity('', do_action('projects_activity_dashboard_limit', 20));
        // To load js files
        $data['calendar_assets'] = true;
        $this->load->model('utilities_model');
        $this->load->model('estimates_model');
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();

        $this->load->model('proposals_model');
        $data['proposal_statuses'] = $this->proposals_model->get_statuses();

        $wps_currency = 'undefined';
        if (is_using_multiple_currencies()) {
            $wps_currency = $data['base_currency']->id;
        }
        $data['weekly_payment_stats'] = json_encode($this->dashboard_model->get_weekly_payments_statistics($wps_currency));

        $data['dashboard'] = true;

        $data['user_dashboard_visibility'] = get_staff_meta(get_staff_user_id(), 'dashboard_widgets_visibility');

        if (!$data['user_dashboard_visibility']) {
            $data['user_dashboard_visibility'] = [];
        } else {
            $data['user_dashboard_visibility'] = unserialize($data['user_dashboard_visibility']);
        }
        $data['user_dashboard_visibility'] = json_encode($data['user_dashboard_visibility']);


        $data['employee_target'] = $this->db->query("SELECT * from tblemployeetarget where staff_id = '".get_staff_user_id()."' and status = 1")->result();

        //$data['salesmen_target'] = $this->db->query("SELECT * from tblemployeetarget where  status = 1 order by id desc ")->result();
        $data['salesmen_target'] = $this->db->query("SELECT staff_id FROM `tblemployeetarget` WHERE `status` = 1 GROUP BY `staff_id`")->result();
        /* task for me */
        $data['task_info'] = $this->db->query("SELECT t.*, ta.staff_id, ta.task_status from tbltasks as t LEFT JOIN tbltaskassignees as ta ON t.id = ta.task_id where ta.staff_id = '".get_staff_user_id()."' and ta.task_status = 0 ")->result();
        $data['mytaskcount'] = $this->db->query("SELECT COUNT(t.id) as ttl_count FROM tbltasks as t LEFT JOIN tbltaskassignees as ta ON t.id = ta.task_id where ta.staff_id = '".get_staff_user_id()."' and ta.task_status = 0 ")->row();

        $data['task_byinfo'] = $this->db->query("SELECT t.*  FROM tbltasks as t LEFT JOIN tbltaskassignees as ta ON t.id = ta.task_id WHERE t.added_by = '".get_staff_user_id()."' and MONTH(t.created_at) = '".date('m')."' and YEAR(t.created_at) = '".date('Y')."' GROUP by t.id")->result();
        $data['task_bycount'] = $this->db->query("SELECT COUNT(t.id) as ttl_count FROM tbltasks as t LEFT JOIN tbltaskassignees as ta ON t.id = ta.task_id WHERE t.added_by = '".get_staff_user_id()."' and MONTH(t.created_at) = '".date('m')."' and YEAR(t.created_at) = '".date('Y')."' GROUP by t.id")->row();
        
        //Notification
        $data['notification_list'] = $this->db->query("SELECT * from tblmasterapproval where staff_id = '".get_staff_user_id()."' and status = 0 and approve_status = 0 order by id desc ")->result();

        //check if attendace is marked 
        $employee_info = get_employee_info(get_staff_user_id());

        $today_attendance = $this->db->query("SELECT * from tblstaffattendance where  staff_id = '".get_staff_user_id()."' and date = '".date('Y-m-d')."' ")->row();
        $today_attendance_status = 0;   
        if(!empty($today_attendance)){
            if($today_attendance->status > 0){
                $today_attendance_status = $today_attendance->status;
            }            
        }

        $working_from = date('Y-m-d').' '.$employee_info->working_from.':00';
        $working_to = date('Y-m-d').' '.$employee_info->working_to.':00';

        if(empty($today_attendance) || $today_attendance->status == 0){
            if((date('Y-m-d H:i:s') >= $working_from) && (date('Y-m-d H:i:s') <= $working_to)){
                $today_attendance_status = $today_attendance_status;
            }else{
                $today_attendance_status = '7'; // popup was showing from 12 am 
            }   
        }
        
        if(date("D") == 'Sun'){
            $today_attendance_status = '7';
        }

        $leave_taken_info = $this->db->query("SELECT * FROM `tblleaves` where addedfrom = '".get_staff_user_id()."' and (from_date >= '".date("Y-m-d")."' && to_date <= '".date("Y-m-d")."') and approved_status != 2 ")->row();
        $holiday_info = $this->db->query("SELECT * FROM `tblholidays` WHERE `date` = '".date("Y-m-d")."' and status = 1 ")->row();
        if(!empty($leave_taken_info) || !empty($holiday_info)){
            $today_attendance_status = '7';
        }

        $data["today_attendance_status"] = $today_attendance_status;

        $data = do_action('before_dashboard_render', $data);
        $this->load->view('admin/dashboard/dashboard', $data);
    }

    /* Chart weekly payments statistics on home page / ajax */
    public function weekly_payments_statistics($currency)
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->dashboard_model->get_weekly_payments_statistics($currency));
            die();
        }
    }

    public function test()
    {
        $pro_cateory_ids = $this->db->query("SELECT *, SUM(amount) as amount, GROUP_CONCAT(product_category_id) as pro_cateory_ids FROM `tblemployeetarget` WHERE `status` = 1 GROUP BY `staff_id`")->row()->pro_cateory_ids;
        echo getSaffArchiveTargetAmount(8,date('m'),date('Y'), $pro_cateory_ids);

    }

    public function get_sales_target_html()
    {
        $this->load->model('Employee_model');
        if (!empty($_POST)) {

            $salesmen_target = $this->db->query("SELECT *, SUM(amount) as amount, GROUP_CONCAT(product_category_id) as pro_cateory_ids FROM `tblemployeetarget` WHERE `status` = 1 GROUP BY `staff_id`")->result();
            ?>
            <div class="table-responsive">
                    <table class="table" id="newtable">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Employee Name</th>
                                <th>Achieved Amount</th>
                                <th>Target Amount</th>
                                <th>Achieved Percent</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

                        $fianl_target_amt = 0;
                        $fianl_achieved_amt = 0;
                        if (!empty($salesmen_target)) {
                            $z = 1;
                            foreach ($salesmen_target as $row) {
                                $invoice_ids = "0";
                                $total_monthly_amt = 0;
                                $total_target_amt = 0;
                                $achieved_percent = 0;
                                $productcategory = "";
                                $categoryids = explode(",", $row->pro_cateory_ids);
                                foreach ($categoryids as $key => $category_id) {
                                    $productcategory .= ($key == 0) ? $category_id:",".$category_id;

                                    $monthly_amt = $this->Employee_model->getEmployeeMonthlyTarget($row->staff_id, $category_id, date('m'), date('Y'));
                                    $target_amt = getSaffArchiveTargetAmount($row->staff_id,date('m'),date('Y'), $category_id, "", "", "", "2", $invoice_ids);
                                    // $chkrentinvoiceamount = getSaffArchiveTargetAmount($row->staff_id, date('m'),date('Y'), $category_id, "", "", "", "1", $invoice_ids);
                                    $achieved_percent += ($target_amt/$monthly_amt * 100);
                                    $total_target_amt += $target_amt;
                                    $invoiceids = getArchiveInvoiceids($row->staff_id, date('m'), date('Y'), $category_id);
                                    if($invoiceids != ""){
                                        $invoice_ids .= ",".$invoiceids;
                                    }
                                }
                                
                                    /* this is for other archive amount */
                                    $total_target_amt += getSaffArchiveTargetAmount($row->staff_id, date('m'),date('Y'), "", "", "", $productcategory, "2", $invoice_ids);
                                    
                                    /* this is for rent invoice archive amount */
                                    $total_target_amt += getSaffArchiveTargetAmount($row->staff_id, date('m'), date('Y'), "", "", "", "", "1", $invoice_ids);

                                $fianl_achieved_amt += $total_target_amt;
                                $fianl_target_amt += $row->amount;
                                $achieved_percent = ($total_target_amt / $row->amount)*100;
                                // $achieved_percent = ($target_amt/$row->amount * 100);
                                // $achieved_percent = ($total_monthly_amt > 0) ? ($total_target_amt / $total_monthly_amt * 100) : 0;
                                ?>
                                    <tr>
                                        <td><?php echo $z++; ?></td>
                                        <td><?php echo cc(get_employee_name($row->staff_id)); ?></td>
                                        <td><?php echo number_format($total_target_amt, 2); ?></td>
                                        <td><?php echo number_format($row->amount, 2); ?></td>
                                        <td><?php echo number_format($achieved_percent, 2); ?> %</td>
                                        <td><a target="_blank" href="<?php echo admin_url("employees/staff_target_list/".$row->staff_id."");?>">Show Details</a></td>
                                    </tr>
                                <?php

                            }
                        }
                        ?>
                        </tbody>
                        <tfoot>
                            <?php 
                                $finalpercent = 0;
                                if ($fianl_achieved_amt > 0){
                                    $finalpercent = ($fianl_achieved_amt/$fianl_target_amt)*100;
                                }
                            ?>
                            <tr><td colspan="2">Total</td><td><?php echo number_format($fianl_achieved_amt, 2); ?></td>
                            <td><?php echo number_format($fianl_target_amt, 2); ?></td>
                            <td><?php echo number_format($finalpercent, 2).' %'; ?></td><td colspan="2"></td></tr>
                        </tfoot>
                    </table>
                </div>
            <?php
        }
    }

    public function get_sales_target_amounts(){
        $this->load->model('Employee_model');
        if (!empty($_POST)) {
            $salesmen_target = $this->db->query("SELECT *, SUM(amount) as amount, GROUP_CONCAT(product_category_id) as pro_cateory_ids FROM `tblemployeetarget` WHERE `status` = 1 AND `staff_id` = '".$_POST['staff_id']."' GROUP BY `staff_id`")->row();
            if (!empty($salesmen_target)){
                $invoice_ids = "0";
                $total_monthly_amt = 0;
                $total_target_amt = 0;
                $achieved_percent = 0;
                $categoryids = explode(",", $salesmen_target->pro_cateory_ids);
                foreach ($categoryids as $category_id) {
                    $monthly_amt = $this->Employee_model->getEmployeeMonthlyTarget($salesmen_target->staff_id, $category_id, date('m'), date('Y'));
                    $target_amt = getSaffArchiveTargetAmount($salesmen_target->staff_id,date('m'),date('Y'), $category_id, "", "", "", "2", $invoice_ids);
                    $achieved_percent += ($target_amt/$monthly_amt * 100);
                    $total_target_amt += $target_amt;
                    $invoiceids = getArchiveInvoiceids($salesmen_target->staff_id, date('m'), date('Y'), $category_id);
                    if($invoiceids != ""){
                        $invoice_ids .= ",".$invoiceids;
                    }
                }
                $response = array('amount' => number_format($salesmen_target->amount, 2), 'ttltargetamount' => number_format($total_target_amt, 2), 'achieved_percent' => number_format($achieved_percent, 2));
                echo json_encode($response);

            }
        }
    }
    
}
