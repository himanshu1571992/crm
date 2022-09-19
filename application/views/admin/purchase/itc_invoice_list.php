
<?php init_head(); ?>


<?php
if(!empty($this->session->userdata('purchaseinvoice_search'))){
    $search_arr = $this->session->userdata('purchaseinvoice_search');
}    
?>

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
                                    if(!empty($vendor_data)){
                                        foreach ($vendor_data as $row) {
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

                        
                        <div class="col-md-2" >
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">ITC Status</label>
                                <select class="form-control selectpicker" id="itc_status" name="itc_status">
                                    <option value="" disabled selected >--Select One-</option>
                                    <option value="3" <?php if(!empty($itc_status) && $itc_status == 1){ echo 'selected';} ?>>Pending</option>
                                    <option value="1" <?php if(!empty($itc_status) && $itc_status == 1){ echo 'selected';} ?>>Done</option>
                                    <option value="2" <?php if(!empty($itc_status) && $itc_status == 2){ echo 'selected';} ?>>Reject</option>
                                    
                                </select>
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
                                <hr>
                            </div>

                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Invoice #</th>
                                        <th>Reference No.</th>
                                        <th>Vendor</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>ITC Status</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($invoice_list)){
                                        foreach ($invoice_list as $key => $value) {

                                             if ($value->itc_status == 0) {
                                                    $status = 'ITC Pending';
                                                    $cls = 'btn-warning';
                                                } elseif ($value->itc_status == 1) {
                                                    $status = 'ITC Done';
                                                    $cls = 'btn-success';
                                                } elseif ($value->itc_status == 2) {
                                                    $status = 'ITC Rejected';
                                                    $cls = 'btn-danger';
                                                }

                                             $approval_info = $this->db->query("SELECT * from tblpurchaseinvoiceitcpproval where invoice_id = '".$value->id."' ")->row();
                                            ?>
                                            <tr>
                                                <td><?php echo ++$key; ?></td>                                                
                                                <td>
                                                    <?php echo 'INV-'.str_pad($value->id, 4, '0', STR_PAD_LEFT); ?>
                                                    <?php echo get_creator_info($value->staff_id, $value->created_at); ?>
                                                </td>
                                                <td><?php echo $value->reference_number; ?></td>
                                                <td><a href="<?php echo admin_url('vendor/vendor/'.$value->vendor_id);?>" target="_blank"><?php echo cc(value_by_id('tblvendor',$value->vendor_id,'name')); ?></a></td>
                                                <td><?php echo $value->totalamount; ?></td>
                                                <td><?php echo _d($value->date); ?></td>                                          
                                                <td><?php echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$value->id.'" data-toggle="modal" data-target="#myModal">'.$status.'</button>'; ?></td>                                          

                                                <td class="text-center">
                                                    <?php
                                                    if(!empty($approval_info) && ($value->itc_status == 0 || $value->itc_status == 1)){                                                        
                                                        echo '<span class="btn-sm btn-success">Request Sent</span>';
                                                    }else{
                                                        echo '<button type="button" class="btn btn-info btn-sm send_request" data-toggle="modal" data-target="#actionModal" value="'.$value->id.'">Send Request</button>';
                                                    }
                                                    ?>
												    
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



<!-- Modal -->
<div id="actionModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send Request for Purchase ITC</h4>
      </div>
      <div class="modal-body">

        <form method="post" action="<?php echo admin_url('purchase/itc_invoice_action'); ?>">
            <div class="row">
            <div class="col-md-12" style="margin-bottom:2%;">
                <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>
                <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assignid[]" required="">
                    <?php

                    if (isset($allStaffdata) && count($allStaffdata) > 0) {
                        foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                            ?>
                            <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                <?php
                                foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                    ?>
                                    <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php
                                    if (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) { echo'selected'; }
                                    ?>><?php echo $singstaff['firstname'] ?></option>
                                        <?php } ?>
                            </optgroup>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-12" >
                <label for="remark" class="control-label">Remark <small>(Reference No.)</small></label>
                <textarea id="remark" name="remark" class="form-control" rows="3" required=""></textarea>
            </div>

            <input type="hidden" value="" name="invoice_id" id="invoice_id">
            <div class="col-md-1">                            
                <button type="submit" style="margin-top: 24px;" class="btn btn-info">Submit</button>
            </div>
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
