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
                                    <label for="name" class="control-label">Tempo Name *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($tempo['name']) && $tempo['name'] != "") ? $tempo['name'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="number" class="control-label">Tempo Number *</label>
                                    <input type="text" id="number" name="number" class="form-control" required="" value="<?php echo (isset($tempo['number']) && $tempo['number'] != "") ? $tempo['number'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="chasis_number" class="control-label">Chasis Number</label>
                                    <input type="text" id="chasis_number" name="chasis_number" class="form-control" value="<?php echo (isset($tempo['chasis_number']) && $tempo['chasis_number'] != "") ? $tempo['chasis_number'] : "" ?>">
                                </div>
								
                                <div class="form-group">
                                    <label for="driver_id" class="control-label"><?php echo 'Driver Name'; ?> </label>
                                    <select class="form-control selectpicker" data-live-search="true" name="driver_id">
                                        <option value="" selected >--Select One-</option>
                                        <?php
                                        if(!empty($staff_list)){
                                            foreach($staff_list as $row){
                                                ?>
                                                <option value="<?php echo $row->staffid;?>" <?php echo (isset($tempo['driver_id']) && $tempo['driver_id'] == $row->staffid) ? "selected" : "" ?>  ><?php echo $row->firstname; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>


								<div class="form-group">
                                    <label for="order" class="control-label">Order *</label>
                                    <input type="number" id="order" name="order" class="form-control" required="" value="<?php echo (isset($tempo['order']) && $tempo['order'] != "") ? $tempo['order'] : "" ?>">
                                </div>


								
                                <div class="form-group">
                                    <label for="status" class="control-label"><?php echo _l('unit_status'); ?> *</label>
                                    <select class="form-control selectpicker" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($tempo['status']) && $tempo['status'] == 1) ? 'selected' : "" ?>>Enable</option>
                                        <option value="0" <?php echo (isset($tempo['status']) && $tempo['status'] == 0) ? 'selected' : "" ?>>Disable</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="file" class="control-label"><?php echo 'Attachment File'; ?></label>
                                    <input type="file" id="file" multiple="" name="file[]" style="width: 100%;">
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
