
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
                        <h4 class="no-margin">
                            <?php echo $title; ?>
                            <a target="_blank" class="btn btn-info pull-right" href="<?php echo admin_url('production_department/production_chart_report?'.$filterdata); ?>">Show Chart</a>
                        </h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="f_date" class="control-label">From Date</label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if (!empty($f_date)) { echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="t_date" class="control-label">To Date</label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if (!empty($t_date)) { echo $t_date; }?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="staff" class="control-label">Staff</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="operator1_id" id="operator1_id">
                                        <option value=""></option>
                                        <?php 
                                            if ($staff_list){
                                                foreach ($staff_list as $value) {
                                        ?>
                                                <option value="<?php echo $value->staffid; ?>" <?php echo (isset($operator1_id) && $value->staffid == $operator1_id) ? 'selected':''; ?>><?php echo cc($value->firstname); ?></option>
                                        <?php             
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="staff" class="control-label">Division</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="department" id="department">
                                        <option value=""></option>
                                        <?php 
                                        if(!empty($division_info)){
                                            foreach ($division_info as $value) {
                                                ?>
                                                <option value="<?php echo $value->id; ?>" <?php echo (isset($department) && $department == $value->id) ? 'selected' : "" ?>><?php echo $value->title; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <!-- <option value="1" <?php echo (isset($department) && $department == 1) ? 'selected' : "" ?>>Aluminum Scaffolding</option>
                                        <option value="2" <?php echo (isset($department) && $department == 2) ? 'selected' : "" ?>>MS Scaffolding</option>
                                        <option value="3" <?php echo (isset($department) && $department == 3) ? 'selected' : "" ?>>Aluminum Formwork</option> -->
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="machine_id" class="control-label">Machine</label>
                                        <select class="form-control selectpicker machine_id" data-live-search="true" name="machine_id" id="machine_id">
                                            <option value=""></option>
                                            <?php 
                                                if (isset($machinemaster_list)){
                                                    foreach ($machinemaster_list as $value) {
                                            ?>
                                                        <option value="<?php echo $value->id; ?>" <?php echo (isset($machine_id) && $machine_id == $value->id) ? 'selected' : ''; ?>><?php echo cc($value->name); ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
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
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="panel_s">
                                        <div class="panel-body text-center">
                                            <h3 class="text-muted _total no_power_div">0.00 %</h3>
                                            <span class="text-danger">No Power</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="panel_s">
                                        <div class="panel-body text-center">
                                            <h3 class="text-muted _total machine_breakdown_div">0.00 %</h3>
                                            <span class="text-danger" style="color:#09f4a7;">Machine Breakdown</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="panel_s">
                                        <div class="panel-body text-center">
                                            <h3 class="text-muted _total fixture_div">0.00 %</h3>
                                            <span class="text-warning">Die / Fixture</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="panel_s">
                                        <div class="panel-body text-center">
                                            <h3 class="text-muted _total otherwork_div">0.00 %</h3>
                                            <span class="text-info">Other Work</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="panel_s">
                                        <div class="panel-body text-center">
                                            <h3 class="text-muted _total loading_div">0.00 %</h3>
                                            <span class="text-warning" style="color:#f110ee;">Loading / Unloading</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="panel_s">
                                        <div class="panel-body text-center">
                                            <h3 class="text-muted _total operator_efficiency_div">0.00 %</h3>
                                            <span class="text-success">Operator Efficiency</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="panel_s">
                                        <div class="panel-body text-center">
                                            <h3 class="text-muted _total overallproduction_div">0.00 %</h3>
                                            <span class="text-danger">Over All Production</span><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>First Operator</th>
                                            <th>Second Operator</th>
                                            <th>Division</th>
                                            <th>Machine</th>
                                            <th>Operation</th>
                                            <th>Size</th>
                                            <th>Start & End Time</th>
                                            <th>Produced Qty</th>
                                            <th>Rejection Qty</th>
                                            <th>No Power</th>
                                            <th>Machine Breakdown</th>
                                            <th>Fixture Setting</th>
                                            <th>other Work</th>
                                            <th>Loading / Unloading</th>
                                            <th>Other Remark</th>
                                            <th>Available Min</th>
                                            <th>Target Qty</th>
                                            <th>Operator Efficiency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $overall_production = $no_power_amt = $ttlavailable_mins = $machine_breakdown_amt = $fixture_amt = $other_work_amt = $loading_amt = $operator_efficiency_amt = 0;
                                        if (!empty($production_list)) {
                                            foreach ($production_list as $key => $row) {
                                                $total_mins = round(abs(strtotime($row->end_time) - strtotime($row->start_time)) / 60,2);    
                                                $total_waste_mins = ($row->no_power+$row->machine_breakdown+$row->fixture_setting+$row->other_work+$row->loading_unloading);
                                                $cycle_time = value_by_id('tbloperationsmaster',$row->operation_id,'cycle_time');
                                                $available_mins = abs($total_mins-$total_waste_mins);
                                                $target_qty = round($available_mins/$cycle_time);
                                                $actual_produced_qty = ($row->produced_qty+$row->rejection_qty);
                                                $operator_efficiency = ($target_qty > 0) ? (($actual_produced_qty/$target_qty)*100) : 0;

                                                if($operator_efficiency > 100){
                                                    $operator_efficiency = '100';
                                                }
                                                /*$department = 'Aluminum Formwork';
                                                if ($row->department_id == 1){
                                                    $department = 'Aluminum Scaffolding';
                                                }else if($row->department_id == 2){
                                                    $department = 'MS Scaffolding';
                                                }*/
                                                $department = value_by_id('tbldivisionmaster',$row->department_id,'title');

                                                $no_power_amt += $row->no_power;
                                                $machine_breakdown_amt += $row->machine_breakdown;
                                                $fixture_amt += $row->fixture_setting;
                                                $other_work_amt += $row->other_work;
                                                $loading_amt += $row->loading_unloading;
                                                $operator_efficiency_amt += $operator_efficiency;
                                                $ttlavailable_mins += $available_mins;
                                        ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>  
                                                    <td><?php echo _d($row->date); ?></td>
                                                    <td><?php echo (!empty($row->operator1_id)) ? get_employee_name($row->operator1_id) : '--'; ?></td> 
                                                    <td><?php echo (!empty($row->operator2_id)) ? get_employee_name($row->operator2_id) : '--'; ?></td> 
                                                    <td><?php echo $department; ?></td>
                                                    <td><?php echo value_by_id('tblmachinemaster',$row->machine_id,'name'); ?></td>
                                                    <td><?php echo value_by_id('tbloperationsmaster',$row->operation_id,'name'); ?></td>
                                                    <td><?php echo $row->size; ?></td>
                                                    <td><?php echo date('h:i A',strtotime($row->start_time)) .' to '.date('h:i A',strtotime($row->end_time))?></td>
                                                    <td><?php echo $row->produced_qty; ?></td>
                                                    <td><?php echo $row->rejection_qty; ?></td>
                                                    <td><?php echo $row->no_power; ?></td>
                                                    <td><?php echo $row->machine_breakdown; ?></td>
                                                    <td><?php echo $row->fixture_setting; ?></td>
                                                    <td><?php echo $row->other_work; ?></td>
                                                    <td><?php echo $row->loading_unloading; ?></td>
                                                    <td><?php echo (!empty($row->other_remark)) ? $row->other_remark : '--'; ?></td>
                                                    <td><?php echo number_format($available_mins, 2); ?></td>
                                                    <td><?php echo number_format($target_qty, 2); ?></td>
                                                    <td><?php echo number_format($operator_efficiency, 2); ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        $ttlsize = (isset($production_list)) ? count($production_list) : 0;
                                        $overAllEfficiency = (($ttlsize > 0) ? round($operator_efficiency_amt / $ttlsize) : 0);
                                        $overAllNoPower = ($no_power_amt > 0) ? round(($no_power_amt / $ttlavailable_mins) * 100) : 0;
                                        $overAllMachineBreakDown = ($machine_breakdown_amt > 0) ? round(($machine_breakdown_amt / $ttlavailable_mins) * 100) : 0;
                                        $overAllDieFixture = ($fixture_amt > 0) ? round(($fixture_amt / $ttlavailable_mins) * 100) : 0;
                                        $overAllOtherWork = ($other_work_amt > 0) ? round(($other_work_amt / $ttlavailable_mins) * 100) : 0;
                                        $overAllLoadingUnloading = ($loading_amt > 0) ? round(($loading_amt / $ttlavailable_mins) * 100) : 0;
                                        $overAllProduction = round(100 - ($overAllNoPower+$overAllMachineBreakDown+$overAllDieFixture+$overAllOtherWork+$overAllLoadingUnloading));
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
    $(".no_power_div").html('<?php echo number_format($overAllNoPower, 2); ?> %');
    $(".machine_breakdown_div").html('<?php echo number_format($overAllMachineBreakDown, 2); ?> %');
    $(".fixture_div").html('<?php echo number_format($overAllDieFixture, 2); ?> %');
    $(".otherwork_div").html('<?php echo number_format($overAllOtherWork, 2); ?> %');
    $(".loading_div").html('<?php echo number_format($overAllLoadingUnloading, 2); ?> %');
    $(".operator_efficiency_div").html('<?php echo number_format($overAllEfficiency, 2); ?> %');
    $(".overallproduction_div").html('<?php echo number_format($overAllProduction, 2); ?> %');

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
                        columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns:  [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns:  [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19]
                    }
                },
                'colvis',
            ]
        });
    });
</script>

</body>
</html>

<script>
    $('#department').on("change",function(){
        var departmentid = $(this).val();

        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/production_department/get_machinelist'); ?>",
            data    : {'departmentid' : departmentid},
            success : function(response){
                if(response != ''){
                    $("#machine_id").html('').html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        });
    });
</script>
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
