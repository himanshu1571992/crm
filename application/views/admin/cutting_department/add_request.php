<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <form action="<?php echo admin_url('cutting_department/add_request');?>" class="proposal-form" id="request_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12">
                                <h4>Cutting Item Request</h4>
                                <hr/>
                            </div>

                            <div class="col-md-4">  
                                <div class="form-group">
                                    <label for="department_id" class="control-label">Select Department</label>
                                    <select class="form-control selectpicker" required="" data-live-search="true" id="department_id" name="department_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($department_info) && count($department_info) > 0) {
                                            foreach ($department_info as $value) {
                                                ?>
                                                <option value="<?php echo $value['id'] ?>" <?php echo (isset($stockdata['department_id']) && $stockdata['department_id'] == $all_warehouse_value['id']) ? 'selected' : "" ?>><?php echo $value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                              <div class="col-md-4">
                                <div class="form-group">
                                    <label for="service_type" class="control-label">Service Type</label>
                                    <select class="form-control selectpicker" required="" data-live-search="true" id="service_type" name="service_type">   
                                        <option value=""></option>                                    
                                        <option value="1">Rent</option>
                                        <option value="2">Sale</option>                                       
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">  
                                <div class="form-group">
                                    <label for="warehouse_id" class="control-label"><?php echo _l('stock_warehouse'); ?></label>
                                    <select class="form-control selectpicker" required="" data-live-search="true" id="warehouse_id" name="warehouse_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                            foreach ($all_warehouse as $all_warehouse_key => $all_warehouse_value) {
                                                ?>
                                                <option value="<?php echo $all_warehouse_value['id'] ?>" <?php echo (isset($stockdata['warehouse_id']) && $stockdata['warehouse_id'] == $all_warehouse_value['id']) ? 'selected' : "" ?>><?php echo $all_warehouse_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="warehouse_id" class="control-label">Remarks</label>
                                    <textarea id="remarks" class="form-control" name="remarks"></textarea>
                                </div>
                            </div>

                        
                            
                           
                            <div class="col-md-12" style="margin-bottom:5%;">   
                            
                            </div>
                            
                            <div class="table-responsive s_table compdv">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable" style="margin-top:2%; !important">
                                    <thead>
                                        <tr>
                                            <th width="32%" align="left">Product Name</th>
                                            <th width="5%" align="left">View</th>
                                            <th width="10%" class="qty" align="left">Size (MM)</th>
                                            <th width="10%" class="qty" align="left">Qty (Pcs)</th>
                                            <th width="10%" class="qty" align="left">Waste per pcs (MM)</th>
                                            <th width="5%"  align="center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <tr class="main" id="tr0">
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control selectpicker" onchange="get_comp_det(0,this.value)" data-live-search="true" id="product_id" name="product_id">
                                                        <option value=""></option>
                                                        <?php
                                                        if (isset($product_info) && count($product_info) > 0) {
                                                            foreach ($product_info as $item_value) {                                                           
                                                                ?>
                                                                <option value="<?php echo $item_value['id'] ?>"><?php echo $item_value['sub_name']; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td id="view0"></td>

                                            <td>
                                                <div class="form-group">
                                                    <input id="product_size" readonly="" name="product_size" class="form-control" >
                                                </div>
                                            </td>
                                            
                                            <td>
                                                <div class="form-group">
                                                    <input type="number" id="product_qty" name="product_qty" class="form-control" >
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <input type="number" id="waste" name="waste" class="form-control" >
                                                </div>
                                            </td>

                                            <td>
                                                <button type="button" id="get_bundles" class="btn pull-right btn-info"  >Get Bundles</i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div>
                            
                           
                        </div>
                        <div class="btn-bottom-toolbar text-right" hidden>
                            <button class="btn btn-info" type="button" id="request_submit">Send Request</button>
                        </div>
                    </div>
                </div>
            </div> 

            <div id="bundle_table">
                    

            </div>  


            <?php echo form_close(); ?>

        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>

<script type="text/javascript">
    function get_comp_det(proid,value)
    {
        var component_id = value;
        $('#view'+proid).html('<a href="../product/product/'+component_id+'" target="_blank">view</a>');


        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url(); ?>admin/manufacture/get_product_details",
            dataType: "json",
            data    : {'id' : component_id},
            success : function(response){
                if(response != ''){
                    $("#product_size").val(response.size);
                }
            }
        })
        
    }
</script>

<script type="text/javascript">
    $(document).on('click', '#get_bundles', function() { 
            var size = $("#product_size").val();
            var product_id = $("#product_id").val();
            var product_qty = $("#product_qty").val();
            var waste = $("#waste").val();
            var service_type = $("#service_type").val();
            var warehouse_id = $("#warehouse_id").val();
            
            if(size > 0){
                if(product_qty > 0){
                    if(service_type > 0 && warehouse_id > 0){
                        $.ajax({
                            type    : "POST",
                            url     : "<?php echo base_url(); ?>admin/manufacture_process/get_bundels_table",
                            data    : {'size' : size, 'product_id':product_id, 'waste' : waste, 'service_type':service_type, 'warehouse_id' : warehouse_id},
                            success : function(response){
                                if(response != ''){
                                    $("#bundle_table").html(response);
                                    $(".btn-bottom-toolbar").show();
                                }
                            }
                        })
                    }else{
                        alert('Please Select Service type Or Warehouse!');
                    }
                 }else{
                    alert('Please Add Quantity of the product!');
                }
            }else{
                alert('Please Add size for the product!');
            }            

    });       
</script>

<script type="text/javascript">
    $(document).on('keyup', '.req_qty', function() { 
        var id = $(this).attr('val');
        var req_qty = parseInt($(this).val());

        var qty = parseInt($("#qty"+id).val());
        // alert(req_qty+' - '+qty);   
        if(req_qty > qty){
            alert('Quantity is grater required quantity!');
            $(this).val(' ');
        }
    });
</script>

<script type="text/javascript">
    $(document).on('click', '.action', function() { 
            var id = $(this).val();
            if($(this).prop("checked") == true){
                
                var req_qty = parseInt($("#req_qty"+id).val());

                var product_size = parseInt($("#product_size").val());
                var product_qty = parseInt($("#product_qty").val());
                var waste = parseInt($("#waste").val());



                if(req_qty > 0 ){

                        var ItemArray = [];
                        $.each($("input[name='bundles[]']:checked"), function(){
                            var bundle_id = $(this).val();
                            var r_qty = parseInt($("#req_qty"+bundle_id).val());
                            var item_size = parseInt($("#item_size"+bundle_id).val());
                            ItemArray.push({
                                    size : item_size, 
                                    qty : r_qty
                                });
                        }); 
                        

                        $.ajax({
                            type    : "POST",
                            url     : "<?php echo base_url(); ?>admin/manufacture_process/check_bundles_entry",
                            data    : {'itemdata' : ItemArray, 'product_size' : product_size, 'waste' : waste, 'product_qty' : product_qty},
                            success : function(response){
                                if(response != ''){
                                    if(response < 0){
                                        $("#action"+id).prop('checked', false);
                                        $("#req_qty"+id).val('');
                                        //alert('Invalid Selection for pipe!');
                                        alert('Requirement fulfilled!');
                                    }else{
                                        $("#req_qty"+id).attr("readonly", true);
                                    }
                                }
                            }
                        })


                }else{
                    $(this).prop('checked', false);
                    alert('Please add required quantity first!');
                }
            }else{
                $("#req_qty"+id).attr("readonly", false);
            }
    });
</script>



<script type="text/javascript">
    $(document).on('click', '#request_submit', function() { 
            var product_size = parseInt($("#product_size").val());
            var product_qty = parseInt($("#product_qty").val());
            var waste = parseInt($("#waste").val());
            var ItemArray = [];

            $.each($("input[name='bundles[]']:checked"), function(){
                var bundle_id = $(this).val();
                var r_qty = parseInt($("#req_qty"+bundle_id).val());
                var item_size = parseInt($("#item_size"+bundle_id).val());
                ItemArray.push({
                        size : item_size, 
                        qty : r_qty
                    });
            }); 
            

            $.ajax({
                type    : "POST",
                url     : "<?php echo base_url(); ?>admin/manufacture_process/check_bundles_entry",
                data    : {'itemdata' : ItemArray, 'product_size' : product_size, 'waste' : waste, 'product_qty' : product_qty},
                success : function(response){
                    if(response != ''){
                        if(response == 0){
                            $("#request_form").submit();
                        }else{
                            alert('Requirement is not fulfilled!');
                        }
                    }
                }
            })
    });
</script>

</body>
</html>
