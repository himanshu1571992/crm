<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'clientcategory-form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label"><?php echo _l('default_setting_category'); ?> *</label>
                                    <input type="text" id="name" name="category_name" class="form-control" required="" value="<?php echo (isset($defaultsettingcategory['category_name']) && $defaultsettingcategory['category_name'] != "") ? $defaultsettingcategory['category_name'] : "" ?>">
                                </div>
								<div class="form-group">
                                    <label for="status" class="control-label"><?php echo _l('default_setting_category_status'); ?> *</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($defaultsettingcategory['status']) && $defaultsettingcategory['status'] == 1) ? 'selected' : "" ?>>Enabled</option>
                                        <option value="0" <?php echo (isset($defaultsettingcategory['status']) && $defaultsettingcategory['status'] == 0) ? 'selected' : "" ?>>Disable</option>
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
