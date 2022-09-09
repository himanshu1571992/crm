
<?php init_head(); ?>
<link href="<?php echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />
<style type="text/css">

    .ui-table > thead > tr > th {
        border:1px solid #9d9d9d !important;
        color: #fff !important;
        background:#6d7580;
    }

    .ui-table > tbody > tr > td{
        border: 1px solid #c7c7c7;
        color:#5f6670;
    }

    .ui-table > tbody > tr:nth-child(even) {
        background: #f8f8f8;
    }

</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?> </h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div>
                                <div class="col-md-3" id="employee_div">
                                    <div class="form-group ">
                                        <label for="branch_id" class="control-label">Client</label>
                                        <select class="form-control selectpicker" id="client_id" name="client_id" data-live-search="true">
                                            <option value="" disabled selected >--Select One-</option>
                                            <?php
                                            if (!empty($client_data)) {
                                                foreach ($client_data as $row) {
                                                    ?>
                                                    <option value="<?php echo $row->userid; ?>" <?php
                                                    if (!empty($client_id) && $client_id == $row->userid) {
                                                        echo 'selected';
                                                    }
                                                    ?>><?php echo cc($row->client_branch_name); ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="f_date" class="control-label">From Date</label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if (!empty($f_date)) { echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="t_date" class="control-label">To Date</label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if (!empty($t_date)) { echo $t_date; }?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-2">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                    <a class="btn btn-danger" style="margin-top: 24px;" href="">Reset</a>
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
                                            <th>Challan No</th>
                                            <th>Customer Name</th>
                                            <th>Date</th>
                                            <th>Components Dispatched</th>
                                            <th>Total Dispatched Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($invoice_list)) {
                                            foreach ($invoice_list as $key => $value) {
                                                $client_info = $this->db->query("SELECT `client_branch_name` from `tblclientbranch` where userid = '" . $value->clientid . "'  ")->row();
                                        ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>                                                
                                                    <td><?php echo '<a target="_blank" href="' . site_url('admin/chalan/view/' . $value->id) . '" >' . $value->chalanno . '</a>'; ?></td>
                                                    <td><a href="<?php echo admin_url('clients/client/' . $value->clientid); ?>" target="_blank"><?php echo cc($client_info->client_branch_name); ?></a></td>
                                                    <td><?php echo _d($value->challandate); ?></td> 
                                                    <td><?php echo value_by_id('tblproducts',$value->component_id,'sub_name'); ?></td> 
                                                    <td><?php echo $value->deleverable_qty." ".get_product_units($value->component_id); ?></td> 
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

<?php echo form_close(); ?>
            </div>      
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script src="<?php echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
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
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            buttons: [
                'pageLength',
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                'colvis',
            ]
        });
    });
</script>

</body>
</html>


<script type="text/javascript">
    $(document).ready(function () {
        'use-strict';

        //Example 2
        $('#filer_input2').filer({
//        limit: 5,
            maxSize: 20,
//        extensions: ['jpg', 'jpeg', 'png' ],
            changeInput: true,
            showThumbs: true,
            addMore: true
        });
    });
</script>
