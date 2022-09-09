<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <form action="<?php echo admin_url('manufacture_process/final_process');?>" class="final_cutting_form" enctype="multipart/form-data" method="post" accept-charset="utf-8" onsubmit="return confirm('Do you really want to perform cutting action?');">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12">
                                <h4>Final Process</h4>
                                <hr/>
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

                            <div class="col-md-4">
                                <div class="form-group" app-field-wrapper="reference_no">
                                    <label for="reference_no" class="control-label">Reference #</label>
                                    <input type="text" id="reference_no" name="reference_no" class="form-control" value="">
                                </div>                                        
                            </div>

                            <div class="col-md-4">  
                                <div class="form-group">
                                    <label for="product_to_id" class="control-label">Product To Create</label>
                                    <select class="form-control selectpicker" required="" data-live-search="true" id="product_to_id" name="product_to_id">
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
                            </div>

                            <div class="col-md-4">  
                                <div class="form-group">
                                    <label for="product_from_id" class="control-label">Product From Create</label>
                                    <select class="form-control selectpicker" required="" data-live-search="true" id="product_from_id" name="product_from_id">
                                        <option value=""></option>
                                      
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group" app-field-wrapper="quantity">
                                    <label for="quantity" class="control-label">Quantity</label>
                                    <input type="number" id="quantity" required="" name="quantity" class="form-control" value="">
                                </div>                                        
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="warehouse_id" class="control-label">Remarks</label>
                                    <textarea id="remarks" class="form-control" name="remarks"></textarea>
                                </div>
                            </div>

               
                            
                           
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info submit_button" type="button">
                                <?php echo _l('submit'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div> 



            <?php echo form_close(); ?>

        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>

<script type="text/javascript">
    $(document).on('change', '#product_to_id', function() { 
            var product_id = $(this).val();
            
            $.ajax({
                type    : "POST",
                url     : "<?php echo base_url(); ?>admin/manufacture_process/get_from_products",
                data    : {'product_id':product_id},
                success : function(response){
                    if(response != ''){
                        $("#product_from_id").html(response);
                        $('.selectpicker').selectpicker('refresh');
                    }else{
                        $("#product_from_id").html('');
                        $('.selectpicker').selectpicker('refresh');
                    }
                }
            })
                       

    });       
</script>

<script>

$( ".submit_button" ).click(function() {

    var service_type = $("#service_type").val();
    var warehouse_id = $("#warehouse_id").val();
    var product_id = $("#product_from_id").val();
    var quantity = $("#quantity").val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/manufacture_process/check_stock",
        data    : {'product_id':product_id,'quantity':quantity,'service_type':service_type,'warehouse_id':warehouse_id},
        success : function(response){
            if(response == '1'){
                $( ".final_cutting_form" ).submit();
                
            }else{
                alert('Not enough quantity in stock!');
                event.preventDefault();
            }
        }
    })
  
});

</script>


</body>
</html>
