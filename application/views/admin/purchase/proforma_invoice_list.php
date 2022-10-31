
<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <div class="row panelHead">
                        <div class="col-xs-12 col-md-6"><h4><?php echo $title; ?> </h4></div>   
                        
                    </div>

                    <hr class="hr-panel-heading">

                    <div class="row">
                    <div>
                        <div class="col-md-4" id="employee_div">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Select Vendor</label>
                                <select class="form-control selectpicker" id="vendor_id" name="vendor_id" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                        if(!empty($vendors_info)){
                                            foreach ($vendors_info as $row) {
                                    ?>
                                            <option value="<?php echo $row->id; ?>" <?php if(!empty($vendor_id) && $vendor_id == $row->id){ echo 'selected';} ?>><?php echo cc($row->name); ?></option>
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
                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                            <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
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
                                    <th>Invoice #</th>
                                    <th>PO #</th>
                                    <th>Vendor</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($proforma_invoice_list)){
                                foreach ($proforma_invoice_list as $key => $value) {

                                    ?>
                                    <tr>
                                        <td><?php echo ++$key; ?></td>                                                
                                        <td>
                                            <?php echo get_creator_info($value->staff_id, $value->created_at); ?>
                                            <?php echo (is_numeric($value->number)) ? "PO-PI-".$value->number : $value->number ; ?>
                                            
                                        </td>
                                        <td>
                                            <a href="<?php echo admin_url('purchase/download_pdf/'.$value->po_id); ?>" target="_blank"><?php echo value_by_id("tblpurchaseorder", $value->po_id, "number"); ?></a>
                                        </td>
                                        <td><a href="<?php echo admin_url('vendor/vendor/'.$value->vendor_id);?>" target="_blank"><?php echo cc(value_by_id('tblvendor',$value->vendor_id,'name')); ?></a></td>
                                        <td><?php echo $value->totalamount; ?></td>
                                        <td><?php echo _d($value->date); ?></td>                                          
                                        <td class="text-center">
                                            <?php echo '<button type="button" title="Uplaod" class="tableBtn uplaods" value="' . $value->id . '" data-toggle="modal" data-target="#upload_modal"><i class="fa fa-upload" aria-hidden="true"></i></button>'; ?>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                    <li>
                                                        <a href="<?php echo admin_url('purchase/proforma_invoice_view/'.$value->id); ?>" target="_blank">VIEW</a> 
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo admin_url('purchase/proforma_invoice_edit/'.$value->id); ?>">EDIT</a> 
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


<div id="upload_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title upload_title">PI Uploads</h4>
            </div>
            <div class="modal-body">

                <div id="upload_data">

                </div>

                <form action="<?php echo admin_url('purchase/pi_upload'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="row">

                        <div class="form-group col-md-12">
                            <label for="file" class="control-label"><?php echo 'Upload File'; ?></label>
                            <input type="file" id="file" multiple="" name="file[]" style="width: 100%;">
                        </div>

                        <input type="hidden" id="pi_id" name="pi_id">
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

<script type="text/javascript">
    $(document).on('click', '.uplaods', function () {

        var id = $(this).val();
        $('#pi_id').val(id);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/purchase/get_pi_uploads_data'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {

                    $('#upload_data').html(response);
                }
            }
        })

    });
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            'colvis'
        ]
    } );
} );
</script>

<script type="text/javascript">
    $('.send_request').click(function () {
        var id = $(this).val();
        $("#invoice_id").val(id)
    });

    $('.status').click(function () {
        var id = $(this).val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/purchase/get_itc_approval_info'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $("#approval_html").html(response);
                }
            }
        })
    });
</script> 
</body>
</html>
