
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
                            <div class="col-xs-12 col-md-6 text-right">
                                <a href="<?php echo admin_url('purchasechallanreturn/purchasedebitnote_add'); ?>" type="submit" class="btn btn-info">Create Direct DN</a>
                            </div>
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
                                <div class="col-md-2">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
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
                                            <th>Vendor Name</th>
                                            <th>MR Number</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($purchase_debitnote_list)) {
                                            foreach ($purchase_debitnote_list as $key => $value) {
                                                $mr_number = "--";
                                                if ($value->mr_id > 0){
                                                    $mr_number = value_by_id_empty("tblmaterialreceipt", $value->mr_id, "numer");
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td> 
                                                    <td><?php echo 'PDN-' . str_pad($value->id, 4, '0', STR_PAD_LEFT); ?></td>
                                                    <td><a href="<?php echo admin_url('vendor/vendor/' . $value->vender_id); ?>" target="_blank"><?php echo cc(value_by_id('tblvendor', $value->vender_id, 'name')); ?></a></td>
                                                    <td><?php echo (!empty($mr_number)) ? $mr_number : 'MR-'.$value->mr_id; ?></td>
                                                    <td><?php echo _d($value->date); ?></td> 
                                                    <td><?php echo $value->totalamount; ?></td> 
                                                    <td>
                                                        <a target="_blank" class="btn btn-info" href="<?php echo admin_url('purchasechallanreturn/download_debitnotepdf/' . $value->id); ?>" data-status="1" title="View PDF"><i class="fa fa-file-pdf-o"></i></a>
                                                        <a class="btn btn-info" href="<?php echo admin_url('purchasechallanreturn/purchasedebitnote_edit/' . $value->id); ?>" data-status="1" title="View PDF"><i class="fa fa-edit"></i></a>
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

</body>
</html>
