
<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6"><h4><?php echo $title;?> </h4></div>   
                        </div>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div>
                                <div class="form-group col-md-3">
                                    <label for="vendor_id" class="control-label">Vendor</label>
                                    <select class="form-control selectpicker vendor_id" data-live-search="true" id="vendor_id" name="vendor_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($vendors_info) && count($vendors_info) > 0) {
                                            foreach ($vendors_info as $vendor_value) {
                                                ?>
                                                <option value="<?php echo $vendor_value->id; ?>" <?php if (!empty($vendor_id) && $vendor_id == $vendor_value->id) {
                                            echo 'selected';
                                        } ?>><?php echo cc($vendor_value->name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="f_date" class="control-label">From Date</label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php
                                        if (!empty($f_date)) {
                                            echo $f_date;
                                        }
                                        ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="t_date" class="control-label">To Date</label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php
                                        if (!empty($t_date)) {
                                            echo $t_date;
                                        }
                                        ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-1">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                </div>
                                <div class="col-md-1">
                                    <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <hr>
                            </div>

                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Number</th>
                                            <th>Date</th>
                                            <th>Vendor Name</th>
                                            <th>MR Number</th>
                                            <th>Uploads Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($challanreturn_list)) {
                                            foreach ($challanreturn_list as $key => $value) {

                                                $document_info = $this->db->query("SELECT * FROM tblfiles WHERE rel_id = '" . $value->id . "' and rel_type = 'purchallan_return'")->result();
                                                $mr_number = value_by_id_empty("tblmaterialreceipt", $value->mr_id, "numer");
                                                ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td> 
                                                    <td><?php echo 'PCR-' . str_pad($value->id, 4, '0', STR_PAD_LEFT); ?></td>
                                                    <td><?php echo _d($value->date); ?></td> 
                                                    <td><a href="<?php echo admin_url('vendor/vendor/' . $value->vendor_id); ?>" target="_blank"><?php echo cc(value_by_id('tblvendor', $value->vendor_id, 'name')); ?></a></td>
                                                    <td><?php echo (!empty($mr_number)) ? $mr_number : 'MR-'.$value->mr_id; ?></td>
                                                    <td><?php
                                                        $dtitle = (!empty($document_info)) ? "<span class='btn btn-success btn-sm'>Uploaded</span>": "<span class='btn btn-warning btn-sm'>Pending</span>";
                                                    ?>
                                                        <a target="_blank" class="actionBtn uplaods" href="javascript:void(0);" data-toggle="modal" data-target="#upload_modal" data-pcreturn_id="<?php echo $value->id; ?>"><?php echo $dtitle; ?></a>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group pull-right">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                <li>
                                                                    <a target="_blank" href="<?php echo admin_url('purchasechallanreturn/download_pdf/' . $value->id); ?>" data-status="1" title="View PDF">View PDF</a>
                                                                    
                                                                </li>
                                                                <?php if ($value->is_convertDN == 0) { ?>
                                                                <li>
                                                                    <?php
                                                                    if (check_permission_page(45, 'delete')) {
                                                                        ?>
                                                                    <a class="_delete" style="color: red;" href="<?php echo admin_url('purchasechallanreturn/delete/' . $value->id); ?>" data-status="1" title="DELETE">DELETE</a> 
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" href="<?php echo admin_url('purchasechallanreturn/convert_todebitnote/' . $value->id); ?>" data-status="1" title="Convert To DN">Convert To DN</a>
                                                                </li>
                                                                <?php } ?>
                                                            </ul>
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
                        <!-- <div class="btn-bottom-toolbar text-right">
                                       <button class="btn btn-info" value="1" name="mark" type="submit">
<?php echo _l('submit'); ?>
                                       </button>
                               </div> -->

                    </div>
                </div>

<?php echo form_close(); ?>
            </div>      
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
</div>
<div id="upload_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title upload_title">Purchase Challan Return Uploads</h4>
      </div>
      <div class="modal-body">
        
        <div id="upload_data">
            
        </div>

        <form action="<?php echo admin_url('purchasechallanreturn/file_upload'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="file" class="control-label"><?php echo 'Upload File'; ?></label>
                    <input type="file" id="file" multiple="" name="file[]" style="width: 100%;height: auto;padding: 10px 15px;">
                </div>
                <input type="hidden" id="pcreturn_id" name="pcreturn_id">
            </div>

            <div class="text-right">
                <button class="btn btn-info" type="submit">Submit</button>
            </div>  
        </form>

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

    $(document).ready(function () {
        $('#newtable').DataTable({
            "iDisplayLength": 15,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                'colvis'
            ]
        });
    });
</script>
<script type="text/javascript">
$(document).on('click', '.uplaods', function() {  

    var id = $(this).data("pcreturn_id");
    $('#pcreturn_id').val(id); 

    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/purchasechallanreturn/get_uploads_data'); ?>",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){       

                $('#upload_data').html(response);  
            }
        }
    })

}); 
</script>
</body>
</html>
