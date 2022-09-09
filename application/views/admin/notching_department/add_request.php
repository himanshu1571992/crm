<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <form action="<?php echo admin_url('notching_department/add_request');?>" class="proposal-form" id="request_form" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12">
                                <h4>Notching Item Request</h4>
                                <hr/>
                            </div>

                             <div class="col-md-4">  
                                <div class="form-group">
                                    <label for="product_id" class="control-label">Select Product</label>
                                    <select class="form-control selectpicker" required="" data-live-search="true" id="product_id" name="product_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($product_info) && count($product_info) > 0) {
                                            foreach ($product_info as $value) {
                                                ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['sub_name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group" app-field-wrapper="quantity">
                                    <label for="quantity" class="control-label">Quantity</label>
                                    <input type="number" id="quantity" name="quantity" class="form-control" value="">
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
                                <div class="form-group">
                                    <label for="warehouse_id" class="control-label">Remarks</label>
                                    <textarea id="remarks" class="form-control" name="remarks"></textarea>
                                </div>
                            </div>

                            
                           
                        </div>
                        
                    </div>
                </div>
            </div> 

            <div id="table_data">
                    

            </div>  


            <?php echo form_close(); ?>

        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>


<script type="text/javascript">
    $(document).on('change', '#quantity', function() { 
            var product_id = $("#product_id").val();
            var quantity = $("#quantity").val();

            $.ajax({
                type    : "POST",
                url     : "<?php echo base_url(); ?>admin/notching_department/get_component_details",
                data    : {'product_id' : product_id,'quantity' : quantity},
                success : function(response){
                    if(response != ''){
                        $("#table_data").html(response);
                        $('.selectpicker').selectpicker('refresh');

                        $("#quantity").attr("readonly", true);
                    }else{
                        alert('Components Not Found!');
                        $("#table_data").html(' ');
                    }
                }
            })

    });       
</script>


<script type="text/javascript">
    $(document).on('click', '#submit_request', function() { 
            var service_type = $("#service_type").val();
            var warehouse_id = $("#warehouse_id").val();

            if(service_type != '' && warehouse_id != ''){

                var atLeastOneIsChecked = $('input[name="item_id[]"]:checked').length > 0;
                if(atLeastOneIsChecked){
                   $("#request_form").submit();
                }else{
                    alert('Components are not Selected!')
                }
                
            }else{
                alert('Service Type Or Warehouse is not selected!')
            }
            

    });       
</script>

<script type="text/javascript">
    $(document).on('click', '.action', function() { 
            var id = $(this).val();
            if($(this).prop("checked") == true){
                
                var req_qty = parseInt($("#qty"+id).val());

                if(req_qty > 0 ){

                        $("#qty"+id).attr("readonly", true);
                }else{
                    $(this).prop('checked', false);
                    alert('Please add required quantity first!');
                }
            }else{
                $("#qty"+id).attr("readonly", false);
            }
    });
</script>


</body>
</html>
