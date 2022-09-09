<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'othercharges-form', 'class' => 'othercharges-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label"><?php echo _l('other_charges_cat_name'); ?> *</label>
                                    <input type="text" id="name" name="category_name" class="form-control" required="" value="<?php echo (isset($clientcategory['category_name']) && $clientcategory['category_name'] != "") ? $clientcategory['category_name'] : "" ?>">
                                </div>
								<div class="form-group">
                                    <label for="sac_code" class="control-label"><?php echo _l('other_charges_sac_code'); ?> *</label>
                                    <input type="text" id="sac_code" name="sac_code" class="form-control" required="" value="<?php echo (isset($clientcategory['sac_code']) && $clientcategory['sac_code'] != "") ? $clientcategory['sac_code'] : "" ?>">
                                </div>
                                <input type="hidden" value="0" name="amount">
								<!-- <div class="form-group">
                                    <label for="sac_code" class="control-label"><?php echo _l('other_charges_amount'); ?> *</label>
                                    <input type="text" id="amount" name="amount" class="form-control" required="" value="<?php echo (isset($clientcategory['amount']) && $clientcategory['amount'] != "") ? $clientcategory['amount'] : "" ?>">
                                </div> -->
								<div class="form-group">
                                    <label for="gst" class="control-label"><?php echo _l('other_charges_cgst'); ?> *</label>
                                    <input type="text" id="gst" name="gst" class="form-control" required="" value="<?php echo (isset($clientcategory['gst']) && $clientcategory['gst'] != "") ? $clientcategory['gst'] : "" ?>">
                                </div>
								<div class="form-group">
                                    <label for="sgst" class="control-label"><?php echo _l('other_charges_sgst'); ?> *</label>
                                    <input type="text" id="sgst" name="sgst" class="form-control" required="" value="<?php echo (isset($clientcategory['sgst']) && $clientcategory['sgst'] != "") ? $clientcategory['sgst'] : "" ?>">
                                </div>
								<div class="form-group">
                                    <label for="igst" class="control-label"><?php echo _l('other_charges_igst'); ?> *</label>
                                    <input type="text" id="igst" name="igst" class="form-control" required="" value="<?php echo (isset($clientcategory['igst']) && $clientcategory['igst'] != "") ? $clientcategory['igst'] : "" ?>">
                                </div>
								<div class="form-group">
                                    <label for="status" class="control-label"><?php echo _l('other_charges_status'); ?> *</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($clientcategory['status']) && $clientcategory['status'] == 1) ? 'selected' : "" ?>>Enabled</option>
                                        <option value="0" <?php echo (isset($clientcategory['status']) && $clientcategory['status'] == 0) ? 'selected' : "" ?>>Disable</option>
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
