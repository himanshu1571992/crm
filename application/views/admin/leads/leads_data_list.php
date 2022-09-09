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
<style>
    fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

.dot {
  height: 25px;
  width: 25px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
}

.circle-blue {
    background-color: #03a9f4;
    text-align: center;
}
.circle-success {
    background-color: #84c529;
    text-align: center;
}
.circle-danger {
    background-color: #fc2d42;
    text-align: center;
}
.circle-warning {
    background-color: #f9d40e;
    text-align: center;
}
.dot > p {
  margin-top: 4px;
  color: #fff;
}
</style>
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row panelHead">
                                <div class="col-md-12">
                                    <h4 class="no-margin"><?php echo $title; if(check_permission_page(3,'create')){ ?> <!-- <a href="<?php echo admin_url('leads/leads'); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">New Lead</a> --> <a href="<?php echo admin_url('leads/new_export_lead'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; margin-right: 10px;"> Export</a> <?php } ?></h4>

                                    <div class="visible-xs">
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-panel-heading">
                            <div class="row">
                                <form id="form-filter" class="form-horizontal">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group ">
                                                <label for="enquiry_type_id" class="control-label">Enquiry Type</label>
                                                <select class="form-control selectpicker" id="enquiry_type_id" name="enquiry_type_id" data-live-search="true">
                                                    <option value="" disabled selected >--Select One-</option>
                                                    <?php
                                                        if(!empty($mainleadtype_info)){
                                                            foreach ($mainleadtype_info as $value) {
                                                    ?>
                                                            <option value="<?php echo $value->id; ?>" <?php if(!empty($search_arr['enquiry_type_id']) && $search_arr['enquiry_type_id'] == $value->id){ echo 'selected';} ?>><?php echo cc($value->name); ?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group ">
                                                <label for="lead_type" class="control-label">Lead Status</label>
                                                <select class="form-control selectpicker" id="lead_type" name="lead_type" data-live-search="true">
                                                    <option value="" disabled selected >--Select One-</option>
                                                    <?php
                                                    if(!empty($leadtype_info)){
                                                        foreach ($leadtype_info as $value) {
                                                        $count_id = $value->id;

                                                        $this->db->where('enquiry_type_id =', $count_id);
                                                        $this->db->where('created_at >', '2021-03-31 23:59:59');
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
                                        <div class="col-md-2">
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
                                            <input type="text" name="lead_no" id="lead_no" class="form-control" value="<?php if(!empty($search_arr['lead_no'])){ echo $search_arr['lead_no']; } ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <label for="customer_company" class="control-label">Customer or Company Name </label>
                                            <input type="text" name="customer_company" id="customer_company" class="form-control" value="<?php if (!empty($search_arr['customer_company'])) { echo $search_arr['customer_company'];} ?>">
                                        </div>
                                        <div class="col-md-4">
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
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-2" app-field-wrapper="date">
                                            <label for="f_amount" class="control-label">From Amount</label>
                                            <div class="input-group">
                                                <input id="f_amount" name="f_amount" class="form-control" value="<?php if(!empty($search_arr['f_amount'])){ echo $search_arr['f_amount']; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-money"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2" app-field-wrapper="date">
                                            <label for="t_amount" class="control-label">To Amount</label>
                                            <div class="input-group">
                                                <input id="t_amount" name="t_amount" class="form-control" value="<?php if(!empty($search_arr['t_amount'])){ echo $search_arr['t_amount']; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-money"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <label for="branch_id" class="control-label">Sales Person</label>
                                                <select class="form-control selectpicker" id="staff_id" multiple name="staff_id[]" data-live-search="true" required="">
                                                    <option value="" disabled="" >--Select One-</option>

                                                    <?php
                                                    if (!empty($sales_person_info)) {
                                                        $select = (!empty($s_staff_id) && ($s_staff_id == "all")) ? 'selected' : '';
                                                        foreach ($sales_person_info as $row) {
                                                            $selected = (!empty($s_staff_id) && in_array($row->sales_person_id, $s_staff_id)) ? 'selected=""':'';
                                                            ?>
                                                            <option value="<?php echo $row->sales_person_id; ?>" <?php echo $selected; ?> ><?php echo cc(get_employee_name($row->sales_person_id)); ?></option>

                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group" style="margin-top: 24px;">
                                                <button type="button" id="btn-filter" class="btn btn-primary">Search</button>
                                                <!-- <button type="button" id="btn-reset" class="btn btn-danger">Reset</button> -->
                                                <a class="btn btn-danger" href="">Reset</a>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                </form>
                                 
                                <div class="col-md-12 table-responsive">
                                <div>
                                    <span class="dot circle-blue"></span> Total Outgoing Calls
                                    <span class="dot circle-success"></span> Total Connecting Calls
                                    <span class="dot circle-danger"></span> Total Missed Calls
                                    <span class="dot circle-warning"></span> Total Activity
                                </div>
                                <hr>
                                    <table id="leadlistTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Lead #</th>
                                                <th width="20%">Customer Name</th>
                                                <th>Quotation</th>
                                                <th width="10%">Enq date</th>
                                                <th width="15%">Contacts</th>
                                                <th>Source</th>                                        
                                                <th>Amount</th>                                        
                                                <th>Sales Person</th>
                                                <th>Followup</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>    
                            </div>    
                        </div>
                    </div>
                </div>
            <?php echo form_close(); ?>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
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
<script src="<?php  echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
<script>

$(document).ready(function() {
    
    table = $('#leadlistTable').DataTable({ 
        // "dom": 'lBfrtip',
        // "buttons": [
        //     {
        //         extend: 'excel',
        //         exportOptions: {
        //             columns: [ 0, 1, 2, 3, 4, 5, 6 ]
        //         }
        //     },
        //     {
        //         extend: 'pdf',
        //         exportOptions: {
        //              columns: [ 0, 1, 2, 3, 4, 5, 6 ]
        //         }
        //     },
        //     {
        //         extend: 'print',
        //         exportOptions: {
        //             columns: [ 0, 1, 2, 3, 4, 5, 6 ]
        //         }
        //     },
        // ],
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "pageLength": 25,
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo admin_url('leads/lead_ajax_list')?>",
            "type": "POST",
            "data": function ( data ) {
                data.enquiry_type_id = $("#enquiry_type_id").val();
                data.lead_type = $('#lead_type').val();
                data.lead_source = $('#lead_source').val();
                data.state = $('#state').val();
                data.city = $('#city').val();
                data.lead_no = $('#lead_no').val();
                data.customer_company = $('#customer_company').val();
                data.client_id = $('#client_id').val();
                data.f_date = $('#f_date').val();
                data.t_date = $('#t_date').val();
                data.f_amount = $('#f_amount').val();
                data.t_amount = $('#t_amount').val();
                data.staff_id = $('#staff_id').val();
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
        ],

    });
    $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
    });
    // $('#btn-reset').click(function(){ //button reset event click
    //     // $('#form-filter')[0].reset();
    //     table.ajax.reload();  //just reload table
    // });
});



</script>
<script>
   $(function(){

     
     /*$.ajax({
            type    : "GET",
            url     : "<?php echo base_url(); ?>admin/leads/get_lead_totalamount",
            success : function(response){
                $('.ttlleadamt_count').html(response);  
            }
        });*/

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
        // location.reload(true);
        table.ajax.reload();
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
    //    location.reload(true);
       table.ajax.reload();
    });
}
function change_lead_main_status(enquiry_type_id, type_id, lead_id) {
    var data = {};
    data.type = type_id;
    data.leadid = lead_id;
    data.enquiry_type_id = enquiry_type_id;
        $.post('<?php echo base_url(); ?>admin/leads/update_lead_main_status', data).done(function(response) {
            
            if (response != ""){
                var obj = jQuery.parseJSON(response);
                $(".enquirymaintype"+lead_id).html(obj["main_status"]);
                $(".enquirytype"+lead_id).html(obj["sub_status"]);
            }
    //    location.reload(true);
       table.ajax.reload();
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

  $(document).on("change", "#enquiry_type_id", function(){
        var main_enquiry_id = $(this).val();
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url(); ?>admin/leads/get_lead_subtype",
            data    : {'type_id' : main_enquiry_id},
            success : function(response){
                $("#lead_type").html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        });
  });
</script>
</body>
</html>
