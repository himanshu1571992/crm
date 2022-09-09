<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="product_id" class="control-label">Product</label>
                                            <select class="form-control selectpicker" required='' id="product_id" name="product_id" data-live-search="true">
                                                <option value=""></option>
                                                <?php
                                                    if (isset($product_list)){
                                                        foreach ($product_list as $key => $value) {
                                                            $selected = (isset($product_id) && $product_id == $value->id) ? "selected": "";
                                                ?>
                                                            <option value="<?php echo $value->id; ?>" <?php echo $selected; ?>><?php echo cc($value->name); ?></option>
                                                <?php            
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label for="warehouse_id" class="control-label">Warehouse</label>
                                            <select class="form-control selectpicker" required='' data-live-search="true" id="warehouse_id" name="warehouse_id">
                                                <option value=""></option>
                                                <?php
                                                if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                                    foreach ($all_warehouse as $all_warehouse_value) {
                                                        $selected = ($warehouse_id == $all_warehouse_value->id) ? "selected": "";
                                                        ?>
                                                        <option value="<?php echo $all_warehouse_value->id; ?>" <?php echo $selected; ?>><?php echo $all_warehouse_value->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" app-field-wrapper="date">
                                            <label for="f_date" class="control-label">From Date</label>
                                            <div class="input-group date">
                                                <input id="f_date" name="f_date" required='' class="form-control datepicker" value="<?php if (!empty($f_date)) {echo $f_date;} ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" app-field-wrapper="date">
                                            <label for="t_date" class="control-label">To Date</label>
                                            <div class="input-group date">
                                                <input id="t_date" name="t_date" required='' class="form-control datepicker" value="<?php if (!empty($t_date)) {echo $t_date;} ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group" style="margin-top: 26px;">
                                            <button type="submit" class="btn btn-info">Search</button>
                                            <a class="btn btn-danger" href="">Reset</a>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>                    
                                <div class="col-md-12 ttlbincard-div">
                                    <div class="col-lg-2 col-xs-12 col-md-12 total-column">
                                        <div class="panel_s">
                                            <div class="panel-body">
                                                <h3 class="text-muted _total openingbaltext">0.00</h3>
                                                <span class="text-success">Opening Balance</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-xs-12 col-md-12 total-column">
                                        <div class="panel_s">
                                            <div class="panel-body">
                                                <h3 class="text-muted _total issueqtytext">0.00</h3>
                                                <span class="text-danger">Issued Qty</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-xs-12 col-md-12 total-column">
                                        <div class="panel_s">
                                            <div class="panel-body">
                                                <h3 class="text-muted _total rejectedtext">0.00</h3>
                                                <span class="text-danger">Rejected Qty</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-xs-12 col-md-12 total-column">
                                        <div class="panel_s">
                                            <div class="panel-body">
                                                <h3 class="text-muted _total outwardtext">0.00</h3>
                                                <span class="text-danger">Outward Qty</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-xs-12 col-md-12 total-column">
                                        <div class="panel_s">
                                            <div class="panel-body">
                                                <h3 class="text-muted _total closingtext">0.00</h3>
                                                <span class="text-success">Closing Balance</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12"> 
                                    <div class="table-responsive">  
                                        <table class="table" id="newtable">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Date</th>
                                                    <th>Opening as on (+)</th>
                                                    <th>Issued Qty (-)</th>
                                                    <th>Stock at Reject Qty(-)</th>
                                                    <th>Outward Qty(-)</th>
                                                    <th>Closing Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $i = 0;
                                            $closing_amt = $openingamt = $issueqtyamt = $rejectedamt = $outwardamt = 0;
                                            if(!empty($rent_bin_card_report)){
                                                foreach ($rent_bin_card_report as $key => $date) { 
                                                    $opening_amt = $this->store_model->getBincardOpeningAmt($date, $product_id, $warehouse_id, $service_type);
                                                    $issueqty_amt = $this->store_model->getBincardIssuedqtyAmt($date, $product_id, $warehouse_id, $service_type);
                                                    $rejected_amt = $this->store_model->getBincardRejectAmt($date, $product_id, $warehouse_id, $service_type);
                                                    $outward_amt = $this->store_model->getBincardOutwardAmt($date, $product_id, $warehouse_id, $service_type);
                                                    if ($opening_amt > 0 || $issueqty_amt > 0 || $rejected_amt > 0 || $outward_amt > 0){
                                                        $closing_amt += ($opening_amt - $issueqty_amt - $rejected_amt - $outward_amt);
                                                        $textcls = ($closing_amt > 0) ? "class='text-success'": "class='text-danger'";
                                                        $openingamt += $opening_amt;
                                                        $issueqtyamt += $issueqty_amt;
                                                        $rejectedamt += $rejected_amt;
                                                        $outwardamt += $outward_amt;
                                            ?>
                                                <tr>
                                                    <td><?php echo ++$i; ?></td>                                                
                                                    <td><?php echo _d($date); ?></td>
                                                    <td><?php echo number_format($opening_amt,2); ?></td>
                                                    <td><?php echo number_format($issueqty_amt,2); ?></td>
                                                    <td><?php echo number_format($rejected_amt,2); ?></td>
                                                    <td><?php echo number_format($outward_amt,2); ?></td>
                                                    <td <?php echo $textcls; ?>><?php echo number_format($closing_amt,2); ?></td>
                                                </tr>
                                                <?php
                                                    }
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
            <?php echo form_close(); ?>
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
    var openingbal = '<?php echo number_format($openingamt,2); ?>';
    var issueqtyamt = '<?php echo number_format($issueqtyamt,2); ?>';
    var rejectedamt = '<?php echo number_format($rejectedamt,2); ?>';
    var outwardamt = '<?php echo number_format($outwardamt,2); ?>';
    var closingamt = '<?php echo number_format($closing_amt,2); ?>';
    $(".ttlbincard-div").hide();
    if (openingbal > 0 || issueqtyamt > 0 || rejectedamt > 0 || outwardamt > 0 || closingamt > 0 ){
       
        $(".ttlbincard-div").show();
        $(".openingbaltext").html(openingbal);
        $(".issueqtytext").html(issueqtyamt);
        $(".rejectedtext").html(rejectedamt);
        $(".outwardtext").html(outwardamt);
        $(".closingtext").html(closingamt);
    }
    

    $('#newtable').DataTable( {
        
        "iDisplayLength": 35,
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [  
            'pageLength',        
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            'colvis',
        ]
    } );
} );
    
    function get_productlog_details(id, ref_type){
        var url = "<?php echo site_url('admin/store/get_productlog_details/'); ?>";
        $.ajax({
            type: "GET",
            url: url+id+"/"+ref_type,
            success: function (res) {
                $('.stockdetails').html(res);
            }
        })
    }

</script>


</body>
</html>

