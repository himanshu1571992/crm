<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('Task/task_details'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">


					<h4 class="no-margin">Reminder - Details <?php /*if(!empty($reminder_info->reminder_file)){ ?><a target="_blank" href="<?php echo base_url('uploads/reminder/'.$reminder_info->reminder_file); ?>" class="btn btn-info pull-right">View Attachment</a><?php }*/ ?> </h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
					
<?php
$reminder_for = '--';
if($reminder_info->reminder_for == 1){
  $reminder_for = 'Payment Followup';
}elseif($reminder_info->reminder_for == 2){
  $reminder_for = 'Lead Followup';
}elseif($reminder_info->reminder_for == 3){
  $reminder_for = 'Task';
}

?>						
						
				 <div role="tabpanel" class="tab-pane" id="lead_activity">
           <div class="panel_s no-shadow">
              <div class="activity-feed">
                 
                 <div class="row">
                    <div class="col-md-4">
                      <div class="Description-box">
                          <p><b>Task Date : </b> <?php echo date('d/m/Y h:i A',strtotime($reminder_info->reminder_date)); ?></p> 
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="Description-box">
                          <p><b>Reminder For  : </b> <?php echo cc($reminder_for); ?></p> 
                      </div>
                    </div>

                     <div class="col-md-4">

                      <div class="Description-box">
                           <?php
                           if($reminder_info->completed == 0){
                            ?>
                              <a class="btn btn-success" href="<?php echo admin_url('reminder/mark_complete/'.$reminder_info->id); ?>">Mark as Complete</a>
                              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" >Postpone Reminder</a>
                            <?php
                           }else{
                            echo '<p><b>Completed</b></p>';
                           }
                           ?>  
                        </div>
                    </div>
                  </div>

                   <hr>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="Description-box">
                        <p><b>Task Description : </b> <?php echo cc($reminder_info->remark); ?></p> 
                      </div>
                    </div>
                  </div>


                  <?php
                  $file_info  = $this->db->query("SELECT * FROM tblfiles WHERE rel_type = 'reminder' and rel_id = '".$reminder_info->id."'")->result();

                  if(!empty($file_info)){
                  ?>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="Description-box">
                          <p><b>Reminder Attachment : </b></p> 
                          <?php
                          foreach ($file_info as $file) {
                            ?>
                            <a download="" href="<?php echo site_url('uploads/reminder/'.$reminder_info->id.'/'.$file->file_name);?>"><?php echo $file->file_name; ?></a><br>
                            <?php
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                  <?php
                  }
                  ?>

                 

                  

              </div>
              <div class="clearfix"></div>
           </div>
        </div>
													
				
                        </div>
                       
                    </div>
                </div>
             
            </form>
		</div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Postpone Reminder</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo admin_url('reminder/reminder_postpone'); ?>">
            <div class="row">

                <?php
                  $reminder_date = '';
                  if(!empty($reminder_info)){
                      $reminder_date = date('d/m/Y h:i A',strtotime($reminder_info->reminder_date));
                  }
                ?>

                <div class="form-group col-md-12" app-field-wrapper="date">
                    <label for="reminder_date" class="control-label"><?php echo 'From Date'; ?></label>
                    <div class="input-group date">

                      <input id="reminder_date" required name="reminder_date" class="form-control datetimepicker" value="<?php echo (isset($reminder_date) && $reminder_date != "") ? $reminder_date : '' ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="remark" class="control-label">Remark </label>
                    <input type="text" id="remark" name="remark" class="form-control" required="" value="<?php echo (isset($reminder_info->remark) && $reminder_info->remark != "") ? $reminder_info->remark : "" ?>">
                </div>

                <input type="hidden" value="<?php echo $reminder_info->id; ?>" name="id">

                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary" >Submit</button>
                </div>
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
	$(document).on('change', '#branch_id', function(){	
		$("#attendance_form").submit();	
	});
	
	$(document).on('change', '#month', function(){	
		$("#attendance_form").submit();	
	});
</script> 


<script type="text/javascript">
	$(document).on('click', '.pay_all', function(){	
		if (! $("input[name='staffid[]']").is(":checked")){
		   alert('Please Check Any Checkbox First!');
		   return false;
		}else{
			$("#salary_form").submit();	
		}
		
		
		
	});	
</script> 

<script type="text/javascript">
      $(".myselect").select2();
</script>

</body>
</html>
