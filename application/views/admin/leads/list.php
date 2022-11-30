
<?php init_head(); ?>

<style type="text/css">

    .ui-table > thead > tr > th {
        color: #fff !important;
        background:#6d7580;
    }

    .ui-table > tbody > tr > td{
        border: 1px solid #c7c7c7;
        color:#5f6670;
    }

    .ui-table > tbody > tr:nth-child(even) {
      background: #f8f8f8;
    }

    .actionBtn {
        border: 1px solid #2196F3;
        padding: 5px;
        border-radius: 3px;
        background: #2196F3;
        color: #fff;
        margin-right: 3px;
        margin-bottom: 3px;
        display: inline-block;
        font-size: 12px;
    }

    .actionBtn:hover {
        border: 1px solid #2196F3;
        background:#51647c;
        color:#fff;
    }

    .delete-btn{
        border: 1px solid #f33224;
        padding: 5px;
        border-radius: 3px;
        background: #f33224;
        color: #fff;
        margin-right: 3px;
        margin-bottom: 3px;
        display: inline-block;
        font-size: 12px;
    }

    .delete-btn:hover{
        color: #fff;
    }

    .staus_process {
        display: inline-block;
        color: #fff;
        padding: 8px 15px;
        font-size: 14px;
        box-shadow: 0px 3px 8px #ccc;    
        display: block;
        margin: 5px;
    }
     .scroll {
        width:200px;
        max-height:450px;
        overflow-y:auto;
}
.dropdown-menu-right {
    right: auto;
    left: 0;
}
</style>
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
<?php
if(!empty($this->session->userdata('lead_search'))){
    $search_arr = $this->session->userdata('lead_search');
}    
?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin">Lead List <?php if(check_permission_page(3,'create')){ ?> <a href="<?php echo admin_url('leads/leads'); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">New Lead</a> <a href="<?php echo admin_url('leads/export_lead'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; margin-right: 10px;"> Export</a> <?php } ?></h4>

                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div >
                        <div class="row col-md-12">

                        <div class="col-md-3">
                            <div class="form-group ">
                                <label for="lead_type" class="control-label">Lead Status</label>
                                <select class="form-control selectpicker" id="lead_type" name="lead_type" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($leadtype_info)){
                                        foreach ($leadtype_info as $value) {
                                           $count_id = $value->id;

                                           $this->db->where('enquiry_type_id =', $count_id);
                                            $query = $this->db->get('tblleads');
                                            $count = $query->num_rows();
                                           
                                            ?>
                                            <option value="<?php echo $value->id; ?>" <?php if(!empty($search_arr['lead_type']) && $search_arr['lead_type'] == $value->id){ echo 'selected';} ?>><?php echo cc($value->name)." "."(".$count.")"; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group ">
                                <label for="lead_source" class="control-label">Lead Source</label>
                                <select class="form-control selectpicker" id="lead_source" name="lead_source" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($sources_info)){
                                        foreach ($sources_info as $value) {
                                            ?>
                                            <option value="<?php echo $value->id; ?>" <?php if(!empty($search_arr['lead_source']) && $search_arr['lead_source'] == $value->id){ echo 'selected';} ?>><?php echo cc($value->name); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                         <!-- <div class="col-md-2" >
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Lead Status</label>
                                <select class="form-control selectpicker" id="status" name="status" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <option value="1" <?php if(!empty($search_arr['status']) && $search_arr['status'] == 1){ echo 'selected';} ?>>Qualified</option>
                                    <option value="2" <?php if(!empty($search_arr['status']) && $search_arr['status'] == 2){ echo 'selected';} ?>>Unqualified</option>
 
                                </select>
                            </div>
                        </div> -->

                        <div class="col-md-2">
                            <div class="form-group ">
                                <label for="state" class="control-label">Site State</label>
                                <select class="form-control selectpicker" id="state" name="state" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($state_info)){
                                        foreach ($state_info as $value) {
                                            ?>
                                            <option value="<?php echo $value->id; ?>" <?php if(!empty($search_arr['state']) && $search_arr['state'] == $value->id){ echo 'selected';} ?>><?php echo cc($value->name); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group ">
                                <label for="city" class="control-label">Site City</label>
                                <select class="form-control selectpicker" id="city" name="city" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($city_info)){
                                        foreach ($city_info as $value) {
                                            ?>
                                            <option value="<?php echo $value->id; ?>" <?php if(!empty($search_arr['city']) && $search_arr['city'] == $value->id){ echo 'selected';} ?>><?php echo cc($value->name); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-2">
                            <label for="lead_no" class="control-label">Lead No.</label>
                            <input type="text" name="lead_no" class="form-control" value="<?php if(!empty($search_arr['lead_no'])){ echo $search_arr['lead_no']; } ?>">
                       </div>   
                        </div>
                                            
                        <div class="row col-md-12">
                            <div class="col-md-3">
                                <label for="customer_company" class="control-label">Customer or Company Name </label>
                                <input type="text" name="customer_company" class="form-control" value="<?php if (!empty($search_arr['customer_company'])) {echo $search_arr['customer_company'];} ?>">
                            </div> 
                            <div class="col-md-3">
                            <div class="form-group ">
                                <label for="Existing Client" class="control-label">Existing Client</label>
                                <select class="form-control selectpicker" id="client_id" name="client_id" data-live-search="true">
                                    <option value="" disabled selected ></option>
                                    <?php
                                    if(!empty($client_list)){
                                        foreach ($client_list as $value) {
                                            ?>
                                            <option value="<?php echo $value->userid; ?>" <?php if(!empty($search_arr['client_id']) && $search_arr['client_id'] == $value->userid){ echo 'selected';} ?>><?php echo cc($value->client_branch_name); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-2" app-field-wrapper="date">
                            <label for="f_date" class="control-label">From Date</label>
                            <div class="input-group date">
                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($search_arr['f_date'])){ echo $search_arr['f_date']; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="form-group col-md-2" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($search_arr['t_date'])){ echo $search_arr['t_date']; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                       

                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="process" class="control-label">Lead Process</label>
                                <select class="form-control selectpicker" data-live-search="true" id="process" name="process[]" multiple="">
                                    <option value=""></option>
                                    <?php
                                    if (!empty($leadprocess)) {
                                        foreach ($leadprocess as $r) {
                                            ?>
                                            <option value="<?php echo $r->id ?>" <?php if(!empty($search_arr['process']) && in_array($r->id, $search_arr['process']) ){ echo 'selected';} ?>><?php echo $r->name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> -->
                                               

                          

                       
                        <div class="col-md-2">                            
                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                            <a href=""><button type="submit" value="1" name="reset" style="margin-top: 24px;" class="btn btn-danger">Reset</button></a>
                        </div>
                       
                   </div>
                       
                    </div>
                                                
                    <div class="col-md-12"> 

                        <?php
                        if(is_admin() == 1){
                        ?>
<!--                        <div class="row" style="margin-top: 15px;">
                             <div class="col-md-4">
                                <h4 style="color: red;">Qualified Lead : <?php echo $lead_data['qualified_count']; ?></h4>
                            </div>
                            <div class="col-md-4">
                                <h4 style="color: red;">Unqualified Lead : <?php echo $lead_data['unqualified_count']; ?></h4>
                            </div> 
                            <div class="col-md-4">
                                <h4 style="color: red;">Total Amount : <?php echo number_format($lead_data['ttl_amount'], 2); ?></h4>
                            </div>
                        </div>-->
                        <!-- <div>
                            <fieldset class="scheduler-border"><br>
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <h4 style="color: red; text-align: center;" class="control-label">Total Amount</h4>
                                            <p style="color: red; text-align: center;"><?php echo number_format($lead_data['ttl_amount'], 2); ?></p>
                                        </div>
                                </div>
                            </fieldset>
                        </div>  -->  
                        <?php    
                        }
                        ?>  
                        
                        
                        <div class="table-responsive" style="overflow: auto;">
                        <table class="table ui-table">
                            <thead>
                              <tr>
                                <th>S.No</th>
                                <th>Lead #</th>
                                <th>Customer Name</th>
                                <th>Quotation</th>
                                <th>Enq date</th>
                                <th>Contacts</th>
                                <th>Source</th>                                        
                                <th>Amount</th>                                        
                                <th>Created</th>
                                <th>Followup</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($lead_list)){
                                foreach ($lead_list as $key => $value) {

                                    $client_info = $this->db->query("SELECT * FROM tblclientbranch WHERE userid = '".$value->client_branch_id."' ")->row();

                                    if($value->client_branch_id > 0){
                                        $company = $client_info->client_branch_name;
                                    }else{
                                        $company = $value->company;
                                    }

                                    if(check_quotation($value->id) == 1){
                                        $quotation = 'Yes';
                                    }else{
                                        $quotation = 'No';
                                    }

                                    $checked = ($value->followup == 1 ) ? 'checked' : '';
                                    $toggleActive = '<div class="onoffswitch">
                                        <input type="checkbox" data-switch-url="' . admin_url() . 'leads/change_followup_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $value->id . '" data-id="' . $value->id . '" ' . $checked . '>
                                        <label class="onoffswitch-label" for="' . $value->id . '"></label>
                                    </div>';

                                    $contact_info = $this->db->query("SELECT c.id from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$value->id."' and c.phonenumber != '' ")->row();

                                    //getting last quotation amount
                                    $quotation_info = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '".$value->id."' order by id desc  ")->row();
                                    if(!empty($quotation_info)){
                                        $amount = $quotation_info->total;
                                    }else{
                                        $amount = '0.00';
                                    }

                                    $status = $this->db->query("SELECT * from `tblleadsstatus` where id = '".$value->status."' ")->row_array();
                                    $type = $this->db->query("SELECT * from `tblenquirytypemaster` where id = '".$value->enquiry_type_id."' ")->row_array();


                                    /*$outputStatus = '<span class="inline-block label label-' . (empty($status['color']) ? 'default': '') . '" style="color:' . $status['color'] . ';border:1px solid ' . $status['color'] . '">' . $status['name'];
                                        $outputStatus .= '<div class="dropdown inline-block mleft5 table-export-exclude">';
                                        $outputStatus .= '<a href="#" style="font-size:14px;vertical-align:middle;" class="dropdown-toggle text-dark" id="tableLeadsStatus-' . $value->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                        $outputStatus .= '<span data-toggle="tooltip" title="' . _l('ticket_single_change_status') . '"><i class="fa fa-caret-down" aria-hidden="true"></i></span>';
                                        $outputStatus .= '</a>';

                                        $outputStatus .= '<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="tableLeadsStatus-' . $value->id . '">';
                                        foreach ($status_info as $leadChangeStatus) {
                                            if ($value->status != $leadChangeStatus['id']) {
                                                $outputStatus .= '<li>
                                              <a href="#" onclick="lead_mark_as(' . $leadChangeStatus['id'] . ',' . $value->id . '); return false;">
                                                 ' . $leadChangeStatus['name'] . '
                                              </a>
                                           </li>';
                                            }
                                        }
                                        $outputStatus .= '</ul>';
                                        $outputStatus .= '</div>';
                                    $outputStatus .= '</span>';*/



                                    $outputType = '<div class="enquirytype'.$value->id.'"><span class="inline-block label label-' . (empty($type['color']) ? 'default': '') . '" style="color:' . $type['color'] . ';border:1px solid ' . $type['color'] . '">' . $type['name'];
                                        $outputType .= '<div class="dropdown inline-block mleft5 table-export-exclude">';
                                        $outputType .= '<a href="#" style="font-size:14px;vertical-align:middle;" class="dropdown-toggle text-dark" id="tableLeadsStatus-' . $value->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                        $outputType .= '<span data-toggle="tooltip" title="' . _l('ticket_single_change_status') . '"><i class="fa fa-caret-down" aria-hidden="true"></i></span>';
                                        $outputType .= '</a>';

                                        $outputType .= '<ul class="dropdown-menu dropdown-menu-right scroll" aria-labelledby="tableLeadsStatus-' . $value->id . '">';
                                        foreach ($leadtype_info as $leadChangeType) {
                                            if ($value->enquiry_type_id != $leadChangeType->id) {
                                                $outputType .= '<li>
                                              <a href="#" onclick="change_lead_type('.$value->enquiry_type_id.',' . $leadChangeType->id . ',' . $value->id . '); return false;">
                                                 ' . cc($leadChangeType->name) . '
                                              </a>
                                           </li>';
                                            }
                                        }
                                        $outputType .= '</ul>';
                                        $outputType .= '</div>';
                                    $outputType .= '</span></div>';

                                ?>
                                <tr>
                                    <td><?php echo ++$key; ?></td>                                                
                                    <td>
                                        <?php //echo '<a href="'.admin_url('leads/index/' . $value->id).'" onclick="init_lead(' . $value->id . ');return false;"> LEAD-'.number_series($value->id).'</a>'; ?>
                                        <?php 
                                            echo '<a target="_blank" href="'.admin_url('leads/lead_profile/' . $value->id).'"> LEAD-'.number_series($value->id).'</a>';
                                           
                                        ?>

                                    </td>
                                    <td><?php echo cc($company);  echo '<br/>';
                                            //echo $outputStatus;
                                            echo $outputType; ?></td>
                                    <td><?php echo $quotation; ?></td>                                            
                                    <td><?php echo _d($value->enquiry_date); ?></td> 
                                    <td><?php if(!empty($contact_info)){ ?><a target="_blank" href="<?php echo admin_url('leads/lead_contact/'.$value->id); ?>"><img src="https://schachengineers.com/schacrm/assets/images/make_call.png" width="35" height="35"></a><?php  }else{ echo '--'; }    cc(value_by_id('tblenquirytypemaster',$value->enquiry_type_id,'name')); ?></td>
                                    <td><?php echo value_by_id('tblleadssources',$value->source,'name'); ?></td>
                                    <td><?php echo $amount; ?></td>
                                    <!-- <td>
                                    <?php
                                    if($value->status == 1){
                                        echo '<button type="button" class="btn btn-info lead_process" style="width: 110px;" data-toggle="modal" data-target="#statusModal" value="'.$value->id.'">Qualified</button>';
                                    }else{
                                        echo '<button class="btn btn-ganger" disabled="" style="width: 110px;">Unqualified</button>';
                                    }
                                    ?>       

                                    </td> -->
                                    <td><?php echo _d($value->dateadded); ?></td>
                                    <td><?php echo $toggleActive; ?></td>
                                    <td>
                                        <?php 
                                            $leadstatus = value_by_id("tblleadprocess", $value->process_id, "name");
                                            if ($value->process_id == 6){
                                                $leadstatus = '<a href="javascript:void(0);" data-remark="'.cc($value->lost_remark).'" class="lostremark" data-target="#showlostremark" data-toggle="modal">'.$leadstatus.'</a>';
                                            }
                                            echo $leadstatus; 
                                        ?>
                                    </td>
                                    <td class="text-center">

                                        <?php
                                        $client_text = ($value->client_branch_id > 0) ? 'Update Client' : 'Make Client';
                                        $client_btn = ($value->client_branch_id > 0) ? 'btn-update' : 'btn-update';
                                        
                                        ?>

                                        <div class="btn-group pull-right">
                                             <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                             </button>
                                             <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                <li>
                                                   <?php if(check_permission_page(3,'edit')){ ?>
                                                    <a href="<?php echo admin_url('leads/leads/' . $value->id); ?>" class="" title="Edit">Edit</a>

                                                    <?php }
                                                    if(!empty($contact_info)){ ?><a target="_blank" href="<?php echo admin_url('leads/lead_contact/'.$value->id); ?>">Lead Contact</a><?php }
                                                    echo '<a target="_blank" class="" href="'.admin_url('follow_up/lead_activity/'.$value->id).'" title="Active">Activity</a>';
                                                    echo '<button type="button" class="'.$client_btn.' update_client" data-toggle="modal" data-target="#clientModal" value="'.$value->id.'">'.$client_text.'</button>'; 
                                                    

                                                    if(check_permission_page(3,'delete')){ ?>
                                                    <a href="<?php echo admin_url('leads/delete/' . $value->id); ?>" class="_delete" title="Delete">Delete</a>
                                                    <?php } ?>
                                                    <a href="javascript:void(0);" class="btn-with-tooltip lead-email" data-id="<?php echo $value->id; ?>"  data-target="#lead_send_to_customer" id="send_mail" data-toggle="modal">
                                                        <span data-toggle="tooltip" class="btn-with-tooltip" data-title="Send to Email" data-placement="bottom" data-original-title="" title="">Send to Email</span>
                                                    </a>
                                                    <?php 
                                                    if ($value->process_id < 6) {?>
                                                        <a href="javascript:void(0);" class="btn-with-tooltip lost-leads btn btn-danger" data-id="<?php echo $value->id; ?>"  data-target="#lead_lost" id="lost_lead_remark" data-toggle="modal">
                                                            <span data-toggle="tooltip" class="btn-with-tooltip" data-title="Lost Lead" data-placement="bottom" data-original-title="" title="">Lost Lead</span>
                                                        </a>
                                                    <?php } ?>
                                                </li>
                                             </ul>
                                        </div>
                                    </td>
                                  </tr>
                                <?php
                                }
                            }
                            ?>
                             
                            </tbody>
                          </table>
                        </div>

                        <div class="pagination">
                            <?php echo $this->pagination->create_links(); ?>
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


<!-- Modal -->
<!-- <div id="statusModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lead Process</h4>
      </div>
      <form  action="<?php echo admin_url('leads/update_process'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Update</button>
      </div>
      </form>
    </div>

  </div>
</div> -->

<div id="clientModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Client</h4>
      </div>
      <div class="modal-body">
        
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="lead_lost" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <?php
        $attributes = array('id' => 'sub_form_lost_lead');
        echo form_open(admin_url("leads/lost_leads"), $attributes);
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lost Lead</h4>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label for="drawing" class="control-label">Remark</label>
                <input type="hidden" name="lead_id" class="lead_id" value="">
                <textarea class="form-control" rows="4" id="lost_remark" name="lost_remark" required=""></textarea>
                <div class="lost_remark_msg"></div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
        <button type="submit" autocomplete="off"  class="btn btn-info lost-lead-subbtn">Send</button>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>
<div id="showlostremark" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lost Lead Remark</h4>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <div class="content-remark"></div>
            </div>
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
        echo form_open_multipart(admin_url("leads/send_to_email"), $attributes);
        ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Send Leads To Client</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="lead_id" class="lead_id" value="">
                <div class="row">
                    <?php 
                        $staff_data = get_employee_info(get_staff_user_id());
                    ?>
                    <?php echo render_input('from_email', 'From Email', $staff_data->email, 'email', array(), [], 'form-group col-md-6'); ?>
                    <?php echo render_input('from_name', 'From Name', $staff_data->firstname.' '.$staff_data->lastname, 'text', array(), [], 'form-group col-md-6'); ?>
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
                            echo render_select('staff_cc[]',$staff_list,array('email','email','firstname'),'', array(),array('multiple'=>true),array(),'','',false);
                        ?>
                    </div>
                    <?php echo render_input('cc', 'CC', '', 'text', [], [], 'form-group col-md-6'); ?>
                    
                </div>
                <?php
                    $template_list = $this->db->query("SELECT id, template_name FROM tblemailmoduletemplate WHERE module_id = 1 AND status = 1")->result();
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
                array_push($editors, 'message');
                ?>
                <!--<div class="form-group" app-field-wrapper="message"><textarea  required="" name="message[]" class="form-control tinymce tinymce-manual template-message" data-url-converter-callback="myCustomURLConverter" rows="4" ></textarea></div>-->
                <?php echo render_textarea('message', '', '', array('rows' => 4, 'class' => 'tinymce tinymce-manual'), array(), '', 'tinymce tinymce-manual'); ?>
                <?php echo form_hidden('template_name', "leads"); ?>
                <div class="module_attech"></div>
                <div class="form-group">
                    <label for="drawing" class="control-label">File</label>
                    <input type="file" id="filer_input2" class="form-control"  name="attach_files[]" multiple="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
                <button type="submit" autocomplete="off"  class="btn btn-info">Send</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php init_tail(); ?>

<script src="<?php  echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
</body>
</html>


<!-- <script type="text/javascript">
$(document).on('click', '.lead_process', function() { 
    var lead_id = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/leads/get_lead_process",
        data    : {'lead_id' : lead_id},
        success : function(response){
            if(response != ''){
                $('.modal-body').html(response);
            }
        }
    })
}); 
</script> -->
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
       $('.lead-email').on('click', function(e) {
      e.preventDefault();
        var lead_id = $(this).data("id");
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url(); ?>admin/leads/get_client_list",
            data    : {'lead_id' : lead_id},
            success : function(response){
                $(".client_list").html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        });
        $(".lead_id").val(lead_id);
        $("#cc").val("");
        $(".module_template").html('<label for="module_id" class="control-label">Select Template</label><select class="form-control selectpicker" required="" data-live-search="true" id="module_template_id" name="module_template_id"><option value=""></option><?php if (isset($template_list) && count($template_list) > 0) {foreach ($template_list as $template) {?><option value="<?php echo $template->id; ?>"><?php echo cc($template->template_name); ?></option><?php } }?></select>');
        $('.selectpicker').selectpicker('refresh');
        tinymce.activeEditor.execCommand('mceSetContent', false, "");
        $(".module_attech").html("");
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
$(document).on('click', '.update_client', function() { 
    var lead_id = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/leads/get_lead_client_model",
        data    : {'lead_id' : lead_id},
        success : function(response){
            if(response != ''){
                $('.modal-body').html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        }
    })
}); 
</script>

<script type="text/javascript">
$(document).on('click', '.process', function() { 

    var lead_id = $(this).attr('val');
    var value = $(this).val();
    
    if($(this).is(":checked")){
        $(this).parent('p').css("background-color", "#46A049");
        
        if(value == 12){
            $('#notintrestdiv'+lead_id).show();
        }

    }else{
        $(this).parent('p').css("background-color", "#757575");
        if(value == 12){
           $('#notintrestdiv'+lead_id).hide(); 
           $('#notintrestrmkdiv'+lead_id).hide(); 
        }
    }
}); 
</script> 

<script type="text/javascript">
    function check_other_remark(lead_id,value) {
        if(value == 6){
            $('#notintrestrmkdiv'+lead_id).show(); 
        }else{
           $('#notintrestrmkdiv'+lead_id).hide();  
        }
    }
</script>

<script type="text/javascript">
    function lead_mark_as(status_id, lead_id) {
    var data = {};
    data.status = status_id;
    data.leadid = lead_id;
    $.post('<?php echo base_url(); ?>admin/leads/update_lead_status', data).done(function(response) {
        location.reload(true);
    });
}
</script>

<script type="text/javascript">
    function change_lead_type(enquiry_type_id, type_id, lead_id) {
    var data = {};
    data.type = type_id;
    data.leadid = lead_id;
    data.enquiry_type_id = enquiry_type_id;
    $.post('<?php echo base_url(); ?>admin/leads/update_lead_type', data).done(function(response) {
        if (response != ""){
            $(".enquirytype"+lead_id).html(response);
        }
//        location.reload(true);
    });
}

$(document).on("click", ".lost-leads", function(){
    var lead_id = $(this).data("id");
    $(".lead_id").val(lead_id);
});

$(document).on("click", ".lost-lead-subbtn", function(e){
    e.preventDefault();
    
    if ($("#lost_remark").val() == ""){
        $(".lost_remark_msg").html("<p class='text-danger'> Remark is required </p>")
    }else{
        $("#sub_form_lost_lead").submit();
    }
});

$(document).on("click", ".lostremark", function(e){
    var remark = $(this).data("remark");
    $(".content-remark").html(remark);
});
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
