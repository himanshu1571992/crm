
<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6"><h4><?php echo $title; ?> </h4></div>
                        </div>

                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="panel-body">
                                        <h4 for=""><u>No of PO Closed :</u></h4>
                                        <p class="text-danger" style="font-size: 25px;"><?php echo $ttlclosedpo; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel-body">
                                        <h4 for=""><u>No of PO Open :</u></h4>
                                        <p class="text-danger" style="font-size: 25px;"><?php echo $ttlopenpo; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <form method="post" id="salary_form" enctype="multipart/form-data" action="">
                                    <div class="col-md-3">
                                        <div class="form-group select-placeholder">
                                            <select class="selectpicker" name="range" id="range" data-width="100%" required="" onchange="render_customer_statement();">
                                                <option value=""></option>
                                                <option value="2" <?php echo (!empty($range) && $range == 2) ? 'selected' : ''; ?>>Weekly</option>
                                                <option value="3" <?php echo (!empty($range) && $range == 3) ? 'selected' : ''; ?>>Monthly</option>
                                                <option value="4" <?php echo (!empty($range) && $range == 4) ? 'selected' : ''; ?>>Quarterly</option>
                                                <option value="5" <?php echo (!empty($range) && $range == 5) ? 'selected' : ''; ?>>Yearly</option>
                                                <option value="period" <?php echo (!empty($range) && $range == 'period') ? 'selected' : ''; ?>>Custom Date</option>
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
                                </form>
                            </div>  
                            <div class="col-md-12 table-responsive">   
                                <hr>                                                          
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th width="1%">S.No</th>
                                            <th width="25%">Total</th>
                                            <th>Counts</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if(!empty($divisionmaster_list)){
                                            foreach ($divisionmaster_list as $key => $row) {
                                                $filter = '';
                                                $where = " YEAR(`date`) = '".date('Y')."' AND MONTH(`date`) = '".date('m')."'";
                                                if (isset($fromdate) && isset($todate)){
                                                    $where = " date between '".$fromdate."' and '".$todate."' ";
                                                    $filter = "&fromdate=".$fromdate."&todate=".$todate."";
                                                }
                                                
                                                $po_data = $this->db->query("SELECT COALESCE(SUM(totalamount),0) as ttlamt, COUNT(id) as ttlcount FROM `tblpurchaseorder` WHERE `division_id` = '".$row->id."' AND $where AND `show_list` = 1 AND `status` = 1 ")->row();
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>                                                
                                            <td><?php echo cc($row->name); ?></td>
                                            <td><a target="_blank" href="<?php echo admin_url('purchase/purchaseorder_list/division?division_id='.$row->id.$filter);?>" class="btn-sm btn-info"><?php echo (!empty($po_data)) ? $po_data->ttlcount : '0'; ?></a></td>
                                            <td><a target="_blank" href="<?php echo admin_url('purchase/purchaseorder_list/division?division_id='.$row->id.$filter);?>" class="btn-sm btn-info"><?php echo (!empty($po_data)) ? number_format($po_data->ttlamt, 2) : '0.00'; ?></a></td>
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
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [      
            'pageLength',        
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                }
            },
            'colvis'
        ]
    } );

    function render_customer_statement(){
        var val = $("#range").val();
        $(".date").hide();
        if (val == "period"){
            $(".date").show();
        }
    }
} );
</script>

</body>
</html>
