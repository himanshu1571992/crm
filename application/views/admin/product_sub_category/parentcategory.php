<?php init_head(); ?>

<div id="wrapper">

    <div class="content accounting-template">

        <div class="row">



           <?php echo form_open($this->uri->uri_string(), array('id' => 'product_sub_category-form', 'class' => 'proposal-form')); ?>

            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">

                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>

                    <hr class="hr-panel-heading">



                        <div class="row">

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label">Product Parent Category *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($product_sub_category_data['name']) && $product_sub_category_data['name'] != "") ? $product_sub_category_data['name'] : "" ?>">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label for="color" class="control-label"><?php echo _l('product_category_name'); ?> *</label>
                                    <select class="form-control selectpicker" required data-live-search="true" id="root_category_id" name="root_category_id">

                                        <option value=""></option>

                                        <?php

                                        

                                        if (isset($pro_category_data) && count($pro_category_data) > 0) {

                                            foreach ($pro_category_data as $pro_category_key => $pro_category_value) {

                                                ?>

                                                <option value="<?php echo $pro_category_value['id'] ?>" <?php echo (isset($product_sub_category_data['root_category_id']) && $product_sub_category_data['root_category_id']==$pro_category_value['id']) ? 'selected' : "" ?>><?php echo cc($pro_category_value['name']); ?></option>

                                                <?php

                                            }

                                        }

                                        ?>

                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label for="status" class="control-label"><?php echo _l('product_sub_category_status'); ?> *</label>
                                    <select class="form-control selectpicker" name="status" required="">

                                        <option value=""></option>

                                        <option value="1" <?php echo (isset($product_sub_category_data['status']) && $product_sub_category_data['status'] == 1) ? 'selected' : "" ?>>Enable</option>

                                        <option value="0" <?php echo (isset($product_sub_category_data['status']) && $product_sub_category_data['status'] == 0) ? 'selected' : "" ?>>Disable</option>

                                    </select>
                                </div>
                            </div>
                            
                            </div>

                        </div>



                        <div class="btn-bottom-toolbar text-right">

                            <button class="btn btn-info" type="submit">

                                <?php echo 'Submit'; ?>

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

