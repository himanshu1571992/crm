
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
         <?php echo lead_report_tab('quotation',$lead_id);?>
      </div>
      
            <div class="col-md-10">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="col-md-4"><h4 class="no-margin"> </h4></div>  

                   <h4 class="no-margin"><?php echo $title.' ('.$company.')'; ?> </h4>

          <hr class="hr-panel-heading">
          
          <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="">
              
             <div class="col-md-3">
                <div class="form-group select-placeholder">
                    <select class="selectpicker" name="range" id="range" data-width="100%" required="" onchange="render_customer_statement();">
                        <option value="1" <?php if(!empty($range) && $range == 1){ echo 'selected'; } ?>>Today</option>
                        <option value="2" <?php if(!empty($range) && $range == 2){ echo 'selected'; } ?>>This Week</option>
                        <option value="3" <?php if(!empty($range) && $range == 3){ echo 'selected'; } ?>>This Month</option>
                        <option value="4" <?php if(!empty($range) && $range == 4){ echo 'selected'; } ?>>Last Month</option>
                        <option value="5" <?php if(!empty($range) && $range == 5){ echo 'selected'; } ?>>This Year</option>
                        <option value="period" <?php if(!empty($range) && $range == 'period'){ echo 'selected'; } ?>>Custom Date</option>
                    </select>
                </div>
               
            </div>
             <div class="col-md-3">
                   <div class="period <?php if(!empty($range) && $range == 'period'){  }else{ echo 'hide'; } ?> ">
                      <div class="input-group date">
                          <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="period <?php if(!empty($range) && $range == 'period'){  }else{ echo 'hide'; } ?>">
                       <div class="input-group date">
                          <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                      </div>
                  </div>
              </div>
    
            
            <div class="form-group col-md-2 float-right">
              <button class="form-control btn-info" type="submit">Search</button>
            </div>
            </form>


            <div class="col-md-12">  

            <hr>    
            <a href="<?php echo admin_url('proposals/proposal?rel_type=proposal&rel_id='.$lead_id); ?>" class="btn btn-info mbot25"><?php echo _l('new_proposal'); ?></a>                         
                <table class="table" id="newtable">

                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Quotation #</th>
                      <th>Staff Name</th>
                      <th>Customer</th>
                      <th>Total Tax</th>                      
                      <th>date</th>
                      <th>Open Till</th>
                      <th>Date Created</th>
                      <th>Status</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                 <tbody>
                  <?php
                  $ttl_amt = 0;
                  if(!empty($quotation_list)){
                      foreach ($quotation_list as $key => $value) {
                          $ttl_amt += $value->total;
                      ?>
                      <tr>
                          <td><?php echo ++$key; ?></td>                                                
                          <td><?php echo '<a href="' . admin_url('proposals/list_proposals/' . $value->id) . '"  target="_blank" ">' . format_proposal_number($value->id) . '</a>'; ?></td>
                          <td><?php echo get_employee_name($value->addedfrom); ?></td>
                          <td><?php echo cc($value->subject); ?></td>
                          <td><?php echo $value->total_tax; ?></td>                                                               
                          <td><?php echo _d($value->date); ?></td> 
                          <td><?php echo _d($value->open_till); ?></td> 
                          <td><?php echo _d($value->datecreated); ?></td> 
                          <td><?php echo format_proposal_status($value->status); ?></td>  
                          <td><?php echo $value->total; ?></td>                      
                        </tr>
                      <?php
                      }
                 }else{
                    echo '<tr><td class="text-center" colspan="10"><h5>Record Not Found</h5></td></tr>';
                  }
                  ?>
                   
                  </tbody>
                   <tfoot>
                       <tr>
                          <td colspan="9" class="text-center"><b>Total Amount</b></td>
                          <td><b><?php echo $ttl_amt; ?></b></td>
                        </tr>
                  </tfoot>
                  </table>
              </div>


                          
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
