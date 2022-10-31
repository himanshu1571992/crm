<?php

$session_id = $this->session->userdata();
?>
<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel_s">
          <div class="panel-body">
            <h4><?php echo $title; ?></h4>
          <div class="clearfix"></div>
          <hr class="hr-panel-heading" />
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="<?php if(!empty($from_page) && $from_page == 1){ echo 'active'; }elseif(empty($from_page)){ echo 'active'; } ?>"><a  href="#superior_request" aria-controls="superior_request" role="tab" data-toggle="tab">Payment Request <span style="background-color:#f44336;" class="badge badge-danger payment_bell"></span></a></li>
            <li role="presentation" class="<?php echo (!empty($from_page) && $from_page == 2) ? 'active' : ''; ?>"><a href="#employee_request" aria-controls="employee_request" role="tab" data-toggle="tab">Employee Request <span style="background-color:#f44336;" class="badge badge-danger employee_bell"></span></a></li>
            <li role="presentation" class="<?php echo (!empty($from_page) && $from_page == 3) ? 'active' : ''; ?>"><a href="#po_request" aria-controls="po_request" role="tab" data-toggle="tab">Po Payment Request <span style="background-color:#f44336;" class="badge badge-danger po_payment_bell"></span></a></li>
            <li role="presentation" class="<?php echo (!empty($from_page) && $from_page == 4) ? 'active' : ''; ?>"><a href="#pettycash_request" aria-controls="pettycash_request" role="tab" data-toggle="tab">Petty Cash Request <span style="background-color:#f44336;" class="badge badge-danger pettycash_bell"></span></a></li>
            <li role="presentation" class="<?php echo (!empty($from_page) && $from_page == 5) ? 'active' : ''; ?>"><a href="#client_deposit_request" aria-controls="client_deposit_request" role="tab" data-toggle="tab">Client Payments <span style="background-color:#f44336;" class="badge badge-danger clientdeposit_bell"></span></a></li>
            <li role="presentation" class="<?php echo (!empty($from_page) && $from_page == 6) ? 'active' : ''; ?>"><a href="#employee_salary_request" aria-controls="employee_salary_request" role="tab" data-toggle="tab">Employee Salary Request <span style="background-color:#f44336;" class="badge badge-danger salary_bell"></span></a></li>

            <!--<li role="presentation"><a href="#phrases" aria-controls="phrases" role="tab" data-toggle="tab">third</a></li>-->
          </ul>
          <div class="tab-content">


              <div role="tabpanel" class="tab-pane <?php if (!empty($from_page) && $from_page == 1) {
                    echo 'active';
                } elseif (empty($from_page)) {
                    echo 'active';
                } ?>" id="superior_request">
                  <form method="post" enctype="multipart/form-data" action="">
                      <input type="hidden" value="1" name="from_page">
                      <div class="row">
                          <div class="form-group col-md-2">
                              <label for="status" class="control-label">Select Status</label>
                              <select class="form-control selectpicker" id="status" name="status">
                                  <option value="" disabled selected >--Select One-</option>
                                  <option value="0"<?php echo (isset($status_1) && $status_1 == 0) ? 'selected' : "" ?>>Payfile Pending</option>
                                  <option value="1"<?php echo (isset($status_1) && $status_1 == 1) ? 'selected' : "" ?>>Payfile Done</option>
                              </select>
                          </div>
                          <div class="form-group col-md-2">
                              <label for="accept_status" class="control-label">Accept Status</label>
                              <select class="form-control selectpicker" id="accept_status" name="accept_status">
                                  <option value="" disabled selected >--Select One-</option>
                                  <option value="0"<?php echo (isset($accept_status_1) && $accept_status_1 == 0) ? 'selected' : "" ?>>Pending</option>
                                  <option value="1"<?php echo (isset($accept_status_1) && $accept_status_1 == 1) ? 'selected' : "" ?>>Accepted</option>
                              </select>
                          </div>
                          <div class="form-group col-md-2">
                              <label for="utr_status" class="control-label">UTR Status</label>
                              <select class="form-control selectpicker" id="utr_status" name="utr_status">
                                  <option value="" disabled selected >--Select One-</option>
                                  <option value="1"<?php echo (isset($utr_status_1) && $utr_status_1 == 1) ? 'selected' : "" ?>>UTR Pending</option>
                                  <option value="2"<?php echo (isset($utr_status_1) && $utr_status_1 == 2) ? 'selected' : "" ?>>UTR Done</option>
                              </select>
                          </div>
                          <div class="form-group col-md-2" app-field-wrapper="date">
                              <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                              <div class="input-group date">
                                  <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                              </div>
                          </div>
                          <div class="form-group col-md-2" app-field-wrapper="date">
                              <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                              <div class="input-group date">
                                  <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : "" ?>" aria-invalid="false" type="text">
                                  <div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                              </div>
                          </div>
                          <div class="form-group col-md-2 float-right" style="margin-top: 26px;">
                              <button class="btn btn-info" type="submit">Search</button>
                              <a class="btn btn-danger" href="" >Reset</a>
                          </div>
                      </div>
                  </form>
                  <div class="table-responsive" style="margin-bottom:30px;">
                    <hr>
                        <table class="table" id="payfill_table">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Request Id</th>
                                    <th>Category</th>
                                    <th>Party Name</th>
                                    <th>Remark</th>
                                    <th>Date</th>
                                    <th>Total Amount</th>
                                    <th width="15%">Accept Status</th>
                                    <th>Payfile Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="ui-sortable">

                                <?php
                                $i = 1;
                                $accept_status_val = 0;
                                if (!empty($superior_request_info)) {
                                    foreach ($superior_request_info as $row) {
                                            $payreq_id = '';
                                        if ($row->payfile_done == 0) {
                                            $status = 'Payfile Pending';
                                            $cls = 'btn-warning';
                                        } elseif ($row->payfile_done == 1) {
                                            $status = 'Done';
                                            $cls = 'btn-success';
                                            $payreq_id = '<a target="_blank" href="'.admin_url('bank_payments/view/'.$row->pay_id).'">PAY-'.$row->pay_id.'</a>';
                                        }

                                        if ($row->acceptance == 0) {
                                            $accept_status_val = ++$accept_status_val;
                                            $accept_status = 'Acceptance Pending';
                                            $accept_cls = 'btn-warning';
                                            $change_status = 1;
                                            $title = 'Change to Accepted';
                                        } elseif ($row->acceptance == 1) {
                                            $accept_status = 'Accepted';
                                            $accept_cls = 'btn-success';
                                            $change_status = 0;
                                            $title = 'Change to Pending';
                                        }

                                        $utr_no_info = $this->db->query("SELECT `utr_no`,`utr_date` FROM tblbankpaymentdetails WHERE pay_type = 'pay_request' and pay_type_id = '" . $row->id . "' ")->row();

                                        if($row->type == 2 && $row->category_id == 6){
                                            $party_name = $row->party_name;
                                        }else{
                                            $party_name = value_by_id('tblcompanyexpenseparties',$row->party_id,'name');
                                        }

                                        $accls = " _delete";
                                        $acceptance_url = admin_url('bank_payments/acceptance_action/1/' . $change_status . '/' . $row->id);
                                        if ($row->payfile_done == 1) {
                                            $acceptance_url = "javascript:void(0);";
                                            $accls = " ";
                                        }
                                        ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><a target="_blank" href="<?php echo admin_url('company_expense/paymentrequest_view/'.$row->id); ?>"><?php echo 'REQ-' . $row->id; ?></a></td>
                                                    <!-- <td><?php echo get_employee_name($row->user_id); ?></td> -->
                                                <td><?php echo value_by_id('tblcompanyexpensecatergory', $row->category_id, 'name'); ?></td>
                                                <td><?php echo $party_name; ?></td>
                                                <td><?php echo $row->remark; ?></td>
                                                <td><?php echo _d($row->created_at); ?></td>
                                                <td><?php echo $row->amount; ?></td>
                                                <?php if ($row->approved_status == 1){ ?>
                                                    <td><?php echo '<a title="' . $title . '" href="' . $acceptance_url . '" class="' . $accept_cls . ' btn-sm' . $accls . ' " >' . $accept_status . '</a>'; ?></td>
                                                    <td>
                                                        <?php echo '<button type="button" class="' . $cls . ' btn-sm status" value="' . $row->id . '" >' . $status . '</button>'; ?>
                                                        <br><?php echo $payreq_id; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                            if ($row->payfile_done == 0 && $row->acceptance == 1) {
                                                                ?>
                                                                <a target="_blank" class="btn-sm btn-info" href="<?php echo admin_url('bank_payments/add?type=pay_request&id=' . $row->id); ?>">Pay File</a>
                                                                <?php
                                                            } else {
                                                                if (!empty($utr_no_info->utr_no)) {
                                                                    echo $utr_no_info->utr_no.'<br>'._d($utr_no_info->utr_date);;
                                                                } else {
                                                                    echo '--';
                                                                }
                                                            }  
                                                        ?>
                                                    </td>
                                                <?php 
                                                    }else{
                                                        echo '<td class="text-center"><span style="cursor: pointer;" class="badge badge-info status" value="' . $row->id . '" data-toggle="modal" data-target="#statusModal">Approval Pending</span></td>';
                                                        echo '<td class="text-center">--</td>';
                                                        echo '<td class="text-center">--</td>';
                                                    }
                                                 ?>
                                            </tr>

                                        <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                      <input type="hidden" name="payment_req" class="payment_req" value="<?php echo $accept_status_val; ?>">
                    </div>
                </div>
          <div role="tabpanel" class="tab-pane <?php echo (!empty($from_page) && $from_page == 2) ? 'active' : ''; ?>" id="employee_request">
            <form method="post" enctype="multipart/form-data" action="">
              <input type="hidden" value="2" name="from_page">
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="employee_id" class="control-label">Select Employee</label>
                    <select class="form-control selectpicker employee_id" data-live-search="true" id="employee_id" name="employee_id">
                        <option value=""></option>
                        <?php
                        if (isset($employee_info) && count($employee_info) > 0) {
                            foreach ($employee_info as $employee_value) {
                                ?>
                                <option value="<?php echo $employee_value['staffid']; ?>" <?php if(!empty($employee_id) && $employee_id == $employee_value['staffid']){ echo 'selected'; } ?>><?php echo $employee_value['firstname'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="status" class="control-label">Select Status</label>
                    <select class="form-control selectpicker" id="status" name="status">
                    <option value="" disabled selected >--Select One-</option>
                    <option value="0"<?php echo (isset($status_2) && $status_2 == 0) ? 'selected' : "" ?>>Payfile Pending</option>
                    <option value="1"<?php echo (isset($status_2) && $status_2 == 1) ? 'selected' : "" ?>>Payfile Done</option>
                   </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="accept_status" class="control-label">Accept Status</label>
                    <select class="form-control selectpicker" id="accept_status" name="accept_status">
                    <option value="" disabled selected >--Select One-</option>
                    <option value="0"<?php echo (isset($accept_status_2) && $accept_status_2 == 0) ? 'selected' : "" ?>>Pending</option>
                    <option value="1"<?php echo (isset($accept_status_2) && $accept_status_2 == 1) ? 'selected' : "" ?>>Accepted</option>
                   </select>
                </div>

                <div class="form-group col-md-3">
                  <label for="utr_status" class="control-label">UTR Status</label>
                  <select class="form-control selectpicker" id="utr_status" name="utr_status">
                    <option value="" disabled selected >--Select One-</option>
                    <option value="1"<?php echo (isset($utr_status_2) && $utr_status_2 == 1) ? 'selected' : "" ?>>UTR Pending</option>
                    <option value="2"<?php echo (isset($utr_status_2) && $utr_status_2 == 2) ? 'selected' : "" ?>>UTR Done</option>
                  </select>
                </div>



                <div class="form-group col-md-3" app-field-wrapper="date">
                  <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                  <div class="input-group date">
                    <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                  </div>
                </div>

                <div class="form-group col-md-3" app-field-wrapper="date">
                    <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                    <div class="input-group date">
                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                    </div>
                </div>
                <div class="form-group col-md-2 float-right" style="margin-top: 26px;">
                    <button class="btn btn-info" type="submit">Search</button>
                    <a class="btn btn-danger" href="" >Reset</a>
                </div>

            </div>

            </form>

            <div class="table-responsive" style="margin-bottom:30px;">
                <table class="table" id="newtable">
                      <thead>
                          <tr>
                              <th>S.No</th>
                              <th>Request ID</th>
                              <th>Employee Name</th>
                              <th>Date</th>
                              <th>Total Amount</th>
                              <th>Accept Status</th>
                              <th>Payfile Status</th>
                              <th class="text-center">Pay File</th>
                          </tr>
                      </thead>

                <tbody class="ui-sortable">

             <?php

                $i=1;
                $employee_pending_val = 0;
                if(!empty($employee_request_info)){
                  foreach ($employee_request_info as $row) {
                        $payreq_id = '';
                        if($row->payfile_done == 0){
                            $status = 'Payfile Pending';
                            $cls = 'btn-warning';
                        }elseif($row->payfile_done == 1){
                            $status = 'Done';
                            $cls = 'btn-success';
                            $payreq_id = '<br><a target="_blank" href="'.admin_url('bank_payments/view/'.$row->pay_id).'">PAY-'.$row->pay_id.'</a>';
                        }


                      if($row->acceptance == 0){
                            if($row->category == 4 || $row->by_pettycash == 1 || $row->payment_type == 2){
                                $employee_pending_val = $employee_pending_val;
                            }else{
                                $employee_pending_val = ++$employee_pending_val;
                            }

                          $accept_status = 'Acceptance Pending';
                          $accept_cls = 'btn-warning';
                          $change_status = 1;
                          $title = 'Change to Accepted';
                      }elseif($row->acceptance == 1){
                          $accept_status = 'Accepted';
                          $accept_cls = 'btn-success';
                          $change_status = 0;
                          $title = 'Change to Pending';
                      }

                      $cat = get_last(get_request_category($row->category));
                      $cat_id = 'REQ-'.get_short($cat).'-'.number_series($row->id);

                      $utr_no_info  = $this->db->query("SELECT `utr_no`,`utr_date` FROM tblbankpaymentdetails WHERE pay_type = 'request' and pay_type_id = '".$row->id."' ")->row();

                    $accls = " _delete";
                    $acceptance_url = admin_url('bank_payments/acceptance_action/2/'.$change_status.'/'.$row->id);
                    if ($row->payfile_done == 1) {
                        $acceptance_url = "javascript:void(0);";
                        $accls = " ";
                    }
                  ?>
                   <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $cat_id; ?></td>
                      <td><?php echo get_employee_name($row->addedfrom);?></td>
                      <td><?php echo _d($row->date); ?></td>
                      <td><?php echo $row->approved_amount;?></td>
                      <td><?php if($row->category == 4 || $row->by_pettycash == 1 || $row->payment_type == 2){ echo '--'; } else { echo '<a title="'.$title.'" href="'.$acceptance_url.'" class="'.$accept_cls.' btn-sm '.$accls.'" >'.$accept_status.'</a>'; } ?></td>
                      <td><?php if($row->category == 4 || $row->by_pettycash == 1 || $row->payment_type == 2){ echo '--'; } else { echo '<button type="button" class="'.$cls.' btn-sm" value="'.$row->id.'" >'.$status.'</button>'.$payreq_id; } ?></td>
                      <td class="text-center">
                          <?php
                          if($row->category == 4){
                            echo '<span style="color:green;">Transferred</span>';
                          }elseif($row->by_pettycash == 1){
                            echo '<span style="color:green;">By Pettycash</span>';
                          }elseif($row->payment_type == 2){
                            echo '<span style="color:green;">By Cash</span>';
                          }elseif($row->payfile_done == 0 && $row->acceptance == 1){
                              ?>
                              <a target="_blank" class="btn-sm btn-info" href="<?php echo admin_url('bank_payments/add?type=request&id='.$row->id); ?>">Pay File</a>
                              <?php
                          }else{
                              if(!empty($utr_no_info->utr_no)){
                                echo $utr_no_info->utr_no.'<br>'._d($utr_no_info->utr_date);;
                              }else{
                                echo '--';
                              }

                          }
                          ?>
                      </td>
                   </tr>
                  <?php
                  $i++;
                      }

                  }

                ?>

                </tbody>

               </table>
                <input type="hidden" name="employee_req" class="employee_req" value="<?php echo $employee_pending_val; ?>">
             </div>
          </div>


          <div role="tabpanel" class="tab-pane <?php echo (!empty($from_page) && $from_page == 3) ? 'active' : ''; ?>" id="po_request">
            <form method="post" enctype="multipart/form-data" action="">
              <input type="hidden" value="3" name="from_page">
            <div class="row">

                <div class="form-group col-md-3">
                    <label for="status" class="control-label">Select Status</label>
                    <select class="form-control selectpicker" id="status" name="status">
                    <option value="" disabled selected >--Select One-</option>
                    <option value="0"<?php echo (isset($status_3) && $status_3 == 0) ? 'selected' : "" ?>>Payfile Pending</option>
                    <option value="1"<?php echo (isset($status_3) && $status_3 == 1) ? 'selected' : "" ?>>Payfile Done</option>
                   </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="accept_status" class="control-label">Accept Status</label>
                    <select class="form-control selectpicker" id="accept_status" name="accept_status">
                    <option value="" disabled selected >--Select One-</option>
                    <option value="0"<?php echo (isset($accept_status_3) && $accept_status_3 == 0) ? 'selected' : "" ?>>Pending</option>
                    <option value="1"<?php echo (isset($accept_status_3) && $accept_status_3 == 1) ? 'selected' : "" ?>>Accepted</option>
                   </select>
                </div>

                <div class="form-group col-md-3">
                  <label for="utr_status" class="control-label">UTR Status</label>
                  <select class="form-control selectpicker" id="utr_status" name="utr_status">
                    <option value="" disabled selected >--Select One-</option>
                    <option value="1"<?php echo (isset($utr_status_3) && $utr_status_3 == 1) ? 'selected' : "" ?>>UTR Pending</option>
                    <option value="2"<?php echo (isset($utr_status_3) && $utr_status_3 == 2) ? 'selected' : "" ?>>UTR Done</option>
                  </select>
                </div>

                <div class="form-group col-md-2 float-right" style="margin-top: 26px;">
                    <button class="btn btn-info" type="submit">Search</button>
                    <a class="btn btn-danger" href="" >Reset</a>
                </div>

            </div>

            </form>

            <div class="table-responsive" style="margin-bottom:30px;">
                <table class="table" id="newtable1">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Po. No.</th>
                            <th>Vendor Name</th>
                            <th>View PO</th>
                            <th>Added By</th>
                            <th>Payment Type</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Accept Status</th>
                            <th>Payfile Status</th>
                            <th class="text-center">Pay File</th>
                        </tr>
                    </thead>

                <tbody class="ui-sortable">

             <?php

                $i=1;
                $po_pending_val = 0;
                if(!empty($po_request_info)){
                  foreach ($po_request_info as $row) {

                        $payreq_id = '';
                        if($row->payfile_done == 0){
                            $status = 'Payfile Pending';
                            $cls = 'btn-warning';
                        }elseif($row->payfile_done == 1){
                            $status = 'Done';
                            $cls = 'btn-success';
                            $payreq_id = '<br><a target="_blank" href="'.admin_url('bank_payments/view/'.$row->pay_id).'">PAY-'.$row->pay_id.'</a>';
                        }

                      if($row->acceptance == 0){
                          $po_pending_val = ++$po_pending_val;
                          $accept_status = 'Acceptance Pending';
                          $accept_cls = 'btn-warning';
                          $change_status = 1;
                          $title = 'Change to Accepted';
                      }elseif($row->acceptance == 1){
                          $accept_status = 'Accepted';
                          $accept_cls = 'btn-success';
                          $change_status = 0;
                          $title = 'Change to Pending';
                      }

                      $utr_no_info  = $this->db->query("SELECT `utr_no`,`utr_date` FROM tblbankpaymentdetails WHERE pay_type = 'po_payment' and pay_type_id = '".$row->id."' ")->row();

                      $payment_type = '--';
                      if($row->payment_type == 1){
                            $payment_type = 'Advance payment<br>against PO/Proforma';
                      }elseif($row->payment_type == 2){
                            $payment_type = 'Advance payment<br>against material readiness';
                      }elseif($row->payment_type == 3){
                            $payment_type = 'Against delivery';
                      }elseif($row->payment_type == 4){
                            $payment_type = 'Against MR';
                      }

                    $accls = " _delete";
                    $acceptance_url = admin_url('bank_payments/acceptance_action/3/'.$change_status.'/'.$row->id);
                    if ($row->payfile_done == 1) {
                        $acceptance_url = "javascript:void(0);";
                        $accls = " ";
                    }
                  ?>
                   <tr>
                    <td><?php echo $i; ?></td>
                    <td>
					<?php $po_id = $this->db->query("SELECT * from tblpurchaseorder where id = '".$row->po_id."' ")->row();
                       $vendor_id = $this->db->query("SELECT * from tblvendor where id = '".$po_id->vendor_id."' ")->row();
                      $po_number = (is_numeric($po_id->number)) ? 'PO-'.$po_id->number : $po_id->number;
                      ?>
                    <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/download_pdf/'.$row->po_id); ?>">
                      <?php echo $po_number;?></a></td>
                      <td><?php echo $vendor_id->name; ?></td>
                      <td><a href="<?php echo admin_url('bank_payments/vendor_po_list/'.$po_id->vendor_id."/".$row->po_id); ?>" target="_black" class="btn-sm btn-info">View</a></td>
                      <td><?php echo get_employee_name($row->staff_id);?></td>
                      <td><?php echo $payment_type;?></td>
                      <td><?php echo _d($row->created_at); ?></td>
                      <td><?php echo $row->approved_amount; ?></td>
                      <?php if ($row->status == 1){ ?>
                        <td>
                            <?php  echo '<a title="'.$title.'" href="'.$acceptance_url.'" class="'.$accept_cls.' btn-sm '.$accls.'" >'.$accept_status.'</a>'; ?>
                        </td>
                        <td>
                            <?php
                                echo '<button type="button" class="'.$cls.' btn-sm" value="'.$row->id.'">'.$status.'</button>';
                            ?>
                            <?php echo $payreq_id; ?>
                            </td>
                        <td class="text-center">
                            <?php
                                $is_account_changes = "No";
                                if (!empty($row->account_remark)){
                                    $is_account_changes = "Yes";
                                    echo '<a href="javascript:void(0)" id="account_changes_div" data-payment_id="'.$row->id.'" class="label label-success">Amount Changed</a>';
                                }else{
                                    if ($row->payfile_done == 0){
                                        $is_account_changes = "Yes";
                                        echo '<a href="javascript:void(0)" id="account_changes_div" data-payment_id="'.$row->id.'" class="label label-success">Change Amount</a>';
                                    }
                                }
                            if($row->payfile_done == 0 && $row->acceptance == 1){
                                ?>
                                <br><br><a target="_blank" class="btn-sm btn-info" href="<?php echo admin_url('bank_payments/add?type=po_payment&id='.$row->id); ?>">Pay File</a>
                                <?php
                            }else{
                                if(!empty($utr_no_info->utr_no)){
                                    echo "<br><br>".$utr_no_info->utr_no.'<br>'._d($utr_no_info->utr_date);
                                }else{
                                    echo ($is_account_changes == "No") ? '--' : '';
                                }
                            }
                                
                            ?>
                        </td>
                      <?php }else{
                            echo '<td class="text-center"><span style="cursor: pointer;" class="badge badge-info postatus" data-section="po_payment" value="' . $row->id . '" data-toggle="modal" data-target="#myModal">Approval Pending</span></td>';
                            echo '<td class="text-center">--</td>';
                            echo '<td class="text-center">--</td>';
                        } ?>
                   </tr>



                  <?php
                  $i++;
                      }

                  }

                ?>

                </tbody>

               </table>
                <input type="hidden" name="po_req" class="po_req" value="<?php echo $po_pending_val; ?>">
             </div>
            </div>



            <div role="tabpanel" class="tab-pane <?php echo (!empty($from_page) && $from_page == 4) ? 'active' : ''; ?>" id="pettycash_request">
            <form method="post" enctype="multipart/form-data" action="">
              <input type="hidden" value="4" name="from_page">
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="employee_id" class="control-label">Select Employee</label>
                    <select class="form-control selectpicker employee_id" data-live-search="true" id="employee_id" name="employee_id">
                        <option value=""></option>
                        <?php
                        if (isset($employee_info) && count($employee_info) > 0) {
                            foreach ($employee_info as $employee_value) {
                                ?>
                                <option value="<?php echo $employee_value['staffid']; ?>" <?php if(!empty($employee_id) && $employee_id == $employee_value['staffid']){ echo 'selected'; } ?>><?php echo $employee_value['firstname'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="status" class="control-label">Select Status</label>
                    <select class="form-control selectpicker" id="status" name="status">
                    <option value="" disabled selected >--Select One-</option>
                    <option value="0"<?php echo (isset($status_4) && $status_4 == 0) ? 'selected' : "" ?>>Payfile Pending</option>
                    <option value="1"<?php echo (isset($status_4) && $status_4 == 1) ? 'selected' : "" ?>>Payfile Done</option>
                   </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="accept_status" class="control-label">Accept Status</label>
                    <select class="form-control selectpicker" id="accept_status" name="accept_status">
                    <option value="" disabled selected >--Select One-</option>
                    <option value="0"<?php echo (isset($accept_status_4) && $accept_status_4 == 0) ? 'selected' : "" ?>>Pending</option>
                    <option value="1"<?php echo (isset($accept_status_4) && $accept_status_4 == 1) ? 'selected' : "" ?>>Accepted</option>
                   </select>
                </div>

                <div class="form-group col-md-3">
                  <label for="utr_status" class="control-label">UTR Status</label>
                  <select class="form-control selectpicker" id="utr_status" name="utr_status">
                    <option value="" disabled selected >--Select One-</option>
                    <option value="1"<?php echo (isset($utr_status_4) && $utr_status_4 == 1) ? 'selected' : "" ?>>UTR Pending</option>
                    <option value="2"<?php echo (isset($utr_status_4) && $utr_status_4 == 2) ? 'selected' : "" ?>>UTR Done</option>
                  </select>
                </div>



                <div class="form-group col-md-3" app-field-wrapper="date">
                  <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                  <div class="input-group date">
                    <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                  </div>
                </div>

                <div class="form-group col-md-3" app-field-wrapper="date">
                  <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                  <div class="input-group date">
                    <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                  </div>
                </div>

                <div class="form-group col-md-2 float-right" style="margin-top: 26px;">
                    <button class="btn btn-info" type="submit">Search</button>
                    <a class="btn btn-danger" href="" >Reset</a>
                </div>

            </div>

            </form>

            <div class="table-responsive" style="margin-bottom:30px;">
                <table class="table" id="newtable2">
                      <thead>
                          <tr>
                              <th>S.No</th>
                              <th>Ref ID</th>
                              <th>Manager Name</th>
                              <th>Date</th>
                              <th>Total Amount</th>
                              <th>Accept Status</th>
                              <th>Payfile Status</th>
                              <th class="text-center">Pay File</th>
                          </tr>
                      </thead>

                <tbody class="ui-sortable">

             <?php

                $i=1;
                $pettycash_pending_val = 0;
                if(!empty($pettycash_request_info)){
                    foreach ($pettycash_request_info as $row) {

                        $payreq_id = '';
                        if($row->payfile_done == 0){
                            $status = 'Payfile Pending';
                            $cls = 'btn-warning';
                        }elseif($row->payfile_done == 1){
                            $status = 'Done';
                            $cls = 'btn-success';
                            $payreq_id = '<br><a target="_blank" href="'.admin_url('bank_payments/view/'.$row->pay_id).'">PAY-'.$row->pay_id.'</a>';
                        }

                      if($row->acceptance == 0){
                          $pettycash_pending_val = ++$pettycash_pending_val;
                          $accept_status = 'Acceptance Pending';
                          $accept_cls = 'btn-warning';
                          $change_status = 1;
                          $title = 'Change to Accepted';
                      }elseif($row->acceptance == 1){
                          $accept_status = 'Accepted';
                          $accept_cls = 'btn-success';
                          $change_status = 0;
                          $title = 'Change to Pending';
                      }

                      $reference_id = 'REQ-PETTY-'.number_series($row->id);

                      $utr_no_info  = $this->db->query("SELECT `utr_no`,`utr_date` FROM tblbankpaymentdetails WHERE pay_type = 'pettycash' and pay_type_id = '".$row->id."' ")->row();

                    $accls = " _delete";
                    $acceptance_url = admin_url('bank_payments/acceptance_action/4/'.$change_status.'/'.$row->id);
                    if ($row->payfile_done == 1) {
                        $acceptance_url = "javascript:void(0);";
                        $accls = " ";
                    }
                  ?>
                   <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $reference_id; ?></td>
                    <td><?php echo get_employee_name($row->addedfrom);?></td>
                    <td><?php echo _d($row->date); ?></td>
                    <td><?php echo $row->approved_amount;?></td>
                    <td><?php echo '<a title="'.$title.'" href="'.$acceptance_url.'" class="'.$accept_cls.' btn-sm '.$accls.'" >'.$accept_status.'</a>'; ?></td>
                    <td>
                        <?php echo '<button type="button" class="'.$cls.' btn-sm" value="'.$row->id.'" >'.$status.'</button>'; ?>
                        <?php echo $payreq_id; ?>
                    </td>
                      <td class="text-center">
                          <?php
                          if($row->payfile_done == 0 && $row->acceptance == 1){
                              ?>
                              <a target="_blank" class="btn-sm btn-info" href="<?php echo admin_url('bank_payments/add?type=pettycash&id='.$row->id); ?>">Pay File</a>
                              <?php
                          }else{
                              if(!empty($utr_no_info->utr_no)){
                                echo $utr_no_info->utr_no.'<br>'._d($utr_no_info->utr_date);
                              }else{
                                echo '--';
                              }
                          }
                          ?>
                      </td>
                   </tr>



                  <?php
                  $i++;
                      }

                  }

                ?>

                </tbody>

               </table>
                <input type="hidden" name="pettycash_req" class="pettycash_req" value="<?php echo $pettycash_pending_val; ?>">
             </div>
          </div>
            <div role="tabpanel" class="tab-pane <?php echo (!empty($from_page) && $from_page == 5) ? 'active' : ''; ?>" id="client_deposit_request">
            <form method="post" enctype="multipart/form-data" action="">
              <input type="hidden" value="5" name="from_page">
            <div class="row">

                <div class="form-group col-md-3">
                    <label for="status" class="control-label">Select Status</label>
                    <select class="form-control selectpicker" id="status" name="status">
                    <option value="" disabled selected >--Select One-</option>
                    <option value="0"<?php echo (isset($status_5) && $status_5 == 0) ? 'selected' : "" ?>>Payfile Pending</option>
                    <option value="1"<?php echo (isset($status_5) && $status_5 == 1) ? 'selected' : "" ?>>Payfile Done</option>
                   </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="accept_status" class="control-label">Accept Status</label>
                    <select class="form-control selectpicker" id="accept_status" name="accept_status">
                    <option value="" disabled selected >--Select One-</option>
                    <option value="0"<?php echo (isset($accept_status_5) && $accept_status_5 == 0) ? 'selected' : "" ?>>Pending</option>
                    <option value="1"<?php echo (isset($accept_status_5) && $accept_status_5 == 1) ? 'selected' : "" ?>>Accepted</option>
                   </select>
                </div>

                <div class="form-group col-md-2">
                  <label for="utr_status" class="control-label">UTR Status</label>
                  <select class="form-control selectpicker" id="utr_status" name="utr_status">
                    <option value="" disabled selected >--Select One-</option>
                    <option value="1"<?php echo (isset($utr_status_5) && $utr_status_5 == 1) ? 'selected' : "" ?>>UTR Pending</option>
                    <option value="2"<?php echo (isset($utr_status_5) && $utr_status_5 == 2) ? 'selected' : "" ?>>UTR Done</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="type" class="control-label">Type</label>
                    <select class="form-control selectpicker" id="type" name="type">
                        <option value="" disabled selected >--Select One-</option>
                        <option value="1" <?php echo (isset($type) && $type == 1) ? 'selected' : "" ?>>Client Deposit</option>
                        <option value="2" <?php echo (isset($type) && $type == 2) ? 'selected' : "" ?>>Client Return</option>
                    </select>
                </div>
                <div class="form-group col-md-2 float-right" style="margin-top: 26px;">
                    <button class="btn btn-info" type="submit">Search</button>
                    <a class="btn btn-danger" href="" >Reset</a>
                </div>
            </div>
            </form>
            <div class="table-responsive" style="margin-bottom:30px;">
                <table class="table" id="newtable3">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Doc. No.</th>
                            <th>Client Name</th>
                            <th>Type</th>
                            <th>Added By</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Accept Status</th>
                            <th>Payfile Status</th>
                            <th class="text-center">Pay File</th>
                        </tr>
                    </thead>

                <tbody class="ui-sortable">

             <?php

                $i=1;
                $deposit_pending_val = 0;
                if(!empty($client_deposit_info)){
                  foreach ($client_deposit_info as $row) {

                        $payreq_id = '';
                        if($row->payfile_done == 0){
                            $status = 'Payfile Pending';
                            $cls = 'btn-warning';
                        }elseif($row->payfile_done == 1){
                            $status = 'Done';
                            $cls = 'btn-success';
                            $payreq_id = '<br><a target="_blank" href="'.admin_url('bank_payments/view/'.$row->pay_id).'">PAY-'.$row->pay_id.'</a>';
                        }

                        if($row->acceptance == 0){
                            $deposit_pending_val = ++$deposit_pending_val;
                            $accept_status = 'Acceptance Pending';
                            $accept_cls = 'btn-warning';
                            $change_status = 1;
                            $title = 'Change to Accepted';
                        }elseif($row->acceptance == 1){
                            $accept_status = 'Accepted';
                            $accept_cls = 'btn-success';
                            $change_status = 0;
                            $title = 'Change to Pending';
                        }

                      $utr_no_info  = $this->db->query("SELECT `utr_no`,`utr_date` FROM tblbankpaymentdetails WHERE pay_type = 'client_deposit' and pay_type_id = '".$row->id."' ")->row();

                    $accls = " _delete";
                    $acceptance_url = admin_url('bank_payments/acceptance_action/5/' . $change_status . '/' . $row->id);
                    if ($row->payfile_done == 1) {
                        $acceptance_url = "javascript:void(0);";
                        $accls = " ";
                    }

                  ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo "CDR-".str_pad($row->id, 4, '0', STR_PAD_LEFT); ?></td>
                        <td><?php echo client_info($row->client_id)->client_branch_name; ?></td>
                        <td><span class="btn-sm btn-success">Client Deposit</span></td>
                        <td><?php echo get_employee_name($row->staff_id); ?></td>
                        <td><?php echo _d($row->created_date); ?></td>
                        <td><?php echo $row->ttl_amt; ?></td>
                        <?php if ($row->status == 1){ ?>
                            <td><?php echo '<a title="' . $title . '" href="' . $acceptance_url . '" class="' . $accept_cls . ' btn-sm '.$accls.'" >' . $accept_status . '</a>'; ?></td>
                            <td>
                                <?php
                                echo '<button type="button" class="' . $cls . ' btn-sm" value="' . $row->id . '">' . $status . '</button>';
                                echo $payreq_id;
                                ?>
                            </td>
                            <td class="text-center">
                                <?php
                                if ($row->payfile_done == 0 && $row->acceptance == 1) {
                                    ?>
                                    <a target="_blank" class="btn-sm btn-info" href="<?php echo admin_url('bank_payments/add?type=client_deposit&id=' . $row->id); ?>">Pay File</a>
                                    <?php
                                } else {
                                    if (!empty($utr_no_info->utr_no)) {
                                        echo $utr_no_info->utr_no.'<br>'._d($utr_no_info->utr_date);;
                                    } else {
                                        echo '--';
                                    }
                                }
                                ?>
                            </td>
                        <?php }else{
                            echo '<td class="text-center"><span class="badge badge-info">Approval Pending</span></td>';
                            echo '<td class="text-center">--</td>';
                            echo '<td class="text-center">--</td>';
                        } ?>
                    </tr>
                  <?php
                  $i++;
                      }

                  }

                   $r=1;
                   if(!empty($client_refund_info)){
                     foreach ($client_refund_info as $row) {

                        $payreq_id = '';
                        if($row->payfile_done == 0){
                            $status = 'Payfile Pending';
                            $cls = 'btn-warning';
                        }elseif($row->payfile_done == 1){
                            $status = 'Done';
                            $cls = 'btn-success';
                            $payreq_id = '<br><a target="_blank" href="'.admin_url('bank_payments/view/'.$row->pay_id).'">PAY-'.$row->pay_id.'</a>';
                        }

                         if($row->acceptance == 0){
                             $deposit_pending_val = ++$deposit_pending_val;
                             $accept_status = 'Acceptance Pending';
                             $accept_cls = 'btn-warning';
                             $change_status = 1;
                             $title = 'Change to Accepted';
                         }elseif($row->acceptance == 1){
                             $accept_status = 'Accepted';
                             $accept_cls = 'btn-success';
                             $change_status = 0;
                             $title = 'Change to Pending';
                         }

                         $utr_no_info  = $this->db->query("SELECT `utr_no`,`utr_date` FROM tblbankpaymentdetails WHERE pay_type = 'client_refund' and pay_type_id = '".$row->id."' ")->row();

                       $accls = " _delete";
                       $acceptance_url = admin_url('bank_payments/acceptance_action/7/' . $change_status . '/' . $row->id);
                       if ($row->payfile_done == 1) {
                           $acceptance_url = "javascript:void(0);";
                           $accls = " ";
                       }

                     ?>
                       <tr>
                           <td><?php echo $r; ?></td>
                           <td><?php echo "CR-".str_pad($row->id, 4, '0', STR_PAD_LEFT); ?></td>
                           <td><?php echo client_info($row->client_id)->client_branch_name; ?></td>
                           <td><span class="btn-sm btn-success">Client Refund</span></td>
                           <td><?php echo get_employee_name($row->added_by); ?></td>
                           <td><?php echo _d($row->created_at); ?></td>
                           <td><?php echo $row->amount; ?></td>
                           <?php if ($row->status == 1){ ?>
                                <td><?php echo '<a title="' . $title . '" href="' . $acceptance_url . '" class="' . $accept_cls . ' btn-sm '.$accls.'" >' . $accept_status . '</a>'; ?></td>
                                <td>
                                    <?php
                                            echo '<button type="button" class="' . $cls . ' btn-sm" value="' . $row->id . '">' . $status . '</button>';
                                            echo $payreq_id;
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if ($row->payfile_done == 0 && $row->acceptance == 1) {
                                        ?>
                                        <a target="_blank" class="btn-sm btn-info" href="<?php echo admin_url('bank_payments/add?type=client_refund&id=' . $row->id); ?>">Pay File</a>
                                        <?php
                                    } else {
                                        if (!empty($utr_no_info->utr_no)) {
                                            echo $utr_no_info->utr_no.'<br>'._d($utr_no_info->utr_date);;
                                        } else {
                                            echo '--';
                                        }
                                    }
                                    ?>
                                </td>
                           <?php }else{
                                echo '<td class="text-center"><span class="badge badge-info">Approval Pending</span></td>';
                                echo '<td class="text-center">--</td>';
                                echo '<td class="text-center">--</td>';
                            } ?>
                       </tr>
                     <?php
                     $i++;
                         }

                     }

                   ?>
                </tbody>

               </table>
                <input type="hidden" name="client_deposit_req" class="client_deposit_req" value="<?php echo $deposit_pending_val; ?>">
             </div>
            </div>
              <div role="tabpanel" class="tab-pane <?php echo (!empty($from_page) && $from_page == 6) ? 'active' : ''; ?>" id="employee_salary_request">
                  <form method="post" enctype="multipart/form-data" action="">
                      <input type="hidden" value="6" name="from_page">
                      <div class="row">
                          <div class="form-group col-md-3">
                              <label for="status" class="control-label">Select Status</label>
                              <select class="form-control selectpicker" id="status" name="status">
                                  <option value="" disabled selected >--Select One-</option>
                                  <option value="0"<?php echo (isset($status_6) && $status_6 == 0) ? 'selected' : "" ?>>Payfile Pending</option>
                                  <option value="1"<?php echo (isset($status_6) && $status_6 == 1) ? 'selected' : "" ?>>Payfile Done</option>
                              </select>
                          </div>
                          <div class="form-group col-md-3">
                              <label for="accept_status" class="control-label">Accept Status</label>
                              <select class="form-control selectpicker" id="accept_status" name="accept_status">
                                  <option value="" disabled selected >--Select One-</option>
                                  <option value="0"<?php echo (isset($accept_status_6) && $accept_status_6 == 0) ? 'selected' : "" ?>>Pending</option>
                                  <option value="1"<?php echo (isset($accept_status_6) && $accept_status_6 == 1) ? 'selected' : "" ?>>Accepted</option>
                              </select>
                          </div>
                          <div class="form-group col-md-3">
                              <label for="utr_status" class="control-label">UTR Status</label>
                              <select class="form-control selectpicker" id="utr_status" name="utr_status">
                                  <option value="" disabled selected >--Select One-</option>
                                  <option value="1"<?php echo (isset($utr_status_6) && $utr_status_6 == 1) ? 'selected' : "" ?>>UTR Pending</option>
                                  <option value="2"<?php echo (isset($utr_status_6) && $utr_status_6 == 2) ? 'selected' : "" ?>>UTR Done</option>
                              </select>
                          </div>

                        <div class="form-group col-md-2 float-right" style="margin-top: 26px;">
                            <button class="btn btn-info" type="submit">Search</button>
                            <a class="btn btn-danger" href="" >Reset</a>
                        </div>

                      </div>

                  </form>

                  <div class="table-responsive" style="margin-bottom:30px;">
                      <table class="table" id="newtable4">
                          <thead>
                              <tr>
                                  <th>S.No.</th>
                                  <th>Employee ID</th>
                                  <th>Employee Name</th>
                                  <th>View Salary</th>
                                  <!--<th>Added By</th>-->
                                  <th>Paid Date</th>
                                  <th>Salary For</th>
                                  <th>Amount</th>
                                  <th>Accept Status</th>
                                  <th>Payfile Status</th>
                                  <th class="text-center">Pay File</th>
                              </tr>
                          </thead>

                          <tbody class="ui-sortable">

                              <?php

                              $i = 1;
                              $salary_val = 0;
                              if (!empty($salary_info)) {
                                    foreach ($salary_info as $row) {

                                        $payreq_id = '';
                                        if ($row->payfile_done == 0) {
                                            $status = 'Payfile Pending';
                                            $cls = 'btn-warning';
                                        } elseif ($row->payfile_done == 1) {
                                            $status = 'Done';
                                            $cls = 'btn-success';
                                            $payreq_id = '<br><a target="_blank" href="'.admin_url('bank_payments/view/'.$row->pay_id).'">PAY-'.$row->pay_id.'</a>';
                                        }

                                      if ($row->acceptance == 0) {
                                          $salary_val = ++$salary_val;
                                          $accept_status = 'Acceptance Pending';
                                          $accept_cls = 'btn-warning';
                                          $change_status = 1;
                                          $title = 'Change to Accepted';
                                      } elseif ($row->acceptance == 1) {
                                          $accept_status = 'Accepted';
                                          $accept_cls = 'btn-success';
                                          $change_status = 0;
                                          $title = 'Change to Pending';
                                      }

                                      $utr_no_info = $this->db->query("SELECT `utr_no`,`utr_date` FROM tblbankpaymentdetails WHERE pay_type = 'employee_salary' and pay_type_id = '" . $row->id . "' ")->row();

                                        $accls = " _delete";
                                        $acceptance_url = admin_url('bank_payments/acceptance_action/6/' . $change_status . '/' . $row->id);
                                        if ($row->payfile_done == 1) {
                                            $acceptance_url = "javascript:void(0);";
                                            $accls = " ";
                                        }
                                      ?>
                                      <tr>
                                          <td><?php echo $i; ?></td>
                                          <td><?php echo get_employee_info($row->staff_id)->employee_id; ?></td>
                                          <td><?php echo get_employee_name($row->staff_id) ?></td>
                                          <td><?php echo '<a target="_blank" href="'. admin_url('salary/salary_print/'.$row->id).'" class="btn-sm btn-info"><i class="fa fa-print" aria-hidden="true"></i></a>'; ?></td>
                                          <td><?php echo _d($row->create_at); ?></td>
                                          <td><?php echo date("M-Y", strtotime($row->year.'-'.$row->month.'-01')); ?></td>
                                          <td><?php echo $row->net_salary; ?></td>
                                          <td><?php echo '<a title="' . $title . '" href="' . $acceptance_url . '" class="' . $accept_cls . ' btn-sm '.$accls.'" >' . $accept_status . '</a>'; ?></td>
                                          <td>
                                            <?php
                                                echo '<button type="button" class="' . $cls . ' btn-sm" value="' . $row->id . '">' . $status . '</button>';
                                                echo $payreq_id;
                                            ?>
                                          </td>
                                          <td class="text-center">
                                              <?php
                                              if ($row->payfile_done == 0 && $row->acceptance == 1) {
                                                  ?>
                                                  <a target="_blank" class="btn-sm btn-info" href="<?php echo admin_url('bank_payments/add?type=employee_salary&id=' . $row->id); ?>">Pay File</a>
                                                  <?php
                                              } else {
                                                  if (!empty($utr_no_info->utr_no)) {
                                                      echo $utr_no_info->utr_no . '<br>' . _d($utr_no_info->utr_date);
                                                      ;
                                                  } else {
                                                      echo '--';
                                                  }
                                              }
                                              ?>
                                          </td>
                                      </tr>
                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>

                          </tbody>

                      </table>
                      <input type="hidden" name="salary_req" class="salary_req" value="<?php echo $salary_val; ?>">
                  </div>
              </div>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
</div>
<div id="accountchangesmodal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:900px;">
        <div id="accountchanges_div">
            
        </div>
    </div>
</div>

<div id="statusModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Payment Request Status</h4>
            </div>
            <div class="modal-body" id="approval_html">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Assigned Person</h4>
            </div>
            <div class="modal-body">
                <div id="poapproval_html"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- /.modal -->
<?php init_tail(); ?>

</body>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>



<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
<script>



$(document).ready(function() {

    $('#payfill_table, #newtable, #newtable1, #newtable2, #newtable3, #newtable4').DataTable( {
        "iDisplayLength": 25,
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
          'pageLength',
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            // {
            //     extend: 'pdf',
            //     exportOptions: {
            //          columns: ':visible'
            //     }
            // },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis',
        ]

    } );

    var pettycash_req_count = $(".pettycash_req").val();
    var payment_req_count = $(".payment_req").val();
    var employee_req_count = $(".employee_req").val();
    var po_req_count = $(".po_req").val();
    var client_deposit_count = $(".client_deposit_req").val();
    var salary_count = $(".salary_req").val();
    if(pettycash_req_count > 0){
        $(".pettycash_bell").html(pettycash_req_count);
    }
    if(payment_req_count > 0){
        $(".payment_bell").html(payment_req_count);
    }
    if(employee_req_count > 0){
        $(".employee_bell").html(employee_req_count);
    }
    if(po_req_count > 0){
        $(".po_payment_bell").html(po_req_count);
    }
    if(client_deposit_count > 0){
        $(".clientdeposit_bell").html(client_deposit_count);
    }
    if(salary_count > 0){
        $(".salary_bell").html(salary_count);
    }


} );

</script>
<script type="text/javascript">

    $(document).on("click",  "#account_changes_div", function(){
        var payment_id = $(this).data("payment_id");
        $.ajax({
            type    : "GET",
            url     : "<?php echo site_url('admin/bank_payments/get_account_changes/'); ?>"+payment_id,
            success : function(response){
                if(response != ''){
                    $("#accountchangesmodal").modal("show");
                    $("#accountchanges_div").html(response);
                }
            }
        })
    });

    function checkChangeAmount(){
        var request_amount = $("#request_amount").val();
        var approved_amount = $("#approved_amount").val();
        if (request_amount < approved_amount){
            alert("Amount is more than request amount, you really want to submit?");
        }
    }
</script>
<script type="text/javascript">
	$('.status').click(function(){
	var id = $(this).attr("value");  
		$.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/company_expense/get_status'); ?>",
			data    : {'id' : id},
			success : function(response){
				if(response != ''){
					$("#approval_html").html(response);
				}
			}
		})
	});
    $('.postatus').click(function () {
        var pay_id = $(this).attr("value");
        var section = $(this).data("section");

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/purchase/get_purchasePayment_approval_info'); ?>",
            data: {'pay_id': pay_id, 'section': section},
            success: function (response) {
                if (response != '') {
                    $("#poapproval_html").html(response);
                }
            }
        })
    });
</script>
</html>
