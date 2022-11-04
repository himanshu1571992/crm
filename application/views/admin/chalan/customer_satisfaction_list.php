
<?php init_head(); ?>
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />
<style type="text/css">

    .ui-table > thead > tr > th {
        border:1px solid #9d9d9d !important;
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

</style>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title; ?> <a class="btn btn-info pull-right" href="<?php echo admin_url('chalan/customer_satisfaction_report'); ?>" target="_blank">Coustomer Feedback </a></h4>

                    <hr class="hr-panel-heading">

                    <div class="row">

                    <div>
                        <div class="col-md-4" id="employee_div">
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
                        <div class="col-md-2">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Service Type</label>
                                <select class="form-control selectpicker" id="service_type" name="service_type" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <option value="1" <?php if(!empty($service_type) && $service_type == 1){ echo 'selected';} ?>>Rent</option>
                                    <option value="2" <?php if(!empty($service_type) && $service_type == 2){ echo 'selected';} ?>>Sale</option>
                                </select>
                            </div>
                        </div>


                        <!-- <div class="col-md-2">
                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                            <button type="submit" value="1" name="reset" style="margin-top: 24px;" class="btn btn-danger">Reset</button>
                        </div> -->

                        <div class="col-md-2">
                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                            <a class="btn btn-danger" style="margin-top: 24px;" href="">Reset</a>
                        </div>

                    </div>

                    <div class="col-md-12">
                        <hr>
                    </div>

                    <div class="col-md-12 table-responsive">
                        <table class="table" id="newtable">
                            <thead>
                              <tr>
                                <th>S.No</th>
                                <th>Challan #</th>
                                <th>Sales Parson Name</th>
                                <th>Service Type</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th class="text-center">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($invoice_list)){
                                foreach ($invoice_list as $key => $value) {

                                     $client_info = $this->db->query("SELECT `email_id`,`client_branch_name` from `tblclientbranch` where userid = '".$value->clientid."'  ")->row();

                                     $delivery_ho = $this->db->query("SELECT * FROM `tblchallanprocess` WHERE `chalan_id` = '".$value->id."' and `for` = 1 ")->row();
                                     $pickup_ho = $this->db->query("SELECT * FROM `tblchallanprocess` WHERE `chalan_id` = '".$value->id."' and `for` = 2 ")->row();

                                     $show_satification = 0;
                                     if($value->process == 1 && $value->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 1 && $value->service_type == 2){
                                         $show_satification = 1;
                                     }elseif($value->process == 1 && $value->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 1){
                                         $show_satification = 1;
                                     }elseif($value->process == 2 && $value->under_process == 0 && $pickup_ho->complete == 1 && $pickup_ho->final_complete == 1){
                                         $show_satification = 1;
                                     }
                                     
                                     if ($show_satification == 1){

                                        /* this code use for get sales parson name */
                                        $sales_parson_name = '--';
                                        switch ($value->rel_type) {
                                            case 'proforma_challan':
                                                $estimate_id = value_by_id_empty("tblproformachalan", $value->rel_id, "rel_id");
                                                if (!empty($estimate_id)){
                                                    $lead_id = value_by_id_empty("tblestimates", $estimate_id, "lead_id");
                                                    $leadstaff = $this->db->query("SELECT `staff_id` FROM `tblleadassignstaff` WHERE `lead_id` = ".$lead_id." AND `type` = 2")->row();
                                                    if (!empty($leadstaff)){
                                                        $sales_parson_name = get_staff_full_name($leadstaff->staff_id);
                                                    }
                                                }
                                                break;
                                            default:
                                                $lead_id = value_by_id_empty("tblestimates", $value->rel_id, "lead_id");
                                                $leadstaff = $this->db->query("SELECT `staff_id` FROM `tblleadassignstaff` WHERE `lead_id` = ".$lead_id." AND `type` = 2")->row();
                                                if (!empty($leadstaff)){
                                                    $sales_parson_name = get_staff_full_name($leadstaff->staff_id);
                                                }
                                                # code...
                                                break;
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo ++$key; ?></td>
                                        <td><?php echo '<a target="_blank" href="' . site_url('admin/chalan/view/' . $value->id). '" >' .$value->chalanno. '</a>'; ?></td>
                                        <td><?php echo $sales_parson_name; ?></td>
                                        <td><?php echo ($value->service_type == 1) ? 'Rent' : 'Sale'; ?></td>
                                        <td><a href="<?php echo admin_url('clients/client/'.$value->clientid); ?>" target="_blank"><?php echo cc($client_info->client_branch_name); ?></a></td>
                                        <td><?php echo _d($value->challandate); ?></td>
                                        <td class="text-center">
                                        <?php

                                            if($value->send_satisfaction_link == 0){ ?>
                                                <a href="javascript:void(0);" class="btn-sm btn-info btn-with-tooltip cust-satifaction" data-id="<?php echo $value->id; ?>" data-cname="<?php echo $client_info->email_id; ?>"  data-target="#custsatifaction" id="customer-satifaction" data-toggle="modal">
                                                    Mail Satisfaction Form
                                                </a>
                                            <?php }elseif($value->send_satisfaction_link == 1){ ?>
                                                <a class="btn-sm btn-success" href="javascript:void(0);" >Satisfaction form already sent</a>
                                            <?php } ?>
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
<div id="deliveryModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title action_title"></h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo admin_url('Chalan/make_delivery'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="row">

        	<div class="form-group col-md-6">
                <label for="priority" class="control-label">Priority *</label>
                <select class="form-control selectpicker" name="priority" required="">
                    <option value=""></option>
                    <option value="1">Low</option>
					<option value="2">Medium</option>
					<option value="3">High</option>
					<option value="4">Urgent</option>
                </select>
            </div>

            <div class="form-group col-md-6" app-field-wrapper="date">
                <label for="delivery_date" class="control-label" id="date_type">Delivery Date</label>
                <div class="input-group date">
                    <input id="delivery_date" name="delivery_date" class="form-control datepicker" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="branch_id" class="control-label">Select Branch *</label>
                <select class="form-control selectpicker" name="branch_id" required="">
                    <option value=""></option>
                    <?php
                    if(!empty($branch_info)){
                        foreach ($branch_info as $branch) {
                            ?>
                            <option value="<?php echo $branch->id; ?>"><?php echo $branch->comp_branch_name; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="name" class="control-label">Description </label>
                <textarea id="description" name="description" class="form-control"><?php echo (isset($event['description']) && $event['description'] != "") ? $event['description'] : "" ?></textarea>
            </div>

            <input type="hidden" id="chalan_id" name="chalan_id">
            <input type="hidden" id="for" name="for">
        </div>

        <div class="text-right">
            <button class="btn btn-info" type="submit">Submit</button>
        </div>

    	</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="send_mainto_customer" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <?php
        $attributes = array('id' => 'sub_form_product');
        echo form_open_multipart(admin_url("chalan/challan_send_to_mail"), $attributes);
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Send challan to client </h4>
      </div>
      <div class="modal-body">
          <input type="hidden" name="challan_id" class="challan_id" value="">
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
            $template_list = $this->db->query("SELECT id, template_name FROM tblemailmoduletemplate WHERE module_id = 6 AND status = 1")->result();
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
        <?php echo render_textarea('message','', '',array('rows' => 4, 'class' => 'tinymce tinymce-manual'),array(),'','tinymce tinymce-manual'); ?>
        <?php echo form_hidden('template_name',"challan"); ?>
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
<div id="custsatifaction" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Send satisfaction form to customer </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form  action="<?php echo admin_url('chalan/satisfaction_email'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="module_id" class="control-label">Client </label>
                                    <?php
                                    $client_list = $this->db->query("SELECT `email_id`,`client_branch_name` FROM `tblclientbranch` WHERE active = 1 AND email_id !='' ")->result();
                                    ?>
                                    <select class="form-control selectpicker" disabled="" data-live-search="true" id="client_name" name="client_email_id">
                                        <option value=""></option>
                                        <?php
                                            if (!empty($client_list)){
                                                foreach ($client_list as $value) {
                                        ?>
                                        <option value="<?php echo $value->email_id; ?>"><?php echo $value->client_branch_name; ?></option>';
                                        <?php   }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="subject" class="control-label">Client Email <span style="color: red;">*</span></label>
                                    <input type="text" id="client_email" name="client_email_id" class="form-control" required="" value="">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="subject" class="control-label">Subject <span style="color: red;">*</span></label>
                                    <input type="text" id="subject" name="subject" class="form-control" required="" value="Customer Satisfaction Survey Form">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">Email Body <span style="color: red;">*</span></label>
                                    <textarea class="form-control tinymce " required="" name="message" id="message">
                                        <h3>Welcome to SCHACH ENGINEERS PVT. LTD.</h3>
                                        <p>Click on the below link to fill the satisfaction form against material delivery </p>
                                        <p><a href="#link#">Click for Review</a></p>
                                    </textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="challan_id" class="delivery_challan_id">
                                    <button class="btn btn-info" type="submit">Send Email</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
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
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            'colvis',
        ]
    } );

    $(".cust-satifaction").on("click", function(){
        var cname = $(this).data("cname");
        var challanid = $(this).data("id");
        $(".delivery_challan_id").val(challanid);
        $("#client_email").val(cname);
        $('#client_name option[value="'+cname+'"]').attr("selected", "selected");
        $('.selectpicker').selectpicker('refresh');
    });
} );
</script>

</body>
</html>


<!-- Modal -->
<div id="handover_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title handover_title">Delivery Hand Overs</h4>
      </div>
      <div class="modal-body" id="handover_data">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="upload_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title upload_title">Delivery Challan Uploads</h4>
      </div>
      <div class="modal-body">

        <div id="upload_data">

        </div>

        <form action="<?php echo admin_url('Chalan/challan_upload'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">

                <div class="form-group col-md-12">
                    <label for="file" class="control-label"><?php echo 'Upload File'; ?></label>
                    <input type="file" id="file" multiple="" name="file[]" style="width: 100%;">
                </div>

                <input type="hidden" id="process_id" name="process_id">
            </div>

            <div class="text-right">
                <button class="btn btn-info" type="submit">Submit</button>
            </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="stock_status" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assigned Person</h4>
      </div>
      <div class="modal-body stock_status_details">


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
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
        var challan_id = $(this).data("id");
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
        $(".challan_id").val(challan_id);
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
            tinymce.activeEditor.execCommand('mceSetContent', false, response);
//                $('.selectpicker').selectpicker('refresh');
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

$(document).on('click', '.action', function() {
  var challan_id = $(this).val();
  var type = $(this).attr('val');
  $('#chalan_id').val(challan_id);
  $('#for').val(type);

    if(type == 1){
        var title = 'Make Challan Delivery';
        var date_type = 'Delivery Date';
    }else{
        var title = 'Make Challan Pickup';
        var date_type = 'Pickup Date';
    }

     $('.action_title').html(title);
     $('#date_type').html(date_type);

});


$(document).on('click', '.handover', function() {

    var challan_id = $(this).val();
    var type = $(this).attr('val');
    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/chalan/get_handover_data'); ?>",
        data    : {'challan_id' : challan_id, 'type' : type},
        success : function(response){
            if(response != ''){

                if(type == 1){
                    var title = 'Delivery Hand Overs';
                }else{
                    var title = 'Pickup Hand Overs';
                }

                 $('.handover_title').html(title);
                 $('#handover_data').html(response);
            }
        }
    })

});

$(document).on('click', '.uplaods', function() {

    var process_id = $(this).attr('process_id');
    var type = $(this).attr('val');

    $('#upload_data').html('');

    $('#process_id').val(process_id);

    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/chalan/get_uploads_data'); ?>",
        data    : {'process_id' : process_id},
        success : function(response){
            if(response != ''){

                if(type == 1){
                    var title = 'Delivery Challan Uploads';
                }else{
                    var title = 'Pickup Challan Uploads';
                }

                 $('.upload_title').html(title);
                 $('#upload_data').html(response);
            }
        }
    })

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
  function get_assign_status(id){
        var url = "<?php echo site_url('admin/chalan/get_assign_status/'); ?>";
        $.ajax({
            type: "GET",
            url: url+id,
            success: function (res) {
                $('.stock_status_details').html(res);
            }
        })
    }

</script>
