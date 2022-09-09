
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
         <?php echo vendor_report_tab('ledger_reco',$vendor_info->id);?>
      </div>

            <div class="col-md-10">
                <div class="panel_s">
                    <div class="panel-body">

                   <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4><?php echo $title; ?></h4>
                        </div>
                        <div class="col-xs-12 col-md-6 text-right">
                   <a href="<?php echo admin_url('vendor/add_client_ledger_reco/'.$vendor_info->id); ?>" type="submit" class="btn btn-info">Add Ledger Reco</a>
                        </div>
                    </div>

          <hr class="hr-panel-heading">

          <div class="row">

            <!-- <form method="post" id="salary_form" enctype="multipart/form-data" action="">

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
            </form> -->


            <div class="col-md-12">

            <hr>
                <table class="table" id="newtable">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Added By</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Created At</th>
                        <th>File</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                if (!empty($ledger_reco_data)) {
                    foreach ($ledger_reco_data as $k => $row) {
                        
                        ?>
                    <tr>
                        <td><?php echo ++$k; ?></td>
                        <td><span class="badge badge-info"><?php echo get_employee_fullname($row->added_by); ?></span></td>
                        <!-- <td><?php echo $client_info->company; ?></td> -->
                        <td><?php echo _d($row->from_date); ?></td>
                        <td><?php echo _d($row->to_date); ?></td>
                        <td><?php echo _d($row->created_at); ?></td>
                        <td>
                            <?php 
                                if (!empty($row->file)){
                                    echo '<a target="_blank" href="'.site_url('uploads/ledger_reco/'.$row->id.'/'.$row->file).'">'.$row->file.'</a>';
                                }
                            ?>
                        </td>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="<?php echo admin_url('vendor/add_client_ledger_reco/'.$row->vendor_id.'/'. $row->id); ?>" class="btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="<?php echo admin_url('vendor/delete_ledger_reco/' . $row->id.'/'.$row->vendor_id); ?>" class="btn-sm btn-danger _delete" title="Delete"><i class="fa fa-trash"></i></a>
                            </div>
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
