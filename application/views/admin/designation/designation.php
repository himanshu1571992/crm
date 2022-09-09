<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'designation-form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-3">
                                    <label for="name" class="control-label"><?php echo _l('designation'); ?> *</label>
                                    <input type="text" id="name" name="designation" class="form-control" required="" value="<?php echo (isset($designation_data['designation']) && $designation_data['designation'] != "") ? $designation_data['designation'] : "" ?>">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label for="color" class="control-label"><?php echo _l('designation_color'); ?> *</label>
                                    <div id="color-group" class="input-group colorpicker-component">
                                        <input type="text" id="color" name="color" class="form-control" required="" value="<?php echo (isset($designation_data['color']) && $designation_data['color'] != "") ? $designation_data['color'] : "#ffffff" ?>">
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="order" class="control-label"><?php echo _l('designation_order'); ?> *</label>
                                    <input type="number" id="order" name="order" class="form-control" required="" min="1"  value="<?php echo (isset($designation_data['order']) && $designation_data['order'] != "") ? $designation_data['order'] : "1" ?>">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="status" class="control-label"><?php echo _l('designation_status'); ?> *</label>
                                    <select class="form-control selectpicker" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($designation_data['status']) && $designation_data['status'] == 1) ? 'selected' : "" ?>>Enable</option>
                                        <option value="0" <?php echo (isset($designation_data['status']) && $designation_data['status'] == 0) ? 'selected' : "" ?>>Disable</option>
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label for="key_responsibility_area" class="control-label">KRA (key responsibility area)</label>
                                    <textarea class="form-control tinymce" name="key_responsibility_area" id="kra_area" required="">
                                        <?php echo (isset($designation_data['key_responsibility_area']) && $designation_data['key_responsibility_area'] != "") ? $designation_data['key_responsibility_area'] : "" ?>
                                    </textarea>

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
