<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'sales_product-form', 'class' => 'sales_product-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4><?php echo $title; ?></h4>
                                <hr/>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_name" class="control-label">Product Name *</label>
                                    <input type="text" id="product_name" name="product_name" class="form-control" required="" value="<?php echo (isset($sales_product['product_name']) && $sales_product['product_name'] != "") ? $sales_product['product_name'] : "" ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea id="description" name="description" class="form-control"><?php echo (isset($sales_product['description']) && $sales_product['description'] != "") ? $sales_product['description'] : "" ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
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
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>

</body>
</html>
