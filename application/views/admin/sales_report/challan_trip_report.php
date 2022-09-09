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
                          <div class="form-group col-md-3">
                              <label for="vendor" class="control-label">Vehicle Type</label>
                              <select class="form-control selectpicker" name="vehicle_type" id="vehicle_type" data-live-search="true">
                                  <option value=""></option>
                                  <option value="1" <?php echo (isset($vehicle_type) && $vehicle_type == 1) ? 'selected':''; ?>>Company Vehicle</option>
                                  <option value="2" <?php echo (isset($vehicle_type) && $vehicle_type == 2) ? 'selected':''; ?>>Out Side Vehicle</option>
                                  <option value="3" <?php echo (isset($vehicle_type) && $vehicle_type == 3) ? 'selected':''; ?>>Client Vehicle</option>
                                  <option value="4" <?php echo (isset($vehicle_type) && $vehicle_type == 4) ? 'selected':''; ?>>Logistic</option>
                              </select>
                          </div>
                          <div class="col-md-2">
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
                                          <th align="center">Trip ID</th>
                                          <th align="center">Date</th>
                                          <th align="center">Vehicle Type</th>
                                          <th align="center">Total Challan</th>
                                          <th align="center">Client Received</th>
                                          <th align="center">Estimate Cost</th>
                                          <th align="center">Actual Cost (exp)</th>
                                          <th align="center">Income</th>
                                          <th align="center">Difference Amount</th>
                                          <th align="center">Approved Status</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 0;
                                            if (!empty($challan_trip_list)){
                                                foreach ($challan_trip_list as $key => $value) {
                                                    $ttlchallan = ($value->challan_ids) ? explode(',',$value->challan_ids) : [];
                                                    $approved_status = "<span class='btn-sm btn-warning'>Pending<span>";
                                                    if($value->vehicle_type == 1 || $value->vehicle_type == 3){
                                                       $approved_status = "<span class='btn-sm btn-success'>Approved<span>";
                                                    }else{
                                                       $triprequest = value_by_id('tblchallantriprequest', $value->id, 'approve_status');
                                                       if ($triprequest == 1){
                                                          $approved_status = "<span class='btn-sm btn-success'>Approved<span>";
                                                       }else if($triprequest == 2){
                                                          $approved_status = "<span class='btn-sm btn-danger'>Rejected<span>";
                                                       }
                                                    }
                                                    $thtml = "";
                                                    $totalamt = 0;
                                                    if (!empty($ttlchallan)){
                                                       $challan_process = $this->db->query("SELECT `chalan_id`, `for` FROM `tblchallanprocess` WHERE id IN (".$value->challan_ids.") ")->result();
                                                       if (!empty($challan_process)){
                                                          $c = 0;
                                                          foreach ($challan_process as $key => $val) {
                                                             $challan_no = value_by_id("tblchalanmst", $val->chalan_id, "chalanno");
                                                             $clientid = value_by_id_empty("tblchalanmst", $val->chalan_id, "clientid");
                                                             $client_name = '--';
                                                             if(!empty($clientid) && $clientid > 0){
                                                               $client_name = client_info($clientid)->client_branch_name;
                                                             }
                                                             $challanfor = ($val->for ==1) ? "<span class='label label-danger'>Delivery</span>":"<span class='label label-success'>Pickup</span>";
                                                             $challan_no = "<a target='_blank' href='".admin_url('Chalan/pdf/'.$val->chalan_id)."'>".$challan_no."</a>";
                                                             $freight_recd  = 0;
                                                             $products = $this->db->query("SELECT items.pro_id, items.qty, items.rate, items.prodtax FROM `tblinvoices` as i RIGHT JOIN `tblitems_in` as items ON i.id = items.rel_id and items.rel_type = 'invoice' WHERE i.challan_id ='".$val->chalan_id."' ")->result();
                                                             if (!empty($products)){
                                                                foreach ($products as $pro) {
                                                                   $is_freight = value_by_id("tblproducts", $pro->pro_id,"is_freight");
                                                                   if ($is_freight == 1){
                                                                     $tax = (($pro->qty*$pro->rate)*$pro->prodtax)/100;
                                                                     $freight_recd  = ($pro->qty*$pro->rate)+$tax;
                                                                     $totalamt += ($pro->qty*$pro->rate)+$tax;
                                                                   }
                                                                }
                                                             }
                                                             $thtml .= "<tr><td>".++$c."</td><td>".$client_name."</td><td>".$challan_no."</td><td>".$challanfor."</td><td>".number_format($freight_recd, 2, '.', ',')."</td></tr>";
                                                          }
                                                       }
                                                    }
                                                    $vehicletype = '--';
                                                    if ($value->vehicle_type == 1){
                                                       $vehicletype = 'Company Vehicle';
                                                    }else if($value->vehicle_type == 2){
                                                       $vehicletype = 'Out Side Vehicle';
                                                    }else if($value->vehicle_type == 3){
                                                       $vehicletype = 'Client Vehicle';
                                                    }else if($value->vehicle_type == 4){
                                                       $vehicletype = 'Logistic';
                                                    }
                                                    $ttlactualcost = $this->db->query("SELECT COALESCE(SUM(amount),0) as ttl_amt FROM `tblrequests` where `approved_status` = 1 and `trip_id` = '".$value->id."'")->row()->ttl_amt;
                                        ?>
                                                  <tr>
                                                      <td align="center"><?php echo ++$i; ?></td>
                                                      <td align="center"><?php echo 'TRP-'.str_pad($value->id, 4, '0', STR_PAD_LEFT); ?></td>
                                                      <td align="center"><?php echo _d($value->date); ?></td>
                                                      <td align="center">
                                                          <button  class="<?php echo ($value->vehicle_type == 3 || $value->vehicle_type == 2) ? 'vehicle_details' : '' ?> btn-sm btn-info" data-id="<?php echo $value->id; ?>"><?php echo $vehicletype; ?></button>
                                                        </td>
                                                      <td align="center">
                                                        <?php if (!empty($ttlchallan)){ ?>
                                                        <a href="javascript:void(0);" class="btn-sm btn-info" data-target="#challandetails<?php echo $value->id; ?>" id="status" data-toggle="modal"><?php echo count($ttlchallan); ?></a>
                                                        <div id="challandetails<?php echo $value->id; ?>" class="modal fade" role="dialog">
                                                            <div class="modal-dialog modal-lg">
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title pull-left" style="color:#fff;">Challan Detals</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                          <div class="col-md-12">
                                                                             <div class="table-responsive">
                                                                                <table class="table">
                                                                                  <thead>
                                                                                    <th align="center">S.No</th>
                                                                                    <th align="center">Client Name</th>
                                                                                    <th align="center">Challan No</th>
                                                                                    <th align="center">Type</th>
                                                                                    <th align="center">Freight Received</th>
                                                                                  </thead>
                                                                                  <tbody>
                                                                                      <?php echo $thtml; ?>
                                                                                  </tbody>
                                                                                </table>
                                                                             </div>
                                                                          </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                      <?php }else{
                                                          echo "<span class='btn-sm btn-info'>".count($ttlchallan)."</span>";
                                                      } ?>
                                                      </td>
                                                      <td align="center"><?php echo number_format($totalamt, 2, '.', ','); ?></td>
                                                      <td align="center"><?php echo number_format($value->approved_amt, 2, '.', ','); ?></td>
                                                      <td align="center"><?php echo number_format($ttlactualcost, 2, '.', ','); ?></td>
                                                      <td align="center"><?php echo number_format($value->extra_income, 2, '.', ','); ?></td>
                                                      <td align="center"><?php echo number_format($totalamt-$ttlactualcost, 2, '.', ','); ?></td>
                                                      <td align="center"><?php echo $approved_status; ?></td>
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
<div id="vehicleDetails" class="modal fade" role="dialog">
    <div class="modal-dialog">

        Vehicle Details
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Vehicle Details</h4>
            </div>
            <div class="modal-body" id="vehicle_details_div">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
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

<script type="text/javascript">
    $('.vehicle_details').click(function () {
        
        $('#vehicleDetails').modal('show'); 
        var trip_id = $(this).data("id");

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/sales_report/get_vehicle_details'); ?>",
            data: {'trip_id': trip_id},
            success: function (response) {
                if (response != '') {
                    $("#vehicle_details_div").html(response);
                }
            }
        })
    });
</script>
</body>
</html>
