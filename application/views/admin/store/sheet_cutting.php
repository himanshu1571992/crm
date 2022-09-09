
<?php 
    init_head();
    $section = $this->uri->segment(4);
    $sessiondata = $this->session->flashdata('item');
?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'sheet_cutting_store', 'class' => 'proposal-form', 'onsubmit' => "return confirm('Do you really want to perform cutting action?');")); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4><?php echo $title; ?></h4>
                                <hr/>
                                <div class="col-md-2">  
                                    <div class="form-group">
                                        <label for="warehouse_id" class="control-label">Warehouse</label>
                                        <select class="form-control selectpicker" required='' data-live-search="true" onchange="getproductlogs(this.value);" id="warehouse_id" name="warehouse_id">
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
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label for="warehouse_id" class="control-label">Product (W*L)</label>
                                        <select class="form-control selectpicker" required='' data-live-search="true" onchange="getproductqty(this.value)" id="product_store_log_id" name="product_store_log_id">
                                            <option value=""></option>
                                        </select>
                                        <input type="hidden" name="system_qty" id="system_qty" value="0">
                                        <input type="hidden" name="system_size" id="system_size" value="0">
                                        <input type="hidden" name="system_width" id="system_width" value="0">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="qty" class="control-label">Qty</label>
                                        <input type='number' class='form-control' id='qty' required='' onkeyup="calculatesize(this.value);" name='qty' min='0'>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="size" class="control-label">Total Surface Area <small class="text-danger">( MM )</small></label>
                                        <input type='text' class='form-control' readonly="" required='' id='size' name='size' min='0'>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="date" class="control-label">Date</label>
                                        <div class="input-group date">
                                            <input id="date" name="date" required='' class="form-control datepicker" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group" app-field-wrapper="remark">
                                        <label for="remark" class="control-label">Cutting Remark</label>
                                        <textarea id="remark" class="form-control" rows="4" required='' name="remark"></textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <div class="col-lg-4 pull-right col-xs-12 col-md-12 total-column">
                                    <div class="panel_s">
                                        <div class="panel-body">
                                            <h3 class="text-muted _total remainingsize">0.00</h3>
                                            <span class="text-danger">Total Remaining Area</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 pull-left">
                                    <a href="#" class="btn-sm btn-info" data-target="#createwaste" data-toggle="modal">Create Waste</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                            <hr>
                                <div class="container-fluid">
                                    <div class="table-responsive">  
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable" id="newtable">
                                            <thead>
                                                <tr>
                                                    <th width='1%'>#</th>
                                                    <th width='35%'>Product Name</th>
                                                    <th>Product ID</th>
                                                    <th>Qty</th>
                                                    <th >Width <small>( MM )</small></th>
                                                    <th >Length <small>( MM )</small></th>
                                                    <th width='15%'>Total Used Area</th>
                                                </tr>
                                            </thead>
                                            <tbody class="product_div">
                                            <?php 
                                                    $r = 0;
                                                    if(!empty($sessiondata)){
                                                        foreach ($sessiondata as $key => $dval) {
                                                ?>
                                                            <tr id="products_<?php echo $r; ?>">
                                                                <td><button style="float: right;" onclick="removeprocomp(<?php echo $r; ?>);" class="btn btn-danger" type="button">x</button></td>
                                                                <td>
                                                                    <select class="form-control selectpicker" onchange="getproductid(<?php echo $r; ?>);" required='' data-live-search="true" id="pro_id<?php echo $r; ?>" name="logdata[<?php echo $r; ?>][pro_id]">
                                                                        <option value=""></option>
                                                                        <?php
                                                                        if (isset($product_list) && count($product_list) > 0) {
                                                                            foreach ($product_list as $product) {
                                                                        ?>
                                                                                <option value="<?php echo $product->id; ?>" <?php echo ($dval['product_id'] == $product->id) ? 'selected':''; ?>><?php echo cc($product->sub_name); ?> | (<?php echo "PRO-ID".$product->id; ?>)</option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                                <td class="proid<?php echo $r; ?>">PRO-ID<?php echo $dval['product_id']; ?></td>
                                                                <td>
                                                                    <input type="number" id="qty<?php echo $r; ?>" name="logdata[<?php echo $r; ?>][qty]" value='<?php echo $dval['qty']; ?>' readonly='' onkeyup="calculateproductqty(<?php echo $r; ?>);" class="form-control" min='0'>
                                                                </td>
                                                                <td><input type="text" id="width<?php echo $r; ?>" name="logdata[<?php echo $r; ?>][width]" onkeyup="calculateproductqty(<?php echo $r; ?>);" class="form-control" min='0'></td>
                                                                <td><input type="text" id="size<?php echo $r; ?>" name="logdata[<?php echo $r; ?>][size]" onkeyup="calculateproductqty(<?php echo $r; ?>);" class="form-control" min='0'></td>
                                                                <td class="ttlsizecount ttlsize<?php echo $r; ?>" style="font-size: 20px;color: #50f55a;"></td>
                                                            </tr>
                                                <?php            
                                                            $r++;
                                                        }
                                                    }else{
                                                ?>
                                                    <tr id="products_0">
                                                        <td><button style="float: right;" onclick="removeprocomp(0);" class="btn btn-danger" type="button">x</button></td>
                                                        <td>
                                                            <select class="form-control selectpicker" onchange="getproductid(0);" required='' data-live-search="true" id="pro_id0" name="logdata[0][pro_id]">
                                                                <option value=""></option>
                                                                <?php
                                                                if (isset($product_list) && count($product_list) > 0) {
                                                                    foreach ($product_list as $product) {
                                                                ?>
                                                                        <option value="<?php echo $product->id; ?>"><?php echo cc($product->sub_name); ?> | (<?php echo "PRO-ID".$product->id; ?>)</option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td class="proid0"></td>
                                                        <td>
                                                            <input type="number" id="qty0" name="logdata[0][qty]" onkeyup="calculateproductqty(0);" class="form-control" min='0'>
                                                        </td>
                                                        <td><input type="text" id="width0" name="logdata[0][width]" onkeyup="calculateproductqty(0);" class="form-control" min='0'></td>
                                                        <td><input type="text" id="size0" name="logdata[0][size]" onkeyup="calculateproductqty(0);" class="form-control" min='0'></td>
                                                        <td class="ttlsizecount ttlsize0" style="font-size: 20px;color: #50f55a;"></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <div class="col-md-12">
                                            <input type="hidden" name="ttlprodctsize" id="ttlprodctsize" value="0">
                                            <?php if ($section != 'demand'){ ?>
                                                <button style="float: right;" class="btn btn-info addmorepro" value="0" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add More</button>
                                            <?php }else{
                                                echo '<input type="hidden" name="page_type" value="demand">';
                                            }
                                            ?>
                                        </div>
                                    </div>                
                                </div>
                            </div>
                        </div>                        
                        <div style="display:none;" class="btn-bottom-toolbar text-right form-sub-btn">
                            <button class="btn btn-info final-btn" type="submit" onclick="return checkForTheCondition();">Submit</button>
                            <!-- <a href="javascript:void(0);" class="btn btn-info final-btn">Submit</a> -->
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
<div id="productdetailsmodal" class="modal fade " role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content producthtml">

        </div>    
    </div>    
</div>
<div id="createwaste" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Waste</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wasteqty" class="control-label">Qty</label>
                                <input type='number' class='form-control' required='' id='wasteqty' name='wasteqty' min='0'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wastewidth" class="control-label">Width</label>
                                <input type='text' class='form-control' required='' id='wastewidth' name='wastewidth' min='0'>
                            </div>
                        </div>                                       
                    </div>
                </div>                                            
            </div>
            <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-info wastedatabtn">Create</button>
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
// $(document).ready(function() {
//     $('#newtable').DataTable();
// });
function getproconfirmation(value)
{
    var prodid=$('#pro_id'+value).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/site_manager/getproductdetails'); ?>",
        data    : {'prodid' : prodid},
        success : function(data){
            if(data != ''){
                $('#productdetailsmodal').modal({
                    show: 'false'
                });
                $('.producthtml').html(data);
                $(".productdetailsbtn").html('<button type="button" class="btn btn-default close-model" onclick="removeprocomp('+value+');" data-dismiss="modal">Cancel</button><button type="submit" autocomplete="off" data-dismiss="modal" class="btn btn-info">ok</button>');
            }
        }
    });
}
function getproductlogs(warehouse_id){
    var url = "<?php echo site_url('admin/store/getsheetCuttingProductlog/'); ?>";
    $.get(url+warehouse_id, function(data){
        $("#product_store_log_id").html(data);
        $('.selectpicker').selectpicker('refresh');
    });
}
function getproductqty(log_id){
    $(".form-sub-btn").hide();
    $("#qty").val('');
    $("#size").val('');
    $("#width").val('');
    var url = "<?php echo site_url('admin/store/getProductlogQtySize/'); ?>";
    $.ajax({
        type: "GET",
        url: url+log_id,
        success: function (res) {
            if (res != ''){
                data = JSON.parse(res);
                $("#system_qty").val(data.qty);
                $("#system_size").val(data.size);
                $("#system_width").val(data.width);
                $(".form-sub-btn").show();
            }
        }
    });

    /* Sub Product list */
    var addmorepro = $(".addmorepro").val();
    for (let i = 0; i <= addmorepro; i++) {
        get_sub_products(log_id, i);
    }
}

function get_sub_products(log_id, rowindex){
    var url = "<?php echo site_url('admin/store/getSubProductList/'); ?>";
    $.ajax({
        type: "GET",
        url: url+log_id,
        success: function (res) {
            if (res != ''){
                // $(".sub_product_list").html(res);
                $("#pro_id"+rowindex).empty().append(res);
                $('.selectpicker').selectpicker('refresh');
            }
        }
    });
}

function calculatesize(qty){
    if (qty != ''){
        var system_size = $('#system_size').val();
        var system_qty = $('#system_qty').val();
        var system_width = $('#system_width').val();
        
        if (parseFloat(qty) <= system_qty){
            var ttlsize = parseFloat(qty)*(system_size*system_width);
            $(".remainingsize").html(ttlsize);
            $("#size").val(ttlsize);
        }else{
            alert("Qty Should be less than or equals to available qty");
            $("#qty").val('');
            $("#size").val('');
        }
    }
}
$(document).on('click', '.addmorepro', function ()
{
    var product_log_id = $("#product_store_log_id").val();
    var addmore = parseInt($(this).attr('value'));
    var newaddmore = addmore + 1;
    $(this).attr('value', newaddmore);
    $('.product_div').append('<tr id="products_'+newaddmore+'"><td><button style="float: right;" onclick="removeprocomp('+newaddmore+');" class="btn btn-danger" type="button">x</button></td><td><select class="form-control selectpicker" required="" data-live-search="true" onchange="getproductid('+newaddmore+');" id="pro_id'+newaddmore+'" name="logdata['+newaddmore+'][pro_id]"><option value=""></option><?php if(!empty($product_list)) { foreach ($product_list as $key=> $value) { ?> <option value="<?php echo $value->id; ?>"><?php echo $value->sub_name; ?><?php echo " (PRO-ID".$value->id.')'; ?></option> <?php } } ?></select></td><td class="proid'+newaddmore+'"></td><td><input type="number" onkeyup="calculateproductqty('+newaddmore+');" id="qty'+newaddmore+'" name="logdata['+newaddmore+'][qty]" class="form-control" min="0"></td><td><input type="text" id="width'+newaddmore+'" name="logdata['+newaddmore+'][width]" onkeyup="calculateproductqty('+newaddmore+');" class="form-control" min="0"></td><td><input type="text" id="size'+newaddmore+'" name="logdata['+newaddmore+'][size]" onkeyup="calculateproductqty('+newaddmore+');" class="form-control" min="0"></td><td class="ttlsizecount ttlsize'+newaddmore+'" style="font-size: 20px;color: #50f55a;"></td></tr>');
    $('.selectpicker').selectpicker('refresh');
    get_sub_products(product_log_id, newaddmore);
});

$(document).on('click', '.wastedatabtn', function(){
    $("#createwaste").modal('hide');
    var wasteqty = parseInt($("#wasteqty").val());
    var wastewidth = parseInt($("#wastewidth").val());
    if (wasteqty > 0 && wastewidth > 0){

        var product_log_id = $("#product_store_log_id").val();
        var remainingsize = parseInt($(".remainingsize").text());
        var finalqty = (remainingsize/wasteqty);
        var length = (finalqty/wastewidth);
        var addmore = parseInt($('.addmorepro').attr('value'));
        var newaddmore = addmore + 1;
        $('.addmorepro').attr('value', newaddmore);
        $('.product_div').append('<tr id="products_'+newaddmore+'"><td><button style="float: right;" onclick="removeprocomp('+newaddmore+');" class="btn btn-danger" type="button">x</button></td><td><select class="form-control selectpicker" required="" data-live-search="true" onchange="getproductid('+newaddmore+');" id="pro_id'+newaddmore+'" name="logdata['+newaddmore+'][pro_id]"><option value=""></option><?php if(!empty($product_list)) { foreach ($product_list as $key=> $value) { ?> <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?><?php echo " (PRO-ID".$value->id.')'; ?></option> <?php } } ?></select></td><td class="proid'+newaddmore+'"></td><td><input type="number" onkeyup="calculateproductqty('+newaddmore+');" id="qty'+newaddmore+'" name="logdata['+newaddmore+'][qty]" class="form-control" value="'+wasteqty+'" min="0"></td><td><input type="text" id="width'+newaddmore+'" value="'+wastewidth+'" name="logdata['+newaddmore+'][width]" onkeyup="calculateproductqty('+newaddmore+');" class="form-control" min="0"></td><td><input type="text" id="size'+newaddmore+'" value="'+length+'" name="logdata['+newaddmore+'][size]" onkeyup="calculateproductqty('+newaddmore+');" class="form-control" min="0"></td><td class="ttlsizecount ttlsize'+newaddmore+'" style="font-size: 20px;color: #50f55a;"></td></tr>');
        $('.selectpicker').selectpicker('refresh');
        calculateproductqty(newaddmore);
        get_sub_products(product_log_id, newaddmore);
    }
    
});
function getproductid(rowid){
    var proid = $('#pro_id'+rowid).val();
    var url = '<?php echo admin_url("product_new/view/"); ?>'+proid;
    $(".proid"+rowid).html("<a href='"+url+"' target='_blank'>PRO-ID"+proid+"</a>");
    getproconfirmation(rowid);
}

function removeprocomp(procompid)
{
    $('#products_' + procompid).remove();
    calculate_remaining_size();
}

function calculateproductqty(rowid){
    var qty = $('#qty'+rowid).val();
    var size = $('#size'+rowid).val();
    var width = $('#width'+rowid).val();
    
    var ttlprodctsize = $('#ttlprodctsize').val();
    var ttlsize = 0;
    if (qty != '' && size != ''){
        ttlsize = parseFloat(qty)*(parseFloat(size) * parseFloat(width));
    } 
    $(".ttlsize"+rowid).html(ttlsize);
    calculate_remaining_size();
}

function calculate_remaining_size(){
    var main_size = $("#size").val();
    var sizecount = 0;
    $('.ttlsizecount').each(function() {
        var csize = $(this).text();
        if (csize != ''){
            sizecount = parseFloat(sizecount)+parseFloat(csize);
        }
    });
    if (sizecount > 0){
        var ttlremainingsize = parseFloat(main_size)-parseFloat(sizecount);
        $(".remainingsize").html(parseInt(ttlremainingsize));
    }
}

function checkForTheCondition(){
    // var main_size = $("#size").val();
    // var sizecount = 0;
    // $('.ttlsizecount').each(function() {
    //     var csize = $(this).text();
    //     if (csize != ''){
    //         sizecount = parseFloat(sizecount)+parseFloat(csize);
    //     }
    // });
    // var ttlremainingsize = parseFloat(main_size)-parseFloat(sizecount);
    var ttlremainingsize = parseInt($(".remainingsize").text());
   
    // if (parseFloat(sizecount) != parseFloat(main_size)){
    //     alert("Total surface area not equal to final product total used area.");
    //     return false;
    // }
    if (ttlremainingsize > 0){
        alert("Total surface area not equal to final product total used area.");
        return false;
    }
    return true;
}

// function getShopfloorStoredata(){
//     $(".form-sub-btn").hide();
//     var service_type = $("#service_type").val();
//     var warehouse_id = $("#warehouse_id").val();
//     $(".mainstoredata").html("<tr><td colspan='5' class='dataTables_empty' valign='top'>No data available in table</td></tr>");
//     if (service_type != "" && warehouse_id != ""){
//         var url = "<?php echo site_url('admin/store/getShopfloorStoredata'); ?>";
//         $.ajax({
//             type: "POST",
//             url: url,
//             data: {'warehouse_id': warehouse_id},
//             success: function (res) {
//                 if (res != ''){
//                     $(".mainstoredata").html(res);
//                     $(".form-sub-btn").show();
//                 }
//             }
//         });
//     }
// }

</script>


</body>
</html>

