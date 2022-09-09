<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label"><?php echo 'Loan Tenure'; ?> *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($tenue['name']) && $tenue['name'] != "") ? $tenue['name'] : "" ?>">
                                </div>
								
								 <div class="form-group">
                                    <label for="installment" class="control-label"><?php echo 'No. Of Installments'; ?> *</label>
                                    <input type="text" id="installment" name="installment" class="form-control" required="" value="<?php echo (isset($tenue['order']) && $tenue['installment'] != "") ? $tenue['installment'] : "" ?>">
                                </div>

                               
                              <div class="form-group">
                                    <label for="order" class="control-label"><?php echo 'Order'; ?> *</label>
                                    <input type="text" id="order" name="order" class="form-control" required="" value="<?php echo (isset($tenue['order']) && $tenue['order'] != "") ? $tenue['order'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="status" class="control-label"><?php echo _l('unit_status'); ?> *</label>
                                    <select class="form-control selectpicker" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($tenue['status']) && $tenue['status'] == 1) ? 'selected' : "" ?>>Enable</option>
                                        <option value="0" <?php echo (isset($tenue['status']) && $tenue['status'] == 0) ? 'selected' : "" ?>>Disable</option>
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
