<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'defaultsetting-form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
								<div class="form-group">
                                    <label for="default_setting_category_id" class="control-label"><?php echo _l('default_setting_category_name'); ?> *</label>
                                    <select class="form-control selectpicker" data-live-search="true" required="" name="default_setting_category_id" id="default_setting_category_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($default_setting_category_data) && count($default_setting_category_data) > 0) {
                                            foreach ($default_setting_category_data as $default_setting_category_key => $default_setting_category_value) {
                                                ?>
                                                <option value="<?php echo $default_setting_category_value['id'] ?>" <?php if($default_setting_category_value['id']==$default_setting['default_setting_category_id']){echo"selected=selected";}?>><?php echo $default_setting_category_value['category_name']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
								<div class="form-group">
                                    <label for="default_setting_field" class="control-label"><?php echo _l('default_setting_fields'); ?> *</label>
                                    <select class="form-control selectpicker" multiple data-live-search="true" required="" name="default_setting_field[]" id="default_setting_field">
                                        <option value=""></option>
                                        <?php
										if(isset($default_setting['default_setting_field']))
										{
											$default_setting_field=explode(',',$default_setting['default_setting_field']);
										}
                                        if (isset($default_setting_fields) && count($default_setting_fields) > 0) {
                                            foreach ($default_setting_fields as $default_setting_fields_key => $default_setting_fields_value) {
                                                ?>
                                                <option value="<?php echo $default_setting_fields_value['name'];?>" <?php if(isset($default_setting) && in_array($default_setting_fields_value['name'],$default_setting_field) ){echo"selected=selected";}?>><?php echo $default_setting_fields_value['name']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="control-label"><?php echo _l('default_setting_status'); ?> *</label>
                                    <select class="form-control selectpicker" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($default_setting['status']) && $default_setting['status'] == 1) ? 'selected' : "" ?>>Enable</option>
                                        <option value="0" <?php echo (isset($default_setting['status']) && $default_setting['status'] == 0) ? 'selected' : "" ?>>Disable</option>
                                    </select>
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