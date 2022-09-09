
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
                        <div class="col-xs-12 col-md-6"><h4><?php echo $title;  if(check_permission_page(45,'create')){ ?> </h4></div>   
                        <div class="col-xs-12 col-md-6 text-right">
                            <a href="<?php echo admin_url('purchase/payment_invoice'); ?>" type="submit" class="btn btn-info">Create new Invoice</a> <?php } ?>
                        </div>
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


                        <div class="form-group col-md-3" app-field-wrapper="date">
                            <label for="f_date" class="control-label">From Date</label>
                            <div class="input-group date">
                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="form-group col-md-3" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        
                       <!--  <div class="col-md-2" id="employee_div">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Service Type</label>
                                <select class="form-control selectpicker" id="service_type" name="service_type" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <option value="1" <?php if(!empty($search_arr['service_type']) && $search_arr['service_type'] == 1){ echo 'selected';} ?>>Rent</option>
                                    <option value="2" <?php if(!empty($search_arr['service_type']) && $search_arr['service_type'] == 2){ echo 'selected';} ?>>Sale</option>
                                    
                                </select>
                            </div>
                        </div> -->


                        
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
                                        <th>PO No.</th>
                                        <th>Vendor</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Invoice For</th>
                                        <th>Invoices</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($invoice_list)){
                                        foreach ($invoice_list as $key => $value) {

                                            $document_info = $this->db->query("SELECT * FROM tblfiles WHERE rel_id = '".$value->id."' and rel_type = 'purchase_invoice'")->result_array();

                                            $file_data = '<a href="javascript:void(0);" class="btn-sm btn-warning upload_invoices" data-id="'.$value->id.'" data-toggle="modal" data-target="#upload_invoice_modal">Upload Invoices</a>';
                                            if(!empty($document_info)){
//                                                foreach ($document_info as $doc) {
//                                                    $file_data .= '<a download href="'.site_url('uploads/purchase_invoice/'.$value->id.'/'.$doc['file_name']).'">'.$doc['file_name'].'</a><br>';
//                                                    
//                                                }
                                                $file_data = '<a href="javascript:void(0);" class="btn-sm btn-success upload_invoices" data-id="'.$value->id.'" data-toggle="modal" data-target="#upload_invoice_modal">View Invoices</a>';
                                            }
                                              
                                            $po_number = "--";
                                             $po_info = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE `id` = ".$value->po_id."")->row();
                                             if(!empty($po_info)){
                                                $po_number = "<a href='".admin_url("purchase/download_pdf/".$value->po_id)."' target='_blank'>".$po_info->number."</a>";
                                             }
                                            ?>
                                            <tr>
                                                <td><?php echo ++$key; ?></td>                                                
                                                <td><?php echo 'Inv-'.str_pad($value->id, 4, '0', STR_PAD_LEFT); ?></td>
                                                <td><?php echo $value->reference_number; ?></td>
                                                <td><?php echo $po_number; ?></td>
                                                <td><a href="<?php echo admin_url('vendor/vendor/'.$value->vendor_id);?>" target="_blank"><?php echo cc(value_by_id('tblvendor',$value->vendor_id,'name')); ?></a></td>
                                                <td><?php echo $value->totalamount; ?></td>
                                                <td><?php echo _d($value->date); ?></td>                                                 
                                                <td><?php echo ($value->invoice_for == 1) ? 'Purchase Order' : 'Work Order'; ?></td>
                                                <td><?php echo $file_data; ?></td>

                                                <td class="text-center">
                                                    
                                                    
                                                    <?php
                                                        $chk_mr_files = $this->db->query("SELECT * FROM `tblmaterialreceiptfiles` WHERE `mr_id` IN (".$value->mr_id.")")->result();
                                                        if(!empty($chk_mr_files)){
                                                            echo '<a href="javascript:void(0);" class="btn-sm btn-success uplaods" data-mr_id="'.$value->mr_id.'" data-toggle="modal" data-target="#upload_modal">Upload Challan</a>';
                                                        }else{
                                                            echo '<a href="javascript:void(0);" class="btn-sm btn-warning uplaods" data-mr_id="'.$value->mr_id.'" data-toggle="modal" data-target="#upload_modal">Pending Challan</a>';
                                                        }
                                                    ?>
                                                    <a target="_blank"  class="btn-sm btn-info" href="<?php echo admin_url('purchase/purchase_invoice_pdf/'.$value->id);?>" data-status="1" title="System Invoice">System Invoice</a>
                                                    <div class="btn-group pull-right">
                                                         <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                         </button>
                                                         <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                            
                                                                <?php if(check_permission_page(45,'edit')){ ?>
                                                                    <li><a href="<?php echo admin_url('purchase/payment_invoice/' . $value->id); ?>" title="Edit">EDIT</a></li>
                                                                <?php } ?>
                                                                 
                                                                <?php
                                                                     /*if($type == '?type=rent' && $value->status != '5'){
                                                                             ?>
                                                                             <a target="_blank" href="<?php echo admin_url('invoices/renew_invoice/'.$value->id);?>" data-status="1">RENEWAL</a>	
                                                                     <?php
                                                                     }*/
                                                               if(check_permission_page(45,'delete')){
                                                                    ?>
                                                               <li>
                                                                   <a style="color:red;" class="_delete" href="<?php echo admin_url('purchase/delete_invoice/'.$value->id);?>" data-status="1" title="DELETE">DELETE</a> 
                                                               </li>
                                                                    
                                                                <?php
                                                                }
								?>
                                                            
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
                <h4 class="modal-title upload_title">Material Receipt Uploads</h4>
            </div>
            <div class="modal-body upload_data">
<!--                <div id="upload_data">

                </div>-->
            </div>
        </div>

    </div>
</div>
<div id="upload_invoice_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title upload_title">Invoices Uploads</h4>
            </div>
            <div class="modal-body">
                <div id="upload_invoice_data">

                </div>
                <form action="<?php echo admin_url('purchase/invoice_uploads'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="file" class="control-label"><?php echo 'Upload File'; ?></label>
                            <input type="file" id="file" multiple="" name="file[]" style="width: 100%;height: auto;padding: 10px 15px;">
                        </div>
                        <input type="hidden" id="invoice_id" name="invoice_id">
                    </div>
                    <div class="text-right">
                        <button class="btn btn-info" type="submit">Submit</button>
                    </div>  
                </form>
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
    $(document).on('click', '.uplaods', function () {

        var mr_ids = $(this).data("mr_id");
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/purchase/get_invoice_mr_uploads_data'); ?>",
            data: {'mr_ids': mr_ids},
            success: function (response) {
                if (response != '') {
                    $('.upload_data').html(response);
                }
            }
        })

    });
</script>
<script type="text/javascript">
    $(document).on('click', '.upload_invoices', function () {

        var id = $(this).data("id");
        $("#invoice_id").val(id);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/purchase/get_invoice_uploads_data'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $('#upload_invoice_data').html(response);
                }
            }
        })

    });
</script>
</body>
</html>
