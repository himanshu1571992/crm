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
                            
                                <div class="form-group col-md-6">
                                    <label for="name" class="control-label"><?php echo 'Event Title'; ?> *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($event['name']) && $event['name'] != "") ? $event['name'] : "" ?>">
                                </div>
								
								<div class="form-group col-md-6">
                                    <label for="name" class="control-label"><?php echo 'Description'; ?> </label>
                                    <textarea id="description" name="description" class="form-control"><?php echo (isset($event['description']) && $event['description'] != "") ? $event['description'] : "" ?></textarea>
                                </div>

                                 <div class="form-group col-md-6" app-field-wrapper="date">
								<label for="from_date" class="control-label"><?php echo 'From Date' ?></label>
									<div class="input-group date">
										<input id="from_date" name="from_date" required class="form-control datepicker" value="<?php echo (isset($event['from_date']) && $event['from_date'] != "") ? date('d/m/Y',strtotime($event['from_date'])) : "" ?>" aria-invalid="false" type="text" ><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
									</div>		
								</div>
									
								<div class="form-group col-md-6" app-field-wrapper="date">
								<label for="to_date" class="control-label"><?php echo 'To Date' ?></label>
									<div class="input-group date">
										<input id="to_date" name="to_date" required class="form-control datepicker" value="<?php echo (isset($event['to_date']) && $event['to_date'] != "") ? date('d/m/Y',strtotime($event['to_date'])) : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
									</div>		
								</div>	
								
								
								
                                <div class="form-group col-md-6">
                                    <label for="status" class="control-label"><?php echo _l('unit_status'); ?> *</label>
                                    <select class="form-control selectpicker" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($event['status']) && $event['status'] == 1) ? 'selected' : "" ?>>Enable</option>
                                        <option value="0" <?php echo (isset($event['status']) && $event['status'] == 0) ? 'selected' : "" ?>>Disable</option>
                                    </select>
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
