
<?php init_head(); ?>
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />
<style>
    fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; /*if(check_permission_page(6,'create')){ ?>  <a href="<?php echo admin_url('estimates/performerinvoice'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; "> Create New Proforma Invoice</a>  <?php }*/ ?></h4>
                        <hr class="hr-panel-heading">
                        <div>
                            <div >
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="source" class="control-label">Customer</label>
                                            <select class="form-control selectpicker" name="clientid" id="clientid" data-live-search="true">
                                                <option value=""></option>
                                                <?php
                                                if (isset($client_branch_data) && count($client_branch_data) > 0) {
                                                    foreach ($client_branch_data as $value) {
                                                        ?>
                                                        <option value="<?php echo $value->userid ?>" <?php if(!empty($clientid) && $clientid == $value->userid){ echo 'selected';} ?>><?php echo cc($value->client_branch_name); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="type" class="control-label">Proforma Type</label>
                                            <select class="form-control selectpicker" id="type" name="type" data-live-search="true">
                                                <option value="" disabled selected >--Select One-</option>
                                                <?php
                                                if(!empty($type_info)){
                                                    foreach ($type_info as $value) {
                                                        ?>
                                                        <option value="<?php echo $value->id; ?>" <?php if(!empty($type) && $type == $value->id){ echo 'selected';} ?>><?php echo cc($value->name); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="source" class="control-label">Order Status</label>
                                            <select class="form-control selectpicker"  name="order_status_id" id="order_status_id" data-live-search="true">
                                                <option value=""></option>
                                                <?php
                                                if (isset($order_status_list) && count($order_status_list) > 0) {
                                                    foreach ($order_status_list as $value) {
                                                        ?>
                                                        <option value="<?php echo $value->id; ?>" <?php echo (isset($order_status_id) && $order_status_id == $value->id) ? 'selected=""':''; ?>><?php echo cc($value->title); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" app-field-wrapper="date">
                                            <label for="f_date" class="control-label">From Date</label>
                                            <div class="input-group date">
                                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" app-field-wrapper="date">
                                            <label for="t_date" class="control-label">To Date</label>
                                            <div class="input-group date">
                                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <br>
                                        <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="check_order_withoutinvoice"  id="check_order_withoutinvoice" <?php echo (isset($check_order_withoutinvoice)) ? 'checked':''; ?>>
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Order Confirmed But Invoice not Raised
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                                        <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <?php
                                    if(is_admin() == 1){
                                ?>
<!--                            <div class="row">
                                    <div class="col-md-12 text-center totalAmount-row">
                                        <h4 style="color: red;">Total Amount : <?php echo number_format($estimate_amount, 2); ?></h4>
                                        <h4 style="color: red;">Total Count : <?php echo count($estimate_list); ?></h4>
                                    </div>
                                </div>-->
                                <br>
                                    <div class="row">
                                        <fieldset class="scheduler-border"><br>
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h4 style="color: red; text-align: center;" class="control-label">Total Amount</h4>
                                                        <p style="color: red; text-align: center;" class="ttlamount">0.00</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h4 style="color: red; text-align: center;" class="control-label">Total Count</h4>
                                                        <p style="color: red; text-align: center;" class="ttlcount">0.00</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                <?php
                                    }
                                ?>

                                <hr>
                                <div class="table-responsive" style="overflow: auto;">
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Proforma Invoice #</th>
                                        <th>Customer Name</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                        <th>Expiry Date</th>
                                        <th>Status</th>
                                        <th>Order Status</th>
                                        <th>Req. Transport Amount</th>
                                        <th>PO Uploads</th>
                                        <th>PO Verification</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    $ttlamount = $ttlcount = 0;
                                    if(!empty($estimate_list)){
                                        foreach ($estimate_list as $key => $value) {
                                            $show_row = 1;
                                            if (isset($check_order_withoutinvoice)){
                                                $check = check_already_converted($value->id,'estimate');
                                                $show_row = 0;
                                                if ($check == 0 && $value->order_confirm == 1){
                                                    $show_row = 1;
                                                }
                                            }
                                            
                                            if ($show_row == 1){
                                                $ttlamount += $value->total;
                                                $ttlcount += 1;
                                            $client_info = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$value->clientid."' ")->row();
                                            $confirmorderinfo = $this->db->query("SELECT `order_status_id`,`branch_id` FROM `tblconfirmorder` where estimate_id = '".$value->id."' ")->row();
                                            $termscondition = get_payment_termsconditions($value->id, 'estimate');
                                            echo '<div style="display:none;" class="paymentterms_data'.$value->id.'">'.$termscondition.'</div>';

                                            $trans_charges_info = $this->db->query("SELECT * FROM  tbltransportchargesrequest WHERE `ref_id`='".$value->id."' AND `ref_type`='estimates'")->row();
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td>
                                                <?php echo '<a target="_blank" href="' . admin_url('estimates/list_estimates/' . $value->id) . '" onclick="init_estimate(' . $value->id . '); ">' . format_estimate_number($value->id) . '</a>'; ?>
                                                <?php echo get_creator_info($value->addedfrom, $value->datecreated); ?>
                                            </td>
                                            <td><?php if(!empty($client_info)){ echo '<a target="_blank" href="' . admin_url('clients/client/' . $value->clientid) . '">' . cc($client_info->client_branch_name) . '</a>'; }else{ echo '--'; } ?></td>
                                            <td><?php echo $value->total; ?></td>
                                            <td><?php echo _d($value->date); ?></td>
                                            <td><?php echo _d($value->expirydate); ?></td>
                                            <td>
                                                <?php
                                                    if ($value->status == 7){
                                                        echo '<span class="label label-danger estimate-status s-status estimate-status-danger" data-id="'.$value->id.'">Cancel</span>';
                                                    }else{
                                                        echo format_estimate_status($value->status);
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn-with-tooltip orderconfirm" data-order_status="<?php echo $value->order_confirm; ?>" data-id="<?php echo $value->id; ?>" data-branch_id="<?php echo (!empty($confirmorderinfo) && !empty($confirmorderinfo->branch_id)) ? $confirmorderinfo->branch_id : 0; ?>" data-expected_date="<?php echo ($value->expected_date_of_delivery != "0000-00-00") ? $value->expected_date_of_delivery : ""; ?>" data-target="#delivery_order_confirm" id="order_confirm" data-toggle="modal">
                                                    <?php
                                                        if ($value->status == 7){
                                                            echo "<span class='text-danger'>Order Canceled</span>";

                                                        }elseif($value->order_confirm == 0){
                                                            echo "About to Confirm";
                                                        }else{
                                                            echo "<span class='text-success'>Order Confired</span>";
                                                        }
                                                    ?>
                                                </a><br><br>
                                                <?php
                                                    if (!empty($confirmorderinfo) && $confirmorderinfo->order_status_id > 0){
                                                        echo "<span class='label label-info'>".cc(value_by_id("tblconfirmorderstatus", $confirmorderinfo->order_status_id, "title"))."</span>";
                                                    }
                                                ?>

                                                <input type="hidden" class="cancelremark<?php echo $value->id; ?>" value="<?php echo $value->cancel_remark; ?>">
                                            </td>
                                            <td>
                                                <?php 
                                                    $sendrequest = '<a href="javascript:void(0);" class="btn-sm btn-info charges-request" data-id="'.$value->id.'" data-request_id="0" data-type="SR">Send Request</a>';
                                                    if (!empty($trans_charges_info)){
                                                        $sendrequest = '<a href="javascript:void(0);" class="btn-sm btn-warning charges-request" data-id="'.$value->id.'" data-request_id="'.$trans_charges_info->id.'" data-type="RS">Request Sent</a>';
                                                        if ($trans_charges_info->status == 1){
                                                            $sendrequest = '<a href="javascript:void(0);" class="btn-sm btn-success" data-target="#transchargesinfo'.$value->id.'" data-toggle="modal" data-content="'.$trans_charges_info->manager_remark.'">'.$trans_charges_info->transport_charges.'</a>';
                                        ?>
                                                            <div id="transchargesinfo<?php echo $value->id; ?>" class="modal fade" role="dialog">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title" style="color:#ffffff;"> Manager Action Details </h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <h4 class="control-label" style="color:red;"><u>Manager</u></h4>
                                                                                        <p ><?php echo get_employee_fullname($trans_charges_info->challan_manage_id); ?></p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <h4 class="control-label" style="color:red;"><u>Manager Remark</u></h4>
                                                                                        <p><?php echo cc($trans_charges_info->manager_remark); ?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        </div>    
                                                                    </div>
                                                                </div>                            
                                                            </div>  
                                            <?php                                           
                                                        }
                                                    }
                                                    echo $sendrequest;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $pouploads = $this->db->query("SELECT * FROM `tblfiles` WHERE `rel_id`= '".$value->id."' AND `rel_type` = 'estimate_po' ")->row();
                                                ?>
                                                <button type="button" title="PO Upload" class="btn-sm <?php echo (!empty($pouploads)) ? 'btn-success':'btn-info'; ?> tableBtn uplaods" value="<?php echo $value->id; ?>" data-toggle="modal" data-target="#upload_modal"><i class="fa <?php echo (!empty($pouploads)) ? 'fa-eye':'fa-upload'; ?>" aria-hidden="true"></i> Upload</button>
                                            </td>
                                            <td>
                                                <?php
                                                    $po_verification_status = 'Verify';
                                                    $verification_status_btn = 'btn-warning';
                                                    if ($value->final_check_status == 1){
                                                        $po_verification_status = 'Verified';
                                                        $verification_status_btn = 'btn-success';
                                                    }else if ($value->final_check_status == 2){
                                                        $po_verification_status = 'Reconciliation';
                                                        $verification_status_btn = 'btn-danger';
                                                    }
                                                ?>
                                                <a href="<?php echo admin_url('estimates/po_verification/'.$value->id); ?>" target="_blank" class="btn-sm <?php echo $verification_status_btn; ?>"><?php echo $po_verification_status; ?></a>
                                            </td>
                                            <td class="text-center">
                                                
                                                <div class="btn-group pull-right">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                        <li>
                                                            <a href="<?php echo admin_url('estimates/download_pdf/'.$value->id); ?>" target="_blank" title="PDF">View PDF</a>

                                                           <?php
                                                            
                                                            if ($value->status != 7){
                                                                if(check_permission_page(6,'edit')){ ?>
                                                                <a href="<?php echo admin_url('estimates/performerinvoice/' . $value->id); ?>" title="Edit" >Edit</a>
                                                            <?php } ?>
                                                            <a href="javascript:void(0);" class="btn-with-tooltip send-email" data-id="<?php echo $value->id; ?>" data-cid="<?php echo $value->clientid; ?>"  data-target="#lead_send_to_customer" id="send_mail" data-toggle="modal">
                                                                Send Mail
                                                            </a>
                                                            <a href="javascript:void(0);" class=" btn-with-tooltip estimate-cancel" data-id="<?php echo $value->id; ?>" data-target="#estimate_cancel" id="cancel_estimate" data-toggle="modal">
                                                                Cancel
                                                            </a>
                                                            <?php } ?>
                                                        </li>
                                                        <li><a target="_blank" href="<?php echo admin_url('follow_up/estimates_activity/'. $value->id); ?>"  >Activity</a></li>
                                                        <li><a target="_blank" href="<?php echo admin_url('estimates/proformachalan_list/'. $value->id); ?>"  >Proforma Challan</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                          </tr>
                                        <?php
                                            }
                                        }
                                    }
                                    ?>

                                    </tbody>
                                  </table>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>

            <?php echo form_close(); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>
<div id="upload_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title upload_title">Purchase Order Uploads</h4>
            </div>
            <div class="modal-body">
                <div id="upload_data">

                </div>
                <?php
                    $attributes = array('id' => 'sub_form_product', 'method'=> 'post');
                    echo form_open_multipart(admin_url("estimates/estimate_po_upload"), $attributes);
                ?>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="file" class="control-label"><?php echo 'Upload File'; ?></label>
                            <input type="file" class="form-control" id="file" multiple="" name="file[]" style="width: 100%;">
                        </div>
                        <input type="hidden" name="estimate_id" class="estimate_id" value="">
                    </div>
                    <div class="text-right">
                        <button class="btn btn-info" type="submit">Submit</button>
                    </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<div id="lead_send_to_customer" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <?php
        $attributes = array('id' => 'sub_form_product');
        echo form_open_multipart(admin_url("estimates/estimate_send_to_mail"), $attributes);
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Send Proforma invoice to client </h4>
      </div>
      <div class="modal-body">
          <input type="hidden" name="estimate_id" class="estimate_id" value="">
          <div class="row">
              <?php $staff_data = get_employee_info(get_staff_user_id()); ?>
              <?php echo render_input('from_email', 'From Email', $staff_data->email, 'email', array(), [], 'form-group col-md-6'); ?>
              <?php echo render_input('from_name', 'From Name', $staff_data->firstname . ' ' . $staff_data->lastname, 'text', array(), [], 'form-group col-md-6'); ?>
          </div>
          <div class="row">
              <div class="client_list col-md-6">
                  <label for="module_id" class="control-label">Email To</label>
                  <select class="form-control selectpicker" required="" multiple="1" data-live-search="true" id="send_to" name="send_to">
                      <option value=""></option>
                  </select>
              </div>
              <?php echo render_input('email_to', 'Send To', '', 'text', [], [], 'form-group col-md-6'); ?>
          </div>
          <div class="row">
              <div class="col-md-6">
                  <label for="module_id" class="control-label">Staff CC</label>
                  <?php
                  $staff_list = $this->db->query("SELECT email, firstname FROM tblstaff WHERE active = 1")->result_array();
                  echo render_select('staff_cc[]', $staff_list, array('email', 'email', 'firstname'), '', array(), array('multiple' => true), array(), '', '', false);
                  ?>
              </div>
              <?php echo render_input('cc', 'CC', '', 'text', [], [], 'form-group col-md-6'); ?>

          </div>
        <?php
            $template_list = $this->db->query("SELECT id, template_name FROM tblemailmoduletemplate WHERE module_id = 3 AND status = 1")->result();
        ?>
        <div class="form-group module_template" app-field-wrapper="name">
            <label for="module_id" class="control-label">Select Template</label>
            <select class="form-control selectpicker" required="" data-live-search="true" id="module_template_id" name="module_template_id">
                <option value=""></option>
            </select>
        </div>
        <h5 class="bold"><?php echo _l('proposal_preview_template'); ?></h5>
        <hr />
        <?php

            $editors = array();
            array_push($editors,'message');
        ?>
        <!--<div class="form-group" app-field-wrapper="message"><textarea  required="" name="message[]" class="form-control tinymce tinymce-manual template-message" data-url-converter-callback="myCustomURLConverter" rows="4" ></textarea></div>-->
        <?php echo render_textarea('message','', '',array('rows' => 4, 'class' => 'tinymce tinymce-manual'),array(),'','tinymce tinymce-manual'); ?>
        <?php echo form_hidden('template_name',"proforma_invoice"); ?>
        <div class="module_attech"></div>
        <div class="form-group">
            <label for="drawing" class="control-label">File</label>
            <input type="file" id="filer_input2" class="form-control"  name="attach_files[]" multiple="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
        <button type="submit" autocomplete="off" class="btn btn-info">Send</button>
<!--        <button type="submit" autocomplete="off" data-loading-text="Please wait..." class="btn btn-info">Send</button>-->
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>

<div id="delivery_order_confirm" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <?php
        $attributes = array('id' => 'sub_form_order');
        echo form_open_multipart(admin_url("estimates/order_confirm"), $attributes);
        ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Confirm Order </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="estimate_id" class="est_id" value="">
                <div class="row">
                    <div class="paymentterms_div"></div>
                    <div class="col-md-12 order-checkboxdiv">
                        <div class="form-group" app-field-wrapper="date">
                            <label for="f_date" class="control-label">Is PO Match :</label>
                            <input type="checkbox" id="orderconfirmchkbox" onclick="showconfirmationdiv();">
                        </div>    
                    </div>
                    <div class="confirmorderdiv" style="display: none;">
                        <div class="col-md-6">
                            <div class="form-group" app-field-wrapper="date">
                                <label for="f_date" class="control-label">Expected Date of Delivery</label>
                                <div class="input-group date">
                                    <input id="expected_date_of_delivery" required="" name="date_of_delivery" class="form-control datepicker" value="" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" app-field-wrapper="date">
                                <label for="f_date" class="control-label">Branch</label>
                                <?php
                                    $branch_list  = $this->db->query("SELECT `comp_branch_name`,`id` from `tblcompanybranch` WHERE `status`= '1' ")->result();
                                ?>
                                <select class="form-control selectpicker" required="" name="branch_id" id="branch_id">
                                    <option value=""></option>
                                    <?php
                                        if (!empty($branch_list)){
                                            foreach ($branch_list as $value) {
                                            echo '<option value="'.$value->id.'">'.$value->comp_branch_name.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr>     
                        <!-- <div class="col-md-12"><strong>Special Remarks </strong></div> -->
                        <div class="orderlist"></div>
                        <div class="col-md-12">
                        <div class="reviseddata_div"></div>
                        </div>
    <!--                    <div class="form-group col-md-12"><a href="javascript:void(0);" class="add_field_button btn-sm btn-info pull-right" value="0"><i class="fa fa-plus-circle"></i> Add More Fields</a></div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="input_fields_wrap">
                                    <div class="row0">
                                        <div class="col-md-10 form-group"><input type="text" name="orderprocessname[]" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                        </div>-->      
                    </div>
                    
                    
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="orderconfirmtype" class="orderconfirmtype" value="1">
                <button type="submit" autocomplete="off" class="btn btn-info confirm-btn">Confirm</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="estimate_cancel" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <?php
        $attributes = array('id' => 'sub_form_order');
        echo form_open_multipart(admin_url("estimates/estimate_cancel"), $attributes);
        ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Proforma Invoice Cancel </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="estimate_id" class="estimateid" value="">
                <div class="row">
                    <hr>
                    <div class="col-md-12"><strong> Cancel Remarks </strong></div>
                    <div class="col-md-12">
                        <textarea class="form-control estimatecancelremark" rows="5" name="remark"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" autocomplete="off" class="btn btn-info cancelremarkbtn">Save</button>
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="charges_request_modal" class="modal fade" role="dialog">
    <div class="modal-dialog charges_req_html">

    </div>                            
</div> 
<?php init_tail(); ?>
<script src="<?php  echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
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

<script type="text/javascript">
    $(document).on('click', '.uplaods', function () {

        var id = $(this).val();
        $('.estimate_id').val(id);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/estimates/get_estimate_po_files'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $('#upload_data').html(response);
                }else{
                    $('#upload_data').html('');
                }
            }
        })

    });
</script>
<script>

$(document).ready(function() {

    $(".ttlamount").html('<?php echo number_format($ttlamount, 2); ?>');
    $(".ttlcount").html('<?php echo number_format($ttlcount, 2); ?>');

    $('#newtable').DataTable( {

        "iDisplayLength": 15,
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            'colvis',
        ]
    } );
} );
</script>


</body>
</html>
<script>
   $(function(){
     <?php foreach($editors as $id){ ?>
       init_editor('textarea[name="<?php echo $id; ?>"]',{urlconverter_callback:'merge_field_format_url'});
       <?php } ?>
       var merge_fields_col = $('.merge_fields_col');
         // If not fields available
         $.each(merge_fields_col, function() {
           var total_available_fields = $(this).find('p');
           if (total_available_fields.length == 0) {
             $(this).remove();
           }
         });
       // Add merge field to tinymce
       $('.send-email').on('click', function(e) {
      e.preventDefault();
        var estimate_id = $(this).data("id");
        var cid = $(this).data("cid");
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url(); ?>admin/estimates/get_client_list",
            data    : {'cid' : cid},
            success : function(response){
                $(".client_list").html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        });
        $(".estimate_id").val(estimate_id);
        $("#cc").val("");
        $(".module_template").html('<label for="module_id" class="control-label">Select Template</label><select class="form-control selectpicker" required="" data-live-search="true" id="module_template_id" name="module_template_id"><option value=""></option><?php if (isset($template_list) && count($template_list) > 0) {foreach ($template_list as $template) {?><option value="<?php echo $template->id; ?>"><?php echo cc($template->template_name); ?></option><?php } }?></select>');
        $('.selectpicker').selectpicker('refresh');
        tinymce.activeEditor.execCommand('mceSetContent', false, "");
//        $('.selectpicker option:selected').remove();
    });
   });
</script>
<script type="text/javascript">
$(document).on('change', '#module_template_id', function() {
    tinymce.activeEditor.execCommand('mceSetContent', false, "");
    $(".module_attech").html();
    var tid = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/leads/get_email_template",
        data    : {'t_id' : tid},
        success : function(response){
            if(response != ''){
                tinymce.activeEditor.execCommand('mceSetContent', false, response);
//                $('.selectpicker').selectpicker('refresh');
            }
        }
    })

    $.get("<?php echo base_url(); ?>admin/leads/get_templete_attechment/"+tid, function(res){
        if (res != ""){
            $(".module_attech").html(res);
        }
    })
});
</script>
<script type="text/javascript">
    function change_source(value,id)
    {
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/estimates/change_source'); ?>",
            data    : {'source' : value,'id' : id},
            success : function(response){
                if(response != ''){
                    location.reload(true);
                }
            }
        })
    }
</script>


<script type="text/javascript">
  $(document).ready(function(){
'use-strict';

    //Example 2
    $('#filer_input2').filer({
//        limit: 5,
        maxSize: 20,
//        extensions: ['jpg', 'jpeg', 'png' ],
        changeInput: true,
        showThumbs: true,
        addMore: true
    });


  });

  function removeattch(index){
      if (confirm("Are you sure you want to remove this file?")){
          $(".box"+index).remove();
      }

  }

  $(document).on("click", ".close-model", function(){
      location.reload();
  });
</script>
<script type="text/javascript">
  $(document).on("click", ".orderconfirm", function(){
        var id = $(this).data("id");
        $(".est_id").val(id);

        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/estimates/getOrderProcess'); ?>",
            data    : {'estimate_id' : id},
            success : function(response){
                if(response != ''){
                    $(".orderlist").html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        });

        var expected_date = $(this).data("expected_date");
        $(".order-checkboxdiv").show();
        $(".confirmorderdiv").hide();
        $(".confirm-btn").hide();
        if (expected_date != ''){
            $(".order-checkboxdiv").hide();
            $(".confirmorderdiv").show();
            $(".confirm-btn").show();
        }
        var branch_id = $(this).data("branch_id");
        $("#expected_date_of_delivery").val(expected_date);
        $("#branch_id option[value='"+branch_id+"']").attr("selected", "selected");
        // $("#branch_id").value(branch_id);
        var order_status = $(this).data("order_status");
        
        $(".confirm-btn").html("Confirm");
        $(".add_field_button").show();
        $(".orderconfirmtype").val('1');
        if (order_status == 1){
            // $(".confirm-btn").hide();
            $(".orderconfirmtype").val('2');
            $(".confirm-btn").html("Update");
            $(".add_field_button").hide();
        }
        var termscondition = $(".paymentterms_data"+id).html();
        if (termscondition != ""){
            $(".paymentterms_div").html('<div class="col-md-12 form-group"><h4 style="color:orange;">'+termscondition+'</div>');
        }
  });
  $(document).on("click", ".estimate-cancel", function(){
        var id = $(this).data("id");
        $(".estimateid").val(id);
        var remark = $(".cancelremark"+id).val();
        $(".estimatecancelremark").val(remark);
        $(".cancelremarkbtn").show();

  });
  $(document).on("click", ".estimate-status", function(){
      var id = $(this).data("id");
      $('#estimate_cancel').modal('show');
//        $(".estimateid").val(id);
        var remark = $(".cancelremark"+id).val();
        $(".estimatecancelremark").val(remark);
        $(".cancelremarkbtn").hide();
  });

    $(document).on("click", ".add_field_button",function(){
        var addmoreproenq = parseInt($(this).attr('value'));
        var newaddmoreproenq = addmoreproenq + 1;
        $(this).attr('value', newaddmoreproenq);

//        $(".input_fields_wrap").append('<div class="row'+newaddmoreproenq+'"><div class="col-md-10 form-group"><input type="text" name="orderprocessname[]" class="form-control"></div><div class="col-md-2"><a class="btn btn-danger" href="#" onclick="removetitle('+newaddmoreproenq+');"><i class="fa fa-remove"></i></a></div></div>');
        $(".input_fields_wrap").append('<tr class="row'+newaddmoreproenq+'"><td width="5%"><a class="btn btn-danger" href="#" onclick="removetitle('+newaddmoreproenq+');"><i class="fa fa-remove"></i></a></td><td><input type="hidden" name="orderprocesspro['+newaddmoreproenq+'][type]" value="1" class="form-control"><input type="text" name="orderprocesspro['+newaddmoreproenq+'][name]" class="form-control"></td></tr>');
        $('.selectpicker').selectpicker('refresh');
    });
    $(document).on("click", ".add_field_button2",function(){
        var addmoreproenq = parseInt($(this).attr('value'));
        var newaddmoreproenq = addmoreproenq + 1;
        $(this).attr('value', newaddmoreproenq);

//        $(".input_fields_wrap").append('<div class="row'+newaddmoreproenq+'"><div class="col-md-10 form-group"><input type="text" name="orderprocessname[]" class="form-control"></div><div class="col-md-2"><a class="btn btn-danger" href="#" onclick="removetitle('+newaddmoreproenq+');"><i class="fa fa-remove"></i></a></div></div>');
        $(".input_fields_wrap2").append('<tr class="rowdelivery'+newaddmoreproenq+'"><td width="5%"><a class="btn btn-danger" href="#" onclick="removedeliverytitle('+newaddmoreproenq+');"><i class="fa fa-remove"></i></a></td><td><input type="hidden" name="orderprocessdelivery['+newaddmoreproenq+'][type]" value="2" class="form-control"><input type="text" name="orderprocessdelivery['+newaddmoreproenq+'][name]" class="form-control"></td></tr>');
        $('.selectpicker').selectpicker('refresh');
    });
    function removetitle(proid)
    {
        $('.row' + proid).remove();
    }
    function removedeliverytitle(proid)
    {
        $('.rowdelivery' + proid).remove();
    }
    function get_revised_processlist(id){
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/estimates/get_revised_processlist'); ?>",
            data    : {'id' : id},
            success : function(response){
                if(response != ''){
                    $(".reviseddata_div").html(response);
                }else{
                   $(".reviseddata_div").html("");
                }
            }
        });
    }
    $(document).on("click", ".close-revised", function(){
       $(".reviseddata_div").html("");
    });

    $(document).on("click", ".charges-request", function(){
        var rel_id = $(this).data("id");
        var request_id = $(this).data("request_id");
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url(); ?>admin/proposals/getTransportChargesRequest",
            data    : {'rel_id' : rel_id, 'rel_type' : "estimates", 'request_id': request_id},
            success : function(response){
                if(response != ''){
                    $("#charges_request_modal").modal("show");
                    $(".charges_req_html").html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        });
    });
    function showconfirmationdiv(){
        $(".confirmorderdiv").hide();
        $(".confirm-btn").hide();
        if ($('#orderconfirmchkbox').is(":checked")){
            $(".confirmorderdiv").show();
            $(".confirm-btn").show();
        }
        // confirmorderdiv
    }
</script>
