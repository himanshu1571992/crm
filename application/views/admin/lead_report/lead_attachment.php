
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
         <?php echo lead_report_tab('attachment',$lead_id);?>
      </div>
      
            <div class="col-md-10">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="col-md-4"><h4 class="no-margin"> </h4></div>  

                   <h4 class="no-margin"><?php echo $title.' ('.cc($company).')'; ?> </h4>

          <hr class="hr-panel-heading">
          
          <div class="row">
            <!-- <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('leads/add_activity_new');?>"> -->
              <div role="tabpanel" class="tab-pane" id="attachments">
         <?php echo form_open('admin/leads/add_lead_attachment',array('class'=>'dropzone mtop15 mbot15','id'=>'lead-attachment-upload')); ?>
         <input type="hidden" value="<?php echo $lead_id; ?>" name="id">
         <?php echo form_close(); ?>
         <?php if(get_option('dropbox_app_key') != ''){ ?>
         <hr />
         <div class="text-center">
            <div id="dropbox-chooser-lead"></div>
         </div>
         <?php } ?>
         <?php if(count($lead->attachments) > 0) { ?>
         <div class="mtop20" id="lead_attachments">
            <?php $this->load->view('admin/leads/leads_attachments_template', array('attachments'=>$lead->attachments)); ?>
         </div>
         <?php } ?>
      </div>
            <!-- </form>-->          
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
