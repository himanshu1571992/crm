<?php

$session_id = $this->session->userdata();

init_head();

?>

<style>
  #address{
    margin: 0px 1.5px 0px 0px;
    height: 112px;
    width:100%;
  }
  .red{
    border:1px solid red !important;
    background-color:red !important;
    color:#fff !important;
  }
  .yellow{
    border:1px solid yellow !important;
    background-color:yellow !important;
    color:black  !important;
  }
  .blue{
      border:1px solid blue !important;
      background-color:blue !important;
      color:#fff !important;
  }
  .green{
      border:1px solid green !important;
      background-color:green !important;
      color:#fff !important;
  }
  .orange{
    border:1px solid orange !important;
    background-color:orange !important;
    color:#fff !important;
  }
  </style>

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
                                    $venderpayment = $this->db->query("SELECT SUM(ttl_amt) as total_amt FROM `tblvendorpayment` WHERE `vendor_id`= ".$purchaseorder_info->vendor_id." AND `payment_behalf` = 1 ")->row();
                                ?>
                                <h3 style="text-align:center">Total On Account Amount : <span style="color:red">(<?php echo (!empty($venderpayment->total_amt) ? $venderpayment->total_amt : "0.00"); ?>/-)</span></h3>
                                <h3><?php echo $title; ?></h3>
                                <hr/>
                            </div>
                            <?php
                                $po_paid_amount = get_po_paid_amount($purchaseorder_info->id);
                                $bal_amount = ($po_paid_amount - $purchaseorder_info->totalamount);
                            ?>
                            <div class="col-md-12">
                                <div class="form-group col-md-4">
                                    <label for="reference_no" class="control-label">PO Amount</label>
                                    <input type="text" readonly="" class="form-control" value="<?php echo $purchaseorder_info->totalamount; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="reference_no" class="control-label">Paid Amount</label>
                                    <input type="text" readonly="" class="form-control" value="<?php echo $po_paid_amount; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="bal_amount" class="control-label"> Amount</label>
                                    <input type="text" readonly="" id="amount" name="amount" class="form-control" required value="<?php echo $bal_amount; ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-4">
                                    <label for="Type" class="control-label">Refund Type <small class="req text-danger">* </small></label>
                                    <select class="form-control selectpicker refund_type" id="refund_type" data-live-search="true" name="type">
                                        <option value="">--Select One--</option>
                                        <option value="1">Refund Payment</option>
                                        <option value="2">Adjust Payment In Next PO</option>
                                    </select>
                                </div>
                                <div class="col-md-4" style="margin-bottom:2%;">
                                    <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?>  <small class="req text-danger">* </small></label>
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
                                <div class="form-group col-md-4 payment_date_div">
                                    <div class="form-group" app-field-wrapper="date">
                                      <label for="date" class="control-label">Payment Date <small class="req text-danger">* </small></label>
                                      <div class="input-group date">
                                        <input type="text" id="date" name="date" class="form-control datepicker" value="<?php echo date("d/m/Y");?>">
                                        <div class="input-group-addon">
                                          <i class="fa fa-calendar calendar-icon"></i>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 refund_to_div" hidden>
                                <div class="form-group col-md-4 select-placeholder">
                                    <label for="refundto" class="control-label"><small class="req text-danger">* </small> Refund To </label>
                                    <select class="form-control selectpicker" id="refund_to"  name="refund_to" >
                                        <option value="">--Select One--</option>
                                        <option value="1">Company Account</option>
                                        <option value="2">Petty Cash</option>
                                    </select>
                                </div>  
                                <div class="pettycash_div" hidden>
                                    <div class="form-group col-md-4 " >
                                        <label for="pettycash_id" class="control-label"><small class="req text-danger">* </small> Petty Cash</label>
                                        <select class="form-control pettycash_id selectpicker" id="pettycash_id"  name="pettycash_id" data-live-search="true">
                                            <option value="">--Select One--</option>
                                            <?php
                                            if (!empty($pettycash_list)) {
                                                foreach ($pettycash_list as $pettycash_key => $pettycash_value) {
                                                    $pettycash_manager = get_employee_name($pettycash_value->staff_id);
                                                    ?>
                                                    <option value="<?php echo $pettycash_value->id; ?>"<?php echo (isset($clientpayment_info) && $clientpayment_info->pettycash_id == $pettycash_value->id) ? "selected":"";?> ><?php echo cc($pettycash_value->department_name).' - '.$pettycash_manager; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4" style="margin-bottom:2%;">
                                        <label for="city_id" class="control-label"><?php echo 'Petty Cash Assign'; ?>  <small class="req text-danger">* </small></label>
                                        <select onchange="staffdropdown1()" class="form-control selectpicker" multiple data-live-search="true" id="assignpettycash" name="pettycashassignid[]">
                                            <?php
                                            if (isset($pettycashassign) && count($pettycashassign) > 0) {
                                                foreach ($pettycashassign as $Staffgroup_key => $Staffgroup_value) {
                                                    ?>
                                                    <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                                        <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                            <?php
                                                    foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                            ?>
                                                            <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" ><?php echo $singstaff['firstname'] ?></option>
                                            <?php   } ?>
                                                    </optgroup>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-12 refund_account_div" hidden>

                              <div class="form-group col-md-4">
                                  <label for="reference_no" class="control-label">Reference No </label>
                                  <input type="text" id="reference_no" name="reference_no" class="form-control">
                              </div>
                                <div class="form-group col-md-2 select-placeholder payment_mode_div">
                                    <label for="payment_mode" class="control-label">Payment Mode </label>
                                    <select class="form-control selectpicker" id="payment_mode"  name="payment_mode" >
                                        <option value="">--Select One--</option>
                                        <option value="1">Cheque</option>
                                        <option value="2">NEFT</option>
                                        <option value="3">Cash</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="paymenttype" class="control-label">Payment Types</label>
                                    <select class="form-control selectpicker" id="paymenttype"  name="paymenttype" data-live-search="true">
                                        <option value="">--Select One--</option>
                                        <?php
                                        if (!empty($paytype_info)) {
                                            foreach ($paytype_info as $pay_key => $pay_value) {
                                                ?>
                                                <option value="<?php echo $pay_value->id; ?>" <?php echo (isset($clientpayment_info) && $clientpayment_info->payment_type_id == $pay_value->id) ? "selected":"";?>><?php echo cc($pay_value->name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="bank" class="control-label">Bank</label>
                                    <select class="form-control bank_id selectpicker" id="bank_id"  name="bank_id" data-live-search="true">
                                        <option value="">--Select One--</option>
                                        <?php
                                        if (!empty($bank_info)) {
                                            foreach ($bank_info as $bank_key => $bank_value) {
                                                ?>
                                                <option value="<?php echo $bank_value->id; ?>"<?php echo (isset($clientpayment_info) && $clientpayment_info->bank_id == $bank_value->id) ? "selected":"";?> ><?php echo cc($bank_value->name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="cheque_div" hidden>
                                <br>
                                <div class="form-group col-md-4 select-placeholder">
                                    <label for="chaque_for" class="control-label"><small class="req text-danger">* </small> Cheque For </label>
                                    <select class="form-control selectpicker" id="chaque_for"  name="chaque_for" >
                                        <option value="">--Select One--</option>
                                        <option value="1">Post Date</option>
                                        <option value="2">Current Date</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cheque_no" class="control-label"> <small class="req text-danger">* </small> Cheque No.</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           <span id="prefix">CHQ-</span>
                                        </span>
                                        <input type="text" id="cheque_no" onkeyup="nospaces(this)" name="cheque_no" class="form-control onlynumbers1" value="<?php echo (isset($clientpayment_info)) ? $clientpayment_info->cheque_no:"";?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo render_date_input('cheque_date', 'Cheque Date', _d(date('Y-m-d'))); ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-8">
                                    <label for="remark" class="control-label">Remark  <small class="req text-danger">* </small></label>
                                    <textarea id="remark" required rows="1" name="remark" class="form-control"></textarea>
                                </div>


                                <input type="hidden" value="<?php echo $purchaseorder_info->id; ?>" name="po_id">
                                <input type="hidden" value="<?php echo $purchaseorder_info->vendor_id; ?>" name="vendor_id">
                        </div>

                    </div>
                        <div class="btn-bottom-toolbar bottom-transaction text-right">
                            <!-- <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">Submit Payment</button> -->
                            <button class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">Send Approval</button>
                        </div>
                </div>
            </div>
	       </div>
            <?php echo form_close(); ?>
    </div>

    <?php init_tail(); ?>
    <script type="text/javascript">
        $(document).on('change', "#refund_type", function(){
            var refund_type = $(this).val();
            
            if (refund_type == 1){
                $(".refund_to_div").show();
                $("#refund_to").attr("required", "");
                
                $('.selectpicker').selectpicker('refresh');
            }else{
                $(".refund_to_div").hide();
                $("#payment_mode").removeAttr("required");
                $("#paymenttype").removeAttr("required");
                $("#bank_id").removeAttr("required");
                $("#reference_no").removeAttr("required");
                $("#refund_to").removeAttr("required");
                $(".refund_account_div").hide();
            }
        });
        $(document).on('change', "#refund_to", function(){
            var type = $(this).val();
            if (type == 1){
               // $("#payment_mode").attr("required", "");
               // $("#paymenttype").attr("required", "");
               // $("#bank_id").attr("required", "");
                //$("#reference_no").attr("required", "");
                $(".refund_account_div").show();
                $(".pettycash_div").hide();
                $("#pettycash_id").removeAttr("required");
                $("#assignpettycash").removeAttr("required");
            }else{
                $("#pettycash_id").attr("required", "");
                $("#assignpettycash").attr("required", "");
                //$("#payment_mode").removeAttr("required");
               // $("#paymenttype").removeAttr("required");
               // $("#bank_id").removeAttr("required");
                //$("#reference_no").removeAttr("required");
                $(".refund_account_div").hide();
                $(".pettycash_div").show();
                $('#cheque_div').hide();
            }
        });

        $(document).on('keyup', '#percentage', function(){
            var percentage = $(this).val();
            if (percentage > 100){
                $(this).val("");
                $("#amount").val("0.00");
            }else{
                var bal_amt = "<?php echo $bal_amount; ?>";
                //Calculate the percent.
                var final_amt = Math.round((percentage / 100) * bal_amt);
                $("#amount").val(final_amt);
            }
	      });

        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
        function staffdropdown()
        {
            $.each($("#assign option:selected"), function () {
                var select = $(this).val();
                $("optgroup." + select).children().attr('selected', 'selected');
            });
            $('.selectpicker').selectpicker('refresh');
            $.each($("#assign option:not(:selected)"), function () {
                var select = $(this).val();
                $("optgroup." + select).children().removeAttr('selected');
            });
            $('.selectpicker').selectpicker('refresh');
        }
        function staffdropdown1()
        {
            $.each($("#assignpettycash option:selected"), function () {
                var select = $(this).val();
                $("optgroup." + select).children().attr('selected', 'selected');
            });
            $('.selectpicker').selectpicker('refresh');
            $.each($("#assignpettycash option:not(:selected)"), function () {
                var select = $(this).val();
                $("optgroup." + select).children().removeAttr('selected');
            });
            $('.selectpicker').selectpicker('refresh');
        }
        $(document).on("keyup", "#amount", function(){
            var amt = $(this).val();
            var bal_amt = "<?php echo $bal_amount; ?>";
            var final_amt = Math.round((amt * 100) / bal_amt);
            $("#percentage").val(final_amt.toFixed(2));
        });

        $(document).on('change', '#payment_mode', function() {
           var payemt_mode = $(this).val();
           if(payemt_mode == 1){
                $('#cheque_div').show();
           }else{
                $('#cheque_div').hide();
           }
        });

        $("#paymenttype").on("change", function(){
            var paytype = $(this).val();
            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('admin/invoice_payments/get_paymenttype_bank'); ?>",
                data    : {'paytype' : paytype},
                success : function(response){
                    if(response != ''){
                        $('#bank_id').html(response);
                        $('.selectpicker').selectpicker('refresh');
                    }
                }
            });
        });
    </script>
</body>

</html>
