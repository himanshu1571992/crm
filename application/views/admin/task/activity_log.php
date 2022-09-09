<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('Task/activity_log'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin">Task - Activity Log</h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
					
						
						
					 <div role="tabpanel" class="tab-pane" id="lead_activity">
         <div class="panel_s no-shadow">
            <div class="activity-feed">
               <?php
                if(!empty($activity_log)){
                foreach($activity_log as $log){ ?>
               <div class="feed-item">
                  <div class="date">
                    <span class="text-has-action" data-toggle="tooltip" data-title="<?php echo _dt($log->created_at); ?>">
                    <?php echo time_ago($log->created_at); ?>
                  </span>
                  </div>
                  <div class="text">
                     <?php if($log->staff_id != 0){ ?>
                     <a href="<?php echo admin_url('profile/'.$log->staff_id); ?>">
                     <?php echo staff_profile_image($log->staff_id,array('staff-profile-xs-image pull-left mright5'));
                        ?>
                     </a>
                     <?php
                        }
                        echo get_employee_name($log->staff_id) . ' - ';
                            echo _l($log->description,'',false);
                        ?>
                  </div>
               </div>
               <?php } ?>
               <?php } ?>
            </div>

            <input type="hidden" value="<?php echo $id; ?>" name="id">
            <div class="col-md-12">
               <?php echo render_textarea('description','','',array('placeholder'=>_l('enter_activity')),array(),'mtop15'); ?>
               <div class="text-right">
                  <button class="btn btn-info"><?php echo _l('submit'); ?></button>
               </div>
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
