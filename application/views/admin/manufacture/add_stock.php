<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<input id="check_gst" type='hidden' value="0">
<!-- Modal Contact -->

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">
            
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'leave_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">Add Manufacturing Stock</h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                               
                             
                                <div class="form-group">
                                    <label for="mr_id" class="control-label">MR Number</label>
                                    <select class="form-control selectpicker mr_id" data-live-search="true" required="" id="mr_id" name="mr_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($mr_list) && count($mr_list) > 0) {
                                            foreach ($mr_list as $mr_value) {
                                                ?>
                                                <option value="<?php echo $mr_value['id'] ?>" ><?php echo 'MR-'.$mr_value['id'].' - '._d($mr_value['date']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>                                        
                                    </select>
                                </div>


                                 <div style="margin-bottom:2%;">
                                        <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>
                                        <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" required="" name="assignid[]">

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
                                
                              
                                
                            </div>
                            <div class="col-md-6">
                                <div class="panel_s no-shadow">
                                  
                                    <div class="row">
                                       
                                        <div class="col-md-6">
                                            <?php $value = (isset($purchase_info) ? $purchase_info['reference_no'] : ''); ?>
                                            <?php echo render_input('reference_no', 'reference_no', $value); ?>
                                        </div>

                                        <div class="col-md-6">
                                            <?php $value = (isset($purchase_info) ? _d($purchase_info['date']) : _d(date('Y-m-d'))); ?>
                                            <?php echo render_date_input('date', 'Date', $value); ?>
                                        </div>

                                  
                                       
                                        
                                    </div>
                                    <?php $value = (isset($purchase_info) ? $purchase_info['adminnote'] : ''); ?>
                                    <?php //echo render_textarea('adminnote', 'note', $value); ?>

                                    <div class="form-group" app-field-wrapper="remark">
                                        <label for="remark" class="control-label">Remark</label>
                                        <textarea id="remark" name="remark" class="form-control" style="height: 110px; width: 590px;" rows="5"><?php echo $value; ?></textarea>
                                    </div>


                                </div>
                            </div>
                           
                            
                        </div>
                        <div class="btn-bottom-toolbar bottom-transaction text-right">
                           <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                <?php echo _l('send_for_approval'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div id="produc_table">
            		

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
