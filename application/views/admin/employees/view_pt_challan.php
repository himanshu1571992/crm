<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}.error{border:1px solid red !important;} 
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        /*width:inherit;*/ /* Or auto */
        padding:0 10px; /* To give a bit of padding on the left and right */
        border-bottom:none;
    }</style>

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><?php echo $title; ?></h4>
                                    <hr/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group col-md-3">
                                        <label for="challan_no" class="control-label"><u class="text-info">Challan No :</u></label>
                                        <p><?php 
                                            echo (!empty($pt_challan_info->challan_no)) ? $pt_challan_info->challan_no : '--';
                                        ?></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="date" class="control-label"><u class="text-info">Challan Date :</u></label>
                                        <p><?php 
                                            echo (!empty($pt_challan_info->challan_date)) ? _d($pt_challan_info->challan_date) : '--';
                                        ?></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="date" class="control-label"><u class="text-info">Payment Date :</u></label>
                                        <p><?php 
                                            echo (!empty($pt_challan_info->payment_date)) ? _d($pt_challan_info->payment_date) : '--';
                                        ?></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="Interested_late_fees_payment" class="control-label">&nbsp;<u class="text-info">Interested Late Fees Payment :</u></label>
                                        <p><?php 
                                            if ($pt_challan_info->Interested_late_fees_payment == "1"){
                                                echo "<span class='btn-sm btn-success'>Yes</span>";
                                            }else{
                                                echo "<span class='btn-sm btn-danger'>No</span>";
                                            }
                                        ?></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group col-md-3">
                                        <label for="amount" class="control-label"><u class="text-info">Total PT Amount :</u></label>
                                        <p><?php 
                                            echo (!empty($pt_challan_info->total_amount)) ? $pt_challan_info->total_amount : '--';
                                        ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($pt_deduction_list)){ ?>
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>PT Deduction List</h4>   
                                    <hr/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <div class="table-responsive">                                                         
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Employee Name</th>
                                                <th>Month / Year</th>                               
                                                <th>Total PT Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $z=1;
                                                $ttl_taxamt = 0;
                                                foreach($pt_deduction_list as $row){ 
                                                    $month = value_by_id("tblmonths", $row->month, "month_name");
                                                    $yearmonth = "<span>".$month." / ".$row->year."</span>";
                                                    $ttlamount = $row->pt_amount;
                                                    $ttl_taxamt += $row->pt_amount;
                                            ?>                                                                                      
                                                    <tr>
                                                        <td><?php echo $z++;?></td>
                                                        <td><?php echo get_employee_fullname($row->employee_id);  ?></td>
                                                        <td><?php echo $yearmonth; ?></td>
                                                        <td><?php echo $row->pt_amount;?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>                  
                                        </tbody>
                                        <tfoot>
                                            <tr style="background-color: #e7e9ed;">
                                                <td colspan="3" class="text-center"><h4 style="color:red;">TOTAL</h4></td>
                                                <td ><h4 style="color:red;"><?php echo number_format($ttl_taxamt, 2); ?></h4></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <?php } ?>        
                </div>
            </div>
        </form>
    </div>
    <div class="btn-bottom-pusher"></div>
</div>
</div>
<?php init_tail(); ?>

</body>
</html>