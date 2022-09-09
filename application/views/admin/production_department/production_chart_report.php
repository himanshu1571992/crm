<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">

  <?php if(get_option('favicon') != ''){ ?>

    <link href="<?php echo base_url('uploads/company/'.get_option('favicon')); ?>" rel="shortcut icon">

  <?php } ?>

  <title>

    <?php echo $title; ?>

  </title>

  <?php echo app_stylesheet('assets/css','reset.css'); ?>

  <!-- Bootstrap -->

  <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

  <?php if(is_rtl()){ ?>

    <link href="<?php echo base_url('assets/plugins/bootstrap-arabic/css/bootstrap-arabic.min.css'); ?>" rel="stylesheet">

  <?php } ?>

  <link href='<?php echo base_url('assets/plugins/roboto/roboto.css'); ?>' rel='stylesheet'>

  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet">

  <link href='<?php echo base_url('assets/css/bs-overides.min.css'); ?>' rel='stylesheet'>
<?php if(get_option('recaptcha_secret_key') != '' && get_option('recaptcha_site_key') != ''){ ?>

  <script src='https://www.google.com/recaptcha/api.js'></script>

<?php } ?>

<?php if(file_exists(FCPATH.'assets/css/custom.css')){ ?>

  <link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet">

<?php } ?>

<?php render_custom_styles(array('general','buttons')); ?>

<?php do_action('app_admin_login_head'); ?>

</head>
<body>
    


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
    /* table {
        table-layout: fixed;
        width: 100%;
        border: 1px solid #333333;
    } */
    th {
        border:3px solid #000 !important;
        /* padding: 5px; */
        color: #fff !important;
        /* background:#2196f3;
        text-overflow: ellipsis;
        font-size: 12px;
        text-align:center; */
    }
    td {
        /* width: 50%;
        max-width: 500px;
        padding: 5px; */
        border: 3px solid #333333;
        /* text-overflow: ellipsis;
        font-size: 10px;
        text-align:center; */
    }
    
</style>

<div id="wrapper1">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">
                            <?php echo $title; ?>
                            <a href="javascript:void(0);" id="printpage" class="btn btn-info pull-right">Print</a>
                        </h4>
                        <hr class="hr-panel-heading">
                        <div class="row" id="printarea">
                            <div class="col-md-12">
                                <div class="col-md-6" style="border: 2px solid;">
                                    <canvas id="chart1" style="width:100%;max-width:600px;height: 300px;"></canvas>
                                </div>
                                <div class="col-md-6" style="border: 2px solid;">
                                    <div id="myPlot" style="width:100%;max-width:600px;height: 300px;"></div>
                                </div>
                                <div class="col-md-6" style="border: 2px solid;">
                                    <!-- <canvas id="chart2" style="width:100%;max-width:600px;height: 300px;"></canvas> -->
                                    <div id="chart2" style="margin-top:1%;width:100%;max-width:600px;height: 300px;"></div>
                                </div>
                                <div class="col-md-6" style="border: 2px solid;">
                                    <!-- <canvas id="chart3" style="width:100%;max-width:600px;height: 300px;"></canvas> -->
                                    <div id="chart3" style="margin-top:1%;width:100%;max-width:600px;height: 300px;"></div>
                                </div>
                            </div>
                            <div class="col-md-12 table-responsive">  
                                <hr>                                                           
                                <table class="table" id="newtable1" style="font-size: 10px;border:3px solid #000 !important;">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>First Operator</th>
                                            <th>Second Operator</th>
                                            <th>Division</th>
                                            <th>Machine</th>
                                            <th>Operation</th>
                                            <th style="width: 107px;">Size</th>
                                            <th>Start & End Time</th>
                                            <th>Produced Qty</th>
                                            <th>Rejection Qty</th>
                                            <th>No Power</th>
                                            <th>Machine Breakdown</th>
                                            <th>Fixture Setting</th>
                                            <th>Other Work</th>
                                            <th>Loading / Unloading</th>
                                            <th>Other Remark</th>
                                            <th>Available Min</th>
                                            <th>Target Qty</th>
                                            <th>Operator Efficiency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $chart1 = array();
                                        $chart2 = array();
                                        $chart3 = array();
                                        $chart1_val = array();
                                        $chart2_val = array();
                                        $chart3_val = array();
                                        $chart3_staff = array();
                                        $total_row = 0;
                                        $overall_production = $no_power_amt = $ttlavailable_mins = $machine_breakdown_amt = $fixture_amt = $other_work_amt = $loading_amt = $operator_efficiency_amt = 0;
                                        if (!empty($production_list)) {
                                            foreach ($production_list as $key => $row) {
                                                ++$total_row;
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
                                                
                                                $department = value_by_id('tbldivisionmaster',$row->department_id,'title');
                                                $chart1[$row->department_id] = $department;
                                                if (array_key_exists($row->department_id, $chart1_val)){
                                                    $chart1_val[$row->department_id] += 1;
                                                }else{
                                                    $chart1_val[$row->department_id] = 1;
                                                }
                                                
                                                $machine_name = value_by_id('tblmachinemaster',$row->machine_id,'name');
                                                $chart2[$row->machine_id] = $machine_name;
                                                if (array_key_exists($row->machine_id, $chart2_val)){
                                                    $chart2_val[$row->machine_id] += 1;
                                                }else{
                                                    $chart2_val[$row->machine_id] = 1;
                                                }

                                                if ($row->operator1_id > 0){
                                                    $chart3[$row->operator1_id] = get_employee_name($row->operator1_id);
                                                    if (array_key_exists($row->operator1_id, $chart3_staff)){
                                                        $chart3_staff[$row->operator1_id] += 1;
                                                    }else{
                                                        $chart3_staff[$row->operator1_id] = 1;
                                                    }
                                                    if (array_key_exists($row->operator1_id, $chart3_val)){
                                                        $chart3_val[$row->operator1_id] += $operator_efficiency;
                                                    }else{
                                                        $chart3_val[$row->operator1_id] = 1;
                                                    }
                                                }
                                                $no_power_amt += $row->no_power;
                                                $machine_breakdown_amt += $row->machine_breakdown;
                                                $fixture_amt += $row->fixture_setting;
                                                $other_work_amt += $row->other_work;
                                                $loading_amt += $row->loading_unloading;
                                                $operator_efficiency_amt += $operator_efficiency;
                                                $ttlavailable_mins += $available_mins;
                                                $psize = str_replace("/","/<br>", $row->size);
                                        ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>  
                                                    <td><?php echo _d($row->date); ?></td>
                                                    <td><?php echo (!empty($row->operator1_id)) ? get_employee_name($row->operator1_id) : '--'; ?></td> 
                                                    <td><?php echo (!empty($row->operator2_id)) ? get_employee_name($row->operator2_id) : '--'; ?></td> 
                                                    <td><?php echo $department; ?></td>
                                                    <td><?php echo $machine_name; ?></td>
                                                    <td><?php echo value_by_id('tbloperationsmaster',$row->operation_id,'name'); ?></td>
                                                    <td><?php echo $psize; ?></td>
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
                            <?php 
                                /* division percent calculation */
                                $division_percent = '';
                                $dicvisionbgcolors = '';
                                if (!empty($chart1_val)){
                                    $j = 0;
                                    foreach ($chart1_val as $k => $division) {
                                        
                                        $prefix = ($j > 0) ? ',':''; 
                                        $percent = round(($division/$total_row)*100);
                                        $division_percent .=  $prefix.$percent;
                                        $chart1[$k] = '"'.$chart1[$k].' ('.$percent.'%)"';
                                        $j++;
                                        $dicvisionbgcolors .= $prefix."'#2196f3'";
                                    }
                                }
                                
                                $division_title = implode(',', $chart1);
                                $division_val = $division_percent;

                                /* machine percent calculation */
                                $machine_percent = '';
                                if (!empty($chart2_val)){
                                    $j1 = 0;
                                    foreach ($chart2_val as $k => $machine) {
                                        
                                        $prefix = ($j1 > 0) ? ',':''; 
                                        $percent = round(($machine/$total_row)*100);
                                        $machine_percent .=  $prefix.$percent;
                                        // $chart2[$k] = '"'.$chart2[$k].' ('.$percent.'%)"';
                                        $chart2[$k] = '"'.$chart2[$k].'"';
                                        $j1++;
                                    }
                                }
                                $machine_title = implode(',', $chart2);
                                $machine_val = $machine_percent;

                                /* Operator percent calculation */
                                $operator_percent = '';
                                if (!empty($chart3_val)){
                                    $j2 = 0;
                                    foreach ($chart3_val as $k => $operator) {
                                        
                                        $prefix = ($j2 > 0) ? ',':'';
                                        $percent = round($operator/$chart3_staff[$k], 2);
                                        $operator_percent .=  $prefix.$percent;
                                        // $chart3[$k] = '"'.$chart3[$k].' ('.$percent.'%)"';
                                        $chart3[$k] = '"'.$chart3[$k].'"';
                                        
                                        $j2++;
                                    }
                                }
                                $operator_title = implode(',', $chart3);
                                $operator_val = $operator_percent;
                            ?>
                        </div>
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
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    $(".no_power_div").html('<?php echo number_format($overAllNoPower, 2); ?> %');
    $(".machine_breakdown_div").html('<?php echo number_format($overAllMachineBreakDown, 2); ?> %');
    $(".fixture_div").html('<?php echo number_format($overAllDieFixture, 2); ?> %');
    $(".otherwork_div").html('<?php echo number_format($overAllOtherWork, 2); ?> %');
    $(".loading_div").html('<?php echo number_format($overAllLoadingUnloading, 2); ?> %');
    $(".operator_efficiency_div").html('<?php echo number_format($overAllEfficiency, 2); ?> %');
    $(".overallproduction_div").html('<?php echo number_format($overAllProduction, 2); ?> %');

</script>
<script>
    // var yValues = [55, 49, 44, 24, 16, 55, 49, 44, 24, 16, 55, 49];
    var barColors = ["#2196f3", "#2196f3","#2196f3","#2196f3","#2196f3", "#2196f3", "#2196f3", "#2196f3", "#2196f3", "#2196f3", "#2196f3", "#2196f3"];

    new Chart("chart1", {
        type: "bar",
        data: {
            labels: [<?php echo $division_title; ?>],
            datasets: [{
            backgroundColor: [<?php echo $dicvisionbgcolors; ?>],
            data: [<?php echo $division_val; ?>]
            }]
        },
        options: {
            legend: {display: false},
            title: {
                display: true,
                text: "Division"
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    /* chart 2 */
    // new Chart("chart2", {
    //     type: "bar",
    //     data: {
    //         labels: [<?php echo $machine_title; ?>],
    //         datasets: [{
    //         backgroundColor: barColors,
    //         data: [<?php echo $machine_val; ?>]
    //         }]
    //     },
    //     options: {
    //         legend: {display: false},
    //         title: {
    //         display: true,
    //         text: "Machine"
    //         }
    //     }
    // });

    var options = {
        series: [{
            data: [<?php echo $machine_val; ?>]
        }],
        chart: {
            type: 'bar',
            height: 400
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: true,
            },
        },
        dataLabels: {
            enabled: true
        },
        xaxis: {
            categories: [<?php echo $machine_title; ?>],
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart2"), options);
    chart.render();
    chart.updateOptions({
        title: {
            text: 'Machine',
            align: 'center'
        }
    })
    /* chart 3 */
    // new Chart("chart3", {
    //     type: "bar",
    //     data: {
    //         labels: [<?php echo $operator_title; ?>],
    //         datasets: [{
    //         backgroundColor: barColors,
    //         data: [<?php echo $operator_val; ?>]
    //         }]
    //     },
    //     options: {
    //         legend: {display: false},
    //         title: {
    //             display: true,
    //             text: "Operators"
    //         }
    //     }
    // });

    var options1 = {
        series: [{
            data: [<?php echo $operator_val; ?>]
        }],
        chart: {
            type: 'bar',
            height: 400
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: true,
            }
        },
        dataLabels: {
            enabled: true
        },
        xaxis: {
            categories: [<?php echo $operator_title; ?>],
        }
    };

    var chart1 = new ApexCharts(document.querySelector("#chart3"), options1);
    chart1.render();
    chart1.updateOptions({
        title: {
            text: 'Operators',
            align: 'center'
        }
    })

    /* Pie chart script */
    var xArray = ["No Power", "Machine Breakdown", "Fixture Setting", "other Work", "Loading / Unloading", "Net Production %"];
    var yArray = [<?php echo $overAllNoPower; ?>, <?php echo $overAllMachineBreakDown; ?>, <?php echo $overAllDieFixture; ?>, <?php echo $overAllOtherWork; ?>, <?php echo $overAllLoadingUnloading; ?>, <?php echo $overAllProduction; ?>];

    var layout = {title:"% of Idle hrs"};

    var data = [{labels:xArray, values:yArray, type:"pie"}];

    Plotly.newPlot("myPlot", data, layout);
    $("#modebar-51dfaf").html("");


    $(document).ready(function(){
        $(document).on("click", "#printpage", function(){
            $("#printpage").hide();
            window.print();
            $("#printpage").show();
            return false;
            
        });
    });
    
</script>
</body>
</html>