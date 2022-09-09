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
									<label for="state_id" class="control-label">Select State *</label>
									<select class="form-control selectpicker" id="state_id" name="state_id">
										<option value="" disabled selected >--Select One-</option>
										<?php
										if(!empty($state_info)){
											foreach($state_info as $state){
												?>
												<option value="<?php echo $state->id;?>" <?php echo (!empty($city) && $city->state_id == $state->id) ? 'selected' : ''; ?>><?php echo cc($state->name); ?></option>
												<?php
											}
										}
										?>
									</select>
								</div>
							
							
                                <div class="form-group">
                                    <label for="name" class="control-label">City Name *</label>
                                    <input type="text" id="city" name="city" class="form-control" required="" value="<?php echo (!empty($city->name)) ? $city->name : ''; ?>" placeholder="City Name">
                                </div>
								
															
                                <div class="form-group">
                                    <label for="status" class="control-label"><?php echo _l('unit_status'); ?> *</label>
                                    <select class="form-control selectpicker" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($city->status) && $city->status == 1) ? 'selected' : "" ?>>Enable</option>
                                        <option value="0" <?php echo (isset($city->status) && $city->status == 0) ? 'selected' : "" ?>>Disable</option>
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
