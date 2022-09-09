<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<input id="check_gst" type='hidden' value="0">
<!-- Modal Contact -->

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">
            
            <form action="<?php echo admin_url('extrusion_department/approve_request');?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8" onsubmit="return confirm('Do you really want to perform this action?');">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">

                             <div class="col-md-4">  
                                <div class="form-group">
                                    <label class="control-label">Department</label>
                                    <input type="text" readonly="" class="form-control" value="<?php echo cc(value_by_id('tblproduction_department',$request_info->approval_department,'name')); ?>">
                                </div>
                            </div>

                            <div class="col-md-2">  
                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                    <input type="text" readonly="" class="form-control" value="<?php echo _d($request_info->date); ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="warehouse_id" class="control-label">Remarks</label>
                                    <textarea id="remarks" class="form-control" readonly name="remarks"><?php echo cc($request_info->remarks); ?></textarea>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="approve_remark" class="control-label">Reject/Approval</label>
                                    <textarea required="" id="approve_remark" class="form-control" name="approve_remark" <?php if($request_info->approve_status > 1) { echo 'readonly'; } ?>><?php echo (!empty($request_info->approve_remark)) ? $request_info->approve_remark : ''; ?></textarea>
                                </div>
                            </div>
                       
                           
                        </div>



                    <hr>
                    <div class="row">
                    <div class="col-md-12">
                    <h4 class="no-mtop mrg3 text-center">Product To Create</h4>
                        </div>
                        <hr/>
                        <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                        <thead>
                                            <tr>
                                                <th style="width:40%">Product Name</th>
                                                <th style="width:20%">Size</th>
                                                <th style="width:20%">Waste</th>
                                                <th style="width:20%">Quntity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>                                                      
                                            <td><?php echo value_by_id('tblproducts',$request_info->product_id,'sub_name'); ?></td>
                                            <td><?php echo $request_info->product_size ; ?></td>     
                                            <td><?php echo $request_info->waste ; ?></td>     
                                            <td><?php echo $request_info->product_qty ; ?></td>     
                                        </tr>  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                       


                 
                    <div class="row">
                    <?php if(!empty($requestitem_info)){
                            ?>
                            <div class="col-md-12">
                            <h4 class="no-mtop mrg3 text-center">Bundle Item Details</h4>
                                </div>
                                <hr/>
                                <div class="col-md-12">
                                    <div style="overflow-x:auto !important;">
                                        <div class="form-group" >
                                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                                <thead>
                                                    <tr>
                                                        <th style="width:10%">S No.</th>
                                                        <th style="width:30%">Item Name</th>
                                                        <th style="width:15%">Bundle No.</th>
                                                        <th style="width:15%">Size</th>
                                                        <th style="width:10%">Qty</th>
                                                        <th style="width:10%">Wt/ PC (Kg)</th>
                                                        <th style="width:10%">Wt of Bdl (Kg)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $i = 1;
                                                    foreach ($requestitem_info as $value) {
                                                        $bundle_info = $this->db->query("SELECT * FROM `tblmanufacturestock`  where id = '".$value->bundle_id."' ")->row();
                                                        if($bundle_info->parent_id > 0){
                                                            $bundle_info = $this->db->query("SELECT * FROM `tblmanufacturestock`  where id = '".$bundle_info->parent_id."' ")->row();
                                                        }
                                                        ?>
                                                        <tr>                                                      
                                                            <td><?php echo $i++;?></td>
                                                            <td><?php echo value_by_id('tblproducts',$value->item_id,'sub_name'); ?></td>
                                                            <td><?php echo $bundle_info->bundle_no;?></td>
                                                            <td><?php echo $value->item_size;?></td>
                                                            <td><?php echo $value->quantity;?></td>
                                                            <td><?php echo $bundle_info->weight_per_psc;?></td>
                                                            <td><?php echo $bundle_info->bundle_weight;?></td>     
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



                    <hr>
                    <div class="row">
                    <div class="col-md-12">
                    <h4 class="no-mtop mrg3 text-center">Approval Info</h4>
                        </div>
                        <hr/>
                        <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                        <thead>
                                            <tr>
                                                <th style="width:20%">Approve Status</th>
                                                <th style="width:30%">Approve By</th>
                                                <th style="width:20%">Approve Date</th>
                                                <th style="width:30%">Remark</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>                                                      
                                            <td><?php echo get_common_status($request_info->approve_status); ?></td>
                                            <td><?php echo ($request_info->approve_by > 0) ?  get_employee_name($request_info->approve_by) : '--'; ?></td>
                                            <td><?php echo ($request_info->approve_date > 0) ? _d($request_info->approve_date) : '--'; ?></td>
                                            <td><?php echo (!empty($request_info->approve_remark)) ? cc($request_info->approve_remark) : '--' ; ?></td>     
                                        </tr>  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    if($request_info->confirm_by > 0){
                    ?>
                     <hr>
                    <div class="row">
                    <div class="col-md-12">
                    <h4 class="no-mtop mrg3 text-center">Confirmation Details</h4>
                        </div>
                        <hr/>
                        <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                        <thead>
                                            <tr>
                                                <th style="width:20%">Status</th>
                                                <th style="width:30%">Confirm By</th>
                                                <th style="width:20%">Confirm Date</th>
                                                <th style="width:30%">Remark</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>  
                                        <?php
                                        $confirmation_status = '--';
                                        if($request_info->confirmation_status == 2){
                                            $confirmation_status = 'Received';
                                        }elseif($request_info->confirmation_status == 3){
                                            $confirmation_status = 'Not Received';
                                        }  
                                        ?>                                                    
                                            <td><?php echo $confirmation_status; ?></td>
                                            <td><?php echo ($request_info->confirm_by > 1) ?  get_employee_name($request_info->confirm_by) : '--'; ?></td>
                                            <td><?php echo ($request_info->confirmation_date > 0) ? _d($request_info->confirmation_date) : '--'; ?></td>
                                            <td><?php echo (!empty($request_info->confirmation_remark)) ? cc($request_info->confirmation_remark) : '--' ; ?></td>     
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
                        <input type="hidden" value="<?php echo $request_info->id; ?>" name="id">
                        <?php if($request_info->approve_status == 1) {
                        ?>
                        <div class="btn-bottom-toolbar bottom-transaction text-right">
                           <button type="submit" value="2" name="action" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">Approve</button>
                           <button type="submit" value="3" name="action" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit">Reject</button>
                        </div>  
                        <?php
                        }
                        ?>    
                         
                            
                        </div>
                        
                    </div>
                </div>
            </div>


      
           

            

            </form>
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
