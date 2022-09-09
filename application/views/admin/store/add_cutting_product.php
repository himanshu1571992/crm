
<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'product_conversion', 'class' => 'product_conversion')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>
                                    <?php echo $title; ?>
                                </h3>
                                <hr/>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label for="product" class="control-label">Product</label>
                                        <select class="form-control selectpicker" required='' data-live-search="true" id="product_id" name="product_id">
                                            <option value="">--select product--</option>
                                            <?php 
                                                if (!empty($product_list)){
                                                    foreach ($product_list as $key => $value) {
                                                        $selectcls = (!empty($cuttingproducts_info) && $cuttingproducts_info->product_id == $value->id) ? 'selected' : '';
                                            ?>
                                                    <option value="<?php echo $value->id; ?>" <?php echo $selectcls; ?>><?php echo $value->sub_name.' '.product_code($value->id); ?></option>';
                                            <?php   }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sub_product" class="control-label">Sub Products</label>
                                        <select class="form-control selectpicker" required='' data-live-search="true" id="sub_products_ids" name="sub_products_ids[]" multiple=''>
                                            <option value="">--select product--</option>
                                            <?php 
                                                if (!empty($product_list)){
                                                    foreach ($product_list as $key => $value) {

                                                        $selectcls = '';
                                                        if (!empty($cuttingproducts_info)){
                                                            $sub_products = explode(',', $cuttingproducts_info->sub_products_ids);
                                                            if (in_array($value->id, $sub_products)){
                                                                $selectcls = 'selected';
                                                            }
                                                        }
                                            ?>
                                                    <option value="<?php echo $value->id; ?>" <?php echo $selectcls; ?>><?php echo $value->sub_name.' '.product_code($value->id); ?></option>';
                                            <?php   }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <div class="btn-bottom-toolbar text-right form-sub-btn">
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




</body>
</html>

