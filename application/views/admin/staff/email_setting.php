<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'product-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12">
                                <h3><?php
                                   
                                    echo 'Staff Email Setting';    
                                    ?></h3>
                                <hr/>
                            </div>
							
							
							

                            <div class="col-md-12">
							
								 <div class="form-group col-md-12">
									<label for="smtp_encryption" class="control-label">Email Encryption </label>
									<select class="form-control selectpicker" id="smtp_encryption" name="smtp_encryption">
										<option value=""></option>
										<option selected value="ssl" <?php echo (isset($mail_info['smtp_encryption']) && $mail_info['smtp_encryption'] == 'ssl') ? 'selected' : "" ?>>SSL</option>
										<option value="tls" <?php echo (isset($mail_info['smtp_encryption']) && $mail_info['smtp_encryption'] == 'tls') ? 'selected' : "" ?>>TLS</option>
									</select>
								</div>
								
							
								<div class="form-group col-md-12">
                                    <label for="smtp_host" class="control-label">SMTP Host *</label>
                                    <input type="text" id="smtp_host" name="smtp_host" class="form-control" required="" value="<?php echo (isset($mail_info['smtp_host']) && $mail_info['smtp_host'] != "") ? $mail_info['smtp_host'] : "" ?>">
                                </div>
								
								<div class="form-group col-md-12">
                                    <label for="smtp_port" class="control-label">SMTP Port *</label>
                                    <input type="text" id="smtp_port" name="smtp_port" class="form-control" required="" value="<?php echo (isset($mail_info['smtp_port']) && $mail_info['smtp_port'] != "") ? $mail_info['smtp_port'] : "" ?>">
                                </div>
								
								<div class="form-group col-md-12">
                                    <label for="smtp_email" class="control-label">Email *</label>
                                    <input type="text" id="smtp_email" name="smtp_email" class="form-control" required="" value="<?php echo (isset($mail_info['smtp_email']) && $mail_info['smtp_email'] != "") ? $mail_info['smtp_email'] : "" ?>">
                                </div>

								<div class="form-group col-md-12">
                                    <label for="smtp_username" class="control-label">SMTP Username *</label>
                                    <input type="text" id="smtp_username" name="smtp_username" class="form-control" required="" value="<?php echo (isset($mail_info['smtp_username']) && $mail_info['smtp_username'] != "") ? $mail_info['smtp_username'] : "" ?>">
                                </div>
								
								<div class="form-group col-md-12">
                                    <label for="smtp_password" class="control-label">SMTP Password *</label>
                                    <input type="password" id="smtp_password" name="smtp_password" class="form-control" required="" value="<?php echo (isset($mail_info['smtp_password']) && $mail_info['smtp_password'] != "") ? $mail_info['smtp_password'] : "" ?>">
                                </div>
							
								<div class="form-group col-md-12">
                                    <label for="smtp_email_charset" class="control-label">Email Charset *</label>
                                    <input type="text" id="smtp_email_charset" name="smtp_email_charset" class="form-control" required="" value="<?php echo (isset($mail_info['smtp_email_charset']) && $mail_info['smtp_email_charset'] != "") ? $mail_info['smtp_email_charset'] : "utf-8" ?>">
                                </div>
								
								<div class="form-group col-md-12">
                                    <label for="bcc_emails" class="control-label">BCC All Emails To </label>
                                    <input type="text" id="bcc_emails" name="bcc_emails" class="form-control" value="<?php echo (isset($mail_info['bcc_emails']) && $mail_info['bcc_emails'] != "") ? $mail_info['bcc_emails'] : "" ?>">
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


</body>
</html>
