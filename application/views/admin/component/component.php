<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'component-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            
                            <div class="col-md-12">
                                <h3><?php echo _l('add_component'); ?></h3>
                                <hr/>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unit_id" class="control-label"><?php echo _l('component_unit'); ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="unit_id" name="unit_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($unit_data) && count($unit_data) > 0) {
                                            foreach ($unit_data as $unit_key => $unit_value) {
                                                ?>
                                                <option value="<?php echo $unit_value['id'] ?>" <?php echo (isset($component['unit_id']) && $component['unit_id'] == $unit_value['id']) ? 'selected' : "" ?>><?php echo $unit_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="dimenssion" class="control-label"><?php echo _l('component_dimenssion'); ?></label>
                                    <input type="text" id="dimenssion" name="dimenssion" class="form-control" value="<?php echo (isset($component['dimenssion']) && $component['dimenssion'] != "") ? $component['dimenssion'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="sac_code" class="control-label"><?php echo _l('component_sac_code'); ?></label>
                                    <input type="text" id="sac_code" name="sac_code" class="form-control" value="<?php echo (isset($component['sac_code']) && $component['sac_code'] != "") ? $component['sac_code'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="component_weight" class="control-label"><?php echo _l('component_component_weight'); ?></label>
                                    <input type="text" id="component_weight" name="component_weight" class="form-control" value="<?php echo (isset($component['component_weight']) && $component['component_weight'] != "") ? $component['component_weight'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="component_remarks" class="control-label"><?php echo _l('component_remarks'); ?></label>
                                    <textarea id="component_remarks" name="component_remarks" class="form-control"><?php echo (isset($component['component_remarks']) && $component['component_remarks'] != "") ? $component['component_remarks'] : "" ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label"><?php echo _l('component_name'); ?> *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($component['name']) && $component['name'] != "") ? $component['name'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="hsn_code" class="control-label"><?php echo _l('component_hsn_code'); ?></label>
                                    <input type="text" id="hsn_code" name="hsn_code" class="form-control" value="<?php echo (isset($component['hsn_code']) && $component['hsn_code'] != "") ? $component['hsn_code'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="purchase_price" class="control-label"><?php echo _l('component_purchase_price'); ?></label>
                                    <input type="text" id="purchase_price" name="purchase_price" class="form-control" value="<?php echo (isset($component['purchase_price']) && $component['purchase_price'] != "") ? $component['purchase_price'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="photo" class="control-label"><?php echo _l('component_photo'); ?></label>
                                    <input type="file" id="photo" name="photo">
                                </div>

                                <?php
                                if (isset($component['photo']) && $component['photo'] != "") {
                                    ?>
                                    <div class="form-group proimg">
                                        <label class="control-label"></label>
                                        <img src="<?php echo base_url('uploads/component') . "/" . $component['id'] . "/" . $component['photo'] ?>" style="width: 150px; height: 150px;">
										<a class="removeimg" value="<?php echo $component['id'];?>">Remove Image <i class="fa fa-remove"></i></a>
									</div>
                                    <?php
                                }
                                ?>

                                <div class="form-group">
                                    <label for="status" class="control-label"><?php echo _l('component_status'); ?> *</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($component['status']) && $component['status'] == 1) ? 'selected' : "" ?>>Enabled</option>
                                        <option value="0" <?php echo (isset($component['status']) && $component['status'] == 0) ? 'selected' : "" ?>>Disable</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <h3><?php echo _l('add_component_price'); ?></h3>
                                <hr/>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sale_price_cat_a" class="control-label"><?php echo _l('component_add_sale_cat_a'); ?></label>
                                    <input type="text" id="sale_price_cat_a" name="sale_price_cat_a" class="form-control" value="<?php echo (isset($component['sale_price_cat_a']) && $component['sale_price_cat_a'] != "") ? $component['sale_price_cat_a'] : "" ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="sale_price_cat_b" class="control-label"><?php echo _l('component_add_sale_cat_b'); ?></label>
                                    <input type="text" id="sale_price_cat_b" name="sale_price_cat_b" class="form-control" value="<?php echo (isset($component['sale_price_cat_b']) && $component['sale_price_cat_b'] != "") ? $component['sale_price_cat_b'] : "" ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="sale_price_cat_c" class="control-label"><?php echo _l('component_add_sale_cat_c'); ?></label>
                                    <input type="text" id="sale_price_cat_c" name="sale_price_cat_c" class="form-control" value="<?php echo (isset($component['sale_price_cat_c']) && $component['sale_price_cat_c'] != "") ? $component['sale_price_cat_c'] : "" ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="sale_price_cat_d" class="control-label"><?php echo _l('component_add_sale_cat_d'); ?></label>
                                    <input type="text" id="sale_price_cat_d" name="sale_price_cat_d" class="form-control" value="<?php echo (isset($component['sale_price_cat_d']) && $component['sale_price_cat_d'] != "") ? $component['sale_price_cat_d'] : "" ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rental_price_cat_a" class="control-label"><?php echo _l('component_add_rental_cat_a'); ?></label>
                                    <input type="text" id="rental_price_cat_a" name="rental_price_cat_a" class="form-control" value="<?php echo (isset($component['rental_price_cat_a']) && $component['rental_price_cat_a'] != "") ? $component['rental_price_cat_a'] : "" ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="rental_price_cat_b" class="control-label"><?php echo _l('component_add_rental_cat_b'); ?></label>
                                    <input type="text" id="rental_price_cat_b" name="rental_price_cat_b" class="form-control" value="<?php echo (isset($component['rental_price_cat_b']) && $component['rental_price_cat_b'] != "") ? $component['rental_price_cat_b'] : "" ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="rental_price_cat_c" class="control-label"><?php echo _l('component_add_rental_cat_c'); ?></label>
                                    <input type="text" id="rental_price_cat_c" name="rental_price_cat_c" class="form-control" value="<?php echo (isset($component['rental_price_cat_c']) && $component['rental_price_cat_c'] != "") ? $component['rental_price_cat_c'] : "" ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="rental_price_cat_d" class="control-label"><?php echo _l('component_add_rental_cat_d'); ?></label>
                                    <input type="text" id="rental_price_cat_d" name="rental_price_cat_d" class="form-control" value="<?php echo (isset($component['rental_price_cat_d']) && $component['rental_price_cat_d'] != "") ? $component['rental_price_cat_d'] : "" ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="damage_rate" class="control-label"><?php echo _l('component_damage_rate'); ?></label>
                                    <input type="text" id="damage_rate" name="damage_rate" class="form-control" value="<?php echo (isset($component['damage_rate']) && $component['damage_rate'] != "") ? $component['damage_rate'] : "" ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lost_rate" class="control-label"><?php echo _l('component_lost_rate'); ?></label>
                                    <input type="text" id="lost_rate" name="lost_rate" class="form-control" value="<?php echo (isset($component['lost_rate']) && $component['lost_rate'] != "") ? $component['lost_rate'] : "" ?>">
                                </div>
                            </div>
                                
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="repairable_rate" class="control-label"><?php echo _l('component_repairable_rate'); ?></label>
                                    <input type="text" id="repairable_rate" name="repairable_rate" class="form-control" value="<?php echo (isset($component['repairable_rate']) && $component['repairable_rate'] != "") ? $component['repairable_rate'] : "" ?>">
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

<script>
    init_selectpicker();
</script>
<script>
$('.removeimg').click(function(){
	if (confirm("Are you sure?")) 
	{
		var compnent=$(this).attr('value');
		var url = admin_url+'Component/imagedelete/';
		$.post(url,
		{
		  compnent: compnent,
		},
		function(data,status){
		  $('.proimg').hide();
		});
	}
});
</script>
</body>
</html>
