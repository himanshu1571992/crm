<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title" class="control-label"><?php echo 'Title'; ?> *</label>
                                    <input type="text" id="title" name="title" class="form-control" required="" value="<?php echo (isset($category['title']) && $category['title'] != "") ? $category['title'] : "" ?>">
                                </div>

                                                                								
								<div class="form-group">
                                    <label for="name" class="control-label"><?php echo _l('description'); ?> </label>
                                    <textarea id="description" name="description" class="form-control"><?php echo (isset($category['description']) && $category['description'] != "") ? $category['description'] : "" ?></textarea>
                                </div>
								
								<div class="form-group">
									<label for="file" class="control-label">Upload Files</label>
									<input required="" type="file" id="file" multiple="" name="file[]" style="width: 100%;">
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

                            </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo 'Upload Document'; ?>
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
