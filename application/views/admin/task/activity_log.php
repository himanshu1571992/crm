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
                        <strong class="text-danger"><?php echo $title; ?></strong>
                        <hr class="hr-panel-heading">
                        <div class="row">
                           <div class="col-md-12"><a href="javascript:void(0);" id="tag_employee_btn" value="0" class="btn btn-success pull-right tag_employee_btn">@ Tag Someone</a></div>
                           <br><br>
                           <div role="tabpanel" class="tab-pane" id="lead_activity">
                              <div class="panel_s no-shadow">
                                 <div class="activity-feed">
                                    <?php
                                       if(!empty($activity_log)){
                                          foreach($activity_log as $log){
                                    ?>
                                             <div class="feed-item">
                                                <div class="date">
                                                   <span class="text-has-action" data-toggle="tooltip"
                                                      data-title="<?php echo _dt($log->created_at); ?>">
                                                      <?php echo time_ago($log->created_at); ?>
                                                   </span>
                                                </div>
                                                <div class="text">
                                                      <?php 
                                                         if($log->staff_id != 0){ ?>
                                                            <a href="<?php echo admin_url('profile/'.$log->staff_id); ?>">
                                                               <?php echo staff_profile_image($log->staff_id,array('staff-profile-xs-image pull-left mright5')); ?>
                                                            </a>
                                                         <?php
                                                         }
                                                         echo get_employee_name($log->staff_id) . ' - ';
                                                         echo _l(str_replace("@", '<span style="color:red;">@</span>', $log->description),'',false);
                                                         // echo _l($log->description,'',false);
                                                      ?>
                                                </div>
                                          </div>
                                    <?php 
                                          } 
                                       }
                                    ?>
                                 </div>
                                 <input type="hidden" value="<?php echo $id; ?>" name="id">
                                 <div class="col-md-12">
                                    <div class="form-group mtop15" app-field-wrapper="description"><textarea id="description0" val="0"  name="description" class="form-control description_box" placeholder="Enter Activity" rows="4"></textarea></div>
                                    <?php //echo render_textarea('description','','',array('placeholder'=>_l('enter_activity')),array(),'mtop15'); ?>
                                    <div class="text-right">
                                       <input type="hidden" name="tag_staff_ids" class="staff_ids">
                                       <input type="hidden" name="tag_viewstaff_ids" class="view_staff_ids">
                                       <button class="btn btn-info"><?php echo _l('submit'); ?></button>
                                    </div>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
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
<?php 
    $this->load->view("admin/follow_up/tag_staff_modal");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
$(function() {
    $('#color-group').colorpicker({
        horizontal: true
    });
});
</script>


<script type="text/javascript">
$(".myselect").select2();
</script>

</body>

</html>