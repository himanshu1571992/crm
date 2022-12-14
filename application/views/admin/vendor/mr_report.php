
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

?>
<div id="wrapper" class="customer_profile">
<div class="content">
   <div class="row">
      <div class="col-md-2">
         <div class="panel_s mbot5">
            <div class="panel-body padding-10">
               <h4 class="bold"><?php echo $vendor_info->name; ?></h4>
            </div>
         </div>
         <?php echo vendor_report_tab('mr',$vendor_info->id);?>
      </div>
      
            <div class="col-md-10">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="col-md-4"><h4 class="no-margin"> </h4></div>  

                   <h4 class="no-margin"><?php echo $title; ?> </h4>

          <hr class="hr-panel-heading">
          
          <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="">
              
             <div class="col-md-3">
                <div class="form-group select-placeholder">
                    <select class="selectpicker" name="range" id="range" data-width="100%" required="" onchange="render_customer_statement();">
                        <option value="" ></option>
                        <option value="1" <?php if(!empty($range) && $range == 1){ echo 'selected'; } ?>>Today</option>
                        <option value="2" <?php if(!empty($range) && $range == 2){ echo 'selected'; } ?>>This Week</option>
                        <option value="3" <?php if(!empty($range) && $range == 3){ echo 'selected'; } ?>>This Month</option>
                        <option value="4" <?php if(!empty($range) && $range == 4){ echo 'selected'; } ?>>Last Month</option>
                        <option value="5" <?php if(!empty($range) && $range == 5){ echo 'selected'; } ?>>This Year</option>
                        <option value="period" <?php if(!empty($range) && $range == 'period'){ echo 'selected'; } ?>>Custom date</option>
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
                <table class="table" id="newtable">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>MR Number</th>
                      <th>Staff Name</th>
                      <th>MR Type</th>
                      <th>PO Number</th>   
                      <th>Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                 <tbody>
                  <?php
                  if(!empty($materialreceipt_list)){
                    $z=1;
                    foreach($materialreceipt_list as $row){ 

                      if($row->status == 0){
                        $status = 'Pending';
                        $cls = 'btn-warning';
                      }elseif($row->status == 1){
                        $status = 'Approved';
                        $cls = 'btn-success';
                      }elseif($row->status == 2){
                        $status = 'Rejected';
                        $cls = 'btn-danger';
                      }

                      $po_number = '--';
                      if($row->po_id > 0){
                        $purchase_info = $this->db->query("SELECT * from tblpurchaseorder where id = '".$row->po_id."' ")->row(); 
                        $po_number = 'PO-'.$purchase_info->number;
                      }

                      if($row->mr_for == 1){
                        $type = 'Against PO';
                      }elseif($row->mr_for == 2){
                        $type = 'Cash';
                      }elseif($row->mr_for == 3){
                        $type = 'GAS';
                      }elseif($row->mr_for == 4){
                        $type = 'Delivery Challan';
                      }

                      
                      ?>                                            
                      <tr>
                        <td><?php echo $z++;?></td>
                        <td><a class="btn btn-info" target="_blank" href="<?php  echo admin_url('purchase/mr_details/'.$row->id); ?>"><?php echo 'MR-'.$row->id;?></a></td>
                        <td><?php echo get_employee_name($row->staff_id); ?></td>
                        <td><?php echo $type;?></td>                        
                        <td><?php echo $po_number;?></td>                       
                        <td><?php echo date('d/m/Y',strtotime($row->date)); ?></td>
                        <td><?php echo '<button type="button" class="btn '.$cls.' btn-sm status" value="'.$row->id.'" data-toggle="modal" data-target="#statusModal">'.$status.'</button>'; ?></td>
                      </tr>
                      <?php
                    }
                  }else{
                    echo '<tr><td class="text-center" colspan="7"><h5>Record Not Found</h5></td></tr>';
                  }
                  ?>
                    
                   
                  </tbody>
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

<!-- Modal -->
<div id="statusModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Material Receipt Status</h4>
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
</html>


<script type="text/javascript">
  $('.status').click(function(){
  var id = $(this).val();
    $.ajax({
      type    : "POST",
      url     : "<?php echo base_url('admin/purchase/get_mr_status'); ?>",
      data    : {'id' : id},
      success : function(response){
        if(response != ''){
          $("#approval_html").html(response);
        }
      }
    })
  });
</script> 