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
                                        <label for="challan_no" class="control-label"><u class="text-danger">Challan No :</u></label>
                                        <p><?php 
                                            echo (!empty($pf_challan_info->challan_no)) ? $pf_challan_info->challan_no : '--';
                                        ?></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="date" class="control-label"><u class="text-danger">Challan Date :</u></label>
                                        <p><?php 
                                            echo (!empty($pf_challan_info->challan_date)) ? _d($pf_challan_info->challan_date) : '--';
                                        ?></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="date" class="control-label"><u class="text-danger">Payment Date :</u></label>
                                        <p><?php 
                                            echo (!empty($pf_challan_info->payment_date)) ? _d($pf_challan_info->payment_date) : '--';
                                        ?></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="Interested_late_fees_payment" class="control-label">&nbsp;<u class="text-danger">Interested Late Fees Payment :</u></label>
                                        <p><?php 
                                            if ($pf_challan_info->Interested_late_fees_payment == "1"){
                                                echo "<span class='btn-sm btn-success'>Yes</span>";
                                            }else{
                                                echo "<span class='btn-sm btn-danger'>No</span>";
                                            }
                                        ?></p>
                                    </div>
                                    
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group col-md-3">
                                        <label for="amount" class="control-label"><u class="text-danger">Employee Contribution :</u></label>
                                        <p><?php 
                                            echo (!empty($pf_challan_info->employee_contribution)) ? $pf_challan_info->employee_contribution : '--';
                                        ?></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="amount" class="control-label"><u class="text-danger">Employer Contribution :</u></label>
                                        <p><?php 
                                            echo (!empty($pf_challan_info->employer_contribution)) ? $pf_challan_info->employer_contribution : '--';
                                        ?></p>
                                    </div>
                                    <?php  if ($pf_challan_info->challan_for == '1'){ ?>
                                    <div class="form-group col-md-3">
                                        <label for="amount" class="control-label"><u class="text-danger">PF Admin :</u></label>
                                        <p><?php 
                                            echo (!empty($pf_challan_info->pf_admin)) ? $pf_challan_info->pf_admin : '--';
                                        ?></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="amount" class="control-label"><u class="text-danger">PF Edli :</u></label>
                                        <p><?php 
                                            echo (!empty($pf_challan_info->pf_edli)) ? $pf_challan_info->pf_edli : '--';
                                        ?></p>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($pf_deduction_list)){ ?>
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if ($pf_challan_info->challan_for == '1'){ ?>
                                        <h4>PF Deduction List</h4>
                                    <?php } ?>   
                                    <?php if ($pf_challan_info->challan_for == '2'){ ?>
                                        <h4>ESIC Deduction List</h4>
                                    <?php } ?>    
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
                                                <th>Employee Contribution</th>                               
                                                <th>Employer Contribution</th>
                                                <?php if ($pf_challan_info->challan_for == '1'){ ?>
                                                    <th>PF Admin</th>
                                                    <th>PF Edli</th>
                                                    <th>Total PF Amount</th>
                                                <?php }else{ ?>
                                                    <th>Total ESIC Amount</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $z=1;
                                                $ttl_taxamt = 0;
                                                foreach($pf_deduction_list as $row){ 
                                                    $month = value_by_id("tblmonths", $row->month, "month_name");
                                                    $yearmonth = "<span>".$month." / ".$row->year."</span>";
                                                    $ttlamount = ($row->employee_contribution+$row->employer_contribution+$row->pf_admin+$row->pf_edli);
                                                    $ttl_taxamt += $ttlamount;
                                            ?>                                                                                      
                                                    <tr>
                                                        <td><?php echo $z++;?></td>
                                                        <td><?php echo get_employee_fullname($row->employee_id);  ?></td>
                                                        <td><?php echo $yearmonth; ?></td>
                                                        <td><?php echo $row->employee_contribution;?></td>
                                                        <td><?php echo $row->employer_contribution;?></a></td>
                                                        <?php if ($pf_challan_info->challan_for == '1'){ ?>
                                                            <td><?php echo $row->pf_admin;?></td>
                                                            <td><?php echo $row->pf_edli;?></td>
                                                        <?php } ?>
                                                        <td><?php echo $ttlamount; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>                  
                                        </tbody>
                                        <tfoot>
                                            <tr style="background-color: #e7e9ed;">
                                                <td colspan="<?php echo ($pf_challan_info->challan_for == '1') ? 7 : 5; ?>" class="text-center"><h4 style="color:red;">TOTAL</h4></td>
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