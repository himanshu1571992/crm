<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_cheque extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function index()
    {

        $where1 = "status IN (1,0) and (chaque_status = 0 || chaque_status = 2 || chaque_status = 3 || chaque_status = 5 || chaque_status = 6) and (payment_mode = 1)";
        $where2 = "status = 1 and (chaque_status = 1) and (payment_mode = 1)";
        $where3 = "status = 1 and (chaque_status = 4) and (payment_mode = 1) ";
        if(!empty($_POST)){
            extract($this->input->post());

            $data['from_page'] = $from_page;

            if($from_page == 1){
                  if(!empty($client_id)){
                    $data['client_id'] = $client_id;
                    $where1 .= " and client_id = '".$client_id."'";
                    }
                if(!empty($f_date) && !empty($t_date)){
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;
                    $where1 .= " and cheque_date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
                }
             }elseif($from_page == 2){
                    if(!empty($client_id1)){
                    $data['client_id1'] = $client_id1;
                    $where2 .= " and client_id = '".$client_id1."'";
                    }
                if(!empty($f_date1) && !empty($t_date1)){
                    $data['f_date1'] = $f_date1;
                    $data['t_date1'] = $t_date1;
                    $where2 .= " and cheque_date between '".db_date($f_date1)."' and '".db_date($t_date1)."' ";
                }

            }elseif($from_page == 3){
                    if(!empty($client_id2)){
                    $data['client_id2'] = $client_id2;
                    $where3 .= " and client_id = '".$client_id2."'";
                    }
                if(!empty($f_date2) && !empty($t_date2)){
                    $data['f_date2'] = $f_date2;
                    $data['t_date2'] = $t_date2;
                    $where3 .= " and cheque_date between '".db_date($f_date2)."' and '".db_date($t_date2)."' ";
                }

            }
        }

        $data['pending_cheque'] = $this->db->query("SELECT * from `tblclientpayment` where ".$where1." order by cheque_date desc")->result();
        $data['cleared_cheque'] = $this->db->query("SELECT * from `tblclientpayment` where ".$where2." order by cheque_date desc")->result();
        $data['cancelled_cheque'] = $this->db->query("SELECT * from `tblclientpayment` where ".$where3." order by cheque_date desc")->result();

        $data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid` from `tblclientbranch` WHERE `client_branch_name` !='' AND `active`=1 ORDER BY client_branch_name ASC ")->result();


        $data['title'] = 'Clients Cheque Details';
        $this->load->view('admin/manage_cheque/client_cheque_report', $data);

    }

    public function pending_client_status()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            $clientpayment_info  = $this->db->query("SELECT * from tblclientpayment where id = '".$id."' ")->row();
            ?>
             <div class="col-md-12">
              <form action="<?php echo admin_url('manage_cheque/pending_cheque_status'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>Status.</th>
                        <th>Action Date</th>
                      </tr>
                    </thead>
                    <tbody>

                       <tr>
                            <td>
                            <select class="form-control" name="status">
                            <option value="">--select status--</option>
                            <option value="0" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 0){ echo 'selected'; } ?>>Pending</option>
                            <option value="2" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 2){ echo 'selected'; } ?>>Bounced</option>
                            <option value="3" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 3){ echo 'selected'; } ?>>Redeposit</option>
                            <option value="1" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 1){ echo 'selected'; } ?>>Clear</option>
                            <option value="4" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 4){ echo 'selected'; } ?>>Cancel</option>
                            <option value="5" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 5){ echo 'selected'; } ?>>Deposit</option>
                            <option value="6" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 6){ echo 'selected'; } ?>>Hold</option>

                            </select>
                            </div>
                            </td>
                            <td><input type="text" name="chaque_clear_date" class="form-control date_picker" value="<?php if(!empty($clientpayment_info->chaque_clear_date)){ echo date('m/d/Y',strtotime($clientpayment_info->chaque_clear_date)); }else{ echo date('m/d/Y');} ?>"></td>
                        </tr>


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

    public function pending_cheque_status()
    {

        if(!empty($_POST)){
            extract($this->input->post());
            
            //for cleared cheque By Safiya
            if($status == 1) {

            $invoicepayment_info  = $this->db->query("SELECT * from tblinvoicepaymentrecords where pay_id = '".$id."' ")->result();
            foreach ($invoicepayment_info as $invoicepayment_value) {

            $invoice_id = $invoicepayment_value->invoiceid;
            $amount = $invoicepayment_value->amount;
            $payment_behalf = $invoicepayment_value->paymentmethod;
            $debit_no = $invoicepayment_value->debitnote_no;

            if($payment_behalf == 2) {

            $invoice_info = $this->db->query("SELECT * FROM tblinvoices  where id = '".$invoice_id."' ")->row();


                $f_paidamt = ($invoice_info->paid_amt + $amount);

                //Getting Payment status
                $inv_amt = $invoice_info->total;
                $inv_duedate = $invoice_info->duedate;
                $inv_status = $invoice_info->status;

                if($f_paidamt > 0){
                    if($f_paidamt >= $inv_amt){
                        $inv_status = 2;
                    }else{
                        if(date('Y-m-d') > $inv_duedate){
                            $inv_status = 4;
                        }else{
                            $inv_status = 3;
                        }

                    }
                }

                if($amount == 0){
                    if(date('Y-m-d') > $inv_duedate){
                        $inv_status = 4;
                    }else{
                        $inv_status = 1;
                    }
                }
                //End Getting Payment status


                $this->home_model->update('tblinvoices', array('paid_amt'=>$f_paidamt,'status'=>$inv_status) ,array('id'=>$invoice_id));
            }
            else if($payment_behalf == 3)
            {
            if(!empty($debit_no))
            {
                $debit_info = $this->db->query("SELECT * FROM tbldebitnote  where `number` = '".$debit_no."' ")->row();
                $debitpayment_info = $this->db->query("SELECT * FROM tbldebitnotepayment  where `number` = '".$debit_no."' ")->row();

                if(!empty($debit_info)){
                    $f_paidamt = ($debit_info->paid_amt + $amount);

                    //Getting Payment status
                    $amt = $debit_info->totalamount;
                    if($f_paidamt >= $amt){
                        $paid_status = 1;
                    }else{
                        $paid_status = 2;
                    }

                    $this->home_model->update('tbldebitnote', array('paid_amt'=>$f_paidamt,'paid_status'=>$paid_status) ,array('id'=>$debit_info->id));


                }elseif(!empty($debitpayment_info)){
                    $f_paidamt = ($debitpayment_info->paid_amt + $amount);

                    //Getting Payment status
                    $amt = $debitpayment_info->amount;
                    if($f_paidamt >= $amt){
                        $paid_status = 1;
                    }else{
                        $paid_status = 2;
                    }


                    $this->home_model->update('tbldebitnotepayment', array('paid_amt'=>$f_paidamt,'paid_status'=>$paid_status) ,array('id'=>$debitpayment_info->id));

                }


            }

            }
          }
        }
            //End for cleared cheque

            $payment_info  = $this->db->query("SELECT * from tblclientpayment where id = '".$id."' ")->row();
             $up_data['chaque_status'] = $status;
            if(!empty($chaque_clear_date)){
                $startDate = trim($chaque_clear_date);
                $startDateArray = explode('/',$startDate);
                $mysqlStartDate = $startDateArray[2]."-".$startDateArray[0]."-".$startDateArray[1];
                $date = $mysqlStartDate;

                $up_data['chaque_clear_date'] = $date;
                if($status == 1){
                    $up_data['date'] = $date;
                }

            }
            $redirecturl = "manage_cheque";
            $update = $this->home_model->update('tblclientpayment', $up_data,array('id'=>$id));
            if(!empty($update)){
                if (isset($chequesaction)){
                    if($chequesaction == "deposit"){
                        $this->home_model->delete("tblmasterapproval", array("module_id" => 50, "table_id" => $id));
                    }else if($chequesaction == "clearance"){
                        $this->home_model->delete("tblmasterapproval", array("module_id" => 51, "table_id" => $id));
                    }
                    $redirecturl = 'approval/notifications';
                }
                set_alert('success', 'cheque status. Updated Successfully');                
            }else{
                set_alert('warning', 'Something went wrong!');
            }
            redirect(admin_url($redirecturl));

        }

    }


    public function cleared_client_status()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            $clientpayment_info  = $this->db->query("SELECT * from tblclientpayment where id = '".$id."' ")->row();
            ?>
             <div class="col-md-12">
              <form action="<?php echo admin_url('manage_cheque/cleared_cheque_status'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>Status.</th>
                        <th>Action Date</th>
                      </tr>
                    </thead>
                    <tbody>

                       <tr>
                            <td>
                            <select class="form-control" name="status1">
                            <option value="">--select status--</option>
                            <option value="0" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 0){ echo 'selected'; } ?>>Pending</option>
                            <option value="2" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 2){ echo 'selected'; } ?>>Bounced</option>
                            <option value="3" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 3){ echo 'selected'; } ?>>Redeposit</option>
                            <option value="1" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 1){ echo 'selected'; } ?>>Clear</option>
                            <option value="4" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 4){ echo 'selected'; } ?>>Cancel</option>

                            </select>
                            </div>
                            </td>
                            <td><input type="text" name="chaque_clear_date1" class="form-control date_picker1" value="<?php if(!empty($clientpayment_info->chaque_clear_date)){ echo date('m/d/Y',strtotime($clientpayment_info->chaque_clear_date)); }else{ echo date('m/d/Y');} ?>"></td>
                        </tr>


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

    public function cleared_cheque_status()
    {

        if(!empty($_POST)){
            extract($this->input->post());

            $payment_info  = $this->db->query("SELECT * from tblclientpayment where id = '".$id."' ")->row();
            if(empty($chaque_clear_date1)){
                $date1 = '0000-00-00';
            }else{
                $startDate1 = trim($chaque_clear_date1);
                $startDateArray1 = explode('/',$startDate1);
                $mysqlStartDate1 = $startDateArray1[2]."-".$startDateArray1[0]."-".$startDateArray1[1];
                $date1 = $mysqlStartDate1;
            }
            $update = $this->home_model->update('tblclientpayment', array('chaque_status'=>$status1,'chaque_clear_date'=>$date1),array('id'=>$id));


            if(!empty($update)){
                set_alert('success', 'cheque status. Updated Successfully');
                redirect(admin_url('manage_cheque'));
            }else{
                set_alert('warning', 'Something went wrong!');
                redirect(admin_url('manage_cheque'));
            }

        }

    }

    public function cancelled_client_status()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            $clientpayment_info  = $this->db->query("SELECT * from tblclientpayment where id = '".$id."' ")->row();
            ?>
             <div class="col-md-12">
              <form action="<?php echo admin_url('manage_cheque/cancelled_cheque_status'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>Status.</th>
                        <th>Cheque Clear Date.</th>
                      </tr>
                    </thead>
                    <tbody>

                       <tr>
                            <td>
                            <select class="form-control" name="status2">
                            <option value="">--select status--</option>
                            <option value="0" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 0){ echo 'selected'; } ?>>Pending</option>
                            <option value="2" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 2){ echo 'selected'; } ?>>Bounced</option>
                            <option value="3" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 3){ echo 'selected'; } ?>>Redeposit</option>
                            <option value="1" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 1){ echo 'selected'; } ?>>Clear</option>
                            <option value="4" <?php if(isset($clientpayment_info->chaque_status) && $clientpayment_info->chaque_status == 4){ echo 'selected'; } ?>>Cancel</option>

                            </select>
                            </div>
                            </td>
                            <td><input type="text" name="chaque_clear_date2" class="form-control date_picker2" value="<?php if(!empty($clientpayment_info->chaque_clear_date)){ echo date('m/d/Y',strtotime($clientpayment_info->chaque_clear_date)); }else{ echo date('m/d/Y');} ?>"></td>
                        </tr>


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

    public function cancelled_cheque_status()
    {

        if(!empty($_POST)){
            extract($this->input->post());

            $payment_info  = $this->db->query("SELECT * from tblclientpayment where id = '".$id."' ")->row();
            if(empty($chaque_clear_date2)){
                $date2 = '0000-00-00';
            }else{
                $startDate2 = trim($chaque_clear_date2);
                $startDateArray2 = explode('/',$startDate2);
                $mysqlStartDate2 = $startDateArray2[2]."-".$startDateArray2[0]."-".$startDateArray2[1];
                $date2 = $mysqlStartDate2;
            }
            $update = $this->home_model->update('tblclientpayment', array('chaque_status'=>$status2,'chaque_clear_date'=>$date2),array('id'=>$id));


            if(!empty($update)){
                set_alert('success', 'cheque status. Updated Successfully');
                redirect(admin_url('manage_cheque'));
            }else{
                set_alert('warning', 'Something went wrong!');
                redirect(admin_url('manage_cheque'));
            }

        }

    }

    public function vendor_cheque()
    {
        $wheres1 = "t1.status = 1 and (t2.chaque_status = 0 || t2.chaque_status = 2 || t2.chaque_status = 3) and t2.method = 'CHEQUE' and t2.utr_no != '' ";
        $wheres2 = "t1.status = 1 and (t2.chaque_status = 1) and t2.method = 'CHEQUE' and t2.utr_no != '' ";
        $wheres3 = "t1.status = 1 and (t2.chaque_status = 4) and t2.method = 'CHEQUE' and t2.utr_no != '' ";
        if(!empty($_POST)){
            extract($this->input->post());

            $data['from_page'] = $from_page;

            if($from_page == 1){
                if(!empty($f_date) && !empty($t_date)){
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;
                    $wheres1 .= " and t1.created_at between '".db_date($f_date)."' and '".db_date($t_date)."' ";
                }
             }elseif($from_page == 2){
                if(!empty($f_date1) && !empty($t_date1)){
                    $data['f_date1'] = $f_date1;
                    $data['t_date1'] = $t_date1;
                    $wheres2 .= " and t1.created_at between '".db_date($f_date1)."' and '".db_date($t_date1)."' ";
                }

            }elseif($from_page == 3){
                if(!empty($f_date2) && !empty($t_date2)){
                    $data['f_date2'] = $f_date2;
                    $data['t_date2'] = $t_date2;
                    $wheres3 .= " and t1.created_at between '".db_date($f_date2)."' and '".db_date($t_date2)."' ";
                }

            }
        }


        $data['pending_cheque'] = $this->db->query("SELECT * from `tblbankpayment` as t1 JOIN tblbankpaymentdetails as t2 ON t1.id = t2.main_id where ".$wheres1." ")->result();
        $data['cleared_cheque'] = $this->db->query("SELECT * from `tblbankpayment` as t1 JOIN tblbankpaymentdetails as t2 ON t1.id = t2.main_id where ".$wheres2." ")->result();
        $data['cancelled_cheque'] = $this->db->query("SELECT * from `tblbankpayment` as t1 JOIN tblbankpaymentdetails as t2 ON t1.id = t2.main_id where ".$wheres3." ")->result();

        $data['vendor_data'] = $this->db->query("SELECT `name`,`id` from `tblvendor`  ")->result();


        $data['title'] = 'Vendor Cheque Details';
        $this->load->view('admin/manage_cheque/vendor_cheque_report', $data);

    }


    public function pending_vendor_status()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            $vendorpayment_info  = $this->db->query("SELECT * from tblbankpaymentdetails where id = '".$id."' ")->row();
            ?>
             <div class="col-md-12">
              <form action="<?php echo admin_url('manage_cheque/pending_vendor_cheque_status'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>Status.</th>
                        <th>Cheque Clear Date.</th>
                      </tr>
                    </thead>
                    <tbody>

                       <tr>
                            <td>
                            <select class="form-control" name="status">
                            <option value="">--select status--</option>
                            <option value="0" <?php if(isset($vendorpayment_info->chaque_status) && $vendorpayment_info->chaque_status == 0){ echo 'selected'; } ?>>Pending</option>
                            <option value="2" <?php if(isset($vendorpayment_info->chaque_status) && $vendorpayment_info->chaque_status == 2){ echo 'selected'; } ?>>Bounced</option>
                            <option value="3" <?php if(isset($vendorpayment_info->chaque_status) && $vendorpayment_info->chaque_status == 3){ echo 'selected'; } ?>>Redeposit</option>
                            <option value="1" <?php if(isset($vendorpayment_info->chaque_status) && $vendorpayment_info->chaque_status == 1){ echo 'selected'; } ?>>Clear</option>
                            <option value="4" <?php if(isset($vendorpayment_info->chaque_status) && $vendorpayment_info->chaque_status == 4){ echo 'selected'; } ?>>Cancel</option>

                            </select>
                            </div>
                            </td>
                            <td><input type="text" name="chaque_clear_date" class="form-control date_picker" value="<?php if(!empty($vendorpayment_info->chaque_clear_date)){ echo date('m/d/Y',strtotime($vendorpayment_info->chaque_clear_date)); }else{ echo date('m/d/Y');} ?>"></td>
                        </tr>


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

    public function pending_vendor_cheque_status()
    {

        if(!empty($_POST)){
            extract($this->input->post());

            $payment_info  = $this->db->query("SELECT * from tblbankpaymentdetails where id = '".$id."' ")->row();

            if(empty($chaque_clear_date)){
                $date = '0000-00-00';
            }else{
                $startDate = trim($chaque_clear_date);
                $startDateArray = explode('/',$startDate);
                $mysqlStartDate = $startDateArray[2]."-".$startDateArray[0]."-".$startDateArray[1];
                $date = $mysqlStartDate;
            }  //echo $chaque_clear_date; echo'<br>'; echo $date; die;
            $update = $this->home_model->update('tblbankpaymentdetails', array('chaque_status'=>$status,'chaque_clear_date'=>$date),array('id'=>$id));


            if(!empty($update)){
                set_alert('success', 'cheque status. Updated Successfully');
                redirect(admin_url('manage_cheque/vendor_cheque'));
            }else{
                set_alert('warning', 'Something went wrong!');
                redirect(admin_url('manage_cheque/vendor_cheque'));
            }

        }

    }

    public function cleared_vendor_status()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            $vendorpayment_info1  = $this->db->query("SELECT * from tblbankpaymentdetails where id = '".$id."' ")->row();
            ?>
             <div class="col-md-12">
              <form action="<?php echo admin_url('manage_cheque/cleared_vendor_cheque_status'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>Status.</th>
                        <th>Cheque Clear Date.</th>
                      </tr>
                    </thead>
                    <tbody>

                       <tr>
                            <td>
                            <select class="form-control" name="status1">
                            <option value="">--select status--</option>
                            <option value="0" <?php if(isset($vendorpayment_info1->chaque_status) && $vendorpayment_info1->chaque_status == 0){ echo 'selected'; } ?>>Pending</option>
                            <option value="2" <?php if(isset($vendorpayment_info1->chaque_status) && $vendorpayment_info1->chaque_status == 2){ echo 'selected'; } ?>>Bounced</option>
                            <option value="3" <?php if(isset($vendorpayment_info1->chaque_status) && $vendorpayment_info1->chaque_status == 3){ echo 'selected'; } ?>>Redeposit</option>
                            <option value="1" <?php if(isset($vendorpayment_info1->chaque_status) && $vendorpayment_info1->chaque_status == 1){ echo 'selected'; } ?>>Clear</option>
                            <option value="4" <?php if(isset($vendorpayment_info1->chaque_status) && $vendorpayment_info1->chaque_status == 4){ echo 'selected'; } ?>>Cancel</option>

                            </select>
                            </div>
                            </td>
                            <td><input type="text" name="chaque_clear_date1" class="form-control date_picker1" value="<?php if(!empty($vendorpayment_info1->chaque_clear_date)){ echo date('m/d/Y',strtotime($vendorpayment_info1->chaque_clear_date)); }else{ echo date('m/d/Y');} ?>"></td>
                        </tr>


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

    public function cleared_vendor_cheque_status()
    {

        if(!empty($_POST)){
            extract($this->input->post());

            $payment_info1  = $this->db->query("SELECT * from tblbankpaymentdetails where id = '".$id."' ")->row();
            if(empty($chaque_clear_date1)){
                $date1 = '0000-00-00';
            }else{
                $startDate1 = trim($chaque_clear_date1);
                $startDateArray1 = explode('/',$startDate1);
                $mysqlStartDate1 = $startDateArray1[2]."-".$startDateArray1[0]."-".$startDateArray1[1];
                $date1 = $mysqlStartDate1;
            }
            $update = $this->home_model->update('tblbankpaymentdetails', array('chaque_status'=>$status1,'chaque_clear_date'=>$date1),array('id'=>$id));


            if(!empty($update)){
                set_alert('success', 'cheque status. Updated Successfully');
                redirect(admin_url('manage_cheque/vendor_cheque'));
            }else{
                set_alert('warning', 'Something went wrong!');
                redirect(admin_url('manage_cheque/vendor_cheque'));
            }

        }

    }

    public function cancelled_vendor_status()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            $vendorpayment_info2  = $this->db->query("SELECT * from tblbankpaymentdetails where id = '".$id."' ")->row();
            ?>
             <div class="col-md-12">
              <form action="<?php echo admin_url('manage_cheque/cancelled_vendor_cheque_status'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>Status.</th>
                        <th>Action Date</th>
                      </tr>
                    </thead>
                    <tbody>

                       <tr>
                            <td>
                            <select class="form-control" name="status2">
                            <option value="">--select status--</option>
                            <option value="0" <?php if(isset($vendorpayment_info2->chaque_status) && $vendorpayment_info2->chaque_status == 0){ echo 'selected'; } ?>>Pending</option>
                            <option value="2" <?php if(isset($vendorpayment_info2->chaque_status) && $vendorpayment_info2->chaque_status == 2){ echo 'selected'; } ?>>Bounced</option>
                            <option value="3" <?php if(isset($vendorpayment_info2->chaque_status) && $vendorpayment_info2->chaque_status == 3){ echo 'selected'; } ?>>Redeposit</option>
                            <option value="1" <?php if(isset($vendorpayment_info2->chaque_status) && $vendorpayment_info2->chaque_status == 1){ echo 'selected'; } ?>>Clear</option>
                            <option value="4" <?php if(isset($vendorpayment_info2->chaque_status) && $vendorpayment_info2->chaque_status == 4){ echo 'selected'; } ?>>Cancel</option>

                            </select>
                            </div>
                            </td>
                            <td><input type="text" name="chaque_clear_date2" class="form-control date_picker2" value="<?php if(!empty($vendorpayment_info2->chaque_clear_date)){ echo date('m/d/Y',strtotime($vendorpayment_info2->chaque_clear_date)); }else{ echo date('m/d/Y');} ?>"></td>
                        </tr>


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

    public function cancelled_vendor_cheque_status()
    {
        if(!empty($_POST)){
            extract($this->input->post());

            $payment_info2  = $this->db->query("SELECT * from tblbankpaymentdetails where id = '".$id."' ")->row();
            if(empty($chaque_clear_date2)){
                $date2 = '0000-00-00';
            }else{
                $startDate2 = trim($chaque_clear_date2);
                $startDateArray2 = explode('/',$startDate2);
                $mysqlStartDate2 = $startDateArray2[2]."-".$startDateArray2[0]."-".$startDateArray2[1];
                $date2 = $mysqlStartDate2;
            }
            $update = $this->home_model->update('tblbankpaymentdetails', array('chaque_status'=>$status2,'chaque_clear_date'=>$date2),array('id'=>$id));


            if(!empty($update)){
                set_alert('success', 'cheque status. Updated Successfully');
                redirect(admin_url('manage_cheque/vendor_cheque'));
            }else{
                set_alert('warning', 'Something went wrong!');
                redirect(admin_url('manage_cheque/vendor_cheque'));
            }
        }
    }

    public function chequedepositrequest($section, $id){
        $data["title"] = "Cheque Deposit Request";
        
        $data["clientpaymentrequest"] = $this->db->query("SELECT * FROM `tblclientpayment` WHERE `id` = $id ")->row();
        $data["section"] = $section;
        $this->load->view('admin/manage_cheque/chequedepositrequest', $data);
    } 

    /* this function use for upcoming payment list */
    public function upcoming_payment_list()
    {

        $where = "id > 0";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($client_id)){
                $data['client_id'] = $client_id;
                $where .= " and client_id = '".$client_id."'";
            }
            if(!empty($payment_type)){
                $data['payment_type'] = $payment_type;
                $where .= " and payment_type = '".$payment_type."'";
            }
            if(isset($received_status)){
                $data['received_status'] = $received_status;
                $where .= " and received_status = '".$received_status."'";
            }
        }

        $data['upcoming_payment_list'] = $this->db->query("SELECT * from `tblupcommingpayments` where ".$where." order by created_at desc")->result();

        $data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid` from `tblclientbranch` WHERE `client_branch_name` !='' AND `active`=1 ORDER BY client_branch_name ASC ")->result();

        $data['title'] = 'Upcoming Payment List';
        $this->load->view('admin/upcoming_payment/list', $data);
    }

    /* this function use for add upcoming payment */
    public function add_upcoming_payment($id = ''){

    	if(!empty($_POST)){
            extract($this->input->post());

            $remark = (!empty($remark)) ? $remark : '';
            $field_arr = array(
            	'added_by' => get_staff_user_id(), 
            	'client_id' => $client_id,
            	'payment_type' => $payment_type,
            	'amount' => $amount,
            	'ref_no' => $ref_no,
            	'remark' => $remark,
            	'created_at' => date("Y-m-d H:i:s")
            );

            if ($id != ''){
            	unset($field_arr["added_by"]);
            	unset($field_arr["created_at"]);
            	$response = $this->home_model->update("tblupcommingpayments", $field_arr, array('id' => $id));
            }else{
            	$response = $this->home_model->insert("tblupcommingpayments", $field_arr);
            }
            if (!empty($response)){
                $message = ($id != '') ? "Upcoming payment update successfully." : "Upcoming payment added successfully.";
                set_alert('success', $message);
                redirect(admin_url('manage_cheque/upcoming_payment_list'));
            }else{
                set_alert('danger', "Somthing went wrong");
                redirect(admin_url('manage_cheque/upcoming_payment_list'));
            }
        }    
    	if ($id != ''){
    		$data["title"] = "Edit Upcoming Payment";
    		$data['upcoming_payment_info'] = $this->db->query("SELECT * from `tblupcommingpayments` where `id`= ".$id." ")->row();
    	}else{
    		$data["title"] = "Add Upcoming Payment";
    	}
    	$data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid` from `tblclientbranch` WHERE `client_branch_name` !='' AND `active`=1 ORDER BY client_branch_name ASC ")->result();
    	$this->load->view('admin/upcoming_payment/add', $data);
    }

    /* this function use for delete upcoming payment */
    public function delete_upcoming_payment($id){
    	
    	$response = $this->home_model->delete("tblupcommingpayments", array('id' => $id));
    	if (!empty($response)){
    		set_alert('success', "Upcoming payment delete successfully");
            redirect(admin_url('manage_cheque/upcoming_payment_list'));
    	}else{
    		set_alert('danger', "Somthing went wrong");
            redirect(admin_url('manage_cheque/upcoming_payment_list'));
    	}
    }

   	/* This function use for update upcoming payment status */
   	public function update_upcoming_status($id = ''){
   		if(!empty($_POST)){
            extract($this->input->post());

            $field_arr = array('received_status' => $received_status, 'received_by'=> get_staff_user_id(), 'received_at'=> date("Y-m-d"));
            $response = $this->home_model->update("tblupcommingpayments", $field_arr, array('id' => $id));
            if (!empty($response)){
            	set_alert('success', "Received status update successfully");
            	redirect(admin_url('manage_cheque/upcoming_payment_list'));
            }else{
	    		set_alert('danger', "Somthing went wrong");
	            redirect(admin_url('manage_cheque/upcoming_payment_list'));
	    	}
        }
        $received_info = $this->db->query("SELECT * from `tblupcommingpayments` where `id`= ".$id." ")->row();
        if (!empty($received_info) && $received_info->received_by > 0){
        	$reveived_status = ($received_info->received_status == 1) ? '<span class="text-success">Received</span>':'<span class="text-danger">Not Received</span>';
    ?>
    		<div class="row">
    			<div class="col-md-12">
	    			<div class="col-md-4">
	    				<label class="control-label">Received Status :</label>
	    				<p><?php echo $reveived_status; ?></p>
	    			</div>
	    			<div class="col-md-4">
	    				<label class="control-label">Received By :</label>
	    				<span class="badge badge-info"><?php echo get_employee_fullname($received_info->received_by); ?></span>
	    			</div>
	    			<div class="col-md-4">
	    				<label class="control-label">Received At :</label>
	    				<p><?php echo _d($received_info->received_at); ?></p>
	    			</div>
	    		</div>
    		</div>
    		
    <?php    	
        }
        echo '<input type="hidden" name="id" value="'.$id.'">';
   	}
}
