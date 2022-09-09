
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
                                <div class="row">
                                    <?php echo form_open($this->uri->uri_string(), array('id' => 'search-form', 'class' => 'search_data_form')); ?>
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <div class="form-group" app-field-wrapper="date">
                                                    <label for="f_date" class="control-label">From Date</label>
                                                    <div class="input-group date">
                                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (!empty($f_date)) ? $f_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group" app-field-wrapper="date">
                                                    <label for="t_date" class="control-label">To Date</label>
                                                    <div class="input-group date">
                                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (!empty($t_date)) ? $t_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="input-group" style="margin-top: 30px;">
                                                    <button type="submit" class="btn btn-info">Search</button>
                                                    <a class="btn btn-danger" href="">Reset</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close(); ?>
                                </div>
                              <!-- <div class="row1">
                                  <fieldset class="scheduler-border"><br>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 style="color: red; text-align: center;" class="control-label">Counts</h4>
                                                <p style="color: red; text-align: center;"><?php echo number_format((count($invoice_list)), 2); ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 style="color: red; text-align: center;" class="control-label">Total Freight Amount</h4>
                                                <p id="show_total" style="color: red; text-align: center;"></p>
                                            </div>
                                        </div>
                                    </div>
                                  </fieldset>
                              </div> -->

                              <hr>
                              <div class="table-responsive">
                                  <table class="table" id="newtable">
                                  <thead>
                                    <tr>
                                      <th width="1%">S.No</th>
                                      <th>Type</th>
                                      <th>Category</th>
                                      <th>Date</th>
                                      <th>Amount</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                        $i = 1;
                                        if(!empty($paidthroughsystem_list)){
                                            foreach ($paidthroughsystem_list as $value) {
                                    ?>
                                              <tr>
                                                  <td><?php echo $i++; ?></td>
                                                  <td><span class="label label-success">System</span></td>
                                                  <td><?php echo cc($value->name); ?></td>
                                                  <td><?php echo _d($value->date); ?></td>
                                                  <td><?php echo number_format($value->amount, '2', ".",","); ?></td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                        if (!empty($paidworkadvanced_list)){
                                            foreach ($paidworkadvanced_list as $value) {
                                                
                                                $headname = cc(value_by_id('tblheads',$value->head_id,'name'));
                                    ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><span class="label label-info">Work Advance</span></td>
                                                    <td><?php echo $headname; ?></td>
                                                    <td><?php echo date("d/m/Y", strtotime($value->created_at)); ?></td>
                                                    <td><?php echo number_format($value->amount, '2', ".",","); ?></td>
                                                  </tr>
                                    <?php            
                                            }
                                        }
                                        if (!empty($transport_overhead_list)){
                                            foreach ($transport_overhead_list as $value) {
                                    ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><span class="label label-warning">Overhead</span></td>
                                                    <td><?php echo cc($value->head); ?></td>
                                                    <td><?php echo _d($value->date); ?></td>
                                                    <td><?php echo number_format($value->amount, '2', ".",","); ?></td>
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

        "iDisplayLength": 25,
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

        "iDisplayLength": 25,
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
    var a = document.getElementById("ttl_freight_amount").value;

    $('#show_total').html(a);
</script>
</body>
</html>
