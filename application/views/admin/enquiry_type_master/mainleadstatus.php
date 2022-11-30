<?php init_head(); ?>
<style>
    
@media (max-width: 500px){
    .btn-bottom-toolbar {
        width: 100%
    }
}    
@media (max-width: 768px){
    .btn-bottom-toolbar {
        width: 100%
    }
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'enquiry-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label"><?php echo "Name"; ?> *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($enquirytype['name']) && $enquirytype['name'] != "") ? $enquirytype['name'] : "" ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="color" class="control-label"><?php echo _l('enquiry_type_color'); ?> *</label>
                                    <div id="color-group" class="input-group colorpicker-component">
                                        <input type="text" id="color" name="color" class="form-control" required="" value="<?php echo (isset($enquirytype['color']) && $enquirytype['color'] != "") ? $enquirytype['color'] : "#ffffff" ?>">
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="order" class="control-label"><?php echo _l('enquiry_type_order'); ?> *</label>
                                    <input type="number" id="order" name="order" class="form-control" required="" min="1"  value="<?php echo (isset($enquirytype['order']) && $enquirytype['order'] != "") ? $enquirytype['order'] : "1" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="status" class="control-label"><?php echo _l('enquiry_type_status'); ?> *</label>
                                    <select class="form-control selectpicker" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($enquirytype['status']) && $enquirytype['status'] == 1) ? 'selected' : "" ?>>Enable</option>
                                        <option value="0" <?php echo (isset($enquirytype['status']) && $enquirytype['status'] == 0) ? 'selected' : "" ?>>Disable</option>
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
