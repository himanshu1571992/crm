<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'client-form', 'class' => 'client-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="row">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin">Payment for Invoice <?php echo format_invoice_number($invoice->id); ?></h4>
                    <hr class="hr-panel-heading">
                        <div class="lead-view" id="leadViewWrapper">
                          <div class=" lead-information-col">
                     <div class="col-md-6">
                       <h4 class="no-margin font-medium-xs bold">Amount Received</h4>
                            <p class="bold font-medium-xs lead-name">
                            <?php 
                            echo $payment->amount; 
                            ?>
                            </p>
                     </div>
                           <div class="col-md-6">
                             <h4 class="no-margin font-medium-xs bold">Payment Date</h4>
                            <p class="bold font-medium-xs"><?php echo _d($payment->date); ?></p>
                           
                           </div>
                           <div class="col-md-6">
                             <h4 class="no-margin font-medium-xs bold">Payment Mode</h4>
                            <p class="bold font-medium-xs"><?php if(!empty($payment->paymentmode) && $payment->paymentmode == 1){ echo 'Cheque'; }
                            elseif(!empty($payment->paymentmode) && $payment->paymentmode == 2){
                              echo "NEFT";
                            }elseif (!empty($payment->paymentmode) && $payment->paymentmode == 3) {
                              echo "Cash";
                            } ?></p>
                            
                           </div>
                           <?php if (!empty($payment->bank_id)) { 
                              ?>
                           <div class="col-md-6">
                             <h4 class="no-margin font-medium-xs bold">Bank</h4>
                            <p class="bold font-medium-xs">
                            <?php
                             foreach ($bank_info as $bank_key => $bank_value) {
                             if(!empty($payment->bank_id) && $payment->bank_id == $bank_value->id) echo cc($bank_value->name); ?><?php } ?></p>
                           </div>
                           <?php }  ?>
                           <div class="col-md-6">
                             <h4 class="no-margin font-medium-xs bold">Reference No</h4>
                            <p class="bold font-medium-xs"><?php echo $client_payment->reference_no; ?></p>
                           
                           </div>
                           <div class="col-md-6">
                             <h4 class="no-margin font-medium-xs bold">TDS %</h4>
                            <p class="bold font-medium-xs"><?php echo $payment->tds; ?></p>
                           
                           </div>
                           <div class="col-md-6">
                             <h4 class="no-margin font-medium-xs bold">TDS Amount</h4>
                            <p class="bold font-medium-xs"><?php echo $payment->tds_amt; ?></p>
                           
                           </div>
                           <div class="col-md-6">
                             <h4 class="no-margin font-medium-xs bold">Note</h4>
                            <p class="bold font-medium-xs"><?php echo $payment->note; ?></p>
                           
                           </div>
                           <div class="col-md-6">
                             <h4 class="no-margin font-medium-xs bold">Total Amount</h4>
                            <p class="bold font-medium-xs"><?php echo format_money($payment->amount,$invoice->symbol); ?></p>
                           
                           </div>
                          </div>
                             <hr>
        <br>                
        <!-- <h4 class="text-center"><u>Payment For</u></h4> -->
        <div class="col-md-12 mtop30">
                  <h4><?php echo _l('payment_for_string'); ?></h4>
                  <div class="table-responsive">
                    <table class="table table-borderd table-hover">
                      <thead>
                        <tr>
                          <th><?php echo _l('payment_table_invoice_number'); ?></th>
                          <th><?php echo _l('payment_table_invoice_date'); ?></th>
                          <th><?php echo _l('payment_table_invoice_amount_total'); ?></th>
                          <th><?php echo _l('payment_table_payment_amount_total'); ?></th>
                          <?php if($invoice->status != 2 && $invoice->status != 5) { ?>
                          <th><span class="text-danger"><?php echo _l('invoice_amount_due'); ?></span></th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <?php if(!empty($invoice)) { ?>
                      <tbody>
                        <tr>
                          <td><?php echo format_invoice_number($invoice->id); ?></td>
                          <td><?php echo _d($invoice->date); ?></td>
                          <td><?php echo format_money($invoice->total,$invoice->symbol); ?></td>
                          <td><?php echo format_money($payment->amount,$invoice->symbol); ?></td>
                          <?php if($invoice->status != 2 && $invoice->status != 5) { ?>
                          <td class="text-danger">
                          <?php echo format_money(get_invoice_total_left_to_pay($invoice->id, $invoice->total), $invoice->symbol); ?>
                          </td>
                          <?php } ?>
                        </tr>
                      </tbody>
                      <?php } ?>
                    </table>
                  </div>
                </div> 
                            
                    </div>
                </div>
            </div>
          
          </div> 
            <?php echo form_close(); ?>

        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>

</body>
</html>
