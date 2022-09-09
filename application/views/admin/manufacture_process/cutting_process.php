<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <form action="<?php echo admin_url('manufacture_process/cutting_process');?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8" onsubmit="return confirm('Do you really want to perform cutting action?');">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12">
                                <h4>Cutting Process</h4>
                                <hr/>
                            </div>

                             <div class="col-md-4">  
                                <div class="form-group">
                                    <label for="request_id" class="control-label">Select Request</label>
                                    <select class="form-control selectpicker" required="" data-live-search="true" id="request_id" name="request_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($request_info) && count($request_info) > 0) {
                                            foreach ($request_info as $all_warehouse_key => $value) {
                                                ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo 'CUT-REQ-'.str_pad($value['id'], 4, '0', STR_PAD_LEFT);?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group" app-field-wrapper="service_name">
                                    <label for="service_name" class="control-label">Service Type</label>
                                    <input type="text" id="service_name" readonly="" class="form-control" value="">
                                </div>                                        
                            </div>

                            <div class="col-md-4">
                                <div class="form-group" app-field-wrapper="warehouse_name">
                                    <label for="warehouse_name" class="control-label">Warehouse</label>
                                    <input type="text" id="warehouse_name" readonly="" class="form-control" value="">
                                </div>                                        
                            </div>

                            <input type="hidden" name="service_type" id="service_type">
                            <input type="hidden" name="warehouse_id" id="warehouse_id">

                           <!--  <div class="col-md-4">
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
                            </div> -->

                            <div class="col-md-4">
                                <div class="form-group" app-field-wrapper="reference_no">
                                    <label for="reference_no" class="control-label">Reference #</label>
                                    <input type="text" id="reference_no" name="reference_no" class="form-control" value="">
                                </div>                                        
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="warehouse_id" class="control-label">Remarks</label>
                                    <textarea id="remarks" class="form-control" name="remarks"></textarea>
                                </div>
                            </div>

                        
                            
                           
                                                        
                            
                            
                           
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
    $(document).on('change', '#request_id', function() { 
            var request_id = $(this).val();

            $.ajax({
                type    : "POST",
                url     : "<?php echo base_url(); ?>admin/manufacture_process/get_request_details",
                data    : {'request_id' : request_id},
                success : function(response){
                    if(response != ''){
                        $("#bundle_table").html(response);
                    }else{
                        $("#bundle_table").html(' ');
                    }
                }
            })

    });       
</script>

<script type="text/javascript">
    $(document).on('change', '#request_id', function() { 
            var request_id = $(this).val();

            $.ajax({
                type    : "POST",
                url     : "<?php echo base_url(); ?>admin/manufacture_process/get_servicetype_warehouse",
                data    : {'request_id' : request_id},
                dataType: "json",
                success : function(response){
                    if(response != ''){
                        $("#warehouse_id").val(response.warehouse_id);
                        $("#service_type").val(response.service_type);
                        $("#service_name").val(response.service_name);
                        $("#warehouse_name").val(response.warehouse_name);
                    }else{
                        $("#warehouse_id").val('');
                        $("#service_type").val('');
                        $("#service_name").val('');
                        $("#warehouse_name").val('');
                    }
                }
            })

    });       
</script>


</body>
</html>
