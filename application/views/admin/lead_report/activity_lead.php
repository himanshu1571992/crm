
<?php init_head(); ?>
<?php
$s_range = '';
$date_a = '';
$date_b = '';

if(!empty($range)){
  $s_range = $range;
}
if(!empty($f_date)){
  $date_a = $f_date;
}
if(!empty($t_date)){
  $date_b = $t_date;
}

$client_info = $this->db->query("SELECT * FROM tblclientbranch WHERE userid = '".$lead->client_branch_id."' ")->row();

if($lead->client_branch_id > 0){
    $company = $client_info->client_branch_name;
}else{
    $company = $lead->company;
}
?>
<div id="wrapper" class="customer_profile">
<div class="content">
   <div class="row">
      <div class="col-md-2">
         <div class="panel_s mbot5">
            <div class="panel-body padding-10">
               <h4 class="bold"><?php echo '#LEAD-'.number_series($lead_id); ?></h4>
            </div>
         </div>
         <?php echo lead_report_tab('lead_activity',$lead_id);?>
      </div>
      
            <div class="col-md-10">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="col-md-4"><h4 class="no-margin"> </h4></div>  

                   <h4 class="no-margin"><?php echo $title; ?><!-- <span style="padding-left: 15%;"><a href="<?php  echo admin_url('reminder/add/0/2'); ?>" class="btn btn-info"><i class="fa fa-bell-o" aria-hidden="true"></i> Set Reminder</a> <button value="1" name="important_search" class="btn btn-info"><i class="fa fa-star" aria-hidden="true"></i>  Search Important</button> <button type="button" id="load_more" class="btn btn-info"><i class="fa fa-refresh fa-spin" aria-hidden="true"></i>  Load last conversation</button> <?php if(!empty($contact_info)){ ?><a target="_blank" href="<?php echo admin_url('leads/lead_contact/'.$lead_id); ?>" class="btn btn-info"><i class="fa fa-user" aria-hidden="true"></i> Contacts</a><?php } ?></span>  --></h4>

          <hr class="hr-panel-heading">
          
          <div class="row">
            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  //echo admin_url('follow_up/lead_activity'); ?>">

            <div role="tabpanel" class="tab-pane" id="lead_activity">
         <div class="panel_s no-shadow">
            <div class="activity-feed">
               <?php
               $last_id = 0;
               $i = 0; 
                foreach($activity_log as $key => $log){
                     if($i == 0){
                        $last_id = $log->id;
                      }
                 ?>
               <div class="feed-item">
                  <div class="date">
                    <span class="text-has-action" data-toggle="tooltip" data-title="<?php echo _dt($log->datetime); ?>">
                    <?php echo time_ago($log->datetime); ?>
                  </span>
                  </div>
                  <div class="text <?php if($log->status == 2){ echo 'line-throught'; } ?>">


                    <a href="#" val="<?php echo $log->id; ?>" pri="<?php echo $log->priority; ?>" onclick="return false;" class="priority" ><i class="fa <?php echo ($log->priority == 1) ? 'fa-star' : 'fa-star-o'; ?>" aria-hidden="true"></i></a>


                     <?php
                    if((get_staff_user_id() == $log->staffid) && ($log->status == 1) ){
                      ?>
                        <a href="<?php  echo admin_url('follow_up/cut_lead_conversation/'.$log->id); ?>" onclick="return confirm('Are you sure you want to cut?');"><i class="fa fa-ban" aria-hidden="true"></i></a>
                      <?php
                    }
                    ?>



                    <?php
                    if(is_admin() == 1){
                      ?>
                        <a href="<?php  echo admin_url('follow_up/delete_lead_conversation/'.$log->id); ?>" val="<?php echo $log->id; ?>" onclick="return confirm('Are you sure you want to Delete?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      <?php
                    }
                    ?>

                     <?php if($log->staffid != 0){ ?>                     
                     <a href="<?php echo admin_url('profile/'.$log->staffid); ?>">
                     <?php echo staff_profile_image($log->staffid,array('staff-profile-xs-image pull-left mright5'));
                        ?>
                     </a>
                     <?php
                        }
                        echo get_employee_name($log->staffid) . ' - ';
                            echo _l($log->message,'',false);
                        ?>
                  </div>
               </div>
               <?php
               $from_date = $log->date;
               $to_date = '';
               $next_key = ($key+1); 
               if(!empty($activity_log[$next_key]->date)){
                  $to_date = $activity_log[$next_key]->date;
               }
               if(!empty($numbers)){
                  if($to_date != ''){
                      $call_history = $this->db->query("SELECT * from tblcalloutgoing where customer_number IN (".$numbers.") and date between '".$from_date."' and '".$to_date."'  order by id desc ")->result();
                  }else{
                      $call_history = $this->db->query("SELECT * from tblcalloutgoing where customer_number IN (".$numbers.") and date >= '".$from_date."'  order by id desc ")->result();
                  }
               }
               ?>

               <?php
               if(!empty($call_history)){
                  foreach ($call_history as $row) {
                    $customer_name = $this->db->query("SELECT c.firstname from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$log->lead_id."' and c.phonenumber = '".$row->customer_number."' ")->row()->firstname;
                    ?>
                    <div class="col-md-12" style="margin-bottom: 20px;">  
                      <div class="lead-view" id="leadViewWrapper">
                       <div class="col-md-4 col-xs-12 lead-information-col">
                          <div class="lead-info-heading">
                             <h4 class="no-margin font-medium-xs bold">Call To Details</h4>
                          </div>
                          <p class="text-muted lead-field-heading no-mtop">Customer Name</p>
                          <p class="bold font-medium-xs lead-name"><?php echo (!empty($customer_name)) ? $customer_name : '--'; ?></p>
                          <p class="text-muted lead-field-heading no-mtop">Customer No.</p>
                          <p class="bold font-medium-xs lead-name"><?php echo $row->customer_number; ?></p>

                       </div>
                      <div class="col-md-4 col-xs-12 lead-information-col">
                          <div class="lead-info-heading">
                             <h4 class="no-margin font-medium-xs bold">Call From Details</h4>
                          </div>
                          <p class="text-muted lead-field-heading no-mtop">Agent No.</p>
                          <p class="bold font-medium-xs lead-name"><span style="margin-right: 10px;"><?php echo $row->agent_number; ?></span> <!-- <img height="35" width="35" src="<?php echo base_url('assets/images/calltransfer.png'); ?>"> --></p>
                          <p class="text-muted lead-field-heading no-mtop">Calling Date</p>
                          <p class="bold font-medium-xs lead-name"><?php echo _d($row->created_at);?></p>

                       </div>
                       <div class="col-md-4 col-xs-12 lead-information-col">
                          <div class="lead-info-heading">
                             <h4 class="no-margin font-medium-xs bold">Recording</h4>
                          </div>
                          <p class="bold font-medium-xs lead-name"><img height="35" width="35" src="<?php if(!empty($row->recording_url)){ echo base_url('assets/images/calltransfer.png'); }else{ echo base_url('assets/images/misscall.png'); }  ?>">
                            <span style="margin-left: 10px; margin-top: 20px;">
                                 <audio controls style="height: 30px;width: 210px;">
                                    <source src="<?php echo $row->recording_url; ?>" type="audio/mpeg">
                                  </audio>
                            </span>
                           
                          </p>
                       </div>
                       
                    </div>
                    <hr>
                    </div>
                    <?php
                  }
               }
               ?>

              <?php 
                $i++;
               }                 
                ?>
            </div>
            <input type="hidden" value="<?php echo $lead_id; ?>" id="lead_id" name="lead_id">
            <input type="hidden" value="<?php echo $last_id; ?>" id="last_id">
            <div class="col-md-12">
              <?php
              if(!empty($suggestion_info)){
                foreach ($suggestion_info as $suggestion) {
                  ?>
                     <button class="btn" name="suggestion" value="<?php echo $suggestion->suggestion; ?>"><?php echo $suggestion->suggestion; ?></button>
                  <?php
                }
              }
              ?>
             </div> 
            <div class="col-md-12">
               <?php echo render_textarea('description','','',array('placeholder'=>_l('enter_activity')),array(),'mtop15'); ?>
               <div class="text-right">
                  <button class="btn btn-info"><?php echo _l('submit'); ?></button>
               </div>
            </div>
            <div class="clearfix"></div>
         </div>
      </div>
            </form>              
          </div>
                       
              
                        </div>
                       
                    </div>
                </div>
   </div>
</div>
</div>

<?php init_tail(); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>


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



<script type="text/javascript">
$(document).on('click', '.priority', function() {   
  
  var id = $(this).attr('val');
  var priority = $(this).attr('pri');
  
   $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/follow_up/udpate_lead_priority'); ?>",            
            data    : {'id' : id,'priority' : priority},
            success : function(response){
                location.reload();
            }
        })
  
        
    
}); 

/*$( document ).ready(function() {
    $('.ex3').animate({
        scrollTop: 999
    }, 1000);

});*/
</script>


<script type="text/javascript">
  $(document).on('click', '#load_more', function() {   
  
  var id = $("#last_id").val();
  var lead_id = $("#lead_id").val();
    
   $.ajax({
            type    : "POST",
            dataType: "json",
            url     : "<?php echo site_url('admin/follow_up/get_last_lead_conversion'); ?>",
            data    : {'id' : id,'lead_id' : lead_id},
            success : function(response){
                if(response != ''){
                   $("#last_id").val(response.last_id);
                   $( "#last_div" ).prepend(response.html);                   
                }
            }
        })
  
        
    
}); 
</script>

</body>
</html>
