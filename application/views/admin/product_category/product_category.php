<?php init_head(); ?>

<div id="wrapper">

    <div class="content accounting-template">

        <div class="row">



            <?php echo form_open($this->uri->uri_string(), array('id' => 'product_category-form', 'class' => 'proposal-form')); ?>

            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">

                        <div class="row">

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label"><?php echo _l('product_category_name'); ?> *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($product_category_data['name']) && $product_category_data['name'] != "") ? $product_category_data['name'] : "" ?>">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label for="color" class="control-label"><?php echo _l('product_category_color'); ?> *</label>
                                    <div id="color-group" class="input-group colorpicker-component">
                                        <input type="text" id="color" name="color" class="form-control" required="" value="<?php echo (isset($product_category_data['color']) && $product_category_data['color'] != "") ? $product_category_data['color'] : "" ?>">
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <input type="checkbox"  name="for_service" value="1" <?php if(!empty($product_category_data) && $product_category_data['for_service'] == 1) { echo 'checked'; }?> >
                                    <label for="client_cat_id" class="control-label">Category For Service</label>

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <!-- <div class="col-xs-12 col-md-8">
								<div class="form-group">
									<label for="client_cat_id" class="control-label"><?php echo _l('product_category_multiselect'); ?></label>
									<select class="form-control selectpicker" multiple data-live-search="true" id="multiselect_id" name="multiselect_id[]">

										<option value=""></option>

										<?php

										$multiselect=explode(',',$multiselect_id);

										if(isset($product_category_data['multiselect_id']) && $product_category_data['multiselect_id']!='')

										{

											$multiselect_id= $product_category_data['multiselect_id'];

											$multiselect=explode(',',$multiselect_id);

										}

										if (isset($multiselect_data) && count($multiselect_data) > 0) {

											foreach ($multiselect_data as $multiselect_key => $multiselect_value) {

												?>

												<option value="<?php echo $multiselect_value['id'] ?>" <?php echo (isset($product_category_data['multiselect_id']) && in_array($multiselect_value['id'],$multiselect)) ? 'selected' : "" ?>><?php echo $multiselect_value['multiselect'] ?></option>

												<?php

											}

										}

										?>
									</select>
								</div>
                            </div> -->

                                    


                             <div class="col-xs-12 col-md-4">
                                <div class="form-group">

                                    <label for="status" class="control-label"><?php echo _l('product_category_status'); ?> *</label>

                                    <select class="form-control selectpicker" name="status" required="">

                                        <option value=""></option>

                                        <option value="1" <?php echo (isset($product_category_data['status']) && $product_category_data['status'] == 1) ? 'selected' : "" ?>>Enable</option>

                                        <option value="0" <?php echo (isset($product_category_data['status']) && $product_category_data['status'] == 0) ? 'selected' : "" ?>>Disable</option>

                                    </select>

                                </div>
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

