<?php init_head(); ?>

<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />
<!-- <link href="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">

<style>
    fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">


            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4>Rent Invoice Report </h4>
                        </div>
                    </div>

                    <hr class="hr-panel-heading">
                    <div class="col-md-12">
                      <?php echo form_open($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                      <div class="row">
                          <div class="form-group col-md-4" app-field-wrapper="date">
                              <label for="date" class="control-label">From Date</label>
                              <div class="input-group date">
                                  <input id="date" required name="from_date" class="form-control datepicker2" value="<?php echo (isset($f_date) && !empty($f_date)) ? $f_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                              </div>
                          </div>
                          <div class="form-group col-md-4" app-field-wrapper="date">
                              <label for="date" class="control-label">To Date</label>
                              <div class="input-group date">
                                  <input id="date" required name="to_date" class="form-control datepicker2" value="<?php echo (isset($s_date) && !empty($s_date)) ? $s_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <input type="hidden" name="section" value="1">
                              <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                              <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                          </div>
                      </div>
                      <?php echo form_close(); ?>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="col-md-8">
                                  <canvas id="myChart" style="width:100%;max-width:100%;"></canvas>
                              </div>
                              <div class="col-md-4">
                                  <div class="col-md-12" style="margin-top:30%">
                                       <p ><span style="height: 15px;width: 15px;border-radius: 50%;background-color: #008000;display: inline-block;"></span>&nbsp;&nbsp;<span >Opening Amount</span></p>
                                  </div>
                                  <div class="col-md-12">
                                       <p><span style="height: 15px;width: 15px;border-radius: 50%;background-color: #ff0000;display: inline-block;"></span>&nbsp;&nbsp;<span >Closing Amount</span></p>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table" id="newtable1">
                                    <thead>
                                      <tr>
                                        <th align="center">Month-Year</th>
                                        <th align="center">Openings</th>
                                        <th align="center">Total Opening</th>
                                        <th align="center">Closings</th>
                                        <th align="center">Total Closing</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $opening_amt = '';
                                            $closing_amt = '';
                                            if (!empty($month_list)){
                                                foreach ($month_list as $key => $value) {
                                                  // echo $key;
                                                  $month = date("m", strtotime($value));
                                                  $year = date("Y", strtotime($value));
                                                  $openings = getInvoiceOpening("amount", $month, $year);
                                                  $opening_amt .= ($key==0) ? $openings : ','.$openings;
                                                  $closing = getInvoiceClosing("amount", $month, $year);
                                                  $closing_amt .= ($key==0) ? $closing : ','.$closing;
                                        ?>
                                                  <tr>
                                                      <td align="center"><?php echo date("M-Y", strtotime($value)); ?></td>
                                                      <td align="center"><?php echo $openings; ?></td>
                                                      <td align="center"><a target="_blank" href="<?php echo admin_url('sales_report/opening_rent_invoice/'.$month.'/'.$year);?>" class="btn-sm btn-info"><?php echo getInvoiceOpening("count", $month, $year); ?></a></td>
                                                      <td align="center"><?php echo $closing; ?></td>
                                                      <td align="center"><a target="_blank" href="<?php echo admin_url('sales_report/closing_rent_invoice/'.$month.'/'.$year);?>" class="btn-sm btn-info"><?php echo getInvoiceClosing("count", $month, $year); ?></a></td>
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

						 <!-- <div class="btn-bottom-toolbar text-right">
								<button class="btn btn-info" value="1" name="mark" type="submit">
									<?php echo _l('submit'); ?>
								</button>
							</div> -->

                    </div>
                </div>


        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>

<?php init_tail(); ?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
<!-- <script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="<?php  echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
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
     <script type="text/javascript" src="http://cdn.rawgit.com/bassjobsen/Bootstrap-3-Typeahead/master/bootstrap3-typeahead.min.js"></script>

<script>
     // var xValues = ['Jan-21','Feb-21','March-21','April-21','May-21','June-21','July-21','Aug-21','Sep-21','Oct-21'];
     var xValues =  [<?php echo $yearmonth;?>] ;
     var openingamt = "<?php echo $closing_amt;?>";
     var closingamt = "<?php echo $closing_amt;?>";
     if (openingamt !='' && closingamt !=''){
       new Chart("myChart", {
         type: "line",
         data: {
           labels: xValues,
           datasets: [{
             data: [<?php echo $closing_amt;?>],
             borderColor: "red",
             fill: false
           }, {
             data: [<?php echo $opening_amt;?>],
             borderColor: "green",
             fill: false
           }]
         },
         options: {
           legend: {display: false}
         }
       });
     }

</script>
<script>

$(document).ready(function() {
    $('#newtable').DataTable( {

        "iDisplayLength": 15,
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
            'pageLength',
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            'colvis',
        ]
    } );
} );
</script>
<script type="text/javascript">
$(".datepicker2").datepicker( {
  format: "yyyy-mm",
  startView: "months",
  minViewMode: "months"
});
</script>
</body>
</html>
