<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php echo $title; ?>
                    <?php if (check_permission_page(353,'create')){?>
                    <a href="<?php echo admin_url('purchase_entry/add_purchase_entry'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; "> Add Purchase Entry </a>
                    <?php } ?>
                    </h4>
                    <hr class="hr-panel-heading">
                    <div>
                        <div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="f_date" class="control-label">From Date</label>
                                        <div class="input-group date">
                                            <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if (!empty($f_date)) {echo $f_date;} ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="t_date" class="control-label">To Date</label>
                                        <div class="input-group date">
                                            <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if (!empty($t_date)) {echo $t_date;} ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="t_date" class="control-label">Company Branch</label>
                                        <select class="form-control selectpicker" data-live-search="true" id="branch_id" name="branch_id">   
                                            <option value=""></option>
                                            <?php
                                                if ($companybranch_list){
                                                    foreach ($companybranch_list as $value) {
                                                        $selected = (isset($branch_id) && $branch_id == $value->id) ? "selected":"";
                                                        echo '<option value="'.$value->id.'" '.$selected.'>'.$value->comp_branch_name.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group" style="margin-top: 26px;">
                                        <button type="submit" class="btn btn-info">Search</button>
                                        <a class="btn btn-danger" href="">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                            <br>
                            <hr>                    
                            <div class="col-md-12"> 
                                <div class="table-responsive">  
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Invoice Date</th>
                                        <th>Invoice Number</th>
                                        <th>GST Number</th>
                                        <th>Tax Type</th>
                                        <th>Total Amount</th>
                                        <th>Basic Amount</th>
                                        <th>Tax Amount</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($invoicelist)){
                                        foreach ($invoicelist as $key => $value) { 
                                           
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>                                                
                                            <td>
                                                <?php echo cc($value->name); ?>
                                                <?php echo get_creator_info($value->staff_id, $value->created_on); ?>
                                            </td>
                                            <td><?php echo date("d-m-Y", strtotime($value->invoice_date)); ?></td>
                                            <td><?php echo $value->invoice_number; ?></td>
                                            <td><?php echo $value->gst_number; ?></td>  
                                            <td><?php echo ($value->tax_type == 1) ? "CGST+SGST" : "IGST"; ?></td>  
                                            <td><?php echo $value->totalamount; ?></td>  
                                            <td><?php echo $value->basic_amount; ?></td>  
                                            <td><?php echo $value->total_tax; ?></td>  
                                            <td class="text-center">
                                            <?php if (check_permission_page(353,'edit')){ ?>
                                                <a class="btn btn-info" href="<?php echo admin_url('purchase_entry/add_purchase_entry/' . $value->id); ?>" title="Edit" ><i class="fa fa-edit"></i></a>
                                            <?php 
                                            }
                                            if (check_permission_page(353,'delete')){ ?>    
                                                <a class="btn btn-danger _delete" href="<?php echo admin_url('purchase_entry/delete_purchase_entry/' . $value->id); ?>" title="Delete" ><i class="fa fa-trash"></i></a>
                                            <?php } ?>    
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
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [  
            'pageLength',        
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
            'colvis',
        ]
    } );
} );
    
    function get_assign_status(id){
        var url = "<?php echo site_url('admin/stock_consumption/get_assign_status/'); ?>";
        $.ajax({
            type: "GET",
            url: url+id,
            success: function (res) {
                $('.stock_status_details').html(res);
            }
        })
    }

</script>


</body>
</html>

