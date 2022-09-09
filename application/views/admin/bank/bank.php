<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'bank-form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label"><?php echo _l('bank_name'); ?> *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($bank_data['name']) && $bank_data['name'] != "") ? $bank_data['name'] : "" ?>">
                                </div>
								<div class="form-group">
                                    <label for="phone_no" class="control-label"><?php echo _l('bank_phone'); ?> *</label>
                                    <input type="text" id="phone_no" name="phone_no" class="form-control" required="" value="<?php echo (isset($bank_data['phone_no']) && $bank_data['phone_no'] != "") ? $bank_data['phone_no'] : "" ?>">
                                </div>
								<div class="form-group">
                                    <label for="account_no" class="control-label"><?php echo _l('bank_account_no'); ?> *</label>
                                    <input type="text" id="account_no" name="account_no" class="form-control" required="" value="<?php echo (isset($bank_data['account_no']) && $bank_data['account_no'] != "") ? $bank_data['account_no'] : "" ?>">
                                </div>
								
                            </div>
							<div class="col-md-6">
                                <div class="form-group">
                                    <label for="branch" class="control-label"><?php echo _l('bank_branch'); ?> *</label>
                                    <input type="text" id="branch" name="branch" class="form-control" required="" value="<?php echo (isset($bank_data['branch']) && $bank_data['branch'] != "") ? $bank_data['branch'] : "" ?>">
                                </div>
								<div class="form-group">
                                    <label for="email_id" class="control-label"><?php echo _l('bank_mail'); ?> *</label>
                                    <input type="text" id="email_id" name="email_id" class="form-control" required="" value="<?php echo (isset($bank_data['email_id']) && $bank_data['email_id'] != "") ? $bank_data['email_id'] : "" ?>">
                                </div>
								<div class="form-group">
                                    <label for="ifsc_code" class="control-label"><?php echo _l('bank_ifsc_code'); ?> *</label>
                                    <input type="text" id="ifsc_code" name="ifsc_code" class="form-control" required="" value="<?php echo (isset($bank_data['ifsc_code']) && $bank_data['ifsc_code'] != "") ? $bank_data['ifsc_code'] : "" ?>">
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
