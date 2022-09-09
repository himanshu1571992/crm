
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
         <?php echo lead_report_tab('activity',$lead_id);?>
      </div>
      
            <div class="col-md-10">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="col-md-4"><h4 class="no-margin"> </h4></div>  

                   <h4 class="no-margin"><?php echo $title.' ('.cc($company).')'; ?> </h4>

          <hr class="hr-panel-heading">
          
          <div class="row">
            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('leads/add_activity_new');?>">

            <div role="tabpanel" class="tab-pane" id="lead_activity">
         <div class="panel_s no-shadow">
            <div class="activity-feed">
               <?php foreach($activity_log as $log){ ?>
               <div class="feed-item">
                  <div class="date">
                    <span class="text-has-action" data-toggle="tooltip" data-title="<?php echo _dt($log['date']); ?>">
                    <?php echo time_ago($log['date']); ?>
                  </span>
                  </div>
                  <div class="text">
                     <?php if($log['staffid'] != 0){ ?>
                     <a href="<?php echo admin_url('profile/'.$log["staffid"]); ?>">
                     <?php echo staff_profile_image($log['staffid'],array('staff-profile-xs-image pull-left mright5'));
                        ?>
                     </a>
                     <?php
                        }
                        $additional_data = '';
                        if(!empty($log['additional_data'])){
                         $additional_data = unserialize($log['additional_data']);
                         echo ($log['staffid'] == 0) ? _l($log['description'],$additional_data) : $log['full_name'] .' - '._l($log['description'],$additional_data);
                        } else {
                            echo $log['full_name'] . ' - ';
                           if($log['custom_activity'] == 0){
                              echo cc(_l($log['description']));
                           } else {
                              echo cc(_l($log['description'],'',false));
                           }
                        }
                        ?>
                  </div>
               </div>
               <?php } ?>
            </div>
            <input type="hidden" value="<?php echo $lead_id; ?>" name="leadid">
            <div class="col-md-12">
               <?php echo render_textarea('activity','','',array('placeholder'=>_l('enter_activity')),array(),'mtop15'); ?>
               <div class="text-right">
                  <button id="lead_enter_activity" class="btn btn-info"><?php echo _l('submit'); ?></button>
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


<script>

$(document).ready(function() {
    $('#newtable').DataTable( {
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        buttons: [           
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ]
    } );
} );
</script>

</body>
</html>
