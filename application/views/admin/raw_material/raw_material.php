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
                                <div class="form-group col-md-6">
                                    <label for="name" class="control-label"><?php echo 'Raw Material Name'; ?> *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($material['name']) && $material['name'] != "") ? $material['name'] : "" ?>">
                                </div>
								
								<div class="form-group col-md-6">
                                    <label for="code" class="control-label"><?php echo 'Raw Material Code'; ?> *</label>
                                    <input type="text" id="code" name="code" class="form-control" required="" value="<?php echo (isset($material['code']) && $material['code'] != "") ? $material['code'] : "" ?>">
                                </div>
								
								<div class="col-md-12">
								<?php
								if(!empty($material)){ $fieldid = $material['id']; }else{ $fieldid = 0; }
								?>
								<?php echo render_custom_fields('raw_material',$fieldid); ?>
								</div>
                               
                              <div class="form-group col-md-6">
                                    <label for="order" class="control-label"><?php echo 'Order'; ?> *</label>
                                    <input type="number" id="order" name="order" class="form-control" required="" value="<?php echo (isset($material['order']) && $material['order'] != "") ? $material['order'] : "" ?>">
                              </div>

                                <div class="form-group col-md-6">
                                    <label for="status" class="control-label"><?php echo _l('unit_status'); ?> *</label>
                                    <select class="form-control selectpicker" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($material['status']) && $material['status'] == 1) ? 'selected' : "" ?>>Enable</option>
                                        <option value="0" <?php echo (isset($material['status']) && $material['status'] == 0) ? 'selected' : "" ?>>Disable</option>
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
