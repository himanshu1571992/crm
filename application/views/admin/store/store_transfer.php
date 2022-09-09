
<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'main_store_issue', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4><?php echo $title; ?></h4>
                                <hr/>
                                <div class="col-md-3">  
                                    <div class="form-group">
                                        <label for="warehouse_id" class="control-label">Issue Store</label>
                                        <select class="form-control selectpicker" required='' onchange="gettransferproducts(0);" data-live-search="true" id="issue_store" name="issue_store">
                                            <option value=""></option>
                                            <option value="1">Main Store</option>
                                            <option value="2">Shop Floor</option>
                                            <option value="3">Finished Goods</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="date" class="control-label">Date</label>
                                        <div class="input-group date">
                                            <input id="date" name="date" required='' class="form-control datepicker" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">  
                                    <div class="form-group">
                                        <label for="warehouse_id" class="control-label">From Warehouse</label>
                                        <select class="form-control selectpicker" required='' onchange="gettransferproducts(0);" data-live-search="true" id="from_warehouse" name="from_warehouse">
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
                                <div class="col-md-3">  
                                    <div class="form-group">
                                        <label for="warehouse_id" class="control-label">To Warehouse</label>
                                        <select class="form-control selectpicker" required='' data-live-search="true" id="to_warehouse" name="to_warehouse">
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
                                <div class="col-md-12">
                                    <div class="form-group" app-field-wrapper="remark">
                                        <label for="remark" class="control-label">Remark</label>
                                        <textarea id="remark" class="form-control" rows="4" required='' name="remark"></textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <hr> 
                            <div class="col-md-12">
                                <div class="container-fluid">
                                    <div class="table-responsive">  
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable" id="newtable">
                                            <thead>
                                                <tr>
                                                    <th width='2%'>#</th>
                                                    <th width='35%' align="center">Product Name</th>
                                                    <th align="center">Product ID</th>
                                                    <th align="center">Available Qty</th>
                                                    <th align="center">Issue Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody class="product_div">
                                                <tr id="products_0">
                                                    <td></td>
                                                    <td>
                                                        <select class="form-control selectpicker storeproduct" required='' data-live-search="true" onchange="getproductstoreqty(this.value, 0);" id="pro_id0" name="logdata[0][pro_log_id]">
                                                            <option value=""></option>
                                                        </select>
                                                    </td>
                                                    <td id="proid0" align="center"></td>
                                                    <td>
                                                        <input type="number" id="availableqty0" readonly="" name="logdata[0][availableqty]" class="form-control" min='0'>
                                                    </td>
                                                    <td><input type="number" id="qty0" name="logdata[0][qty]" required='' onkeyup="calculateproductqty(0);" data-rid="0" class="form-control issue_qty_cls" min='1'></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="col-md-12">
                                            <button style="float: right;" class="btn btn-info addmorepro" value="0" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add More</button>
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

$("#from_warehouse").change(function() {
    var opt1 = $(this).val();
    var opt2 = $("#to_warehouse").val();
    if (opt1 == opt2){
        $('#to_warehouse').val('').trigger("change");
    }
});

$("#to_warehouse").change(function() {
    var opt1 = $(this).val();
    var opt2 = $("#from_warehouse").val();
    if (opt1 == opt2){
        $('#from_warehouse').val('').trigger("change");
    }
});

function getproductlogs(warehouse_id){
    var url = "<?php echo site_url('admin/store/getCuttingProductlog/'); ?>";
    $.get(url+warehouse_id, function(data){
        $("#product_store_log_id").html(data);
        $('.selectpicker').selectpicker('refresh');
    });
}

function gettransferproducts(rowid){
    $(".form-sub-btn").hide();
    var issue_store = $("#issue_store").val();
    var warehouse_id = $("#from_warehouse").val();
    if (warehouse_id != "" && issue_store != ""){
        var url = "<?php echo site_url('admin/store/gettransferproducts'); ?>";
        $.ajax({
            type: "POST",
            url: url,
            data: {'warehouse_id': warehouse_id, 'issue_store': issue_store},
            success: function (data) {
                $("#pro_id"+rowid).html(data);
                $('.selectpicker').selectpicker('refresh');
                $(".form-sub-btn").show();
            }
        });
    }
}

function getproductstoreqty(log_id, rowid){
    
    /* this script use for check product not select again */
    if (rowid > 0){
        $('.storeproduct').each(function() {
            var productlogid = $(this).val();
            
            if (productlogid != ""){
                if (productlogid == log_id){
                    alert("Product already selected");
                    removeprocomp(rowid);
                }
            }
        });
    }
    
    
    $("#qty").val('');
    $("#size").val('');
    var url = "<?php echo site_url('admin/store/getProductlogQtySize/'); ?>";
    $.ajax({
        type: "GET",
        url: url+log_id,
        success: function (res) {
            if (res != ''){
                data = JSON.parse(res);
                $("#proid"+rowid).html(data.pro_id);
                $("#availableqty"+rowid).val(data.qty);
            }
        }
    });
    $("#pro_id"+rowid).addClass("storeproduct");
}

$(document).on('click', '.addmorepro', function ()
{
    var addmore = parseInt($(this).attr('value'));
    var newaddmore = addmore + 1;
    $(this).attr('value', newaddmore);
    $('.product_div').append('<tr id="products_'+newaddmore+'"><td><button style="float: right;" onclick="removeprocomp('+newaddmore+');" class="btn btn-danger" type="button">x</button></td><td><select class="form-control selectpicker" required="" data-live-search="true" id="pro_id'+newaddmore+'" onchange="getproductstoreqty(this.value, '+newaddmore+')" name="logdata['+newaddmore+'][pro_log_id]"><option value=""></option></select></td><td id="proid'+newaddmore+'" align="center"></td><td><input type="number" id="availableqty'+newaddmore+'" name="logdata['+newaddmore+'][availableqty]" readonly="" class="form-control" min="0"></td><td><input type="number" id="qty'+newaddmore+'" name="logdata['+newaddmore+'][qty]" required="" onkeyup="calculateproductqty('+newaddmore+')" class="form-control issue_qty_cls" data-rid="'+newaddmore+'" min="1"></td></tr>');
    $('.selectpicker').selectpicker('refresh');
    gettransferproducts(newaddmore);
});

function removeprocomp(procompid)
{
    $('#products_' + procompid).remove();
}

function calculateproductqty(rowid){
    var availableqty = $('#availableqty'+rowid).val();
    var qty = $('#qty'+rowid).val();
    
    if (qty != "" && availableqty != ""){
        if (parseFloat(qty) > parseFloat(availableqty)){
            alert("Issue Qty Should be less than or equals to available qty");
            $('#qty'+rowid).val('');
        }
    } 
}
function checkForTheCondition(){
    var count = 0;
    $('.issue_qty_cls').each(function() {
        var rowid = $(this).data('rid');
        var availableqty = $('#availableqty'+rowid).val();
        var qty = $('#qty'+rowid).val();
        
        if (qty != "" && availableqty != ""){
            if (parseFloat(qty) > parseFloat(availableqty)){
                count++; 
            }
        }
    });
    
    if (count > 0){
        alert("Issue Qty Should be less than or equals to available qty");
        return false;
    }
    return true;
}

</script>


</body>
</html>

