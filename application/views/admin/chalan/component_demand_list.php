
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
<style>
    @media (max-width: 500px){
        .btn-bottom-toolbar {
            width: 100%
        }
    }    
    @media (max-width: 768px){
        .btn-bottom-toolbar {
            width: 100%
        }
    }     
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?> </h4>
                        <hr class="hr-panel-heading">
                        <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                            <div class="row">
                                <div>
                                    <div class="col-md-3" id="employee_div">
                                        <div class="form-group ">
                                            <label for="branch_id" class="control-label">Status</label>
                                            <select class="form-control selectpicker" id="status" name="status" data-live-search="true">
                                                <option value="" disabled selected >--Select One-</option>
                                                <option value="1" <?php echo (strlen($status) > 0 && $status == 1) ? 'selected':''; ?>>Converted</option>
                                                <option value="0" <?php echo (strlen($status) > 0 && $status == 0) ? 'selected':''; ?>>Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">                            
                                        <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                        <a class="btn btn-danger" style="margin-top: 24px;" href="">Reset</a>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                        <?php echo form_open(admin_url("chalan/demand_product_cutting"), array('id' => 'demand_product_cutting_form', 'class' => 'demand_product_cutting-form')); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <div class="col-md-3 pull-right" id="cutting_typediv">
                                    <div class="form-group ">
                                        <label for="branch_id" class="control-label">Cutting Type</label>
                                        <select class="form-control selectpicker" id="cutting_type" name="cutting_type" data-live-search="true" required>
                                            <option value="" disabled selected >--Select One-</option>
                                            <option value="1">Pipe Cutting</option>
                                            <option value="2">Sheet Cutting</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                            </div>

                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Product Name</th>
                                            <th>Demand Qty</th>
                                            <th>Qty</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($demand_list)) {
                                            foreach ($demand_list as $key => $value) {
                                                $product_name = value_by_id("tblproducts", $value->product_id, 'name');
                                                $demand_status = ($value->status == 1) ? '<span class="text-success">Converted</span>' : '<span class="text-warning">Pending</span>';
                                        ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>        
                                                    <td><?php echo $product_name; ?></td>        
                                                    <td><?php echo $value->demand_qty; ?></td>
                                                    <td>
                                                        <input type="hidden" name="demandproduct[<?php echo $key; ?>][product_id]" class="form-control product_id<?php echo $key; ?>" value="<?php echo $value->product_id; ?>">
                                                        <input type="hidden" name="demandproduct[<?php echo $key; ?>][dqty]" class="form-control demandqty<?php echo $key; ?>" value="<?php echo $value->demand_qty; ?>">
                                                        <input type="number" min="1" name="demandproduct[<?php echo $key; ?>][qty]" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control requiredqty<?php echo $key; ?>">
                                                    </td>
                                                    <td><?php echo $demand_status; ?></td>
                                                    <td><input type="checkbox" name="demandproduct[<?php echo $key; ?>][action]" data-rid="<?php echo $key; ?>" class="form-control action-box"></td> 
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="btn-bottom-toolbar bottom-transaction text-right">
                                    <button type="submit" onclick="return checkForTheCondition();" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">Save</button>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>

                
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

        $(document).on('click','.action-box', function() {
            var rid = $(this).data("rid");
            if($(this).is(":checked")) {
               
                var demandqty = $('.demandqty'+rid).val();
                var requiredqty = $('.requiredqty'+rid).val();
                if (requiredqty != '' && requiredqty > 0){
                    if (demandqty < parseFloat(requiredqty)){
                        alert('Qty Should be equal to less then demand qty');
                        $('.requiredqty'+rid).val('');
                        $(this).prop("checked", false);
                    }
                }else{
                    alert('Qty Should be required');
                    $('.requiredqty'+rid).val('');
                    $(this).prop("checked", false);
                }
            }else{
                $('.requiredqty'+rid).val('');
            }
        });
    });

    function checkForTheCondition(){
        var actioncount = 0;
        $('.action-box').each(function() {
            if($(this).is(":checked")) {
                actioncount++;
            }
        });
        if (actioncount == 0){
            alert("Please check at least one product");
            return false;
        }
        return true;
    }
</script>
