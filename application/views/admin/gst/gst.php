<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'gst-form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="igst" class="control-label"><?php echo _l('gst_igst'); ?> (%) *</label>
                                    <input type="number" id="igst" name="igst" class="form-control" required="" value="<?php echo (isset($gst['igst']) && $gst['igst'] != "") ? $gst['igst'] : "" ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="cgst" class="control-label"><?php echo _l('gst_cgst'); ?> (%) *</label>
                                    <input type="number" id="cgst" name="cgst" class="form-control" required="" value="<?php echo (isset($gst['cgst']) && $gst['cgst'] != "") ? $gst['cgst'] : "" ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="sgst" class="control-label"><?php echo _l('gst_sgst'); ?> (%) *</label>
                                    <input type="number" id="sgst" name="sgst" class="form-control" required="" value="<?php echo (isset($gst['sgst']) && $gst['sgst'] != "") ? $gst['sgst'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="status" class="control-label"><?php echo _l('gst_status'); ?> *</label>
                                    <select class="form-control selectpicker" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($gst['status']) && $gst['status'] == 1) ? 'selected' : "" ?>>Enable</option>
                                        <option value="0" <?php echo (isset($gst['status']) && $gst['status'] == 0) ? 'selected' : "" ?>>Disable</option>
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

</body>
</html>
