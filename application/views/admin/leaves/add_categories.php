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
                                    <label for="name" class="control-label"><?php echo 'Leave Category'; ?> *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($category['name']) && $category['name'] != "") ? $category['name'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="color" class="control-label"><?php echo _l('unit_color'); ?> *</label>
                                    <div id="color-group" class="input-group colorpicker-component">
                                        <input type="text" id="color" name="color" class="form-control" required="" value="<?php echo (isset($category['color']) && $category['color'] != "") ? $category['color'] : "#ffffff" ?>">
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="order" class="control-label"><?php echo _l('unit_order'); ?> *</label>
                                    <input type="number" id="order" name="order" class="form-control" required="" min="1"  value="<?php echo (isset($category['order']) && $category['order'] != "") ? $category['order'] : "1" ?>">
                                </div>
								
								<?php
								/*
								<div class="form-group">
                                    <label for="ttl_leaves" class="control-label"><?php echo 'No. of Leave Per Month'; ?> *</label>
                                    <input type="number" id="ttl_leaves" name="ttl_leaves" class="form-control" required=""  value="<?php echo (isset($category['ttl_leaves']) && $category['ttl_leaves'] != "") ? $category['ttl_leaves'] : "1" ?>">
                                </div>
								*/
								?>
								<input type="hidden" value="1" name="ttl_leaves">
								
								<div class="form-group">
                                    <label for="name" class="control-label"><?php echo _l('requiest_description'); ?> </label>
                                    <textarea id="description" name="description" class="form-control"><?php echo (isset($category['description']) && $category['description'] != "") ? $category['description'] : "" ?></textarea>
                                </div>
								
								<div class="form-group">
									<label for="leaves_category_img" class="control-label"><?php echo _l('expenses_category_image'); ?></label>
									<input type="file" id="leaves_category_img" name="leaves_category_img" style="width: 100%;">
								</div>
						
								<?php
								if (isset($category['leaves_category_img']) && $category['leaves_category_img'] != "") {
								?>
								<div class="form-group prodoc">
									<label class="control-label"></label>
									<img src="<?php echo base_url('uploads/leaves_category/'.$category['leaves_category_img']);?>" style="width: 150px; height: 150px;">
									<!--<a class="removedocument" value="<?php echo $category['id']; ?>">Remove Image <i class="fa fa-remove"></i></a>-->
								</div>
								<?php
								}
								?>

                                <div class="form-group">
                                    <label for="status" class="control-label"><?php echo _l('unit_status'); ?> *</label>
                                    <select class="form-control selectpicker" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($category['status']) && $category['status'] == 1) ? 'selected' : "" ?>>Enable</option>
                                        <option value="0" <?php echo (isset($category['status']) && $category['status'] == 0) ? 'selected' : "" ?>>Disable</option>
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
