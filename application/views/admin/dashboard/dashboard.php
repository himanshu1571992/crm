<?php init_head(); ?>

<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 80px;
  height: 80px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

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
</style>


<div id="wrapper">
    <div class="screen-options-area"></div>
    <div class="screen-options-btn">
        <?php echo _l('dashboard_options'); ?>
    </div>

    <div class="content">
        

        <div class="row">


            <?php include_once(APPPATH . 'views/admin/includes/alerts.php'); ?>

            <?php do_action( 'before_start_render_dashboard_content' ); ?>
            <div class="col-md-12">
              <div class="panel_s">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-10"><h4>Product Catgorization Guidance Tree</h4></div>
                    <div class="col-md-2"><a href="<?php echo base_url('assets/product_tree.pdf'); ?>" target="_blank" class="btn-sm btn-info pull-right">Show PDF</a></div>
                  </div>
                </div>
              </div>
            </div>          
            <?php
            if(!empty($employee_target)){
            ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">Your Sales Monthly Target </h4>
                        <hr class="hr-panel-heading">

                        <?php
                        foreach ($employee_target as $value) {
                            $archiveTargetAmount = getSaffArchiveTargetAmount($value->staff_id, date("m"), date("Y"), $value->product_category_id);
                            $percent = ($value->amount > 0 ? number_format(($archiveTargetAmount * 100) / $value->amount, 2) : 0);
                            ?>
                            <div class="col-md-4">                
                                <p class="text-uppercase mtop5"><i class="hidden-sm fa fa-tty"></i> <?php echo cc(value_by_id_empty('tbldivisionmaster',$value->product_category_id,'title')); ?> <?php //echo cc(get_product_category($value->product_category_id)); ?>
                                    <span class="pull-right"><?php echo number_format($value->amount, 2); ?> / <?php echo $archiveTargetAmount; ?></span>
                                </p>
                                <div class="clearfix"></div>
                                <div class="progress no-margin progress-bar-mini">
                                    <div class="progress-bar progress-bar-success no-percent-text not-dynamic" role="progressbar" aria-valuenow="<?php echo $percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: 0%" data-percent="<?php echo $percent; ?>">
                                    </div>
                                </div>
                            </div>


                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
            }


            if(is_admin() == 1){
            ?>
            <div class="col-md-12">
                <div class="panel_s">

                <div class="panel-body">
                <!-- <h4 class="no-margin">Sales Persons Monthly Target </h4> -->
                <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4>Sales Persons Monthly Target</h4>
                            </div>
                            <div class="col-xs-12 col-md-6 text-right">
                                <button class="btn-sm btn-info pull-right" style="margin-top:-6px;" type="button" id="show_target" value="1">Show Target</button>
                            </div>
                        </div>
                <hr class="hr-panel-heading">
                <div class="col-md-12" id="show_target_div"> 

                    <div id="loader_div" hidden="">
                         <div class="col-md-5"></div>
                        <div class="col-md-6 loader"></div>
                    </div>
                    
                          <!-- <div class="table-responsive">                                                          
                            <table class="table" id="newtable">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Employee Name</th>
                                        <th>Target Amount</th>
                                        <th>Achieved Amount</th>
                                        <th>Achieved Percent</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    if (!empty($salesmen_target)) {
                                        $z = 1;
                                        foreach ($salesmen_target as $row) {
                                            ?>                                                                                      
                                                <tr>
                                                    <td><?php echo $z++; ?></td>
                                                    <td><?php echo cc(get_employee_name($row->staff_id)); ?></td>
                                                    <td class="targetamt<?php echo $z; ?>"><a href="javascript:void(0)" data-staffid="<?php echo $row->staff_id; ?>" data-rid="<?php echo $z; ?>" class="btn-sm btn-info showtarget">Show Target</a></td>
                                                    <td class="achievedamt<?php echo $z; ?>">--</td>
                                                    <td class="achievedpercent<?php echo $z; ?>">--</td>
                                                    <td><a target="_blank" href="<?php echo admin_url("employees/staff_target_list/".$row->staff_id."");?>">Show Details</a></td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                  ?>
                                </tbody>
                            </table>
                          </div> -->
                    </div>
                                    
                 
                 </div>
                </div>
            </div>
            <?php    
            }
            ?>            

            <div class="clearfix"></div>

            <div class="col-md-12 mtop30" data-container="top-12">
                <?php render_dashboard_widgets('top-12'); ?>
            </div>

            <?php do_action('after_dashboard_top_container'); ?>

            <div class="col-md-6" data-container="middle-left-6">
                <?php render_dashboard_widgets('middle-left-6'); ?>
            </div>
            <div class="col-md-6" data-container="middle-right-6">
                <?php render_dashboard_widgets('middle-right-6'); ?>
            </div>

            <?php do_action('after_dashboard_half_container'); ?>

            <div class="col-md-8" data-container="left-8">
                <?php render_dashboard_widgets('left-8'); ?>
            </div>
            <div class="col-md-4" data-container="right-4">
                <?php render_dashboard_widgets('right-4'); ?>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-4" data-container="bottom-left-4">
                <?php render_dashboard_widgets('bottom-left-4'); ?>
            </div>
             <div class="col-md-4" data-container="bottom-middle-4">
                <?php render_dashboard_widgets('bottom-middle-4'); ?>
            </div>
            <div class="col-md-4" data-container="bottom-right-4">
                <?php render_dashboard_widgets('bottom-right-4'); ?>
            </div>

            <?php do_action('after_dashboard'); ?>
        </div>
    </div>
</div>
<script>
    google_api = '<?php echo get_option('google_api_key'); ?>';
    calendarIDs = '<?php echo json_encode($google_ids_calendars); ?>';
</script>
<?php init_tail(); ?>
<?php $this->load->view('admin/utilities/calendar_template'); ?>
<?php $this->load->view('admin/dashboard/dashboard_js'); ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>

<?php
// if(is_admin() == 1){
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script>

    $(document).ready(function () {
        $('#newtable').DataTable({
            "iDisplayLength": 15,
            dom: 'Bfrtip'
        });
            
    });
</script>
<?php
// }
?>

<!-- Button trigger modal -->
<button style="display: none;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="notification_click">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title" id="exampleModalCenterTitle">Pending Notifications For Action</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="tabel-responsive">
              <table class="table" id="">
                  <thead>
                      <tr>
                        <th align="left" style="background:#252733 !important; font-size: 18px !important;">Pending Notifications List</th> 
                      </tr>
                  </thead>
                  <tbody class="ui-sortable">

                    <?php
                    if(!empty($notification_list)){
                       foreach ($notification_list as $key => $value) {

                            if($value->approve_status == 0){
                                $status = 'Pending';
                                $status_cls = 'pending';
                            }elseif($value->approve_status == 1){
                                $status = 'Approved';
                                $status_cls = 'approve';
                            }elseif($value->approve_status == 2){
                                $status = 'Rejected';
                                $status_cls = 'cancel';
                            }elseif($value->approve_status == 5){
                                $status = 'On Hold';
                                $status_cls = 'hold';
                            }

                            $from_name = '';
                            if($value->fromuserid){
                                $from_name = get_employee_name($value->fromuserid).' - ';
                            }

                            $pdf_html = '';
                            if($value->module_id == 3){
                                $pdf_html = '<a target="_blank" href="'.admin_url('purchase/download_pdf/'.$value->table_id).'">PDF</a>';
                            }elseif($value->module_id == 29){
                                $pdf_html = '<a target="_blank" href="'.admin_url('Chalan/pdf/'.$value->table_id).'">PDF</a>';
                            }

                            $number = '';
                            if($value->module_id == 3){
                                $number = 'PO-'.value_by_id('tblpurchaseorder',$value->table_id,'number');
                            }elseif($value->module_id == 4){
                                $number = 'MR-'.$value->table_id;
                            }  
                        ?>
                          <tr>
                            <td style="padding: 0;">
                              <table>
                                <tr>
                                  <td>
                                    <div class="notification-box-all <?php if($value->isread == 0){echo ' unread';} ?>">
                                      <div class="row">
                                        <div class="col-10 col-sm-10">
                                          <a href="#"><img src="https://schachengineers.com/schacrm_test/assets/images/user-placeholder.jpg" class="staff-profile-image-small img-circle pull-left"></a>
                                          <div class="media-body notification_link">
                                            <a href="javascript:;" onclick="getlinlk(<?php echo $value->id; ?>); return false;"><div class="description"><?php echo $from_name.$value->description; ?></div></a>
                                            <small class="text-muted text-right text-has-action"><span data-placement="right" data-toggle="tooltip" data-title="<?php echo _dt($value->date_time); ?>"><?php echo time_ago($value->date_time); ?></span> <b style="color:#2196F3; font-size:11px;margin-left: 5px;">(<?php echo value_by_id('tblcrmmodules',$value->module_id,'name').' '.$number; ?>)</b>&nbsp;<b style="font-size:11px;margin-left: 5px;" class="text-success"><?php echo getModuleHeadName($value->module_id, $value->table_id)["notification_title"]; ?></b></small>
                                          </div>
                                        </div>
                                        
                                        <div class="col-2 col-sm-2 text-right">
                                           <a href="javascript:;" onclick="getDetails(<?php echo $value->id; ?>); return false;" href="#" class="text-muted <?php echo $status_cls; ?> statusBtn" value="1" data-toggle="modal" data-target="#statusModal"><?php echo $status; ?></a>
                                        </div>
                                        <div class="col-2 col-sm-2 text-right">
                                          <?php echo $pdf_html; ?>
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
</div>


<script>

  <?php if($today_attendance_status == 0){ ?>
  $("document").ready(function() {
      
        swal("You Did Not Mark Your Attendance", "Please  Mark Attendance First", {
            icon : "info",
            closeOnClickOutside: false,
            buttons: {
              confirm: {
                className : 'btn-info btn-attendance',
                text: "Mark Attendance",
                customClass: "swal-back"
              }
            },
        }).then((result) => {
          
            if (result == true){
                $.ajax({
                    type    : "POST",
                    url     : "<?php echo base_url(); ?>Staff_API/mark_attendance",
                    data    : {'user_id' : '<?php echo get_staff_user_id(); ?>'},
                    success : function(response){
                      if(response != ''){
                          if (response.status == true){
                            swal(response.message, "", "success");
                          }else{
                            swal(response.message, "", "warning");
                          }
                          location.reload();
                      }
                    }
                });
            }
            
        });
    }); 
<?php
  }
if(!empty($notification_list)){
?>
$("document").ready(function() {
    $("#notification_click").trigger('click');
});
<?php
}
if (!empty($pending_leave_request) && $pending_leave_request > 0 && $today_attendance_status > 0){
?>
$("document").ready(function() {
      var base_url = "<?php echo site_url('admin/approval/staff_notification_list/3'); ?>"
      swal("Leave Request Pending For Your Approval", "Please Take Action On It.", {
          icon : "info",
          closeOnClickOutside: false,
          buttons: {
            confirm: {
              className : 'btn-info',
              text: "Take Action",
              customClass: "swal-back"
            }
          },
      }).then((result) => {
        
          if (result == true){
            window.location.replace(base_url);
          }
          
      });
  }); 
<?php
}  
?>

function getlinlk(id) {

   $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/approval/getNotificationLink",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){
                location.href = response
            }
        }
    })

}

function getDetails(id) {

   $.ajax({
      type    : "POST",
      url     : "<?php echo base_url('admin/approval/get_status'); ?>",
      data    : {'id' : id},
      success : function(response){
        if(response != ''){
          $("#approval_html").html(response);
        }
      }
    })

}
</script>

<script type="text/javascript">
$(document).on('click', '#show_target', function() {  

    var show = $(this).val();
    $('#loader_div').show(); 
    $.ajax({
        type    : "POST",
        url     : "<?php echo admin_url('dashboard/get_sales_target_html'); ?>",
        data    : {'show' : show},
        success : function(response){
            if(response != ''){       

                $('#show_target_div').html(response); 

                 $('#newtable').DataTable({
                        "iDisplayLength": 15,
                        dom: 'Bfrtip'
                    }); 
            }
        }
    })

}); 
  $(document).on('click', '.showtarget', function() {
    var rid = $(this).data('rid');
    var staffid = $(this).data('staffid');
    $(".targetamt"+rid).html('<button class="btn-sm btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...</button>');
    $(".achievedamt"+rid).html('<button class="btn-sm btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...</button>');
    $(".achievedpercent"+rid).html('<button class="btn-sm btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...</button>');
    
    $.ajax({
      type    : "POST",
      url     : "<?php echo admin_url('dashboard/get_sales_target_amounts'); ?>",
      data    : {'staff_id' : staffid},
      success : function(response){
          if(response != ''){
            const obj = JSON.parse(response);
            $(".targetamt"+rid).html(obj.amount);
            $(".achievedamt"+rid).html(obj.ttltargetamount);
            $(".achievedpercent"+rid).html(obj.achieved_percent);
          }else{
            $(".targetamt"+rid).html('<a href="javascript:void(0)" data-staffid="'+staffid+'" data-rid="'+rid+'" class="btn-sm btn-info showtarget">Show Target</a>');
            $(".achievedamt"+rid).html('--');
            $(".achievedpercent"+rid).html('--');
          }
      }
    });
  });

</script>


<script>

$(document).ready(function() {
    $('#newtable1').DataTable( {
        
        "iDisplayLength": 15,
        dom: 'Bfrtip'
    } );
} );
</script>
<script type="text/javascript">
	$(document).on('click', '.assignees', function() { 	
//	var id = $(this).val();
	var id = $(this).data("value");

	if(id != ''){
		 $.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/task/get_assignee_list'); ?>",
			data    : {'id' : id},
			success : function(response){
				if(response != ' '){
					$("#assig_div").html(response);
				}
			}
		})
	}
		
	});
</script> 
