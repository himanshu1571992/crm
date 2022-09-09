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
                            <h4><?php echo $title; ?> </h4>
                        </div>
                    </div>

                    <hr class="hr-panel-heading">
                    <div class="col-md-12">
                      <?php echo form_open($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                      <div class="row">
                          <div class="form-group col-md-3">
                              <label for="vendor" class="control-label">Vendor</label>
                              <select class="form-control selectpicker" name="vendor_id" required="" id="vendor_id" onchange="get_challan()" data-live-search="true">
                                  <option value=""></option>
                                  <?php
                                  if (isset($vendor_list) && count($vendor_list) > 0) {
                                      foreach ($vendor_list as $vendor_value) {
                                  ?>
                                              <option value="<?php echo $vendor_value->id; ?>" <?php echo (isset($vendor_id) && $vendor_id == $vendor_value->id) ? 'selected' : "" ?>><?php echo cc($vendor_value->name); ?></option>
                                  <?php
                                      }
                                  }
                                  ?>
                              </select>
                          </div>
                          <div class="form-group col-md-3" app-field-wrapper="date">
                              <label for="date" class="control-label">From Date</label>
                              <div class="input-group date">
                                  <input id="date" name="f_date" class="form-control datepicker" value="<?php echo (isset($f_date) && !empty($f_date)) ? $f_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                              </div>
                          </div>
                          <div class="form-group col-md-3" app-field-wrapper="date">
                              <label for="date" class="control-label">To Date</label>
                              <div class="input-group date">
                                  <input id="date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_date) && !empty($s_date)) ? $s_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
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
                            <div class="table-responsive">
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                          <th align="center">Sr.No</th>
                                          <th align="center">Product Name</th>
                                          <th align="center">Po. No</th>
                                          <th align="center">Po. Date</th>
                                          <th align="center">Po Qty</th>
                                          <th align="center">Invoice No</th>
                                          <th align="center">Invoice Date</th>
                                          <th align="center">Invoice Qty</th>
                                          <th align="center">Diff Qty</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 0;
                                            if (!empty($po_report)){
                                                foreach ($po_report as $key => $value) {
                                                  $isOtherCharge = value_by_id("tblproducts", $value->product_id,"isOtherCharge");

                                                  if ($isOtherCharge == 0){
                                                     $invoice_info = $this->db->query("SELECT i.id, i.date, pro.qty FROM `tblpurchaseinvoice` as i RIGHT JOIN `tblpurchaseinvoiceproduct` as pro ON i.id = pro.invoice_id WHERE i.vendor_id = ".$vendor_id." and i.po_id = ".$value->id." and pro.product_id = ".$value->product_id." ")->row();
                                                     $invoice_qty = (!empty($invoice_info)) ? $invoice_info->qty: 0;
                                                     $invoice_date = (!empty($invoice_info)) ? _d($invoice_info->date): '--';
                                                     $diff_qty = $value->qty-$invoice_qty;
                                        ?>
                                                  <tr>
                                                      <td align="center"><?php echo ++$i; ?></td>
                                                      <td align="center"><?php echo value_by_id("tblproducts", $value->product_id, "name"); ?></td>
                                                      <td align="center"><a href="<?php echo admin_url('purchase/download_pdf/'.$value->id); ?>" target="_blank" ><?php echo $value->number; ?></a></td>
                                                      <td align="center"><?php echo _d($value->date); ?></td>
                                                      <td align="center"><?php echo $value->qty; ?></td>
                                                      <td align="center">
                                                        <?php
                                                            if (!empty($invoice_info)){
                                                              $ipdf = admin_url("purchase/purchase_invoice_pdf/".$invoice_info->id);
                                                              echo '<a target="_blank" href="'.$ipdf.'">Inv-'.str_pad($invoice_info->id, 4, '0', STR_PAD_LEFT).'</a>';
                                                            }else{
                                                               echo '--';
                                                            }
                                                       ?>
                                                      </td>
                                                      <td align="center"><?php echo $invoice_date; ?></td>
                                                      <td align="center"><?php echo $invoice_qty; ?></td>
                                                      <td align="center"><?php echo $diff_qty; ?></td>
                                                  </tr>
                                        <?php
                                                  }
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]
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
