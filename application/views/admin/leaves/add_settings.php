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
                                    <label for="leave_count" class="control-label"><?php echo 'No. of Leaves'; ?> *</label>
                                    <input type="text" id="leave_count" name="leave_count" class="form-control" required="" value="<?php echo (isset($category->leave_count) && $category->leave_count != "") ? $category->leave_count : "" ?>">
                                </div>

								<?php
								if(!empty($category->category_id)){
									$expense_category_id_arr = explode(',',$category->category_id);
								}
								?>                                
                                <div class="form-group">
								<label for="category_id" class="control-label"><?php echo 'Leave Category'; ?></label>
								<select class="form-control selectpicker" required data-live-search="true" id="category_id" name="category_id">
								
									<?php
									
									if(!empty($leave_categories)){
										foreach($leave_categories as $row){
											?>
											<option value="<?php echo $row->id; ?>"  <?php echo (isset($category->category_id) && in_array($row->id,$expense_category_id_arr)) ? 'selected' : "" ?>><?php echo $row->name;?></option>
											<?php
										}
									}
									?>	
									
								</select>
							</div>
                                <div class="form-group">
                                    <label for="status" class="control-label"><?php echo _l('unit_status'); ?> *</label>
                                    <select class="form-control selectpicker" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($category->status) && $category->status == 1) ? 'selected' : "" ?>>Enable</option>
                                        <option value="0" <?php echo (isset($category->status) && $category->status == 0) ? 'selected' : "" ?>>Disable</option>
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
