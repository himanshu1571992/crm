
<?php init_head(); ?>


<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title; ?></h4>
                            </div>
                            <div class="col-xs-12 col-md-6 text-right">
                                <?php if(check_permission_page(427,'create')){ ?>
                                    <a href="<?php echo admin_url('store/sheet_cutting'); ?>" class="btn btn-info mright5 pull-right display-block" style="margin-top:-6px; "> Sheet Cutting </a>

                                    <a href="<?php echo admin_url('store/store_cutting'); ?>" class="btn btn-info mright5 pull-right display-block" style="margin-top:-6px; "> Pipe Cutting </a>
                                <?php } ?> 
                            </div>
                        </div>
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
                                    <div class="form-group">
                                        <label for="operator_id" class="control-label">Cutting Type</label>
                                        <select class="form-control selectpicker" data-live-search="true" id="cutting_type" name="cutting_type">
                                            <option value=""></option>
                                            <option value="1" <?php echo (!empty($cutting_type) && $cutting_type == 1) ? 'selected="selected"' : ''; ?>>Pipe Cutting</option>
                                            <option value="2" <?php echo (!empty($cutting_type) && $cutting_type == 2) ? 'selected="selected"' : ''; ?>>Sheet Cutting</option>
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
                                        <th>Added By</th>
                                        <th>Cutting Type</th>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Date</th>
                                        <th>Remark</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($store_cutting_list)){
                                        foreach ($store_cutting_list as $key => $value) { 
                                            $pro_id = value_by_id("tblproduct_store_log", $value->product_store_log_id, "pro_id");
                                            $product_name = value_by_id("tblproducts", $pro_id, "sub_name");
                                            $cuttingtype = ($value->cutting_type == 1) ? '<span class="btn-sm btn-success">Pipe Cutting</span>' : '<span class="btn-sm btn-info">Sheet Cutting</span>';
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>                                                
                                            <td><?php echo get_employee_fullname($value->added_by); ?></td>
                                            <td><?php echo $cuttingtype; ?></td>
                                            <td><?php echo cc($product_name); ?></td>
                                            <td><?php echo $value->qty; ?></td>
                                            <td><?php echo _d($value->date); ?></td>
                                            <td><span><button type="button" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="<?php echo (!empty($value->remark)) ? cc($value->remark) : "--"; ?>">Show Remark</button></td>  
                                            <td>
                                                <a href="javascript:void(0)" class="btn-sm btn-info status" onclick="get_productlog_details('<?php echo $value->id; ?>', 'store_cutting', '<?php echo $value->cutting_type; ?>');" data-id="<?php echo $value->id; ?>" data-target="#stock_details" id="status" data-toggle="modal" title="View Details"><i class="fa fa-eye"></i></a>
                                                <a href="<?php echo admin_url('store/store_cutting_delete/'.$value->id); ?>" class="_delete btn-sm btn-danger" title="delete" ><i class="fa fa-trash"></i></a>
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
                                <th class="sheetcutting" style="display:none;">Width <small>( MM )</small></th>
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
            'colvis',
        ]
    } );
} );
    
    function get_productlog_details(id, ref_type, cutting_type){
        var url = "<?php echo site_url('admin/store/get_productlog_details/'); ?>";
        $.ajax({
            type: "GET",
            url: url+id+"/"+ref_type+"/"+cutting_type,
            success: function (res) {
                $(".sheetcutting").hide();
                if (cutting_type == 2){
                    $(".sheetcutting").show();
                }
                $('.stockdetails').html(res);
            }
        })
    }

</script>


</body>
</html>

