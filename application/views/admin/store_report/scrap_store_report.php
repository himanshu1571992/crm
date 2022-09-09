<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php echo $title; ?></h4>
                    <hr class="hr-panel-heading">
                    <div>
                        <div>
                            <div class="row">
                                <div class="col-md-2">  
                                    <div class="form-group">
                                        <label for="warehouse_id" class="control-label">Warehouse</label>
                                        <select class="form-control selectpicker" required='' data-live-search="true" id="warehouse_id" name="warehouse_id">
                                            <option value=""></option>
                                            <?php
                                            if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                                foreach ($all_warehouse as $all_warehouse_value) {
                                                    $selected = ($warehouse_id == $all_warehouse_value->id) ? "selected": ""; ?>
                                                    ?>
                                                    <option value="<?php echo $all_warehouse_value->id; ?>" <?php echo $selected; ?>><?php echo $all_warehouse_value->name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">  
                                    <div class="form-group">
                                        <label for="store_issue" class="control-label">Store Issue</label>
                                        <select class="form-control selectpicker" required='' data-live-search="true" id="store_issue" name="store_issue">
                                            <option value=""></option>
                                            <option value="MSI" <?php echo (isset($store_issue)) ? ($store_issue == 'MSI') ? "selected=''": "": ""; ?>>Main Store</option>
                                            <option value="SFI" <?php echo (isset($store_issue)) ? ($store_issue == 'SFI') ? "selected=''": "": ""; ?>>Shop Floor</option>
                                            <option value="FGI" <?php echo (isset($store_issue)) ? ($store_issue == 'FGI') ? "selected=''": "": ""; ?>>Finished Goods</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" app-field-wrapper="from_date">
                                        <label for="from_date" class="control-label">From Date</label>
                                        <div class="input-group date">
                                            <input id="from_date" name="from_date" class="form-control datepicker" value="<?php echo (!empty($from_date)) ? $from_date:''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" app-field-wrapper="to_date">
                                        <label for="to_date" class="control-label">To Date</label>
                                        <div class="input-group date">
                                            <input id="to_date" name="to_date" class="form-control datepicker" value="<?php echo (!empty($to_date)) ? $to_date:''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
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
                                        <th>Product Name</th>
                                        <th>Product ID</th>
                                        <th>Date</th>
                                        <th>Size</th>
                                        <th>Qty </th>
                                      </tr>
                                    </thead>
                                    <tbody class="main_store_report_div">
                                    <?php
                                    if(!empty($scrap_store_report)){
                                        foreach ($scrap_store_report as $key => $value) { 
                                            $product_name = value_by_id("tblproducts", $value->pro_id, "sub_name");
                                            $ttl_qty = (!empty($from_date) && !empty($to_date)) ? $value->total_qty : $value->qty;
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>      
                                            <td><?php echo cc($product_name); ?></td>
                                            <td><a href='<?php echo admin_url('product_new/view/'.$value->pro_id); ?>' target='_blank'><?php echo 'PRO-ID'.$value->pro_id; ?></a></td>
                                            <td><?php echo _d($value->date); ?></td>
                                            <td><?php echo $value->size; ?></td>
                                            <td><?php echo $ttl_qty; ?></td>
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

