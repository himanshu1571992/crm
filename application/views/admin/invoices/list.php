
<?php init_head();


$client = '';
$date_a = '';
$date_b = '';
$staff = '';
$stat = '';

if(!empty($client_id)){
  $client = $client_id;
}
if(!empty($f_date)){
  $date_a = $f_date;
}
if(!empty($t_date)){
  $date_b = $t_date;
}
if(!empty($staff_id)){
  $staff = $staff_id;
}
if(!empty($status)){
  $stat = $status;
}
?>
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />
<?php
if(!empty($this->session->userdata('invoice_search'))){
    $search_arr = $this->session->userdata('invoice_search');
}
?>
<style>
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

.dropdown-menu {
    min-width: 191px;            
}  
</style>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4>Sale Invoice List </h4>
                        </div>
                        <div class="col-xs-12 col-md-6 text-right">
                            <a href="<?php echo admin_url('invoices/export/?service_type=2&f_date='.$date_a.'&t_date='.$date_b.'&staff_id='.$staff.'&client_id='.$client.'&status='.$stat); ?>" class="btn btn-info">Export</a> <?php if(check_permission_page('17,18','create')){ ?>
                            <a href="<?php echo admin_url('invoices/invoices'); ?>" class="btn btn-info">Create new Invoice</a> <?php } ?>
                        </div>
                    </div>

                    <hr class="hr-panel-heading">

                    <div class="row">

                    <div>
                        <div class="col-md-2" id="employee_div">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Client</label>
                                <select class="form-control selectpicker" id="client_id" name="client_id" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($client_data)){
                                        foreach ($client_data as $row) {
                                            ?>
                                            <option value="<?php echo $row->userid; ?>" <?php if(!empty($client_id) && $client_id == $row->userid){ echo 'selected';} ?>><?php echo cc($row->client_branch_name); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="staff_id" class="control-label">Employee Name</label>
                            <select class="form-control selectpicker" id="staff_id" name="staff_id" data-live-search="true">
                                <option value="" disabled selected >--Select One-</option>
                                <?php
                                if(!empty($staff_list)){
                                    foreach($staff_list as $staff){
                                        ?>
                                        <option value="<?php echo $staff->staffid;?>" <?php if(!empty($staff_id) && $staff_id == $staff->staffid){ echo 'selected';} ?>><?php echo cc($staff->firstname); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-2" id="employee_div">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Invoice Status</label>
                                <select class="form-control selectpicker" id="status" name="status" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <option value="1" <?php if(!empty($status) && $status == 1){ echo 'selected';} ?>>Unpaid</option>
                                    <option value="2" <?php if(!empty($status) && $status == 2){ echo 'selected';} ?>>Paid</option>
                                    <option value="3" <?php if(!empty($status) && $status == 3){ echo 'selected';} ?>>Partially Paid</option>
                                    <option value="4" <?php if(!empty($status) && $status == 4){ echo 'selected';} ?>>Overdue</option>
                                    <option value="5" <?php if(!empty($status) && $status == 5){ echo 'selected';} ?>>Cancelled</option>

                                </select>
                            </div>
                        </div>


                        <div class="form-group col-md-2" app-field-wrapper="date">
                            <label for="f_date" class="control-label">From Date</label>
                            <div class="input-group date">
                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="form-group col-md-2" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>



                        <div class="col-md-1">
                        <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                        </div>

                    </div>

                            <div class="col-md-12">
                                <?php
                                //if(is_admin() == 1){
                                ?>
                                <div class="row1">
                                    <fieldset class="scheduler-border"><br>
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h4 style="color: red; text-align: center;" class="control-label">Total Taxable Value</h4>
                                                    <p style="color: red; text-align: center;"><?php echo number_format(($invoice_amount-$taxable_value), 2); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h4 style="color: red; text-align: center;" class="control-label">Total SGST</h4>
                                                    <p id="sgst_tot" style="color: red; text-align: center;"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h4 style="color: red; text-align: center;" class="control-label">Total CGST</h4>
                                                    <p id="cgst_tot" style="color: red; text-align: center;"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h4 style="color: red; text-align: center;" class="control-label">Total IGST</h4>
                                                    <p id="igst_tot" style="color: red; text-align: center;"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h4 style="color: red; text-align: center;" class="control-label">Total Amount</h4>
                                                    <p style="color: red; text-align: center;"><?php echo number_format($invoice_amount, 2); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h4 style="color: red; text-align: center;" class="control-label">Total Count</h4>
                                                    <p style="color: red; text-align: center;"><?php echo count($invoice_list); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
<!--                                <div class="row">
                                    <div class="col-md-12 text-center totalAmount-row">
                                        <h4 style="color: red;">Total Taxable Value : <?php echo number_format(($invoice_amount-$taxable_value), 2); ?></h4>
                                        <h4 id="sgst_tot" style="color: red;"></h4>
                                        <h4 id="cgst_tot" style="color: red;"></h4>
                                        <h4 id="igst_tot" style="color: red;"></h4>
                                        <h4 style="color: red;">Total Amount : <?php echo number_format($invoice_amount, 2); ?></h4>
                                        <h4 style="color: red;">Total Count : <?php echo count($invoice_list); ?></h4>
                                    </div>
                                </div> -->
                                <?php
                               // }
                                ?>

                                <hr>
                                <div class="table-responsive">
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Invoice #</th>
                                        <th>Sales Person</th>
                                        <th>Amount</th>
                                        <th>Invoice Date</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Send Email</th>
                                        <th>Send Courier</th>
                                        <th>E-Invoice Status</th>
                                        <th>Eway-Bill Status</th>
                                        <th>Accounted Status</th>
                                        <th>TCS Status</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sum= 0.00;
                                        $cgst_sum= 0.00;
                                        $igst_sum= 0.00;
                                        if(!empty($invoice_list)){

                                            foreach ($invoice_list as $key => $value) {

                                                if($value->status != '5'){
                                                    if($value->tax_type == 1){
                                                        $tax = ($value->total_tax/2);
                                                        $sgst = number_format(round($tax), 2, '.', '');
                                                        $sum += $sgst;
                                                        $cgst = number_format(round($tax), 2, '.', '');
                                                        $cgst_sum += $cgst;
                                                    }else{
                                                        $igst = $value->total_tax;
                                                        $igst_sum += $igst;
                                                    }
                                                }

                                                 $client_info = $this->db->query("SELECT `client_branch_name`,`legal_name`,`trade_name` from `tblclientbranch` where userid = '".$value->clientid."'  ")->row();

                                                    $item_info = $this->db->query("SELECT is_sale FROM `tblitems_in` where  `rel_type` = 'invoice' and `rel_id` = '".$value->id."' ")->row();

                                                    $type = '';
                                                    if(!empty($item_info)){
                                                        if($item_info->is_sale == 0){
                                                            $type = '?type=rent';
                                                        }elseif($item_info->is_sale == 1){
                                                            $type = '?type=sale';
                                                        }
                                                    }
                                                    $courier_info = $this->db->query("SELECT * FROM `tblcouriersend` WHERE `rel_type` = 'invoice' and `rel_id` = '".$value->id."' ")->row();

                                                    $sales_person = $this->db->query("SELECT `staff_id` FROM tblleadassignstaff WHERE type = 2 and lead_id = '".$value->lead_id."' ")->row();
                                                ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>
                                                    <!-- <td><?php echo '<a href="' . site_url('invoice/' . $value->id . '/' . $value->hash) . $type .'" target="_blank">' .format_invoice_number($value->id). '</a>'; ?></td> -->
                                                    <td >
                                                        <a target="_blank" href="<?php echo admin_url('invoices/download_pdf/'.$value->id.'/?output_type=I');?>" data-status="1"><?php echo format_invoice_number($value->id); ?></a>
                                                        <?php echo get_creator_info($value->addedfrom, $value->datecreated); ?>
                                                    </td>
                                                    <td><?php echo (!empty($sales_person) && $sales_person->staff_id > 0) ? get_employee_name($sales_person->staff_id) : '--'; ?></td>
                                                    <td><?php echo $value->total; ?></td>
                                                    <td><?php echo _d($value->invoice_date); ?></td>
                                                    <td><a href="<?php echo admin_url('clients/client/'.$value->clientid);?>" target="_blank"><?php echo cc($client_info->client_branch_name); ?></a></td>
                                                    <td><?php echo format_invoice_status($value->status); ?></td>
                                                    <td>
                                                        <a href="javascript:void(0);" data-target="#send-email-date" data-rel_id="<?php echo $value->id; ?>" data-emaildate="<?php echo (!empty($value->email_send_date)) ? _d($value->email_send_date):''; ?>" data-toggle="modal" class="label label-info sendemail-date"><?php echo (!empty($value->email_send_date)) ? _d($value->email_send_date):'SET DATE'; ?></a>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" class="courier_name<?php echo $value->id; ?>" value="<?php echo (!empty($courier_info)) ? $courier_info->courier_name : ''; ?>">
                                                        <input type="hidden" class="tracking_number<?php echo $value->id; ?>" value="<?php echo (!empty($courier_info)) ? $courier_info->tracking_number : ''; ?>">
                                                        <input type="hidden" class="courier_date<?php echo $value->id; ?>" value="<?php echo (!empty($courier_info) && !empty($courier_info->date)) ? _d($courier_info->date) : ''; ?>">
                                                        <div style="display:none;" class="courier_files<?php echo $value->id; ?>">
                                                            <?php
                                                                if(!empty($courier_info) && !empty($courier_info->files)){
                                                                    $files = json_decode($courier_info->files);
                                                                    if (!empty($files)){
                                                                        foreach ($files as $key => $file) {
                                                            ?>
                                                                           <a target="_blank" href="<?php echo site_url('uploads/courier_files/'.$file); ?>"><?php echo $file; ?></a>
                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </div>
                                                        <a href="javascript:void(0);" data-target="#courierinfo" onclick="getcourierinfo('<?php echo $value->id; ?>');" data-toggle="modal" class="label label-success courier_model"><?php echo (!empty($courier_info)) ? 'VIEW':'SET'; ?></a>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if (isset($value->einvoice_pdf) && !empty($value->einvoice_pdf)){
                                                                echo '<a href="'.$value->einvoice_pdf.'" class="label label-success" style="font-size: 12px;">CREATED</a>';
                                                            }else{
                                                                echo '<span class="label label-warning">PENDING</span>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if (!empty($value->ewayBiIl_id)){                                                                
                                                                $eway_info = $this->db->query("SELECT ewaybill_pdf FROM `tblwaybill` where  `status` = '1' and `invoice_id` = '".$value->id."' ")->row();
                                                                if (!empty($eway_info)){
                                                                    echo '<a href="'.$eway_info->ewaybill_pdf.'" class="label label-success" style="font-size: 12px;">CREATED</a>';
                                                                }else{
                                                                    echo '<span class="label label-warning">PENDING</span>';
                                                                }
                                                            }else{
                                                                echo '<span class="label label-warning">PENDING</span>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $accounted_status = 0;
                                                            $accounted_text = '<span class="btn-sm btn-warning">Pending</span>';
                                                            if ($value->accounted_status > 0){
                                                                $accounted_status = 1;
                                                                $accounted_text = '<span class="btn-sm btn-success">Accounted</span>';
                                                            }
                                                        ?>
                                                        <!-- <a href="<?php echo admin_url('invoices/update_accounted_status/'.$value->id.'/sales'); ?>" onclick="return confirm('Are you sure you want to change this?');"><?php echo $accounted_text; ?></a> -->
                                                        <a href="javascript:void(0);" class="accounted_sts<?php echo $value->id; ?>" onclick="update_accounted_status(<?php echo $value->id; ?>);"><?php echo $accounted_text; ?></a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $tcsstatus_text = '<a href="'.admin_url('invoices/calculate_tcs_charges/'.$value->id.'/'.$value->clientid).'" class="_delete"><span class="label label-warning">Pending</span></a>';
                                                            if ($value->tcs_status > 0){
                                                                $tcsstatus_text = '<span class="label label-success">Charges Taken</span>';
                                                            }
                                                            echo $tcsstatus_text;
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group pull-right">
                                                             <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                             </button>
                                                             <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                <li>
                                                                    <a href="<?php echo site_url('invoice/'.$value->id.'/'.$value->hash).$type ; ?>" target="_blank">View</a>
                                                                    <?php if(check_permission_page(17,'edit') && $value->status != '5'){ ?>
                                                                    <a href="<?php echo admin_url('invoices/invoices/' . $value->id); ?>" >Edit</a>
                                                                    <?php } ?>
                                                                   <a target="_blank" href="<?php echo admin_url('invoices/download_pdf/'.$value->id.'/?output_type=I');?>" data-status="1">View PDF</a>

                                                                <?php
                                                                    /*if($type == '?type=rent' && $value->status != '5'){
                                                                            ?>
                                                                            <a target="_blank" href="<?php echo admin_url('invoices/renew_invoice/'.$value->id);?>" data-status="1">RENEWAL</a>
                                                                    <?php
                                                                    }*/
                                                                    
                                                                                                                                    ?>
                                                                    <a href="javascript:void(0);" class="btn-with-tooltip send-email" data-id="<?php echo $value->id; ?>" data-cid="<?php echo $value->clientid; ?>"  data-target="#send_mainto_customer" id="send_mail" data-toggle="modal">
                                                                        Send Mail
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="btn-with-tooltip connect_to_lead" data-id="<?php echo $value->id; ?>" data-lead_id="<?php echo $value->lead_id; ?>"  data-target="#connect_lead" id="lead_connect" data-toggle="modal">
                                                                        <?php echo ($value->lead_id > 0) ? 'Lead Connected' : 'Connect To Lead'; ?>
                                                                    </a>
                                                                    <a href="<?php echo admin_url('invoices/load_certificate_list/'.$value->id); ?>" class="btn-with-tooltip" title="Load Test Certificate">LTC</a>

                                                                    <?php 
                                                                    if($value->status != '5'){
                                                                        ?>
                                                                        <a class="text-danger _delete" style="color:red;" target="_blank" href="<?php echo admin_url('invoices/mark_as_cancelled/'.$value->id);?>" data-status="1">CANCEL</a>
                                                                    <?php
                                                                    }
                                                                        if (empty($value->einvoice_irn) && empty($value->einvoice_ack_date) && empty($value->einvoice_ack_number)){
                                                                            if (!empty($client_info->legal_name) && !empty($client_info->trade_name)){
                                                                                if ($value->tcs_status > 0){
                                                                                    echo '<a href="javascript:void(0);" onclick="generateEinvoice('.$value->id.');" class="btn-with-tooltip" style="font-size: 12px;">GENERATE E-INVOICE</a>';
                                                                                }    
                                                                            }else{
                                                                                if ($value->tcs_status > 0){
                                                                                    echo '<a href="javascript:void(0);" onclick="getLegalName('.$value->clientid.');" class="btn-with-tooltip get_legal_name">Get Legal Name</a>';
                                                                                }
                                                                            }
                                                                        }
                                                                        if (!empty($value->einvoice_pdf)){
                                                                            echo '<a href="'.$value->einvoice_pdf.'" class="btn-with-tooltip" style="font-size: 12px;">DOWNLOAD E-INVOICE</a>';
                                                                            if ($value->ewayBiIl_id > 0){
                                                                                $ewayBiIl_pdf = value_by_id_empty("tblwaybill", $value->ewayBiIl_id, "ewaybill_pdf");

                                                                                echo '<a href="javascript:void(0);" class="btn-with-tooltip" style="color:red;" onclick="cancel_ewaybill_remark('.$value->id.');" style="font-size: 12px;">CANCEL E-WAYBILL</a>';
                                                                                if (!empty($ewayBiIl_pdf)){
                                                                                    echo '<a href="'.$ewayBiIl_pdf.'" class="btn-with-tooltip" style="font-size: 12px;">DOWNLOAD EwayBill</a>';
                                                                                }
                                                                            }else{
                                                                                echo '<a href="javascript:void(0);" class="btn-with-tooltip" onclick="generate_ewaybill('.$value->id.');" style="font-size: 12px;">GENERATE EWAYBILL</a>';   
                                                                            }
                                                                            echo '<a href="javascript:void(0);" class="btn-with-tooltip" style="color:red;" onclick="cancel_remark('.$value->id.');" style="font-size: 12px;">CANCEL E-INVOICE</a>';
                                                                        }      
                                                                    ?>
                                                                </li>
                                                             </ul>
                                                        </div>
                                                    </td>
                                                  </tr>
                                                <?php
                                            } ?>

                                        <?php }
                                        ?>
                                        <input type="hidden" name="" id="sgst_id" value="<?php echo $sum; ?>">
                                        <input type="hidden" name="" id="cgst_id" value="<?php echo $cgst_sum; ?>">
                                        <input type="hidden" name="" id="igst_id" value="<?php echo $igst_sum; ?>">
                                    </tbody>
                                  </table>
                                </div>
                            </div>



                        </div>
						 <!-- <div class="btn-bottom-toolbar text-right">
								<button class="btn btn-info" value="1" name="mark" type="submit">
									<?php echo _l('submit'); ?>
								</button>
							</div> -->

                    </div>
                </div>

            <?php echo form_close(); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>
<div id="send_mainto_customer" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <?php
        $attributes = array('id' => 'sub_form_product');
        echo form_open_multipart(admin_url("invoices/invoice_send_to_mail"), $attributes);
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Send Sale Invoice to client </h4>
      </div>
      <div class="modal-body">
          <input type="hidden" name="invoice_id" class="invoice_id" value="">
          <input type="hidden" name="service_type" class="service_type" value="2">
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
            $template_list = $this->db->query("SELECT id, template_name FROM tblemailmoduletemplate WHERE module_id = 4 AND status = 1")->result();
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
        <?php echo form_hidden('template_name',"saleinvoice"); ?>
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

<div id="connect_lead" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <?php
        $attributes = array('id' => 'sub_form_product');
        echo form_open_multipart(admin_url("invoices/connect_to_lead"), $attributes);
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Connect Lead To Invoice </h4>
      </div>
      <div class="modal-body">
          <input type="hidden" name="invoice_id" class="invoice_id" value="">
          <input type="hidden" name="service_type" class="service_type" value="2">
          <div class="row lead_number_data">
              <div class="col-md-8">
                  <label for="lead_number" class="control-label">Lead Number</label>
                  <input type="text" name="lead_number" class="lead_number form-control" autocomplete="off" value="">
                  <input type="hidden" name="lead_id" id="lead_connect_id" value='0' class=" form-control">
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
        <button type="submit" autocomplete="off" class="btn btn-info">Connect</button>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>
<div id="send-email-date" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <?php echo form_open(admin_url("invoices/addsendemaildate"), array('id' => 'sub_form_product')); ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#fff"> Send Email Date </h4>
      </div>
      <div class="modal-body">
         <div class="row">
           <input type="hidden" name="rel_id" class="rel_id" value="">
           <input type="hidden" name="section" class="section" value="invoice">
           <input type="hidden" name="type" class="type" value="sales">
           <div class="form-group col-md-6" app-field-wrapper="date">
               <label for="f_date" class="control-label">Date</label>
               <div class="input-group date">
                   <input id="date" required name="email_send_date" class="form-control datepicker email_send_date" value="<?php echo (!empty($value->email_send_date)) ? $value->email_send_date : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
               </div>
           </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
        <button type="submit" autocomplete="off" class="btn btn-info">Save</button>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>
<div id="courierinfo" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <?php echo form_open_multipart(admin_url("invoices/add_courier_info"), array('id' => 'sub_form_product')); ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#fff"> Send Courier Info </h4>
      </div>
      <div class="modal-body">
         <div class="row">
           <input type="hidden" name="rel_id" class="rel_id" value="">
           <input type="hidden" name="rel_type" class="rel_type" value="invoice">
           <input type="hidden" name="type" class="type" value="sales">
           <div class="form-group col-md-6" app-field-wrapper="courier_name">
               <label for="courier_name" class="control-label">Courier Name</label>
               <input type="text" required class="form-control" name="courier_name" id="couriername" value="">
           </div>
           <div class="form-group col-md-6" app-field-wrapper="tracking_number">
               <label for="tracking_number" class="control-label">Tracking Number</label>
               <input type="text" required class="form-control" name="tracking_number" id="trackingnumber" value="">
           </div>
           <div class="form-group col-md-6" app-field-wrapper="courier_date">
               <label for="date" class="control-label">Date</label>
               <div class="input-group date">
                   <input id="courierdate" required name="courier_date" class="form-control datepicker" value="" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
               </div>
           </div>
           <div class="form-group col-md-6" app-field-wrapper="files">
               <label for="files" class="control-label">Files</label>
               <input type="file" class="form-control" name="courier_file[]" id="courier_file" multiple="" value="">
               <div class="courierfilediv">

               </div>
           </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
        <button type="submit" autocomplete="off" class="btn btn-info">Save</button>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>

<div id="spinnerlodder" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content" style="width: 140px;margin-top: 50%;margin-left: 40%;">
            <div class="modal-body" >
                <div class="row">
                    <div class="col-md-12">
                        <!-- <img src="<?php echo base_url('assets/images/lodder.gif'); ?>" width="100px;" alt="lodder"> -->
                        <h6>Please waiting.....</h6>                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="cancel-einvoice-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <?php echo form_open(admin_url("E_invoicing/cancel_einvoice"), array('id' => 'cancel_einvoice_from')); ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:#fff"> Cancel E-invoice </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="invoice_id" class="invoice_id" value="0">
                    <div class="form-group">
                        <div class="col-md-12" app-field-wrapper="cancel-remark">
                            <label for="cancel_remark" class="control-label">Cancel Remark</label>
                            <textarea class="form-control" name="cancel_remarks" id="cancel_remarks" cols="30" rows="5" required></textarea>                
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="type" value="einvoice">
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
                <button type="submit" autocomplete="off" class="btn btn-info">Send Request</button>
            </div>
        </div>
    <?php echo form_close(); ?>
  </div>
</div>

<div id="generate-ewaybill-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <?php echo form_open(admin_url("E_invoicing/generate_ewaybill"), array('id' => 'generate_ewaybill')); ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:#fff"> Generate Ewaybill </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="invoice_id" class="invoice_id" value="0">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vehicle_number" class="control-label">Vehicle Number</label>
                                <input type="text" class="form-control" name="vehicle_number" id="vehicle_number" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="transporter_name" class="control-label">Transporter Name</label>
                                <input type="text" class="form-control" name="transporter_name" id="transporter_name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vehicle_type" class="control-label">Vehicle Type</label>
                                <select class="form-control selectpicker" required="" data-live-search="true" id="vehicle_type" name="vehicle_type">
                                    <option value="R">Regular</option>
                                    <option value="O">ODC</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="transportation_mode" class="control-label">Transportation Mode</label>
                                <select class="form-control selectpicker" required="" data-live-search="true" id="transportation_mode" name="transportation_mode">
                                    <option value="1">Road</option>
                                    <option value="2">Rail</option>
                                    <option value="3">Air</option>
                                    <option value="4">Ship</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="transporter_id" class="control-label">Transporter ID</label>
                                <input type="text" class="form-control" name="transporter_id" id="transporter_id" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="transporter_doc_no" class="control-label">Transporter Document Number</label>
                                <input type="text" class="form-control" name="transporter_doc_no" id="transporter_doc_no" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="transporter_doc_date" class="control-label">Transporter Document Date</label>
                                <div class="input-group date">
                                    <input id="transporter_doc_date" name="transporter_doc_date" class="form-control datepicker" value="" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
                <button type="submit" autocomplete="off" class="btn btn-info">Save</button>
            </div>
        </div>
    <?php echo form_close(); ?>
  </div>
</div>

<div id="cancel-ewaybill-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <?php echo form_open(admin_url("E_invoicing/cancel_einvoice"), array('id' => 'cancel_einvoice_from')); ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:#fff"> Cancel E-Waybill </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="invoice_id" class="invoice_id" value="0">
                    <div class="form-group">
                        <div class="col-md-12" app-field-wrapper="cancel-remark">
                            <label for="cancel_remark" class="control-label">Cancel Remark</label>
                            <textarea class="form-control" name="cancel_remarks" id="cancel_remarks" cols="30" rows="5" required></textarea>                
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="type" value="ewaybill">
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
                <button type="submit" autocomplete="off" class="btn btn-info">Send Request</button>
            </div>
        </div>
    <?php echo form_close(); ?>
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
     <script type="text/javascript" src="http://cdn.rawgit.com/bassjobsen/Bootstrap-3-Typeahead/master/bootstrap3-typeahead.min.js"></script>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
        var invoice_id = $(this).data("id");
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
        $(".invoice_id").val(invoice_id);
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
<script>

$(document).ready(function() {
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            'colvis',
        ]
    } );
} );
</script>
<!--<script type="text/javascript">
    var a = document.getElementById("sgst_id").value;
    $('#sgst_tot').html('Total SGST :  '+a);

    var b = document.getElementById("cgst_id").value;
    $('#cgst_tot').html('Total CGST :  '+b);

    var c = document.getElementById("igst_id").value;
    $('#igst_tot').html('Total IGST :  '+c);
</script>-->
<script type="text/javascript">
    var a = document.getElementById("sgst_id").value;
    $('#sgst_tot').html(a);
//    $('#sgst_tot').html('Total SGST :  '+a);

    var b = document.getElementById("cgst_id").value;
    $('#cgst_tot').html(b);
//    $('#cgst_tot').html('Total CGST :  '+b);

    var c = document.getElementById("igst_id").value;
    $('#igst_tot').html(c);
//    $('#igst_tot').html('Total IGST :  '+c);
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

  $(document).on("click", ".connect_to_lead", function(){
      var id = $(this).data("id");
      $(".invoice_id").val(id);
      $.ajax({
            url: "<?php echo admin_url();?>invoices/chk_lead/"+id,
            dataType: "json",
            type: "GET",
            success: function (data) {
                $(".lead_number").val(data.leadno);
                $('#lead_connect_id').val(data.lead_id);
            }
        });
  });
</script>

<script type="text/javascript">
        $(function () {
            $(".lead_number").typeahead({
                hint: true,
                highlight: true,
                minLength: 1,
                source: function (request, response) {
                    $.ajax({
                        url: "<?php echo admin_url();?>invoices/getleadlist",
                        data: {
                            search: request
                          },
                        dataType: "json",
                        type: "POST",
                        success: function (data) {
                            items = [];
                            map = {};
                            $.each(data, function (i, item) {
                                var id = item.value;
                                var name = item.label;
                                map[name] = { id: id, name: name };
                                items.push(name);
                            });
                            response(items);
                            $(".dropdown-menu").css("height", "auto");
                        },
                        error: function (response) {
                            alert(response.responseText);
                        },
                        failure: function (response) {
                            alert(response.responseText);
                        }
                    });
                },
                updater: function (item) {
                    $('#lead_connect_id').val(map[item].id);
                    return item;
                }
            });
        });

        $(document).on("click", ".sendemail-date", function(){
            var date = $(this).data("emaildate");
            var rel_id = $(this).data("rel_id");
            $(".email_send_date").val(date);
            $(".rel_id").val(rel_id);
        });

        function getcourierinfo(rel_id){
           var courier_name = $(".courier_name"+rel_id).val();
           var tracking_number = $(".tracking_number"+rel_id).val();
           var courier_date = $(".courier_date"+rel_id).val();
           var courier_files = $(".courier_files"+rel_id).html();
           $(".rel_id").val(rel_id);
           $("#couriername").val(courier_name);
           $("#trackingnumber").val(tracking_number);
           $("#courierdate").val(courier_date);
           $(".courierfilediv").html(courier_files);
        }

        function getLegalName(client_id){
            $.ajax({
                url: "<?php echo admin_url();?>E_invoicing/get_client_legal_name/"+client_id,
                type: 'GET',
                beforeSend: function(){
                    // Show image container
                    // $("#loader").show();
                    $('#spinnerlodder').modal({backdrop: 'static',keyboard: false,show: true}); 
                },
                success: function(response){
                    alert(response);
                    location.reload();
                },
                complete:function(data){
                    // Hide image container
                    // $("#loader").hide();
                    $('#spinnerlodder').modal("hide"); 
                }
            });
        }
        function generateEinvoice(invoice_id){
            $.ajax({
                url: "<?php echo admin_url();?>E_invoicing/generate_einvoice/"+invoice_id,
                type: 'GET',
                beforeSend: function(){
                    // Show image container
                    // $("#loader").show();
                    $('#spinnerlodder').modal({backdrop: 'static',keyboard: false,show: true}); 
                },
                success: function(response){
                    alert(response);
                    location.reload();
                },
                complete:function(data){
                    // Hide image container
                    // $("#loader").hide();
                    $('#spinnerlodder').modal("hide"); 
                }
            });
        }
        function generate_ewaybill(invoice_id){
            if (confirm('Do you really want to take action ?')){
                $("#generate-ewaybill-modal").modal("show");
                $(".invoice_id").val(invoice_id);
            }
        }
        function cancel_remark(invoice_id){
            if (confirm('Do you really want to take action ?')){
                $("#cancel-einvoice-modal").modal("show");
                $(".invoice_id").val(invoice_id);
            }
        }
        function cancel_ewaybill_remark(invoice_id){
            if (confirm('Do you really want to take action ?')){
                $("#cancel-ewaybill-modal").modal("show");
                $(".invoice_id").val(invoice_id);
            }
        }

        /* this function use for update accounted status */
        function update_accounted_status(id){
            var base_url = "<?php echo admin_url('invoices/update_accounted_status/'); ?>"+id+'/sales';
            swal("Are you sure you want to change this?", {
                icon : "info",
                closeOnClickOutside: false,
                showCancelButton: true,
                buttons: true,
            }).then((result) => {
                if (result == true){
                   
                    $.ajax({
                        type    : "GET",
                        url     : base_url,
                        success : function(response){
                            if(response != ''){
                                $(".accounted_sts"+id).html(response);
                                swal("","Accounted Status Updated Successfully", "success");
                            }
                        }
                    });
                }
                
            });
        }
    </script>
</body>
</html>
