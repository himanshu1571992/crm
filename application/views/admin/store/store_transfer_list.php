
<?php init_head(); ?>


<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title; ?>
                    <?php if(check_permission_page(426,'create')){ ?>
                        <a href="<?php echo admin_url('store/store_transfer'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; "> Add Store Transfer </a>
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
                                        <th>Added By</th>
                                        <th>From Warehouse</th>
                                        <th>To Warehouse</th>
                                        <th>Date</th>
                                        <th>Remark</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($store_transfer_list)){
                                        foreach ($store_transfer_list as $key => $value) { 
                                            $fromwarehouse = value_by_id("tblwarehouse", $value->from_warehouse, "name");
                                            $towarehouse = value_by_id("tblwarehouse", $value->to_warehouse, "name");
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>                                                
                                            <td><?php echo get_employee_fullname($value->added_by); ?></td>
                                            <td><?php echo cc($fromwarehouse); ?></td>
                                            <td><?php echo cc($towarehouse); ?></td>
                                            <td><?php echo _d($value->date); ?></td>
                                            <td><?php echo (!empty($value->remark)) ? cc($value->remark) : "--"; ?></td>  
                                            <td><a href="javascript:void(0)" class="btn-sm btn-info status" onclick="get_productlog_details('<?php echo $value->id; ?>', 'store_transfer');" data-id="<?php echo $value->id; ?>" data-target="#stock_details" id="status" data-toggle="modal">View Details</a></td>
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
<div id="stock_details" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Product Log Details</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">  
                        <table class="table">
                            <thead>
                                <th>S.no.</th>
                                <th>Product Name</th>
                                <th>Product ID</th>
                                <th>Total Qty</th>
                                <th>Size <small>( MM )</small></th>
                            </thead>
                            <tbody class="stockdetails">

                            </tbody>
                        </table>
                    </div>                                
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
    
    function get_productlog_details(id, ref_type){
        var url = "<?php echo site_url('admin/store/get_productlog_details/'); ?>";
        $.ajax({
            type: "GET",
            url: url+id+"/"+ref_type,
            success: function (res) {
                $('.stockdetails').html(res);
            }
        })
    }

</script>


</body>
</html>

