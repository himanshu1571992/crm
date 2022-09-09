

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

               <h4 class="bold">Master Report</h4>

            </div>

         </div>

         <?php echo master_report_tab('paymentreceipt');?>

      </div>

      

            <div class="col-md-10">

                <div class="panel_s">

                    <div class="panel-body">



                    <div class="col-md-4"><h4 class="no-margin"> </h4></div>  



                   <h4 class="no-margin"><?php echo $title; ?> <!-- <a href="<?php echo admin_url('master_report_export/export_paymentreceipt?range='.$s_range.'&f_date='.$date_a.'&t_date='.$date_b); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">Export</a> --></h4>



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

                   <div class="col-md-12 period <?php if(!empty($range) && $range == 'period'){  }else{ echo 'hide'; } ?> ">

                      <div class="input-group date">

                          <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                      </div>

                  </div>

              </div>

              <div class="col-md-3">

                  <div class="col-md-12 period <?php if(!empty($range) && $range == 'period'){  }else{ echo 'hide'; } ?>">

                       <div class="input-group date">

                          <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                      </div>

                  </div>

              </div>

    

            

            <div class="col-md-1">                            
            <button type="submit" class="btn btn-info">Search</button>
            </div>
            <div class="col-md-1">
             <a class="btn btn-danger" href="" style="margin-left: 20px;">Reset</a>
            </div>

            </form>



            <div class="col-md-12 table-responsive">  

            <hr>                             

                <table class="table" id="newtable">

                  <thead>

                    <tr>

                      <th>S.No</th>
                      <th>Payment #</th>
                      <th>Invoice #</th>
                      <th>Payment Mode</th>
                      <th>TDS %</th>
                      <th>Customer</th>
                      <th>Date</th>
                      <th>Amount</th>

                    </tr>

                  </thead>

                 <tbody>

                  <?php

                  $ttl_amt = 0;

                  if(!empty($payment_list)){

                      foreach ($payment_list as $key => $value) {



                        if($value->paymentmode == 1){

                          $payment_name = 'Cheque';

                        }elseif($value->paymentmode == 2){

                          $payment_name = 'NEFT';

                        }elseif($value->paymentmode == 3){

                          $payment_name = 'Cash';

                        }



                       // $client_id = value_by_id('tblinvoices',$value->invoiceid,'clientid');
                        $client_id = value_by_id('tblclientpayment',$value->pay_id,'client_id');

                        $ttl_amt += $value->amount;

                        if($value->paymentmethod != 2){
                              $debit_info = $this->db->query("SELECT * FROM tbldebitnote  where `number` = '".$value->debitnote_no."' ")->row();
                              $debitpayment_info = $this->db->query("SELECT * FROM tbldebitnotepayment  where `number` = '".$value->debitnote_no."' ")->row();
                        }

                      ?>

                      <tr>

                          <td><?php echo ++$key; ?></td>                                                

                          <td><?php echo '<a href="' . admin_url('payments/payment/' . $value->id) .'" target="_blank">' .'Rcpt-'.str_pad($value->id, 4, '0', STR_PAD_LEFT). '</a>'; ?></td>

                          <?php

                            if($value->paymentmethod == 2){
                              ?>
                              <td><?php echo '<a target="_blank" href="' . admin_url('invoices/download_pdf/' . $value->invoiceid) . '">' . format_invoice_number($value->invoiceid) . '</a>'; ?></td>
                              <?php
                              }else{
                                if(!empty($debit_info)){
                                  echo '<td><a target="_blank" href="' . admin_url('debit_note/download_pdf/' . $value->invoiceid) . '">' .$value->debitnote_no. '</a></td>';
                                }elseif(!empty($debitpayment_info)){
                                  echo '<td><a target="_blank" href="' . admin_url('debit_note/download_paymentpdf/' . $value->invoiceid) . '">' .$value->debitnote_no. '</a></td>';
                                }else{
                                  echo '<td>--</td>';
                                }
                              }

                            ?>

                          <td><?php echo cc($payment_name); ?></td>

                          <td><?php echo $value->tds; ?></td>

                          <td><?php echo '<a href="' . admin_url('clients/client/' . $client_id) .'" target="_blank">' .cc(client_info($client_id)->client_branch_name). '</a>'; ?></td>

                          <td><?php echo _d($value->date); ?></td>                  

                          <td><?php echo $value->amount; ?></td>

                        </tr>

                      <?php

                      }

                 }else{

                    echo '<tr><td class="text-center" colspan="8"><h5>Record Not Found</h5></td></tr>';

                  }

                  ?>

                   

                  </tbody>

                  <tfoot>

                       <tr>

                          <td colspan="7" class="text-center"><b>Total Amount</b></td>

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

