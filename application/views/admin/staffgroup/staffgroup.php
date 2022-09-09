<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label"><?php echo _l('staff_group_name'); ?> *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($staffgroup['name']) && $staffgroup['name'] != "") ? $staffgroup['name'] : "" ?>">
                                </div>
								<div class="form-group">
                                    <label for="staff_id" class="control-label"><?php echo _l('staff'); ?></label>
                                    <select class="form-control selectpicker" multiple data-live-search="true" id="staff_id" name="staff_id[]">
                                        <option value=""></option>
                                        <?php
                                        if (isset($staff_data) && count($staff_data) > 0) {
											if(isset($staffgroup['staff_id']) && $staffgroup['staff_id']!='')
											{
												$staff_id= $staffgroup['staff_id'];
												$staff_ids=explode(',',$staff_id);
											}
                                            foreach ($staff_data as $staff_key => $staff_value) {
                                                ?>
                                                <option value="<?php echo $staff_value['staffid'] ?>" <?php echo (isset($staffgroup['staff_id']) && in_array($staff_value['staffid'],$staff_ids)) ? 'selected' : "" ?>><?php echo cc($staff_value['firstname']).' - '.$staff_value['email']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
								<!-- <div class="form-group">
                                    <label for="departmentid" class="control-label"><?php echo _l('department'); ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="departmentid" name="departmentid">
                                        <option value=""></option>
                                        <?php
                                        if (isset($department_data) && count($department_data) > 0) {
											
                                            foreach ($department_data as $department_key => $department_value) {
                                                ?>
                                                <option value="<?php echo $department_value['departmentid'] ?>" <?php echo (isset($staffgroup['departmentid']) && $staffgroup['departmentid'] == $department_value['departmentid']) ? 'selected' : "" ?>><?php echo $department_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div> -->
								<div class="form-group">
									<label for="client_cat_id" class="control-label"><?php echo _l('product_category_multiselect'); ?></label>
									<select class="form-control selectpicker" multiple data-live-search="true" id="multiselect_id" name="multiselect_id[]">
										<option value=""></option>
										<?php
										$multiselect=explode(',',$multiselect_id);
										if(isset($staffgroup['multiselect_id']) && $staffgroup['multiselect_id']!='')
										{
											$multiselect_id= $staffgroup['multiselect_id'];
											$multiselect=explode(',',$multiselect_id);
										}
										if (isset($multiselect_data) && count($multiselect_data) > 0) {
											foreach ($multiselect_data as $multiselect_key => $multiselect_value) {
												?>
												<option value="<?php echo $multiselect_value['id'] ?>" <?php echo (isset($staffgroup['multiselect_id']) && in_array($multiselect_value['id'],$multiselect)) ? 'selected' : "" ?>><?php echo cc($multiselect_value['multiselect']); ?></option>
												<?php
											}
										}
										?>
									</select>
								</div>
								
                                <div class="form-group">
                                    <label for="color" class="control-label"><?php echo _l('staff_group_color'); ?> *</label>
                                    <div id="color-group" class="input-group colorpicker-component">
                                        <input type="text" id="color" name="color" class="form-control" required="" value="<?php echo (isset($staffgroup['color']) && $staffgroup['color'] != "") ? $staffgroup['color'] : "#ffffff" ?>">
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="order" class="control-label"><?php echo _l('staff_group_order'); ?> *</label>
                                    <input type="number" id="order" name="order" class="form-control" required="" min="1"  value="<?php echo (isset($staffgroup['order']) && $staffgroup['order'] != "") ? $staffgroup['order'] : "1" ?>">
                                </div>
								
								<div class="form-group">
                                    <label for="description" class="control-label"><?php echo _l('description'); ?> *</label>
                                    <textarea id="description" name="description" class="form-control" required="" ><?php echo (isset($staffgroup['description']) && $staffgroup['description'] != "") ? $staffgroup['description'] : "1" ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="status" class="control-label"><?php echo _l('staff_group_status'); ?> *</label>
                                    <select class="form-control selectpicker" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($staffgroup['status']) && $staffgroup['status'] == 1) ? 'selected' : "" ?>>Enable</option>
                                        <option value="0" <?php echo (isset($staffgroup['status']) && $staffgroup['status'] == 0) ? 'selected' : "" ?>>Disable</option>
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
