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

                            <div class="row ">
                                <div class="col-xs-12 col-md-6"><h4><?php echo $title; ?> </h4></div>   
                                <?php if($section == "suspense_account"){?>
                                <div class="col-xs-12 col-md-6 text-right">
                                    <a href="<?php echo admin_url('invoice_payments/mark_suspense_unknown/'.$clientpayment_info->id); ?>" class="btn btn-success _delete">Mark as Unkown</a> 
                                </div>
                                <?php } ?>
                            </div>
                            <hr/>
                           <!--  <div class="col-md-12">
                                <h3><?php echo $title; ?></h3>
                                <hr/>
                            </div> -->


                            <?php if($section == "add"){?>
                            <div class="col-md-12">
                                <div class="from-group pull-right">
                                    <input type="checkbox" name="suspense_account" id="suspense_account">
                                    <label class="control-label">Suspense Receipt</label>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="col-md-12">
                                <div class="form-group col-md-3 select-placeholder client_div">
                                    <label for="payment_method" class="control-label"><small class="req text-danger">* </small> Select Client </label>
                                    <select class="form-control selectpicker" id="client_id"  name="client_id" required="" data-live-search="true">
                                        <option value="">--Select One--</option>
                                        <?php
                                        if(!empty($client_info)){

                                            foreach ($client_info as $key => $value) {

                                                ?>
                                                    <option value="<?php echo $value->userid; ?>" ><?php echo cc($value->client_branch_name); ?></option>
                                                <?php
                                            }
                                        }   
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 select-placeholder payment_behalf_div">

                                    <label for="payment_behalf" class="control-label"><small class="req text-danger">* </small> Payment On Behalf </label>

                                    <select class="form-control selectpicker" id="payment_behalf"  name="payment_behalf" required="">

                                        <option value="">--Select One--</option>

                                        <option value="1">On Account</option>

                                        <option value="2">Against Invoice</option>

                                        <option value="3">Against Debitnote</option>

                                    </select>

                                </div>
                                <div class="form-group col-md-3 select-placeholder payment_mode_div">

                                    <label for="payment_mode" class="control-label"><small class="req text-danger">* </small> Payment Mode </label>

                                    <select class="form-control selectpicker" id="payment_mode"  name="payment_mode" required="">

                                        <option value="">--Select One--</option>

                                        <option value="1" <?php echo (isset($clientpayment_info) && $clientpayment_info->payment_mode == 1) ? "selected":""; ?>>Cheque</option>

                                        <option value="2" <?php echo (isset($clientpayment_info) && $clientpayment_info->payment_mode == 2) ? "selected":"";?>>NEFT</option>

                                        <option value="3" <?php echo (isset($clientpayment_info) && $clientpayment_info->payment_mode == 3) ? "selected":"";?>>Cash</option>

                                    </select>

                                </div>



                                <div class="form-group col-md-3 payment_date_div">

                                    <?php 
                                        
                                        $value = (isset($clientpayment_info) ? _d($clientpayment_info->date) : _d(date('Y-m-d')));

                                        echo render_date_input('date', 'Payment Date', $value); 

                                    ?>

                                </div>







                                <div id="cheque_div" <?php echo (isset($clientpayment_info) && $clientpayment_info->payment_mode == 1) ? "":"hidden";?>>



                                    <div class="form-group col-md-4 select-placeholder">

                                        <label for="chaque_for" class="control-label"><small class="req text-danger">* </small> Cheque For </label>

                                        <select class="form-control selectpicker" id="chaque_for"  name="chaque_for" >

                                            <option value="">--Select One--</option>

                                            <option value="1" <?php echo (isset($clientpayment_info) && $clientpayment_info->chaque_for == 1) ? "selected":"";?>>Post Date</option>

                                            <option value="2" <?php echo (isset($clientpayment_info) && $clientpayment_info->chaque_for == 2) ? "selected":"";?>>Current Date</option>

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

                                        <?php 
                                            $value = (isset($estimate) ? _d($estimate->workdate) : _d(date('Y-m-d')));
                                            if (isset($clientpayment_info)){
                                                $value = _d($clientpayment_info->cheque_date);
                                            }

                                            echo render_date_input('cheque_date', 'Cheque Date', $value); 

                                        ?>

                                    </div>    



                                </div>







                                <div id="invoice_div" hidden>

                                    <div class="form-group col-md-6 select-placeholder">

                                        <label for="site_id" class="control-label"><small class="req text-danger">* </small> Select Site </label>

                                        <select class="form-control selectpicker" id="site_id"  name="site_id[]" multiple="">

                                            <option value="">--Select One-</option>

                                           

                                           

                                        </select>

                                    </div>





                                    <div class="form-group col-md-6 select-placeholder">

                                        <label for="invoice_id" class="control-label"><small class="req text-danger">* </small> Select Invoice </label>

                                        <select class="form-control selectpicker invoice_id"  id="invoice_id"  name="invoice_id[]" multiple="">

                                            <option value="">--Select One-</option>

                                           

                                           

                                        </select>

                                    </div>





                                </div>   



                                <div id="debitnote_div" hidden>

                                   

                                    <div class="form-group col-md-6 select-placeholder">

                                        <label for="invoice_id" class="control-label"><small class="req text-danger">* </small> Select Debitnote </label>

                                        <select class="form-control selectpicker debitnote_id"  id="debitnote_id"  name="debitnote_id[]" multiple="">

                                            <option value="">--Select One-</option>

                                           

                                           

                                        </select>

                                    </div>





                                </div>


                                 <div id="service_type_div" hidden>

                                   <div class="form-group col-md-6 select-placeholder">

                                        <label for="invoice_id" class="control-label"><small class="req text-danger">* </small> Select Service Type </label>

                                        <select class="form-control selectpicker service_type" onchange="get_terms_condition()" required="" data-live-search="true" id="service_type" name="service_type">

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



                                <div class="form-group col-md-3" id="amt_div">                                   

                                    <label for="ttl_amt" class="control-label"> <small class="req text-danger">* </small> Amount</label>

                                    <input type="text" id="ttl_amt" name="ttl_amt" class="form-control" required value="<?php echo (isset($clientpayment_info)) ? $clientpayment_info->ttl_amt : ""; ?>">                                   

                                </div>



                                <div class="form-group col-md-3">                                   

                                    <label for="reference_no" class="control-label">Reference No.</label>

                                    <input type="text" id="reference_no" name="reference_no" class="form-control" value="<?php echo (isset($clientpayment_info)) ? $clientpayment_info->reference_no : ""; ?>">                                   

                                </div>





                                <div class="form-group col-md-6">

                                    <label for="remark" class="control-label">Remark</label>

                                    <textarea id="remark" name="remark" class="form-control"><?php echo (isset($clientpayment_info)) ? $clientpayment_info->remark : ""; ?></textarea>

                                </div>
                                <div class="row col-md-12">
                                    <div class="form-group col-md-3">
                                        <label for="photo" class="control-label">Image Upload</label>
                                        <input type="file" multiple="" id="file" name="file[]" style="height:auto;padding:8px 12px;width:100%;border-radius:4px;">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="paymenttype" class="control-label">Payment Types</label>
                                        <select class="form-control selectpicker" id="paymenttype" required="" name="paymenttype" data-live-search="true">
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
                                    <div class="form-group col-md-3">
                                        <label for="bank" class="control-label">Bank</label>
                                        <select class="form-control bank_id selectpicker" id="bank_id" required="" name="bank_id" data-live-search="true">
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
                                    <div class="form-group col-md-3">
                                        <label for="color" class="control-label">Approved By</label>
                                        <select required="" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assign[assignid][]">
                                            <?php
                                            if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                                foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                                    ?>
                                                    <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                                        <option value=""><?php echo $Staffgroup_value['name'] ?></option>
                                                        <?php
                                                        foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                            ?>
                                                            <option style="padding-left: 50px;" value="<?php echo $singstaff['staffid'] ?>" <?php
                                                            foreach ($approved_by as $approvby) {
                                                                if (isset($approvby->staffid) && in_array($singstaff['staffid'], $approvby->staffid)) {
                                                                    echo'selected';
                                                                }
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
                                </div>
                        </div>



                    </div>





                        <div id="get_data_div" hidden class=" bottom-transaction text-right">

                            <button type="button" id="get_data" class="btn btn-info mleft10 ">Get Data</button>

                        </div>



                        <div class="btn-bottom-toolbar bottom-transaction text-right">

                            <!-- <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">Submit Payment</button> -->

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
    
    $(document).on("click", "#suspense_account", function(){
        if($(this).is(":checked") == true){
            $(".client_div").hide();
            $(".payment_behalf_div").hide();
            $(".payment_mode_div").removeClass("col-md-3");
            $(".payment_mode_div").addClass("col-md-6");
            $(".payment_date_div").removeClass("col-md-3")
            $(".payment_date_div").addClass("col-md-6");
        }else{
            $(".client_div").show();
            $(".payment_behalf_div").show();
            $(".payment_mode_div").removeClass("col-md-6");
            $(".payment_mode_div").addClass("col-md-3");
            $(".payment_date_div").removeClass("col-md-6")
            $(".payment_date_div").addClass("col-md-3");
        }
    });
    
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
       
       $("#get_data").show();
       if(payment_behalf == 1){
            
            $('#service_type_div').show();
            $("#get_data").hide();
            $('#invoice_div').hide();
            $('#debitnote_div').hide();
            $('#get_data_div').show();
       }
       else if(payment_behalf == 2){
            $('#invoice_div').show();
            $('#debitnote_div').hide();
            $('#get_data_div').show();
       }else if(payment_behalf == 3){
            $('#debitnote_div').show();
            $('#invoice_div').hide();
            $('#get_data_div').show();
       }else{
            $('#service_type_div').hide();
            $('#invoice_div').hide();
            $('#debitnote_div').hide();
            $('#get_data_div').hide();
       }
    });

</script>





<script type="text/javascript">

    $(document).on('change', '#client_id', function() {   

       var client_id = $(this).val();



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



        $.ajax({

            type    : "POST",

            url     : "<?php echo site_url('admin/invoice_payments/get_debitnote'); ?>",

            data    : {'client_id' : client_id},

            success : function(response){

                if(response != ''){                   

                     $('#debitnote_id').html(response);  

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

       var debitnote_id = $('#debitnote_id').val();

       var payment_behalf = $('#payment_behalf').val();

       var ttl_amt = $('#ttl_amt').val();

       

       if(invoice_id != '' || debitnote_id != ''){



            if(ttl_amt != ''){

                $.ajax({

                    type    : "POST",

                    url     : "<?php echo site_url('admin/invoice_payments/get_invoice_table'); ?>",

                    data    : {'invoice_id' : invoice_id, 'debitnote_id' : debitnote_id, 'payment_behalf' : payment_behalf},

                    success : function(response){

                        if(response != ''){                   

                            $('#invice_table').html(response);  

                             

                        }

                    }

                })

            }else{

                alert('Please Enter Amount!');

            }            

       }else{
            if (payment_behalf == "2"){
                alert('Please Select Invoice First!');
            }else{
                alert('Please Select Debit Note First!');
            }
       }
    }); 

</script>



<script type="text/javascript">

$(document).on('click', '#add_payment', function() {   

    var payment_behalf = $('#payment_behalf').val();
    var bank_id = $('#bank_id').val();
    var assign = $('#assign').val();
    var reference_no = $('#reference_no').val();
    var client_id = $('#client_id').val();
    var payment_behalf = $('#payment_behalf').val();
    var service_type = $('#service_type').val();
    
    var ttl_amt = parseInt($('#ttl_amt').val());

    var section = "<?php echo ($section == "suspense_account") ? 1 : 0; ?>";
    if(payment_behalf == 1 && service_type == ""){
        alert("Please select service type");
        exit;
    } 
    var ttl_inv_amt = 0;
    if(payment_behalf == 2){
        $(".amt").each(function() {
            var inv_amt = parseInt($(this).val());
            if(inv_amt > 0){
                ttl_inv_amt = (ttl_inv_amt + inv_amt);
            }            
        });

        if(ttl_amt == ttl_inv_amt){

            /*if(bank_id == ''){
                alert('Bank Can\'t be empty');  
            }else if(assign == ''){
                alert('Please select Approed By person');
            }else if(reference_no == ''){
                alert('Reference No. Can\'t be empty');  
            }else if(ttl_amt == ''){
                alert('Amount Can\'t be empty');  
            }else{
              $("#payment-form").submit();
            }*/

            if(bank_id == ''){
                alert('Bank Can\'t be empty');  
            }else if(assign == ''){
                alert('Please select Approed By person');
            }else if(reference_no == ''){
                alert('Reference No. Can\'t be empty');  
            }else if(client_id == '' && section == 1){
                alert('Client Can\'t be empty');  
            }else if(payment_behalf == '' && section == 1){
                alert('Payment behalf Can\'t be empty');  
            }else{
              $("#payment-form").submit();
            }
        }else{
            alert('Total of Payble Amount should be equals to amount.');
        }
    }else{

        /*if(bank_id == ''){
            alert('Bank Can\'t be empty');  
        }else if(assign == ''){
            alert('Please select Approed By person');
        }else if(reference_no == ''){
            alert('Reference No. Can\'t be empty');  
        }else if(ttl_amt == ''){
            alert('Amount Can\'t be empty');  
        }else{
          $("#payment-form").submit();
        }*/
        if(bank_id == ''){
            alert('Bank Can\'t be empty');  
        }else if(assign == ''){
            alert('Please select Approed By person');
        }else if(reference_no == ''){
            alert('Reference No. Can\'t be empty');  
        }else if(client_id == '' && section == 1){
            alert('Client Can\'t be empty');  
        }else if(payment_behalf == '' && section == 1){
            alert('Payment behalf Can\'t be empty');  
        }else{
          $("#payment-form").submit();
        }

        /*if(bank_id != '' && assign != ''){
            $("#payment-form").submit();
        }else{
          alert('Please select Bank Or Approed By');  
        }*/
    }
}); 
$('.onlynumbers1').keypress(function(event){

       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
           event.preventDefault(); //stop character from entering input
       }

   });

function nospaces(t){
  if(t.value.match(/\s/g)){
    t.value=t.value.replace(/\s/g,'');
  }
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

