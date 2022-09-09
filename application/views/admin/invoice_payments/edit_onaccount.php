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

                                <h3><?php echo $title; ?></h3>

                                <hr/>

                            </div>

                            <div class="col-md-12">
                                <?php if(!empty($onaccount_data) && $onaccount_data->is_suspense_account == 0) { ?>
                                <div class="form-group col-md-3 select-placeholder">

                                    <label for="payment_method" class="control-label"><small class="req text-danger">* </small> Select Client </label>

                                    <select class="form-control selectpicker" id="client_id"  name="client_id" required="" data-live-search="true">

                                        <option value="">--Select One--</option>

                                        <?php

                                        if(!empty($client_info)){
                                             foreach ($client_info as $client_key => $client_value) {
                                                ?>
                                             <option value="<?php echo $client_value->userid; ?>" <?php if(!empty($onaccount_data->client_id) && $onaccount_data->client_id == $client_value->userid){ echo 'selected'; } ?>><?php echo cc($client_value->client_branch_name); ?></option>
                                             
                                        <?php
                                           }
                                          }   
                                        ?>
                                   </select>

                                </div>

                                <div class="form-group col-md-3">                                   

                                    <label for="cheque_no" class="control-label"> <small class="req text-danger">* </small> Payment On Behalf</label>

                                    <input type="text" disabled="" class="form-control" value="On Account">                                   

                                </div>
                                 <?php } ?>
                                <div class="form-group <?php echo (!empty($onaccount_data->is_suspense_account) && $onaccount_data->is_suspense_account == 1) ? 'col-md-6': 'col-md-3'; ?> select-placeholder">
                                    <label for="payment_mode" class="control-label"><small class="req text-danger">* </small> Payment Mode </label>
                                    <select class="form-control selectpicker" id="payment_mode"  name="payment_mode" required="">
                                        <option value="">--Select One--</option>
                                        <option value="1" <?php if(!empty($onaccount_data->payment_mode) && $onaccount_data->payment_mode == 1){ echo 'selected'; } ?>>Cheque</option>
                                        <option value="2" <?php if(!empty($onaccount_data->payment_mode) && $onaccount_data->payment_mode == 2){ echo 'selected'; } ?>>NEFT</option>
                                        <option value="3" <?php if(!empty($onaccount_data->payment_mode) && $onaccount_data->payment_mode == 3){ echo 'selected'; } ?>>Cash</option>
                                    </select>
                                </div>
                                <div class="form-group <?php echo (!empty($onaccount_data->is_suspense_account) && $onaccount_data->is_suspense_account == 1) ? 'col-md-6': 'col-md-3'; ?>">
                                    <?php 
                                        echo render_date_input('date','payment_edit_date',_d($onaccount_data->date));
                                    ?>
                                </div>
                                <?php
                                if(!empty($onaccount_data->payment_mode) && $onaccount_data->payment_mode == 1)
                                {
                                ?>
                                <div id="cheque_div">
                                    <div class="form-group col-md-4 select-placeholder">
                                        <label for="chaque_for" class="control-label"><small class="req text-danger">* </small> Cheque For </label>
                                        <select class="form-control selectpicker" id="chaque_for"  name="chaque_for" >
                                            <option value="">--Select One--</option>
                                            <option value="1" <?php if(!empty($onaccount_data->chaque_for) && $onaccount_data->chaque_for == 1){ echo 'selected'; } ?>>Post Date</option>
                                            <option value="2" <?php if(!empty($onaccount_data->chaque_for) && $onaccount_data->chaque_for == 2){ echo 'selected'; } ?>>Current Date</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">                                   
                                        <label for="cheque_no" class="control-label"> <small class="req text-danger">* </small> Cheque No.</label>
                                        <input type="text" id="cheque_no" name="cheque_no" class="form-control" value="<?php echo $onaccount_data->cheque_no; ?>">                                   
                                    </div>
                                    <div class="form-group col-md-4">
                                        <?php echo render_date_input('cheque_date','payment_edit_date',_d($onaccount_data->cheque_date)); ?>
                                    </div>    
                                </div>
                                <?php } else { ?>
                                <div id="cheque_div" hidden>
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
                                        <input type="text" id="cheque_no" name="cheque_no" class="form-control" value="">                                   
                                    </div>
                                    <div class="form-group col-md-4">

                                        <?php 

                                            $value = (isset($estimate) ? _d($estimate->workdate) : _d(date('Y-m-d')));

                                            echo render_date_input('cheque_date', 'Cheque Date', $value); 

                                        ?>

                                    </div>    



                                </div>

                                <?php } ?>  

                        <?php
                         /*if(!empty($onaccount_data->service_type))
                         {
                         ?>
                        <div id="service_type">

                           <div class="form-group col-md-6 select-placeholder">

                                <label for="invoice_id" class="control-label"><small class="req text-danger">* </small> Select Service Type </label>

                                <select class="form-control selectpicker" onchange="get_terms_condition()" required="" data-live-search="true" id="service_type" name="service_type">

                                <option value=""></option>

                                <?php

                                if (isset($service_type) && count($service_type) > 0) {

                                    foreach ($service_type as $service_type_key => $service_type_value) {

                                        ?>
                                        <option value="<?php echo $service_type_value['id']; ?>" <?php if(!empty($onaccount_data->service_type) && $onaccount_data->service_type == $service_type_value['id']){ echo 'selected'; } ?>><?php echo cc($service_type_value['name']); ?></option>

                                        <?php

                                    }

                                }

                                ?>

                            </select>

                        </div>
                        </div>
                        <?php } else { ?>
                        <div id="service_type" hidden>

                           <div class="form-group col-md-6 select-placeholder">

                            <label for="invoice_id" class="control-label"><small class="req text-danger">* </small> Select Service Type </label>

                                <select class="form-control selectpicker" onchange="get_terms_condition()" required="" data-live-search="true" id="service_type" name="service_type">

                                <option value=""></option>

                                <?php

                                if (isset($service_type) && count($service_type) > 0) {

                                    foreach ($service_type as $service_type_key => $service_type_value) {

                                        ?>

                                        <option value="<?php echo $service_type_value['id'] ?>"><?php echo cc($service_type_value['name']); ?></option>

                                        <?php

                                    }

                                }

                                ?>

                            </select>

                        </div>
                        </div>
                        <?php }*/ ?>


                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-3" id="amt_div">                                   

                                            <label for="ttl_amt" class="control-label"> <small class="req text-danger">* </small> Amount</label>

                                            <input type="text" id="ttl_amt" name="ttl_amt" class="form-control" required value="<?php echo $onaccount_data->ttl_amt; ?>">                                   

                                        </div>
                                        <div class="form-group col-md-3">                                   

                                            <label for="reference_no" class="control-label">Reference No.</label>

                                            <input type="text" id="reference_no" name="reference_no" class="form-control" value="<?php echo $onaccount_data->reference_no; ?>">                                   

                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="paymenttype" class="control-label">Payment Types</label>
                                            <select class="form-control selectpicker" id="paymenttype" required="" name="paymenttype" data-live-search="true">
                                                <option value="">--Select One--</option>
                                                <?php
                                                if (!empty($paytype_info)) {
                                                    foreach ($paytype_info as $pay_key => $pay_value) {
                                                        ?>
                                                        <option value="<?php echo $pay_value->id; ?>" <?php echo (!empty($onaccount_data->payment_type_id) && $onaccount_data->payment_type_id == $pay_value->id) ? 'selected':"";?>><?php echo cc($pay_value->name); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        

                                        <div class="form-group col-md-3">

                                            <label for="bank" class="control-label">Bank</label>

                                            <select class="form-control selectpicker" id="bank_id"  name="bank_id" data-live-search="true">
                                                <option value="">--Select One--</option>
                                                <?php
                                                if (!empty($bank_info)) {
                                                    foreach ($bank_info as $bank_key => $bank_value) {
                                                        ?>
                                                        <option value="<?php echo $bank_value->id; ?>" <?php if (!empty($onaccount_data->bank_id) && $onaccount_data->bank_id == $bank_value->id) {
                                                    echo 'selected';
                                                } ?>><?php echo cc($bank_value->name); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-4 select-placeholder">

                                        <label for="invoice_id" class="control-label"><small class="req text-danger">* </small> Select Service Type </label>

                                        <select class="form-control selectpicker" onchange="get_terms_condition()" required="" data-live-search="true" id="service_type" name="service_type">

                                        <option value=""></option>

                                        <?php

                                        if (isset($service_type) && count($service_type) > 0) {

                                            foreach ($service_type as $service_type_key => $service_type_value) {

                                                ?>
                                                <option value="<?php echo $service_type_value['id']; ?>" <?php if(!empty($onaccount_data->service_type) && $onaccount_data->service_type == $service_type_value['id']){ echo 'selected'; } ?>><?php echo cc($service_type_value['name']); ?></option>

                                                <?php

                                            }

                                        }

                                        ?>

                                    </select>

                                </div>
                                        <div class="form-group col-md-8">

                                            <label for="remark" class="control-label">Remark</label>

                                            <textarea id="remark" rows="5" name="remark" class="form-control"><?php echo $onaccount_data->remark; ?></textarea>

                                        </div>
                                    </div>
                                </div>



                                
                                <div class="row col-md-12">
                                    
                                    <div class="form-group col-md-3">

                                            <label for="photo" class="control-label">Image Upload</label>

                                            <input type="file" multiple="" id="file" name="file[]" style="height:auto;padding:8px 12px;width:100%;border-radius:4px;">

                                        </div>
                                    <div class="form-group col-md-3">
                                        <label for="image" class="control-label">Image</label><br>
                                        <?php
                                        if (!empty($file_info)) {
                                            foreach ($file_info as $file_key) {
                                                ?>
                                                <a target="_blank" href="<?php echo base_url('uploads/Payment/' . $onaccount_data->id . '/' . $file_key->file_name); ?>" ><b><?php echo $file_key->file_name; ?></b></a> <br>       
                                                <?php
                                            }
                                        }
                                        ?>

                                    </div>
                                </div>
                                

                        </div>



                    </div>



                        <div class="btn-bottom-toolbar bottom-transaction text-right">

                            <button type="button" id="add_payment" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">Submit Payment</button>

                        </div>

                </div>

            </div>

		

	       </div>

       <div id="invice_table" class="col-md-12">
           
       </div>
       <?php echo form_close(); ?>
       </div>
       <?php init_tail(); ?>



<script type="text/javascript">

    $(document).on('change', '#payment_mode', function() {   

       var payemt_mode = $(this).val();

       if(payemt_mode == 1){

            $('#cheque_div').show();

       }else{

            $('#cheque_div').hide();

       }



    }); 



    $(document).on('change', '#payment_behalf', function() {   

       var payment_behalf = $(this).val();
 
       if(payment_behalf == 1){
            $('#service_type').show();

       }else{
            $('#service_type').hide();
       }



    });

</script>



<script type="text/javascript">

$(document).on('click', '#add_payment', function() {   

    var payment_behalf = $('#payment_behalf').val();

    var ttl_amt = parseInt($('#ttl_amt').val());



    var ttl_inv_amt = 0;

        $("#payment-form").submit();

    



}); 

var paytype_id = "<?php echo (!empty($onaccount_data)) ? $onaccount_data->payment_type_id : 0 ?>";
var bank_id = "<?php echo (!empty($onaccount_data)) ? $onaccount_data->bank_id : 0 ?>";
if (paytype_id > 0){
    
    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/invoice_payments/get_paymenttype_bank'); ?>",
        data    : {'paytype' : paytype_id, 'bank_id' : bank_id},
        success : function(response){
            if(response != ''){   
                $('#bank_id').html(response);  
                $('.selectpicker').selectpicker('refresh');
            }
        }
    });
}
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

