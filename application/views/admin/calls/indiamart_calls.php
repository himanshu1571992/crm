<?php init_head(); ?>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />


<style type="text/css">
    .popover{
        max-width:600px;
    }
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo site_url($this->uri->uri_string()); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12"><h4 class="no-margin"><?php echo $title; ?> </h4></div>
                            </div>	                   

                            <hr class="hr-panel-heading">

                            <div class="row">

                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" required="" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" required="" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

                                <div class="col-md-1">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                </div>
                                <div class="col-md-1">
                                    <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                </div>


                                <div class="col-md-12 table-responsive">																
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Enquiry Type</th>
                                                <th>Date</th>
                                                <th>Customer Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($indiamart_list)) {
                                                foreach ($indiamart_list as $k => $row) {
                                                    $mobile_number = (!empty($row->mobile)) ? substr($row->mobile, -10) : "";

                                                        $source_type = "--";
                                                        if ($row->source_type == "W"){
                                                            $source_type = "Direct";
                                                        }elseif ($row->source_type == "B") {
                                                            $source_type = "Consumed BuyLead";
                                                        }elseif ($row->source_type == "P") {
                                                            $source_type = "Call";
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ++$k; ?></td>
                                                        <td><?php echo $source_type; ?></td>
                                                        <td><?php echo _d($row->date_time); ?></td>
                                                        <td><?php echo $row->customer_name; ?></td>
                                                        <td><?php echo (!empty($row->email)) ? $row->email : '--'; ?></td>
                                                        <td><?php echo $mobile_number; ?></td>
                                                        <td><?php echo (!empty($row->address)) ? $row->address : '--'; ?></td>
                                                        <td><?php echo (!empty($row->city)) ? $row->city : '--'; ?></td>
                                                        <td><?php echo (!empty($row->state)) ? $row->state : '--'; ?></td>
                                                        <td class="text-center">
                                                            <?php echo '<a class="make_call" val="'.$mobile_number.'" data-toggle="modal" data-target="#myModal" href="#">Call Back</a>'; ?>&nbsp;
                                                            <a href="javascript:void(0);" class="label label-info indiamartdetails" data-id="<?php echo $row->id; ?>" data-toggle="modal" data-target="#call_details"><i class="fa fa-eye"></i></a>
                                                        </td>
                                                     
                                                    </tr>    
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="btn-bottom-toolbar text-right">
                            </div>

                            <!-- Tracks used in this music/audio player application are free to use. I downloaded them from Soundcloud and NCS websites. I am not the owner of these tracks. -->
                        </div>
                    </div>
                </div>
            </form>
        </div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>


<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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

    $(document).ready(function () {
        $('#newtable').DataTable({
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Calling Numbers</h4>
      </div>
       <form  action="<?php echo admin_url('leads/make_call'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class="modal-body">

        <div class="form-group">
            <label for="exotel_number" class="control-label">Select Calling Number</label>
            <select class="form-control selectpicker" name="exotel_number" required="" data-live-search="true">
              <option value=""></option>
              <?php
              if (isset($calling_numbes) && count($calling_numbes) > 0) {
                foreach ($calling_numbes as $r) {
                  ?>
                  <option value="<?php echo $r->exotel_number; ?>" ><?php echo $r->exotel_number; ?></option>
                  <?php
                }
              }
              ?>
            </select>

            <input type="hidden" name="customer_number" id="customer_number" >
          </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info" >Make Call</button>
      </div>
    </form>
    </div>

  </div>
</div>
<div id="call_details" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">India mart Details</h4>
            </div>
            <div class="modal-body indiamart_view">
                
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>


</body>
</html>

<script type="text/javascript">
  $(document).on('click', '.make_call', function() {
  var customer_number = $(this).attr('val');
  $("#customer_number").val(customer_number); 
});  
    $(document).on('click', '.indiamartdetails', function() {
        var rid = $(this).data('id');
        $.get("<?php echo admin_url('calls/getIndiaMartDetails/'); ?>"+rid, function(res){
            if (res != ""){
                $(".indiamart_view").html(res);
            }
        });
    });  
</script>

</body>
</html>
