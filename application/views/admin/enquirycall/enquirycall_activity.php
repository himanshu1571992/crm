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
            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php //echo admin_url('follow_up/lead_activity');  ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4 class="no-margin"><?php echo $title; ?>  <span style="padding-left: 15%;"><button value="1" name="important_search" class="btn btn-info"><i class="fa fa-star" aria-hidden="true"></i>  Search Important</button> <button type="button" id="load_more" class="btn btn-info"><i class="fa fa-refresh fa-spin" aria-hidden="true"></i>  Load last conversation</button> <a target="_blank" href="<?php echo admin_url('enquirycall/enquirycall_contacts/'.$enquirycall_id); ?>" class="btn btn-info"><i class="fa fa-user" aria-hidden="true"></i> Contacts</a></span></h4>
                            <h4 style="color:red;"><?php
                                echo cc(value_by_id_empty("tblenquirycall", $enquirycall_id, "company_name"));
                                ?></h4>    
                                <hr class="hr-panel-heading">
                                <div class="row">
                                <div class="col-md-12"><a href="javascript:void(0);" id="tag_employee_btn" value="0" class="btn btn-success pull-right tag_employee_btn">@ Tag Someone</a></div>
                                <div role="tabpanel" class="tab-pane" id="lead_activity">
                                    <div class="panel_s no-shadow">
                                        <div class="activity-feed ex31">

                                            <div id="last_div" >

                                            </div>

                                            <?php
                                            $last_id = 0;
                                            $i = 0;
                                            foreach ($activity_log as $key => $log) {
                                                if ($i == 0) {
                                                    $last_id = $log->id;
                                                }
                                                $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblenquirycall_activity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                                                ?>
                                                <div class="col-md-12 replyboxdiv<?php echo $log->id; ?>">
                                                    <div class="feed-item">
                                                        <div class="date">
                                                            <span class="text-has-action" data-toggle="tooltip">
                                                        <?php echo _dt($log->datetime); ?>
                                                            </span>
                                                        </div>
                                                        <div class="text <?php if ($log->status == 2) {
                                                                echo 'line-throught';
                                                            } ?>">
                                                            <a href="#" val="<?php echo $log->id; ?>" pri="<?php echo $log->priority; ?>" onclick="return false;" class="priority" ><i class="fa <?php echo ($log->priority == 1) ? 'fa-star' : 'fa-star-o'; ?>" aria-hidden="true"></i></a>
                                                            <?php
                                                            if ((get_staff_user_id() == $log->staffid) && ($log->status == 1)) {
                                                                ?>
                                                                <a href="<?php echo admin_url('enquirycall/cut_enquirycall_conversation/' . $log->id); ?>" onclick="return confirm('Are you sure you want to cut?');"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if (is_admin() == 1 && $ttl_reply == 0) {
                                                                ?>
                                                                <a href="<?php echo admin_url('enquirycall/delete_enquirycall_conversation/' . $log->id); ?>" val="<?php echo $log->id; ?>" onclick="return confirm('Are you sure you want to Delete?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                                <?php
                                                            }
                                                            ?>

                                                            <?php if ($log->staffid != 0) { ?>                     
                                                                <a href="<?php echo admin_url('profile/' . $log->staffid); ?>">
                                                                    <?php echo staff_profile_image($log->staffid, array('staff-profile-xs-image pull-left mright5'));
                                                                    ?>
                                                                </a>
                                                                <?php
                                                            }
                                                            echo get_employee_name($log->staffid) . ' - ';
                                                            echo _l(str_replace("@", '<span style="color:red;">@</span>', $log->message), '', false);
                                                            ?>
                                                            <a href="javascript:void(0);" class="reply_comment" val="<?php echo $log->id; ?>" title="Reply on activity"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>
                                                            <?php if ($ttl_reply > 0){ ?>
                                                            | <a href="javascript:void(0);" class="view_reply" val="<?php echo $log->id; ?>" data-last_id="0" data-type="1" title="Reply on activity"> <?php echo $ttl_reply; ?> Replies</a>
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
                                            ?>

                                        </div>
                                        <input type="hidden" value="<?php echo $enquirycall_id; ?>" id="enquirycall_id" name="enquirycall_id">
                                        <input type="hidden" value="<?php echo $last_id; ?>" id="last_id">
                                        <div class="col-md-12">
                                            <?php
                                            if (!empty($suggestion_info)) {
                                                foreach ($suggestion_info as $suggestion) {
                                                    ?>
                                                    <button class="btn" name="suggestion" value="<?php echo $suggestion->suggestion; ?>"><?php echo $suggestion->suggestion; ?></button>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div> 
                                        <div class="col-md-12">
                                            <?php //echo render_textarea('description', '', '', array('placeholder' => _l('enter_activity')), array(), 'mtop15'); ?>
                                            <div class="form-group mtop15" app-field-wrapper="description"><textarea id="description0" val="0"  name="description" class="form-control description_box" placeholder="Enter Activity" rows="4"></textarea></div>
                                            <div id="searchResult"></div>
                                            <br>
                                            <!-- <mark style="color:red">* Please use @ for tag someone</mark> -->
                                            <div class="text-right">
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
$(function () {
    $('#color-group').colorpicker({horizontal: true});
});
</script>
<script type="text/javascript">
    $(".myselect").select2();
</script>

<script type="text/javascript">
    $(document).on('click', '.priority', function () {

        var id = $(this).attr('val');
        var priority = $(this).attr('pri');

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/enquirycall/udpate_enquirycall_priority'); ?>",
            data: {'id': id, 'priority': priority},
            success: function (response) {
                location.reload();
            }
        })
    });

    $(document).ready(function () {
        $('.ex3').animate({
            scrollTop: 1500
        }, 1000);

    });
</script>

<script type="text/javascript">
    $(document).on('click', '#load_more', function () {

        var id = $("#last_id").val();
        var enquirycall_id = $("#enquirycall_id").val();

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo site_url('admin/enquirycall/get_last_enquirycall_conversion'); ?>",
            data: {'id': id, 'enquirycall_id': enquirycall_id},
            success: function (response) {
                if (response != '') {
                    $("#last_id").val(response.last_id);
                    $("#last_div").prepend(response.html);
                }
            }
        })
    });

//     $(document).on("keypress", ".description_box", function (e) {
//         if (e.which == 64) {
//             var val = $(this).val();
//             var d_id = $(this).attr("val");
//             $.ajax({
//                 url: "<?php echo admin_url("follow_up/get_staff_list"); ?>",
//                 type: 'get',
//                 success: function (response) {

//                     $("#searchResult").html(response);
//                     $('.selectpicker').selectpicker('refresh');
//                     $(".dropdown-toggle").click();
// //                     binding click event to li
//                     $("#staffuserlist").bind("change", function () {
//                         var str = $(this).val();
//                         $("#description"+d_id).val(val+str);
//                         $("#searchResult").empty();
//                     });

//                 }
//             });
//         }
//     });

    function get_tag_staffid(el) {
        var staff_id = el.selectedOptions[0].getAttribute('data-staff_id');
        var staff_ids = $(".staff_ids").val();
        var staff_val = staff_ids + "," + staff_id;
        if (staff_ids == "") {
            staff_val = staff_id;
        }
        $(".staff_ids").val(staff_val);
    }

    
/* START THIS SCRIPT CODE USE FOR ACTIVIES REPLY */
 $(document).on("click",".reply_comment", function(){
    var logid = $(this).attr("val");
    $(".reply-div").hide();
    $(".reply-box"+logid).show();
    $(".reply_parent_id").val(logid);
 });

 function close_reply_activity(){
    $(".reply-div").hide();
    $(".reply_parent_id").val('0');
    $(".staff_ids").val('');
 }

 $(document).on("click",".view_reply", function(){
    var logid = $(this).attr("val");
    var last_reply_id = $(this).data("last_id");
    $(this).addClass("toggle_reply");
      $.ajax({
          type    : "POST",
          dataType: "json",
          url     : "<?php echo site_url('admin/follow_up/get_activities_reply'); ?>",            
          data    : {'id': last_reply_id, 'logid' : logid, 'section': 'enquirycall_activity'},
          success : function(response){
            if(response != ''){
                $(".reply-view"+logid).html(response.html);
            }
            
          }
      })
    
 });
$(document).on("click",".view_more_reply", function(){
    var logid = $(this).attr("val");
    var last_reply_id = $(this).attr("last_id");
    // var page = $(this).attr("page");
        $.ajax({
            type    : "POST",
            dataType: "json",
            url     : "<?php echo site_url('admin/follow_up/get_activities_reply'); ?>",            
            data    : {'id': last_reply_id, 'logid' : logid, 'section': 'enquirycall_activity'},
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
