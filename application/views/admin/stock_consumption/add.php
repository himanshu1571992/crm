<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}.error{border:1px solid red !important;} 
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        /*width:inherit;*/ /* Or auto */
        padding:0 10px; /* To give a bit of padding on the left and right */
        border-bottom:none;
    }</style>

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">

            <form action="<?php admin_url('stock_consumption/add') ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <h4><?php echo $title; ?></h4>
                                    <hr/>
                                </div>
                                <div class="col-md-4">
                                    <label for="type" class="control-label">Stock Type</label>
                                    <select class="form-control selectpicker" required="" data-live-search="true" id="stock_type" name="stock_type">
                                        <option value=""></option>
                                        <option value="1">Production</option>
                                        <option value="2">Outsource</option>
                                    </select> 
                                </div>
                                <div class="col-md-4 vender_list" style="display:none;">  
                                    <div class="form-group">
                                        <label for="vender" class="control-label">Vendor</label>
                                        <select class="form-control selectpicker" data-live-search="true" id="vendor_id" name="vendor_id">
                                            <option value=""></option>
                                            <?php
                                            if (isset($vendor_list) && count($vendor_list) > 0) {
                                                foreach ($vendor_list as $vendor) {
                                                    ?>
                                                    <option value="<?php echo $vendor->id; ?>"><?php echo $vendor->name; ?></option>
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
                                        <label for="warehouse_id" class="control-label">Warehouse</label>
                                        <select class="form-control selectpicker" required="" data-live-search="true" id="warehouse_id" name="warehouse_id">
                                            <option value=""></option>
                                            <?php
                                            if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                                foreach ($all_warehouse as $all_warehouse_value) {
                                                    ?>
                                                    <option value="<?php echo $all_warehouse_value->id; ?>"><?php echo $all_warehouse_value->name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="approve_by" class="control-label"><?php echo _l('stock_approve_by'); ?></label>
                                    <select class="form-control selectpicker" multiple data-live-search="true" id="assign" required="" name="assignid[]">
                                        <?php
                                        if (isset($stockdata['approvby'])) {
                                            $approvby = explode(',', $stockdata['approvby']);
                                        }
                                        if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                            foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                                ?>
                                                <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                                    <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                                    <?php
                                                    foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                        ?>
                                                        <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php
                                                        if (isset($approvby) && in_array($singstaff['staffid'], $approvby)) {
                                                            echo'selected';
                                                        }
                                                        ?>><?php echo $singstaff['firstname'] ?></option>
                                                <?php }
                                                ?>
                                                </optgroup>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select> 
                                </div>
                                <div class="col-md-4">
                                    <label for="remark" class="control-label">Remarks</label>
                                    <textarea id="remark" class="form-control" rows="5" name="remark"></textarea>
                                </div>    
                            </div>
                            <br/>
                            <br/>
                            
                            <div class="col-md-12">
                                <div>
                                    <h3>Product To Create</h3>
                                    <hr>
                                    <div class="form-group">
                                        <?php $i = 0; ?>
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                            <thead>
                                                <tr>
                                                    <td style="width:5%"><i class="fa fa-cog"></i></td>
                                                    <td style="width:20%">Product Name</td>
                                                    <td style="width:2%"></td>
                                                    <td style="width:10%">Pro ID</td>
                                                    <td style="width:10%">Available Qty</td>
                                                    <td style="width:10%">Quantity</td>
                                                    <td style="width:30%">Remark</td>
                                                </tr>
                                            </thead>
                                            <tbody class="product_div">
                                                <tr>                                                      
                                                    <td></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control selectpicker col-md-6 product_create" onchange="getproductinfo(<?php echo $i; ?>)" required="" data-live-search="true" id="product_id_<?php echo $i; ?>" name="products[<?php echo $i; ?>][product_id]">
                                                                <option value=""></option>
                                                                <?php
                                                                if (isset($product_info) && count($product_info) > 0) {
                                                                    foreach ($product_info as $value) {
                                                                        ?>
                                                                        <option value="<?php echo $value->id; ?>"><?php echo $value->sub_name ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td id="pro_pview_<?php echo $i; ?>"></td>
                                                    <td><input type="text" id="pro_pid_<?php echo $i; ?>" readonly="" name="products[<?php echo $i; ?>][pro_id]" class="form-control" value="--"></td>
                                                    <td><input type="text" id="available_pqty_<?php echo $i; ?>" readonly="" name="products[<?php echo $i; ?>][available_qty]" class="form-control" value="0"></td>
                                                    <td><input type="number" id="pqty_<?php echo $i; ?>" required="" name="products[<?php echo $i; ?>][qty]" min="1" class="form-control" value="1"></td>                                                                                                  
                                                    <td><textarea id="premark_<?php echo $i; ?>" class="form-control" rows="2" name="products[<?php echo $i; ?>][remark]"></textarea></td>                                                                                                  
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button style="float: right;" class="btn btn-info addmorepro" value="<?php echo $i; ?>" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add More</button>
                                    </div>
                                </div>
                            </div>
                            
                            <br>
                            <br>
                            <div>
                                
                                <div class="col-md-12">
                                    <div>
                                        <h3>Product To Consume</h3>
                                        <?php $j = 0; ?>
                                        <div class="form-group">
                                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                                <thead>
                                                    <tr>
                                                        <td style="width:5%"><i class="fa fa-cog"></i></td>
                                                        <td style="width:20%">Product Name</td>
                                                        <td style="width:2%"></td>
                                                        <td style="width:10%">Pro ID</td>
                                                        <td style="width:10%">Available Qty</td>
                                                        <td style="width:10%">Quantity</td>
                                                        <td style="width:30%">Remark</td>
                                                    </tr>
                                                </thead>
                                                <tbody class="consume_div">
                                                    <tr>                                                      
                                                        <td></td>
                                                        <td>
                                                            <select class="form-control selectpicker product_counsume" required="" onchange="getproductconsumeinfo(<?php echo $j; ?>)"  data-live-search="true" id="product_counsume_id_<?php echo $j; ?>" name="products_consume[<?php echo $j; ?>][product_id]">
                                                                <option value=""></option>
                                                                <?php
                                                                if (isset($product_info) && count($product_info) > 0) {
                                                                    foreach ($product_info as $value) {
                                                                        ?>
                                                                        <option value="<?php echo $value->id; ?>"><?php echo $value->sub_name ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td id="pro_view_<?php echo $i; ?>"></td>
                                                        <td><input type="text" id="pro_id_<?php echo $i; ?>" readonly="" name="products_consume[<?php echo $j; ?>][pro_id]" class="form-control" value="--"></td>
                                                        <td><input type="text" id="available_qty_<?php echo $i; ?>" readonly="" name="products_consume[<?php echo $j; ?>][available_qty]" class="form-control" value="0"></td>
                                                        <td><input type="number" id="qty_<?php echo $i; ?>" required="" name="products_consume[<?php echo $j; ?>][qty]" min="1" class="form-control" value="1"></td>
                                                        <td><textarea id="pcremark_<?php echo $i; ?>" class="form-control" rows="2" name="products_consume[<?php echo $j; ?>][remark]"></textarea></td>   
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <button style="float: right;" class="btn btn-info addmoreprocounsume" value="<?php echo $j; ?>" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add More</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="btn-bottom-toolbar text-right">
                                <button class="btn btn-info" type="submit">Send For Approval</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
    <div class="btn-bottom-pusher"></div>
</div>
</div>
<?php init_tail(); ?>

<script type="text/javascript">
    $('.date').datepicker();


    $(document).on('click', '.addmorepro', function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('.product_div').append('<tr id="products_'+newaddmore+'"><td><button style="float: right;" onclick="removeprocomp('+newaddmore+');" class="btn btn-danger" type="button">x</button></td><td><select class="form-control selectpicker product_create" onchange="getproductinfo('+newaddmore+')" required="" data-live-search="true" id="product_id_'+newaddmore+'" name="products['+newaddmore+'][product_id]"><option value=""></option><?php if(!empty($product_info)) { foreach ($product_info as $key=> $value) { ?> <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option> <?php } } ?></select></td><td id="pro_pview_'+newaddmore+'"></td><td><input type="text" id="pro_pid_'+newaddmore+'" readonly="" name="products['+newaddmore+'][pro_id]" class="form-control" value="--"></td><td><input type="text" id="available_pqty_'+newaddmore+'" readonly="" name="products['+newaddmore+'][available_qty]" class="form-control" value="0"></td><td><input type="number" id="pqty_'+newaddmore+'" required="" name="products['+newaddmore+'][qty]" min="1" class="form-control" value="1"></td><td><textarea id="premark_'+newaddmore+'" class="form-control" rows="2" name="products['+newaddmore+'][remark]"></textarea></td></tr>');
        $('.selectpicker').selectpicker('refresh');
    });

    function removeprocomp(procompid)
    {
        $('#products_' + procompid).remove();
    }

    $(document).on('click', '.addmoreprocounsume', function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('.consume_div').append('<tr id="productscounsume_'+newaddmore+'"><td><button style="float: right;" onclick="removeprocounsume('+newaddmore+');" class="btn btn-danger" type="button">x</button></td><td><select class="form-control selectpicker product_counsume" onchange="getproductconsumeinfo('+newaddmore+')" required="" data-live-search="true" id="product_counsume_id_'+newaddmore+'" name="products_consume['+newaddmore+'][product_id]"><option value=""></option><?php if(!empty($product_info)) { foreach ($product_info as $key=> $value) { ?> <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option> <?php } } ?></select></td><td id="pro_view_'+newaddmore+'"></td><td><input type="text" id="pro_id_'+newaddmore+'" readonly="" name="products_consume['+newaddmore+'][pro_id]" class="form-control" value="--"></td><td><input type="text" id="available_qty_'+newaddmore+'" readonly="" name="products_consume['+newaddmore+'][available_qty]" class="form-control" value="0"></td><td><input type="number" id="qty_'+newaddmore+'" required="" name="products_consume['+newaddmore+'][qty]" min="1" class="form-control" value="1"></td><td><textarea id="pcremark_'+newaddmore+'" class="form-control" rows="2" name="products_consume['+newaddmore+'][remark]"></textarea></td></tr>');
        $('.selectpicker').selectpicker('refresh');
    });

    function removeprocounsume(procompid)
    {
        $('#productscounsume_' + procompid).remove();
    }


    $(document).on('change', '#stock_type', function ()
    {
        var stock_type = $(this).val();
        $(".vender_list").hide();
        if(stock_type == 2){
            $(".vender_list").show();
            $("#vendor_id").attr("required", "");
        }
    });
    
    function getproductinfo(index){
        var product_id = $("#product_id_"+index).val();
        var warehouse_id = $("#warehouse_id").val();
        var service_type = $("#service_type").val();
        if (warehouse_id != "" && service_type != ""){
            var view_url = "<?php echo admin_url('product_new/view/');?>";
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/stock_consumption/get_prodcut_details'); ?>",
                data: {'product_id': product_id, 'warehouse_id': warehouse_id, 'service_type': service_type},
                success: function (res) {
                    var data = JSON.parse(res);
                    $('#pro_pid_' + index).val(data.pro_id);
                    $('#pro_pview_' + index).html('<a target="_blank" href="'+view_url+product_id+'" title="View Product Details"><i class="fa fa-eye"></i></a>');
                    $('#available_pqty_' + index).val(data.availableqty);
                }
            })
        }else{
            alert("Please select warehouse & service_type first");
            var product_id = $("#product_id_"+index).val("");
        }
        
    }
    
    function getproductconsumeinfo(index){
        var product_id = $("#product_counsume_id_"+index).val();
        var warehouse_id = $("#warehouse_id").val();
        var service_type = $("#service_type").val();
        if (warehouse_id != "" && service_type != ""){
            var view_url = "<?php echo admin_url('product_new/view/');?>";
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/stock_consumption/get_prodcut_details'); ?>",
                data: {'product_id': product_id, 'warehouse_id': warehouse_id, 'service_type': service_type},
                success: function (res) {
                    var data = JSON.parse(res);
                    $('#pro_id_' + index).val(data.pro_id);
                    $('#pro_view_' + index).html('<a target="_blank" href="'+view_url+product_id+'" title="View Product Details"><i class="fa fa-eye"></i></a>');
                    $('#available_qty_' + index).val(data.availableqty);
                }
            })
        }else{
            alert("Please select warehouse & service_type first");
            var product_id = $("#product_id_"+index).val("");
        }
        
    }
   
</script>

</body>
</html>