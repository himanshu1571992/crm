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
  fieldset {
    border: 2px solid black;
    width: 100%;
    /* background: #252733; */
    padding: 3px;
  }
  fieldset legend {
    /* background: #CCA383; */
    padding: 6px;
    font-weight: bold;
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
$bal_amount = ($purchaseorder_info->totalamount - $po_paid_amount);

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
                                    <label for="bal_amount" class="control-label"> Balance Amount</label>
                                    <input type="text" readonly="" id="bal_amount" name="bal_amount" class="form-control" required value="<?php echo $bal_amount; ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-4">
                                    <label for="status" class="control-label"><small class="req text-danger">* </small>Payment Type</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="payment_type">
                                        <option value=""></option>
                                        <option value="1">Advance payment against PO/Proforma</option>
                                        <option value="2">Advance payment against material readiness</option>
                                        <option value="3">Against delivery</option>
                                        <option value="4">Against MR</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="amount" class="control-label"> <small class="req text-danger">* </small> Amount</label>
                                    <input type="text" readonly id="amount" name="amount" class="form-control" required value="0">
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
                                <input type="hidden" value="4" name="payment_by"><!-- for payment by adjustment -->
                                <div class="form-group col-md-4">
                                    <label for="remark" class="control-label">Remark</label>
                                    <textarea id="remark" rows="1" name="remark" class="form-control"></textarea>
                                </div>
                              </div>
                            </div>





                        <div class="btn-bottom-toolbar bottom-transaction text-right">

                            <!-- <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">Submit Payment</button> -->

                            <button class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">Send Approval</button>

                        </div>

                </div>

            </div>
            <div class="row">
              <div id="refundadjustment_table" class="col-md-12">

                  <?php
                      $po_adjustment = $this->db->query("SELECT * FROM `tblpurchaseorderrefundpayment` WHERE `vendor_id` = '".$purchaseorder_info->vendor_id."' AND `balance_amount` > 0 AND `status` = 1")->result();
                      if(!empty($po_adjustment)){
                  ?>
                  <div class="panel_s">
                          <div class="panel-body">
                              <div class="modal-body">
                                  <div style="padding:5px;margin-bottom:5%;">
                                      <h4 class="modal-title pull-left">Last Adjustment Request's</h4>
                                  </div>
                                  <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
                                      <thead>
                                          <tr>
                                              <th width="10%" align="center">S.No.</th>
                                              <th width="20%" align="center">PO No.</th>
                                              <th width="20%" align="center">Balance Amt</th>
                                              <th width="20%" align="center">Payble Amount</th>
                                          </tr>
                                      </thead>
                                      <tbody class="ui-sortable" style="font-size:15px;">
                                          <?php
                                          $kp = 0;
                                          foreach ($po_adjustment as $key => $row) {

                                              $po_number = value_by_id("tblpurchaseorder", $purchaseorder_info->id, "number");
                                              ?>
                                          <input type="hidden" value="<?php echo $row->id; ?>" name="adjustment_data[<?php echo$kp; ?>][refund_id]">
                                          <input type="hidden" value="<?php echo $purchaseorder_info->id; ?>" name="po_id">
                                          <tr class="main">
                                              <td width="10%" align="center"><?php echo ++$key; ?></td>
                                              <td width="20%" align="center"><a href="<?php echo base_url("admin/purchase/download_pdf/" . $purchaseorder_info->id); ?>" target="_blank"><?php echo $po_number . ' - (' . _d($row->payment_date) . ')'; ?></a></td>
                                              <td width="20%" align="center"><?php echo number_format($row->balance_amount, 2); ?></td>
                                              <td width="20%" align="center">
                                                  <input class="form-control adjustment_amt" data-bal="<?php echo $row->balance_amount; ?>" type="text" name="adjustment_data[<?php echo$kp; ?>][amount]" value="0">
                                              </td>
                                          </tr>
                                          <?php
                                          $kp++;
                                      }
                                      ?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  <?php } ?>
              </div>
            </div>

          </div>
          <?php echo form_close(); ?>
        </div>
    <?php init_tail(); ?>
    <script type="text/javascript">
        $(document).on("keyup", ".adjustment_amt", function(){
            var totalamt = 0;
            $.each($(".adjustment_amt"), function(){
                var amt = $(this).val();
                if (amt > 0){
                    var bal_amt = $(this).data("bal");
                    if (parseInt(bal_amt) >= parseInt(amt)){
                      totalamt = parseInt(totalamt)+parseInt(amt);
                    }else{
                      $(this).val("");
                    }
                }
            });
            $("#amount").val(totalamt);
        });
        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        $(document).on("keyup", "#amount", function(){
            var amt = $(this).val();
            var bal_amt = "<?php echo $bal_amount; ?>";
            var final_amt = Math.round((amt * 100) / bal_amt);
            $("#percentage").val(final_amt.toFixed(2));
        });
    </script>
</body>

</html>
