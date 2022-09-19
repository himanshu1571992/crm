
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
<?php
/*$where_amt_desc = 0;
if(!empty($this->session->userdata('proposal_search'))){
    $search_arr = $this->session->userdata('proposal_search');
} 
if(!empty($this->session->userdata('proposal_where_amt_desc'))){
    $where_amt_desc = $this->session->userdata('proposal_where_amt_desc');
}  */ 
?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title; ?><!-- <a href="<?php echo admin_url('leads/export_lead'); ?>" class="btn btn-info pull-right" style="margin-top:-6px;"> Export</a> --></h4>

                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div >
                        <div class="row col-md-12">

                        <div class="col-md-3">
                            <div class="form-group ">
                                <label for="source" class="control-label">Quotation Source</label>
                                <select class="form-control selectpicker" id="source" name="source" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($sources_info)){
                                        foreach ($sources_info as $value) {
                                            ?>
                                            <option value="<?php echo $value->id; ?>" <?php if(!empty($source) && $source == $value->id){ echo 'selected';} ?>><?php echo cc($value->name); ?></option>
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

                        <!-- <div class="col-md-3">
                            <label for="quotation_no" class="control-label">Quotation No.</label>
                            <input type="text" name="quotation_no" class="form-control" value="<?php if(!empty($quotation_no)){ echo $quotation_no; } ?>">
                       </div>    -->                       

                        <div class="col-md-3">
                            <label for="customer_company" class="control-label">Customer Name </label>
                            <input type="text" name="customer_company" class="form-control" value="<?php if(!empty($customer_company)){ echo $customer_company; } ?>">
                       </div>   
                      


                        
                        <!-- <div class="col-md-12" style="margin-top: 15px;">                            
                            <button type="submit" class="btn btn-info pull-right">Search</button>
                        </div> -->
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
<!--                        <div class="row">
                            <div class="col-md-12 text-center totalAmount-row">
                                <h4 style="color: red;">Total Amount : <?php echo number_format($proposal_amount, 2); ?></h4>
                                <h4 style="color: red;">Total Count : <?php echo count($proposal_list); ?></h4>
                            </div>  
                        </div>-->
                        <br>
                        <div>
                            <fieldset class="scheduler-border"><br>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h4 style="color: red; text-align: center;" class="control-label">Total Amount</h4>
                                            <p style="color: red; text-align: center;"><?php echo number_format($proposal_amount, 2); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h4 style="color: red; text-align: center;" class="control-label">Total Count</h4>
                                            <p style="color: red; text-align: center;"><?php echo count($proposal_list); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>   
                        <?php    
                        }
                        ?>  
                                                        
                        <hr>     
                        <div class="table-responsive">                                                    
                        <table class="table" id="newtable">
                            <thead>
                              <tr>
                                <th>S.No</th>
                                <th>Quotation #</th>
                                <th>Customer Name</th>
                                <th>Total Tax</th>
                                <th>Total</th>
                                <th>Date</th>                                        
                                <th>Source</th>                                        
                                <th>Status</th>
                                <th>Followup</th>
                                <th>Req. Transport Amount</th>
                                <th class="text-center">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($proposal_list)){
                                foreach ($proposal_list as $key => $value) {
                                    $source = get_multiple_source($value->source);
                                    $trans_charges_info = $this->db->query("SELECT * FROM  tbltransportchargesrequest WHERE `ref_id`='".$value->id."' AND `ref_type`='proposals'")->row();
                                ?>
                                <tr>
                                    <td><?php echo ++$key; ?></td>                                                
                                    <td>
                                        <?php echo '<a target="_blank" href="' . admin_url('proposals/list_proposals/' . $value->id) . '" onclick="init_proposal(' . $value->id . '); ">' . format_proposal_number($value->id) . '</a>'; ?>
                                        <?php echo get_creator_info($value->addedfrom, $value->datecreated); ?>
                                    </td>
                                    <td><?php echo cc($value->proposal_to); ?></td>
                                    <td><?php echo $value->total_tax; ?></td>
                                    <td><?php echo $value->total; ?></td>                                        
                                    <td><?php echo _d($value->date); ?></td> 
                                    <td><?php echo $source; ?></td> 
                                    <td><?php echo format_proposal_status($value->status); ?></td>
                                    <td><a target="_blank" href="<?php echo admin_url('follow_up/lead_activity/'.$value->rel_id); ?>">Activity</a></td>
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
                                                                    <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
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
                                                                    <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
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
                                    <td class="text-center">
                                        
                                        <a href="<?php echo admin_url('proposals/download_pdf/'.$value->id); ?>" target="_blank" class="actionBtn" title="PDF"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                        <?php if(check_permission_page(5,'edit')){ ?>
                                        <a href="<?php echo admin_url('proposals/proposal/' . $value->id); ?>" title="Edit" class="actionBtn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <?php } ?>
                                        <br><a target="_blank" href="<?php echo admin_url('proposals/revice_quotation/' . $value->id); ?>" class="actionBtn" title="Revise"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                        <a href="javascript:void(0);" class="btn-with-tooltip send-email actionBtn" data-id="<?php echo $value->id; ?>" data-relid="<?php echo $value->rel_id;?>" title="Send to mail" data-target="#lead_send_to_customer" id="send_mail" data-toggle="modal">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                  </tr>
                                <?php
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

<div id="lead_send_to_customer" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <?php
        $attributes = array('id' => 'sub_form_product');
        echo form_open_multipart(admin_url("proposals/send_proposalto_email"), $attributes);
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Send Quotation to Email </h4>
      </div>
      <div class="modal-body">
          <input type="hidden" name="proposal_id" class="proposal_id" value="">
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
            $template_list = $this->db->query("SELECT id, template_name FROM tblemailmoduletemplate WHERE module_id = 2 AND status = 1")->result();
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
        <?php echo form_hidden('template_name',"quote"); ?>
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
        var proposal_id = $(this).data("id");
        var relid = $(this).data("relid");
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url(); ?>admin/proposals/get_client_list",
            data    : {'relid' : relid},
            success : function(response){
                $(".client_list").html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        });
        $(".proposal_id").val(proposal_id);
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

    $(document).on("click", ".charges-request", function(){
        var rel_id = $(this).data("id");
        var request_id = $(this).data("request_id");
        var type = $(this).data("type");
        $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/proposals/getTransportChargesRequest",
        data    : {'rel_id' : rel_id, 'rel_type' : "proposals", 'type': type, 'request_id': request_id},
        success : function(response){
            if(response != ''){
                $("#charges_request_modal").modal("show");
                $(".charges_req_html").html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        }
    })
  });
</script>
</body>
</html>

