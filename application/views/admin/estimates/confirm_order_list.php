
<?php init_head(); ?>
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php echo $title; /*if(check_permission_page(6,'create')){ ?>  <a href="<?php echo admin_url('estimates/performerinvoice'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; "> Create New Proforma Invoice</a>  <?php }*/ ?></h4>
                    <hr class="hr-panel-heading">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="text-center <?php echo (!empty($section) && $section == 1) ? 'active' : ''; ?>">
                                    <a  href="#alumininum_order" aria-controls="designrequisition" role="tab" data-toggle="tab"> Aluminium </a>
                                </li>
                                <li role="presentation" class="text-center <?php echo (!empty($section) && $section == 2) ? 'active' : ''; ?>">
                                    <a  href="#fomwork_order" aria-controls="designrequisition" role="tab" data-toggle="tab"> Fomwork </a>
                                </li>
                                <li role="presentation" class="text-center <?php echo (!empty($section) && $section == 3) ? 'active' : ''; ?>">
                                    <a href="#scaffolding_order" aria-controls="designdepartment" role="tab" data-toggle="tab">Steel Scaffolding</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane <?php echo (!empty($section) && $section == 1) ? 'active' : ''; ?>" id="alumininum_order">
                                <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>  
                                    <div>
                                            <div class="row col-md-12">
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label for="source" class="control-label">Customer</label>
                                                        <select class="form-control selectpicker" name="clientid" id="clientid" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($client_branch_data) && count($client_branch_data) > 0 ) {
                                                                foreach ($client_branch_data as $value) {
                                                                    ?>
                                                                    <option value="<?php echo $value->userid ?>" <?php if (!empty($clientid) && $clientid == $value->userid && $section == 1) {
                                                                echo 'selected';
                                                            } ?>><?php echo cc($value->client_branch_name); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label for="source" class="control-label">Status</label>
                                                        <select class="form-control selectpicker" name="status" id="status" data-live-search="true">
                                                            <option value=""></option>
                                                            <option value="1" <?php echo (isset($status) && $status == "1" && $section == 1) ? 'selected':''; ?>>Complete</option>
                                                            <option value="0" <?php echo (isset($status) && $status == "0" && $section == 1) ? 'selected':''; ?>>Pending</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group" app-field-wrapper="date">
                                                        <label for="f_date" class="control-label">From Date</label>
                                                        <div class="input-group date">
                                                            <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if (!empty($f_date) && $section == 1) {
                                                                echo $f_date;
                                                            } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group" app-field-wrapper="date">
                                                        <label for="t_date" class="control-label">To Date</label>
                                                        <div class="input-group date">
                                                            <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if (!empty($t_date) && $section == 1) {
                                                                echo $t_date;
                                                            } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- <div class="col-md-2">
                                                    <div class="form-group ">
                                                        <label for="source" class="control-label">Product Type</label>
                                                        <select class="form-control selectpicker" name="product_type" id="product_type" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($product_types_list) && count($product_types_list) > 0 ) {
                                                                foreach ($product_types_list as $pro_types) {
                                                                    if ($pro_types->id == '1'){
                                                                    ?>
                                                                    <option value="<?php echo $pro_types->id ?>" <?php echo (!empty($product_type) && $product_type == $pro_types->id && $section == 1) ? 'selected':''; ?>><?php echo cc($pro_types->name); ?></option>
                                                                    <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div> -->
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label for="source" class="control-label">Branch</label>
                                                        <select class="form-control selectpicker" name="branch_id" id="branch_id" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($branch_info) && count($branch_info) > 0 ) {
                                                                foreach ($branch_info as $branch) {
                                                                    ?>
                                                                    <option value="<?php echo $branch->id ?>" <?php echo (!empty($branch_id) && $branch_id == $branch->id && $section == 1) ? 'selected':''; ?>><?php echo cc($branch->comp_branch_name); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label for="product_name" class="control-label">Product</label>
                                                        <select class="form-control selectpicker" name="product_id" id="product_id" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($product_list) && count($product_list) > 0 ) {
                                                                foreach ($product_list as $product) {
                                                                    ?>
                                                                    <option value="<?php echo $product->id ?>" <?php echo (!empty($product_id) && $product_id == $product->id && $section == 1) ? 'selected':''; ?>><?php echo cc($product->name); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" style="margin-top: 28px;">
                                                    <div class="form-group" app-field-wrapper="date" >
                                                        <input type="hidden" name="section" value="1">
                                                        <button type="submit"  class="btn btn-info">Search</button>
                                                        <a  class="btn btn-danger" href="">Reset</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                            <div class="col-md-12 col-md-2 total-column">
                                                <div class="panel_s">
                                                    <div class="panel-body">
                                                        <h3 class="text-muted _total alumininumOrderttl">0</h3>
                                                        <span class="staff_logged_time_text text-success">Total Compilation Days</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 table-responsive">
                                                <table class="table" id="newtable">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Challan #</th>
                                                            <th>Proforma Invoice #</th>
                                                            <th>Invoice #</th>
                                                            <th>Proforma Challan #</th>
                                                            <th>Sales Person Name</th>
                                                            <th>Customer Name</th>
                                                            <th>Delivery Date</th>
                                                            <th>Expected Complete Date</th>
                                                            <th>Compilation Days</th>
                                                            <th>Priority</th>
                                                            <th>Order Status</th>
                                                            <th>Created At</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $total_amt = 0.00;
                                                    $i = 1;
                                                    $compilation_days1 = 0;
                                                    if(!empty($order_confirm_list)){
                                                        foreach ($order_confirm_list as $key => $value) {

                                                            $client_info = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$value->clientid."' ")->row();
                                                            $compilation_days1 += $value->compilation_days;
                                                            $ordercomplete_date = (!empty($value->expected_completed_date)) ? _d($value->expected_completed_date) : "SET DATE";
                                                            $ordercomplete_date1 = (!empty($value->expected_completed_date)) ? _d($value->expected_completed_date) : "";
                                                            $OrderCompilationDays = ($value->compilation_days > 0) ? $value->compilation_days : "SET DAYS";
                                                            $OrderPriority = ($value->priority > 0) ? $value->priority : "SET Priority";
                                                            $pro_status = "SET STATUS";
                                                            if ($value->order_status_id > 0){
                                                                $pro_status = value_by_id("tblconfirmorderstatus", $value->order_status_id, "title");
                                                            }

                                                            $challan_info = $this->db->query("SELECT id,production_plan_id,chalanno FROM `tblchalanmst` WHERE (`rel_id`='".$value->id."' OR `rel_id`='".$value->proformachallan_id."') order by id desc ")->row();
                                                            if (!empty($challan_info)){
                                                                $challanlink = '<a target="_blank" href="' . admin_url('chalan/pdf/' . $challan_info->id). '" >' .$challan_info->chalanno. '</a>';
                                                            }else{
                                                                $challanlink = '<span class="btn-sm btn-warning">Pending</span>';
                                                            }

                                                            $invoice_info = $this->db->query("SELECT `id`,`number` from `tblinvoices` where estimate_id = '".$value->id."'")->row();
                                                            $invoice_number = (!empty($invoice_info)) ? '<a target="_blank" href="' . admin_url('invoices/download_pdf/' . $invoice_info->id). '" >' .$invoice_info->number. '</a>':'<span class="btn-sm btn-warning">Pending</span>';
                                                            $proformachallan_number = ($value->proformachallan_id > 0) ? '<a target="_blank" href="' . admin_url('estimates/proformachallan_download_pdf/' . $value->proformachallan_id). '" >' .'PC-'.sprintf("%'.05d\n", $value->proformachallan_id). '</a>':'--';
                                                        if($value->id > 0){
                                                            $sales_person_id = value_by_id_empty("tblleadstaffgroup", $value->group_id,"sales_person_id");
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i++; ?></td>
                                                            <td><?php echo $challanlink; ?></td>
                                                            <td><?php echo '<a target="_blank" href="' . admin_url('estimates/download_pdf/' . $value->id) . '" >' . format_estimate_number($value->id) . '</a>'; ?></td>
                                                            <td><?php echo $invoice_number; ?></td>
                                                            <td><?php echo $proformachallan_number; ?></td>
                                                            <td><?php echo (!empty($sales_person_id)) ? get_employee_fullname($sales_person_id) : '--'; ?></td>

                                                            <td><?php if(!empty($client_info)){ echo cc($client_info->client_branch_name); }else{ echo '--'; } ?></td>
                                                            <td><?php echo _d($value->delivery_date); ?></td>
                                                            <td><a href="javascript:void(0);" class="label label-primary completedate" data-toggle="modal" data-target="#expectedcomplete_date" data-section="1" data-order_id="<?php echo $value->confirm_order_id; ?>" data-id="<?php echo $value->id; ?>" data-expected_date="<?php echo $ordercomplete_date1; ?>"><?php echo $ordercomplete_date; ?></a></td>
                                                            <td><a href="javascript:void(0);" class="label label-primary compilationdays" data-toggle="modal" data-target="#compilation_days_modal" data-section="1" data-order_id="<?php echo $value->confirm_order_id; ?>" data-id="<?php echo $value->id; ?>" data-compilation_days="<?php echo $value->compilation_days; ?>"><?php echo $OrderCompilationDays; ?></a></td>
                                                            <td><a href="javascript:void(0);" class="label label-primary priority_order" data-toggle="modal" data-target="#priorityorder_modal" data-section="1" data-order_id="<?php echo $value->confirm_order_id; ?>" data-id="<?php echo $value->id; ?>" data-priority="<?php echo $value->priority; ?>"><?php echo $OrderPriority; ?></a></td>
                                                            <td>
                                                            <?php if ($value->complete_status == 1 && $value->order_status_id != '11'){ ?>
                                                                <span class="label label-success"><?php echo cc($pro_status); ?></span>
                                                            <?php }else if ($value->order_status_id == '11'){
                                                                echo '<span class="label label-danger">'.cc($pro_status).'</span>';
                                                            }else{ ?>
                                                                <a href="javascript:void(0);" class="label label-success orderconfirm" data-toggle="modal" data-section="1" data-target="#delivery_order_confirm" data-order_id="<?php echo $value->confirm_order_id; ?>" data-id="<?php echo $value->id; ?>" id="order_confirm"><?php echo cc($pro_status); ?></a>
                                                            <?php } ?>
                                                            </td>
                                                            <td><?php echo _d($value->created_at); ?></td>
                                                            <td class="text-center">

                                                            <div class="btn-group pull-right">
                                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                        <li>
                                                                        <a href="javascript:void(0);" class="orderprocess" data-section="1" data-id="<?php echo $value->id; ?>" data-order_id="<?php echo $value->confirm_order_id; ?>" data-target="#delivery_order_process" id="order_confirm" data-toggle="modal"><i class="fa fa-eye"></i> Order Process </a>
                                                                        <a target="_blank" href="<?php echo admin_url('follow_up/estimates_activity/'. $value->id); ?>"  >Activity</a>
                                                                        <?php
                                                                        if ($value->proformachallan_id > 0){
                                                                            $chkproductionplan = $this->db->query("SELECT * FROM `tblchalanproductionplan` WHERE `chalan_id`= ".$value->proformachallan_id." AND `ref_type`= '2' ")->row();
                                                                            if (!empty($chkproductionplan)){
                                                                        ?>
                                                                                <a target="_blank" style="color:yellowgreen;" href="<?php echo admin_url('Chalan/production_plan_pdf/' . $chkproductionplan->id); ?>" >Production Plan Converted</a>
                                                                        <?php  }else{ ?>
                                                                                <a target="_blank" href="<?php echo admin_url("chalan/convert_to_productionplan/".$value->proformachallan_id."?ref_type=2");?>" class="btn-with-tooltip" id="production_plan">
                                                                                    Convert To Production Plan
                                                                                </a>
                                                                        <?php        
                                                                            }
                                                                        }else if (!empty($challan_info)){
                                                                            if($challan_info->production_plan_id == 0) { ?>
                                                                                <a target="_blank" href="<?php echo admin_url("chalan/convert_to_productionplan/".$challan_info->id."?ref_type=1");?>" class="btn-with-tooltip" id="production_plan">
                                                                                    Convert To Production Plan
                                                                                </a>
                                                                            <?php }else{ ?>
                                                                                <a target="_blank" style="color:yellowgreen;" href="<?php echo admin_url('Chalan/production_plan_pdf/' . $challan_info->production_plan_id); ?>" >Production Plan Converted</a>
                                                                            <?php }
                                                                        }
                                                                        
                                                                        ?>
                                                                        </li>
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
                                <?php echo form_close(); ?>    
                                <div role="tabpanel" class="tab-pane <?php echo (!empty($section) && $section == 2) ? 'active' : ''; ?>" id="fomwork_order">
                                <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>  
                                    <div>
                                            <div class="row col-md-12">
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label for="source" class="control-label">Customer</label>
                                                        <select class="form-control selectpicker" name="clientid" id="clientid" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($client_branch_data) && count($client_branch_data) > 0 ) {
                                                                foreach ($client_branch_data as $value) {
                                                                    ?>
                                                                    <option value="<?php echo $value->userid ?>" <?php if (!empty($clientid) && $clientid == $value->userid && $section == 2) {
                                                                echo 'selected';
                                                            } ?>><?php echo cc($value->client_branch_name); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label for="source" class="control-label">Status</label>
                                                        <select class="form-control selectpicker" name="status" id="status" data-live-search="true">
                                                            <option value=""></option>
                                                            <option value="1" <?php echo (isset($status) && $status == "1" && $section == 2) ? 'selected':''; ?>>Complete</option>
                                                            <option value="0" <?php echo (isset($status) && $status == "0" && $section == 2) ? 'selected':''; ?>>Pending</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group" app-field-wrapper="date">
                                                        <label for="f_date" class="control-label">From Date</label>
                                                        <div class="input-group date">
                                                            <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if (!empty($f_date) && $section == 2) {
                                                                echo $f_date;
                                                            } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group" app-field-wrapper="date">
                                                        <label for="t_date" class="control-label">To Date</label>
                                                        <div class="input-group date">
                                                            <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if (!empty($t_date) && $section == 2) {
                                                                echo $t_date;
                                                            } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- <div class="col-md-2">
                                                    <div class="form-group ">
                                                        <label for="source" class="control-label">Product Type</label>
                                                        <select class="form-control selectpicker" name="product_type" id="product_type" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($product_types_list) && count($product_types_list) > 0 ) {
                                                                foreach ($product_types_list as $pro_types) {
                                                                    if ($pro_types->id == '4'){
                                                                    ?>
                                                                    <option value="<?php echo $pro_types->id ?>" <?php echo (!empty($product_type) && $product_type == $pro_types->id && $section == 2) ? 'selected':''; ?>><?php echo cc($pro_types->name); ?></option>
                                                                    <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div> -->
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label for="source" class="control-label">Branch</label>
                                                        <select class="form-control selectpicker" name="branch_id" id="branch_id" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($branch_info) && count($branch_info) > 0 ) {
                                                                foreach ($branch_info as $branch) {
                                                                    ?>
                                                                    <option value="<?php echo $branch->id ?>" <?php echo (!empty($branch_id) && $branch_id == $branch->id && $section == 2) ? 'selected':''; ?>><?php echo cc($branch->comp_branch_name); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label for="product_name" class="control-label">Product</label>
                                                        <select class="form-control selectpicker" name="product_id" id="product_id" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($product_list) && count($product_list) > 0 ) {
                                                                foreach ($product_list as $product) {
                                                                    ?>
                                                                    <option value="<?php echo $product->id ?>" <?php echo (!empty($product_id) && $product_id == $product->id && $section == 2) ? 'selected':''; ?>><?php echo cc($product->name); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" style="margin-top: 28px;">
                                                    <div class="form-group" app-field-wrapper="date" >
                                                        <input type="hidden" name="section" value="2">
                                                        <button type="submit"  class="btn btn-info">Search</button>
                                                        <a  class="btn btn-danger" href="">Reset</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                            <div class="col-md-12 col-md-2 total-column">
                                                <div class="panel_s">
                                                    <div class="panel-body">
                                                        <h3 class="text-muted _total fomworkOrderttl">0</h3>
                                                        <span class="staff_logged_time_text text-success">Total Compilation Days</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 table-responsive">
                                                <table class="table" id="newtable2">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Challan #</th>
                                                            <th>Proforma Invoice #</th>
                                                            <th>Invoice #</th>
                                                            <th>Proforma Challan #</th>
                                                            <th>Sales Person Name</th>
                                                            <th>Customer Name</th>
                                                            <th>Delivery Date</th>
                                                            <th>Expected Complete Date</th>
                                                            <th>Compilation Days</th>
                                                            <th>Priority</th>
                                                            <th>Order Status</th>
                                                            <th>Created At</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $total_amt = 0.00;
                                                    $i = 1;
                                                    $compilation_days2 = 0;
                                                    if(!empty($fomwork_list)){
                                                        foreach ($fomwork_list as $key => $value) {

                                                            $client_info = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$value->clientid."' ")->row();
                                                            $compilation_days2 += $value->compilation_days;
                                                            $ordercomplete_date = (!empty($value->expected_completed_date)) ? _d($value->expected_completed_date) : "SET DATE";
                                                            $ordercomplete_date1 = (!empty($value->expected_completed_date)) ? _d($value->expected_completed_date) : "";
                                                            $OrderCompilationDays = ($value->compilation_days > 0) ? $value->compilation_days : "SET DAYS";
                                                            $OrderPriority = ($value->priority > 0) ? $value->priority : "SET Priority";
                                                            $pro_status = "SET STATUS";
                                                            if ($value->order_status_id > 0){
                                                                $pro_status = value_by_id("tblconfirmorderstatus", $value->order_status_id, "title");
                                                            }

                                                            $challan_info = $this->db->query("SELECT id,production_plan_id,chalanno FROM `tblchalanmst` WHERE (`rel_id`='".$value->id."' OR `rel_id`='".$value->proformachallan_id."') order by id desc ")->row();
                                                            if (!empty($challan_info)){
                                                                $challanlink = '<a target="_blank" href="' . admin_url('chalan/pdf/' . $challan_info->id). '" >' .$challan_info->chalanno. '</a>';
                                                            }else{
                                                                $challanlink = '<span class="btn-sm btn-warning">Pending</span>';
                                                            }

                                                            $invoice_info = $this->db->query("SELECT `id`,`number` from `tblinvoices` where estimate_id = '".$value->id."'")->row();
                                                            $invoice_number = (!empty($invoice_info)) ? '<a target="_blank" href="' . admin_url('invoices/download_pdf/' . $invoice_info->id). '" >' .$invoice_info->number. '</a>':'<span class="btn-sm btn-warning">Pending</span>';
                                                            $proformachallan_number = ($value->proformachallan_id > 0) ? '<a target="_blank" href="' . admin_url('estimates/proformachallan_download_pdf/' . $value->proformachallan_id). '" >' .'PC-'.sprintf("%'.05d\n", $value->proformachallan_id). '</a>':'--';
                                                        if($value->id > 0){
                                                            $sales_person_id = value_by_id_empty("tblleadstaffgroup", $value->group_id,"sales_person_id");
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i++; ?></td>
                                                            <td><?php echo $challanlink; ?></td>
                                                            <td><?php echo '<a target="_blank" href="' . admin_url('estimates/download_pdf/' . $value->id) . '" >' . format_estimate_number($value->id) . '</a>'; ?></td>
                                                            <td><?php echo $invoice_number; ?></td>
                                                            <td><?php echo $proformachallan_number; ?></td>
                                                            <td><?php echo (!empty($sales_person_id)) ? get_employee_fullname($sales_person_id) : '--'; ?></td>

                                                            <td><?php if(!empty($client_info)){ echo cc($client_info->client_branch_name); }else{ echo '--'; } ?></td>
                                                            <td><?php echo _d($value->delivery_date); ?></td>
                                                            <td><a href="javascript:void(0);" class="label label-primary completedate" data-toggle="modal" data-target="#expectedcomplete_date" data-section="1" data-order_id="<?php echo $value->confirm_order_id; ?>" data-id="<?php echo $value->id; ?>" data-expected_date="<?php echo $ordercomplete_date1; ?>"><?php echo $ordercomplete_date; ?></a></td>
                                                            <td><a href="javascript:void(0);" class="label label-primary compilationdays" data-toggle="modal" data-target="#compilation_days_modal" data-section="1" data-order_id="<?php echo $value->confirm_order_id; ?>" data-id="<?php echo $value->id; ?>" data-compilation_days="<?php echo $value->compilation_days; ?>"><?php echo $OrderCompilationDays; ?></a></td>
                                                            <td><a href="javascript:void(0);" class="label label-primary priority_order" data-toggle="modal" data-target="#priorityorder_modal" data-section="1" data-order_id="<?php echo $value->confirm_order_id; ?>" data-id="<?php echo $value->id; ?>" data-priority="<?php echo $value->priority; ?>"><?php echo $OrderPriority; ?></a></td>
                                                            <td>
                                                            <?php if ($value->complete_status == 1 && $value->order_status_id != '11'){ ?>
                                                                <span class="label label-success"><?php echo cc($pro_status); ?></span>
                                                            <?php }else if ($value->order_status_id == '11'){
                                                                echo '<span class="label label-danger">'.cc($pro_status).'</span>';
                                                            }else{ ?>
                                                                <a href="javascript:void(0);" class="label label-success orderconfirm" data-toggle="modal" data-section="1" data-target="#delivery_order_confirm" data-order_id="<?php echo $value->confirm_order_id; ?>" data-id="<?php echo $value->id; ?>" id="order_confirm"><?php echo cc($pro_status); ?></a>
                                                            <?php } ?>
                                                            </td>
                                                            <td><?php echo _d($value->created_at); ?></td>
                                                            <td class="text-center">

                                                            <div class="btn-group pull-right">
                                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                        <li>
                                                                        <a href="javascript:void(0);" class="orderprocess" data-section="1" data-id="<?php echo $value->id; ?>" data-order_id="<?php echo $value->confirm_order_id; ?>" data-target="#delivery_order_process" id="order_confirm" data-toggle="modal"><i class="fa fa-eye"></i> Order Process </a>
                                                                        <a target="_blank" href="<?php echo admin_url('follow_up/estimates_activity/'. $value->id); ?>"  >Activity</a>
                                                                        <?php
                                                                        if ($value->proformachallan_id > 0){
                                                                            $chkproductionplan = $this->db->query("SELECT * FROM `tblchalanproductionplan` WHERE `chalan_id`= ".$value->proformachallan_id." AND `ref_type`= '2' ")->row();
                                                                            if (!empty($chkproductionplan)){
                                                                        ?>
                                                                                <a target="_blank" style="color:yellowgreen;" href="<?php echo admin_url('Chalan/production_plan_pdf/' . $chkproductionplan->id); ?>" >Production Plan Converted</a>
                                                                        <?php  }else{ ?>
                                                                                <a target="_blank" href="<?php echo admin_url("chalan/convert_to_productionplan/".$value->proformachallan_id."?ref_type=2");?>" class="btn-with-tooltip" id="production_plan">
                                                                                    Convert To Production Plan
                                                                                </a>
                                                                        <?php        
                                                                            }
                                                                        }else if (!empty($challan_info)){
                                                                            if($challan_info->production_plan_id == 0) { ?>
                                                                                <a target="_blank" href="<?php echo admin_url("chalan/convert_to_productionplan/".$challan_info->id."?ref_type=1");?>" class="btn-with-tooltip" id="production_plan">
                                                                                    Convert To Production Plan
                                                                                </a>
                                                                            <?php }else{ ?>
                                                                                <a target="_blank" style="color:yellowgreen;" href="<?php echo admin_url('Chalan/production_plan_pdf/' . $challan_info->production_plan_id); ?>" >Production Plan Converted</a>
                                                                            <?php }
                                                                        }
                                                                        
                                                                        ?>
                                                                        </li>
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
                                <?php echo form_close(); ?> 
                                <div role="tabpanel" class="tab-pane <?php echo (!empty($section) && $section == 3) ? 'active' : ''; ?>" id="scaffolding_order">
                                    <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>  
                                        <div>
                                            <div class="row col-md-12">
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label for="source" class="control-label">Customer</label>
                                                        <select class="form-control selectpicker" name="clientid" id="clientid" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($client_branch_data) && count($client_branch_data) > 0 ) {
                                                                foreach ($client_branch_data as $value) {
                                                                    ?>
                                                                    <option value="<?php echo $value->userid ?>" <?php if (!empty($clientid) && $clientid == $value->userid && $section == 3) {
                                                                echo 'selected';
                                                            } ?>><?php echo cc($value->client_branch_name); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label for="source" class="control-label">Status</label>
                                                        <select class="form-control selectpicker" name="status" id="status" data-live-search="true">
                                                            <option value=""></option>
                                                            <option value="1" <?php echo (isset($status) && $status == "1" && $section == 3) ? 'selected':''; ?>>Complete</option>
                                                            <option value="0" <?php echo (isset($status) && $status == "0" && $section == 3) ? 'selected':''; ?>>Pending</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group" app-field-wrapper="date">
                                                        <label for="f_date" class="control-label">From Date</label>
                                                        <div class="input-group date">
                                                            <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if (!empty($f_date) && $section == 3) {
                                                                echo $f_date;
                                                            } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group" app-field-wrapper="date">
                                                        <label for="t_date" class="control-label">To Date</label>
                                                        <div class="input-group date">
                                                            <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if (!empty($t_date) && $section == 3) {
                                                                echo $t_date;
                                                            } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- <div class="col-md-2">
                                                    <div class="form-group ">
                                                        <label for="source" class="control-label">Product Type</label>
                                                        <select class="form-control selectpicker" name="product_type" id="product_type" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($product_types_list) && count($product_types_list) > 0) {
                                                                foreach ($product_types_list as $pro_types) {
                                                                    if ($pro_types->id == 3){
                                                                    ?>
                                                                    <option value="<?php echo $pro_types->id ?>" <?php echo (!empty($product_type) && $product_type == $pro_types->id && $section == 3) ? 'selected':''; ?>><?php echo cc($pro_types->name); ?></option>
                                                                    <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div> -->
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label for="source" class="control-label">Branch</label>
                                                        <select class="form-control selectpicker" name="branch_id" id="branch_id" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($branch_info) && count($branch_info) > 0) {
                                                                foreach ($branch_info as $branch) {
                                                                    ?>
                                                                    <option value="<?php echo $branch->id ?>" <?php echo (!empty($branch_id) && $branch_id == $branch->id && $section == 3) ? 'selected':''; ?>><?php echo cc($branch->comp_branch_name); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label for="product_name" class="control-label">Product</label>
                                                        <select class="form-control selectpicker" name="product_id" id="product_id" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($product_list) && count($product_list) > 0 ) {
                                                                foreach ($product_list as $product) {
                                                                    ?>
                                                                    <option value="<?php echo $product->id ?>" <?php echo (!empty($product_id) && $product_id == $product->id && $section == 3) ? 'selected':''; ?>><?php echo cc($product->name); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" style="margin-top: 28px;">
                                                    <div class="form-group" app-field-wrapper="date" >
                                                        <input type="hidden" name="section" value="3">
                                                        <button type="submit"  class="btn btn-info">Search</button>
                                                        <a  class="btn btn-danger" href="">Reset</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                            <div class="col-md-12 col-md-2 total-column">
                                                <div class="panel_s">
                                                    <div class="panel-body">
                                                        <h3 class="text-muted _total scaffoldingOrderttl">0</h3>
                                                        <span class="staff_logged_time_text text-success">Total Compilation Days</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 table-responsive" style="overflow: auto;">
                                                <table class="table" id="newtable3">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Challan #</th>
                                                            <th>Proforma Invoice #</th>
                                                            <th>Invoice #</th>
                                                            <th>Proforma Challan #</th>
                                                            <th>Sales Person Name</th>
                                                            <th>Customer Name</th>
                                                            <th>Delivery Date</th>
                                                            <th>Expected Complete Date</th>
                                                            <th>Compilation Days</th>
                                                            <th>Priority</th>
                                                            <th>Order Status</th>
                                                            <th>Created At</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $total_amt = 0.00;
                                                        $compilation_days3 = 0;
                                                        $i = 1;
                                                        if(!empty($scaffolding_order_list)){
                                                            foreach ($scaffolding_order_list as $key => $value) {

                                                                $client_info = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$value->clientid."' ")->row();
                                                                $compilation_days3 += $value->compilation_days;
                                                                $ordercomplete_date = (!empty($value->expected_completed_date)) ? _d($value->expected_completed_date) : "SET DATE";
                                                                $OrderCompilationDays = ($value->compilation_days > 0) ? $value->compilation_days : "SET DAYS";
                                                                $OrderPriority = ($value->priority > 0) ? $value->priority : "SET Priority";
                                                                $ordercomplete_date1 = (!empty($value->expected_completed_date)) ? _d($value->expected_completed_date) : "";
                                                                $pro_status = "SET STATUS";
                                                                if ($value->order_status_id > 0){
                                                                    $pro_status = value_by_id("tblconfirmorderstatus", $value->order_status_id, "title");
                                                                }

                                                                $challan_info = $this->db->query("SELECT id,production_plan_id,chalanno FROM `tblchalanmst` WHERE (`rel_id`='".$value->id."' OR `rel_id`='".$value->proformachallan_id."') ")->row();
                                                                if (!empty($challan_info)){
                                                                    $challanlink = '<a target="_blank" href="' . admin_url('chalan/pdf/' . $challan_info->id). '" >' .$challan_info->chalanno. '</a>';
                                                                }else{
                                                                    $challanlink = '<span class="btn-sm btn-warning">Pending</span>';
                                                                }

                                                                $invoice_info = $this->db->query("SELECT `id`,`number` from `tblinvoices` where estimate_id = '".$value->id."'")->row();
                                                                $invoice_number = (!empty($invoice_info)) ? '<a target="_blank" href="' . admin_url('invoices/download_pdf/' . $invoice_info->id). '" >' .$invoice_info->number. '</a>':'<span class="btn-sm btn-warning">Pending</span>';
                                                                $proformachallan_number = ($value->proformachallan_id > 0) ? '<a target="_blank" href="' . admin_url('estimates/proformachallan_download_pdf/' . $value->proformachallan_id). '" >' .'PC-'.sprintf("%'.05d\n", $value->proformachallan_id). '</a>':'--';
                                                            if($value->id > 0){
                                                            $sales_person_id = value_by_id_empty("tblleadstaffgroup", $value->group_id,"sales_person_id");
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i++; ?></td>
                                                                <td><?php echo $challanlink; ?></td>
                                                                <td><?php echo '<a target="_blank" href="' . admin_url('estimates/download_pdf/' . $value->id) . '" >' . format_estimate_number($value->id) . '</a>'; ?></td>
                                                                <td><?php echo $invoice_number; ?></td>
                                                                <td><?php echo $proformachallan_number; ?></td>
                                                                <td><?php echo (!empty($sales_person_id)) ? get_employee_fullname($sales_person_id) : '--'; ?></td>

                                                                <td><?php if(!empty($client_info)){ echo cc($client_info->client_branch_name); }else{ echo '--'; } ?></td>
                                                                <td><?php echo _d($value->delivery_date); ?></td>
                                                                <td><a href="javascript:void(0);" class="label label-primary completedate" data-toggle="modal" data-target="#expectedcomplete_date" data-section="2" data-order_id="<?php echo $value->confirm_order_id; ?>" data-id="<?php echo $value->id; ?>" data-expected_date="<?php echo $ordercomplete_date1; ?>"><?php echo $ordercomplete_date; ?></a></td>
                                                                <td><a href="javascript:void(0);" class="label label-primary compilationdays" data-toggle="modal" data-target="#compilation_days_modal" data-section="2" data-order_id="<?php echo $value->confirm_order_id; ?>" data-id="<?php echo $value->id; ?>" data-compilation_days="<?php echo $value->compilation_days; ?>"><?php echo $OrderCompilationDays; ?></a></td>
                                                                <td><a href="javascript:void(0);" class="label label-primary priority_order" data-toggle="modal" data-target="#priorityorder_modal" data-section="2" data-order_id="<?php echo $value->confirm_order_id; ?>" data-id="<?php echo $value->id; ?>" data-priority="<?php echo $value->priority; ?>"><?php echo $OrderPriority; ?></a></td>
                                                                <td>
                                                                    <?php if ($value->complete_status == 1 && $value->order_status_id != '11'){ ?>
                                                                        <span class="label label-success"><?php echo cc($pro_status); ?></span>
                                                                    <?php }else if ($value->order_status_id == '11'){
                                                                        echo '<span class="label label-danger">'.cc($pro_status).'</span>';
                                                                    }else{ ?>
                                                                        <a href="javascript:void(0);" class="label label-success orderconfirm" data-toggle="modal" data-section="2" data-target="#delivery_order_confirm" data-order_id="<?php echo $value->confirm_order_id; ?>" data-id="<?php echo $value->id; ?>" id="order_confirm"><?php echo cc($pro_status); ?></a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php echo _d($value->created_at); ?></td>
                                                                <td class="text-center">

                                                                <div class="btn-group pull-right">
                                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                            <li>
                                                                            <a href="javascript:void(0);" class="orderprocess" data-id="<?php echo $value->id; ?>" data-order_id="<?php echo $value->confirm_order_id; ?>" data-section="2" data-target="#delivery_order_process" id="order_confirm" data-toggle="modal"><i class="fa fa-eye"></i> Order Process </a>
                                                                            <a target="_blank" href="<?php echo admin_url('follow_up/estimates_activity/'. $value->id); ?>"  >Activity</a>
                                                                            <?php
                                                                                if ($value->proformachallan_id > 0){
                                                                                    $chkproductionplan = $this->db->query("SELECT * FROM `tblchalanproductionplan` WHERE `chalan_id`= ".$value->proformachallan_id." AND `ref_type`= '2' ")->row();
                                                                                    if (!empty($chkproductionplan)){
                                                                                ?>
                                                                                        <a target="_blank" style="color:yellowgreen;" href="<?php echo admin_url('Chalan/production_plan_pdf/' . $chkproductionplan->id); ?>" >Production Plan Converted</a>
                                                                                <?php  }else{ ?>
                                                                                        <a target="_blank" href="<?php echo admin_url("chalan/convert_to_productionplan/".$value->proformachallan_id."?ref_type=2");?>" class="btn-with-tooltip" id="production_plan">
                                                                                            Convert To Production Plan
                                                                                        </a>
                                                                                <?php        
                                                                                    }
                                                                                }else if (!empty($challan_info)){
                                                                                    if($challan_info->production_plan_id == 0) { ?>
                                                                                        <a target="_blank" href="<?php echo admin_url("chalan/convert_to_productionplan/".$challan_info->id."?ref_type=1");?>" class="btn-with-tooltip" id="production_plan">
                                                                                            Convert To Production Plan
                                                                                        </a>
                                                                                    <?php }else{ ?>
                                                                                        <a target="_blank" style="color:yellowgreen;" href="<?php echo admin_url('Chalan/production_plan_pdf/' . $challan_info->production_plan_id); ?>" >Production Plan Converted</a>
                                                                                    <?php }
                                                                                }
                                                                        ?>
                                                                            </li>
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
                                    <?php echo form_close(); ?>
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
<div id="expectedcomplete_date" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php
        $attributes = array('id' => 'sub_form_order');
        echo form_open_multipart(admin_url("estimates/order_confirm_status"), $attributes);
        ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Update Order Complete Date </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="estimate_id" class="est_id" value="">
                <input type="hidden" name="confirm_order_id" class="confirmorder_id" value="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" app-field-wrapper="date">
                            <label for="f_date" class="control-label">Expected Date Of Complete </label>
                            <div class="input-group date">
                                <input id="ordercompletedate" required="" name="expected_compalete_date" class="form-control datepicker" value="" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="section" value="cdate">
                <input type="hidden" name="section_id" class="section_id" value="">
                <button type="submit" autocomplete="off" class="btn btn-info">Update</button>
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="compilation_days_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php
        $attributes = array('id' => 'sub_form_order');
        echo form_open_multipart(admin_url("estimates/setOrderCompilationDays"), $attributes);
        ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Set Order Compilation Days </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="estimate_id" class="orderestimate_id" value="">
                <input type="hidden" name="confirm_order_id" class="confirmorder_id" value="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                          <label for="source" class="control-label"> Compilation Days </label>
                          <input type="number" id="order_compilation_days" name="compilation_days" required="" class="form-control" value="" aria-invalid="false">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="section" class="ordersectiontype" value="">
                <input type="hidden" name="section_id" class="section_id" value="">
                <button type="submit" autocomplete="off" class="btn btn-info">Update</button>
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="priorityorder_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php
        $attributes = array('id' => 'sub_form_order');
        echo form_open_multipart(admin_url("estimates/setOrderPriority"), $attributes);
        ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Set Order Priority </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="estimate_id" class="order_estimate_id" value="">
                <input type="hidden" name="confirm_order_id" class="confirmorder_id" value="">
                <div class="row assignprioritydiv">
                    
                    
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="section" class="ordersectiontype" value="">
                <input type="hidden" name="section_id" class="section_id" value="">
                <button type="submit" autocomplete="off" class="btn btn-info">Update</button>
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="delivery_order_confirm" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php
        $attributes = array('id' => 'sub_form_order');
        echo form_open_multipart(admin_url("estimates/order_confirm_status"), $attributes);
        ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Update Order Status </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="estimate_id" class="est_id" value="">
                <input type="hidden" name="confirm_order_id" class="confirmorder_id" value="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="source" class="control-label">Order Status</label>
                            <select class="form-control selectpicker" required="" name="order_status_id" id="order_status_id" data-live-search="true">
                                <option value=""></option>
                                <?php
                                $type_info = $this->db->query("SELECT * FROM `tblconfirmorderstatus`")->result();
                                if (isset($type_info) && count($type_info) > 0) {
                                    foreach ($type_info as $value) {
                                        ?>
                                        <option value="<?php echo $value->id ?>" ><?php echo cc($value->title); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="source" class="control-label">Remark</label>
                            <textarea class="form-control selectpicker" name="remark" id="remark" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="section" value="order_status">
                <input type="hidden" name="section_id" class="section_id" value="">
                <button type="submit" autocomplete="off" class="btn btn-info confirm-btn">Save</button>
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="delivery_order_process" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php
        $attributes = array('id' => 'sub_form_order');
        echo form_open_multipart(admin_url("estimates/confirm_order_process"), $attributes);
        ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Confirm Order Process </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="estimate_id" class="est_id" value="">
                <input type="hidden" name="confirm_order_id" class="confirmorder_id" value="">
                <div class="row">
                    <div class="orderprocessdiv">
                        <div class="col-md-12">
                            <a href="javascript:void(0)" class="addremarkbtn btn btn-success" >Add New Order Process</a>
                            <h4 class="text-center text-danger">Order Process</h4>
                        </div>
                        <div class="orderprocess_div"></div>
                        <div class="col-md-12">
                          <div class="reviseddata_div"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="ordersection" name="sectiontype" value="update_process">
                <input type="hidden" name="section_id" class="section_id" value="">
                <button type="submit" autocomplete="off" class="btn btn-info orderprocess-btn">Confirm</button>
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="revised_orderprocess" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php
        $attributes = array('id' => 'sub_form_order');
        echo form_open_multipart(admin_url("estimates/revised_orderprocess"), $attributes);
        ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Revice Order Process </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="orderprocess_id" class="orderprocess_id" value="">
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group ">
                          <label for="source" class="control-label">Special Remark</label>
                          <input type="text" required=""  name="processname" class="form-control processname" >
                      </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="section_id" class="section_id" value="">
                <button type="submit" autocomplete="off" class="btn btn-info orderprocess-btn">Save</button>
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="add_new_process_name" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php
        $attributes = array('id' => 'sub_form_order');
        echo form_open_multipart(admin_url("estimates/add_new_process_name"), $attributes);
        ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Add New Order Process </h4>
            </div>
            <div class="modal-body">
              <div class="addprocessdiv">
                <input type="hidden" name="estimate_id" class="estimateid" value="">
                <input type="hidden" name="confirm_order_id" class="confirm_order_id" value="">
                <div class="col-md-12">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th scope="col"><i class="fa fa-cog"></i></th>
                              <th scope="col">Special Remark</th>
                          </tr>
                      </thead>
                      <tbody class="input_fields_wrap2">
                          <tr class="row0">
                              <td width="10%"></td>
                              <td>
                                  <input type="hidden" name="orderprocess[0][type]" class="form-control" value="1">
                                  <input type="text" required="" name="orderprocess[0][name]" class="form-control ordertitle0" >
                              </td>
                          </tr>
                        </tbody>
                    </table>
                    <div class="form-group col-md-12"><a href="javascript:void(0);" class="add_field_button2 btn-sm btn-success pull-right" value="0"><i class="fa fa-plus-circle"></i> Add More Remark</a></div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="section_id" class="section_id" value="">
                <button type="submit" autocomplete="off" class="btn btn-info">Save</button>
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
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


<script>

$(document).ready(function() {
    $(".alumininumOrderttl").html('<?php echo number_format($compilation_days1, '2'); ?>');
    $(".fomworkOrderttl").html('<?php echo number_format($compilation_days2, '2'); ?>');
    $(".scaffoldingOrderttl").html('<?php echo number_format($compilation_days3, '2'); ?>');
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                }
            },
            'colvis',
        ]
    } );
    $('#newtable2,#newtable3').DataTable( {

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
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                }
            },
            'colvis',
        ]
    } );

} );
</script>


</body>
</html>


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

  $(document).on("click", ".orderconfirm", function(){
        var id = $(this).data("id");
        $(".est_id").val(id);
        var section_id = $(this).data("section");
        $(".section_id").val(section_id);
        var order_id = $(this).data("order_id");
        $(".confirmorder_id").val(order_id);
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/estimates/getConfirmOrder'); ?>",
            data    : {'estimate_id' : id, 'confirm_order_id': order_id},
            success : function(response){
                if(response != ''){
                    var res=JSON.parse(response);
                    $("#expected_date_of_delivery").val(res.expected_completed_date);
                    $('#order_status_id').val(res.order_status_id);
                    $('#remark').val(res.remark);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        });
//
//        var expected_date = $(this).data("expected_date");
//        $("#expected_date_of_delivery").val(expected_date);
  });

    $(document).on("click", ".completedate", function(){
        var id = $(this).data("id");
        var order_id = $(this).data("order_id");
        $(".confirmorder_id").val(order_id);
        $(".est_id").val(id);
        var section_id = $(this).data("section");
        $(".section_id").val(section_id);

        var expected_date = $(this).data("expected_date");
        $("#ordercompletedate").val(expected_date);
    });

    $(document).on("click", ".compilationdays", function(){
        var id = $(this).data("id");
        var section = $(this).data("section");
        $(".orderestimate_id").val(id);
        $(".ordersectiontype").val(section);
        var section_id = $(this).data("section_id");
        $(".section_id").val(section_id);

        var order_id = $(this).data("order_id");
        $(".confirmorder_id").val(order_id);

        var compilation_days = $(this).data("compilation_days");
        $("#order_compilation_days").val(compilation_days);
    });
    $(document).on("click", ".priority_order", function(){
        var id = $(this).data("id");
        var section = $(this).data("section");
        $(".order_estimate_id").val(id);
        $(".ordersectiontype").val(section);

        var order_id = $(this).data("order_id");
        $(".confirmorder_id").val(order_id);

        var priority = $(this).data("priority");
        $("#order_priority").val(priority);
        
        var section_id = $(this).data("section_id");
        $(".section_id").val(section_id);

        $.ajax({
            type    : "GET",
            url     : "<?php echo site_url('admin/estimates/getOrderPriority'); ?>",
            data    : {'estimate_id' : id, 'priority' : priority},
            success : function(response){
                if(response != ''){
                    $(".assignprioritydiv").html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        });
    });

  $(document).on("click", ".orderprocess", function(){
        var id = $(this).data("id");
        $(".est_id").val(id);
        $(".orderprocess-btn").hide();

        var section_id = $(this).data("section");
        $(".section_id").val(section_id);

        var order_id = $(this).data("order_id");
        $(".confirmorder_id").val(order_id);

        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/estimates/getOrderDeliveryProcess'); ?>",
            data    : {'estimate_id' : id, 'confirm_order_id': order_id},
            success : function(response){
                if(response != ''){
                    $(".orderprocess-btn").show();
                    $(".orderprocess_div").html(response);
                }
            }
        });
  });

 $(document).on("click", ".processcheck", function(){
    var process = $(".process-per").text();
    var total_complete = $(".totalcomplete").val();
    var totalstep = $(".totalstep").val();

    var persent = parseInt(process);
    if($(this).prop("checked") == true){
        total_complete = parseInt(total_complete)+1;
        var percentage =  Math.round((total_complete / totalstep) * 100);
        $(".process-per").html(percentage);
        $(".totalcomplete").val(total_complete);
        $(".progress-bar").css('width', percentage+'%');
    }else{
        total_complete = parseInt(total_complete)-1;
        var percentage = Math.round((total_complete / totalstep) * 100);
        $(".process-per").html(percentage);
        $(".totalcomplete").val(total_complete);
        $(".progress-bar").css('width', percentage+'%');
    }
 });
 $(document).on("click", ".addremarkbtn", function(){
   $("#delivery_order_process").modal("hide");
   $('#add_new_process_name').modal('show');
   var est_id = $(".est_id").val();
   $(".estimateid").val(est_id);
   var section_id = $(this).data("section_id");
    $(".section_id").val(section_id);

    var confirmorder_id = $(".confirmorder_id").val();
    $(".confirm_order_id").val(confirmorder_id)
 });
 $(document).on("click", ".add_field_button2",function(){
     var addmoreproenq = parseInt($(this).attr('value'));
     var newaddmoreproenq = addmoreproenq + 1;
     $(this).attr('value', newaddmoreproenq);

//        $(".input_fields_wrap").append('<div class="row'+newaddmoreproenq+'"><div class="col-md-10 form-group"><input type="text" name="orderprocessname[]" class="form-control"></div><div class="col-md-2"><a class="btn btn-danger" href="#" onclick="removetitle('+newaddmoreproenq+');"><i class="fa fa-remove"></i></a></div></div>');
     $(".input_fields_wrap2").append('<tr class="row'+newaddmoreproenq+'"><td width="5%"><a class="btn btn-danger" href="#" onclick="removetitle('+newaddmoreproenq+');"><i class="fa fa-remove"></i></a></td><td><input type="hidden" name="orderprocess['+newaddmoreproenq+'][type]" value="1" class="form-control"><input type="text" name="orderprocess['+newaddmoreproenq+'][name]" class="form-control"></td></tr>');
     $('.selectpicker').selectpicker('refresh');
 });
 function removetitle(proid)
 {
     $('.row' + proid).remove();
 }
//  $(document).on("click", ".close-model", function(){
//      location.reload();
//  });

 function addmodification(id){
    $("#delivery_order_process").modal("hide");
    $('#revised_orderprocess').modal('show');
    var pname = $(this).data("pname");
    $(".processname").val(pname);
    $(".orderprocess_id").val(id);
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

 function staffdropdown()
    {

        $.each($("#assign option:selected"), function () {

            var select = $(this).val();

            $("optgroup." + select).children().attr('selected', 'selected');

        });

        $('.selectpicker').selectpicker('refresh');

        $.each($("#assign option:not(:selected)"), function () {

            var select = $(this).val();

            $("optgroup." + select).children().removeAttr('selected');

        });

        $('.selectpicker').selectpicker('refresh');

    }
</script>
