<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Report_API extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        
    }

    /* this function use for sales report */
    public function sales_report() {
        if(!empty($_GET))
        {
            extract($this->input->get());   
        }
        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }
        
        $service_type = (!empty($service_type)) ? $service_type : 1;
        $min_balance = (!empty($min_balance)) ? $min_balance : "";
        $max_balance = (!empty($max_balance)) ? $max_balance : "";
        $ttl_invoice = $ttl_paid = $ttl_balance = $ttl_on_account = $ttl_waiveoff = 0;
        
        $return_arr = array("status" => false, "message" => "Record not found!", "data" => []);
        $client_list = $this->db->query("SELECT `client_branch_name`,`userid`,`client_id` from `tblclientbranch` where active = 1 ")->result();
        if (!empty($client_list)){
            foreach ($client_list as $client) {
                
                $parent_ids = $invoice_amt = $paid_amt = $onaccout_amt = 0;
                $where = "clientid = '".$client->userid."' and status != '5' ";
                $where_debitnote = "clientid = '".$client->userid."' and status = '1' ";

                if(isset($service_type) && $service_type != 3){
                    $where .= " and service_type = '".$service_type."'";
                }

                if(!empty($f_date) && !empty($t_date)){
                    $where .= " and invoice_date between '".db_date($f_date)."' and '".db_date($t_date)."'";
                    $where_debitnote .= " and date between '".db_date($f_date)."' and '".db_date($t_date)."'";
                }else{
                    $where .= " and MONTH(invoice_date) = '".date('m')."' and YEAR(invoice_date) = '".date('Y')."' ";    
                    $where_debitnote .= " and MONTH(date) = '".date('m')."' and YEAR(date) = '".date('Y')."' ";    
                } 
                /* this is for invoices details */
                $invoice_info = $this->db->query("SELECT `id`,`total`,`parent_id` from `tblinvoices` where ".$where."  ")->result();
                if(!empty($invoice_info)){
                    foreach ($invoice_info as $invoice) {
                        if($invoice->parent_id == 0){
                            $parent_ids .= ','.$invoice->id;
                        }
                        $invoice_amt += $invoice->total;
                        $paid_amt += invoice_received($invoice->id);
                        $paid_amt += invoice_tds_received($invoice->id);
                    }
                }
                /* this is for debitnote details */
                $debit_note_info = $this->db->query("SELECT `id`,`totalamount`,`number` FROM tbldebitnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' ")->result();
                if(!empty($debit_note_info)){
                    foreach ($debit_note_info as $debitnote) {
                        $invoice_amt += $debitnote->totalamount;
                        $paid_amt += debitnote_received($debitnote->number);
                        $paid_amt += debitnote_tds_received($debitnote->number);
                    }
                }
                
                $credit_note_info = $this->db->query("SELECT `id`,`totalamount`,`number` FROM tblcreditnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' ")->result();
                if(!empty($credit_note_info)){
                    foreach ($credit_note_info as $creditnote) {
                        $paid_amt += $creditnote->totalamount;
                    }
                }

                if($service_type == 3 || $service_type == 1){
                    $payment_debitnote = $this->db->query("SELECT `id`,`amount`,`number` FROM tbldebitnotepayment where ".$where_debitnote." ")->result();
                    if(!empty($payment_debitnote)){
                        foreach ($payment_debitnote as $debitnote) {
                            $invoice_amt += $debitnote->amount;
                            $paid_amt += debitnote_received($debitnote->number);
                            $paid_amt += debitnote_tds_received($debitnote->number);
                        }
                    }
                }
                
                $where_onaccount = "client_id = '".$client->userid."' and payment_behalf = 1 and status = 1";
                if($service_type != 3){
                    $where_onaccount .= " and service_type = '".$service_type."'";
                }
                if(!empty($f_date) && !empty($t_date)){
                    $where_onaccount .= " and date between '".db_date($f_date)."' and '".db_date($t_date)."'";
                }else{
                    $where_onaccount .= " and MONTH(date) = '".date('m')."' and YEAR(date) = '".date('Y')."' ";    
                }
              
                $onaccout_amt_info = $this->db->query("SELECT * FROM `tblclientpayment`  where ".$where_onaccount." ")->result();
                if(!empty($onaccout_amt_info)){
                    foreach ($onaccout_amt_info as $on_am) {
                        $to_see = ($on_am->payment_mode == 1 && $on_am->chaque_status != 1) ? '0' : '1';
                        if($to_see == 1){
                            $onaccout_amt += $on_am->ttl_amt;
                        }
                    }
                }
                
                $where_waveoff = "client_id = '".$client->userid."' and status = 1 ";
                if(!empty($f_date) && !empty($t_date)){
                    $where_waveoff .= " and created_date between '".db_date($f_date)."' and '".db_date($t_date)."'";
                }else{
                    $where_waveoff .= " and MONTH(created_date) = '".date('m')."' and YEAR(created_date) = '".date('Y')."' ";    
                }
                
                $waveoff_amt = $this->db->query("SELECT COALESCE(SUM(amount),0) AS ttl_amount FROM `tblclientwaveoff`  where ".$where_waveoff." ")->row()->ttl_amount;

		$balance_amt = ($invoice_amt - $paid_amt - $onaccout_amt - $waveoff_amt);
               // $output_data = array();
                if($invoice_amt > 0){
                   
                    if(($min_balance == '') && ($max_balance == '')){
                        
                        $ttl_invoice += $invoice_amt;
                        $ttl_paid += $paid_amt;
                        $ttl_on_account += $onaccout_amt;
                        $ttl_waiveoff += $waveoff_amt;
                        $ttl_balance += $balance_amt;
                        
                        $output_data[] = array(
                            'client_name' => cc($client->client_branch_name),
                            'invoice_amount' => number_format($invoice_amt, 2),
                            'paid_amount' => number_format($paid_amt, 2),
                            'on_account' => number_format($onaccout_amt, 2),
                            'waive_off' => number_format($waveoff_amt, 2),
                            'balance' => number_format($balance_amt, 2),
                        );
                        
                    }elseif (($min_balance != '') && ($max_balance != '')) {
                        if ($balance_amt >= $min_balance && $balance_amt <= $max_balance) {
                            $ttl_invoice += $invoice_amt;
                            $ttl_paid += $paid_amt;
                            $ttl_on_account += $onaccout_amt;
                            $ttl_waiveoff += $waveoff_amt;
                            $ttl_balance += $balance_amt;
                            
                            $output_data[] = array(
                                'client_name' => cc($client->client_branch_name),
                                'invoice_amount' => number_format($invoice_amt, 2),
                                'paid_amount' => number_format($paid_amt, 2),
                                'on_account' => number_format($onaccout_amt, 2),
                                'waive_off' => number_format($waveoff_amt, 2),
                                'balance' => number_format($balance_amt, 2),
                            );
                        }
                    }elseif (($min_balance != '') && ($max_balance == '')){
                        if ($balance_amt >= $min_balance) {
                            
                            $ttl_invoice += $invoice_amt;
                            $ttl_paid += $paid_amt;
                            $ttl_on_account += $onaccout_amt;
                            $ttl_waiveoff += $waveoff_amt;
                            $ttl_balance += $balance_amt;
                            
                            $output_data[] = array(
                                'client_name' => cc($client->client_branch_name),
                                'invoice_amount' => number_format($invoice_amt, 2),
                                'paid_amount' => number_format($paid_amt, 2),
                                'on_account' => number_format($onaccout_amt, 2),
                                'waive_off' => number_format($waveoff_amt, 2),
                                'balance' => number_format($balance_amt, 2),
                            );
                        }
                    }elseif (($min_balance == '') && ($max_balance != '')) {
                        if ($balance_amt <= $max_balance) {
                            
                            $ttl_invoice += $invoice_amt;
                            $ttl_paid += $paid_amt;
                            $ttl_on_account += $onaccout_amt;
                            $ttl_waiveoff += $waveoff_amt;
                            $ttl_balance += $balance_amt;
                            
                            $output_data[] = array(
                                'client_name' => cc($client->client_branch_name),
                                'invoice_amount' => number_format($invoice_amt, 2),
                                'paid_amount' => number_format($paid_amt, 2),
                                'on_account' => number_format($onaccout_amt, 2),
                                'waive_off' => number_format($waveoff_amt, 2),
                                'balance' => number_format($balance_amt, 2),
                            );
                        }
                    }
                    
                    
                }
            }

            if(!empty($output_data)){
                $output_data = $output_data;
            }else{
                $output_data = [];                
            }
            
            $return_arr = array("status" => true, "message" => "Success", "data" => $output_data);
            $return_arr["service_type"] = $service_type;
            $return_arr["total_invoice_amount"] = number_format($ttl_invoice, 2);
            $return_arr["total_paid_amount"] = number_format($ttl_paid, 2);
            $return_arr["total_on_account_amount"] = number_format($ttl_on_account, 2);
            $return_arr["total_waive_off_amount"] = number_format($ttl_waiveoff, 2);
            $return_arr["total_balance_amount"] = number_format($ttl_balance, 2);
        }
        
        header('Content-type: application/json');
        echo json_encode($return_arr);
        // http://localhost/crm/Report_API/sales_report?service_type=1&f_date=2021-05-01&t_date=2021-05-14
    }
    
    /* this function use for collection report list */
    public function collection_report() {
        if(!empty($_GET))
        {
            extract($this->input->get());   
        }
        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }
        
        $where = 'status IN (0,1) ';
        if(!empty($f_date) && !empty($t_date)){
            $where .= " and date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."' ";
        }else{
            $where .= " and MONTH(date) = '".date('m')."' and YEAR(date) = '".date('Y')."' ";    
        }

        if($status != ''){
            $where .= " and status = '".$status."' ";
        }
        $collection_amount = 0; 
        $return_arr = array("status" => false, "message" => "Record not found!", "total_amount" => 0, "data" => []);
        $collection_list = $this->db->query("SELECT * from `tblclientpayment` where ".$where." order by date desc ")->result();
        if (!empty($collection_list)){
            foreach ($collection_list as $row) {
                $to_see = ($row->payment_mode == 1 && $row->chaque_status != 1) ? '0' : '1';
                if ($to_see == 1) {
                    $collection_amount += $row->ttl_amt;
                    $client_info = $this->db->query("SELECT * FROM `tblclientbranch` where `userid`='" . $row->client_id . "' ")->row();
                    
                    $payment_behalf = '--';
                    switch ($row->payment_behalf) {
                        case 1:
                            $payment_behalf = 'On Account';
                            break;
                        case 2:
                            $payment_behalf = 'Invoice';
                            break;
                        case 3:
                            $payment_behalf = 'Debit Note';
                            break;
                    }
                    
                    $payment_mode = '';
                    switch ($row->payment_mode) {
                        case 1:
                            $payment_mode = 'Cheque';
                            break;
                        case 2:
                            $payment_mode = 'NEFT';
                            break;
                        case 3:
                            $payment_mode = 'Cash';
                            break;
                    }
                    
                    $status = ($row->status == 1) ? "Approved" : "Pending";

                    if($row->is_suspense_account == 1){
                        $client_name = 'Suspense';
                    }else{
                        $client_name = (!empty($client_info)) ? cc($client_info->client_branch_name) : "";
                    }
                    
                    $output_arr[] = array(
                        "client_name" => $client_name,
                        "collection_type" => $payment_behalf,
                        "bank_name" => cc(value_by_id('tblbankmaster', $row->bank_id, 'name')),
                        "payment_mode" => $payment_mode,
                        "reference_number" => (!empty($row->reference_no)) ? cc($row->reference_no) : '--',
                        "date" => _d($row->date),
                        "amount" => number_format($row->ttl_amt, 2),
                        "status_id" => $row->status,
                        "status" => $status
                    );
                }
            }
            $return_arr = array("status" => true, "message" => "Success", "total_amount" => number_format($collection_amount, 2), "total_row" => (isset($output_arr) ? count($output_arr) : 0), "data" => (isset($output_arr) ? $output_arr : ""));
        }
        header('Content-type: application/json');
        echo json_encode($return_arr);
        // http://localhost/crm/Report_API/collection_report?f_date=2019-05-01&t_date=2021-05-14&status=0
    }
    
    /* this is for client status list */
    public function get_status_list() {
        if(!empty($_GET))
        {
            extract($this->input->get());   
        }
        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }
        
        $return_arr = array("status" => false, "message" => "Record not found!", "data" => []);
        $clinet_status = $this->db->query("SELECT * from `tblclientstatus` where status = 1  ")->result();
        if (!empty($clinet_status)){
            foreach ($clinet_status as $value) {
                $output[] = array("id" => $value->id, "name" => $value->name);
            }
            $return_arr = array("status" => true, "message" => "Success", "data" => $output);
        }
        header('Content-type: application/json');
        echo json_encode($return_arr);
        // http://localhost/crm/Report_API/get_status_list
    }
    
     /* this is for underlimit running outstanding client list */
    public function underlimit_running_outstanding() {
        if(!empty($_GET))
        {
            extract($this->input->get());   
        }
        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }
        
        $return_arr = array("status" => false, "message" => "Please send all required parameters!", "total_running_amount" => 0, "data" => []);
        if (!empty($user_id)){
             
            if(getCurrentFinancialYear() == 1){
                $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and duedate >= '".date('Y-m-d')."' and year_id = '".getCurrentFinancialYear()."' ";
            }else{
                $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and year_id = '".getCurrentFinancialYear()."' ";    
            }

            $client_ids = 0;
            $invoice_client = $this->db->query("SELECT clientid from `tblinvoices` where ".$where." group by clientid")->result();
            if(!empty($invoice_client)){
                foreach ($invoice_client as $key => $value) {
                    if($key == 0){
                        $client_ids = $value->clientid;
                    }else{
                        $client_ids .= ','.$value->clientid;
                    }
                }
            }

            if (!empty($user_id) && $user_id != 1){
                $assigned_clients = get_staff_clients($user_id);
                $client_arr = explode(',', $client_ids);
                $client_ids = 0;
                $j = 0;
                if(!empty($client_arr)){
                    foreach ($client_arr as $c_id_1) {

                        if(!empty($assigned_clients)){
                            foreach ($assigned_clients as $c_id_2) {
                                if($c_id_1 == $c_id_2){
                                    $j++;
                                    if($j == 0){
                                        $client_ids = $c_id_2;
                                    }else{
                                        $client_ids .= ','.$c_id_2;
                                    }
                                }
                            }
                        }

                    }
                }
            }
            $condition = ' and other_collection = 0';
            if(!empty($status)){            
                $condition .= " and client_status IN (".$status.") ";
            }
            $return_arr = array("status" => false, "message" => "Record not found!", "total_running_amount" => 0, "data" => []);
            $ttl_running_amt = 0;
            $running_clinets = $this->db->query("SELECT `client_status`,`staff_group`,`credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where userid IN (".$client_ids.") ".$condition." ")->result();
            if (!empty($running_clinets)){
                foreach ($running_clinets as $row) {
                    $bal_amt = client_balance_amt($row->userid,1);
                    if($row->credit_limit == 0 || $bal_amt <= $row->credit_limit ){
                        if($bal_amt > 1){
                            $ttl_running_amt += $bal_amt;
                            
                            $group_nams = 'Allot Group';
                            if(!empty($row->staff_group)){ 
                                $group_arr = explode(',', $row->staff_group);
                                foreach ($group_arr as $k => $group_id) {
                                    if($k == 0){
                                        $group_nams = value_by_id('tblstaffgroup',$group_id,'name');
                                    }else{
                                        $group_nams .= ', '.value_by_id('tblstaffgroup',$group_id,'name');
                                    }                                
                                }
                            }

                            $client_status = '--';
                            if($row->client_status > 0){
                               $client_status = value_by_id("tblclientstatus", $row->client_status, "name");
                            }


                            $output_arr[] = array(
                                "client_id" => $row->userid,
                                "client_name" => cc($row->client_branch_name),
                                "client_status" => $client_status,
                                "client_status_id" => $row->client_status,
                                "assigned_details" => $group_nams,
                                "outstanding" => $bal_amt,
                            );
                        }
                    }
                }
                if ($ttl_running_amt > 0){
                    $return_arr = array("status" => true, "message" => "Success", "total_running_amount" => number_format($ttl_running_amt, 2), "data" => (isset($output_arr) ? $output_arr : []));
                }
                
            }
        }
        
        header('Content-type: application/json');
        echo json_encode($return_arr);
        // http://localhost/crm/Report_API/underlimit_running_outstanding?user_id=1&status=1,2
    }
    
     /* this is for underlimit closed outstanding client list */
    public function underlimit_closed_outstanding() {
        if(!empty($_GET))
        {
            extract($this->input->get());   
        }
        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }
        
        $return_arr = array("status" => false, "message" => "Please send all required parameters!", "total_running_amount" => 0, "data" => []);
        if (!empty($user_id)){
             
            if(getCurrentFinancialYear() == 1){
                $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and duedate >= '".date('Y-m-d')."' and year_id = '".getCurrentFinancialYear()."' ";
            }else{
                $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and year_id = '".getCurrentFinancialYear()."' ";    
            }

            $client_ids = 0;
            $invoice_client = $this->db->query("SELECT clientid from `tblinvoices` where ".$where." group by clientid")->result();
            if(!empty($invoice_client)){
                foreach ($invoice_client as $key => $value) {
                    if($key == 0){
                        $client_ids = $value->clientid;
                    }else{
                        $client_ids .= ','.$value->clientid;
                    }
                }
            }
            $condition = ' and other_collection = 0';
            if (!empty($user_id) && $user_id != 1){
                $assigned_clients = get_staff_clients($user_id);
                $client_arr = explode(',', $client_ids);
                $client_ids = 0;
                $j = 0;
                if(!empty($client_arr)){
                    foreach ($client_arr as $c_id_1) {

                        if(!empty($assigned_clients)){
                            foreach ($assigned_clients as $c_id_2) {
                                if($c_id_1 == $c_id_2){
                                    $j++;
                                    if($j == 0){
                                        $client_ids = $c_id_2;
                                    }else{
                                        $client_ids .= ','.$c_id_2;
                                    }
                                }
                            }
                        }

                    }
                }
                $condition .= " and staff_group != '' ";
            }
            
            if(!empty($status)){            
                $condition .= " and client_status IN (".$status.") ";
            }
            $return_arr = array("status" => false, "message" => "Record not found!", "total_running_amount" => 0, "data" => []);
            $ttl_closed_amt = 0;
            $running_clinets = $this->db->query("SELECT `client_status`,`staff_group`,`credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where userid NOT IN (".$client_ids.") ".$condition." ")->result();
            if (!empty($running_clinets)){
                foreach ($running_clinets as $row) {
                    $bal_amt = client_balance_amt($row->userid,1);
                    if($row->credit_limit == 0 || $bal_amt <= $row->credit_limit ){
                        if($bal_amt > 1){
                            $ttl_closed_amt += $bal_amt;
                            
                            $group_nams = 'Allot Group';
                            if(!empty($row->staff_group)){ 
                                $group_arr = explode(',', $row->staff_group);
                                foreach ($group_arr as $k => $group_id) {
                                    if($k == 0){
                                        $group_nams = value_by_id('tblstaffgroup',$group_id,'name');
                                    }else{
                                        $group_nams .= ', '.value_by_id('tblstaffgroup',$group_id,'name');
                                    }                                
                                }
                            }
                            $output_arr[] = array(
                                "client_id" => $row->userid,
                                "client_name" => cc($row->client_branch_name),
                                "client_status" => value_by_id("tblclientstatus", $row->client_status, "name"),
                                "client_status_id" => $row->client_status,
                                "assigned_details" => $group_nams,
                                "outstanding" => $bal_amt,
                            );
                        }
                    }
                }
                if ($ttl_closed_amt > 0){
                    $return_arr = array("status" => true, "message" => "Success", "total_running_amount" => number_format($ttl_closed_amt, 2), "data" => (isset($output_arr) ? $output_arr : []));
                }
                
            }
        }
        
        header('Content-type: application/json');
        echo json_encode($return_arr);
        // http://localhost/crm/Report_API/underlimit_closed_outstanding?user_id=1&status=1,2
    }
    
    /* this is for underlimit sales outstanding client list */
    public function underlimit_sales_outstanding() {
        if(!empty($_GET))
        {
            extract($this->input->get());   
        }
        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }
        
        $return_arr = array("status" => false, "message" => "Please send all required parameters!", "total_running_amount" => 0, "data" => []);
        if (!empty($user_id)){
             
            $client_ids = 0;
            $invoice_client = $this->db->query("SELECT clientid from `tblinvoices` where service_type = 2 and status != '5' group by clientid")->result();
            if(!empty($invoice_client)){
                foreach ($invoice_client as $key => $value) {
                    if($key == 0){
                        $client_ids = $value->clientid;
                    }else{
                        $client_ids .= ','.$value->clientid;
                    }
                }
            }

            if (!empty($user_id) && $user_id != 1){
                $assigned_clients = get_staff_clients($user_id);
                $client_arr = explode(',', $client_ids);
                $client_ids = 0;
                $j = 0;
                if(!empty($client_arr)){
                    foreach ($client_arr as $c_id_1) {

                        if(!empty($assigned_clients)){
                            foreach ($assigned_clients as $c_id_2) {
                                if($c_id_1 == $c_id_2){
                                    $j++;
                                    if($j == 0){
                                        $client_ids = $c_id_2;
                                    }else{
                                        $client_ids .= ','.$c_id_2;
                                    }
                                }
                            }
                        }

                    }
                }
                
            }
            $condition = ' and other_collection = 0';
            if(!empty($status)){            
                $condition .= " and client_status IN (".$status.") ";
            }
            $return_arr = array("status" => false, "message" => "Record not found!", "total_running_amount" => 0, "data" => []);
            $ttl_sales_amt = 0;
            $sales_clinets = $this->db->query("SELECT `client_status`,`staff_group`,`credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where userid IN (".$client_ids.") ".$condition."")->result();
            if (!empty($sales_clinets)){
                foreach ($sales_clinets as $row) {
                    $bal_amt = client_balance_amt($row->userid,2);
                    if($row->credit_limit == 0 || $bal_amt <= $row->credit_limit ){
                        if($bal_amt > 1){
                            $ttl_sales_amt += $bal_amt;
                            
                            $group_nams = 'Allot Group';
                            if(!empty($row->staff_group)){ 
                                $group_arr = explode(',', $row->staff_group);
                                foreach ($group_arr as $k => $group_id) {
                                    if($k == 0){
                                        $group_nams = value_by_id('tblstaffgroup',$group_id,'name');
                                    }else{
                                        $group_nams .= ', '.value_by_id('tblstaffgroup',$group_id,'name');
                                    }                                
                                }
                            }

                            $client_status = '';
                            if(!empty($row->client_status)){
                                $client_status = value_by_id("tblclientstatus", $row->client_status, "name");
                            }

                            $output_arr[] = array(
                                "client_id" => $row->userid,
                                "client_name" => cc($row->client_branch_name),
                                "client_status" => $client_status,
                                "client_status_id" => $row->client_status,
                                "assigned_details" => $group_nams,
                                "outstanding" => $bal_amt,
                            );
                        }
                    }
                }
                if ($ttl_sales_amt > 0){
                    $return_arr = array("status" => true, "message" => "Success", "total_running_amount" => number_format($ttl_sales_amt, 2), "data" => (isset($output_arr) ? $output_arr : []));
                }
                
            }
        }
        
        header('Content-type: application/json');
        echo json_encode($return_arr);
        // http://localhost/crm/Report_API/underlimit_sales_outstanding?user_id=1&status=1,2
    }
    
    /* this is for all running client list */
    public function all_running_clients() {
        if(!empty($_GET))
        {
            extract($this->input->get());   
        }
        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }
        
        $return_arr = array("status" => false, "message" => "Please send all required parameters!", "total_running_amount" => 0, "data" => []);
        if (!empty($user_id)){
             
            if(getCurrentFinancialYear() == 1){
                $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and duedate >= '".date('Y-m-d')."' and year_id = '".getCurrentFinancialYear()."' ";
            }else{
                $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and year_id = '".getCurrentFinancialYear()."' ";    
            }

            $client_ids = 0;
            $invoice_client = $this->db->query("SELECT clientid from `tblinvoices` where ".$where." group by clientid")->result();
            if(!empty($invoice_client)){
                foreach ($invoice_client as $key => $value) {
                    if($key == 0){
                        $client_ids = $value->clientid;
                    }else{
                        $client_ids .= ','.$value->clientid;
                    }
                }
            }

            if (!empty($user_id) && $user_id != 1){
                $assigned_clients = get_staff_clients($user_id);
                $client_arr = explode(',', $client_ids);
                $client_ids = 0;
                $j = 0;
                if(!empty($client_arr)){
                    foreach ($client_arr as $c_id_1) {

                        if(!empty($assigned_clients)){
                            foreach ($assigned_clients as $c_id_2) {
                                if($c_id_1 == $c_id_2){
                                    $j++;
                                    if($j == 0){
                                        $client_ids = $c_id_2;
                                    }else{
                                        $client_ids .= ','.$c_id_2;
                                    }
                                }
                            }
                        }

                    }
                }
            }
            $condition = ' and other_collection = 0';
            if(!empty($status)){            
                $condition .= " and client_status IN (".$status.") ";
            }
            $return_arr = array("status" => false, "message" => "Record not found!", "total_running_amount" => 0, "data" => []);
            $ttl_running_amt = 0;
            $running_clinets = $this->db->query("SELECT `client_status`,`staff_group`,`credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where userid IN (".$client_ids.") ".$condition." ")->result();
            if (!empty($running_clinets)){
                foreach ($running_clinets as $row) {
                    $bal_amt = client_balance_amt($row->userid,1);
                    $ttl_running_amt += $bal_amt;

                    $group_nams = 'Allot Group';
                    if(!empty($row->staff_group)){ 
                        $group_arr = explode(',', $row->staff_group);
                        foreach ($group_arr as $k => $group_id) {
                            if($k == 0){
                                $group_nams = value_by_id('tblstaffgroup',$group_id,'name');
                            }else{
                                $group_nams .= ', '.value_by_id('tblstaffgroup',$group_id,'name');
                            }                                
                        }
                    }

                    $client_status = '--';
                    if($row->client_status > 0){
                       $client_status = value_by_id("tblclientstatus", $row->client_status, "name");
                    }
                    

                    $output_arr[] = array(
                        "client_id" => $row->userid,
                        "client_name" => cc($row->client_branch_name),
                        "client_status" => $client_status,
                        "client_status_id" => $row->client_status,
                        "assigned_details" => $group_nams,
                        "outstanding" => $bal_amt,
                    );
                }
                $return_arr = array("status" => true, "message" => "Success", "total_running_amount" => number_format($ttl_running_amt, 2), "data" => (isset($output_arr) ? $output_arr : []));
            }
        }
        
        header('Content-type: application/json');
        echo json_encode($return_arr);
        // http://localhost/crm/Report_API/all_running_clients?user_id=1&status=1,2
    }
    
    /* this is for all running with no outstanding list */
    public function running_with_no_outstanding() {
        if(!empty($_GET))
        {
            extract($this->input->get());   
        }
        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }
        
        $return_arr = array("status" => false, "message" => "Please send all required parameters!", "total_running_amount" => 0, "data" => []);
        if (!empty($user_id)){
             
            if(getCurrentFinancialYear() == 1){
                $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and duedate >= '".date('Y-m-d')."' and year_id = '".getCurrentFinancialYear()."' ";
            }else{
                $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and year_id = '".getCurrentFinancialYear()."' ";    
            }

            $client_ids = 0;
            $invoice_client = $this->db->query("SELECT clientid from `tblinvoices` where ".$where." group by clientid")->result();
            if(!empty($invoice_client)){
                foreach ($invoice_client as $key => $value) {
                    if($key == 0){
                        $client_ids = $value->clientid;
                    }else{
                        $client_ids .= ','.$value->clientid;
                    }
                }
            }

            if (!empty($user_id) && $user_id != 1){
                $assigned_clients = get_staff_clients($user_id);
                $client_arr = explode(',', $client_ids);
                $client_ids = 0;
                $j = 0;
                if(!empty($client_arr)){
                    foreach ($client_arr as $c_id_1) {

                        if(!empty($assigned_clients)){
                            foreach ($assigned_clients as $c_id_2) {
                                if($c_id_1 == $c_id_2){
                                    $j++;
                                    if($j == 0){
                                        $client_ids = $c_id_2;
                                    }else{
                                        $client_ids .= ','.$c_id_2;
                                    }
                                }
                            }
                        }

                    }
                }
            }
            $condition = ' and other_collection = 0';
            if(!empty($status)){            
                $condition .= " and client_status IN (".$status.") ";
            }
            $return_arr = array("status" => false, "message" => "Record not found!", "total_running_amount" => 0, "data" => []);
            $ttl_running_amt = 0;
            $running_clinets = $this->db->query("SELECT `client_status`,`staff_group`,`credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where userid IN (".$client_ids.") ".$condition." ")->result();
            if (!empty($running_clinets)){
                foreach ($running_clinets as $row) {
                    
                    $bal_amt = client_balance_amt($row->userid,1);
                    
                    if($bal_amt < 10){
                        $ttl_running_amt += $bal_amt;

                        $group_nams = 'Allot Group';
                        if(!empty($row->staff_group)){ 
                            $group_arr = explode(',', $row->staff_group);
                            foreach ($group_arr as $k => $group_id) {
                                if($k == 0){
                                    $group_nams = value_by_id('tblstaffgroup',$group_id,'name');
                                }else{
                                    $group_nams .= ', '.value_by_id('tblstaffgroup',$group_id,'name');
                                }                                
                            }
                        }
                        $output_arr[] = array(
                            "client_id" => $row->userid,
                            "client_name" => cc($row->client_branch_name),
                            "client_status" => ($row->client_status > 0) ? value_by_id("tblclientstatus", $row->client_status, "name") : '',
                            "client_status_id" => $row->client_status,
                            "assigned_details" => $group_nams,
                            "outstanding" => $bal_amt,
                        );
                    }
                }
                $return_arr = array("status" => true, "message" => "Success", "total_running_amount" => number_format($ttl_running_amt, 2), "data" => (isset($output_arr) ? $output_arr : []));
            }
        }
        
        header('Content-type: application/json');
        echo json_encode($return_arr);
        // http://localhost/crm/Report_API/running_with_no_outstanding?user_id=1&status=1,2
    }

    /* This function use for client ledger api */
    public function client_ledger(){

        if(!empty($_GET))
        {
            extract($this->input->get());   
        }
        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }

        if(!empty($client_branch_id)){
            $branch = $this->db->query("SELECT * from tblclientbranch where userid = '".$client_branch_id."' order by client_branch_name asc")->row();
            $client_branch = array();
            
            if(!empty($branch)){
                $data['client_id'] = $branch->client_id;
            }
            $client_branch[] = $client_branch_id;
            $data['client_branch'] = $client_branch;
            $i = 0;
            $order = 'asc';
            $service_type = 2;

            $grand_bal = $grand_recevied = $allinvoice_ids = $alldn_ids = $ttl_billing = 0;
            $vendor_outstanding_amount = 0;
            /*get vendor outstanding amount if client have as vendor also */            
            $vendordata = $this->db->query("SELECT GROUP_CONCAT(vendor_id) as vendor_ids FROM `tblclientbranch` WHERE `userid` IN (".$client_branch_id.") ")->row();
            $vendorids_str = (!empty($vendordata)) ? $vendordata->vendor_ids : 0;
            if ($vendorids_str > 0){
                $vendor_outstanding_amount = get_vendor_ledger_amount($vendorids_str);
            }
            $output_arr = array();
            $site_info = $this->db->query("SELECT i.site_id, s.name FROM tblinvoices as  i LEFT JOIN tblsitemanager as s ON i.site_id = s.id where i.clientid = '".$client_branch_id."' and i.site_id > 0  GROUP By i.site_id ORDER by i.id DESC")->result();
            if(!empty($site_info)){
                foreach ($site_info as $r) {
                    $i++;
                    $site_id = $r->site_id;
                    $site_name = $r->name;
                    $site_info = $this->db->query("SELECT * FROM tblsitemanager where id = '".$site_id."' ")->row();
                    $ttl_bal = 0;
                    $ttl_recv = 0;
                    $ttl_amt = 0;
                    $ttl_tds = 0;
                    $parent_ids = 0;
                    $invoice_data = array();
                    $parent_invoice = $this->db->query("SELECT * FROM tblinvoices where clientid IN (".$client_branch_id.") and site_id = '".$site_id."' and service_type = '".$service_type."' and parent_id = '0' and status != '5' order by date ".$order." ")->result();
                    if (!empty($parent_invoice)){
                        
                        foreach ($parent_invoice as $parent) {
                            $parent_ids .= ','.$parent->id;
                            $allinvoice_ids .= ','.$parent->id;
                            $due_days= due_days($parent->payment_due_date);
                            
                            $received = invoice_received($parent->id);
                            $received_tds = invoice_tds_received($parent->id);
                            $bal_amt = ($parent->total - $received - $received_tds);

                            $ttl_recv += $received;
                            $ttl_tds += $received_tds;
                            $ttl_amt += $parent->total;
                            $ttl_bal += $bal_amt;
                            $grand_bal += $bal_amt;
                            $ttl_billing += $parent->total;

                            $payment_info = $this->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date, p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '2' and p.invoiceid = '".$parent->id."' and cp.status = 1 order by p.id asc ")->result();

                            // IF there is only one recored of payment which is made by cheque and cheque is not clear
                            if(count($payment_info) == 1){
                                if($payment_info[0]->payment_mode == 1 && $payment_info[0]->chaque_status != 1){
                                    $payment_info = '';
                                }
                            }
                            //Getting site person
                            $person_info = invoice_contact_person($parent->id);
                            $delivery_data = $this->get_delivery_info($parent->challan_id);
                            if(!empty($payment_info)){
                                $j = 0;
                                foreach ($payment_info as  $r1) {

                                    $to_see = ($r1->payment_mode == 1 && $r1->chaque_status != 1) ? '0' : '1';

                                    if($to_see == 1){
                                        $ref_no = value_by_id('tblclientpayment',$r1->pay_id,'reference_no');
                                        $receipt_date = $r1->date;
                                        if($r1->payment_mode == 1 && $r1->chaque_status == 1 && !empty($r1->chaque_clear_date)){
                                            $receipt_date = $r1->chaque_clear_date;
                                        }
                                        if($r1->amount >= $parent->total){
                                            $due_days = 'PAID';
                                        }elseif($parent->payment_due_date > date("Y-m-d")){
                                            $due_days = 0;
                                        }
                                        
                                        $invoice_data[] = array(
                                            "invoice_number" => $parent->number,
                                            "r_type" => "INV",
                                            "invoice_date" => $parent->invoice_date,
                                            "invoice_amount" => ($j == 0) ? $parent->total : '--',
                                            "total_recd" => ($j == 0) ? strval($received) : '--',
                                            "payment_recd" => $r1->amount,
                                            "tds" => $r1->paid_tds_amt,
                                            "balance" => ($j == 0) ? number_format($bal_amt, 2) : '--',
                                            "receipt_date" => ($r1->amount > 0) ? _d($receipt_date) : '--',
                                            "ref_detail" => $ref_no,
                                            "contact_person" => (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--',
                                            "due_days" => ($j == 0) ? $due_days : 0,
                                            "delivery_date" => $delivery_data["delivery_date"],
                                            "delivery_status" => $delivery_data["delivery_status"],
                                        );
                                        $j++;
                                    }
                                }
                            }else{
                                $invoice_data[] = array(
                                    "invoice_number" => $parent->number,
                                    "r_type" => "INV",
                                    "invoice_date" => $parent->invoice_date,
                                    "invoice_amount" => $parent->total,
                                    "total_recd" => '0.00',
                                    "payment_recd" => '0.00',
                                    "tds" => '--',
                                    "balance" => number_format($bal_amt, 2),
                                    "receipt_date" => '--',
                                    "ref_detail" => '--',
                                    "contact_person" => (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--',
                                    "due_days" => $due_days,
                                    "delivery_date" => $delivery_data["delivery_date"],
                                    "delivery_status" => $delivery_data["delivery_status"],
                                );
                            }
                            /* get child invoice */
                            $child_invoice = $this->db->query("SELECT * FROM tblinvoices where clientid IN (".$client_branch_id.") and site_id = '".$site_id."' and service_type = '".$service_type."' and parent_id = '".$parent->id."' and status != '5' order by date ".$order." ")->result();
                            if(!empty($child_invoice)){
                                foreach ($child_invoice as $child) {
                                    $allinvoice_ids .= ','.$child->id;
                                    $due_days = due_days($child->payment_due_date);

                                    $received = invoice_received($child->id);
                                    $received_tds = invoice_tds_received($child->id);
                                    $bal_amt = ($child->total - $received - $received_tds);

                                    $ttl_recv += $received;
                                    $ttl_tds += $received_tds;
                                    $ttl_amt += $child->total;
                                    $ttl_bal += $bal_amt;
                                    $grand_bal += $bal_amt;
                                    $ttl_billing += $child->total;

                                    $child_payment_info = $this->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '2' and p.invoiceid = '".$child->id."' and cp.status = 1 order by p.id asc ")->result();

                                    // IF there is only one recored of payment which is made by cheque and cheque is not clear
                                    if(count($child_payment_info) == 1){
                                        if($child_payment_info[0]->payment_mode == 1 && $child_payment_info[0]->chaque_status != 1){
                                            $child_payment_info = '';
                                        }
                                    }

                                    //Getting site person
                                    $person_info = invoice_contact_person($child->id);
                                    $delivery_data = $this->get_delivery_info($child->challan_id);
                                    if(!empty($child_payment_info)){
                                        $j = 0;
                                        $lastChildInvoiceId = 0;
                                        foreach ($child_payment_info as  $r2) {
                                            $to_see = ($r2->payment_mode == 1 && $r2->chaque_status != 1) ? '0' : '1';
                                            if($to_see == 1){
                                                $ref_no = value_by_id('tblclientpayment',$r2->pay_id,'reference_no');

                                                $receipt_date = $r2->date;
                                                if($r2->payment_mode == 1 && $r2->chaque_status == 1 && !empty($r2->chaque_clear_date)){
                                                    $receipt_date = $r2->chaque_clear_date;
                                                }
                                                if($r2->amount >= $child->total){
                                                    $due_days = 'PAID';
                                                }elseif($child->payment_due_date > date("Y-m-d")){
                                                    $due_days = 0;
                                                }
                                                $invoice_data[] = array(
                                                    "invoice_number" => $child->number,
                                                    "r_type" => "INV",
                                                    "invoice_date" => $child->invoice_date,
                                                    "invoice_amount" => ($j == 0) ? $child->total : '--',
                                                    "total_recd" => ($j == 0) ? strval($received) : '--',
                                                    "payment_recd" => $r2->amount,
                                                    "tds" => $r2->paid_tds_amt,
                                                    "balance" => ($j == 0) ? number_format($bal_amt, 2) : '--',
                                                    "receipt_date" => ($r2->amount > 0) ? _d($receipt_date) : '--',
                                                    "ref_detail" => $ref_no,
                                                    "contact_person" => (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--',
                                                    "due_days" => ($j == 0) ? $due_days : 0,
                                                    "delivery_date" => $delivery_data["delivery_date"],
                                                    "delivery_status" => $delivery_data["delivery_status"],
                                                );
                                                $lastChildInvoiceId = $child->id;
                                                $j++;
                                            }else{
                                                if($child->id != $lastChildInvoiceId){
                                                    $invoice_data[] = array(
                                                        "invoice_number" => $child->number,
                                                        "r_type" => "INV",
                                                        "invoice_date" => $child->invoice_date,
                                                        "invoice_amount" => $child->total,
                                                        "total_recd" => '0.00',
                                                        "payment_recd" => '0.00',
                                                        "tds" => '--',
                                                        "balance" => number_format($bal_amt, 2),
                                                        "receipt_date" => '--',
                                                        "ref_detail" => '--',
                                                        "contact_person" => (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--',
                                                        "due_days" => $due_days,
                                                        "delivery_date" => $delivery_data["delivery_date"],
                                                        "delivery_status" => $delivery_data["delivery_status"],
                                                    );
                                                }
                                                $lastChildInvoiceId = $child->id;
                                            }
                                        }
                                    }else{
                                        $invoice_data[] = array(
                                            "invoice_number" => $child->number,
                                            "r_type" => "INV",
                                            "invoice_date" => $child->invoice_date,
                                            "invoice_amount" => $child->total,
                                            "total_recd" => '0.00',
                                            "payment_recd" => '0.00',
                                            "tds" => '--',
                                            "balance" => number_format($bal_amt, 2),
                                            "receipt_date" => '--',
                                            "ref_detail" => '--',
                                            "contact_person" => (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--',
                                            "due_days" => $due_days,
                                            "delivery_date" => $delivery_data["delivery_date"],
                                            "delivery_status" => $delivery_data["delivery_status"],
                                        );
                                    }
                                }
                            }
                        }

                        //Getting Debit Notes againt parent invoice
                        $debit_note_info = $this->db->query("SELECT * FROM tbldebitnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' order by dabit_note_date ".$order." ")->result();
                        if(!empty($debit_note_info)){
                            foreach ($debit_note_info as $debitnote) {
                                $alldn_ids .= ','.$debitnote->id;

                                $received = debitnote_received($debitnote->number);
                                $received_tds = debitnote_tds_received($debitnote->number);
                                $bal_amt = ($debitnote->totalamount - $received - $received_tds);

                                $ttl_recv += $received;
                                $ttl_tds += $received_tds;
                                $ttl_amt += $debitnote->totalamount;
                                $ttl_bal += $bal_amt;
                                $grand_bal += $bal_amt;
                                $ttl_billing += $debitnote->totalamount;
                                $debitnote_payment = $this->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '3' and p.debitnote_no = '".$debitnote->number."' and cp.status = 1 order by p.id asc ")->result();

                                // IF there is only one recored of payment which is made by cheque and cheque is not clear
                                if(count($debitnote_payment) == 1){
                                    if($debitnote_payment[0]->payment_mode == 1 && $debitnote_payment[0]->chaque_status != 1){
                                        $debitnote_payment = '';
                                    }
                                }
                                if(!empty($debitnote_payment)){
                                    $j = 0;
                                    foreach ($debitnote_payment as  $r3) {
                                        $to_see = ($r3->payment_mode == 1 && $r3->chaque_status != 1) ? '0' : '1';
                                        if($to_see == 1){    

                                            $ref_no = value_by_id('tblclientpayment',$r3->pay_id,'reference_no');
                                            $receipt_date = _d($r3->date);
                                            if($r3->payment_mode == 1 && $r3->chaque_status == 1 && !empty($r3->chaque_clear_date)){
                                                $receipt_date = _d($r3->chaque_clear_date);
                                            }

                                            $invoice_data[] = array(
                                                "invoice_number" => $debitnote->number,
                                                "r_type" => "DN",
                                                "invoice_date" => $debitnote->dabit_note_date,
                                                "invoice_amount" => ($j == 0) ? $debitnote->totalamount : '--',
                                                "total_recd" => ($j == 0) ? strval($received) : '--',
                                                "payment_recd" => $r3->amount,
                                                "tds" => $r3->paid_tds_amt,
                                                "balance" => ($j == 0) ? number_format($bal_amt, 2) : '--',
                                                "receipt_date" => $receipt_date,
                                                "ref_detail" => $ref_no,
                                                "contact_person" => '--',
                                                "due_days" => 0,
                                                "delivery_date" => '--',
                                                "delivery_status" => '--',
                                            );
                                            $j++;
                                        }
                                    }
                                }else{
                                    $invoice_data[] = array(
                                        "invoice_number" => $debitnote->number,
                                        "r_type" => "DN",
                                        "invoice_date" => $debitnote->dabit_note_date,
                                        "invoice_amount" => $debitnote->totalamount,
                                        "total_recd" => '0.00',
                                        "payment_recd" => '0.00',
                                        "tds" => '--',
                                        "balance" => number_format($bal_amt, 2),
                                        "receipt_date" => '--',
                                        "ref_detail" => '--',
                                        "contact_person" => '--',
                                        "due_days" => 0,
                                        "delivery_date" => '--',
                                        "delivery_status" => '--',
                                    );
                                }
                            }
                        }

                        //Getting Credit Notes againt parent invoice
                        $credit_note_info = $this->db->query("SELECT * FROM tblcreditnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' order by date ".$order." ")->result();
                        if(!empty($credit_note_info)){
                            foreach ($credit_note_info as $creditnote) {

                                $ttl_recv += $creditnote->totalamount;
                                $ttl_bal -= $creditnote->totalamount;
                                $grand_bal -= $creditnote->totalamount;

                                $invoice_data[] = array(
                                    "invoice_number" => $creditnote->number,
                                    "r_type" => "CN",
                                    "invoice_date" => $creditnote->date,
                                    "invoice_amount" => '0.00',
                                    "total_recd" => $creditnote->totalamount,
                                    "payment_recd" => '0.00',
                                    "tds" => '0.00',
                                    "balance" => '--',
                                    "receipt_date" => '--',
                                    "ref_detail" => '--',
                                    "contact_person" => '--',
                                    "due_days" => 0,
                                    "delivery_date" => '--',
                                    "delivery_status" => '--',
                                );

                            }
                        }
                    }
                    if (!empty($invoice_data)){
                        $output_arr["site_data"][] = array(
                            "site_name" => $site_name,
                            "invoice_data" => $invoice_data,
                            "ttl_invoice_amt" => number_format($ttl_amt, 2),
                            "ttl_recd_amt" => number_format($ttl_recv, 2),
                            "ttl_payment_recd_amt" => number_format($ttl_recv, 2),
                            "tds" => number_format($ttl_tds, 2),
                            "balance" => number_format($ttl_bal, 2),
                        );
                    }
                    $grand_recevied += ($ttl_recv + $ttl_tds);
                }
            }

            /* getting debitnote payment */
            $payment_debitnote = $this->db->query("SELECT dn.* from tbldebitnotepayment as dn LEFT JOIN tbldebitnotepaymentitems as i ON dn.id = i.debitnote_id where i.invoice_id IN (".$allinvoice_ids.") and i.invoice_id > 0 and i.type = 1 and dn.status > 0  GROUP by dn.id ")->result();
            if(empty($payment_debitnote)){
                $payment_debitnote = $this->db->query("SELECT dn.* from tbldebitnotepayment as dn LEFT JOIN tbldebitnotepaymentitems as i ON dn.id = i.debitnote_id where i.invoice_id IN (".$alldn_ids.") and i.invoice_id > 0 and i.type = 2 and dn.status > 0  GROUP by dn.id ")->result();
            }
            if(!empty($payment_debitnote)){
                $ttl_bal = 0;
                $ttl_tds = 0;
                $ttl_recv = 0;
                $ttl_amt = 0;
                $dn_payment = array();
                foreach ($payment_debitnote as $debitnote) {
                    $received = debitnote_received($debitnote->number);
                    $received_tds = debitnote_tds_received($debitnote->number);
                    $bal_amt = ($debitnote->amount - $received - $received_tds);

                    $ttl_recv += $received;
                    $ttl_tds += $received_tds;
                    $ttl_amt += $debitnote->amount;
                    $ttl_bal += $bal_amt;
                    $grand_bal += $bal_amt;

                    $ttl_billing += $debitnote->amount;
                    $debitnote_payment = $this->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '3' and p.debitnote_no = '".$debitnote->number."' and cp.status = 1 order by p.id asc ")->result();
                    // IF there is only one recored of payment which is made by cheque and cheque is not clear
                    if(count($debitnote_payment) == 1){
                        if($debitnote_payment[0]->payment_mode == 1 && $debitnote_payment[0]->chaque_status != 1){
                            $debitnote_payment = '';
                        }
                    }

                    if(!empty($debitnote_payment)){
                        $j = 0;
                        foreach ($debitnote_payment as  $r4) {

                            $to_see = ($r4->payment_mode == 1 && $r4->chaque_status != 1) ? '0' : '1';
                            if($to_see == 1){
                                $ref_no = value_by_id('tblclientpayment',$r4->pay_id,'reference_no');

                                $receipt_date = _d($r4->date);
                                if($r4->payment_mode == 1 && $r4->chaque_status == 1 && !empty($r4->chaque_clear_date)){
                                    $receipt_date = _d($r4->chaque_clear_date);
                                }
                                $dn_payment[] = array(
                                    "details" => "DN (Delay in Payment)",
                                    "dn_number" => $debitnote->number,
                                    "dn_date" => _d($debitnote->date),
                                    "amount" => ($j == 0) ? $debitnote->amount : '--',
                                    "total_recd" => ($j == 0) ? strval($received) : '--',
                                    "payment_recd" => $r4->amount,
                                    "tds" => $r4->paid_tds_amt,
                                    "payment_bal" => ($j == 0) ? number_format($bal_amt, 2) : '--',
                                    "remark" => $r4->note,
                                    "payment_receipt_date" => $receipt_date,
                                    "payment_ref_detail" => $ref_no,
                                );
                                $j++;
                            }
                        }
                    }else{
                        $dn_payment[] = array(
                            "details" => "DN (Delay in Payment)",
                            "dn_number" => $debitnote->number,
                            "dn_date" => _d($debitnote->date),
                            "amount" => $debitnote->amount,
                            "total_recd" => '0.00',
                            "payment_recd" => '0.00',
                            "tds" => '--',
                            "payment_bal" => number_format($bal_amt, 2),
                            "remark" => '--',
                            "payment_receipt_date" => '--',
                            "payment_ref_detail" => '--',
                        );
                    
                    }
                }
                if (!empty($dn_payment)){
                    $output_arr["dn_payment"]["data"] = $dn_payment;
                    $output_arr["dn_payment"]["ttl_amt"] = number_format($ttl_amt, 2);
                    $output_arr["dn_payment"]["ttl_recd_amt"] = number_format($ttl_recv, 2);
                    $output_arr["dn_payment"]["ttl_payment_recd_amt"] = number_format($ttl_recv, 2);
                    $output_arr["dn_payment"]["tds"] = number_format($ttl_tds, 2);
                    $output_arr["dn_payment"]["balance"] = number_format($ttl_bal, 2);
                }
                $grand_recevied += ($ttl_recv + $ttl_tds);
            }
            /* this is for gettting on account */
            $onaccout_amt = 0;
            $onaccout_amt_info = $this->db->query("SELECT * FROM `tblclientpayment`  where client_id IN (".$client_branch_id.") and payment_behalf = 1 and service_type = '".$service_type."' and status = 1 ")->result();  
            if(!empty($onaccout_amt_info)){
                foreach ($onaccout_amt_info as $on_am) {
                    $to_see = ($on_am->payment_mode == 1 && $on_am->chaque_status != 1) ? '0' : '1';
                    if($to_see == 1){
                        $onaccout_amt += $on_am->ttl_amt;
                    }
                }
            }
            $waveoff_amt = $this->db->query("SELECT COALESCE(SUM(amount),0) AS ttl_amount FROM `tblclientwaveoff`  where client_id IN (".$client_branch_id.") and status = 1 and service_type = '".$service_type."' ")->row()->ttl_amount;
            $onaccout_info = $this->db->query("SELECT * FROM `tblclientpayment`  where client_id IN (".$client_branch_id.") and payment_behalf = 1 and service_type = '".$service_type."' and status = 1 ")->result();
            $waveoff_info = $this->db->query("SELECT * FROM `tblclientwaveoff`  where client_id IN (".$client_branch_id.") and status = 1 and service_type = '".$service_type."' ")->result();
            $pendingcheque_info = $this->db->query("SELECT * FROM `tblclientpayment`  where client_id IN (".$client_branch_id.") and payment_mode = 1 and chaque_status IN (0,2,3,4) and status = 1 ")->result();
            $clientdeposits_info = $this->db->query("SELECT * FROM `tblclientdeposits`  where client_id IN (" . $client_branch_id . ") and status = 1 ")->result();
            $clientrefund_info = $this->db->query("SELECT r.*, pd.utr_no, pd.utr_date,pd.method from  tblclientrefund as r LEFT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'client_refund' where client_id IN (" . $client_branch_id . ") and pd.utr_no != '' and service_type = '".$service_type."' order by r.id desc")->result();

            $clientrefund_amt = $this->db->query("SELECT COALESCE(SUM(r.amount),0) AS ttl_amount from  tblclientrefund as r LEFT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'client_refund' where client_id IN (" . $client_branch_id . ") and pd.utr_no != '' and service_type = '".$service_type."' order by r.id desc")->row()->ttl_amount;
            $final_balance = (round($grand_bal) - round($onaccout_amt) - round($waveoff_amt) + round($clientrefund_amt)) - $vendor_outstanding_amount;
            
            $output_arr["ttl_billing"] = round($ttl_billing).'.00';
            $output_arr["ttl_recevied"] = round($grand_recevied).'.00';
            $output_arr["ttl_balance"] = round($grand_bal).'.00';
            $output_arr["onaccount"] = "-".round($onaccout_amt).'.00';
            /*waveoff amount details*/
            if(!empty($waveoff_info)){
                foreach ($waveoff_info as $wave_row) {
                    $title = (!empty($wave_row->remark)) ? '"'.$wave_row->remark.'"' : "Waveoff";
                    $output_arr[$title."_sign"] = ($wave_row->amount > 0) ? '-' : '+';
                    $output_arr[$title] = round($wave_row->amount).'.00';
                }
            }
            /*client refund details*/
            if(!empty($clientrefund_info)){
                foreach ($clientrefund_info as $crrow) {
                    $output_arr["client_refund"] = round($crrow->amount).'.00';
                }
            }
            if ($vendor_outstanding_amount > 0){
                $output_arr["vendor_outstanding_sign"] = '-';
                $output_arr["vendor_outstanding_amt"] = round($vendor_outstanding_amount).'.00';
            }
            $output_arr["final_amount"] = round($final_balance).'.00';

            // IF there is only one recored of payment which is made by cheque and cheque is not clear
            if(count($onaccout_info) == 1){
                if($onaccout_info[0]->payment_mode == 1 && $onaccout_info[0]->chaque_status != 1){
                    $onaccout_info = '';
                }
            }
            /* on account details */
            if(!empty($onaccout_info)){
                foreach ($onaccout_info as $key => $on_acc) {

                    $to_see = ($on_acc->payment_mode == 1 && $on_acc->chaque_status != 1) ? '0' : '1';

                    $onAccountDate = _d($on_acc->date);
                    if(!empty($on_acc->chaque_clear_date)){
                        $onAccountDate = _d($on_acc->chaque_clear_date);
                    }

                    if($to_see == 1){
                        $output_arr["onaccount_list"][] = array(
                            "onaccount_date" => $onAccountDate,
                            "reference_no" => $on_acc->reference_no,
                            "ttl_amt" => $on_acc->ttl_amt,
                        );
                    }
                }
            }
            /* get pending cheque data */
            if(!empty($pendingcheque_info)){
                foreach ($pendingcheque_info as $key => $client_pay) {
                    switch ($client_pay->chaque_status) {
                        case 0:
                            $status = 'Pending';
                            break;
                        case 2:
                            $status = 'Bounced';
                            break;
                        case 3:
                            $status = 'Redeposit';
                            break;
                        default:
                            $status = 'Cancel';
                            break;
                    }
                    $output_arr["pending_cheque"][] = array(
                        "cheque_no" => $client_pay->cheque_no,
                        "cheque_date" => _d($client_pay->cheque_date),
                        "status" => $status,
                    );
                }
            }
            /* get client deposites data */
            if (!empty($clientdeposits_info)) {
                foreach ($clientdeposits_info as $key => $deposit) {
                    if ($deposit->payment_mode == 1) {
                        $mode = 'Cheque';
                    } else if ($deposit->payment_mode == 2) {
                        $mode = 'NEFT';
                    } else if ($deposit->payment_mode == 3) {
                        $mode = 'Cash';
                    }
                    $output_arr["client_deposits"][] = array(
                        "date" => _d($deposit->date),
                        "mode" => $mode,
                        "bank_name" => value_by_id("tblbankmaster", $deposit->bank_id, "name"),
                        "amount" => $deposit->ttl_amt,
                    );
                }
            }
            /* client refund data */
            if (!empty($clientrefund_info)){
                foreach ($clientrefund_info as $key => $refunddata) {
                    $output_arr["client_refund"][] = array(
                        "date" => _d($refunddata->date),
                        "utr_no" => $refunddata->utr_no,
                        "method" => $refunddata->method,
                        "amount" => $refunddata->amount,
                    );
                }
            }
             $return_arr = array("status" => true, "message" => "Success", "data" => (isset($output_arr) ? $output_arr : []));
        }else{
             $return_arr = array("status" => false, "message" => "Required parameters are missing", "data" => []);
        }

        
       
        header('Content-type: application/json');
        echo json_encode($return_arr);
        // http://localhost/crm/Report_API/client_ledger/1
    }

    /* this function use for get delivery info */
    private function get_delivery_info($challan_id){
        if ($challan_id > 0){
            $delivery_status = 'Challan Not Created';
            $delivery_date = '--';
            $delivery_data = $this->db->query("SELECT ch.*, c.order_status_id, c.complete_status FROM `tblconfirmorder` as c LEFT JOIN `tblchalanmst` as ch  ON (`ch`.`rel_id` = `c`.`estimate_id` AND `ch`.`rel_type` = 'estimate') OR (`ch`.`rel_id` = `c`.`proformachallan_id` AND `ch`.`rel_type` = 'proforma_challan') WHERE ch.id = '".$challan_id."' ORDER BY ch.id DESC")->row();
            if (!empty($delivery_data)){
                if ($delivery_data->complete_status == 1 && $delivery_data->approve_status == 1){
                    $delivery_ho = $this->db->query("SELECT * from `tblchallanprocess` where chalan_id = '".$challan_id."' and `for` = 1 ")->row();
                    $delivery_date = (!empty($delivery_ho)) ? _d($delivery_ho->date) : '--';
                    if ($delivery_data->process == 0){
                        $delivery_status = "Delivery Pending";
                    }else if ($delivery_data->process == 1 && $delivery_data->under_process == 1){
                        $delivery_status = "Delivery In Process";
                    }else if ($delivery_data->process == 1 && $delivery_data->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 1 && $delivery_data->service_type == 2){
                        $delivery_status = "Completed";
                    }else{
                        $delivery_status = 'Pending';
                    } 
                }else{
                    if ($delivery_data->order_status_id > 0){
                        $delivery_status = value_by_id("tblconfirmorderstatus", $delivery_data->order_status_id, "title");
                    }else{
                        $delivery_status = "Production Pending";
                    }
                }
            }
            return array("delivery_status"=> $delivery_status, "delivery_date" => $delivery_date);
        }else{
            return array("delivery_status"=> 'Challan Not Created', "delivery_date" => '--');
        }
        
        
    }
}
