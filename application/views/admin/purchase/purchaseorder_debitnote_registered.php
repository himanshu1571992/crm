<?php
$session_id = $this->session->userdata();

init_head();
?>

<style>#address{margin: 0px 1.5px 0px 0px;height: 112px;width:100%;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>

<div id="wrapper">

    <div class="content accounting-template">

        <div class="row">



        <?php echo form_open($this->uri->uri_string(), array('id' => 'payment-form', 'class' => '_propsal_form proposal-form', 'enctype' => 'multipart/form-data')); ?>

            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">

                        <div class="row">

                            <div class="col-md-12">
                                <?php
                                $venderpayment = $this->db->query("SELECT SUM(ttl_amt) as total_amt FROM `tblvendorpayment` WHERE `vendor_id`= " . $purchaseorder_info->vendor_id . " AND `payment_behalf` = 1 ")->row();
                                ?>
                                <h3 style="text-align:center">Total On Account Amount : <span style="color:red">(<?php echo (!empty($venderpayment->total_amt) ? $venderpayment->total_amt : "0.00"); ?>/-)</span></h3>
                                <h3><?php echo $title; ?></h3>

                                <hr/>

                            </div>

                                <?php
//                                $po_paid_amount = get_po_paid_amount($purchaseorder_info->id);
//                                $bal_amount = ($purchaseorder_info->totalamount - $po_paid_amount);
                                $bal_amount = (floatval($ttl_debit_amount) - floatval($paid_amount));
                                ?>


                            <div class="col-md-12">

                                <input type="hidden" id="po_id" name="po_id" value="<?php echo $purchaseorder_info->id; ?>">
                                <div class="form-group col-md-4">    
                                    <label for="reference_no" class="control-label">PO Amount</label>
                                    <input type="text" readonly="" class="form-control" value="<?php echo (isset($ttl_debit_amount)) ? number_format($ttl_debit_amount, 2) : "0.00"; ?>">       
                                </div>

                                <div class="form-group col-md-4">    
                                    <label for="reference_no" class="control-label">Paid Amount</label>
                                    <input type="text" readonly="" class="form-control" value="<?php echo number_format($paid_amount, 2); ?>">       
                                </div>

                                <div class="form-group col-md-4"> 
                                    <label for="bal_amount" class="control-label"> Balance Amount</label>
                                    <input type="text" readonly="" id="bal_amount" name="bal_amount" class="form-control" required value="<?php echo number_format($bal_amount, 2); ?>"> 
                                </div>
                            </div>    
                            <div class="col-md-12">
<!--                                <div class="form-group col-md-4"> 
                                    <label for="status" class="control-label"><small class="req text-danger">* </small>Payment Type</label>
                                    <select class="form-control selectpicker" required="" data-live-search="true" name="payment_type">
                                        <option value=""></option>
                                        <option value="1">Advance payment against PO/Proforma</option>
                                        <option value="2">Advance payment against material readiness</option>
                                        <option value="3">Against delivery</option>
                                        <option value="4">Against MR</option>
                                    </select>
                                </div>-->
                                <div class="form-group col-md-4"> 
                                    <label for="percentage" class="control-label"> <small class="req text-danger">* </small> Percent</label>
                                    <input type="text" id="percentage" name="percentage" class="form-control" onkeypress="return isNumberKey(event)" required value=""> 
                                </div>
                                <div class="form-group col-md-4"> 
                                    <label for="amount" class="control-label"> <small class="req text-danger">* </small> Amount</label>
                                    <input type="text" id="amount" name="amount" class="form-control" required value=""> 
                                </div>
                                <div class="col-md-4" style="margin-bottom:2%;">
                                    <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>
                                    <select onchange="staffdropdown()" required="" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assignid[]">

                                        <?php
                                        if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                            foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                                ?>
                                                <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                                    <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                                    <?php
                                                    foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                        ?>
                                                        <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php
                                                        if (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) {
                                                            echo'selected';
                                                        }
                                                        ?>><?php echo $singstaff['firstname'] ?></option>
                                                            <?php }
                                                            ?>
                                                </optgroup>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <input type="hidden" value="<?php echo $purchaseorder_info->id; ?>" name="po_id">
<!--                                <div class="form-group col-md-4"> 
                                    <label for="status" class="control-label"><small class="req text-danger">* </small>Payment By</label>
                                    <select class="form-control selectpicker" disabled="" required="" data-live-search="true" name="payment_by">
                                        <option value="3" selected="selected">Debit Note</option>
                                    </select>
                                </div>-->
                                <div class="form-group col-md-12">
                                    <label for="remark" class="control-label">Remark</label>
                                    <textarea id="remark" rows="5" name="remark" class="form-control"></textarea>
                                </div>



                            </div>



                        </div>

<!--                        <div id="get_data_div" class=" bottom-transaction text-right">

                            <button type="button" id="get_data" class="btn btn-info mleft10 ">Get Data</button>

                        </div>-->



                        <div class="btn-bottom-toolbar bottom-transaction text-right">

                            <!-- <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">Submit Payment</button> -->

                            <!--<button class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">Send Approval</button>-->
                            <a href="javascript:void(0);" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">Send Approval</a>

                        </div>

                    </div>

                </div>



            </div>


            <div id="debitnote_table" class="col-md-12">

                <?php
                    //$po_debitnote = $this->db->query("SELECT * FROM `tblpurchasedabitnote` as pdn LEFT JOIN `tblpurchasechallanreturn` as pcr ON pcr.id = pdn.parchasechallanreturn_id WHERE pcr.vendor_id = '".$purchaseorder_info->vendor_id."' AND pdn.complete = 0")->result();
                    $po_debitnote = $this->db->query("SELECT * FROM `tblpurchasedabitnote`  WHERE vender_id = '".$purchaseorder_info->vendor_id."' AND complete = 0")->result();
                    if(!empty($po_debitnote)){
                ?>
                <div class="panel_s">
                        <div class="panel-body">
                            <div class="modal-body">
                                <div style="padding:5px;margin-bottom:5%;">
                                    <h4 class="modal-title pull-left">Add Debit Note Detials</h4>
                                </div>
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
                                    <thead>
                                        <tr>
                                            <th width="10%" align="center">S.No.</th>
                                            <th width="20%" align="center">Debit No.</th>
                                            <th width="20%" align="center">Balance Amt</th>
                                            <th width="20%" align="center">Payble Amount</th>
                                            <th width="10%" align="center">Clear Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable" style="font-size:15px;">
                                        <?php
                                        foreach ($po_debitnote as $key => $row) {

                                            $paid_amt = $this->db->query("SELECT COALESCE(sum(pdr.amount),0) as ttl_amt FROM `tblpurchasedebitnoteregistered` as pdr LEFT JOIN `tblpurchaseorderpayments` as pop ON pdr.payment_id = pop.id WHERE pdr.`debitnote_id` = " . $row->id . " AND pdr.status = 1 AND pop.status in (0,1)")->row()->ttl_amt;
                                            $balance_amt = ($row->totalamount - $paid_amt);
                                            ?>
                                        <input type="hidden" value="<?php echo $row->id; ?>" name="debitnote_id[]">
                                        <input type="hidden" value="<?php echo $purchaseorder_info->id; ?>" name="po_id">
                                        <tr class="main">  
                                            <td width="10%" align="center"><?php echo ++$key; ?></td>
                                            <td width="20%" align="center"><a href="<?php echo base_url("admin/purchasechallanreturn/download_debitnotepdf/" . $row->id); ?>" target="_blank"><?php echo 'PDN-' . str_pad($row->id, 4, '0', STR_PAD_LEFT) . ' - (' . _d($row->date) . ')'; ?></a></td>
                                            <td width="20%" align="center"><?php echo number_format($balance_amt, 2); ?></td> 
                                            <td width="20%" align="center">
                                                <input class="form-control debitnote_amt" type="text" name="<?php echo 'amount_' . $row->id; ?>" value="0">
                                            </td>
                                            <td width="10%" align="center"><input type="checkbox" value="1" name="<?php echo 'clear_'.$row->id; ?>" ></td>  
                                        </tr>  
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>


<?php echo form_close(); ?>



        </div>

<?php init_tail(); ?>

<script type="text/javascript">
    $(document).on('keyup', '#percentage', function () {
        var percentage = $(this).val();
        if (percentage > 100) {
            $(this).val("");
            $("#amount").val("0.00");
        } else {
            var bal_amt = "<?php echo $bal_amount; ?>";
            //Calculate the percent.
            var final_amt = Math.round((percentage / 100) * bal_amt);
            $("#amount").val(final_amt);
        }
    });

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    $(document).on("keyup", "#amount", function(){
            var amt = $(this).val();
            var bal_amt = "<?php echo $bal_amount; ?>";
            var final_amt = (amt * 100) / bal_amt;
            $("#percentage").val(final_amt.toFixed(2));
        });
</script>

<!--<script type="text/javascript">

    $(document).on('click', '#get_data', function () {

        var po_id = $('#po_id').val();

        var amount = $('#amount').val();

        if (po_id != '') {

            if (amount != '') {

                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('admin/purchase/get_purchasedebitnote_table'); ?>",
                    data: {'po_id': po_id},
                    success: function (response) {

                        if (response != '') {
                            $('#debitnote_table').html(response);
                        }
                    }
                })
            } else {
                alert('Please Enter Amount!');
            }
        }
    });

</script>-->
<script>
    $(".transaction-submit").on("click", function(event){
        event.preventDefault();
        var ttl_amt = $("#amount").val();
        
        if (ttl_amt != ""){
            
            var pamt = 0;
            var debitnote_amt = $(".debitnote_amt").val();
            $(".debitnote_amt").each(function () {
                pamt += parseFloat($(this).val());
            });
            if (pamt > 0){
                if (ttl_amt != pamt){
                    alert("Payble amount not match with amount");
                }else{
                    $("#payment-form").submit();
                }
            }else{
                alert("Please Enter Payble Amount");
            }
            
        }else{
            alert("Please Enter Amount");
        }
    });
</script>
</body>

</html>

