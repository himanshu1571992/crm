
<?php init_head(); ?>

<style type="text/css">

    .ui-table > thead > tr > th {
        border:1px solid #9d9d9d !important;
        color: #fff !important;
        background:#6d7580;
    }

    .ui-table > tbody > tr > td{
        border: 1px solid #c7c7c7;
        color:#5f6670;
    }

    .ui-table > tbody > tr:nth-child(even) {
      background: #f8f8f8;
    }

    .actionBtn {
        border: 1px solid #6d7580;
        padding: 8px 10px;
        border-radius: 3px;
        background:#6d7580;
        color:#fff;
        margin-right: 3px;
    }

    .actionBtn:hover {
        background:#51647c;
        color:#fff;
    }
	.mt-5{
		margin-top:15px;
	}

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
    <?php if(isset($section) && $section == 'edit') { ?>
        <form action="<?php echo admin_url('requirement/edit_purchase_process/'.$id);?>" id="product-form" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <?php }else{ ?>
        <form action="<?php echo admin_url('requirement/purchase_process_action');?>" id="product-form" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <?php } ?>

  <input type="hidden" value="<?php echo $id?>" name="req_id">
	<div class="panel_s">
		<div class="panel-body">
            <div class="row">
                <h3 class="text-center">Product Requirement</h3>
                <hr>
                <div class="col-md-3">
                    <h5 style="font-size:15px;color:red;"><u>Expected Date</u> : </h5>
                    <div class="form-group">
                        <span><?php echo (!empty($requirement_info) && !empty($requirement_info->expected_date)) ? _d($requirement_info->expected_date) : "N/A"; ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <h5 style="font-size:15px;color:red;"><u>Remark :</u></h5>
                    <span><?php echo $requirement_info->remark; ?></span>
                </div>
             <?php if(isset($requirement_info) && $requirement_info->reason_for_request > 0){ ?>
               <div class="col-md-3">
                   <h5 style="font-size:15px;color:red;"><u>Reason For Request</u></h5>
                   <div class="form-group">
                     <span>
                       <?php
                           echo ($requirement_info->reason_for_request == 1) ? 'For Sales Order' : 'For Stock';
                       ?>
                     </span>
                   </div>
               </div>
             <?php } ?>
             <?php if(isset($requirement_info) && $requirement_info->estimate_id > 0){ ?>
               <div class="col-md-3">
                   <h5 style="font-size:15px;color:red;"><u>Proforma Invoice</u></h5>
                   <div class="form-group">
                     <span >
                       <?php
                           echo '<a target="_blank" href="'.admin_url('estimates/download_pdf/'.$requirement_info->estimate_id).'">'.value_by_id("tblestimates", $requirement_info->estimate_id, "number").'</a>';
                       ?>
                     </span>
                   </div>
               </div>
               <?php
               $client_id = value_by_id("tblestimates", $requirement_info->estimate_id, "clientid");
               $client_name = client_info($client_id)->client_branch_name;
               if(!empty($client_id)){
               ?>
               <div class="col-md-3">
                   <h5 style="font-size:15px;color:red;"><u>Client Name</u></h5>
                   <div class="form-group">
                     <span >
                       <?php
                           echo '<a target="_blank" href="'.admin_url('ClientBranch/branch/'.$client_id).'">'.$client_name.'</a>';
                       ?>
                     </span>
                   </div>
               </div>
               <?php 
               }
             } ?>
             <hr>
            </div>
		<div class="row">
			 <div class="col-md-4">
				<div class="form-group">
            <label for="warehouse_id" class="control-label"><?php echo _l('stock_approve_by'); ?></label>
                <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assign[assignid][]">
                    <?php
                    if(isset($stockdata['approvby']))
                    {
                        $approvby=explode(',',$stockdata['approvby']);
                    }
                    if (isset($allStaffdata) && count($allStaffdata) > 0) {
                        foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value)
                        {?>
                             <optgroup class="<?php echo 'group'.$Staffgroup_value['id'] ?>">
                            <option value=""><?php echo $Staffgroup_value['name'] ?></option>
                            <?php
                            foreach($Staffgroup_value['staffs'] as $singstaff)
                            {?>
                                <option style="padding-left: 50px;" value="<?php echo $singstaff['staffid'] ?>" <?php if(isset($approvby) && in_array($singstaff['staffid'],$approvby)){echo'selected';}?>><?php echo $singstaff['firstname'] ?></option>
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
            <!-- <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Remark :</label>
                    <p><?php echo $requirement_info->remark; ?></p>
                </div>
            </div> -->
			<!-- <div class="col-md-4">
				<button type="submit" style="margin-top: 24px;" class="btn btn-info">Send for approval</button>
			</div> -->
		</div>
    <?php
    if(!empty($requirement_products)){
      foreach ($requirement_products as $key => $value) {

         $productfields  = $this->db->query("SELECT * FROM tblrequirement_productfields WHERE reqpro_id =  '".$value->id."' ")->result();
         $productimages  = $this->db->query("SELECT * FROM tblrequirement_productimages WHERE reqpro_id =  '".$value->id."' ")->result();
         $productvendors  = $this->db->query("SELECT * FROM tblrequirement_productvendors WHERE reqpro_id =  '".$value->id."' ")->result();
         $provendorlist  = $this->db->query("SELECT `v`.`id`,`v`.`name` FROM `tblvendorproductsname` as vp LEFT JOIN `tblvendor` as v ON `vp`.`vendor_id`=`v`.`id` WHERE product_id='".$value->product_id."' ORDER BY id desc ")->result();

        ?>
        <div class="row">
            <div class="col-md-12">
                <hr class="hr-panel-heading">
                <h4 class="no-margin">
                    <?php echo cc($value->product_name).' - Quantity ('.$value->quantity.')'; ?> 
                    <br>
                    <br>
                    <?php if ($value->rate_given == 0){  ?>
                        <button val="<?php echo $value->id; ?>" value="<?php if(!empty($productvendors)){ echo (count($productvendors) - 1); }else{ echo 0; } ?>" type="button" class="btn btn-success pull-right addmore" style="margin-top:-6px;">Add More Vendors</button>
                    <?php } ?>
                </h4>
                <div>
                    <br>
                    <p><b>Remark :</b> <?php echo $value->remark; ?></p>
                </div>
                <hr class="hr-panel-heading">
            </div>
            <div class="col-md-12">
                <div class="">
                    <table class="table table-responsive" id="vendortable_<?php echo $value->id; ?>" style="margin-top:2%; !important">
                        <thead>
                            <tr>
                                <th style="width:25%">Vendor</th>
                                <th style="width:15%">Unit</th>
                                <th style="width:15%">Rate</th>
                                <th style="width:10%">Tax</th>
                                <th style="width:45%">Remark</th>
                                <th style="width:5%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($productvendors)){
                                foreach ($productvendors as $k2 => $r2) {
                                    
                                    $approved_status = $r2->approve;
                                    $rategiven = ($value->rate_given == 1) ? 'readonly':'';
                                ?>
                                    <tr id="tr<?php echo $value->id.'_'.$k2;?>">
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" value="<?php echo $r2->vendor_name; ?>" type="text" list ="vendor_<?php echo $value->id; ?>" placeholder="Vendor" name="vendor_<?php echo $value->id; ?>[]" <?php echo $rategiven; ?>>
                                            <datalist id="vendor_<?php echo $value->id; ?>">
                                                <?php
                                                if (!empty($vendor_info)) {
                                                    foreach ($vendor_info as $v_row) {
                                                        echo '<option value="'.$v_row->name.'">';
                                                    }
                                                }
                                                ?>
                                                </datalist>

                                        </div>
                                    </td>
                                    <td>
                                        <select class="form-control selectpicker" data-live-search="true" name="unit_id_<?php echo $value->id; ?>[]" id="unit_id" <?php echo $rategiven; ?>>
                                            <option value=""></option>
                                            <?php
                                                if (isset($unit_list) && !empty($unit_list)){
                                                foreach ($unit_list as $uval) {
                                            ?>
                                                    <option value="<?php echo $uval->id; ?>" <?php echo ($r2->unit_id == $uval->id) ? 'selected' : ''; ?>><?php echo cc($uval->name); ?></option>
                                            <?php
                                                }
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td><input class="form-control" value="<?php echo $r2->rate; ?>" type="text" name="rate_<?php echo $value->id; ?>[]" placeholder="Rate" <?php echo $rategiven; ?>></td>
                                    <td class="text-center">
                                        <select class="form-control selectpicker" data-live-search="true" name="tax_<?php echo $value->id; ?>[]" <?php echo $rategiven; ?>>
                                            <option value="0" <?php echo ($r2->tax == 0) ? 'selected':''; ?>>Excluding</option>
                                            <option value="1" <?php echo ($r2->tax == 1) ? 'selected':''; ?>>Including</option>
                                        </select>
                                    </td>
                                    <td><textarea name="vendorremark_<?php echo $value->id; ?>[]" class="form-control" placeholder="remark" <?php echo $rategiven; ?>><?php echo $r2->remark; ?></textarea></td>
                                    <td class="text-center">
                                        <?php if ($value->rate_given == 0){  ?>
                                            <button type="button" class="btn pull-right btn-danger"  onclick="removeprocomp(<?php echo $value->id.','.$k2;?>);" ><i class="fa fa-remove"></i></button>
                                        <?php }else{
                                            echo '<input type="hidden" name="approve_'.$value->id.'[]" value="'.$approved_status.'">';
                                        } ?>
                                    </td>
                                    </tr>
                                <?php
                                }
                            }else{ ?>
                                <?php
                                    if (!empty($provendorlist)){
                                        foreach ($provendorlist as $kp=> $provendor) {
                                ?>
                                <tr id="tr<?php echo $value->id.'_0';?>">
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="text" list ="vendor_<?php echo $value->id; ?>" placeholder="Vendor" name="vendor_<?php echo $value->id; ?>[]" value="<?php echo $provendor->name; ?>">
                                            <datalist id="vendor_<?php echo $value->id; ?>">
                                                <?php
                                                if (!empty($vendor_info)) {
                                                    foreach ($vendor_info as $v_row) {
                                                        echo '<option value="'.$v_row->name.'">';
                                                    }

                                                }
                                                ?>
                                                </datalist>

                                        </div>
                                    </td>
                                    <td>
                                        <select class="form-control selectpicker " data-live-search="true" name="unit_id_<?php echo $value->id; ?>[]" id="unit_id">
                                            <option value=""></option>
                                            <?php
                                                if (isset($unit_list) && !empty($unit_list)){
                                                foreach ($unit_list as $uval) {
                                            ?>
                                                    <option value="<?php echo $uval->id; ?>" <?php echo ($value->unit == $uval->id) ? 'selected' : ''; ?>><?php echo cc($uval->name); ?></option>
                                            <?php
                                                }
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td><input class="form-control" type="text" name="rate_<?php echo $value->id; ?>[]" placeholder="Rate"></td>
                                    <td class="text-center">
                                        <select class="form-control selectpicker" data-live-search="true" name="tax_<?php echo $value->id; ?>[]">
                                            <option value="0">Excluding</option>
                                            <option value="1">Including</option>
                                        </select>
                                    </td>
                                    <td><textarea name="vendorremark_<?php echo $value->id; ?>[]" class="form-control" placeholder="remark"></textarea></td>
                                    <td class="text-center"><button type="button" class="btn pull-right btn-danger"  onclick="removeprocomp(<?php echo $value->id;?>,0);" ><i class="fa fa-remove"></i></button></td>
                                </tr>
                                <?php
                                        }
                                    }else{
                                ?>
                                    <tr id="tr<?php echo $value->id.'_0';?>">
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="text" list ="vendor_<?php echo $value->id; ?>" placeholder="Vendor" name="vendor_<?php echo $value->id; ?>[]">
                                            <datalist id="vendor_<?php echo $value->id; ?>">
                                                <?php
                                                if (!empty($vendor_info)) {
                                                    foreach ($vendor_info as $v_row) {
                                                        echo '<option value="'.$v_row->name.'">';
                                                    }

                                                }
                                                ?>
                                                </datalist>

                                        </div></td>
                                    <td>
                                        <select class="form-control selectpicker" data-live-search="true" name="unit_id_<?php echo $value->id; ?>[]" id="unit_id">
                                            <option value=""></option>
                                            <?php
                                                if (isset($unit_list) && !empty($unit_list)){
                                                    foreach ($unit_list as $uval) {
                                            ?>
                                                        <option value="<?php echo $uval->id; ?>" <?php echo ($value->unit == $uval->id) ? 'selected' : ''; ?>><?php echo cc($uval->name); ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                        
                                    </td>
                                    <td><input class="form-control" type="text" name="rate_<?php echo $value->id; ?>[]" placeholder="Rate"></td>
                                    <td class="text-center">
                                        <select class="form-control selectpicker" data-live-search="true" name="tax_<?php echo $value->id; ?>[]">
                                            <option value="0">Excluding</option>
                                            <option value="1">Including</option>
                                        </select>
                                    </td>
                                    <td><textarea name="vendorremark_<?php echo $value->id; ?>[]" class="form-control" placeholder="remark"></textarea></td>
                                    <td class="text-center"><button type="button" class="btn pull-right btn-danger"  onclick="removeprocomp(<?php echo $value->id;?>,0);" ><i class="fa fa-remove"></i></button></td>
                                </tr>
                            <?php  }} ?>
                        </tbody>
                    </table> 
                </div>
            </div>
            
          </div>
        <?php
      }
    }
    ?>

		<div class="btn-bottom-toolbar text-right">
        <!-- <button class="btn btn-info" type="submit">Submit</button> -->
        <?php
            if(!empty($save_info)){
                echo '<input type="hidden" class="save_id" value="'.$save_info->id.'" name="save_id">';
            }
        ?>
        <?php if (isset($section) && $section != 'edit'){ ?>
        <button class="btn btn-success" name="save" value="1" type="submit">Save</button>
        <?php } ?>
        <button class="btn btn-info" type="submit">Send for approval</button>
    </div>
	   </div>
	</div>

	</form>
<?php init_tail(); ?>
<script type="text/javascript">

       $('.addmore').click(function ()
        {
            var addmore = parseInt($(this).attr('value'));
            var row = parseInt($(this).attr('val'));
            var newaddmore = addmore + 1;
            $(this).attr('value', newaddmore);
            $('#vendortable_'+row+' tbody').first().append('<tr id="tr'+row+'_'+newaddmore+'"> <td> <div class="form-group"> <input class="form-control" required="" type="text" list="vendor_'+row+'" placeholder="Vendor" name="vendor_'+row+'[]"> <datalist id="vendor_'+row+'"> <?php if (!empty($vendor_info)){ foreach ($vendor_info as $v_row){ echo '<option value="'.$v_row->name.'">'; } }?> </datalist> </div></td><td><select class="form-control selectpicker" data-live-search="true" id="unit' + newaddmore + '" name="unit_id_'+row+'[]"><option value=""></option><?php if (isset($unit_list) && !empty($unit_list)){foreach ($unit_list as $value) {?><option value="<?php echo $value->id; ?>"><?php echo cc($value->name); ?></option><?php  }} ?></select></td><td><input class="form-control" required="" type="text" name="rate_'+row+'[]" placeholder="Rate"></td><td class="text-center"><select class="form-control selectpicker" data-live-search="true" name="tax_'+row+'[]"><option value="0">Excluding</option><option value="1">Including</option></select></td><td><textarea name="vendorremark_'+row+'[]" class="form-control"></textarea></td><td class="text-center"><button type="button" class="btn pull-right btn-danger" onclick="removeprocomp('+row+','+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');

            $('.selectpicker').selectpicker('refresh');

        });


    function removeprocomp(row,procompid)
    {
        $('#tr'+row+'_'+procompid).remove();
    }



    $(document).on('click', '.addmore_model', function(){

        var row = parseInt($(this).attr('val'));
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);


          $('#table_'+row+' tbody').append('<tr id="trcf_'+row+'_'+newaddmore+'"><td><input class="form-control" name="customdata[product_field_'+row+']['+newaddmore+']" type="text" ></td><td><input class="form-control" name="customdata[product_value_'+row+']['+newaddmore+']" type="text" ></td><td><textarea readonly name="customdata[product_remark_'+row+']['+newaddmore+']" class="form-control"></textarea></td><td><textarea name="customdata[product_pp_remark_'+row+']['+newaddmore+']" class="form-control"></textarea></td> <td><textarea  name="customdata[product_vendor_remark_'+row+']['+newaddmore+']" class="form-control"></textarea></td><td><button type="button" value="'+newaddmore+'" class="btn pull-right btn-danger" onclick="removeprofield('+row+','+newaddmore+');"><i class="fa fa-remove"></i></button></td></tr> ');

    });

    function removeprofield(row,procompid)
    {
        $('#trcf_'+row+'_'+procompid).remove();
    }


    //$('input[type="checkbox"]').on('change', function(e){
    $(document).on('change', 'input[type="checkbox"]', function(e){
        if($(this).prop('checked'))
        {
            $(this).next().val(1);
        } else {
            $(this).next().val(0);
        }
});
</script>


</body>
</html>
