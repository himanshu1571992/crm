<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<input id="check_gst" type='hidden' value="0">
<!-- Modal Contact -->

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">
<?php
if($payment_info->payment_mode == 1){
    $paymentmode = 'Cheque';
}elseif($payment_info->payment_mode == 2){
    $paymentmode = 'NEFT';
}elseif($payment_info->payment_mode == 3){
    $paymentmode = 'Cash';
}
?>            
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'leave_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">

                             <div class="col-md-4">  
                                <div class="form-group">
                                    <label class="control-label">Vendor</label>
                                    <input type="text" readonly="" class="form-control" value="<?php echo cc(value_by_id('tblvendor',$payment_info->vendor_id,'name')); ?>">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label class="control-label">Payment Mode</label>
                                    <input type="text" readonly="" class="form-control" value="<?php echo cc($paymentmode); ?>">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label class="control-label">On Behalf</label>
                                    <input type="text" readonly="" class="form-control" value="<?php echo ($payment_info->payment_behalf == 1) ? 'On Account' : 'Against Invoice'; ?>">
                                </div>
                            </div>

                            <div class="col-md-2">  
                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                    <input type="text" readonly="" class="form-control" value="<?php echo _d($payment_info->date); ?>">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label class="control-label">Amount</label>
                                    <input type="text" readonly="" class="form-control" value="<?php echo $payment_info->ttl_amt; ?>">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label class="control-label">Reference Number</label>
                                    <input type="text" readonly="" class="form-control" value="<?php echo $payment_info->reference_no; ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="warehouse_id" class="control-label">Remarks</label>
                                    <textarea id="remarks" class="form-control" readonly name="remarks"><?php echo cc($payment_info->remark); ?></textarea>
                                </div>
                            </div>
                            
                           
                        </div>
                    


                    
                    <?php if(!empty($files_info)){
                            ?>
                            <hr>
                            <div class="row">
                            <div class="col-md-12">
                            <h4 class="no-mtop mrg3 text-center">Attachments</h4>
                                </div>
                                <hr/>
                                <div class="col-md-12">
                                    <div style="overflow-x:auto !important;">
                                        <div class="form-group" >
                                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                                <thead>
                                                    <tr>
                                                        <th style="width:10%">S No.</th>
                                                        <th style="width:50%">Download File</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $i = 1;
                                                    foreach ($files_info as $file) {
                                                        ?>
                                                        <tr>                                                      
                                                            <td><?php echo $i++;?></td>
                                                            <td> <a download="" href="<?php echo base_url('uploads/purchase_payment/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                ?>  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                </div>  
                            <?php
                    }    
                    ?> 
                      

                   <?php
                    if($payment_info->payment_mode == 1){
                    ?>
                      <hr>
                        <div class="row">
                        <div class="col-md-12">
                        <h4 class="no-mtop mrg3 text-center">Cheque Details</h4>
                            </div>
                            <hr/>
                            <div class="col-md-12">
                                <div style="overflow-x:auto !important;">
                                    <div class="form-group" >
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                            <thead>
                                                <tr>
                                                    <th style="width:33%">Cheque For</th>
                                                    <th style="width:33%">Cheque Number</th>
                                                    <th style="width:33%">Cheque Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><?php echo ($payment_info->chaque_for == 1) ? 'Post Date' : 'Current Date'; ?></td>     
                                                <td><?php echo $payment_info->cheque_no ; ?></td>     
                                                <td><?php echo _d($payment_info->cheque_date) ; ?></td>     
                                            </tr>  
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    <?php    
                    }
                   ?>     
                   

                    <hr>
                    <div class="row">
                    <?php if(!empty($payment_details)){
                            ?>
                            <div class="col-md-12">
                            <h4 class="no-mtop mrg3 text-center">Invoice Details</h4>
                                </div>
                                <hr/>
                                <div class="col-md-12">
                                    <div style="overflow-x:auto !important;">
                                        <div class="form-group" >
                                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                                <thead>
                                                    <tr>
                                                        <th style="width:10%">S No.</th>
                                                        <th style="width:30%">Invoice#</th>
                                                        <th style="width:15%">TDS %</th>
                                                        <th style="width:10%">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $i = 1;
                                                    foreach ($payment_details as $value) {
                                                        ?>
                                                        <tr>                                                      
                                                            <td><?php echo $i++;?></td>
                                                            <td><a target="_blank" href="<?php echo admin_url('purchase/purchase_invoice_pdf/'.$value->invoiceid);?>"><?php echo 'Inv-'.str_pad($value->invoiceid, 4, '0', STR_PAD_LEFT); ?></a></td>
                                                            <td><?php echo $value->tds;?></td>
                                                            <td><?php echo $value->amount;?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                ?>  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php
                    }    
                    ?> 
                    </div>


                           
                            
                        </div>
                        <!-- <div class="btn-bottom-toolbar bottom-transaction text-right">
                           <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                <?php echo _l('send_for_approval'); ?>
                            </button>
                        </div> -->
                    </div>
                </div>
            </div>


      
           

            

            <?php echo form_close(); ?>
            <?php $this->load->view('admin/invoice_items/item'); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>






<script type="text/javascript">
    $(document).on('change', '#mr_id', function() { 
    var mr_id = $(this).val();
         $.ajax({
            type    : "POST",
            url     : "<?php echo base_url(); ?>admin/manufacture/get_product_table",
            data    : {'mr_id' : mr_id},
            success : function(response){
                if(response != ''){
                    $("#produc_table").html(response);
                }
            }
        })
    });       
</script>

<script type="text/javascript">
    function get_bundle_weight(product_id,row)
    {
        var qty = $('#bundle_qty_' +product_id+'_'+row).val();
        var weight_pcs = $('#weight_per_psc_' +product_id+'_'+row).val();
        
        var bundle_weight = ((qty)*((weight_pcs)));
        $('#bundle_weight_' +product_id+'_'+row).val(bundle_weight.toFixed(3));
    }
</script>

<script type="text/javascript">
    $(document).on('click', '.addmore_model', function(){    
    
        var row = parseInt($(this).attr('val'));
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore); 

        var s_no = (newaddmore + 1);    

          /*$('#table_'+row+' tbody').append('<tr id="trcf_'+row+'_'+newaddmore+'"><td><input class="form-control" name="customdata[product_field_'+row+']['+newaddmore+']" type="text" ></td><td><input class="form-control" name="customdata[product_value_'+row+']['+newaddmore+']" type="text" ></td><td><input class="form-control" name="customdata[product_remark_'+row+']['+newaddmore+']" type="text" ></td><td><button type="button" value="'+newaddmore+'" class="btn pull-right btn-danger" onclick="removeprofield('+row+','+newaddmore+');"><i class="fa fa-remove"></i></button></td></tr> ');*/
          $('#table_'+row+' tbody').append('<tr id="trcf_'+row+'_'+newaddmore+'"><td>'+s_no+'</td><td><input class="form-control" name="customdata[bundle_no_'+row+']['+newaddmore+']" type="text" ></td><td><input class="form-control qty" id="bundle_qty_'+row+'_'+newaddmore+'" name="customdata[bundle_qty_'+row+']['+newaddmore+']" type="text" onchange="get_bundle_weight('+row+','+newaddmore+');" onkeyup="get_total('+row+');" ></td><td><input class="form-control" id="weight_per_psc_'+row+'_'+newaddmore+'" name="customdata[weight_per_psc_'+row+']['+newaddmore+']" type="text" onkeyup="get_bundle_weight('+row+','+newaddmore+');"></td><td><input class="form-control" id="bundle_weight_'+row+'_'+newaddmore+'" name="customdata[bundle_weight_'+row+']['+newaddmore+']" type="text" ></td></tr>');

    });

    function removeprofield(row,procompid)
    {
        $('#trcf_'+row+'_'+procompid).remove();
    }
</script>

<script type="text/javascript">
    //$(document).on('click', '.kkk', function(){  
    function get_total(p_id) {
        //var p_id = $(this).val();
        var qty_str = [];
        var i = 0;
        $(".qty").each(function(){
            var ttl_qty_arr = parseInt($('#bundle_qty_'+p_id+'_'+i).val());
            var ttl_weight_arr = parseInt($('#bundle_weight_'+p_id+'_'+i).val());
            if(ttl_qty_arr > 0){
                qty_str.push(ttl_qty_arr);
            }

            i++;
        });
        var ttl_qty = qty_str.reduce((a, b) => a + b, 0);
        
        //alert(ttl_qty+' -- '+ttl_weight);
        $('#ttl_qty_'+p_id).val(ttl_qty);
    }
</script>

<script type="text/javascript">
$(document).on('click', '.rate', function(){   
    var p_id = parseInt($(this).attr('val'));

    var ttl_qty =  parseInt($('#ttl_qty_'+p_id).val());
    var ttl_weight = parseInt($('#ttl_pcs_'+p_id).val());
});       
</script>

<script type="text/javascript">
$(document).on('click', '.calculate', function(){   
    var p_id = parseInt($(this).attr('val'));

    var qty_str = [];
        var i = 0;
        $(".qty").each(function(){
            var ttl_weight_arr = parseFloat($('#bundle_weight_'+p_id+'_'+i).val());
            if(ttl_weight_arr > 0){
                qty_str.push(ttl_weight_arr);
            }

            i++;
        });
        var ttl_weight = qty_str.reduce((a, b) => a + b, 0);
        
        $('#ttl_bundlewt_'+p_id).val(ttl_weight.toFixed(3));


        var rate = $('#rate_'+p_id).val();
        var qty = $('#ttl_qty_'+p_id).val();
        if(rate > 0){
            var rate_per_pcs = ((ttl_weight/qty)*rate);
            $('#rate_per_pcs'+p_id).val(rate_per_pcs.toFixed(2));
        }else{
            alert('Please enter rate per pcs!');
        }


});       
</script>

</body>
</html>
