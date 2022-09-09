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
                                            echo (!empty($tds_challan_info->challan_no)) ? $tds_challan_info->challan_no : '--';
                                        ?></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="date" class="control-label"><u class="text-danger">Challan Date :</u></label>
                                        <p><?php 
                                            echo (!empty($tds_challan_info->date)) ? _d($tds_challan_info->date) : '--';
                                        ?></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="amount" class="control-label"><u class="text-danger">Amount :</u></label>
                                        <p><?php 
                                            echo (!empty($tds_challan_info->amount)) ? $tds_challan_info->amount : '--';
                                        ?></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="bsr_code" class="control-label"><u class="text-danger">BSR Code :</u></label>
                                        <p><?php 
                                            echo (!empty($tds_challan_info->bsr_code)) ? $tds_challan_info->bsr_code : '--';
                                        ?></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group col-md-3">
                                        <label for="section_of_tds" class="control-label"><u class="text-danger">Section Of TDS :</u></label>
                                        <p><?php 
                                            echo (!empty($tds_challan_info->section_of_tds)) ? value_by_id("tbltdssections", $tds_challan_info->section_of_tds, "code").' - '.value_by_id("tbltdssections", $tds_challan_info->section_of_tds, "name") : '--';
                                        ?></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="tax_applicable" class="control-label"><u class="text-danger">Tax Applicable :</u></label>
                                        <p><?php 
                                            if ($tds_challan_info->tax_applicable > 0){
                                                if ($tds_challan_info->tax_applicable == "1"){
                                                    echo "(0020) Company Deductees";
                                                }else{
                                                    echo "(0021) Non-Company Deductees";
                                                }
                                            }
                                        ?></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="type_of_payment" class="control-label"><u class="text-danger">Type of Payment :</u></label>
                                        <p><?php 
                                            if ($tds_challan_info->type_of_payment > 0){
                                                if ($tds_challan_info->type_of_payment == "1"){
                                                    echo "(200) TDS/TCS Payable by Taxpayer";
                                                }else{
                                                    echo "(400) TDS/TCS Regular Assessment";
                                                }
                                            }
                                        ?></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="Interested_late_fees_payment" class="control-label">&nbsp;<u class="text-danger">Interested Late Fees Payment :</u></label>
                                        <p><?php 
                                            if ($tds_challan_info->Interested_late_fees_payment == "1"){
                                                echo "<span class='btn-sm btn-success'>Yes</span>";
                                            }else{
                                                echo "<span class='btn-sm btn-danger'>No</span>";
                                            }
                                        ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($tds_deduction_list)){ ?>
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>TDS Deduction List</h4>
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
                                                <th>Name of Party</th>
                                                <th>Date of Trasaction</th>
                                                <th>PAN No of Party</th>
                                                <th>Taxable Amount</th>                               
                                                <th>TDS Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $z=1;
                                                $ttl_taxamt = 0;
                                                foreach($tds_deduction_list as $row){ 
                                                    $date1=date_create(date("Y-m-d"));
                                                    $date2=date_create($row->date);
                                                    $diff=date_diff($date1, $date2);
                                                    $days = $diff->format("%a");
                                                    $newrowflag = '';
                                                    if ($days === '0'){
                                                        $newrowflag = '<span class="badge badge-secondary" style="background-color:red">New</span>';
                                                    }
                                                    $yearmonth = "";
                                                    if ($row->rel_type == "3"){
                                                        $salarylog = $this->db->query("SELECT month,year FROM tblsalarypaidlog WHERE id='".$row->rel_id."'")->row();
                                                        $month = value_by_id("tblmonths", $salarylog->month, "month_name");
                                                        $yearmonth = "<br><span>(".$month."-".$salarylog->year.")</span>";
                                                    }
                                                    $ttl_taxamt += $row->tds_amount;
                                            ?>                                                                                      
                                                    <tr>
                                                        <td><?php echo $z++;?></td>
                                                        <td><?php echo cc($row->party_name).' '.$newrowflag.$yearmonth;  ?></td>
                                                        <td><?php echo _d($row->date);?></td>
                                                        <td>
                                                            <?php
                                                                echo (!empty($row->pan_no)) ? $row->pan_no : '--';
                                                            ?>
                                                        </td>
                                                        <td><?php echo $row->taxable_amount;?></td>
                                                        <td><?php echo $row->tds_amount;?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>                  
                                        </tbody>
                                        <tfoot>
                                            <tr style="background-color: #e7e9ed;">
                                                <td colspan="5" class="text-center"><h4 style="color:red;">TOTAL</h4></td>
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