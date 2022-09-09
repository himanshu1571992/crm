<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'contacttype-form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="contact_type" class="control-label"><?php echo _l('contact_type'); ?> *</label>
                                    <input type="text" id="contact_type" name="contact_type" class="form-control" required="" value="<?php echo (isset($contacttype['contact_type']) && $contacttype['contact_type'] != "") ? $contacttype['contact_type'] : "" ?>">
                                </div>
								<div class="form-group">
                                    <label for="status" class="control-label"><?php echo _l('contact_type_status'); ?> *</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($contacttype['status']) && $contacttype['status'] == 1) ? 'selected' : "" ?>>Enabled</option>
                                        <option value="0" <?php echo (isset($contacttype['status']) && $contacttype['status'] == 0) ? 'selected' : "" ?>>Disable</option>
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
