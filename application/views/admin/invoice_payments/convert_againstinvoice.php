<?php

$session_id = $this->session->userdata();

init_head();

?>
<style>#address{margin: 0px 1.5px 0px 0px;height: 110px;width:100%;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <form action="<?php echo base_url('admin/invoice_payments/action_againstinvoice'); ?>" class="_propsal_form proposal-form" method="post" accept-charset="utf-8" onsubmit="return check_condition();">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Client Payment Form</h3>
                                <hr/>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" id="client_id" name="client_id" value="<?php echo $payment_info->client_id; ?>">
                                <div class="form-group col-md-3">                                   
                                    <label for="cheque_no" class="control-label"> <small class="req text-danger">* </small> Client Name</label>
                                    <input type="text" disabled="" class="form-control" value="<?php echo cc($client_company); ?>">                                   
                                </div>
                                <input type="hidden" id="payment_behalf" name="payment_behalf" value="2">
                                <div class="form-group col-md-3">                                   
                                    <label for="cheque_no" class="control-label"> <small class="req text-danger">* </small> Payment On Behalf</label>
                                    <input type="text" disabled="" class="form-control" value="Against Invoice">                                   
                                </div>
                                <div class="form-group col-md-3 select-placeholder">
                                    <label for="payment_mode" class="control-label"><small class="req text-danger">* </small> Payment Mode </label>
                                    <select class="form-control selectpicker" id="payment_mode"  name="payment_mode" required="">
                                        <option value="">--Select One--</option>
                                        <option value="1" <?php if($payment_info->payment_mode == 1){ echo 'selected'; } ?>>Cheque</option>
                                        <option value="2" <?php if($payment_info->payment_mode == 2){ echo 'selected'; } ?>>NEFT</option>
                                        <option value="3" <?php if($payment_info->payment_mode == 3){ echo 'selected'; } ?>>Cash</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <?php 
                                        $value = (isset($payment_info) ? _d($payment_info->date) : _d(date('Y-m-d')));
                                        echo render_date_input('date', 'Payment Date', $value); 
                                    ?>
                                </div>
                                <div id="cheque_div" <?php if($payment_info->payment_mode != 1){ echo 'hidden'; } ?> >
                                    <div class="form-group col-md-4 select-placeholder">
                                        <label for="chaque_for" class="control-label"><small class="req text-danger">* </small> Cheque For </label>
                                        <select class="form-control selectpicker" id="chaque_for"  name="chaque_for" >
                                            <option value="">--Select One--</option>
                                            <option value="1" <?php if($payment_info->chaque_for == 1){ echo 'selected'; } ?>>Post Date</option>
                                            <option value="2" <?php if($payment_info->chaque_for == 2){ echo 'selected'; } ?>> Current Date</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">                                   
                                        <label for="cheque_no" class="control-label"> <small class="req text-danger">* </small> Cheque No.</label>
                                        <input type="text" id="cheque_no" name="cheque_no" class="form-control" value="<?php echo $payment_info->cheque_no; ?>">                                   
                                    </div>
                                    <div class="form-group col-md-4">
                                        <?php 
                                            $cheque_date = (isset($payment_info) ? _d($payment_info->cheque_date) : _d(date('Y-m-d')));
                                            echo render_date_input('cheque_date', 'Cheque Date', $cheque_date); 
                                        ?>
                                    </div>   
                                </div>
                                <div id="invoice_div">
                                    <div class="form-group col-md-6 select-placeholder">
                                        <label for="site_id" class="control-label"><small class="req text-danger">* </small> Select Site </label>
                                        <select class="form-control selectpicker" id="site_id"  name="site_id[]" multiple="" required>
                                            <option value="">--Select One-</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 select-placeholder">
                                        <label for="invoice_id" class="control-label"><small class="req text-danger">* </small> Select Invoice </label>
                                        <select class="form-control selectpicker"  id="invoice_id"  name="invoice_id[]" multiple="" required>
                                            <option value="">--Select One-</option>
                                        </select>
                                    </div>
                                </div>   



                                <div class="form-group col-md-3" id="amt_div">                                   

                                    <label for="ttl_amt" class="control-label"> <small class="req text-danger">* </small> Amount</label>

                                    <input type="text" id="ttl_amt" name="ttl_amt" class="form-control" readonly="" required value="<?php echo $payment_info->ttl_amt; ?>">                                   

                                </div>



                                <div class="form-group col-md-3">                                   

                                    <label for="reference_no" class="control-label">Reference No.</label>

                                    <input type="text" id="reference_no" name="reference_no" class="form-control" value="<?php echo $payment_info->reference_no; ?>">                                   

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="remark" class="control-label">Remark</label>
                                    <textarea id="remark" name="remark" class="form-control"><?php echo $payment_info->remark; ?></textarea>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="paymenttype" class="control-label">Payment Types</label>
                                    <select class="form-control selectpicker" id="paymenttype" required="" name="paymenttype" data-live-search="true">
                                        <option value="">--Select One--</option>
                                        <?php
                                        if (!empty($paytype_info)) {
                                            foreach ($paytype_info as $pay_key => $pay_value) {
                                                ?>
                                                <option value="<?php echo $pay_value->id; ?>" <?php echo ($payment_info->payment_type_id == $pay_value->id) ? 'selected':''; ?>><?php echo cc($pay_value->name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">

                                    <label for="bank" class="control-label">Bank</label>

                                    <select class="form-control selectpicker" id="bank_id" required="" name="bank_id" data-live-search="true">
                                       <option value="">--Select One--</option>
                                        <?php

                                        if(!empty($bank_info)){
                                             foreach ($bank_info as $bank_key => $bank_value) {
                                                ?>
                                             <option value="<?php echo $bank_value->id; ?>" <?php if($payment_info->bank_id == $bank_value->id){ echo 'selected';}?>><?php echo cc($bank_value->name); ?></option>
                                        <?php
                                           }
                                          }   
                                        ?>
                                    </select>

                                </div>



                                <div class="form-group col-md-3">

                                    <label for="photo" class="control-label">Image Upload</label>

                                    <input type="file" multiple="" id="file" name="file[]" style="height:auto;padding:8px 12px;width:100%;border-radius:4px;">

                                </div>
                                
                                <div class="form-group col-md-3">
                                   <label for="color" class="control-label">Approved By</label>
                                    
                                    <select required="" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assign[assignid][]">
                                        <?php
                                    if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                        foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) 
                                        {?>
                                             <optgroup class="<?php echo 'group'.$Staffgroup_value['id'] ?>">
                                            <option value=""><?php echo $Staffgroup_value['name'] ?></option>
                                            <?php
                                            foreach($Staffgroup_value['staffs'] as $singstaff)
                                            {?>
                                                <option style="padding-left: 50px;" value="<?php echo $singstaff['staffid'] ?>" <?php 
                                                 foreach ($approved_by as $approvby) 
                                                 {
                                                if(isset($approvby->staffid) && in_array($singstaff['staffid'],$approvby->staffid)){echo'selected';} }?>><?php echo $singstaff['firstname'] ?></option>
                                            <?php
                                            }?>
                                            </optgroup>
                                        <?php
                                        }
                                    }
                                    ?>
                                    </select> 
                                </div>
                              

                        </div>



                    </div>





                        <div id="get_data_div" class=" bottom-transaction text-right">

                            <button type="button" id="get_data" class="btn btn-info mleft10 ">Get Data</button>

                        </div>



                        <div class="btn-bottom-toolbar bottom-transaction text-right">
                            <input type="hidden" class="getdataval" name="getdata" value="0">        
                            <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">Submit Payment</button>

                        </div>

                </div>

            </div>

		

	       </div>







            <div id="invice_table" class="col-md-12">

                



            </div>

            <input type="hidden" value="<?php echo $id; ?>" name="id">   

            </form>

        

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
       if(payment_behalf == 2){
            $('#invoice_div').show();
            $('#get_data_div').show();
       }else{
            $('#invoice_div').hide();
            $('#get_data_div').hide();
       }
    });
</script>
<script type="text/javascript">
    $( document ).ready(function() {  
       var client_id = $('#client_id').val();
       $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/invoice_payments/get_sites'); ?>",
            data    : {'client_id' : client_id},
            success : function(response){
                if(response != ''){                   
                     $('#site_id').html(response);  
                     $('.selectpicker').selectpicker('refresh');
                }
            }
        })
    }); 
</script>
<script type="text/javascript">
    $(document).on('change', '#site_id', function() {   
       var site_id = $(this).val();
       var client_id = $('#client_id').val();
       $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/invoice_payments/get_invoice'); ?>",
            data    : {'site_id' : site_id, 'client_id' : client_id},
            success : function(response){
                if(response != ''){                   
                     $('#invoice_id').html(response);  
                     $('.selectpicker').selectpicker('refresh');
                }
            }
        })
    }); 
</script>
<script type="text/javascript">
    $(document).on('click', '#get_data', function() {   
       var invoice_id = $('#invoice_id').val();
       var ttl_amt = $('#ttl_amt').val();
       if(invoice_id != ''){
            if(ttl_amt != ''){
                $.ajax({
                    type    : "POST",
                    url     : "<?php echo site_url('admin/invoice_payments/get_invoice_table'); ?>",
                    data    : {'invoice_id' : invoice_id},
                    success : function(response){
                        if(response != ''){                   
                            $('#invice_table').html(response);        
                            $(".getdataval").val('1');                     
                        }
                    }
                })
            }else{
                alert('Please Enter Amount!');
            }            
       }else{
            alert('Please Select Invoice First!');
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

    function check_condition(){
        var chk_get_data = $(".getdataval").val();
        var ttl_amt = parseFloat($("#ttl_amt").val());
		var condition = true;
        if (chk_get_data == 0){
            alert("Please do get data"); 
            condition = false;
            return false;
        }
        var ttl_inv_amt = 0;
        $(".amt").each(function() {
            var inv_amt = parseFloat($(this).val());
            if(inv_amt > 0){
                ttl_inv_amt = (ttl_inv_amt + inv_amt);
            }            
        });

        if(ttl_amt != ttl_inv_amt){
            alert("Payble amount should be equals to total amount"); 
            condition = false;
            return false;
        }
		if(condition){
            // condition =  confirm('Do you want to submit the form?');
            return true;
        }
	}
</script>





</body>

</html>

