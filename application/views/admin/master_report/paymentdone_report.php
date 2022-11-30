

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

         <?php echo master_report_tab('paymentdone');?>

      </div>

      

            <div class="col-md-10">

                <div class="panel_s">

                    <div class="panel-body">



                    <div class="col-md-4"><h4 class="no-margin"> </h4></div>  



                   <h4 class="no-margin"><?php echo $title; ?> <!-- <a href="<?php echo admin_url('master_report_export/export_paymentdone?range='.$s_range.'&f_date='.$date_a.'&t_date='.$date_b.'&staff_id='.$staff); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">Export</a> --></h4>



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

    

            

            <div class="col-md-2">                            
              <button type="submit" class="btn btn-info">Search</button>
              <a class="btn btn-danger" href="" style="margin-left: 20px;">Reset</a>
            </div>

            </form>



            <div class="col-md-12 table-responsive">  

            <hr>                             

                <table class="table" id="newtable">

                  <thead>

                    <tr>

                      <th>S.No</th>

                      <th>Staff Name</th>

                      <th>Vendor</th>

                      <th>On Behalf</th>

                      <th>Payment Mode</th>

                      <th>Reference No.</th>

                      <th>Date</th>                      

                      <th>View</th>

                      <th>Amount</th>

                    </tr>

                  </thead>

                 <tbody>

                  <?php

                  $ttl_amt = 0;

                  if(!empty($payment_list)){

                      foreach ($payment_list as $key => $value) {

                        

                        if($value->payment_mode == 1){

                          $payment_name = 'Cheque';

                        }elseif($value->payment_mode == 2){

                          $payment_name = 'NEFT';

                        }elseif($value->payment_mode == 3){

                          $payment_name = 'Cash';

                        }



                        if($value->payment_behalf == 1){

                          $payment_behalf = 'On Account';

                        }elseif($value->payment_behalf == 2){

                          $payment_behalf = 'Against Invoice';

                        }

                        $ttl_amt += $value->ttl_amt;

                      ?>

                      <tr>

                        <td><?php echo ++$key; ?></td>

                        <td><?php echo cc(get_employee_name($value->staff_id)); ?></td>

                        <td><a href="<?php echo admin_url('vendor/vendor/'.$value->vendor_id);?>" target="_blank"><?php echo cc(value_by_id('tblvendor',$value->vendor_id,'name')); ?></a></td>

                        <td><?php echo cc($payment_behalf); ?></td>

                        <td><?php echo cc($payment_name); ?></td>

                        <td><?php echo $value->reference_no; ?></td>

                        <td><?php echo _d($value->date); ?></td>                         

                         <td class="text-center">                          

                            <a target="_blank" href="<?php echo admin_url('purchase_payments/payment_details/' . $value->id); ?>">View</a>

                        </td> 

                        <td><?php echo $value->ttl_amt; ?></td>  

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



</body>

</html>

