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

            <form action="<?php echo site_url($this->uri->uri_string()); ?>" class="stockissue-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <h4><?php echo $title; ?></h4>
                                    <hr/>
                                </div>
                               
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="service_type" class="control-label">Service Type</label>
                                        <select class="form-control selectpicker" required="" data-live-search="true" id="service_type" name="service_type">   
                                            <option value=""></option>                                    
                                            <option value="1">Rent</option>
                                            <option value="2" selected="">Sale</option>                                       
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
                                    <label for="remark" class="control-label">Remarks</label>
                                    <textarea id="remark" class="form-control" rows="5" name="remark"></textarea>
                                </div>    
                            </div>
                            <br/>
                            <br/>
                            
                            <div class="col-md-12">
                                <div>
                                    <h3>Product Issue</h3>
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
                                                    <td><input type="number" id="pqty_<?php echo $i; ?>" required="" name="products[<?php echo $i; ?>][qty]" min="1" class="form-control pqty" data-rid="<?php echo $i; ?>" value="0"></td>                                                                                                  
                                                    <td><textarea id="premark_<?php echo $i; ?>" class="form-control" rows="2" name="products[<?php echo $i; ?>][remark]"></textarea></td>                                                                                                  
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button style="float: right;" class="btn btn-info addmorepro" value="<?php echo $i; ?>" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add More</button>
                                    </div>
                                </div>
                            </div>
                           
                            
                            <div class="btn-bottom-toolbar text-right">
                                <!--<button class="btn btn-info" type="submit">Save</button>-->
                                <a class="btn btn-info transaction-submit" onclick="return confirm('All Information is correct ? Click Ok if yes');" >Save</a>
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
        $('.product_div').append('<tr id="products_'+newaddmore+'"><td><button style="float: right;" onclick="removeprocomp('+newaddmore+');" class="btn btn-danger" type="button">x</button></td><td><select class="form-control selectpicker product_create" onchange="getproductinfo('+newaddmore+')" required="" data-live-search="true" id="product_id_'+newaddmore+'" name="products['+newaddmore+'][product_id]"><option value=""></option><?php if(!empty($product_info)) { foreach ($product_info as $key=> $value) { ?> <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option> <?php } } ?></select></td><td id="pro_pview_'+newaddmore+'"></td><td><input type="text" id="pro_pid_'+newaddmore+'" readonly="" name="products['+newaddmore+'][pro_id]" class="form-control" value="--"></td><td><input type="text" id="available_pqty_'+newaddmore+'" readonly="" name="products['+newaddmore+'][available_qty]" class="form-control" value="0"></td><td><input type="number" id="pqty_'+newaddmore+'" required="" name="products['+newaddmore+'][qty]" min="1" class="form-control pqty" data-rid="'+newaddmore+'" value="0"></td><td><textarea id="premark_'+newaddmore+'" class="form-control" rows="2" name="products['+newaddmore+'][remark]"></textarea></td></tr>');
        $('.selectpicker').selectpicker('refresh');
    });

    function removeprocomp(procompid)
    {
        $('#products_' + procompid).remove();
    }
    
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
            alert("Please select warehouse & service type first");
            var product_id = $("#product_id_"+index).val("");
        }
        
    }
   
   $(".transaction-submit").on("click", function(event){
        event.preventDefault();
        
        var procount = $(".addmorepro").val();
        var ttl_pro = 0;
        var ttl_qty = 0;
        $(".pqty").each(function(){
            ttl_pro++;
            var rid = $(this).data("rid");
            var aval = $("#available_pqty_"+rid).val();
            var pqty = $("#pqty_"+rid).val();
            if ((parseInt(aval) >= parseInt(pqty)) && parseInt(pqty) > 0){
                ttl_qty++;
            }else{
                alert("Please enter qty equal or less then to available qty");
                exit;
            }
        });
        
        if(ttl_qty > 0 && (ttl_qty == ttl_pro)){
            $(".stockissue-form").submit();
        }
    });
</script>

</body>
</html>