<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'temperory_product-form', 'class' => 'temperory_product-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="product_cat_id" class="control-label">Product Main Category</label>
                                    <select class="form-control selectpicker" required=""  data-live-search="true" id="product_cat_id" name="product_cat_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($pro_cat_data) && count($pro_cat_data) > 0) {
                                            foreach ($pro_cat_data as $pro_cat_key => $pro_cat_value) {
                                                ?>
                                                <option value="<?php echo $pro_cat_value['id'] ?>" <?php echo (isset($product_data['category_id']) && $product_data['category_id'] == $pro_cat_value['id']) ? 'selected' : "" ?>><?php echo cc($pro_cat_value['name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="unit" class="control-label">Unit</label>
                                        <select class="form-control selectpicker" data-live-search="true" id="unit" name="unit">
                                            <option value=""></option>
                                            <?php
                                            if (isset($unit_data) && count($unit_data) > 0) {
                                                foreach ($unit_data as $unit_key => $unit_value) {
                                                    ?>
                                                    <option value="<?php echo $unit_value['id'] ?>" <?php echo (isset($product_data['unit']) && $product_data['unit'] == $unit_value['id']) ? 'selected' : "" ?>><?php echo $unit_value['name'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="control-label">Assigned</label>
                                    <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assignid[]">



                                                <?php

                                                if (isset($allStaffdata) && count($allStaffdata) > 0) {

                                                    foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {

                                                        ?>

                                                        <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">

                                                            <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>

                                                            <?php

                                                            foreach ($Staffgroup_value['staffs'] as $singstaff) {

                                                                ?>

                                                                <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php

                                                                if (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) {

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
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_name" class="control-label">Product Name </label>
                                    <input type="text" id="product_name" name="product_name" class="form-control" required="" value="<?php echo (isset($product_data['product_name']) && $product_data['product_name'] != "") ? $product_data['product_name'] : "" ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_price" class="control-label">Product Price </label>
                                    <input type="text" id="product_price" name="product_price" class="form-control" required="" value="<?php echo (isset($product_data['price']) && $product_data['price'] != "") ? $product_data['price'] : "" ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sac" class="control-label">SAC Code </label>
                                    <input type="text" id="sac" name="sac" class="form-control" required="" value="<?php echo (isset($product_data['sac']) && $product_data['sac'] != "") ? $product_data['sac'] : "" ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hsn" class="control-label">HSN Code</label>
                                    <input type="text" id="hsn" name="hsn" class="form-control" required="" value="<?php echo (isset($product_data['hsn']) && $product_data['hsn'] != "") ? $product_data['hsn'] : "" ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description" class="control-label">Product Description</label>
                                    <textarea id="description" style="height: 110px;" name="description" class="form-control"><?php echo (isset($product_data['product_desc']) && $product_data['product_desc'] != "") ? $product_data['product_desc'] : "" ?></textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description" class="control-label">Drawing Image</label>
                                    <input type="file" id="product_image" name="product_image">
                                    <?php if (isset($product_data['file_name']) && $product_data['file_name'] != "") { ?>
                                    <a target="_blank" href="<?php echo base_url('uploads/temperory_product/'.$product_data['id'].'/'.$product_data['file_name']); ?>"><?php echo $product_data['file_name']; ?>
                                    </a> <?php } ?>
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

    /*function staffdropdown()

    { 

        $.each($("#assign option:selected"), function () { 

            var select = $(this).val(); 

            $("optgroup." + select).children().attr('selected', 'selected');

        });

        $('.selectpicker').selectpicker('refresh');

        $.each($("#assign option:not(:selected)"), function () {

            var select = $(this).val(); 

            $("optgroup." + select).children().removeAttr('selected');

        });

        $('.selectpicker').selectpicker('refresh');

    }*/
</script>

</body>
</html>
