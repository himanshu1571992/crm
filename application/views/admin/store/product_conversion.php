
<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'product_conversion', 'class' => 'product_conversion', 'onsubmit' => "return confirm('Do you really want to perform conversion action?');")); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                <h3><?php echo $title; ?>
                                        <div class="pull-right" style="margin-top:-6px;"><label class="control-label">Product Stay in Shop Floor</label> <input type="checkbox" value="1" name="product_stay"></div>
                                    </h3>

                                <hr/>
                            </div>
                                
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
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="date" class="control-label">Date</label>
                                        <div class="input-group date">
                                            <input id="date" name="date" required='' class="form-control datepicker" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
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
                                                    <th width='25%'>Product Name</th>
                                                    <th width='15%'>Qty</th>
                                                    <th width='15%'>BOQ List</th>
                                                    <th width='2%'>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="product_div">
                                                <tr id="products_0">
                                                    <td>
                                                        <select class="form-control selectpicker storeproduct" required='' data-live-search="true" onchange="getproductboq(this.value, 0);" id="pro_id0" name="logdata[0][pro_id]">
                                                            <option value=""></option>
                                                            <?php
                                                                if (isset($product_list)){
                                                                    foreach ($product_list as $key => $value) {
                                                            ?>
                                                                        <option value="<?php echo $value->id; ?>"><?php echo cc($value->sub_name); ?> | (<?php echo "PRO-ID".$value->id; ?>)</option>
                                                            <?php            
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td><input type="number" id="qty0" onkeyup="resetproductitems();" name="logdata[0][qty]" required='' data-rid="0" class="form-control proitemqty" min='1'></td>
                                                    <td id="boq0"></td>
                                                    <td><button style="float: right;" onclick="removeprocomp(0);" class="btn btn-danger" type="button">x</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="col-md-12">
                                            <button style="float: right;" class="btn btn-info addmorepro" value="0" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add More</button>
                                        </div>
                                        <div class="col-md-12">
                                             <button style="float: left;" class="btn btn-success get_components" value="0" type="button"> Get Components</button>
                                        </div>
                                    </div>                
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="container-fluid component_table_div">

                                </div>
                            </div>        
                        </div>                        
                        <div style="display:none;" class="btn-bottom-toolbar text-right form-sub-btn">
                            <button class="btn btn-info final-btn" type="submit" >Submit</button>
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
<div id="productitems" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Product Item List</h4>
      </div>
      <div class="modal-body productitems_div">
        
       
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
// $(document).ready(function() {
//     $('#newtable').DataTable();
// });

function getproductboq(log_id, rowid){
    var boqurl = "<a href='javascript:void(0)' data-id='"+log_id+"' class='btn-sm btn-info productboq'>View</a>";
    $("#boq"+rowid).html(boqurl);
    getproconfirmation(rowid);
}

$(document).on("click", ".productboq", function(){
    var log_id = $(this).data("id");
    var url = "<?php echo site_url('admin/store/getProductItems/'); ?>";
    $.get(url+log_id, function(data){
        if (data != ''){
            $('#productitems').modal('show');
            $('.productitems_div').html(data);
        }
    });
});

$(document).on('click', '.get_components', function() {
    var warehouse_id = $("#warehouse_id").val();
    if (warehouse_id == ""){
        alert("Please Select Warehouse First");
    }else{
        var proqtycount = 1;
        $(".proitemqty").each(function(){
            var proqty = $(this).val();
            if (proqty == "" || proqty == "0"){
                proqtycount = 0;
            }
        });
        if (warehouse_id != "" && proqtycount > 0){
            $.ajax({
                type    : "POST",
                url     : "<?php echo base_url(); ?>admin/store/get_components",
                data    : $('#product_conversion').serialize(),
                success : function(response){
                    if(response != ''){
                        $(".component_table_div").html(response);
                        var avaibilityofqty = $(".avaibilityofqty").val();
                        $(".form-sub-btn").hide();
                        if (avaibilityofqty > 0){
                            $(".form-sub-btn").show();
                        }
                    }
                }
            });
        }else{
            alert("Please enter product qty first");
        }
    }
    
});

function resetproductitems(){
    $(".component_table_div").html("");
    $(".form-sub-btn").hide();
}

$(document).on('click', '.addmorepro', function ()
{
    var addmore = parseInt($(this).attr('value'));
    var newaddmore = addmore + 1;
    $(this).attr('value', newaddmore);
    $('.product_div').append('<tr id="products_'+newaddmore+'"><td><select class="form-control selectpicker" required="" data-live-search="true" id="pro_id'+newaddmore+'" onchange="getproductboq(this.value, '+newaddmore+')" name="logdata['+newaddmore+'][pro_id]"><option value=""></option><?php if(!empty($product_list)) { foreach ($product_list as $key=> $value) { ?> <option value="<?php echo $value->id; ?>"><?php echo $value->sub_name.'| ( PRO-ID'.$value->id.' )'; ?></option> <?php } } ?></select></td><td><input type="number" onkeyup="resetproductitems();" id="qty'+newaddmore+'" name="logdata['+newaddmore+'][qty]" required="" class="form-control proitemqty" data-rid="'+newaddmore+'" min="1"></td><td id="boq'+newaddmore+'" ></td><td><button style="float: right;" onclick="removeprocomp('+newaddmore+');" class="btn btn-danger" type="button">x</button></td></tr>');
    $('.selectpicker').selectpicker('refresh');
    resetproductitems();
});

function removeprocomp(procompid)
{
    $('#products_' + procompid).remove();
    resetproductitems();
}


</script>


</body>
</html>

