<?php init_head(); ?>

<style type="text/css">
  div.ex3 {
    overflow-y: scroll;
    height: 300px;
  }
#searchResult{
 list-style: none;
 padding: 0px;
 width: 250px;
 position: absolute;
 margin: 0;
}

#searchResult option{
 background: lavender;
 padding: 4px;
 margin-bottom: 1px;
}

#searchResult option:nth-child(even){
 background: cadetblue;
 color: white;
}

#searchResult option:hover{
 cursor: pointer;
}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<div id="wrapper">
  <div class="content accounting-template">
		<div class="row">
      <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  //echo admin_url('follow_up/lead_activity'); ?>">
        <div class="col-md-12">
          <div class="panel_s">
            <div class="panel-body">
              <h4 class="no-margin"><?php echo $title; ?></h4>
              <hr class="hr-panel-heading">
              <div class="row">
                <div class="col-md-12"><a href="javascript:void(0);" id="tag_employee_btn" value="0" class="btn btn-success pull-right tag_employee_btn">@ Tag Someone</a><br><br></div>
                
                <?php if ($enquirycall_id > 0){ ?>
                <div class="col-md-6">
                  <div class="panel_s">
                    <div class="panel-body">
                      <h4 class="no-margin">Lead Form Activities</h4>
                      <h4 style="color:red;"><a target="_blank" href="<?php echo admin_url('enquirycall/view/'.$enquirycall_id); ?>"><?php echo "ENQ-".str_pad($enquirycall_id, 4, '0', STR_PAD_LEFT); ?></a></h4>
                      <hr class="hr-panel-heading">
                      <div class="row">
                        <div role="tabpanel" class="tab-pane" id="lead_activity">
                          <div class="panel_s no-shadow">
                            <div class="activity-feed ex3">
                              <?php
                                $last_id = 0;
                                $i = 0;
                              if (!empty($call_activity_log)){  
                                foreach ($call_activity_log as $key => $log) {
                                  $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblenquirycall_activity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                              ?>
                                  <div class="col-md-12 replyboxdiv<?php echo $log->id; ?>">
                                    <div class="feed-item">
                                      <div class="date">
                                        <span class="text-has-action" data-toggle="tooltip"><?php echo _dt($log->datetime); ?></span>
                                      </div>
                                      <div class="text <?php echo ($log->status == 2) ? 'line-throught' : ''; ?>">
                                        <a href="#" val="<?php echo $log->id; ?>" section="enquirycall_activity" pri="<?php echo $log->priority; ?>" onclick="return false;" class="priority" ><i class="fa <?php echo ($log->priority == 1) ? 'fa-star' : 'fa-star-o'; ?>" aria-hidden="true"></i></a>
                                        <?php
                                          if ((get_staff_user_id() == $log->staffid) && ($log->status == 1)) {
                                        ?>
                                            <a href="<?php echo admin_url('enquirycall/cut_enquirycall_conversation/' . $log->id); ?>" onclick="return confirm('Are you sure you want to cut?');"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                        <?php
                                          }
                                          if (is_admin() == 1 && $ttl_reply == 0) {
                                        ?>
                                            <a href="<?php echo admin_url('enquirycall/delete_enquirycall_conversation/' . $log->id); ?>" val="<?php echo $log->id; ?>" onclick="return confirm('Are you sure you want to Delete?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        <?php
                                          }
                                        if ($log->staffid != 0) { ?>                     
                                            <a href="<?php echo admin_url('profile/' . $log->staffid); ?>">
                                              <?php echo staff_profile_image($log->staffid, array('staff-profile-xs-image pull-left mright5')); ?>
                                            </a>
                                        <?php
                                          }
                                          echo get_employee_name($log->staffid) . ' - ';
                                          echo _l(str_replace("@", '<span style="color:red;">@</span>', $log->message), '', false);
                                        ?>
                                        <a href="javascript:void(0);" class="reply_comment" section="enquirycall_activity" val="<?php echo $log->id; ?>" title="Reply on activity"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>
                                        <?php if ($ttl_reply > 0){ ?>
                                        | <a href="javascript:void(0);" class="view_reply" section="enquirycall_activity" val="<?php echo $log->id; ?>" data-last_id="0" data-type="1" title="Reply on activity"> <?php echo $ttl_reply; ?> Replies</a>
                                        <?php } ?>
                                        <div class="reply-div reply-box<?php echo $log->id; ?>" style="display: none;">
                                          <?php //echo render_textarea('activity_reply['.$log->id.']','','',array('placeholder'=>_l('enter_activity'), 'class' => 'comment-box'),array(),'mtop15'); ?>
                                          <div class="form-group mtop15" app-field-wrapper="description">
                                              <!-- <textarea id="description<?php echo $log->id; ?>" val="<?php echo $log->id; ?>" name="activity_reply[<?php echo $log->id; ?>]" class="form-control description_box" placeholder="Enter Activity" rows="4"></textarea> -->
                                              <input type="text" name="activity_reply[<?php echo $log->id; ?>]" val="<?php echo $log->id; ?>" id="description<?php echo $log->id; ?>" class="form-control description_box">
                                          </div>
                                          <div class="text-right">
                                              <a href="javascript:void(0);" id="tag_employee_btn" value="<?php echo $log->id; ?>" class="btn btn-success tag_employee_btn">@ Tag Someone</a>
                                              <button class="btn btn-info">Reply</button>
                                              <a href="javascript:void(0);" onclick="close_reply_activity();" class="btn btn-danger">Close</a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="reply-view<?php echo $log->id; ?>"></div>
                                  </div>
                              <?php    
                                }
                              }else{
                                echo '<div class="col-md-12"><h1 class="text-danger text-center">No Activity Found!</h1></div>';
                              }   
                              ?>
                            </div>
                          </div>
                        </div>  
                      </div>  
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div class="col-md-6">
                  <div class="panel_s">
                    <div class="panel-body">
                      <h4 class="no-margin">Lead Activities</h4>
                      <h4 style="color:red;">
                        <?php 
                          $lead_info = $this->db->query("SELECT * FROM tblleads WHERE id = '".$lead_id."' ")->row();
                          if ($lead_info){
                              $client_info = $this->db->query("SELECT * FROM tblclientbranch WHERE userid = '".$lead_info->client_branch_id."' ")->row();
                              
                              echo ($lead_info->client_branch_id > 0) ? $client_info->client_branch_name : $lead_info->company;
                          }
                        ?>
                      </h4> 
                      <hr class="hr-panel-heading">
                      <div class="row">
                        <div role="tabpanel" class="tab-pane" id="lead_activity">
                          <div class="panel_s no-shadow">
                            <div class="activity-feed ex3">
                            <?php
                                $i = 0;
                              if (!empty($lead_activity_log)){  
                                foreach ($lead_activity_log as $key => $log) {
                                  $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblfollowupleadactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                              ?>
                                  <div class="col-md-12 replyboxdiv<?php echo $log->id; ?>">
                                    <div class="feed-item">
                                      <div class="date">
                                        <span class="text-has-action" data-toggle="tooltip"><?php echo _dt($log->datetime); ?></span>
                                      </div>
                                      <div class="text <?php echo ($log->status == 2) ? 'line-throught' : ''; ?>">
                                        <a href="#" val="<?php echo $log->id; ?>" section="lead_activity" pri="<?php echo $log->priority; ?>" onclick="return false;" class="priority" ><i class="fa <?php echo ($log->priority == 1) ? 'fa-star' : 'fa-star-o'; ?>" aria-hidden="true"></i></a>
                                        <?php
                                          if ((get_staff_user_id() == $log->staffid) && ($log->status == 1)) {
                                        ?>
                                            <a href="<?php echo admin_url('follow_up/cut_lead_conversation/' . $log->id); ?>" onclick="return confirm('Are you sure you want to cut?');"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                        <?php
                                          }
                                          if (is_admin() == 1 && $ttl_reply == 0) {
                                        ?>
                                            <a href="<?php echo admin_url('follow_up/delete_lead_conversation/' . $log->id); ?>" val="<?php echo $log->id; ?>" onclick="return confirm('Are you sure you want to Delete?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        <?php
                                          }
                                        if ($log->staffid != 0) { ?>                     
                                            <a href="<?php echo admin_url('profile/' . $log->staffid); ?>">
                                              <?php echo staff_profile_image($log->staffid, array('staff-profile-xs-image pull-left mright5')); ?>
                                            </a>
                                        <?php
                                          }
                                          echo get_employee_name($log->staffid) . ' - ';
                                          echo _l(str_replace("@", '<span style="color:red;">@</span>', $log->message), '', false);
                                        ?>
                                        <a href="javascript:void(0);" class="reply_comment" section="lead_activity" val="<?php echo $log->id; ?>" title="Reply on activity"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>
                                        <?php if ($ttl_reply > 0){ ?>
                                        | <a href="javascript:void(0);" class="view_reply" section="lead_activity" val="<?php echo $log->id; ?>" data-last_id="0" data-type="1" title="Reply on activity"> <?php echo $ttl_reply; ?> Replies</a>
                                        <?php } ?>
                                        <div class="reply-div reply-box<?php echo $log->id; ?>" style="display: none;">
                                          <?php //echo render_textarea('activity_reply['.$log->id.']','','',array('placeholder'=>_l('enter_activity'), 'class' => 'comment-box'),array(),'mtop15'); ?>
                                          <div class="form-group mtop15" app-field-wrapper="description">
                                              <!-- <textarea id="description<?php echo $log->id; ?>" val="<?php echo $log->id; ?>" name="activity_reply[<?php echo $log->id; ?>]" class="form-control description_box" placeholder="Enter Activity" rows="4"></textarea> -->
                                              <input type="text" name="activity_reply[<?php echo $log->id; ?>]" val="<?php echo $log->id; ?>" id="description<?php echo $log->id; ?>" class="form-control description_box">
                                          </div>
                                          <div class="text-right">
                                              <a href="javascript:void(0);" id="tag_employee_btn" value="<?php echo $log->id; ?>" class="btn btn-success tag_employee_btn">@ Tag Someone</a>
                                              <button class="btn btn-info">Reply</button>
                                              <a href="javascript:void(0);" onclick="close_reply_activity();" class="btn btn-danger">Close</a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="reply-view<?php echo $log->id; ?>"></div>
                                  </div>
                              <?php    
                                }
                              }else{
                                echo '<div class="col-md-12"><h1 class="text-danger text-center">No Activity Found!</h1></div>';
                              }  
                              ?>
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div>
                  </div>
                </div>
                <?php if ($designrequision_id > 0){ ?>
                <div class="col-md-6">
                  <div class="panel_s">
                    <div class="panel-body">
                      <h4 class="no-margin">Design Requisition Activities</h4>
                      <h4 style="color:red;"><a target="_blank" href="<?php echo admin_url('designrequisition/view/'.$designrequision_id); ?>"><?php echo "DR-".str_pad($designrequision_id, 3, '0', STR_PAD_LEFT); ?></a></h4>
                      <hr class="hr-panel-heading">
                      <div class="row">
                        <div role="tabpanel" class="tab-pane" id="lead_activity">
                          <div class="panel_s no-shadow">
                            <div class="activity-feed ex3">
                              <?php
                                $i = 0;
                                if (!empty($design_activity_log)){
                                  foreach ($design_activity_log as $key => $log) {

                                    $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tbldesignrequisitionactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                              ?>
                                    <div class="col-md-12 replyboxdiv<?php echo $log->id; ?>">
                                      <div class="feed-item">
                                        <div class="date">
                                          <span class="text-has-action" data-toggle="tooltip"><?php echo _dt($log->datetime); ?></span>
                                        </div>
                                        <div class="text <?php echo ($log->status == 2) ? 'line-throught' : ''; ?>">
                                          <a href="#" val="<?php echo $log->id; ?>" section="designrequisition" pri="<?php echo $log->priority; ?>" onclick="return false;" class="priority" ><i class="fa <?php echo ($log->priority == 1) ? 'fa-star' : 'fa-star-o'; ?>" aria-hidden="true"></i></a>
                                                <?php
                                                if ((get_staff_user_id() == $log->staffid) && ($log->status == 1)) {
                                                    ?>
                                                    <a href="<?php echo admin_url('designrequisition/cut_designrequisition_conversation/' . $log->id); ?>" onclick="return confirm('Are you sure you want to cut?');"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                                    <?php
                                                }
                                                if (is_admin() == 1 && $ttl_reply == 0) {
                                                    ?>
                                                    <a href="<?php echo admin_url('designrequisition/delete_designrequisition_conversation/' . $log->id); ?>" val="<?php echo $log->id; ?>" onclick="return confirm('Are you sure you want to Delete?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                    <?php
                                                }
                                                if ($log->staffid != 0) { ?>
                                                    <a href="<?php echo admin_url('profile/' . $log->staffid); ?>">
                                                        <?php echo staff_profile_image($log->staffid, array('staff-profile-xs-image pull-left mright5'));
                                                        ?>
                                                    </a>
                                                    <?php
                                                }
                                                echo get_employee_name($log->staffid) . ' - ';
                                                echo _l(str_replace("@", '<span style="color:red;">@</span>', $log->message), '', false);
                                                ?>
                                                  <a href="javascript:void(0);" class="reply_comment" section="designrequisition" val="<?php echo $log->id; ?>" title="Reply on activity"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>
                                                <?php if ($ttl_reply > 0){ ?>
                                                | <a href="javascript:void(0);" class="view_reply" section="designrequisition" val="<?php echo $log->id; ?>" data-last_id="0" data-type="1" title="Reply on activity"> <?php echo $ttl_reply; ?> Replies</a>
                                                <?php } ?>
                                                <div class="reply-div reply-box<?php echo $log->id; ?>" style="display: none;">
                                                    <?php //echo render_textarea('activity_reply['.$log->id.']','','',array('placeholder'=>_l('enter_activity'), 'class' => 'comment-box'),array(),'mtop15'); ?>
                                                    <div class="form-group mtop15" app-field-wrapper="description">
                                                        <!-- <textarea id="description<?php echo $log->id; ?>" val="<?php echo $log->id; ?>" name="activity_reply[<?php echo $log->id; ?>]" class="form-control description_box" placeholder="Enter Activity" rows="4"></textarea> -->
                                                        <input type="text" name="activity_reply[<?php echo $log->id; ?>]" val="<?php echo $log->id; ?>" id="description<?php echo $log->id; ?>" class="form-control description_box">
                                                    </div>
                                                    <div class="text-right">
                                                        <a href="javascript:void(0);" id="tag_employee_btn" value="<?php echo $log->id; ?>" class="btn btn-success tag_employee_btn">@ Tag Someone</a>
                                                        <button class="btn btn-info">Reply</button>
                                                        <a href="javascript:void(0);" onclick="close_reply_activity();" class="btn btn-danger">Close</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reply-view<?php echo $log->id; ?>"></div>
                                    </div>
                                    <?php
                                    $i++;
                                }
                              }else{
                                echo '<div class="col-md-12"><h1 class="text-danger text-center">No Activity Found!</h1></div>';
                              }  
                                ?>   
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div>
                  </div>
                </div>
                <?php 
                  } 
                  if ($estimate_id > 0){
                ?>
                <div class="col-md-6">
                  <div class="panel_s">
                    <div class="panel-body">
                      <h4 class="no-margin">Proforma Invoice Activities</h4>
                      <h4 style="color:red;"><a target="_blank" href="<?php echo admin_url('estimates/download_pdf/'.$estimate_id); ?>"><?php echo $estimate_number; ?></a></h4>
                      <hr class="hr-panel-heading">
                      <div class="row">
                        <div role="tabpanel" class="tab-pane" id="lead_activity">
                          <div class="panel_s no-shadow">
                            <div class="activity-feed ex3">
                            <?php
                                $i = 0;
                                if (!empty($estimate_activity_log)){
                                foreach ($estimate_activity_log as $key => $log) {
                                  $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblproformainvoiceactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                              ?>
                                  <div class="col-md-12 replyboxdiv<?php echo $log->id; ?>">
                                    <div class="feed-item">
                                      <div class="date">
                                        <span class="text-has-action" data-toggle="tooltip"><?php echo _dt($log->datetime); ?></span>
                                      </div>
                                      <div class="text <?php echo ($log->status == 2) ? 'line-throught' : ''; ?>">
                                        <a href="#" val="<?php echo $log->id; ?>" section="estimate_activity" pri="<?php echo $log->priority; ?>" onclick="return false;" class="priority" ><i class="fa <?php echo ($log->priority == 1) ? 'fa-star' : 'fa-star-o'; ?>" aria-hidden="true"></i></a>
                                        <?php
                                          if ((get_staff_user_id() == $log->staffid) && ($log->status == 1)) {
                                        ?>
                                            <a href="<?php echo admin_url('follow_up/cut_estimate_conversation/' . $log->id); ?>" onclick="return confirm('Are you sure you want to cut?');"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                        <?php
                                          }
                                          if (is_admin() == 1 && $ttl_reply == 0) {
                                        ?>
                                            <a href="<?php echo admin_url('follow_up/delete_estimate_conversation/' . $log->id); ?>" val="<?php echo $log->id; ?>" onclick="return confirm('Are you sure you want to Delete?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        <?php
                                          }
                                        if ($log->staffid != 0) { ?>                     
                                            <a href="<?php echo admin_url('profile/' . $log->staffid); ?>">
                                              <?php echo staff_profile_image($log->staffid, array('staff-profile-xs-image pull-left mright5')); ?>
                                            </a>
                                        <?php
                                          }
                                          echo get_employee_name($log->staffid) . ' - ';
                                          echo _l(str_replace("@", '<span style="color:red;">@</span>', $log->message), '', false);
                                        ?>
                                        <a href="javascript:void(0);" class="reply_comment" section="estimate_activity" val="<?php echo $log->id; ?>" title="Reply on activity"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>
                                        <?php if ($ttl_reply > 0){ ?>
                                        | <a href="javascript:void(0);" class="view_reply" section="estimate_activity" val="<?php echo $log->id; ?>" data-last_id="0" data-type="1" title="Reply on activity"> <?php echo $ttl_reply; ?> Replies</a>
                                        <?php } ?>
                                        <div class="reply-div reply-box<?php echo $log->id; ?>" style="display: none;">
                                          <?php //echo render_textarea('activity_reply['.$log->id.']','','',array('placeholder'=>_l('enter_activity'), 'class' => 'comment-box'),array(),'mtop15'); ?>
                                          <div class="form-group mtop15" app-field-wrapper="description">
                                              <!-- <textarea id="description<?php echo $log->id; ?>" val="<?php echo $log->id; ?>" name="activity_reply[<?php echo $log->id; ?>]" class="form-control description_box" placeholder="Enter Activity" rows="4"></textarea> -->
                                              <input type="text" name="activity_reply[<?php echo $log->id; ?>]" val="<?php echo $log->id; ?>" id="description<?php echo $log->id; ?>" class="form-control description_box">
                                          </div>
                                          <div class="text-right">
                                              <a href="javascript:void(0);" id="tag_employee_btn" value="<?php echo $log->id; ?>" class="btn btn-success tag_employee_btn">@ Tag Someone</a>
                                              <button class="btn btn-info">Reply</button>
                                              <a href="javascript:void(0);" onclick="close_reply_activity();" class="btn btn-danger">Close</a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="reply-view<?php echo $log->id; ?>"></div>
                                  </div>
                              <?php    
                                  }
                                }else{
                                  echo '<div class="col-md-12"><h1 class="text-danger text-center">No Activity Found!</h1></div>';
                                }
                              ?>
                              
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div class="col-md-12">
                  <div class="col-md-2">
                    <div class="form-group" app-field-wrapper="status">
                        <label for="type" class="control-label">Activity Type</label>
                        <select class="form-control selectpicker" id="avtivity_type" name="avtivity_type" data-live-search="true">
                            <option value="1">Lead</option>
                            <?php if ($enquirycall_id > 0){ ?>
                            <option value="2">Lead Form</option>
                            <?php } if ($designrequision_id > 0){ ?>
                            <option value="3">Design Requisition</option>
                            <?php } if ($estimate_id > 0){ ?>
                            <option value="4">Proforma Invoice</option>
                            <?php } ?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group mtop15 col-md-10" app-field-wrapper="description">
                    <textarea id="description0" val="0"  name="description" class="form-control description_box" placeholder="Enter Activity" rows="4"></textarea>
                  </div>
                  <div id="searchResult"></div>
                  <br>
                  <!-- <mark style="color:red">* Please use @ for tag someone</mark> -->
                  <div class="text-right">
                    <input type="hidden" value="<?php echo $lead_id; ?>" id="lead_id" name="lead_id">                                
                    <input type="hidden" value="<?php echo $enquirycall_id; ?>" id="enquirycall_id" name="enquirycall_id">                                
                    <input type="hidden" value="<?php echo $designrequision_id; ?>" id="design_requisition_id" name="design_requisition_id">                                
                    <input type="hidden" value="<?php echo $estimate_id; ?>" id="estimate_id" name="estimate_id">                                
                    <input type="hidden" name="tag_staff_ids" class="staff_ids">
                    <input type="hidden" name="tag_viewstaff_ids" class="view_staff_ids">
                    <input type="hidden" name="parent_id" class="reply_parent_id" value="0">
                    <button class="btn btn-info"><?php echo _l('submit'); ?></button>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>  
          </div>
        </div>
      </form>										
		</div>
  </div>
</div>
</div>

<?php init_tail(); ?>
<?php 
    $this->load->view("admin/follow_up/tag_staff_modal");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>
<script type="text/javascript">
      $(".myselect").select2();
</script>
<script type="text/javascript">
$(document).on('click', '.priority', function() {   
  
  var id = $(this).attr('val');
  var section = $(this).attr('section');
  var priority = $(this).attr('pri');
  
    var url_action = "<?php echo site_url('admin/follow_up/udpate_lead_priority'); ?>"
    if (section == "estimate_activity"){
      url_action = "<?php echo site_url('admin/follow_up/udpate_estimate_priority'); ?>"
    }else if (section == "designrequisition"){
      url_action = "<?php echo site_url('admin/designrequisition/udpate_designrequisition_priority'); ?>"
    }else if (section == "enquirycall_activity"){
      url_action = "<?php echo site_url('admin/enquirycall/udpate_enquirycall_priority'); ?>"
    }
    $.ajax({
      type    : "POST",
      url     : url_action,            
      data    : {'id' : id,'priority' : priority},
      success : function(response){
          location.reload();
      }
    })
}); 

$( document ).ready(function() {
    $('.ex3').animate({
        scrollTop: 1500
    }, 1000);

});
</script>
<script type="text/javascript">

// $(document).on("keypress", ".description_box", function(e){
//     if(e.which == 64){
//         var val = $(this).val();
//         var d_id = $(this).attr("val");
//        $.ajax({
//             url: "<?php echo admin_url("follow_up/get_staff_list");?>",
//             type: 'get',
//             success:function(response){

//                 $("#searchResult").html(response);
//                 $('.selectpicker').selectpicker('refresh');
//                 $(".dropdown-toggle").click();
// //                     binding click event to li
//                 $("#staffuserlist").bind("change",function(){
//                     var str = $(this).val();
//                     $("#description"+d_id).val(val+str);
//                     $("#description"+d_id).focus();
//                     $("#searchResult").empty();
//                 });

//             }
//         });
//     }
// });

function get_tag_staffid(el){
    var staff_id = el.selectedOptions[0].getAttribute('data-staff_id');
    var staff_ids = $(".staff_ids").val();
    var staff_val = staff_ids+","+staff_id;
    if (staff_ids == ""){
        staff_val = staff_id;
    }
    $(".staff_ids").val(staff_val);
 }


/* START THIS SCRIPT CODE USE FOR ACTIVIES REPLY */
 $(document).on("click",".reply_comment", function(){
  
    var logid = $(this).attr("val");
    var section = $(this).attr("section");
    if (section == "estimate_activity"){
      $('#avtivity_type option[value="4"]').attr("selected", "selected");
      $('.selectpicker').selectpicker('refresh');
    }else if (section == "designrequisition"){
      $('#avtivity_type option[value="3"]').attr("selected", "selected");
      $('.selectpicker').selectpicker('refresh');
    }else if (section == "enquirycall_activity"){
      $('#avtivity_type option[value="2"]').attr("selected", "selected");
      $('.selectpicker').selectpicker('refresh');
    }else{
      $('#avtivity_type option[value="1"]').attr("selected", "selected");
      $('.selectpicker').selectpicker('refresh');
    }
    
    $(".reply-div").hide();
    $(".reply-box"+logid).show();
    $(".reply_parent_id").val(logid);
 });

 function close_reply_activity(){
    $(".reply-div").hide();
    $(".reply_parent_id").val('0');
    $(".reply_comment").val('');
    $(".staff_ids").val('');
 }

 $(document).on("click",".view_reply", function(){
    var logid = $(this).attr("val");
    var section = $(this).attr("section");
    var last_reply_id = $(this).data("last_id");
    $(this).addClass("toggle_reply");
      $.ajax({
          type    : "POST",
          dataType: "json",
          url     : "<?php echo site_url('admin/follow_up/get_activities_reply'); ?>",            
          data    : {'id': last_reply_id, 'logid' : logid, 'section': section},
          success : function(response){
            if(response != ''){
                $(".reply-view"+logid).html(response.html);
            }
          }
      })
 });
$(document).on("click",".view_more_reply", function(){
    var logid = $(this).attr("val");
    var section = $(this).attr("section");
    var last_reply_id = $(this).attr("last_id");
    // var page = $(this).attr("page");
        $.ajax({
            type    : "POST",
            dataType: "json",
            url     : "<?php echo site_url('admin/follow_up/get_activities_reply'); ?>",            
            data    : {'id': last_reply_id, 'logid' : logid, 'section': section},
            success : function(response){
              if(response != ''){
                  // $(".reply-view"+logid).append(response.html);
                  $(response.html).insertAfter(".replyboxdiv"+last_reply_id);
                  $(".replymore"+logid).attr("last_id", response.last_id);
              }
              
            }
        })
    
 });
$(document).on("click",".toggle_reply", function(){
    var logid = $(this).attr("val");
    $(".reply-view"+logid).toggle();
 });
/* END THIS CODE USE FOR ACTIVIES REPLY SCRIPT CODE*/

</script>

</body>
</html>
