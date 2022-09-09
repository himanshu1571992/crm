
<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6"><h4><?php echo $title;?> </h4></div>
                        </div>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <?php echo form_open($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="financial_year_id" class="control-label">Financial Year</label>
                                            <select class="form-control selectpicker" name="financial_year_id" id="financial_year_id"  data-live-search="true" required="">
                                                <option value=""></option>
                                                <?php
                                                if (isset($financial_year_list) && count($financial_year_list) > 0) {
                                                    foreach ($financial_year_list as $key => $value) {
                                                        ?>
                                                        <option value="<?php echo $value->id; ?>" <?php echo ($financial_year_id == $value->id) ? 'selected' : "" ?>><?php echo cc($value->name); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group" style="margin-top: 26px;">
                                            <button type="submit" class="btn btn-info">Search</button>
                                            <a class="btn btn-danger" href="">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>    
                            <div class="col-md-12">
                                <br><br>
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><h4>Purchase Order</h4></div>
                                        <div class="panel-body">
                                            <canvas id="pochart" style="width:100%;max-width:600px"></canvas>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p style="font-size:15px;">PO made within this week - </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <a target="_blank" href="<?php echo admin_url('purchase/purchaseorder_list/week');?>" class="label label-info"><?php echo (isset($current_week_po)) ? $current_week_po->ttlcount : '0'; ?></a>&nbsp;&nbsp; <span class="badge badge-info"> <?php echo (isset($current_week_po)) ? number_format($current_week_po->ttlamt, 2) : '0.00'; ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p style="font-size:15px;">PO made within this month - </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <a target="_blank" href="<?php echo admin_url('purchase/purchaseorder_list/month');?>" class="label label-info"><?php echo (isset($current_month_po)) ? $current_month_po->ttlcount : '0'; ?></a>&nbsp;&nbsp; <span class="badge badge-info"> <?php echo (isset($current_month_po)) ? number_format($current_month_po->ttlamt, 2) : '0.00'; ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p style="font-size:15px;">PO made within this financial year - </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <a target="_blank" href="<?php echo admin_url('purchase/purchaseorder_list/year/'.$financial_year_id);?>" class="label label-info"><?php echo (isset($current_year_po)) ? $current_year_po->ttlcount : '0'; ?></a>&nbsp;&nbsp; <span class="badge badge-info"> <?php echo (isset($current_year_po)) ? number_format($current_year_po->ttlamt, 2) : '0.00'; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <a target="_blank" href="<?php echo admin_url('purchase/po_more_details');?>">Show More ..</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><h4>Payments</h4></div>
                                        <div class="panel-body">
                                            <canvas id="paychart" style="width:100%;max-width:600px"></canvas>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p style="font-size:15px;">Payment made within this week -  </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <a target="_blank" href="<?php echo admin_url('purchase/popayment_list/week');?>" class="label label-info"><?php echo (isset($current_week_payment)) ? $current_week_payment->ttlcount : '0'; ?></a>&nbsp;&nbsp; <span class="badge badge-info"> <?php echo (isset($current_week_payment)) ? number_format($current_week_payment->ttlamt, 2) : '0.00'; ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p style="font-size:15px;">Payment made within this month -  </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <a target="_blank" href="<?php echo admin_url('purchase/popayment_list/month');?>" class="label label-info"><?php echo (isset($current_month_payment)) ? $current_month_payment->ttlcount : '0'; ?></a>&nbsp;&nbsp; <span class="badge badge-info"> <?php echo (isset($current_month_payment)) ? number_format($current_month_payment->ttlamt, 2) : '0.00'; ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p style="font-size:15px;">Payment made within this financial year - </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <a target="_blank" href="<?php echo admin_url('purchase/popayment_list/year/'.$financial_year_id);?>" class="label label-info"><?php echo (isset($current_year_payment)) ? $current_year_payment->ttlcount : '0'; ?></a>&nbsp; <span class="badge badge-info"> <?php echo (isset($current_year_payment)) ? number_format($current_year_payment->ttlamt, 2) : '0.00'; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <a target="_blank" href="<?php echo admin_url('purchase/payment_more_details');?>">Show More ..</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><h4>MR</h4></div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p style="font-size:15px;">MR made within this week -  </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <a target="_blank" href="<?php echo admin_url('purchase/mr_list/week');?>" class="label label-info"><?php echo (isset($current_week_mr)) ? $current_week_mr->ttlcount : '0'; ?></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p style="font-size:15px;">MR made within this month -  </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <a target="_blank" href="<?php echo admin_url('purchase/mr_list/month');?>" class="label label-info"><?php echo (isset($current_month_mr)) ? $current_month_mr->ttlcount : '0'; ?></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p style="font-size:15px;">MR made within this financial year - </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <a target="_blank" href="<?php echo admin_url('purchase/mr_list/year/'.$financial_year_id);?>" class="label label-info"><?php echo (isset($current_year_mr)) ? $current_year_mr->ttlcount : '0'; ?></a> </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p style="font-size:15px;">Overdue MR Counts </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <a target="_blank" href="<?php echo admin_url('purchase/purchaseorder_list/overdue/'.$financial_year_id);?>" class="label label-info"><?php echo (isset($overdue_mr)) ? $overdue_mr : '0'; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <!-- <a href="#">Show More ..</a> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><h4>Invoices</h4></div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p style="font-size:15px;">Invoice made within this week -  </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <a target="_blank" href="<?php echo admin_url('purchase/purchaseinvoice_list/week');?>" class="label label-info"><?php echo (isset($current_week_invoice)) ? $current_week_invoice->ttlcount : '0'; ?></a>&nbsp;&nbsp; <span class="badge badge-info"> <?php echo (isset($current_week_invoice)) ? number_format($current_week_invoice->ttlamt, 2) : '0.00'; ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p style="font-size:15px;">Invoice made within this month -  </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <a target="_blank" href="<?php echo admin_url('purchase/purchaseinvoice_list/month');?>" class="label label-info"><?php echo (isset($current_month_invoice)) ? $current_month_invoice->ttlcount : '0'; ?></a>&nbsp;&nbsp; <span class="badge badge-info"> <?php echo (isset($current_month_invoice)) ? number_format($current_month_invoice->ttlamt, 2) : '0.00'; ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p style="font-size:15px;">Invoice made within this financial year - </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <a target="_blank" href="<?php echo admin_url('purchase/purchaseinvoice_list/year/'.$financial_year_id);?>" class="label label-info"><?php echo (isset($current_year_invoice)) ? $current_year_invoice->ttlcount : '0'; ?></a>&nbsp;&nbsp; <span class="badge badge-info"> <?php echo (isset($current_year_invoice)) ? number_format($current_year_invoice->ttlamt, 2) : '0.00'; ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p style="font-size:15px;">Overdue Invoice Counts <!-- 1 day MR create --> </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <a target="_blank" href="<?php echo admin_url('purchase/mr_list/overdue/'.$financial_year_id);?>" class="label label-info"><?php echo (isset($overdue_invoice)) ? $overdue_invoice : '0'; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <!-- <a href="#">Show More ..</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
</div>

<?php init_tail(); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>


<script>
    var yValues = [55, 49, 44, 24, 16, 55, 49, 44, 24, 16, 55, 49];
    var barColors = ["#2196f3", "#2196f3","#2196f3","#2196f3","#2196f3", "#2196f3", "#2196f3", "#2196f3", "#2196f3", "#2196f3", "#2196f3", "#2196f3"];

    new Chart("pochart", {
        type: "bar",
        data: {
            labels: [<?php echo $month_arr;?>],
            datasets: [{
            backgroundColor: barColors,
            data: [<?php echo $ttlpoamount;?>]
            }]
        },
        options: {
            legend: {display: false},
            title: {
            display: true,
            text: "PO Financial Year Record"
            }
        }
    });

    new Chart("paychart", {
        type: "bar",
        data: {
            labels: [<?php echo $month_arr;?>],
            datasets: [{
            backgroundColor: barColors,
            data: [<?php echo $ttlpaymentamount;?>]
            }]
        },
        options: {
            legend: {display: false},
            title: {
            display: true,
            text: "Payment Financial Year Record"
            }
        }
    });
</script>

</body>
</html>
