<?php
$session_id = $this->session->userdata();
init_head();
?>

<style type="text/css">
  .statusBtn{
    margin: 0 5px;
    font-size: 12px;
  }
  .pending{
    color: #ff9934;
  }
  .approve{
    color: #138806;
  }
  .cancel{
    color: #F44336;
  }
  .hold{
    color: #e8bb0b;
  }
  .notification-box-all.unread, .notification-box.unread {
      margin-bottom: 0;
  }
  .form-control{
    height: 40px;
  }
  td {
      border-top: none !important;
  }
  
  
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            
      
            <div class="col-md-10 col-md-offset-1">
               
                <div class="panel_s">
                
                <div class="panel-body">

              <div class="row">
                <div class="col-sm-6">
                  <h4 style="color: #607D8B;"><?php echo $title; ?></h4>
                </div>
                <div class="col-sm-6 text-right">
                  <button type="button" class="btn btn-default" id="filter-btn">
                      <i class="fa fa-filter" aria-hidden="true"></i>
                  </button>
                </div>
              </div>

            <hr class="hr-panel-heading">
            
            <div id="filter-box" style="display: none;">
              <form method="post" enctype="multipart/form-data" action="">
                <div class="form-group col-md-4">
                  <label for="module_id" class="control-label">Select Module</label>
                  <select class="form-control selectpicker" data-live-search="true" name="module_id">
                      <option value="">Select Module</option>
                      <option value="1" <?php echo (!empty($s_module) && $s_module == 1) ? 'selected':''; ?>>Request</option>
                      <option value="2" <?php echo (!empty($s_module) && $s_module == 2) ? 'selected':''; ?>>Expenses</option>
                      <option value="3" <?php echo (!empty($s_module) && $s_module == 3) ? 'selected':''; ?>>Leave</option>
                      <option value="8" <?php echo (!empty($s_module) && $s_module == 8) ? 'selected':''; ?>>Assign Manager For Petty Cash</option>
                      <option value="9" <?php echo (!empty($s_module) && $s_module == 9) ? 'selected':''; ?>>Petty Cash</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="status" class="control-label">Select Status</label>
                    <select class="form-control selectpicker" data-live-search="true" name="status">
                        <option value=""></option>
                        <option value="0" <?php echo (isset($s_status) && $s_status == 0) ? 'selected':''; ?>>Pending</option>
                        <option value="1" <?php echo (!empty($s_status) && $s_status == 1) ? 'selected':''; ?>>Approved</option>
                        <option value="2" <?php echo (!empty($s_status) && $s_status == 2) ? 'selected':''; ?>>Rejected</option>
                    </select>
                </div>
                
                <div class="form-group col-md-2" app-field-wrapper="date">
                  <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                  <div class="input-group date">
                    <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                  </div>
                </div>
                
                <div class="form-group col-md-2" app-field-wrapper="date">
                  <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                  <div class="input-group date">
                    <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                  </div>
                </div>
                
                <div class="form-group col-md-2 float-right">
                  <button class="form-control btn-info" type="submit" style="margin-top: 25px;">Search</button>
                </div>
              </form>
            </div>

            <div class="tabel-responsive">
              <table class="table" id="newtable">
                  <thead>
                      <tr>
                        <th align="left" style="background:#252733 !important; font-size: 18px !important;">Notification List</th> 
                      </tr>
                  </thead>
                  <tbody class="ui-sortable">

                    <?php
                    if(!empty($notification_list)){
                       foreach ($notification_list as $key => $value) {

                            $category_name = get_any_category_name($value->module_id,$value->category_id);
                            if ($value->module_id == 8){
                              $category_name = "Assign Manager For Petty Cash";
                            }
                            if ($value->module_id == 9){
                              $category_name = "Petty Cash";
                            }
                            if($value->approved_status == 0){
                                $status = 'Pending';
                                $status_cls = 'pending';
                            }elseif($value->approved_status == 1){
                                $status = 'Approved';
                                $status_cls = 'approve';
                            }elseif($value->approved_status == 2){
                                $status = 'Rejected';
                                $status_cls = 'cancel';
                            }

                            $from_name = '';
                            if($value->fromuserid > 0){
                                $from_name = get_employee_name($value->fromuserid).' - ';
                            }

                            $number = '';
                            if ($value->module_id == "1" && $value->category_id == "1") {
                              $number = "REQ-SAL-".number_series($value->table_id);
                            }
                            if ($value->module_id == "1" && $value->category_id == "2") {
                              $number = "REQ-ADV-".number_series($value->table_id);
                            }
                            if ($value->module_id == "1" && $value->category_id == "3") {
                              $number = "REQ-LOA-".number_series($value->table_id);
                            }
                            if ($value->module_id == "1" && $value->category_id == "4") {
                              $number = "REQ-TRA-".number_series($value->table_id);
                            }
                            if ($value->module_id == "2") {
                              $number = "EXP-".get_short(get_expense_category($value->category_id))."-".number_series($value->table_id);
                            }
                            if ($value->module_id == "3") {
                              $number = "LEA-".number_series($value->table_id);
                            }                        
                            if ($value->module_id == "9" && $value->type == "1" && $value->for_manager_approval == "0") {
                              $number = "REQ-PTC-".number_series($value->table_id);
                            }
                            if ($value->module_id == "9" && $value->type == "1" && $value->for_manager_approval == "1") {
                              $request_id = value_by_id("tblpettycashapproved", $value->table_id, "request_id");
                              if ($value->category_id == 1){
                                $number = "REQ-SAL-".number_series($request_id);
                              }else if ($value->category_id == 2){
                                $number = "REQ-ADV-".number_series($request_id);
                              }else if ($value->category_id == 3){
                                $number = "REQ-LOA-".number_series($request_id);
                              }else if ($value->category_id == 4){
                                $number = "REQ-TRA-".number_series($request_id);
                              }
                            }                         
                            
                            $profile = $this->staff_model->get($value->fromuserid);
                            if(!empty($profile->profile_image)){
                              $profile_image = base_url('uploads/staff_profile_images/'.$value->fromuserid.'/'.$profile->profile_image);
                            }else{
                              $profile_image = 'https://schachengineers.com/schacrm_test/assets/images/user-placeholder.jpg';
                            }

                            $notification_id = ($value->old_id > 0) ? $value->old_id : $value->id;
                        ?>
                          <tr>
                            <td style="padding: 0;">
                              <table>
                                <tr>
                                  <td>
                                    <div class="notification-box-all <?php if($value->isread == 0){echo ' unread';} ?>">
                                      <div class="row">
                                        <div class="col-10 col-sm-10">
                                          <a href="#"><img src="<?php echo $profile_image; ?>" class="staff-profile-image-small img-circle pull-left"></a>
                                          <div class="media-body notification_link">
                                            <?php //if ($value->module_id == "2") { ?>
                                              <!-- <a href="<?php echo admin_url('expenses/get_multiple_expense/'.$notification_id); ?>"><div class="description"><?php echo $from_name.$value->description; ?></div></a> -->
                                            <?php //}else if ($value->module_id == "1" && $value->type == "2") { ?>
                                              <!-- <a href="<?php echo admin_url('requests/request_comfirm/'.$value->table_id); ?>"><div class="description"><?php echo $from_name.$value->description; ?></div></a> -->
                                            <?php //}else{ ?>
                                              <!-- <a href="javascript:;" onclick="getlinlk(<?php echo $value->id; ?>); return false;"><div class="description"><?php echo $from_name.$value->description; ?></div></a> -->
                                            <?php //} ?>
                                            <a href="javascript:;" onclick="getlinlk(<?php echo $value->id; ?>); return false;"><div class="description"><?php echo $from_name.$value->description; ?></div></a> 
                                            <small class="text-muted text-right text-has-action"><span data-placement="right" data-toggle="tooltip" data-title="<?php echo _dt($value->date); ?>"><?php echo _dt($value->date); ?></span> <b style="color:#2196F3; font-size:11px;margin-left: 5px;">(<?php echo cc($category_name); ?>)</b>&nbsp;<b style="font-size:11px;margin-left: 5px;" class="text-success"><?php echo ($number != '') ? '['.$number.']':''; ?></b></small>
                                          </div>
                                        </div>
                                        
                                        <div class="col-2 col-sm-2 text-right">
                                           <!-- <a href="javascript:;" onclick="getDetails(<?php echo $value->id; ?>); return false;" href="#" class="text-muted <?php echo $status_cls; ?> statusBtn" value="1" data-toggle="modal" data-target="#statusModal"><?php echo $status; ?></a> -->
                                           <a href="javascript:;" href="#" class="text-muted <?php echo $status_cls; ?> statusBtn" value="1"><?php echo $status; ?></a>
                                        </div>
                                      </div><!--//row//-->
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        <?php
                       }
                    }
                    ?>                    

                </tbody>
               </table>
             </div>

            
                    </div>
                </div>
               

            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
    <?php init_tail(); ?>


<!-- Modal -->
<div id="statusModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Approval Status</h4>
      </div>
      <div class="modal-body" id="approval_html">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

   
</body>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script>

$(document).ready(function() {
    $('#newtable').DataTable( {
          "pageLength": 25,
          "aaSorting": []
    } );
} );


$("#filter-btn").click(function(){
  $("#filter-box").toggle(500);
});

function getlinlk(id) {

   $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/approval/getStaffNotificationLink",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){
                location.href = response
            }
        }
    })

}

// function getDetails(id) {

//    $.ajax({
//       type    : "POST",
//       url     : "<?php echo base_url('admin/approval/get_status'); ?>",
//       data    : {'id' : id},
//       success : function(response){
//         if(response != ''){
//           $("#approval_html").html(response);
//         }
//       }
//     })

// }
</script>






</html>
