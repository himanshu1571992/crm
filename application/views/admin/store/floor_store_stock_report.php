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
                                <div class="col-md-4">  
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
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label for="warehouse_id" class="control-label">Material Status</label>
                                        <select class="form-control selectpicker" data-live-search="true" id="material_status" name="material_status">
                                            <option value=""></option>
                                            <option value="1" <?php echo (isset($material_status) && $material_status == 1) ? 'selected': ''; ?>>OK</option>
                                            <option value="2" <?php echo (isset($material_status) && $material_status == 2) ? 'selected': ''; ?>>NOT OK</option>
                                            <option value="3" <?php echo (isset($material_status) && $material_status == 3) ? 'selected': ''; ?>>Repair</option>
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
                                        <th>Product Name</th>
                                        <th>Product ID</th>
                                        <th>Date</th>
                                        <th>Size</th>
                                        <th>Qty </th>
                                        <th align='center'>Material Status</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($floor_stock_report)){
                                        foreach ($floor_stock_report as $key => $value) { 
                                            $product_name = value_by_id("tblproducts", $value->pro_id, "sub_name");
                                            if ($value->material_status == 1){
                                                $material_status = "<span class='label label-success'>OK</span>";
                                            }else if ($value->material_status == 2){
                                                $material_status = "<span class='label label-danger'>NOT OK</span>";
                                            }else{
                                                $material_status = "<a href='javascript:void(0)' data-id='".$value->id."' data-target='#repair_update_modal' id='repairupdate' data-toggle='modal' class='btn-sm btn-warning'>Repair</a>";
                                            }
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>      
                                            <td><a href='<?php echo admin_url('product_new/view/'.$value->pro_id); ?>' target='_blank'><?php echo cc($product_name); ?></a></td>
                                            <td><?php echo 'PRO-ID'.$value->pro_id; ?></td>
                                            <td><?php echo _d($value->date); ?></td>
                                            <td><?php echo $value->size; ?></td>
                                            <td><?php echo $value->qty; ?></td>
                                            <td align='center'><?php echo $material_status; ?></td>
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
<div id="repair_update_modal" class="modal fade" role="dialog">
  <div class="modal-dialog repairupdatediv modal-lg">

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

    $("#repairupdate").on("click", function(){
        var logid = $(this).data("id");
        var url = "<?php echo site_url('admin/store/repairupdate/'); ?>";
        var mainurl = url+logid+'/floorstock';
        $.get(mainurl, function(data){
            $('.repairupdatediv').html(data);
        });
    });
} );
    
    function checkForTheCondition(){
        var errorcount = 0;
        
        var aqty = $('#aqty_0').val();
        var qty = $('#qty_0').val();
        var notokqty = $('#notokqty_0').val();
        var repairqty = $('#repairqty_0').val();
        var ttl_qty = parseInt(qty) + parseInt(notokqty) + parseInt(repairqty);
        
        if (qty != '' && notokqty != '' && repairqty != ''){
            if (aqty != ttl_qty){
                errorcount ++;
                alert('Qty Shoud be equals to total qty');
                $('#qty_0').val('');
                $('#notokqty_0').val('');
                $('#repairqty_0').val('');
                return false;
            }
        }
        return (errorcount == 0) ? true : false;
    }

</script>


</body>
</html>

