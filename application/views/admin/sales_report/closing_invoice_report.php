
<?php init_head();



?>
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />

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
                            <h4><?php echo $title; ?> </h4>
                        </div>
                    </div>

                    <hr class="hr-panel-heading">
                    <div class="col-md-12">
                      <div class="row">
                          <div class="col-md-12">
                              <?php
                              if(is_admin() == 1){

                              ?>
                              <div class="row1">
                                  <fieldset class="scheduler-border"><br>
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <h4 style="color: red; text-align: center;" class="control-label">Total Taxable Value</h4>
                                                <p style="color: red; text-align: center;"><?php echo number_format(($invoice_amount-$taxable_value), 2); ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <h4 style="color: red; text-align: center;" class="control-label">Total SGST</h4>
                                                <p id="sgst_tot" style="color: red; text-align: center;"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <h4 style="color: red; text-align: center;" class="control-label">Total CGST</h4>
                                                <p id="cgst_tot" style="color: red; text-align: center;"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <h4 style="color: red; text-align: center;" class="control-label">Total IGST</h4>
                                                <p id="igst_tot" style="color: red; text-align: center;"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <h4 style="color: red; text-align: center;" class="control-label">Total Amount</h4>
                                                <p style="color: red; text-align: center;"><?php echo number_format($invoice_amount, 2); ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <h4 style="color: red; text-align: center;" class="control-label">Total Count</h4>
                                                <p style="color: red; text-align: center;"><?php echo count($invoice_report); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                  </fieldset>
                              </div>
                              <?php
                              }
                              ?>

                              <hr>
                              <div class="table-responsive">
                                  <table class="table" id="newtable">
                                  <thead>
                                    <tr>
                                      <th>S.No</th>
                                      <th>Invoice #</th>
                                      <th>Client Name</th>
                                      <th>Invoice Date</th>
                                      <th>Site Name</th>
                                      <th>Amount</th>
                                      <th class="text-center">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      $sum= 0.00;
                                      $cgst_sum= 0.00;
                                      $igst_sum= 0.00;
                                      if(!empty($invoice_report)){

                                          foreach ($invoice_report as $key => $value) {

                                                  if($value->tax_type == 1){
                                                      $tax = ($value->total_tax/2);
                                                      $sgst = number_format($tax, 2, '.', '');
                                                      $sum += $sgst;
                                                      $cgst = number_format($tax, 2, '.', '');
                                                      $cgst_sum += $cgst;
                                                  }else{
                                                      $igst = $value->total_tax;
                                                      $igst_sum += $igst;
                                                  }
                                                  $person_info = invoice_contact_person($value->id);
                                                  $client_info = $this->db->query("SELECT `client_branch_name` from `tblclientbranch` where userid = '".$value->clientid."'  ")->row();
                                                  $site_name = value_by_id("tblsitemanager", $value->site_id, "name");
                                              ?>
                                              <tr>
                                                  <td><?php echo ++$key; ?></td>
                                                  <td><?php echo '<a href="' . admin_url('invoices/download_pdf/' . $value->id . '/?output_type=1') . '" target="_blank">' .format_invoice_number($value->id). '</a>'; ?></td>
                                                  <td><a href="<?php echo admin_url('clients/client/'.$value->clientid);?>" target="_blank"><?php echo cc($client_info->client_branch_name); ?></a></td>
                                                  <td><?php echo _d($value->invoice_date); ?></td>
                                                  <td><?php echo $site_name; ?></td>
                                                  <td><?php echo $value->total; ?></td>
                                                  <td class="text-center">
                                                      <a href="<?php echo admin_url('sales_report/rent_details/'.$value->id); ?>" target="_blank" class="btn-sm btn-primary">Details</a>
                                                  </td>
                                                </tr>
                                              <?php
                                          } ?>

                                      <?php }
                                      ?>
                                      <input type="hidden" name="" id="sgst_id" value="<?php echo $sum; ?>">
                                      <input type="hidden" name="" id="cgst_id" value="<?php echo $cgst_sum; ?>">
                                      <input type="hidden" name="" id="igst_id" value="<?php echo $igst_sum; ?>">
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
    $('#newtable1').DataTable( {

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
    var a = document.getElementById("sgst_id").value;

    $('#sgst_tot').html(a);
//    $('#sgst_tot').html('Total SGST :  '+a);

    var b = document.getElementById("cgst_id").value;
    $('#cgst_tot').html(b);
//    $('#cgst_tot').html('Total CGST :  '+b);

    var c = document.getElementById("igst_id").value;
    $('#igst_tot').html(c);
//    $('#igst_tot').html('Total IGST :  '+c);
</script>
</body>
</html>
