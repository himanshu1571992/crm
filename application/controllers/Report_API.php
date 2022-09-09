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
}
