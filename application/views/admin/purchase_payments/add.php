<?php

$session_id = $this->session->userdata();

init_head();

?>

<style>#address{margin: 0px 1.5px 0px 0px;height: 112px;width:100%;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">       
            <?php echo form_open($this->uri->uri_string(), array('id' => 'proposal-form', 'class' => '_propsal_form proposal-form', 'enctype' => 'multipart/form-data', 'onsubmit' => "return check_condition();")); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3><?php echo $title; ?></h3>
                                <hr/>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-3 select-placeholder">
                                    <label for="payment_method" class="control-label"><small class="req text-danger">* </small> Select Vendor </label>
                                    <select class="form-control selectpicker" id="vendor_id"  name="vendor_id" required="" data-live-search="true">
                                        <option value="">--Select One--</option>
                                        <?php
                                        if(!empty($vendor_info)){
                                            foreach ($vendor_info as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value->id; ?>" ><?php echo cc($value->name); ?></option>
                                                <?php
                                            }
                                        }   
                                        ?>                                       
                                    </select>
                                </div>
                                <div class="form-group col-md-3 select-placeholder">
                                    <label for="payment_behalf" class="control-label"><small class="req text-danger">* </small> Payment On Behalf </label>
                                    <select class="form-control selectpicker" id="payment_behalf"  name="payment_behalf" required="">
                                        <option value="">--Select One--</option>
                                        <option value="1">On Account</option>
                                        <option value="2">Against Invoice</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 select-placeholder">
                                    <label for="payment_mode" class="control-label"><small class="req text-danger">* </small> Payment Mode </label>
                                    <select class="form-control selectpicker" id="payment_mode"  name="payment_mode" required="">
                                        <option value="">--Select One--</option>
                                        <option value="1">Cheque</option>
                                        <option value="2">NEFT</option>
                                        <option value="3">Cash</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <?php 
                                        $value = _d(date('Y-m-d'));
                                        echo render_date_input('date', 'Payment Date', $value); 
                                    ?>
                                </div>
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
                                            $value = _d(date('Y-m-d'));
                                            echo render_date_input('cheque_date', 'Cheque Date', $value); 
                                        ?>
                                    </div>    
                                </div>
                                <div class="form-group col-md-3" id="amt_div">                                   
                                    <label for="ttl_amt" class="control-label"> <small class="req text-danger">* </small> Amount</label>
                                    <input type="text" id="ttl_amt" name="ttl_amt" class="form-control" required value="">                                   
                                </div>
                                <div class="form-group col-md-3">                                   
                                    <label for="reference_no" class="control-label">Reference No.</label>
                                    <input type="text" id="reference_no" name="reference_no" class="form-control" value="">                                   
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="remark" class="control-label">Remark</label>
                                    <textarea id="remark" name="remark" class="form-control"></textarea>
                                </div>
                                <div id="invoice_div" hidden>
                                    <div class="form-group col-md-6 select-placeholder">
                                        <label for="invoice_id" class="control-label"><small class="req text-danger">* </small> Select Invoice </label>
                                        <select class="form-control selectpicker invoice_id"  id="invoice_id"  name="invoice_id[]" multiple="">
                                            <option value="">--Select One-</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group col-md-3">
                                    <label for="photo" class="control-label">Image Upload</label>
                                    <input type="file" multiple="" id="file" name="file[]" style="height: auto;padding:8px 12px;border-radius: 4px;width:100%;">
                                </div>
                            </div>
                        </div>
                        <div id="get_data_div" hidden class=" bottom-transaction text-right">
                            <button type="button" id="get_data" class="btn btn-info mleft10 ">Get Data</button>
                        </div>
                        <div class="btn-bottom-toolbar bottom-transaction text-right">
                            <input type="hidden" class="getdataval" name="getdata" value="0">
                            <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">Submit Payment</button>
                            <!-- <a href="javascript:void(0);" class="btn btn-info mleft10 proposal-form-submit save-and-send purchase-payment-btn">Submit Payment</a> -->
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
        if(payment_behalf == 2){
            $('#invoice_div').show();
            $(".invoice_id").attr("required", "");
            $('#get_data_div').show();
        }else{
            $(".invoice_id").removeAttr("required", "");
            $('#invoice_div').hide();
            $('#get_data_div').hide();
        }
    });
</script>
<script type="text/javascript">
    $(document).on('change', '#vendor_id', function() {   
        var vendor_id = $(this).val();
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/purchase_payments/get_invoice'); ?>",
            data    : {'vendor_id' : vendor_id},
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
                    url     : "<?php echo site_url('admin/purchase_payments/get_invoice_table'); ?>",
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

    function check_condition(){
        var chk_get_data = $(".getdataval").val();
        var payment_behalf = $("#payment_behalf").val();
        var ttl_amt = parseFloat($("#ttl_amt").val());
		var condition = true;
        if (payment_behalf == 2){
            if (chk_get_data == 0){
                alert("Please do get data"); 
                condition = false;
                return false;
            }
            var productvalerror = 0;
            $(".invoice_product").each(function(){
                productval = $(this).val();
                if (productval == "" || productval == 0) {
                    productvalerror++;
                }
            });
            if (productvalerror > 0){
                alert("Payble amount should be required"); 
                condition = false;
                return false;
            }
            var ttl_inv_amt = 0;
            $(".invoice_product").each(function() {
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
        }
        
		if(condition){
            // condition =  confirm('Do you want to submit the form?');
            return true;
        }
	}
</script>
</body>
</html>

