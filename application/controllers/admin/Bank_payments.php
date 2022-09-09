<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Bank_payments extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function index()
    {
        check_permission(57,'view');

        if(!empty($_POST)){
            extract($this->input->post());

            $data['s_fdate'] = $f_date;
            $data['s_tdate'] = $t_date;

            $f_date = str_replace("/","-",$f_date);
            $f_date = date("Y-m-d",strtotime($f_date));

            $t_date = str_replace("/","-",$t_date);
            $t_date = date("Y-m-d",strtotime($t_date));

            $data['payment_info']  = $this->db->query("SELECT * FROM tblbankpayment WHERE save = 0 and created_at BETWEEN '".$f_date."' and '".$t_date."' order by id desc")->result();

        }else{
            $data['payment_info']  = $this->db->query("SELECT * FROM tblbankpayment WHERE save = 0 and MONTH(created_at) = '".date('m')."' and YEAR(created_at) = '".date('Y')."' order by id desc")->result();
        }



        $data['title'] = 'Payment List';
        $this->load->view('admin/bank_payments/manage', $data);

    }

    public function add($id="")
    {
        check_permission(57,'create');

        $data['type'] = '';
        $data['type_id'] = 0;
        if(!empty($_GET['type'])){
            $data['type'] = $_GET['type'];
            $data['type_id'] = $_GET['id'];
        }

        $data['category_info']  = $this->db->query("SELECT * FROM tblcompanyexpensecatergory WHERE status = 1 order by name asc ")->result();
        $data['bank_info']  = $this->db->query("SELECT * FROM tblbankmaster WHERE status = 1 order by name asc ")->result();

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

        if(!empty($_POST)){
            extract($this->input->post());

            $assignstaff = $_POST['assign']['assignid'];
            foreach($assignstaff as $single_staff)
            {
                if (strpos($single_staff, 'staff') !== false)
                {
                    $staff_id[]=str_replace("staff","",$single_staff);
                }
            }


            /*echo '<pre/>';
            print_r($_POST);
            die;*/
            if(!empty($save) && $save == 1){
                $save = 1;
                $staff_id = [];
            }else{
                $save = 0;
                if(empty($staff_id)){
                    set_alert('warning', 'Assignees can\'t be empty! ');
                    redirect(admin_url('bank_payments/add'));
                }
            }


            $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'billing_branch_id' => get_login_branch(),
                'remark' => $remark,
                'created_at' => date('Y-m-d'),
                'save' => $save,
                'status' => 0,
            );

            if(!empty($save_id)){
               $insert = $this->home_model->update('tblbankpayment', $ad_data,array('id'=>$save_id));
            }else{
               $insert = $this->home_model->insert('tblbankpayment', $ad_data);
            }


            if($insert){

                if(!empty($save_id)){
                    $this->home_model->delete('tblbankpaymentdetails', array('main_id'=>$save_id));
                    $this->home_model->delete('tblbankpaymentapproval', array('payment_id'=>$save_id));
                    $this->home_model->delete('tblmasterapproval', array('table_id'=>$save_id, 'module_id'=>'8'));
                    $main_id = $save_id;
                }else{
                    $main_id = $this->db->insert_id();
                }



                if(!empty($paymentdata)){
                    foreach ($paymentdata as $key => $value) {

                       $date_arr = explode("/",$value['date']);
                       $date = $date_arr[2].'-'.$date_arr[0].'-'.$date_arr[1];


                       $fromdate = '0000-00-00';
                       $todate = '0000-00-00';
                       $deposit = '0';
                       $pay_type = '';
                       $pay_type_id = '0';
                       $payee_id = '0';
                       $payee_name = '';
                       if(!empty($value['fromdate'])){
                            $fdate_arr = explode("/",$value['fromdate']);
                            $fromdate = $fdate_arr[2].'-'.$fdate_arr[0].'-'.$fdate_arr[1];
                       }

                       if(!empty($value['todate'])){
                            $tdate_arr = explode("/",$value['todate']);
                            $todate = $tdate_arr[2].'-'.$tdate_arr[0].'-'.$tdate_arr[1];
                       }

                       if(!empty($value['deposit'])){
                            $deposit = $value['deposit'];
                       }

                       if(!empty($value['pay_type'])){
                            $pay_type = $value['pay_type'];
                       }

                       if(!empty($value['pay_type_id'])){
                            $pay_type_id = $value['pay_type_id'];
                       }

                       if(!empty($value['bank_id'])){
                            if($value['bank_id'] == 1){
                                $account_no = 0;
                            }else{
                                $account_no = value_by_id('tblbankmaster',$value['bank_id'],'account_no');
                            }
                       }

                       if(!empty($value['payee'])){
                            $payee_id = $value['payee'];
                       }
                       if(!empty($value['payee_name'])){
                            $payee_name = $value['payee_name'];
                       }

                       $cheque_id = (!empty($value['cheque_id'])) ? $value['cheque_id'] : 0;
                       $cheque_no = (!empty($value['cheque_bank_no'])) ? $value['cheque_bank_no'] : 0;
                        $ad_data_1 = array(
                            'main_id' => $main_id,
                            'date' => $date,
                            'category_id' => $value['category_id'],
                            'bank_id' => $value['bank_id'],
                            'payee_id' => $payee_id,
                            'payee_name' => $payee_name,
                            'ifsc' => $value['ifsc'],
                            'account' => $value['account'],
                            'method' => $value['method'],
                            'type' => $value['type'],
                            'amount' => $value['amount'],
                            'first_remark' => $value['first_remark'],
                            'second_remark' => $value['second_remark'],
                            'company_code' => $company_code,
                            'account_no' => $account_no,
                            'fromdate' => $fromdate,
                            'todate' => $todate,
                            'deposit' => $deposit,
                            'pay_type' => $pay_type,
                            'pay_type_id' => $pay_type_id,
                            'cheque_id' => $cheque_id,
                            'cheque_no' => $cheque_no,
                        );

                        $insert_1 = $this->home_model->insert('tblbankpaymentdetails', $ad_data_1);

                        if($pay_type == 'po_payment'){
                            $this->home_model->update('tblpurchaseorderpayments', array('payfile_done'=>1),array('id'=>$pay_type_id));

                            if($save == 0){
                               //Adding Paid Amount to Vendor On Account
                                $payment_info  = $this->db->query("SELECT * FROM tblpurchaseorderpayments WHERE id = '".$pay_type_id."' ")->row();
                                $vendor_id = value_by_id('tblpurchaseorder',$payment_info->po_id,'vendor_id');
                                $number = value_by_id('tblpurchaseorder',$payment_info->po_id,'number');
                                $po_number = (is_numeric($number)) ? 'PO-'.$number : $number;

                                $p_mode = 3;
                                if($value['method'] == 'CHEQUE'){
                                   $p_mode = 1;
                               }elseif($value['method'] == 'NEFT'){
                                   $p_mode = 2;
                                }elseif($value['method'] == 'CASH'){
                                   $p_mode = 3;
                                }


                                $ad_data_2 = array(
                                        'staff_id' => get_staff_user_id(),
                                        'year_id' => financial_year(),
                                        'vendor_id' => $vendor_id,
                                        'payment_behalf' => 1,
                                        'payment_mode' => $p_mode,
                                        'chaque_for' => 0,
                                        'cheque_no' => 0,
                                        'cheque_date' => '0000-00-00',
                                        'invoice_id' => '',
                                        'ttl_amt' => $payment_info->approved_amount,
                                        'reference_no' => '',
                                        'remark' => 'By Purchase Order Payment '.$po_number,
                                        'date' => date('Y-m-d'),
                                        'status' => 1,
                                        'created_date' => date('Y-m-d H:i:s')
                                    );
                                $this->home_model->insert('tblvendorpayment', $ad_data_2);
                            }


                        }elseif($pay_type == 'pay_request'){
                           // $this->home_model->update('tblbankpaymentrequest', array('status'=>2),array('id'=>$pay_type_id));
                            $this->home_model->update('tblpaymentrequest', array('payfile_done'=>1),array('id'=>$pay_type_id));
                        }elseif($pay_type == 'request'){
                            $this->home_model->update('tblrequests', array('payfile_done'=>1),array('id'=>$pay_type_id));
                        }elseif($pay_type == 'pettycash'){
                            $this->home_model->update('tblpettycashrequest', array('payfile_done'=>1),array('id'=>$pay_type_id));
                        }elseif($pay_type == 'client_deposit'){
                            $this->home_model->update('tblclientdeposits', array('payfile_done'=>1),array('id'=>$pay_type_id));
                        }elseif($pay_type == 'employee_salary'){
                            $this->home_model->update('tblsalarypaidlog', array('payfile_done'=>1),array('id'=>$pay_type_id));
                        }elseif($pay_type == 'client_refund'){
                            $this->home_model->update('tblclientrefund', array('payfile_done'=>1),array('id'=>$pay_type_id));
                        }


                    }

                    if($insert_1){
                        if(!empty($staff_id)){
                            foreach($staff_id as $single_staff)
                            {
                                if($single_staff!=get_staff_user_id())
                                {
                                    $sdata['staffid']=$single_staff;
                                    $sdata['payment_id']=$main_id;
                                    $sdata['status']=1;
                                    $sdata['created_at'] = date("Y-m-d H:i:s");
                                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                                    $this->db->insert('tblbankpaymentapproval', $sdata);

                                    $adata = array(
                                        'staff_id' => $single_staff,
                                        'fromuserid'      => get_staff_user_id(),
                                        'module_id' => 8,
                                        'table_id' => $main_id,
                                        'approve_status' => 0,
                                        'status' => 0,
                                        'description'     => 'Bank Payment For Approval',
                                        'link' => 'bank_payments/view/'.$main_id.'/approval',
                                        'date' => date('Y-m-d'),
                                        'date_time' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s')
                                    );
                                    $this->db->insert('tblmasterapproval', $adata);

                                    //Sending Mobile Intimation
                                    $token = get_staff_token($single_staff);
                                    $message = 'Bank Payment For Approval';
                                    $title = 'Schach';
                                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                                }
                            }
                        }

                    }
                }


                set_alert('success', 'Payment added Successfully');
                redirect(admin_url('bank_payments'));
            }
        }

        if(!empty($id)){
            $data['payments_info']  = $this->db->query("SELECT * FROM tblbankpaymentdetails WHERE main_id = '".$id."'")->result();
            $data['main_info']  = $this->db->query("SELECT * FROM tblbankpayment WHERE id = '".$id."'")->row();
            $data['id'] = $id;
            $data['title'] = 'Edit Payments';
        }else{
            $data['save_info']  = $this->db->query("SELECT * FROM tblbankpayment WHERE save = 1 order by id desc ")->row();
            if(!empty($data['save_info'])){
                $data['save_payments_info']  = $this->db->query("SELECT * FROM tblbankpaymentdetails WHERE main_id = '".$data['save_info']->id."'")->result();
            }

            $data['title'] = 'Add Payments';
        }


        $this->load->view('admin/bank_payments/add_new', $data);

    }


    public function edit($id="")
    {

        check_permission(57,'edit');

        if(!empty($_POST)){
            extract($this->input->post());

            $assignstaff = $_POST['assign']['assignid'];
            foreach($assignstaff as $single_staff)
            {
                if (strpos($single_staff, 'staff') !== false)
                {
                    $staff_id[]=str_replace("staff","",$single_staff);
                }
            }

            $ad_data = array(
                            'staff_id' => get_staff_user_id(),
                            'remark' => $remark,
                            'created_at' => date('Y-m-d'),
                            'status' => 0
                        );

            $update = $this->home_model->update('tblbankpayment', $ad_data,array('id'=>$id));

            if($update){

                $this->home_model->delete('tblbankpaymentdetails', array('main_id'=>$id));
                $this->home_model->delete('tblbankpaymentapproval', array('payment_id'=>$id));
                //$this->home_model->delete('tblnotifications', array('table_id'=>$id, 'description'=>'Bank Payment For Approval'));
                $this->home_model->delete('tblmasterapproval', array('table_id'=>$id, 'module_id'=>'8'));

                if(!empty($paymentdata)){
                    foreach ($paymentdata as $key => $value) {

                       $date_arr = explode("/",$value['date']);
                       $date = $date_arr[2].'-'.$date_arr[0].'-'.$date_arr[1];


                       $fromdate = '0000-00-00';
                       $todate = '0000-00-00';
                       $deposit = '0';
                       $pay_type = '';
                       $payee_name = '';
                       $pay_type_id = '0';
                       $payee_id = '0';
                       if(!empty($value['fromdate'])){
                            $fdate_arr = explode("/",$value['fromdate']);
                            $fromdate = $fdate_arr[2].'-'.$fdate_arr[0].'-'.$fdate_arr[1];
                       }

                       if(!empty($value['todate'])){
                            $tdate_arr = explode("/",$value['todate']);
                            $todate = $tdate_arr[2].'-'.$tdate_arr[0].'-'.$tdate_arr[1];
                       }

                       if(!empty($value['deposit'])){
                            $deposit = $value['deposit'];
                       }

                       if(!empty($value['pay_type'])){
                            $pay_type = $value['pay_type'];
                       }

                       if(!empty($value['pay_type_id'])){
                            $pay_type_id = $value['pay_type_id'];
                       }

                       if(!empty($value['bank_id'])){
                            if($value['bank_id'] == 1){
                                $account_no = 0;
                            }else{
                                $account_no = value_by_id('tblbankmaster',$value['bank_id'],'account_no');
                            }
                       }

                       if(!empty($value['payee'])){
                            $payee_id = $value['payee'];
                       }
                       if(!empty($value['payee_name'])){
                            $payee_name = $value['payee_name'];
                       }
                       $cheque_id = (!empty($value['cheque_id'])) ? $value['cheque_id'] : 0;
                       $cheque_no = (!empty($value['cheque_bank_no'])) ? $value['cheque_bank_no'] : 0;
                        $ad_data_1 = array(
                            'main_id' => $id,
                            'date' => $date,
                            'category_id' => $value['category_id'],
                            'bank_id' => $value['bank_id'],
                            'payee_id' => $payee_id,
                            'payee_name' => $payee_name,
                            'ifsc' => $value['ifsc'],
                            'account' => $value['account'],
                            'method' => $value['method'],
                            'type' => $value['type'],
                            'amount' => $value['amount'],
                            'first_remark' => $value['first_remark'],
                            'second_remark' => $value['second_remark'],
                            'company_code' => $company_code,
                            'account_no' => $account_no,
                            'fromdate' => $fromdate,
                            'todate' => $todate,
                            'deposit' => $deposit,
                            'pay_type' => $pay_type,
                            'pay_type_id' => $pay_type_id,
                            'cheque_id' => $cheque_id,
                            'cheque_no' => $cheque_no,
                        );

                        $insert_1 = $this->home_model->insert('tblbankpaymentdetails', $ad_data_1);



                    }

                    if($insert_1){
                        if(!empty($staff_id)){
                            foreach($staff_id as $single_staff)
                            {
                                if($single_staff!=get_staff_user_id())
                                {
                                    $sdata['staffid']=$single_staff;
                                    $sdata['payment_id']=$id;
                                    $sdata['status']=1;
                                    $sdata['created_at'] = date("Y-m-d H:i:s");
                                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                                    $this->db->insert('tblbankpaymentapproval', $sdata);

                                    $adata = array(
                                        'staff_id' => $single_staff,
                                        'fromuserid'      => get_staff_user_id(),
                                        'module_id' => 8,
                                        'table_id' => $id,
                                        'approve_status' => 0,
                                        'status' => 0,
                                        'description'     => 'Bank Payment For Approval',
                                        'link' => 'bank_payments/view/'.$id.'/approval',
                                        'date' => date('Y-m-d'),
                                        'date_time' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s')
                                    );
                                    $this->db->insert('tblmasterapproval', $adata);

                                    //Sending Mobile Intimation
                                    $token = get_staff_token($single_staff);
                                    $message = 'Bank Payment For Approval';
                                    $title = 'Schach';
                                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                                }
                            }
                        }

                    }
                }


                set_alert('success', 'Payment updated Successfully');
                redirect(admin_url('bank_payments'));
            }
        }


    }



    public function view($id,$action="")
    {

        if(!empty($action)){

             $info = $this->db->query("SELECT * FROM tblbankpayment WHERE id = '".$id."'")->row();

             if($info->status != 0 && $info->status != 5){
                set_alert('warning', 'Action Alreadt Taken!');
                redirect(admin_url('bank_payments'));
             }


            $data['title'] = 'Payment Approval';
            $data['action'] = 1;
            
            $data['approval_info']  = $this->db->query("SELECT * FROM tblbankpaymentapproval WHERE payment_id = '".$id."' and approve_status !=0")->row();
        }else{
            $data['title'] = 'Payment Details';
        }

        $data['payments_info']  = $this->db->query("SELECT * FROM tblbankpaymentdetails WHERE main_id = '".$id."'")->result();
        $data['id'] = $id;

        $this->load->view('admin/bank_payments/view', $data);
    }

    public function payment_approval()
    {

        if(!empty($_POST)){
            extract($this->input->post());

            $user_id = get_staff_user_id();

            $update = $this->home_model->update('tblbankpayment', array('status'=>$action),array('id'=>$id));

            if($update){
               $ad_data = array(
                    'approvereason' => $approvereason,
                    'approve_status' => $action,
                    'created_at' => date('Y-m-d H:i:s')
                );

                $this->home_model->update('tblbankpaymentapproval', $ad_data,array('payment_id'=>$id,'staffid'=>$user_id));
                
                if($action == 1){
                    set_alert('success', 'Payment Approved Successfully');
                }else if ($action == 4){
                    set_alert('success', 'Payment Reconciliation Successfully');
                }else if ($action == 5){
                    set_alert('success', 'Payment Hold Successfully');
                }else{
                    set_alert('danger', 'Payment Rejected Successfully');
                }

                update_masterapproval_single(get_staff_user_id(),8,$id,$action);
                update_masterapproval_all(8,$id,$action);

                
                redirect(admin_url('bank_payments'));
            }

        }
    }


    public function delete($id)
    {

        check_permission(57,'delete');

        $response = $this->home_model->delete('tblbankpayment', array('id'=>$id));
        if ($response == true) {

            $payment_info = $this->db->query("SELECT * FROM tblbankpaymentdetails WHERE main_id =  '".$id."' ")->result();
            if(!empty($payment_info)){
                foreach ($payment_info as $row) {
                    $pay_type = $row->pay_type;
                    $pay_type_id = $row->pay_type_id;

                    if($pay_type == 'po_payment'){
                        $this->home_model->update('tblpurchaseorderpayments', array('payfile_done'=>0),array('id'=>$pay_type_id));
                    }elseif($pay_type == 'pay_request'){
                        $this->home_model->update('tblpaymentrequest', array('payfile_done'=>0),array('id'=>$pay_type_id));
                    }elseif($pay_type == 'request'){
                        $this->home_model->update('tblrequests', array('payfile_done'=>0),array('id'=>$pay_type_id));
                    }elseif($pay_type == 'pettycash'){
                        $this->home_model->update('tblpettycashrequest', array('payfile_done'=>0),array('id'=>$pay_type_id));
                    }elseif($pay_type == 'client_deposit'){
                        $this->home_model->update('tblclientdeposits', array('payfile_done'=>0),array('id'=>$pay_type_id));
                    }elseif($pay_type == 'employee_salary'){
                        $this->home_model->update('tblsalarypaidlog', array('payfile_done'=>0),array('id'=>$pay_type_id));
                    }elseif($pay_type == 'client_refund'){
                        $this->home_model->update('tblclientrefund', array('payfile_done'=>0),array('id'=>$pay_type_id));
                    }
                }
            }

            $this->home_model->delete('tblbankpaymentdetails', array('main_id'=>$id));
            $this->home_model->delete('tblbankpaymentapproval', array('payment_id'=>$id));
            $this->home_model->delete('tblnotifications', array('table_id'=>$id, 'description'=>'Bank Payment For Approval'));

            set_alert('success', _l('deleted', 'Payments'));
        } else {
            set_alert('warning', _l('problem_deleting', 'Payments'));
        }
        redirect(admin_url('bank_payments'));
    }


    public function export($id)
    {
        $fileName = 'Payment'.$id.'.xls';

        $this->load->library('excel');


        $payment_info = $this->db->query("SELECT * FROM tblbankpaymentdetails WHERE main_id =  '".$id."' ")->result();


        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        $styleArray = array(
            'font'  => array(
            'bold'  => false,
            'size'  => 14,
            'name'  => 'Arial'
        ));

        $textFormat='@';//'General','0.00','@'

        // set Header
       /* $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Account Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Employee Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Net Salary');   */
        // set Row
        $rowCount = 1;
        $i = 1;
        foreach ($payment_info as $val)
        {

           $payee_name = $val->payee_name;

        	if($val->category_id == 1){
                $payee_info = $this->db->query("SELECT staffid as id,firstname as name FROM `tblstaff` where staffid = '".$val->payee_id."' ")->row();
            }elseif($val->category_id == 2){
                $payee_info = $this->db->query("SELECT id,name FROM `tblvendor` where id = '".$val->payee_id."' ")->row();
            }elseif($val->category_id == 7){
                $payee_info = $this->db->query("SELECT userid as id,client_branch_name as name FROM `tblclientbranch` where userid = '".$val->payee_id."' ")->row();
            }else{
                if($val->payee_id > 0){
                   $payee_info = $this->db->query("SELECT id,name FROM `tblcompanyexpenseparties` where id = '".$val->payee_id."' ")->row();
                }

            }

            if(!empty($payee_info)){
                $payee_name = $payee_info->name;
            }



            $vendor_acc = "'".$val->account;


            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $val->company_code);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val->type);
            $objPHPExcel->getActiveSheet()->getStyle('B' . $rowCount)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val->method);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $rowCount)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, date("d/m/Y",strtotime($val->date)));
            $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount) ->getNumberFormat()->setFormatCode($textFormat);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val->account_no);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount) ->getNumberFormat()->setFormatCode($textFormat);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val->amount);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getNumberFormat()->setFormatCode('0.00');
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, 'M');
            $objPHPExcel->getActiveSheet()->getStyle('I' . $rowCount)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $payee_name);
            $objPHPExcel->getActiveSheet()->getStyle('K' . $rowCount)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $val->ifsc);
            $objPHPExcel->getActiveSheet()->getStyle('M' . $rowCount)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $vendor_acc);
            $objPHPExcel->getActiveSheet()->getStyle('N' . $rowCount)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->SetCellValue('X' . $rowCount, $val->first_remark);
            $objPHPExcel->getActiveSheet()->getStyle('X' . $rowCount)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->SetCellValue('Y' . $rowCount, $val->second_remark);
            $objPHPExcel->getActiveSheet()->getStyle('Y' . $rowCount)->applyFromArray($styleArray);


            $i++;
            $rowCount++;
        }

        foreach(range('A','Y') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);

    }


    public function get_vendor_detl() {

         if(!empty($_POST)){
            extract($this->input->post());

                if($category_id == 1){
                    $payee_info = $this->db->query("SELECT ifsc_code as ifsc,account_no FROM `tblstaff` where staffid = '".$vendor."' ")->row_array();
                }elseif($category_id == 2){
                    $payee_info = $this->db->query("SELECT ifsc,account_no FROM `tblvendor` where id = '".$vendor."' ")->row_array();
                }elseif($category_id == 7){
                    $payee_info = array();
                }else{
                    $payee_info = $this->db->query("SELECT ifsc,account_no FROM `tblcompanyexpenseparties` where id = '".$vendor."' ")->row_array();
                }

                if(!empty($payee_info)){
                    echo json_encode($payee_info);
                }
            }

    }

    public function get_html() {

        if(!empty($_POST)){
            extract($this->input->post());

                $category_info = $this->db->query("SELECT show_date,show_deposit FROM `tblcompanyexpensecatergory` where id = '".$category_id."' ")->row();
                $bank_info  = $this->db->query("SELECT * FROM tblbankmaster WHERE status = 1 ")->result();

                if($category_id == 1){
                    $payee_info = $this->db->query("SELECT staffid as id,firstname as name FROM `tblstaff` where active = '1' ")->result();
                }elseif($category_id == 2){
                    $payee_info = $this->db->query("SELECT id,name FROM `tblvendor` where status = '1' ")->result();
                }elseif($category_id == 7){
                    $payee_info = $this->db->query("SELECT userid as id,client_branch_name as name FROM `tblclientbranch` where active = '1' AND client_branch_name != '' ORDER BY client_branch_name ASC ")->result();
                }else{
                    $payee_info = $this->db->query("SELECT id,name FROM `tblcompanyexpenseparties` where category_id = '".$category_id."' and status = '1' ")->result();
                }



                ?>
                <input type="hidden" name="paymentdata[<?php echo $i; ?>][pay_type]" value="">

                <input type="hidden" name="paymentdata[<?php echo $i; ?>][pay_type_id]" value="0">

                <div class="row">
                    <div class="form-group col-md-2">
                        <label class="control-label">Payment Date </label>
                            <input type="text" id="date<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][date]" class="form-control date" value="<?php echo date('m/d/Y');?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label">Payee Name </label>
                         <select onchange="get_vendor_detl(<?php echo $i; ?>,this.value)" class="form-control selectpicker" id="payee<?php echo $i; ?>" required="" name="paymentdata[<?php echo $i; ?>][payee]">
                          <option value="" disabled selected >--Select One-</option>
                          <?php
                          if(!empty($payee_info)){
                            foreach ($payee_info as $key => $value) {
                                ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                <?php
                            }
                          }
                          ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="control-label">IFSC Code </label>
                            <input type="text" required="" id="ifsc<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][ifsc]" class="form-control" value="">
                    </div>

                     <div class="form-group col-md-2">
                        <label class="control-label">Account No. </label>
                            <input type="text" required="" id="account<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][account]" class="form-control" value="">
                    </div>

                    <div class="form-group col-md-2">
                        <label class="control-label">Select Bank </label>
                          <select class="form-control selectpicker bank_id" data-rid="<?php echo $i; ?>" data-live-search="true" id="bank_id<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][bank_id]">
                            <option value="">-- Select Bank --</option>
                            <?php
                            if(!empty($bank_info)){
                                foreach ($bank_info as  $bank) {
                                    ?>
                                        <option value="<?php echo $bank->id; ?>"><?php echo cc($bank->name); ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="row">


                    <div class="form-group col-md-2">
                        <label class="control-label">Payment Method </label>
                          <select required="" class="form-control selectpicker payment_method" data-rid="<?php echo $i; ?>" data-live-search="true" id="method<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][method]">
                            <option value="NEFT">NEFT</option>
                            <option value="RTGS">RTGS</option>
                            <option value="IFT">IFT</option>
                            <option value="CASH">CASH</option>
                            <option value="CHEQUE">CHEQUE</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="control-label">Payment Type </label>
                          <select required="" class="form-control selectpicker" data-live-search="true" id="type<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][type]">
                            <option value="RPAY">RPAY</option>
                            <option value="SALPAY">SALPAY</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="control-label">Amount </label>
                           <input type="text" required="" id="amount<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][amount]" class="form-control" value="">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="control-label">First Remark </label>
                            <textarea id="first_remark<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][first_remark]" class="form-control"></textarea>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="control-label">Second Remark </label>
                          <textarea id="second_remark<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][second_remark]" class="form-control"></textarea>
                    </div>


                </div>

                <div class="row">

                    <?php
                    if($category_info->show_deposit == 1){
                    ?>
                         <div class="form-group col-md-4">
                            <label class="control-label">Deposit </label>
                                <input type="text" required="" id="deposit<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][deposit]" class="form-control" value="">
                        </div>
                    <?php
                    }


                    if($category_info->show_date == 1){
                    ?>
                        <div class="form-group col-md-4">
                            <label class="control-label">From Date </label>
                                <input type="text" id="fromdate<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][fromdate]" class="form-control date" value="<?php echo date('m/d/Y');?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label class="control-label">To Date </label>
                                <input type="text" id="todate<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][todate]" class="form-control date" value="<?php echo date('m/d/Y');?>">
                        </div>
                    <?php
                    }
                    ?>


                </div>
                <div class="row">
                    <input type="hidden" class="chequeid<?php echo $i; ?>" value="0">
                    <input type="hidden" class="cheque_no<?php echo $i; ?>" value="0">
                    <div class="bank_cheque_field<?php echo $i;?>">

                    </div>
                    <div class="bank_cheque_num_range<?php echo $i;?>">

                    </div>
                </div>

                <?php

            }

    }


    public function get_detail_html()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            $payment_info  = $this->db->query("SELECT * from tblbankpaymentdetails where main_id = '".$id."' ")->result();
            ?>
             <div class="col-md-12">
              <form action="<?php echo admin_url('bank_payments/update_reference'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Category Name</th>
                        <th>Payee Name</th>
                        <th>Amount</th>
                        <th>UTR No.</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php
                    if(!empty($payment_info)){
                        $z=1;
                        foreach($payment_info as $row){

                            $payee_name = $row->payee_name;
                            $payee_info = '';
                            if($row->category_id == 1){
                                $payee_info = $this->db->query("SELECT staffid as id,firstname as name FROM `tblstaff` where staffid = '".$row->payee_id."' ")->row();
                            }elseif($row->category_id == 2){
                                $payee_info = $this->db->query("SELECT id,name FROM `tblvendor` where id = '".$row->payee_id."' ")->row();
                            }elseif($row->category_id == 7){
                                $payee_info = $this->db->query("SELECT userid as id,client_branch_name as name FROM `tblclientbranch` where userid = '".$row->payee_id."' ")->row();
                            }else{
                                if($row->payee_id > 0){
                                   $payee_info = $this->db->query("SELECT id,name FROM `tblcompanyexpenseparties` where id = '".$row->payee_id."' ")->row();
                                }

                            }

                            if(!empty($payee_info)){
                                $payee_name = $payee_info->name;
                            }



                            ?>

                            <tr>
                                <td><?php echo $z++;?></td>
                                <td><?php echo value_by_id('tblcompanyexpensecatergory',$row->category_id,'name'); ?></td>
                                <td><?php echo $payee_name; ?></td>
                                <td><?php echo $row->amount; ?></td>
                                <td><input class="form-control" type="text" name="urt_<?php echo $row->id; ?>" value="<?php echo $row->utr_no; ?>"></td>
                                <td><input type="text" name="utr_date_<?php echo $row->id; ?>" class="form-control date_picker" value="<?php if(!empty($row->utr_date)){ echo date('m/d/Y',strtotime($row->utr_date)); }else{ echo date('m/d/Y');} ?>"></td>

                             </tr>

                            <?php
                        }
                    }else{
                        echo '<tr><td class="text-center" colspan="5"><h5>Record Not Found</h5></td></tr>';
                    }
                    ?>


                    </tbody>
                  </table>

                  <input type="hidden" value="<?php echo $id; ?>" name="id">

                   <div class="col-md-12">
                        <button  type="submit" class="btn btn-info">Update</button>
                    </div>
                  </form>
            </div>
            <?php
        }
    }



    public function update_reference()
    {

        if(!empty($_POST)){
            extract($this->input->post());

            $payment_info  = $this->db->query("SELECT * from tblbankpaymentdetails where main_id = '".$id."' ")->result();

            if(!empty($payment_info)){
                foreach ($payment_info as $key => $value) {
                    if(!empty($_POST['urt_'.$value->id])){
                        $utr_no = $_POST['urt_'.$value->id];
                        $utr_date = date('Y-m-d',strtotime($_POST['utr_date_'.$value->id]));

                        $update = $this->home_model->update('tblbankpaymentdetails', array('utr_no'=>$utr_no,'utr_date'=>$utr_date),array('id'=>$value->id));

                        $detail_info  = $this->db->query("SELECT * FROM tblbankpaymentdetails WHERE id = '".$value->id."' ")->row();
                        if($detail_info->pay_type == 'po_payment'){
                            $this->home_model->update('tblpurchaseorderpayments', array('utr_no'=>$utr_no),array('id'=>$detail_info->pay_type_id));
                        }
                    }

                }
            }

            if(!empty($update)){
                set_alert('success', 'Reference No. Updated Successfully');
                redirect(admin_url('bank_payments'));
            }else{
                set_alert('warning', 'Something went wrong!');
                redirect(admin_url('bank_payments'));
            }

        }

    }

    public function payfile_report()
    {
        //check_permission('66,84,222','view');

        $data['category_info']  = $this->db->query("SELECT * FROM tblcompanyexpensecatergory WHERE status = 1 ")->result();

         $where = "utr_no != '' ";
         if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){
               $data['s_fdate'] = $f_date;
               $data['s_tdate'] = $t_date;

               $f_date = str_replace("/","-",$f_date);
                $f_date = date("Y-m-d",strtotime($f_date));

                $t_date = str_replace("/","-",$t_date);
                $t_date = date("Y-m-d",strtotime($t_date));

                $where .= " and utr_date between '".$f_date."' and '".$t_date."'";
            }

            if(!empty($paymentdata)){
                $data['s_paymentdata'] = $paymentdata;

               $where .= " and category_id = '".$paymentdata."' ";
               }


         }
        else
        {
          $where .= " and YEAR(`utr_date`) = '".date('Y')."' and MONTH(`utr_date`) = '".date('m')."'";
        }

        $data['payment_info'] = $this->db->query("SELECT * from tblbankpaymentdetails where ".$where." ")->result();


        $data['title'] = 'Pay file Report';
        $this->load->view('admin/bank_payments/payfile_report', $data);

    }

    // by safiya
    public function get_approval_info() {


        if(!empty($_POST)){
            extract($this->input->post());
            $assign_info = $this->db->query("SELECT * from tblbankpaymentapproval  where payment_id = '".$payment_id."'  ")->result();
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
                                                    <td><?php echo get_employee_name($value->staffid); ?></td>
                                                    <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
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



    /*public function payfile_request()
    {
        //check_permission('66,84,222','view');

         $where = "id > 0 ";
         if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){
               $data['s_fdate'] = $f_date;
               $data['s_tdate'] = $t_date;

                $f_date = db_date($f_date);

                $t_date = db_date($t_date);

                $where .= " and created_at between '".$f_date."' and '".$t_date."'";
            }

            if(!empty($status)){
                $data['status'] = $status;
                $where .= " and status = '".$status."' ";
            }


        }

        $data['request_info'] = $this->db->query("SELECT * from tblbankpaymentrequest where ".$where." order by id desc")->result();


        $data['title'] = 'Pay File Request';
        $this->load->view('admin/bank_payments/payfile_request', $data);

    }*/

    /*public function employee_request()
    {
        //check_permission('66,84,222','view');
         $data['employee_info']  = $this->db->query("SELECT * FROM tblstaff WHERE active = 1 ")->result_array();
         $where = "approved_status = 1 and category IN (1,2,3) ";
         if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){
               $data['s_fdate'] = $f_date;
               $data['s_tdate'] = $t_date;

                $f_date = db_date($f_date);
                $t_date = db_date($t_date);

                $where .= " and date between '".$f_date."' and '".$t_date."'";
            }

            if(!empty($employee_id)){
                $data['employee_id'] = $employee_id;
                $where .= " and addedfrom = '".$employee_id."' ";
            }

            if(isset($status)){
                $data['status'] = $status;
                $where .= " and payfile_done = '".$status."' ";
            }


        }else{
         // $where .= " and YEAR(`date`) = '".date('Y')."' and MONTH(`date`) = '".date('m')."'";
        }

        $data['request_info'] = $this->db->query("SELECT * from tblrequests where ".$where." order by id desc")->result();


        $data['title'] = 'Employee Request';
        $this->load->view('admin/bank_payments/employee_request', $data);

    }*/


    //gopal
    public function combine_request()
    {
        check_permission('299','view');

        $data['employee_info']  = $this->db->query("SELECT * FROM tblstaff WHERE active = 1 order by firstname asc ")->result_array();

        $where_superior = "r.approved_status IN (1,0) ";
        //$where_employee = "approved_status = 1 and by_pettycash = 0 and category IN (1,2,3) and date > '2020-10-31' ";
        $where_employee = "r.approved_status = 1 and r.receive_status != 2 and r.category IN (1,2,3,4) and r.date > '2020-10-31' ";
        $where_pettycash = "r.approved_status = 1 and r.receive_status != 2 and r.date > '2020-10-31' ";
        $where_po = " r.status IN (1,0) and r.payment_by = 1 and r.created_at > '2020-10-31 00:00:00' ";
        $where_cd = " r.status IN (1,0) and r.created_date > '2020-10-31 00:00:00' and r.isReturn = 1 ";
        $where_cr = " r.status IN (1,0) and r.created_at > '2020-10-31 00:00:00' ";
        $where_es = " r.status = 1 and r.year >= '2021' and r.month >= 10 ";
         if(!empty($_POST)){
            extract($this->input->post());
            $data['from_page'] = $from_page;
            if($from_page == 1){

               if(!empty($f_date) && !empty($t_date)){
                   $data['s_fdate'] = $f_date;
                   $data['s_tdate'] = $t_date;

                    $f_date = db_date($f_date).' 00:00:00';

                    $t_date = db_date($t_date).' 23:59:59';

                    $where_superior .= " and r.created_at between '".$f_date."' and '".$t_date."'";
                }

                if(isset($status)){
                    $data['status_1'] = $status;
                    $where_superior .= " and r.payfile_done = '".$status."' ";
                }

                if(!empty($utr_status)){
                    $data['utr_status_1'] = $utr_status;
                    if($utr_status == 1){
                        $where_superior .= " and pd.utr_no = '' || pd.utr_no IS NULL ";
                    }elseif($utr_status == 2){
                        $where_superior .= " and pd.utr_no > '0' ";
                    }

                }

                if(isset($accept_status)){
                    $data['accept_status_1'] = $accept_status;
                    $where_superior .= " and r.acceptance = '".$accept_status."' ";
                }

            }elseif($from_page == 2){
                if(!empty($f_date) && !empty($t_date)){
                   $data['s_fdate'] = $f_date;
                   $data['s_tdate'] = $t_date;

                    $f_date = db_date($f_date);
                    $t_date = db_date($t_date);

                    $where_employee .= " and r.date between '".$f_date."' and '".$t_date."'";
                }

                if(!empty($employee_id)){
                    $data['employee_id'] = $employee_id;
                    $where_employee .= " and r.addedfrom = '".$employee_id."' ";
                }

                if(isset($status)){
                    $data['status_2'] = $status;
                    $where_employee .= " and r.payfile_done = '".$status."' ";
                }

                if(!empty($utr_status)){
                    $data['utr_status_2'] = $utr_status;
                    if($utr_status == 1){
                        $where_employee .= " and pd.utr_no = '' || pd.utr_no IS NULL ";
                    }elseif($utr_status == 2){
                        $where_employee .= " and pd.utr_no > '0' ";
                    }

                }

                if(isset($accept_status)){
                    $data['accept_status_2'] = $accept_status;
                    $where_employee .= " and r.acceptance = '".$accept_status."' ";
                }
            }elseif($from_page == 3){

                if(isset($status)){
                    $data['status_3'] = $status;
                    $where_po .= " and r.payfile_done = '".$status."' ";
                }

                if(isset($accept_status)){
                    $data['accept_status_3'] = $accept_status;
                    $where_po .= " and r.acceptance = '".$accept_status."' ";
                }

                if(!empty($utr_status)){
                    $data['utr_status_3'] = $utr_status;
                    if($utr_status == 1){
                        $where_po .= " and pd.utr_no = '' || pd.utr_no IS NULL ";
                    }elseif($utr_status == 2){
                        $where_po .= " and pd.utr_no > '0' ";
                    }

                }
            }elseif($from_page == 4){
                if(!empty($f_date) && !empty($t_date)){
                   $data['s_fdate'] = $f_date;
                   $data['s_tdate'] = $t_date;

                    $f_date = db_date($f_date);
                    $t_date = db_date($t_date);

                    $where_pettycash .= " and r.date between '".$f_date."' and '".$t_date."'";
                }

                if(!empty($employee_id)){
                    $data['employee_id'] = $employee_id;
                    $where_pettycash .= " and r.addedfrom = '".$employee_id."' ";
                }

                if(isset($status)){
                    $data['status_4'] = $status;
                    $where_pettycash .= " and r.payfile_done = '".$status."' ";
                }

                if(isset($accept_status)){
                    $data['accept_status_4'] = $accept_status;
                    $where_pettycash .= " and r.acceptance = '".$accept_status."' ";
                }

                if(!empty($utr_status)){
                    $data['utr_status_4'] = $utr_status;
                    if($utr_status == 1){
                        $where_pettycash .= " and pd.utr_no = '' || pd.utr_no IS NULL ";
                    }elseif($utr_status == 2){
                        $where_pettycash .= " and pd.utr_no > '0' ";
                    }

                }
            }elseif($from_page == 5){

                if(isset($status)){
                    $data['status_5'] = $status;
                    $where_cd .= " and r.payfile_done = '".$status."' ";
                    $where_cr .= " and r.payfile_done = '".$status."' ";
                }

                if(isset($accept_status)){
                    $data['accept_status_5'] = $accept_status;
                    $where_cd .= " and r.acceptance = '".$accept_status."' ";
                    $where_cr .= " and r.acceptance = '".$accept_status."' ";
                }

                if(!empty($utr_status)){
                    $data['utr_status_5'] = $utr_status;
                    if($utr_status == 1){
                        $where_cd .= " and (pd.utr_no = '' || pd.utr_no IS NULL)";
                        $where_cr .= " and (pd.utr_no = '' || pd.utr_no IS NULL)";
                    }elseif($utr_status == 2){
                        $where_cd .= " and pd.utr_no > '0' ";
                        $where_cr .= " and pd.utr_no > '0' ";
                    }

                }

                if (!empty($type)){
                   $data['type'] = $type;
                   if ($type == 1){
                      $where_cr .= "and pd.id = 0";
                   }else{
                      $where_cd .= "and pd.id = 0";
                   }
                }
            }elseif($from_page == 6){

                if(isset($status)){
                    $data['status_6'] = $status;
                    $where_es .= " and r.payfile_done = '".$status."' ";
                }

                if(isset($accept_status)){
                    $data['accept_status_6'] = $accept_status;
                    $where_es .= " and r.acceptance = '".$accept_status."' ";
                }

                if(!empty($utr_status)){
                    $data['utr_status_6'] = $utr_status;
                    if($utr_status == 1){
                        $where_es .= " and (pd.utr_no = '' || pd.utr_no IS NULL)";
                    }elseif($utr_status == 2){
                        $where_es .= " and pd.utr_no > '0' ";
                    }

                }
            }



        }else{
            $where_cd .= " and r.payfile_done = '0'";
            $where_cr .= " and r.payfile_done = '0'";
            $where_es .= " and r.payfile_done = '0'";
            $where_po .= " and r.payfile_done = '0' ";
            $where_employee .= " and r.payfile_done = '0' ";
            $where_pettycash .= " and r.payfile_done = '0' ";
            $where_superior .= " and r.payfile_done = '0' ";
            //$where_superior .= " and r.status = '1' ";
        }
        //$data['superior_request_info'] = $this->db->query("SELECT r.* from tblbankpaymentrequest as r LEFT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'pay_request' where ".$where_superior." order by r.id desc")->result();
        $data['superior_request_info'] = $this->db->query("SELECT r.*,pd.main_id as pay_id from tblpaymentrequest as r LEFT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'pay_request' where ".$where_superior." order by r.id desc")->result();

        //$data['employee_request_info'] = $this->db->query("SELECT * from tblrequests where ".$where_employee." order by id desc")->result();
        $data['employee_request_info'] = $this->db->query("SELECT r.*,pd.main_id as pay_id from tblrequests as r LEFT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'request' where ".$where_employee." order by r.id desc")->result();

        //$data['pettycash_request_info'] = $this->db->query("SELECT * from tblpettycashrequest where ".$where_pettycash." order by id desc")->result();
        $data['pettycash_request_info'] = $this->db->query("SELECT r.*,pd.main_id as pay_id from tblpettycashrequest as r LEFT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'pettycash' where ".$where_pettycash." order by id desc")->result();
        //$data['po_request_info'] = $this->db->query("SELECT * from tblpurchaseorderpayments where ".$where_po." order by id desc")->result();
        $data['po_request_info'] = $this->db->query("SELECT r.*,pd.main_id as pay_id from tblpurchaseorderpayments as r LEFT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'po_payment' where ".$where_po." order by r.id desc")->result();

        $data['client_deposit_info'] = $this->db->query("SELECT r.*,pd.main_id as pay_id from  tblclientdeposits as r LEFT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'client_deposit' where ".$where_cd." order by r.id desc")->result();
        
        $data['client_refund_info'] = $this->db->query("SELECT r.*,pd.main_id as pay_id from  tblclientrefund as r LEFT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'client_refund' where ".$where_cr." order by r.id desc")->result();

        $data['salary_info'] = $this->db->query("SELECT r.*,pd.main_id as pay_id from tblsalarypaidlog as r LEFT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'employee_salary' where ".$where_es." order by r.id desc")->result();

        $data['title'] = 'Payment Request Report';
        $this->load->view('admin/bank_payments/request',$data);
    }

    public function acceptance_action($from,$status,$id)
    {
        $ad_data = array(
            'acceptance_by' => get_staff_user_id(),
            'acceptance' => $status,
            'acceptance_date' => date('Y-m-d H:i:s')
        );

        if($from == 3){
            $this->home_model->update('tblpurchaseorderpayments', $ad_data,array('id'=>$id));
        }elseif($from == 2){
            $this->home_model->update('tblrequests', $ad_data,array('id'=>$id));
        }elseif($from == 1){
            //$this->home_model->update('tblbankpaymentrequest', $ad_data,array('id'=>$id));
            $this->home_model->update('tblpaymentrequest', $ad_data,array('id'=>$id));
        }elseif($from == 4){
            $this->home_model->update('tblpettycashrequest', $ad_data,array('id'=>$id));
        }elseif($from == 5){
            $this->home_model->update('tblclientdeposits', $ad_data,array('id'=>$id));
        }elseif($from == 6){
            $this->home_model->update('tblsalarypaidlog', $ad_data,array('id'=>$id));
        }elseif($from == 7){
            $this->home_model->update('tblclientrefund', $ad_data,array('id'=>$id));
        }

        set_alert('success', 'Status Updated Successfully ');
        redirect(admin_url('bank_payments/combine_request'));
    }

    public function last_payment_details_list($payee_id=0)
    {

        $data['payment_info'] = $this->db->query("SELECT pd.* FROM `tblbankpaymentdetails` as pd LEFT JOIN `tblbankpayment` as b ON `b`.id = `pd`.main_id WHERE `pd`.`category_id` = 3 AND `pd`.`payee_id`='".$payee_id."' AND `b`.`status` = 1 ORDER BY date DESC ")->result();

        $data["party_name"] = value_by_id("tblcompanyexpenseparties", $payee_id, "name");
        $data['title'] = 'Last Payment Details';
        $this->load->view('admin/bank_payments/payment_details', $data);
    }

    /* this fucntion use for vendor po list */
    public function vendor_po_list($vendor_id, $po_id){
        $where = "vendor_id = '".$vendor_id."' and show_list  = '1'";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($f_date) && !empty($t_date)){
                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $where .= " and date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }
        }

        $data['purchaseorder_list'] = $this->db->query("SELECT * from `tblpurchaseorder` where ".$where." ORDER BY id desc ")->result();
        $data['title'] = value_by_id("tblvendor", $vendor_id, "name").' (Purchase Order)';
        $data['vendor_id'] = $vendor_id;
        $data['po_id'] = $po_id;
        $data['staff_list'] = $this->db->query("SELECT * FROM tblstaff WHERE staffid!=".  get_staff_user_id() ." AND active = 1")->result();;
        $this->load->view('admin/bank_payments/vendor_po_list', $data);
    }

    /* this fucntion use for purchaseorder payment query */
    public function purchaseorder_payment_query($id){

        /* this is for check notification uodate */
        $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$id."' and staff_id = '".get_staff_user_id()."' and module_id = '34'")->result();
        if (!empty($chk_notification)){
            foreach ($chk_notification as $value) {
                $this->home_model->update("tblmasterapproval", array("status" => 1, "approve_status" => 1), array("id" => $value->id));
            }
        }

        $data['title'] = value_by_id("tblvendor", $vendor_id, "name").' (Purchase Order Activity Details)';
        $data['vendor_activity'] = $this->db->query("SELECT * FROM tblvendoractivity WHERE id=".$id."")->row();
        $this->load->view('admin/bank_payments/purchaseorder_payment_query', $data);
    }

    /* this function use send query */
    public function send_query(){
        if(!empty($_POST)){
            extract($this->input->post());
            $ad_data = array(
                'vendor_id' => $vendor_id,
                'po_id' => $po_id,
                'message' => $message,
                'staffid' => get_staff_user_id(),
                'date' => date('Y-m-d'),
                'datetime' => date('Y-m-d H:i:s'),
                'priority' => 0,
                'status' => 1
            );

            $insert_id = $this->home_model->insert('tblvendoractivity',$ad_data);
            if(!empty($insert_id)){
                $addata = array(
                            'po_id' => $po_id,
                            'message' => $message,
                            'staffid' => get_staff_user_id(),
                            'date' => date('Y-m-d'),
                            'datetime' => date('Y-m-d H:i:s'),
                            'priority' => 0,
                            'status' => 1
                        );

                $this->home_model->insert('tblpurchaseorderactivity',$addata);

                if (!empty($staff_id)){
                   foreach ($staff_id as $staffid) {
                       $n_data = array(
                            'description' => 'You taged in vendor purchase order activity follow up',
                            'staff_id' => $staffid,
                            'fromuserid' => get_staff_user_id(),
                            'table_id' => $insert_id,
                            'isread' => 0,
                            'module_id' => 34,
                            'link'  => "bank_payments/purchaseorder_payment_query/".$insert_id,
                            'date' => date('Y-m-d H:i:s'),
                            'date_time' => date('Y-m-d H:i:s')
                        );

                        $this->home_model->insert('tblmasterapproval', $n_data);

                        //Sending Mobile Intimation
                        $token = get_staff_token($staffid);
                        $title = 'Schach';
                        $message = 'You taged in purchase order activity follow up';
                        $send_intimation = sendFCM($message, $title, $token, $page = 2);
                   }
                }

                set_alert('success', 'Activity Added successfully');
                redirect(admin_url('bank_payments/vendor_po_list/' . $vendor_id."/".$po_id));
            }
        }
    }

    public function getbankchequebook(){

        $html = '';
        if(!empty($_POST)){
            extract($this->input->post());
            if (in_array($method, ["NEFT", "CHEQUE"])){

                if (!empty($bank_id)){
                    $chequebook_list = $this->db->query("SELECT * FROM tblchequebook WHERE bank_id=".$bank_id." AND status=1")->result();
                    if (!empty($chequebook_list)) {
                        $html .= '<div class="form-group col-md-3">
                                    <label for="Bank" class="control-label">Cheque Book *</label>
                                    <select class="form-control selectpicker chequebook_id" data-rid="'.$div_id.'" data-live-search="true" id="cheque_book_id'.$div_id.'" name="paymentdata['.$div_id.'][cheque_id]">
                                        <option value=""></option>';

                                            foreach ($chequebook_list as $value) {
                                                $selectcls = (isset($chequeid) && $chequeid == $value->id) ? "selected": "";
                                                $html .= '<option value="'.$value->id.'" '.$selectcls.'>'.cc($value->chequebook_name).'</option>';
                                            }

                          $html .= '</select>
                                </div>';
                    }
                }
            }
        }
        echo $html;exit;
    }

    public function getbankchequerange(){

        $html = '';
        if(!empty($_POST)){
            
            extract($this->input->post());

            if (!empty($cheque_book_id)){
                $chequebook_info = $this->db->query("SELECT * FROM tblchequebook WHERE id=".$cheque_book_id."")->row();

                if (!empty($chequebook_info)){

                    if (!empty($chequebook_info->from_page) && !empty($chequebook_info->to_page)){

                        $start = $chequebook_info->from_page;
                        $end = $chequebook_info->to_page;
                        $html .= '<div class="form-group col-md-3">
                                        <label for="Cheque Book Number" class="control-label">Cheque Book Number *</label>
                                        <select class="form-control selectpicker " data-rid="'.$div_id.'" data-live-search="true" id="cheque_no'.$div_id.'" name="paymentdata['.$div_id.'][cheque_bank_no]">
                                            <option value=""></option>';
                                            for($i=$start; $i <= $end; $i++){
                                                if (isset($cheque_no) && $cheque_no == $i){
                                                    $html .= '<option value="'.$cheque_no.'" selected>'.$cheque_no.'</option>';
                                                }
                                                $chequebook_info = $this->db->query("SELECT * FROM tblbankpaymentdetails WHERE cheque_id=".$cheque_book_id." AND cheque_no='".$i."' ")->row();
                                                if (empty($chequebook_info)){
                                                    $html .= '<option value="'.$i.'" >'.$i.'</option>';
                                                }else if (!empty($chequebook_info) && $chequebook_info->main_id == $save_id){
                                                    $html .= '<option value="'.$i.'" >'.$i.'</option>';
                                                }

                                            }
                                $html .= '</select>
                                    </div>';
                    }
                }
            }
        }
        echo $html;exit;
    }

    /* this is for get account changes */
    public function get_account_changes($payment_id){

        $getpayment_info = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` WHERE id = '".$payment_id."'")->row();
        if(!empty($_POST)){
            extract($this->input->post());

            $account_data["approved_amount"] = $approved_amount;
            $account_data["account_remark"] = $remark;
            $account_data["last_approved_amount"] = $last_approved_amount;
            $account_data["account_changes_dated"] = date('Y-m-d H:i:s');
            $account_data["account_person_id"] = get_staff_user_id();
            $response = $this->home_model->update("tblpurchaseorderpayments", $account_data, array("id" => $payment_id));
            if ($response){
                set_alert('success', 'Amount Changed Successfully');
                redirect(admin_url('bank_payments/combine_request'));
            }
        }    
        

        echo form_open($this->uri->uri_string(), array('id' => 'account_changes_form', 'class' => 'account-changes-form', 'onsubmit' => 'checkChangeAmount()'));
    ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Account Changes</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group" app-field-wrapper="request_amount">
                                <label>Request Amount *</label>
                                <input type="text" readonly="" id="request_amount" name="last_approved_amount" class="form-control" value="<?php echo (!empty($getpayment_info) && $getpayment_info->last_approved_amount > 0) ? $getpayment_info->last_approved_amount : $getpayment_info->approved_amount; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" app-field-wrapper="remark">
                                <label>Change Amount *</label>
                                <input type="text" required="" id="approved_amount" name="approved_amount" class="form-control" value="<?php echo (!empty($getpayment_info) && !empty($getpayment_info->account_remark)) ? $getpayment_info->approved_amount : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" app-field-wrapper="request_amount">
                                <label>Remark *</label>
                                <textarea id="remark" required="" name="remark" class="form-control" rows="4"><?php echo (!empty($getpayment_info) && !empty($getpayment_info->account_remark)) ? $getpayment_info->account_remark : ''; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?php if (!empty($getpayment_info) && $getpayment_info->payfile_done == 0){  ?>
                    <button type="submit" class="btn btn-primary">Submit</button>
                <?php } ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    <?php
        echo form_close();
    }
}
