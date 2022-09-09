<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php /*echo form_open($this->uri->uri_string(), array('id' => 'clientcategory-form', 'class' => 'proposal-form'));*/ ?>
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'leave_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="reminder_for" class="control-label">Reminder For *</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="reminder_for" required="">
                                        <option value=""></option>
                                        <option value="1" <?php if(!empty($reminder['reminder_for']) && !empty($reminder['reminder_for'] == 1)){ echo 'selected'; }elseif(!empty($r_id) && $r_id == 1){ echo 'selected'; }?>>Payment Followup</option>
                                        <option value="2" <?php if(!empty($reminder['reminder_for']) && !empty($reminder['reminder_for'] == 2)){ echo 'selected'; }elseif(!empty($r_id) && $r_id == 2){ echo 'selected'; }?>>Lead Followup</option>
                                        <option value="3" <?php if(!empty($reminder['reminder_for']) && !empty($reminder['reminder_for'] == 3)){ echo 'selected'; }elseif(!empty($r_id) && $r_id == 3){ echo 'selected'; }?>>Task</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="remark" class="control-label">Remark *</label>
                                    <input type="text" id="remark" name="remark" class="form-control" required="" value="<?php echo (isset($reminder['remark']) && $reminder['remark'] != "") ? $reminder['remark'] : "" ?>">
                                </div>

                                <?php
                                $reminder_date = '';
                                if(!empty($reminder)){
                                    $reminder_date = date('d/m/Y h:i A',strtotime($reminder['reminder_date']));
                                }
                                ?>

                                <div class="form-group" app-field-wrapper="date">
                                    <label for="reminder_date" class="control-label"><?php echo 'From Date'; ?></label>
                                    <div class="input-group date">

                                        <input id="reminder_date" required name="reminder_date" class="form-control datetimepicker" value="<?php echo (isset($reminder_date) && $reminder_date != "") ? $reminder_date : '' ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

								<div class="form-group">
                                    <label for="status" class="control-label"><?php echo _l('unit_status'); ?> *</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($reminder['status']) && $reminder['status'] == 1) ? 'selected' : "" ?>>Enabled</option>
                                        <option value="0" <?php echo (isset($reminder['status']) && $reminder['status'] == 0) ? 'selected' : "" ?>>Disable</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="file" class="control-label">Attachment</label>
                                    <input type="file" id="file" name="file[]" multiple="" style="width: 100%;">
                                </div>
                        
                                <?php
                                /*if (isset($reminder['reminder_file']) && $reminder['reminder_file'] != "") {
                                ?>
                                <div class="form-group prodoc">
                                    <label class="control-label"></label>
                                    <img src="<?php echo base_url('uploads/reminder/'.$reminder['reminder_file']);?>" style="width: 150px; height: 150px;">
                                    <!--<a class="removedocument" value="<?php echo $category['id']; ?>">Remove Image <i class="fa fa-remove"></i></a>-->
                                </div>
                                <?php
                                }*/
                                ?>
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
