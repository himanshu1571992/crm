<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Payments extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payments_model');
        $this->load->model('home_model');
    }

    /* In case if user go only on /payments*/
    public function index()
    {
        $this->list_payments();
    }

    /* List all invoice paments */
    public function list_payments()
    {
        check_permission(51,'view');

        $where = " p.id > '0' and cp.is_suspense_account = 0";
        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/

            if(!empty($client_id)){
                $data['client_id'] = $client_id;
                $where .= " and cp.client_id = '".$client_id."'";
            }

            if(!empty($paymentmethod)){
                $data['paymentmethod'] = $paymentmethod;
                $where .= " and p.paymentmethod = '".$paymentmethod."'";
            }

            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));

               $where .= " and p.date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }

           if($status != ''){
                $data['s_status'] = $status;
                $where .= " and cp.status = '".$status."'";
            }

        }else{
            // $where .= " and p.date  BETWEEN  '".$from_date_year."' and  '".$to_date_year."' "; 
            $date_range = get_last_month_date();
            $where .= " and p.date BETWEEN '".$date_range["start_date"]."' and '".$date_range["end_date"]."' ";
            $data['s_fdate'] = _d($date_range["start_date"]);
            $data['s_tdate'] = _d($date_range["end_date"]);          
        }


        $data['payment_list'] = $this->db->query("SELECT cp.*, p.* FROM tblinvoicepaymentrecords as p LEFT JOIN tblclientpayment as cp ON cp.id = p.pay_id where ".$where." order by p.date desc ")->result();

        $data['client_info'] = $this->db->query("SELECT * FROM tblclientbranch  where active = '1' and client_branch_name !='' ORDER BY client_branch_name ASC ")->result_array();
        $data['title'] = _l('payments');
        $this->load->view('admin/payments/manage', $data);
    }

    public function table($clientid = '')
    {
        if (!has_permission('payments', '', 'view') && !has_permission('invoices', '', 'view_own') && get_option('allow_staff_view_invoices_assigned') == '0') {
            ajax_access_denied();
        }

        $this->app->get_table_data('payments', [
            'clientid' => $clientid,
        ]);
    }

    /* Update payment data */
    public function payment($id = '')
    {
        /*if (!has_permission('payments', '', 'view') && !has_permission('invoices', '', 'view_own') && get_option('allow_staff_view_invoices_assigned') == '0') {
            access_denied('payments');
        }*/

        if (!$id) {
            redirect(admin_url('payments'));
        }
        if ($this->input->post()) {
            extract($this->input->post());
            $post_data = $this->input->post();

            /*echo '<pre/>';
            print_r($_POST);
//            die;*/
            /*if (!has_permission('payments', '', 'edit')) {
                access_denied('Update Payment');
            }*/

            $assignstaff=$assign['assignid'];
            $staff_id = array();
            foreach($assignstaff as $s_id)
            {
               if($s_id > 0){
                $staff_id[]=$s_id;
               }

            }
            $staff_id=array_unique($staff_id);

            //Amount Adjustment
            $payment_info = $this->db->query("SELECT * FROM tblinvoicepaymentrecords  where id = '".$id."' ")->row();
            $invoice_info = $this->db->query("SELECT * FROM tblinvoices  where id = '".$payment_info->invoiceid."' ")->row();
            $paidamt = ($invoice_info->paid_amt - $payment_info->amount);
            $this->home_model->update('tblinvoices', array('paid_amt'=>$paidamt) ,array('id'=>$payment_info->invoiceid));

            $finvoice_info = $this->db->query("SELECT `paid_amt` FROM tblinvoices  where id = '".$payment_info->invoiceid."' ")->row();
            $f_paidamt = ($finvoice_info->paid_amt + $amount);
            $this->home_model->update('tblinvoices', array('paid_amt'=>$f_paidamt) ,array('id'=>$payment_info->invoiceid));

            //Updating Ref No
            $upclientpayment = array('reference_no'=>$post_data['reference_no'],'date'=>db_date($post_data['date']), 'payment_mode' => $post_data["paymentmode"],'bank_id'=>$post_data['bank_id'],'status'=>'0');
            $upclientpayment['chaque_for'] = (isset($post_data["chaque_for"]) && $post_data["paymentmode"] == 1) ? $post_data["chaque_for"] : "";
            $upclientpayment['cheque_no'] = (isset($post_data["cheque_no"]) && $post_data["paymentmode"] == 1) ? $post_data["cheque_no"] : "";
            $upclientpayment['cheque_date'] = (isset($post_data["cheque_date"]) && $post_data["paymentmode"] == 1) ? db_date($post_data["cheque_date"]) : "";

            $this->home_model->update('tblclientpayment',  $upclientpayment,array('id'=> $post_data['pay_id']));
            unset($post_data['reference_no'], $post_data['pay_id'], $post_data["chaque_for"], $post_data["cheque_no"], $post_data["cheque_date"], $post_data["assign"]);

            $pay_id = $payment_info->pay_id;

                if(!empty($staff_id)){
                    $this->home_model->delete('tblclientreceiptapproval', array('clientpayment_id'=>$pay_id));
                    $this->home_model->delete('tblmasterapproval', array('table_id'=>$pay_id, 'module_id'=>'15'));

                    foreach ($staff_id as $staffid) {

                        $ad_field = array(
                            'staff_id' => $staffid,
                            'clientpayment_id' => $pay_id,
                            'status' => 1,
                            'approve_status' => 0,
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        $this->home_model->insert('tblclientreceiptapproval',$ad_field);

                        $message = 'Client Receipt send you for aaproval';


                            $adata = array(
                                'staff_id' => $staffid,
                                'fromuserid'      => get_staff_user_id(),
                                'module_id' => 15,
                                'table_id' => $pay_id,
                                'approve_status' => 0,
                                'status' => 0,
                                'description'     => $message,
                                'link' => 'invoice_payments/clientpayment_approval/'.$pay_id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tblmasterapproval', $adata);

                            //Sending Mobile Intimation
                            $token = get_staff_token($staffid);
                            $title = 'Schach';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                    }
                }

            $success = $this->payments_model->update($post_data, $id);

            if ($success) {
                set_alert('success', _l('updated_successfully', _l('payment')));
            }
            redirect(admin_url('payments/payment/' . $id));
        }
        $data['payment'] = $this->payments_model->get($id);
        if (!$data['payment']) {
            blank_page(_l('payment_not_exists'));
        }
        $data['client_payment'] = $this->db->query("SELECT * FROM tblclientpayment  where id = '".$data['payment']->pay_id."' ")->row();
        $this->load->model('invoices_model');
        $data['invoice'] = $this->invoices_model->get($data['payment']->invoiceid);
        $this->load->model('payment_modes_model');
        $data['payment_modes'] = $this->payment_modes_model->get('', [], true, true);
        $i                     = 0;
        foreach ($data['payment_modes'] as $mode) {
            if ($mode['active'] == 0 && $data['payment']->paymentmode != $mode['id']) {
                unset($data['payment_modes'][$i]);
            }
            $i++;
        }
        $data['files'] = $this->db->query("SELECT * FROM tblfiles  where rel_id = '".$data['payment']->pay_id ."' and rel_type = 'payment' ")->result();

        /*by safiya */
        $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' ")->result();
        $data['paytype_info'] = $this->db->query("SELECT * FROM tblpaymenttypes")->result();

        //$Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
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

        $data['title'] = _l('payment_receipt') . ' - ' . format_invoice_number($data['payment']->invoiceid);
        $this->load->view('admin/payments/payment', $data);
    }

    /**
     * Generate payment pdf
     * @since  Version 1.0.1
     * @param  mixed $id Payment id
     */
    public function pdf($id)
    {
        if (!has_permission('payments', '', 'view') && !has_permission('invoices', '', 'view_own') && get_option('allow_staff_view_invoices_assigned') == '0') {
            access_denied('View Payment');
        }
        $payment = $this->payments_model->get($id);

        if(!has_permission('payments', '', 'view') && !has_permission('invoices', '', 'view_own') && !user_can_view_invoice($payment->invoiceid)) {
            access_denied('View Payment');
        }

        $this->load->model('invoices_model');
        $payment->invoice_data = $this->invoices_model->get($payment->invoiceid);

        try {
            $paymentpdf = payment_pdf($payment);
        } catch (Exception $e) {
            $message = $e->getMessage();
            echo $message;
            if (strpos($message, 'Unable to get the size of the image') !== false) {
                show_pdf_unable_to_get_image_size_error();
            }
            die;
        }

        $type = 'D';
        if ($this->input->get('print')) {
            $type = 'I';
        }
        $paymentpdf->Output(mb_strtoupper(slug_it(_l('payment') . '-' . $payment->paymentid)) . '.pdf', $type);
    }

    /* Delete payment */
    public function delete($id)
    {
        check_permission(51,'delete');

        if (!$id) {
            redirect(admin_url('payments'));
        }

        //Amount Adjustment
        $payment_info = $this->db->query("SELECT * FROM tblinvoicepaymentrecords  where id = '".$id."' ")->row();

        //deleteing approval notificatoin
        if(!empty($payment_info)){
            $this->home_model->delete('tblmasterapproval',array('module_id'=>15,'table_id'=>$payment_info->pay_id));
        }


        if($payment_info->paymentmethod == 2){
            $invoice_info = $this->db->query("SELECT `paid_amt` FROM tblinvoices  where id = '".$payment_info->invoiceid."' ")->row();
            $f_paidamt = ($invoice_info->paid_amt - $payment_info->amount);
        }else{
            $debit_info = $this->db->query("SELECT * FROM tbldebitnote  where `number` = '".$payment_info->debitnote_no."' ")->row();
            $debitpayment_info = $this->db->query("SELECT * FROM tbldebitnotepayment  where `number` = '".$payment_info->debitnote_no."' ")->row();

            if(!empty($debit_info)){
                $f_paidamt = ($debit_info->paid_amt - $payment_info->amount);
            }elseif(!empty($debitpayment_info)){
                $f_paidamt = ($debitpayment_info->paid_amt - $payment_info->amount);
            }
        }

        //Delete Client Payment Record
        $pay_id = $payment_info->pay_id;
        $row_count = $this->db->query("SELECT count(id) as ttl_count from tblinvoicepaymentrecords where pay_id = '".$pay_id."' ")->row()->ttl_count;
        if($row_count == 1){
            $this->home_model->delete('tblclientpayment',array('id'=>$pay_id));
        }

        $response = $this->payments_model->delete($id);
        if ($response == true) {

            if($payment_info->paymentmethod == 2){
                $this->home_model->update('tblinvoices', array('paid_amt'=>$f_paidamt) ,array('id'=>$payment_info->invoiceid));
            }else{
                if(!empty($debit_info)){
                   $this->home_model->update('tbldebitnote', array('paid_amt'=>$f_paidamt) ,array('id'=>$payment_info->invoiceid));
                }elseif(!empty($debitpayment_info)){
                   $this->home_model->update('tbldebitnotepayment', array('paid_amt'=>$f_paidamt) ,array('id'=>$payment_info->invoiceid));
                }
            }




            set_alert('success', _l('deleted', _l('payment')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('payment_lowercase')));
        }
        redirect(admin_url('payments'));
    }


    //By safiya

   //View Company Receipt
    public function company_receipt_view() {
     $data['comapany'] = $this->db->query("SELECT * from `tblcompanyreceipt` order by id desc ")->result();

     $data['title'] = 'Company Receipt';
     $this->load->view('admin/payments/company_receipt_view', $data);
    }


   // Company Receipt
   public function company_receipt($id = '') {

     $this->load->model('home_model');

      if ($this->input->post()) {
            extract($this->input->post());

            $sdate = str_replace("/","-",$date);
            $cdate = date("Y-m-d",strtotime($sdate));

            if ($id == '') {

                    $ad_data = array(
                        'type' => $type,
                        'amount' => $amount,
                        'utr_no' => $utr_no,
                        'date' => $cdate,
                        'remark' => $remark,
                        'receipt_id' => $receipt_name,
                        'from_bank' => $from_bank,
                        'to_bank' => $to_bank,
                        'added_by' => get_staff_user_id(),
                        'created_at' => date('Y-m-d H:i:s')
                    );


                    $insert = $this->home_model->insert('tblcompanyreceipt',$ad_data);

                    set_alert('success', 'Company Receipt Added Successfully');
                    redirect(admin_url('payments/company_receipt_view'));


            } else {
                if($type == 1)
                {
                  $up_data = array(
                        'type' => $type,
                        'amount' => $amount,
                        'utr_no' => $utr_no,
                        'date' => $cdate,
                        'remark' => $remark,
                        'receipt_id' => $receipt_name,
                        'from_bank' => '0',
                        'to_bank' => '0',
                        'added_by' => get_staff_user_id(),
                        'updated_at' => date('Y-m-d H:i:s')
                    );

                    $update = $this->home_model->update('tblcompanyreceipt',$up_data,array('id'=>$id));
                }
                else
                {
                    $up_data = array(
                        'type' => $type,
                        'amount' => $amount,
                        'utr_no' => $utr_no,
                        'date' => $cdate,
                        'remark' => $remark,
                        'receipt_id' => '0',
                        'from_bank' => $from_bank,
                        'to_bank' => $to_bank,
                        'added_by' => get_staff_user_id(),
                        'updated_at' => date('Y-m-d H:i:s')
                    );

                    $update = $this->home_model->update('tblcompanyreceipt',$up_data,array('id'=>$id));
                }


                    set_alert('success', _l('updated_successfully', 'Company Receipt'));
                    redirect(admin_url('payments/company_receipt_view'));
            }
        }

     if ($id == '') {
            $data['title'] = 'Add Company Receipt';
        } else {
            $data['receipt'] = $this->db->query("SELECT * from `tblcompanyreceipt` WHERE id = '".$id."' ")->row();
            $data['title'] = 'Edit Company Receipt';
        }

     $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' ")->result();
     $data['receipt_info'] = $this->db->query("SELECT * FROM tblreceiptmaster WHERE status = '1' ")->result();

     $this->load->view('admin/payments/company_receipt', $data);
    }


    //Payment View
    public function payment_view($id) {

        $data['payment'] = $this->payments_model->get($id);
        if (!$data['payment']) {
            blank_page(_l('payment_not_exists'));
        }
        $data['client_payment'] = $this->db->query("SELECT * FROM tblclientpayment  where id = '".$data['payment']->pay_id."' ")->row();
        $this->load->model('invoices_model');
        $data['invoice'] = $this->invoices_model->get($data['payment']->invoiceid);

        $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' ")->result();
        $data['title'] = 'Payment Details View';
        $this->load->view('admin/payments/payment_view', $data);
    }

    public function get_status() {


        if(!empty($_POST)){
            extract($this->input->post());

            $assign_info = $this->db->query("SELECT * from tblclientreceiptapproval  where clientpayment_id = '".$id."' ")->result();
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
                                                <td>Action Date</td>
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
                                                    <td><?php echo $value->approve_remark; ?></td>
                                                    <td><?php echo ($value->approve_date > 0) ? _d($value->approve_date) : '--'; ?></td>
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

    /* this function use for suspense account list */
    public function suspense_account_list(){
        check_permission(376,'view');
        $data['title'] = 'Suspense Receipts';

        $where = "id > '0' and is_suspense_account = 1";

        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/

            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));

               $where .= " and date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }

        }


        $data['payment_list'] = $this->db->query("SELECT * FROM tblclientpayment where ".$where." order by id desc ")->result();
        $this->load->view('admin/payments/suspense_account_list', $data);
    }

    /* this function use for delete suspense receipt */
    public function suspense_receipt_delete($pay_id){
        check_permission(376,'delete');
        // deleteing approval notificatoin
        $this->home_model->delete("tblclientreceiptapproval", array("clientpayment_id" => $pay_id));
        $this->home_model->delete('tblmasterapproval',array('module_id'=>15,'table_id'=>$pay_id));

        $response = $this->home_model->delete("tblclientpayment", array("id" => $pay_id, "is_suspense_account" => 1));
        if (!empty($response)){
             set_alert('success', "Suspense receipt deleted successfully.");
        } else {
            set_alert('warning', "Something went wroung.");
        }
        redirect(admin_url("payments/suspense_account_list"));
    }
}
