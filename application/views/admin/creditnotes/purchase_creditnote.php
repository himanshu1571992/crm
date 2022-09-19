<?php init_head(); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
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
<?php
$client = '';
$date_a = '';
$date_b = '';

if(!empty($s_client)){
	$client = $s_client;
}
if(!empty($s_fdate)){
	$date_a = $s_fdate;
}
if(!empty($s_tdate)){
	$date_b = $s_tdate;
}
?>
            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('creditnotes/purchase_creditnote'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4><?php echo $title; ?></h4>
                        </div>
                        <div class="col-xs-12 col-md-6 text-right">
                        	<!-- <a href="<?php echo admin_url('creditnotes/export?client_id='.$client.'&f_date='.$date_a.'&t_date='.$date_b); ?>" type="submit" class="btn btn-info">Export</a> -->
                            <?php if(check_permission_page(346,'create')){ ?> 
                   <a href="<?php echo admin_url('creditnotes/addPurchaseCreditNote'); ?>" type="submit" class="btn btn-info">Create Credit Note</a> <?php } ?>
                        </div>
                    </div>

					<hr class="hr-panel-heading">
					
					<div class="row">
					
						<div class="form-group col-md-4">
                           <label for="vendor_id" class="control-label">Select Vendor</label>
						
							<select class="form-control selectpicker" name="vendor_id" id="vendor_id" onchange="get_challan()" data-live-search="true">
	                            <option value=""></option>
	                            <?php
	                     
	                            if (isset($vendors_info) && count($vendors_info) > 0) {
	                                foreach ($vendors_info as $vendor_value) {

	                                    ?>
	                                        <option value="<?php echo $vendor_value['id'] ?>" <?php echo (isset($s_vendor_id) && $s_vendor_id == $vendor_value['id']) ? 'selected' : "" ?>><?php echo cc($vendor_value['name']); ?></option>
	                                        <?php
	                                }
	                            }
	                            ?>
	                        </select>
                        </div>
						
						<div class="form-group col-md-2" app-field-wrapper="date">
							<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
							<div class="input-group date">
								<input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group col-md-2" app-field-wrapper="date">
							<label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
							<div class="input-group date">
								<input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="col-md-1">                            
                        <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                        </div>


						<div class="col-md-12">	
                            <?php
                                if(is_admin() == 1){
                            ?>
                      					<div class="row1">                                   
<!--                                    <div class="col-md-12 text-center totalAmount-row">
                                        <h4 style="color: red;">Total Taxable Value : <?php echo number_format(($dn_amount-$taxable_value), 2); ?></h4>
                                        <h4 id="sgst_tot" style="color: red;"></h4>
                                        <h4 id="cgst_tot" style="color: red;"></h4>
                                        <h4 id="igst_tot" style="color: red;"></h4>
                                        <h4 style="color: red;">Total Amount : <?php echo number_format($dn_amount, 2, '.', ''); ?></h4>
                                        <h4 style="color: red;">Total Count : <?php echo count($debitnote_list); ?></h4>
                                    </div>  -->
                                    <fieldset class="scheduler-border"><br>
                                            <div class="col-md-12">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <h4 style="color: red; text-align: center;" class="control-label">Total Taxable Value</h4>
                                                        <p style="color: red; text-align: center;"><?php echo number_format(($dn_amount-$taxable_value), 2); ?></p>
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
                                                        <p id="igst_tot" style="color: red; text-align: center;"><?php echo number_format($dn_amount, 2, '.', ''); ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <h4 style="color: red; text-align: center;" class="control-label">Total Count</h4>
                                                        <p id="igst_tot" style="color: red; text-align: center;"><?php echo count($debitnote_list); ?></p>
                                                    </div>
                                                </div>

                                            </div>
                                        </fieldset>
                                </div>
                            <?php } ?>
                                <hr>
                        		<div class="table-responsive"> 															
								<table class="table" id="newtable">
									<thead>
									  <tr>
										<th>S.No.</th>
										<th>Number</th>
										<th>Vendor</th>
										<th>Invoice</th>
										<th>Date</th>										
										<th>Amount</th>
										<th>Action</th>
										
									  </tr>
									</thead>
									<tbody>
									<?php
                                        $sum= 0;
                                        $cgst_sum= 0;
                                        $igst_sum= 0;
									if(!empty($debitnote_list)){
										$z=1;
                    
										foreach($debitnote_list as $row){	
											$vendor_info = $this->db->query("SELECT `name` from `tblvendor` where id = '".$row->vendor_id."'  ")->row();		

                                                if($row->status == '1'){
                                                    if($row->tax_type == 1){
                                                        $tax = ($row->total_tax/2);
                                                        $sgst = number_format(round($tax), 2, '.', ''); 
                                                        $sum += $sgst;
                                                        $cgst = number_format(round($tax), 2, '.', '');
                                                        $cgst_sum += $cgst;
                                                    }else{
                                                        $igst = $row->total_tax;
                                                        $igst_sum += $igst;
                                                    }
                                                }									

											?>																						
											<tr>
												<td><?php echo $z++;?></td>
												<td>
                                                    <?php echo $row->number;?>
                                                    <?php echo get_creator_info($row->staff_id, $row->created_at); ?>
                                                </td>
												<td><a href="<?php echo admin_url('vendor/vendor_profile/'.$row->vendor_id);?>" target="_blank"><?php echo cc($vendor_info->name); ?></a></td>
												<td><?php echo $row->invoice_numbers;?></td>
												<td><?php echo _d($row->date); ?></td>
												<td><?php echo $row->totalamount;?></td>
												
												<td class="">
												
													<a  title="View" class="btn btn-info" target="_blank" href="<?php  echo admin_url('creditnotes/purchase_creditnote_pdf/'.$row->id); ?>">PDF</a>
													<?php 
													if(check_permission_page(346,'edit')){
													echo '<a class="btn btn-info" title="Edit" href="'.admin_url('creditnotes/addPurchaseCreditNote/'.$row->id).'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
													}else{
														echo '--';
													}

													if((check_permission_page(346,'delete'))){
													?>	
													<a class="btn btn-danger _delete" href="<?php echo admin_url('creditnotes/deletePurchaseCreditNote/'.$row->id);?>" data-status="1"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
													<?php
													}
													?>
													<!-- <a href="javascript:void(0);" class="btn-with-tooltip btn btn-info send-email" data-id="<?php echo $row->id; ?>" data-cid="<?php echo $row->clientid; ?>"  data-target="#send_mainto_customer" id="send_mail" data-toggle="modal">
                                                                                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                                                                                        </a> -->
												</td>
												
											</tr>
											<?php
										}
									}else{
										echo '<tr><td class="text-center" colspan="7"><h5>Record Not Found</h5></td></tr>';
									}
									?>
                  <input type="hidden" name="" id="sgst_id" value="<?php echo $sum; ?>">
                  <input type="hidden" name="" id="cgst_id" value="<?php echo $cgst_sum; ?>">
                  <input type="hidden" name="" id="igst_id" value="<?php echo $igst_sum; ?>">
									</tbody>
								  </table>
							</div>
						</div>
													
					</div>
					
					 <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>
                       
							
							
						<div class="btn-bottom-toolbar text-right">
                           
                        </div>
                        </div>
                       
                    </div>
                </div>
             
            </form>
		</div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assigned Person</h4>
      </div>
      <div class="modal-body">
       	<div id="approval_html"></div>
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
        <h4 class="modal-title upload_title">Material Receipt Uploads</h4>
      </div>
      <div class="modal-body">
        
        <div id="upload_data">
            
        </div>

        <form action="<?php echo admin_url('purchase/po_upload'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">

                <div class="form-group col-md-12">
                    <label for="file" class="control-label"><?php echo 'Upload File'; ?></label>
                    <input type="file" id="file" multiple="" name="file[]" style="width: 100%;">
                </div>
                
                <input type="hidden" id="po_id" name="po_id">
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
        echo form_open_multipart(admin_url("creditnotes/send_to_mail"), $attributes);
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Send credit note to client </h4>
      </div>
      <div class="modal-body">
          <input type="hidden" name="credit_note_id" class="credit_note_id" value="">
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
            $template_list = $this->db->query("SELECT id, template_name FROM tblemailmoduletemplate WHERE module_id = 9 AND status = 1")->result();
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
        <?php echo form_hidden('template_name',"credit_note"); ?>
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


<?php init_tail(); ?>
<script src="<?php  echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


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
<script>

$(document).ready(function() {
    $('#newtable').DataTable( {
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        buttons: [           
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            'colvis'
        ]
    } );
} );
</script>
<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
	$(document).on('change', '#branch_id', function(){	
		$("#attendance_form").submit();	
	});
	
	$(document).on('change', '#month', function(){	
		$("#attendance_form").submit();	
	});
</script> 


<script type="text/javascript">
	$(document).on('click', '.pay_all', function(){	
		if (! $("input[name='staffid[]']").is(":checked")){
		   alert('Please Check Any Checkbox First!');
		   return false;
		}else{
			$("#salary_form").submit();	
		}
	
	});	
</script> 


<script type="text/javascript">
	$('.status').click(function(){
	var po_id = $(this).val();
	
		$.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/purchase/get_approval_info'); ?>",
			data    : {'po_id' : po_id},
			success : function(response){
				if(response != ''){
					$("#approval_html").html(response);
				}
			}
		})
	});
</script> 

<script type="text/javascript">
$(document).on('click', '.uplaods', function() {  

    var id = $(this).val();
    $('#po_id').val(id); 

    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/purchase/get_po_uploads_data'); ?>",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){       

                $('#upload_data').html(response);  
            }
        }
    })

}); 
</script>

<script type="text/javascript">
      $(".myselect").select2();
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
        var credit_note_id = $(this).data("id");
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
        $(".credit_note_id").val(credit_note_id);
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
</body>
</html>
