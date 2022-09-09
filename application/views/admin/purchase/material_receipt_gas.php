<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'product-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12">
                                <h4><?php echo $title; ?></h4><hr/>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="vendor_id" class="control-label">Select Vendor</label>
                                    <select class="form-control selectpicker vendor_id" data-live-search="true" required="" id="vendor_id" name="vendor_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($vendors_info) && count($vendors_info) > 0) {
                                            foreach ($vendors_info as $vendor_value) {
                                                
                                                $vendor_id = "";
                                                if (isset($materialreceipt_info) && !empty($materialreceipt_info->vendor_id)){
                                                    $vendor_id = $materialreceipt_info->vendor_id;
                                                }elseif(isset($purchase_info) && !empty($purchase_info['vendor_id'])){
                                                    $vendor_id = $purchase_info['vendor_id'];
                                                }
                                                ?>
                                                <option value="<?php echo $vendor_value['id'] ?>" <?php echo ($vendor_id == $vendor_value['id']) ? 'selected' : "" ?>><?php echo $vendor_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
				<?php 
                                    $value = _d(date('Y-m-d'));
                                    $mr_number = mr_next_number();
                                    if (isset($materialreceipt_info) && !empty($materialreceipt_info)){
                                        $value = _d($materialreceipt_info->date);
                                        $mr_number = $materialreceipt_info->numer;
                                    }
                                   // echo render_date_input('date', 'Material Receipt Date', $value); 
                                ?>
                                <div class="form-group" app-field-wrapper="date">
                                    <label for="date" class="control-label">Material Receipt Date <span style="color:red;">(This should be Material Receipt Date)</span></label>
                                        <div class="input-group date"><input type="text" id="date" name="date" class="form-control datepicker" value="<?php echo $value; ?>">
                                            <div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-md-4">	
                                <div class="form-group" app-field-wrapper="number">
                                    <label for="number" class="control-label">MR Number</label>
                                    <input type="text" id="number" name="number" class="form-control" value="<?php echo $mr_number; ?>">
                                </div>
                            </div>
                            

                            <div class="col-md-4">  
                                <?php
                                    $reference_no = (isset($materialreceipt_info) && !empty($materialreceipt_info)) ? $materialreceipt_info->reference_no : "";
                                ?>
                                <?php echo render_input('reference_no', 'reference_no', $reference_no); ?>
                            </div> 

                            <div class="col-md-4">	
                                <div class="form-group" app-field-wrapper="challan_no">
                                    <label for="challan_no" class="control-label">challan No.</label>
                                    <?php
                                        $challan_no = (isset($materialreceipt_info) && !empty($materialreceipt_info)) ? $materialreceipt_info->challan_no : "";
                                    ?>
                                    <input type="text" id="challan_no" name="challan_no" class="form-control" value="<?php echo $challan_no; ?>">
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="files" class="control-label"><?php echo 'Attachment File'; ?></label>
                                    <input type="file" id="files" multiple="" name="files[]" style="width: 100%;">
                                    <?php
                                        if(!empty($file_info)){
                                            $j = 1;
                                            foreach ($file_info as $key => $value) {
                                                $extension = pathinfo($value->file, PATHINFO_EXTENSION);
                                                if (in_array(strtolower($extension), ["jpg", "png"])){
                                                    ?>
                                                    <a class="img-thumbnail" href="<?php echo base_url('uploads/material_receipt') . "/" . $value->file; ?>" target="_blank"><img src="<?php echo base_url('uploads/material_receipt') ."/". $value->file; ?>" title="<?php echo $value->file; ?>" width="50px" height="50px" ></a>
                                                <?php
                                                }else{
                                                ?>
                                                    <a href="<?php echo base_url('uploads/material_receipt') . "/" . $value->file; ?>" target="_blank"><i class="fa-2x fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                <?php
                                                
                                            $j++;
                                                }
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                             
                             
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="adminnote" class="control-label"><?php echo _l('stock_remarks'); ?></label>
                                    <?php
                                        $adminnote = (isset($materialreceipt_info) && !empty($materialreceipt_info)) ? $materialreceipt_info->adminnote : "";
                                    ?>
                                    <textarea id="adminnote" class="form-control" name="adminnote"><?php echo $adminnote; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type_of_billing" class="control-label">Type of Billing</label>
                                    <select class="form-control selectpicker" data-live-search="true" required="" id="type_of_billing" name="type_of_billing">
                                        <option value="" ></option>
                                        <option value="1" <?php echo (isset($materialreceipt_info->type_of_billing) && $materialreceipt_info->type_of_billing == 1) ? 'selected' : ''; ?>>Monthly</option>
                                        <option value="2" <?php echo (isset($materialreceipt_info->type_of_billing) && $materialreceipt_info->type_of_billing == 2) ? 'selected' : ''; ?> >Part</option>
                                        <option value="3" <?php echo (isset($materialreceipt_info->type_of_billing) && $materialreceipt_info->type_of_billing == 3) ? 'selected' : ''; ?> >Full</option>
                                    </select>
                                </div>
                            </div> 
                            <!-- <div class="col-md-4">  
                                <div class="form-group">
                                    <label for="assign" class="control-label"><?php echo _l('stock_approve_by'); ?></label>
                                        <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" required="" name="assignid[]">
                                            <?php
                                            if(isset($stockdata['approvby']))
                                            {
                                                $approvby=explode(',',$stockdata['approvby']);
                                            }
                                            if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                                foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) 
                                                {?>
                                                     <optgroup class="<?php echo 'group'.$Staffgroup_value['id'] ?>">
                                                    <option value="<?php echo 'group'.$Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                                    <?php
                                                    foreach($Staffgroup_value['staffs'] as $singstaff)
                                                    {?>
                                                        <option style="margin-left: 3%;" value="<?php echo 'staff'.$singstaff['staffid'] ?>" <?php if(isset($approvby) && in_array($singstaff['staffid'],$approvby)){echo'selected';}?>><?php echo $singstaff['firstname'] ?></option>
                                                    <?php
                                                    }?>
                                                    </optgroup>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select> 
                                </div>
                                
                            </div> -->

                            
							
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo _l('send_for_approval'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Assign Approval Persons</h4>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_id" class="control-label">Select Quality Person</label>
                                        <select class="form-control selectpicker quality_person" data-live-search="true" required="" id="quality_person" name="quality_person">
                                            <option value=""></option>
                                            <?php
                                            if (isset($staff_list) && count($staff_list) > 0) {
                                                foreach ($staff_list as $staff) {
                                                    
                                                    if ($staff->staffid != get_staff_user_id()){
                                                        $staff_id = "";
                                                        if (isset($quality_assign_person) && !empty($quality_assign_person->staff_id)){
                                                            $staff_id = $quality_assign_person->staff_id;
                                                        }
                                                    ?>
                                                        <option value="<?php echo $staff->staffid ?>" <?php echo ($staff_id == $staff->staffid) ? 'selected' : "" ?>><?php echo $staff->firstname; ?></option>
                                                    <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="stock_person" class="control-label">Select Stock Person</label>
                                        <select class="form-control selectpicker stock_person" data-live-search="true" required="" id="stock_person" name="stock_person">
                                            <option value=""></option>
                                            <?php
                                            if (isset($staff_list) && count($staff_list) > 0) {
                                                foreach ($staff_list as $staff) {
                                                    
                                                    if ($staff->staffid != get_staff_user_id()){
                                                        $staff_id = "";
                                                        if (isset($stock_assign_person) && !empty($stock_assign_person->staff_id)){
                                                            $staff_id = $stock_assign_person->staff_id;
                                                        }
                                                    ?>
                                                        <option value="<?php echo $staff->staffid ?>" <?php echo ($staff_id == $staff->staffid) ? 'selected' : "" ?>><?php echo $staff->firstname; ?></option>
                                                    <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="purchase_person" class="control-label">Select Purchase Person</label>
                                        <select class="form-control selectpicker purchase_person" data-live-search="true" required="" id="purchase_person" name="purchase_person">
                                            <option value=""></option>
                                            <?php
                                            if (isset($staff_list) && count($staff_list) > 0) {
                                                foreach ($staff_list as $staff) {
                                                    
                                                    if ($staff->staffid != get_staff_user_id()){
                                                        $staff_id = "";
                                                        if (isset($purchase_assign_person) && !empty($purchase_assign_person->staff_id)){
                                                            $staff_id = $purchase_assign_person->staff_id;
                                                        }
                                                    ?>
                                                        <option value="<?php echo $staff->staffid ?>" <?php echo ($staff_id == $staff->staffid) ? 'selected' : "" ?>><?php echo $staff->firstname; ?></option>
                                                    <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>MR Product Details</h4>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive s_table">
                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable">
                                        <thead>
                                            <tr>
                                                <th width="30%" align="left">Select Product</th>
                                                <th width="20%" class="qty" align="left">Receive Qty.</th>
                                                <th width="20%" align="left">Deliver Qty.</th>
                                                <th width="30%" align="left">Product Remark</th>
                                                <th width="10%"  align="center"><i class="fa fa-cog"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody class="ui-sortable">
                                            <?php 
                                                $totalrecord = (isset($mr_product_list) && !empty($mr_product_list)) ? count($mr_product_list) : 0;
                                                if (isset($mr_product_list) && !empty($mr_product_list)){ 
                                                    $i = 1;
                                                    foreach ($mr_product_list as $key => $value) {
                                            ?>
                                                <tr class="main" id="trcc<?php echo $i; ?>">
                                                    <td>
                                                        <div class="form-group">
                                                            <select data-dropup-auto="false" class="form-control selectpicker" onchange="getproductdata(this, '<?php echo $i; ?>');" data-live-search="true" id="product_id" required="" name="productdata[<?php echo $i; ?>][product_id]">
                                                                <option value=""></option>
                                                                <?php
                                                                if (isset($item_data) && count($item_data) > 0) {
                                                                    foreach ($item_data as $item_value) {
                                                                        ?>
                                                                        <option value="<?php echo $item_value['id'] ?>" <?php echo ($value['product_id'] == $item_value['id']) ? "selected":""; ?>><?php echo $item_value['sub_name'] ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" id="firstname" value="<?php echo $value['qty']; ?>" required="" name="productdata[<?php echo $i; ?>][receive_qty]" class="form-control" >
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" id="contactperson_email" required="" value="<?php echo $value['deliver_qty']; ?>" name="productdata[<?php echo $i; ?>][deliver_qty]" class="form-control clientmail" >
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <textarea id="remarks" name="productdata[<?php echo $i; ?>][remark]" class="form-control"><?php echo $value['remark']; ?></textarea>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson3('<?php echo $i; ?>');" ><i class="fa fa-remove"></i></button>
                                                    </td>
                                                </tr>
                                            <?php 
                                            $i++;
                                                    }
                                                }else{
                                            ?>
                                            <tr class="main" id="trcc40">
                                                <td>
                                                    <div class="form-group">
                                                        <select data-dropup-auto="false" class="form-control selectpicker" data-live-search="true" onchange="getproductdata(this, '0');" id="product_id" required="" name="productdata['+newaddmore+'][product_id]">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($item_data) && count($item_data) > 0) {
                                                                foreach ($item_data as $item_value) {
                                                                    ?>
                                                                    <option value="<?php echo $item_value['id'] ?>" ><?php echo $item_value['sub_name'] ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="firstname" value="" required="" name="productdata['+newaddmore+'][receive_qty]" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="contactperson_email" required="" value="" name="productdata['+newaddmore+'][deliver_qty]" class="form-control clientmail">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <textarea id="remarks" name="productdata['+newaddmore+'][remark]" class="form-control"></textarea>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson3(0);" ><i class="fa fa-remove"></i></button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12">
                                        <label class="label-control subHeads"><a  class="addMore" value="<?php echo $totalrecord; ?>">Add More <i class="fa fa-plus"></i></a></label>
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
<div id="productdetailsmodal" class="modal fade " role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content producthtml">

        </div>    
    </div>    
</div>
<?php init_tail(); ?>
<script type="text/javascript">
    $('.addMore').click(function ()
    { 
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myTable tbody').append('<tr class="main" id="trcc4'+newaddmore+'"><td><div class="form-group"><select data-dropup-auto="false" data-live-search="true" class="form-control selectpicker" style="display:block !important;" required onchange="getproductdata(this,' + newaddmore + ');" name="productdata[' + newaddmore + '][product_id]"><option value=""></option><?php
            if (isset($item_data) && count($item_data) > 0) {
                foreach ($item_data as $item_key => $item_value) {
                    ?><option value="<?php echo $item_value['id'] ?>"><?php echo $item_value['sub_name'] ?></option><?php
                }
            }
            ?></select></div></td><td><div class="form-group"><input type="text" required name="productdata['+newaddmore+'][receive_qty]" class="form-control" ></div></td><td><div class="form-group"><input type="text" required  name="productdata['+newaddmore+'][deliver_qty]" class="form-control"></div></td><td><div class="form-group"><textarea id="remarks" name="productdata['+newaddmore+'][remark]" class="form-control"></textarea></div></td><td class="text-center"><button type="button" class="btn btn-danger"  onclick="removeclientperson44('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
         $('.selectpicker').selectpicker('refresh');
    });
    function removeclientperson3(procompid)
    { 
        $('#trcc' + procompid).remove();
    }
    function removeclientperson44(procompid)
    {
        $('#trcc4' + procompid).remove();
    }

    function getproductdata(sel, rowid){
        var prodid = sel.value;
        /* this is for redirect to product details on next tab */
        // var reurl = '<?php echo base_url(); ?>admin/product_new/view/'+prodid; 
        // window.open(reurl, '_blank');
        $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/site_manager/getproductdetails'); ?>",
        data    : {'prodid' : prodid},
        success : function(data){
            if(data != ''){
                $('#productdetailsmodal').modal({
                    show: 'false'
                }); 
                $('.producthtml').html(data);
                $(".productdetailsbtn").html('<button type="button" class="btn btn-default close-model" onclick="removeclientperson44('+rowid+');" data-dismiss="modal">Cancel</button><button type="submit" autocomplete="off" data-dismiss="modal" class="btn btn-info">ok</button>');
            }
        }
    })
    }
</script>
</body>
</html>
