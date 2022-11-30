

<?php init_head(); ?>

<?php

$s_range = '';

$date_a = '';

$date_b = '';

$staff = '';



if(!empty($range)){

  $s_range = $range;

}

if(!empty($f_date)){

  $date_a = $f_date;

}

if(!empty($t_date)){

  $date_b = $t_date;

}

if(!empty($staff_id)){

  $staff = $staff_id;

}

?>

<div id="wrapper" class="customer_profile">

<div class="content">

   <div class="row">

      <div class="col-md-2">

         <div class="panel_s mbot5">

            <div class="panel-body padding-10">

               <h4 class="bold">Master Report</h4>

            </div>

         </div>

         <?php echo master_report_tab('purchaseorder');?>

      </div>

      

            <div class="col-md-10">

                <div class="panel_s">

                    <div class="panel-body">



                    <div class="col-md-4"><h4 class="no-margin"> </h4></div>  



                   <h4 class="no-margin"><?php echo $title; ?> <!-- <a href="<?php echo admin_url('master_report_export/export_purchaseorder?range='.$s_range.'&f_date='.$date_a.'&t_date='.$date_b.'&staff_id='.$staff); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">Export</a> --></h4>



          <hr class="hr-panel-heading">

          

          <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="">

             <div class="form-group col-md-3">

                  <select class="form-control selectpicker" id="staff_id" name="staff_id" data-live-search="true">

                      <option value="" selected >--Select Employee-</option>

                      <?php

                      if(!empty($staff_list)){

                          foreach($staff_list as $staff){

                              ?>

                              <option value="<?php echo $staff->staffid;?>" <?php if(!empty($staff_id) && $staff_id == $staff->staffid){ echo 'selected'; } ?>><?php echo cc($staff->firstname); ?></option>

                              <?php

                          }

                      }

                      ?>

                  </select>

              </div>

             <div class="col-md-2">

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

             <div class="col-md-2">

                   <div class="period <?php if(!empty($range) && $range == 'period'){  }else{ echo 'hide'; } ?> ">

                      <div class="input-group date">

                          <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                      </div>

                  </div>

              </div>

              <div class="col-md-2">

                  <div class="period <?php if(!empty($range) && $range == 'period'){  }else{ echo 'hide'; } ?>">

                       <div class="input-group date">

                          <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                      </div>

                  </div>

              </div>

    

            

            <div class="col-md-1">                            
              <button type="submit" class="btn btn-info">Search</button>
              <a class="btn btn-danger" href="" style="margin-left: 20px;">Reset</a>
            </div>

            </form>



            <div class="col-md-12 table-responsive">  

            <hr>                             

                <table class="table" id="newtable">

                  <thead>

                    <tr>

                      <th>S.No.</th>

                      <th>Number</th>

                      <th>Staff Name</th>

                      <th>Vendor</th>

                      <th>Warehouse</th>

                      <th>Date</th>                      

                      <th>Material</th>                      

                      <th>Status</th>

                      <th>Total Amount</th>

                    </tr>

                  </thead>

                 <tbody>

                  <?php

                  $ttl_amt = 0;

                  if(!empty($purchaseorder_list)){

                    $z=1;

                    foreach($purchaseorder_list as $row){ 



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



                      if($row->complete == 1){

                        $mr_status = '<sapn class="alert-success">Received</span>';

                      }else{

                        $mr_status = '<span class="alert-danger">Not Received</span>';

                      }



                      $can_edit = $this->db->query("SELECT * from tblpurchaseorderapproval where po_id = '".$row->id."' and (approve_status = 1 || approve_status = 2) ")->row_array();



                      $ttl_amt += $row->totalamount;

                      ?>                                            

                      <tr>

                        <td><?php echo $z++;?></td>

                        <td><?php echo 'PO-'.$row->number;?></td>

                        <td><?php echo cc(get_employee_name($row->staff_id)); ?></td>

                        <td><?php echo cc(value_by_id('tblvendor',$row->vendor_id,'name'));?></td>

                        <td><?php echo cc(value_by_id('tblwarehouse',$row->warehouse_id,'name'));?></td>

                        <td><?php echo date('d/m/Y',strtotime($row->date)); ?></td> 

                        <td><?php echo $mr_status; ?></td>                       

                        <td>

                          <?php

                          if($row->cancel == 1){

                            echo '<button disabled class="btn btn-danger">Cancelled</button>';

                          }else{

                            echo '<button type="button" class="btn '.$cls.' btn-sm status" value="'.$row->id.'" data-toggle="modal" data-target="#myModal">'.$status.'</button>';

                            

                          }

                          ?>

                        </td> 

                        <td><?php echo $row->totalamount;?></td>

                        

                        

                      </tr>

                      <?php

                    }

                  }else{

                    echo '<tr><td class="text-center" colspan="9"><h5>Record Not Found</h5></td></tr>';

                  }

                  ?>

                    

                   

                  </tbody>

                  <tfoot>

                       <tr>

                          <td colspan="8" class="text-center"><b>Total Amount</b></td>

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



<div id="myModal" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Assigned Person</h4>

      </div>

      <div class="modal-body">

        <div id="approval_html"></div>

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

  var po_id = $(this).val();

  

    $.ajax({

      type    : "POST",

      url     : "<?php echo base_url('admin/purchase/get_approval_info'); ?>",

      data    : {'po_id' : po_id},

      success : function(response){

        if(response != ''){

          $("#approval_html").html(response);

        }

      }

    })

  });

</script> 