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
                                        <label for="warehouse_id" class="control-label">Material Status</label>
                                        <select class="form-control selectpicker" data-live-search="true" id="material_status" name="material_status">
                                            <option value=""></option>
                                            <option value="1" <?php echo (isset($material_status) && $material_status == 1) ? 'selected': ''; ?>>OK</option>
                                            <option value="3" <?php echo (isset($material_status) && $material_status == 3) ? 'selected': ''; ?>>Repair</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">  
                                    <div class="form-group">
                                        <label for="service_type" class="control-label">Service Type</label>
                                        <select class="form-control selectpicker" data-live-search="true" id="service_type" name="service_type">
                                            <option value=""></option>
                                            <option value="1" <?php echo (isset($service_type) && $service_type == 1) ? 'selected': ''; ?>>Rent</option>
                                            <option value="2" <?php echo (isset($service_type) && $service_type == 2) ? 'selected': ''; ?>>Sales</option>
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
                                        <th>Service Type</th>
                                        <th>Date</th>
                                        <th>Size</th>
                                        <th>Qty </th>
                                        <th>Material Status</th>
                                        <th align='center'>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($finished_goods_report)){
                                        foreach ($finished_goods_report as $key => $value) { 
                                            $product_name = value_by_id("tblproducts", $value->pro_id, "sub_name");
                                            if ($value->material_status == 1){
                                                $material_status = "<span class='label label-success'>OK</span>";
                                            }else if ($value->material_status == 3){
                                                $material_status = "<a href='javascript:void(0)' data-id='".$value->id."' data-target='#repair_update_modal' id='repairupdate' data-toggle='modal' class='btn-sm btn-warning repair_update'>Repair</a>";
                                            }
                                            $ttl_qty = (!empty($from_date) && !empty($to_date)) ? $value->total_qty : $value->qty;
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>
                                            <td><?php echo cc($product_name); ?></td>
                                            <td><a href='<?php echo admin_url('product_new/view/'.$value->pro_id); ?>' target='_blank'><?php echo 'PRO-ID'.$value->pro_id; ?></a></td>
                                            <td><?php echo ($value->service_type == 1) ? '<span class="label label-danger">Rent</span>': '<span class="label label-success">Sales</span>'; ?></td>
                                            <td><?php echo _d($value->date); ?></td>
                                            <td><?php echo $value->size; ?></td>
                                            <td><?php echo $ttl_qty; ?></td>
                                            <td><?php echo $material_status; ?></td>
                                            <td align='center'>
                                                <?php
                                                    if ($value->material_status == 1){
                                                        if ($value->service_type == 1){
                                                            echo '<a href="javascript:void(0)" data-stype="2" data-proqty="'.$value->qty.'" data-proname="'.cc($product_name).'" data-logid="'.$value->id.'"  class="btn-sm btn-info convertproduct">Convert To Sales</a>';
                                                        }else if ($value->service_type == 2){
                                                            echo '<a href="javascript:void(0)" data-stype="1" data-proqty="'.$value->qty.'" data-proname="'.cc($product_name).'" data-logid="'.$value->id.'" class="btn-sm btn-info convertproduct">Convert To Rent</a>';
                                                        }
                                                    }else{
                                                        echo '--';
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
<div id="convertproductmodal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <?php echo form_open(admin_url('store_report/convertproduct'), array('id' => 'convertproduct_form', 'class' => 'convertproduct-form')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Convert Product</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">  
                                <table class="table">
                                    <thead>
                                        <th>Product Name</th>
                                        <th>Product ID</th>
                                        <th>Total Qty</th>
                                        <th>Qty</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="proname"></td>
                                            <td id="proid"></td>
                                            <td id="prottlqty"></td>
                                            <td><input type="number" required="" name="qty" min="1" id="proissueqty" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>                                
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="service_type" value="0" id="pro_service_type">
                    <input type="hidden" name="pro_log_id" value="0" id="pro_log_id">
                    <input type="submit" name="submit" value="submit" id="convertsbtn" onclick="return checkConvertCondition();" class="btn btn-info">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>     
        <?php echo form_close(); ?>                         
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
        
        //"iDisplayLength": 100,
        paging: false,
        dom: 'Bfrtip',
        // lengthMenu: [
        //     [ 10, 25, 50, -1 ],
        //     [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        // ],
        buttons: [  
            'pageLength',        
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            'colvis',
        ]
    } );

    $(".convertproduct").on("click", function(){
        var logid = $(this).data("logid");
        var stype = $(this).data("stype");
        var proqty = $(this).data("proqty");
        var proname = $(this).data("proname");
        $("#convertproductmodal").modal("show");
        $("#proname").html(proname);
        $("#prottlqty").html(proqty);
        $("#pro_log_id").val(logid);
        $("#pro_service_type").val(stype);
    });

    $(".repair_update").on("click", function(){
        var logid = $(this).data("id");
        var url = "<?php echo site_url('admin/store_report/repairupdate/'); ?>";
        var mainurl = url+logid+'/finised_stock';
        $.get(mainurl, function(data){
            $('.repairupdatediv').html(data);
        });
    });
} );
    
    function checkConvertCondition(){
        var errorcount = 0;
        var aqty = $('#prottlqty').text();
        var qty = $('#proissueqty').val();
        
        if (qty != ''){
            if (parseFloat(aqty) < parseFloat(qty)){
                errorcount ++;
                alert('Qty Shoud be less than equals to total qty');
                $('#proissueqty').val('');
                return false;
            }
        }
        return (errorcount == 0) ? true : false;
    }

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

