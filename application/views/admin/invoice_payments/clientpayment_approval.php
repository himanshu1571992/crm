<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<!-- Modal Contact -->
<style>
    @media (max-width: 500px){
        .btn-bottom-toolbar {
            width: 100%
        }
    }    
    @media (max-width: 768px){
        .btn-bottom-toolbar {
            width: 100%
        }
    }     
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">
            
            <?php echo form_open($this->uri->uri_string(), array('id' => 'allot-item-form', 'class' => '_item_form allot-item-form')); ?>
            <div class="col-md-12">
            <div class="panel_s">
                <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?><?php echo (!empty($info) && $info['is_suspense_account'] == 1) ? " <span style='color:red;border:1px solid;padding:5px;'> Suspense Receipt </span>":""; ?></h4>
                    <hr class="hr-panel-heading">

                    <div class="row">
                      <?php if(!empty($info)){
                        $client_name = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$info['client_id']."' ")->row();
                        ?>
                        
                        <?php if (!empty($info) && $info['is_suspense_account'] == "0"){ ?>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label for="color" class="control-label">Client</label>
                                <input type="text" readonly="" class="form-control" value="<?php echo $client_name->client_branch_name; ?>">
                            </div>
                        </div>

                        <div class="form-group col-md-3" app-field-wrapper="on_behalf">
                            <div class="form-group">
                            <label for="amount" class="control-label">Payment On Behalf</label>
                                <select class="form-control selectpicker" id="paymentbehalf"  name="paymentbehalf" disabled="">
                                    <option value="">--Select One--</option>
                                    <option value="1" <?php if(!empty($info['payment_behalf']) && $info['payment_behalf'] == 1){ echo 'selected'; } ?>>On Account</option>
                                    <option value="2" <?php if(!empty($info['payment_behalf']) && $info['payment_behalf'] == 2){ echo 'selected'; } ?>>Against Invoice</option>
                                    <option value="3" <?php if(!empty($info['payment_behalf']) && $info['payment_behalf'] == 3){ echo 'selected'; } ?>>Against Debitnote</option>
                                </select>
                            </div>
                        </div> 
                        <?php } ?>
                        <div class="form-group <?php echo (!empty($info['is_suspense_account']) && $info['is_suspense_account'] == 1) ? 'col-md-6': 'col-md-3'; ?> " app-field-wrapper="on_behalf">
                            <div class="form-group">
                            <label for="amount" class="control-label">Payment Mode</label>
                                <select class="form-control selectpicker" id="paymentmode"  name="paymentmode" disabled="">
                                    <option value="">--Select One--</option>
                                    <option value="1" <?php if(!empty($info['payment_mode']) && $info['payment_mode'] == 1){ echo 'selected'; } ?>>Cheque</option>
                                    <option value="2" <?php if(!empty($info['payment_mode']) && $info['payment_mode'] == 2){ echo 'selected'; } ?>>NEFT</option>
                                    <option value="3" <?php if(!empty($info['payment_mode']) && $info['payment_mode'] == 3){ echo 'selected'; } ?>>Cash</option>
                                </select>
                            </div>
                        </div> 
                        
                        <?php
                         if($info['payment_mode'] == 1)
                         { ?>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="color" class="control-label">Cheque No.</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">

                                                <span id="prefix">CHQ-</span>

                                            </span>
                                            <input type="text" readonly="" class="form-control" value="<?php echo $info['cheque_no']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3" app-field-wrapper="chaque_for">
                                    <div class="form-group">
                                    <label for="amount" class="control-label">Cheque For</label>
                                        <select class="form-control selectpicker" id="chaque_for"  name="chaque_for" disabled="">
                                            <option value="">--Select One--</option>
                                            <option value="1" <?php if(!empty($info['chaque_for']) && $info['chaque_for'] == 1){ echo 'selected'; } ?>>Post Date</option>
                                            <option value="2" <?php if(!empty($info['chaque_for']) && $info['chaque_for'] == 2){ echo 'selected'; } ?>>Current Date</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="remark" class="control-label">Cheque Date</label>
                                        <input type="text" readonly="" class="form-control" value="<?php echo $info['cheque_date']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                         
                        <?php }
                        ?>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="remark" class="control-label">Payment Date</label>
                                        <input type="text" readonly="" class="form-control" value="<?php echo $info['date']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="remark" class="control-label">Remark</label>
                                        <input type="text" readonly="" class="form-control" value="<?php echo $info['remark']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="amount">
                                        <div class="form-group">
                                        <label for="amount" class="control-label">Amount</label>
                                            <input type="text" readonly="" class="form-control" value="<?php echo $info['ttl_amt']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <?php
                        if($info['payment_behalf'] == 1){
                        ?>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="remark" class="control-label">Service Type</label>
                                <select class="form-control selectpicker"  data-live-search="true" id="service_type" name="service_type" disabled="">

                                        <option value=""></option>

                                        <?php

                                        if (isset($service_type) && count($service_type) > 0) {

                                            foreach ($service_type as $service_type_key => $service_type_value) {

                                                ?>

                                                <option value="<?php echo $service_type_value['id'] ?>" <?php if(isset($info) && $info['service_type'] == $service_type_value['id']){echo 'selected';} ?>><?php echo cc($service_type_value['name']); ?></option>

                                                <?php

                                            }

                                        }

                                        ?>

                                </select>
                            </div>
                        </div>
                        <?php    
                        }
                        ?>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group col-md-3" app-field-wrapper="paymenttype">
                                    <div class="form-group">
                                    <label for="paymenttype" class="control-label">Payment Types</label>
                                        <select class="form-control selectpicker" id="paymenttype"  name="paymenttype" disabled="">
                                            <option value=""></option>
                                            <?php
                                                if (isset($pay_info) && count($pay_info) > 0) {
                                                    foreach ($pay_info as $pay_info_key => $pay_info_value) {
                                            ?>
                                                        <option value="<?php echo $pay_info_value['id'] ?>" <?php echo (isset($info) && $info['payment_type_id'] == $pay_info_value['id'])  ? 'selected':''; ?>><?php echo cc($pay_info_value['name']); ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3" app-field-wrapper="bank">
                                    <div class="form-group">
                                        <label for="amount" class="control-label">Bank</label>
                                        <select class="form-control selectpicker" id="bank"  name="bank_id" disabled="">
                                            <option value=""></option>

                                                <?php

                                                if (isset($bank_info) && count($bank_info) > 0) {

                                                    foreach ($bank_info as $bank_info_key => $bank_info_value) {

                                                        ?>

                                                        <option value="<?php echo $bank_info_value['id'] ?>" <?php if(isset($info) && $info['bank_id'] == $bank_info_value['id']){echo 'selected';} ?>><?php echo cc($bank_info_value['name']); ?></option>

                                                        <?php

                                                    }

                                                }

                                                ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3" app-field-wrapper="service_type">
                                    <div class="form-group">
                                    <label for="service_type" class="control-label">Reference No.</label>
                                        <input type="text" readonly="" class="form-control" value="<?php echo $info['reference_no']; ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="image" class="control-label">Image</label><br>
                                    <?php
                                        if (!empty($file_info)) {
                                            foreach ($file_info as $file_key) {
                                    ?>
                                            <a target="_blank" href="<?php echo base_url('uploads/payment/' . $info['id'] . '/' . $file_key->file_name); ?>" ><b><?php echo $file_key->file_name; ?></b></a> <br>       
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                                
                            </div>
                        </div>
                        
                        
                        
                        
                        <?php 
                        if($info['payment_behalf'] == 2)
                        { ?>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="superior_ids" class="control-label">Select Site</label>
                                    <select class="form-control selectpicker" name="superior_ids[]" id="superior_ids" multiple data-live-search="true" disabled="">
                                        <option value=""></option>
                                        <?php
                                 
                                        if (isset($stitemanager_info) && count($stitemanager_info) > 0) {
                                            foreach ($stitemanager_info as $value) {

                                                ?>
                                                <option value="<?php echo $value['id'] ?>" <?php echo (isset($Sitedata) && in_array($value['id'],$Sitedata) ) ? 'selected' : "" ?>><?php echo cc($value['name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="superior_ids" class="control-label">Select Invoice</label>
                            <select class="form-control selectpicker" name="superior_ids[]" id="superior_ids" multiple data-live-search="true" disabled="">
                                <option value=""></option>
                                <?php
                         
                                if (isset($invoice_info) && count($invoice_info) > 0) {
                                    foreach ($invoice_info as $value1) {

                                        ?>
                                        <option value="<?php echo $value1['id'] ?>" <?php echo (isset($invoicedata) && in_array($value1['id'],$invoicedata) ) ? 'selected' : "" ?>><?php echo cc($value1['number']); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            </div>
                        </div>
                        <?php }
                        ?>
                        <?php 
                        if($info['payment_behalf'] == 3)
                        { ?>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="superior_ids" class="control-label">Select Debitnote</label>
                                    <select class="form-control selectpicker" name="superior_ids[]" id="superior_ids" multiple data-live-search="true" disabled="">
                                        <option value=""></option>
                                        <?php
                                 
                                        if (isset($debitnote_info) && count($debitnote_info) > 0) {
                                            foreach ($debitnote_info as $value2) {

                                                ?>
                                                <option value="<?php echo $value2['id'] ?>" <?php echo (isset($debitnotedata) && in_array($value2['number'],$debitnotedata) ) ? 'selected' : "" ?>><?php echo cc($value2['number']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                
                            </div>
                        </div>
                    <?php } } ?>
                    
                    <?php 
                    if($info['payment_behalf'] == 2)
                    { ?>
                    <div class="col-md-12 mtop30">
                          <h4>Invoice Payment Detials</h4>
                          <div class="table-responsive">
                            <table class="table table-borderd table-hover">
                              <thead>
                                <tr>
                                  <th>Invoice No.</th>
                                  <th>TDS %</th>
                                  <th>TDS Amt</th>
                                  <th>Payble Amount</th>
                                </tr>
                              </thead>
                              <?php if(!empty($payment)) { ?>
                              <tbody>
                                <?php foreach ($payment as $key => $value) { ?>
                                <tr>
                                  <td><?php echo format_invoice_number($value->invoiceid); ?></td>
                                  <td><?php echo $value->tds; ?></td>
                                  <td><?php echo $value->tds_amt; ?></td>
                                  <td><?php echo $value->amount; ?>
                                  </td>
                                </tr> <?php } ?>
                              </tbody>
                              <?php } ?>
                            </table>
                          </div>
                    </div>
                    <?php } ?>
                    <?php 
                    if($info['payment_behalf'] == 3)
                    { ?>
                    <div class="col-md-12 mtop30">
                          <h4>Debitnote Payment Detials</h4>
                          <div class="table-responsive">
                            <table class="table table-borderd table-hover">
                              <thead>
                                <tr>
                                  <th>Debitnote No.</th>
                                  <th>TDS %</th>
                                  <th>TDS Amt</th>
                                  <th>Payble Amount</th>
                                </tr>
                              </thead>
                              <?php if(!empty($payment)) { ?>
                              <tbody>
                                <?php foreach ($payment as $key => $value) { ?>
                                <tr>
                                  <td><?php echo $value->debitnote_no; ?></td>
                                  <td><?php echo $value->tds; ?></td>
                                  <td><?php echo $value->tds_amt; ?></td>
                                  <td><?php echo $value->amount; ?>
                                  </td>
                                </tr> <?php } ?>
                              </tbody>
                              <?php } ?>
                            </table>
                          </div>
                    </div>
                    <?php } ?>
                    </div>

                    <?php 
                        if(empty($appvoal_info) OR (!empty($appvoal_info) && $appvoal_info->approve_status == 5)){
                           ?>
                           <div class="btn-bottom-toolbar bottom-transaction text-right">
                           <button type="submit" name="submit" value="5" style="background-color: #f9d306;color:#fff;" class="btn">On Hold</button>
                                <button type="submit" name="submit" value="4" style="background-color: #9d0b1a;color:#fff;" class="btn">Reconciliation</button>
                                 <button type="submit" name="submit" value="2" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Reject
                                </button>
                               <button type="submit" name="submit" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Approved
                                </button>
                            </div> 
                           <?php 
                        }
                        ?>
                </div>
            </div>
        </div>   
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Approve/Reject Remark</h4>
                            </div>
                            <hr/>
                            <div class="col-md-12">
                                <input type="hidden" value="<?php echo $id;?>" name="id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" app-field-wrapper="remark">
                                            <textarea id="remark" required="" name="remark" class="form-control" rows="4"><?php if(!empty($appvoal_info)){ echo $appvoal_info->approve_remark; } ?></textarea>
                                        </div>
                                    </div>
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


</body>
</html>
