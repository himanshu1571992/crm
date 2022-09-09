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
                                                ?>
                                                <option value="<?php echo $vendor_value['id'] ?>" <?php echo (isset($purchase_info['vendor_id']) && $purchase_info['vendor_id'] == $vendor_value['id']) ? 'selected' : "" ?>><?php echo $vendor_value['name'] ?></option>
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
                                    echo render_date_input('date', 'Material Receipt Date', $value); 
                                ?>
                            </div>
                            <div class="col-md-4">	
                                <div class="form-group" app-field-wrapper="number">
                                    <label for="number" class="control-label">MR Number</label>
                                    <input type="text" id="number" name="number" class="form-control" value="<?php echo mr_next_number(); ?>">
                                </div>
                            </div>
                            

                            <div class="col-md-4">  
                                <?php echo render_input('reference_no', 'reference_no', ''); ?>
                            </div> 

                            <div class="col-md-4">	
								<div class="form-group" app-field-wrapper="challan_no">
                                    <label for="challan_no" class="control-label">challan No.</label>
                                    <input type="text" id="challan_no" name="challan_no" class="form-control" value="">
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="files" class="control-label"><?php echo 'Attachment File'; ?></label>
                                    <input type="file" id="files" multiple="" name="files[]" style="width: 100%;">
                                </div>
                            </div>
                             
                             
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="adminnote" class="control-label"><?php echo _l('stock_remarks'); ?></label>
                                    <textarea id="adminnote" class="form-control" name="adminnote"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">  
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
                                
                            </div>

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
                                <tr class="main" id="trcc0">

                                <td>

                                <div class="form-group">

                                <select data-dropup-auto="false" class="form-control selectpicker" data-live-search="true" id="product_id" required="" name="productdata['+newaddmore+'][product_id]">

                                <option value=""></option>
                                    <?php
                                    if (isset($item_data) && count($item_data) > 0) {
                                        foreach ($item_data as $item_value) {
                                            ?>
                                            <option value="<?php echo $item_value['id'] ?>" ><?php echo $item_value['name'] ?></option>
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

                                        <button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson3('0');" ><i class="fa fa-remove"></i></button>

                                    </td>

                                </tr>

                                </tbody>

                                </table>

                                <div class="col-xs-12">

                                <label class="label-control subHeads"><a  class="addMore" value="0">Add More <i class="fa fa-plus"></i></a></label>

                                </div>

                            </div>
							
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo _l('send_for_approval'); ?>
                            </button>
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
    $('.addMore').click(function ()
    { 
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myTable tbody').append('<tr class="main" id="trcc4'+newaddmore+'"><td><div class="form-group"><select data-dropup-auto="false" data-live-search="true" class="form-control selectpicker" style="display:block !important;" required name="productdata[' + newaddmore + '][product_id]"><option value=""></option><?php
            if (isset($item_data) && count($item_data) > 0) {
                foreach ($item_data as $item_key => $item_value) {
                    ?><option value="<?php echo $item_value['id'] ?>"><?php echo $item_value['name'] ?></option><?php
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
</script>
</body>
</html>
