
<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">
            
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <?php echo form_open($this->uri->uri_string(), array('id' => 'floorstoregetsearch', 'class' => 'proposal-form')); ?>                    
                            <div>
                                <div>
                                    <div class="row">
                                        <div class="col-md-3">  
                                            <div class="form-group">
                                                <label for="warehouse_id" class="control-label">Warehouse</label>
                                                <select class="form-control selectpicker" required='' data-live-search="true" onchange="getshopfloordata();" id="warehouse_id" name="warehouse_id">
                                                    <option value=""></option>
                                                    <?php
                                                    if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                                        foreach ($all_warehouse as $all_warehouse_value) {
                                                            $selected = ($warehouse_id == $all_warehouse_value->id) ? "selected": "";
                                                            ?>
                                                            <option value="<?php echo $all_warehouse_value->id; ?>" <?php echo $selected; ?>><?php echo $all_warehouse_value->name; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="submittype" value="search">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" app-field-wrapper="date">
                                                <label for="date" class="control-label">Date</label>
                                                <div class="input-group date">
                                                    <input id="date" name="date" required='' class="form-control datepicker" value="<?php echo date("d/m/Y"); ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <hr>
                            </div>
                        
                            <div class="col-md-12"> 
                                <div class="table-responsive">  
                                    <table class="table" id="newtable">
                                        <thead>
                                        <tr>
                                            <th width='1%'>S.No</th>
                                            <th>Product Name</th>
                                            <th>Product ID</th>
                                            <th>Qty</th>
                                            <th>Ok Qty</th>
                                            <th>Not Ok Qty</th>
                                            <th>Repair Qty</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="shopfloordata">
                                            <?php 
                                                if (!empty($shopdata)){
                                                    foreach ($shopdata as $key => $value) {
                                                        $product_name = value_by_id("tblproducts", $value->pro_id, "sub_name");
                                                        $url = admin_url('product_new/view/'.$value->pro_id);
                                                        echo "<tr>
                                                                <td>".++$key."</td>
                                                                <td>".cc($product_name)."</td>
                                                                <td><a href='".$url."' target='_blank'>PRO-ID".$value->pro_id."</a></td>
                                                                <td>".$value->qty."</td>
                                                                <td>
                                                                    <input type='hidden' class='form-control' name='storedata[".$key."][parent_id]' value='".$value->id."'>
                                                                    <input type='hidden' class='form-control' id='aqty_".$key."' name='storedata[".$key."][available_qty]' value='".$value->qty."'>
                                                                    <input type='number' class='form-control' id='qty_".$key."' name='storedata[".$key."][ok_qty]' min='0'>
                                                                </td>
                                                                <td><input type='number' class='form-control' id='notokqty_".$key."' name='storedata[".$key."][notok_qty]' min='0'></td>
                                                                <td><input type='number' class='form-control' id='repairqty_".$key."' name='storedata[".$key."][repair_qty]' min='0'></td>
                                                                <td><input class='form-control action-box' data-rid='".$key."' data-name='".cc($product_name)."' type='checkbox' name='storedata[".$key."][action]'></td>
                                                            </tr>";
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div <?php echo (empty($shopdata)) ? 'style="display:none;"': ''; ?> class="btn-bottom-toolbar text-right form-sub-btn">
                                <!-- <input type="hidden" name="warehouse_id" value="<?php echo (isset($warehouse_id) && !empty($warehouse_id)) ? $warehouse_id : 0; ?>">  -->
                                <button class="btn btn-info final-btn" type="submit" onclick="return checkForTheCondition();">Submit</button>
                                <!-- <a href="javascript:void(0);" class="btn btn-info final-btn">Submit</a> -->
                            </div>
                        <?php echo form_close(); ?>                        
                    </div>
                </div>
            </div>                                
            
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
    $('#newtable').DataTable({"bPaginate": false});
});
$(document).ready(function() {
    

        $(document).on('click','.action-box', function() {
            var rid = $(this).data("rid");
            
            if($(this).is(":checked")) {
                
                var pname = $(this).data("name");
                
                var aqty = $('#aqty_'+rid).val();
                var qty = $('#qty_'+rid).val();
                var notokqty = $('#notokqty_'+rid).val();
                var repairqty = $('#repairqty_'+rid).val();
                if (qty == ''){
                    alert(pname+'- Ok Qty Required');
                    $(this).prop("checked", false);
                }
                if (notokqty == ''){
                    alert(pname+'- Not Ok Qty Required');
                    $(this).prop("checked", false);
                }
                if (repairqty == ''){
                    alert(pname+'- Repair Qty Required');
                    $(this).prop("checked", false);
                }
                if (qty != '' && notokqty != '' && repairqty != ''){
                    var ttl_qty = parseInt(qty) + parseInt(notokqty) + parseInt(repairqty);
                    if (aqty != ttl_qty){
                        alert(pname+'- Total Qty Not equal with qty');
                        $('#qty_'+rid).val('');
                        $('#notokqty_'+rid).val('');
                        $('#repairqty_'+rid).val('');
                        $(this).prop("checked", false);
                    }
                }
                
            }else{
                $('#qty_'+rid).val('');
                $('#notokqty_'+rid).val('');
                $('#repairqty_'+rid).val('');
            }
        });

    });
    
    function checkForTheCondition(){
        var actioncount = 0;
        var errorcount = 0;
        $('.action-box').each(function() {
            var rid = $(this).data("rid");
            var pname = $(this).data("name");
            var aqty = $('#aqty_'+rid).val();
            var qty = $('#qty_'+rid).val();
            var notokqty = $('#notokqty_'+rid).val();
            var repairqty = $('#repairqty_'+rid).val();
            var ttl_qty = parseInt(qty) + parseInt(notokqty) + parseInt(repairqty);
            
            if (qty != '' && notokqty != '' && repairqty != ''){
                if (aqty != ttl_qty){
                    errorcount ++;
                    alert(pname+'- Total Qty Not equal with qty');
                    $('#qty_'+rid).val('');
                    $('#notokqty_'+rid).val('');
                    $('#repairqty_'+rid).val('');
                    $(this).prop("checked", false);
                    return false;
                }
            }
        });

        $('.action-box').each(function() {
            if($(this).is(":checked")) {
                actioncount++;
            }
        });
        if (actioncount == 0){
            alert("Please check at least one record");
            return false;
        }
        return (errorcount == 0) ? true : false;
    }

    function getshopfloordata(){
        
        var warehouse_id = $("#warehouse_id").val();
        $(".form-sub-btn").hide();
        $(".shopfloordata").html("<tr><td colspan='8' class='dataTables_empty' valign='top'>No data available in table</td></tr>");
        if (warehouse_id != ""){
            $("#floorstoregetsearch").submit();

            // var url = "<?php echo site_url('admin/store/getshopfloordata'); ?>";
            // $.ajax({
            //     type: "POST",
            //     url: url,
            //     data: {'warehouse_id': warehouse_id},
            //     success: function (res) {
            //         if (res != ''){
            //             $(".shopfloordata").html(res);
            //             $(".form-sub-btn").show();
            //         }
            //     }
            // });
        }
    }
</script>


</body>
</html>

