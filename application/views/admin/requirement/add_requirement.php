<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}</style>
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
    @media (max-width: 500px){
        .btn-bottom-toolbar {
            width: 100%
        }
        .btn-bottom-toolbar .btn {
            margin-top: 5px !important;
        }
    }    
    @media (max-width: 768px){
        .btn-bottom-toolbar {
            width: 100%
        }
        .btn-bottom-toolbar .btn {
            margin-top: 5px !important;
        }
    }
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'product-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4><?php echo $title; ?></h4>
                                <hr/>
                            </div>
                            <div class="table-responsive s_table compdv">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable" style="margin-top:2%; !important">
                                    <thead>
                                        <tr>
                                            <th width="35%" align="left">Product Name</th>
                                            <th width="10%" align="left">Unit</th>
                                            <th width="10%" align="left">Quantity</th>
                                            <!-- <th width="10%" align="left">Fields</th> -->
                                            <th width="20%" align="left">Product Images</th>
                                            <th width="20%" align="left">Remarks</th>
                                            <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                         <?php
                                            $stockproducts = [];
                                            if ($this->uri->segment(4) == "livestock"){
                                                $proid = $this->input->get('pids');
                                                $stockproducts = $this->db->query("SELECT `sub_name` FROM `tblproducts` WHERE id IN (".$proid.") ")->result();
                                            }
                                            
                                             $prid = 0;
                                            if (isset($save_products_info) && !empty($save_products_info)){
                                              foreach ($save_products_info as $value) {
                                          ?>
                                          <tr class="main" id="tr<?php echo $prid; ?>">
                                             <td>
                                                 <div class="form-group">
                                                     <input class="form-control" required="" type="text" list="product_id_<?php echo $prid; ?>" name="componnetdata[<?php echo $prid; ?>][product_name]" value="<?php echo $value->product_name;?>">
                                                 </div>
                                             </td>
                                                 <td>
                                                   <select class="form-control selectpicker" data-live-search="true" id="unit<?php echo $prid; ?>" name="componnetdata[<?php echo $prid; ?>][unit]">
                                                       <option value=""></option>
                                                       <?php
                                                           if (isset($unit_list) && !empty($unit_list)){
                                                              foreach ($unit_list as $val) {
                                                       ?>
                                                                 <option value="<?php echo $val->id; ?>" <?php echo ($value->unit == $val->id) ? 'selected=""':''; ?>><?php echo cc($val->name); ?></option>
                                                       <?php
                                                              }
                                                           }
                                                       ?>
                                                   </select>
                                                 </td>
                                                 <td>
                                                     <div class="form-group">
                                                         <input class="form-control" type="number" name="componnetdata[<?php echo $prid; ?>][quantity]" value="<?php echo $value->quantity; ?>">
                                                     </div>
                                                 </td>
                                                 <td>
                                                     <div class="form-group">
                                                         <input type="file" multiple="" name="images_<?php echo $prid; ?>[]" class="form-control">
                                                         <?php
                                                            $files_data = $this->db->query("SELECT * FROM `tblrequirement_productimages` WHERE `req_id`='".$value->req_id."' AND `reqpro_id`='".$value->id."' ")->result();
                                                            if (!empty($files_data)){
                                                               foreach ($files_data as $ky => $file) {
                                                                 echo '<input type="hidden" name="componnetdata['.$prid.'][image][]" value="'.$file->image.'">';
                                                          ?>
                                                                <a href="<?php echo site_url('uploads/requirement_product/'.$file->image); ?>" target="_blank"><img style="border: 1px solid;" src="<?php echo site_url('uploads/requirement_product/'.$file->image); ?>" width="50" height="50"></a>
                                                                <a class="_delete" href="<?php echo admin_url('requirement/delete_requirement_file/'.$file->id); ?>"><i class="fa fa-remove"></i></a>
                                                          <?php
                                                               }
                                                            }
                                                         ?>
                                                     </div>
                                                 </td>
                                                 <td>
                                                     <div class="form-group">
                                                         <textarea id="remarks" name="componnetdata[<?php echo $prid; ?>][remarks]" class="form-control"><?php echo $value->remark; ?></textarea>
                                                     </div>
                                                 </td>
                                                 <td>
                                                     <button type="button" class="btn pull-right btn-danger"  onclick="removeprocomp('<?php echo $prid; ?>');" ><i class="fa fa-remove"></i></button>
                                                 </td>
                                             </tr>
                                          <?php
                                                 $prid++;
                                              }
                                          ?>
                                         <?php }else if(!empty($stockproducts)){ 
                                                foreach ($stockproducts as $prodval) { 
                                            ?>
                                                <tr class="main" id="tr<?php echo $prid; ?>">
                                                    <td>
                                                        <div class="form-group">
                                                            
                                                            <input class="form-control" required="" type="text" list ="product_id_<?php echo $prid; ?>" name="componnetdata[<?php echo $prid; ?>][product_name]" value="<?php echo $prodval->sub_name; ?>">
                                                            <datalist id="product_id_<?php echo $prid; ?>">
                                                                <?php
                                                                    if (!empty($product_info)) {
                                                                        foreach ($product_info as $item_value) {
                                                                            echo '<option value="'.cc(trim($item_value->sub_name)).'"></option>';
                                                                        }

                                                                    }
                                                                ?>
                                                            </datalist>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select class="form-control selectpicker" data-live-search="true" id="unit" name="componnetdata[<?php echo $prid; ?>][unit]">
                                                            <option value=""></option>
                                                            <?php
                                                                if (isset($unit_list) && !empty($unit_list)){
                                                                foreach ($unit_list as $value) {
                                                            ?>
                                                                    <option value="<?php echo $value->id; ?>"><?php echo cc($value->name); ?></option>
                                                            <?php
                                                                }
                                                                }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input class="form-control" type="number" name="componnetdata[<?php echo $prid; ?>][quantity]">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="file" multiple="" name="images_<?php echo $prid; ?>[]" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <textarea id="remarks" name="componnetdata[<?php echo $prid; ?>][remarks]" class="form-control"></textarea>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn pull-right btn-danger"  onclick="removeprocomp('<?php echo $prid; ?>');" ><i class="fa fa-remove"></i></button>
                                                    </td>
                                                </tr>
                                        
                                        <?php
                                                $prid++;
                                             }
                                            }else{ ?>
                                            <tr class="main" id="tr0">
                                                    <td>
                                                        <div class="form-group">
                                                            
                                                            <input class="form-control" required="" type="text" list ="product_id_0" name="componnetdata[0][product_name]" >
                                                            <datalist id="product_id_0">
                                                                <?php
                                                                if (!empty($product_info)) {
                                                                    foreach ($product_info as $item_value) {
                                                                        echo '<option value="'.cc(trim($item_value->sub_name)).'"></option>';
                                                                    }

                                                                }
                                                                ?>
                                                                </datalist>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select class="form-control selectpicker" data-live-search="true" id="unit" name="componnetdata[0][unit]">
                                                            <option value=""></option>
                                                            <?php
                                                                if (isset($unit_list) && !empty($unit_list)){
                                                                foreach ($unit_list as $value) {
                                                            ?>
                                                                    <option value="<?php echo $value->id; ?>"><?php echo cc($value->name); ?></option>
                                                            <?php
                                                                }
                                                                }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input class="form-control" type="number" name="componnetdata[0][quantity]">
                                                        </div>
                                                    </td>

                                                        <!-- <td>
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#fieldmodel_0">Item Fields</button>
                                                            </div>

                                                            <div id="fieldmodel_0" class="modal fade" role="dialog">
                                                                <div class="modal-dialog"> -->

                                                                <!-- Modal content-->
                                                                <!-- <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Add Custom Fields</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <button type="button" class="addmore_model btn btn-info pull-right" style="margin-bottom: 15px;" val="0" value="0">Add More <i class="fa fa-plus"></i></button>

                                                                            <table class="table ui-table" id="table_0">
                                                                                <thead>
                                                                                    <tr>
                                                                                    <th style="width:30%">Name</th>
                                                                                    <th style="width:30%">Value</th>
                                                                                    <th style="width:35%">Remark</th>
                                                                                    <th style="width:5%">Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>

                                                                                    <tr id="trcf_0_0">
                                                                                        <td><input class="form-control" name="customdata[product_field_0][0]" type="text" ></td>
                                                                                        <td><input class="form-control" name="customdata[product_value_0][0]" type="text" ></td>
                                                                                        <td><input class="form-control" name="customdata[product_remark_0][0]" type="text" ></td>
                                                                                        <td><button type="button" value="0" class="btn pull-right btn-danger" onclick="removeprofield(0,0);"><i class="fa fa-remove"></i></button></td>
                                                                                    </tr>


                                                                                </tbody>
                                                                                </table>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>

                                                                </div>
                                                            </div>
                                                        </td> -->
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="file" multiple="" name="images_0[]" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <textarea id="remarks" name="componnetdata[0][remarks]" class="form-control"></textarea>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn pull-right btn-danger"  onclick="removeprocomp('0');" ><i class="fa fa-remove"></i></button>
                                                    </td>
                                                </tr>
                                        <?php } ?>    
                                    </tbody>
                                </table>
                                <div class="col-xs-12">
                                    <?php
                                         if (isset($save_products_info) && !empty($save_products_info)){
                                            $addmorecount = count($save_products_info);
                                         }else{
                                            $addmorecount = (!empty($productcomponent)) ? count($productcomponent) : 0;
                                         }
                                    ?>
                                    <label class="label-control subHeads"><a  class="addmore" value="<?php echo $addmorecount; ?>">Add More <i class="fa fa-plus"></i></a></label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                 <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="department" class="control-label">Department</label>
                                            <select class="form-control selectpicker" required="" data-live-search="true" id="department_id" name="department_id">
                                                <option value=""></option>
                                                <?php
                                                    if (isset($department_list) && !empty($department_list)){
                                                       foreach ($department_list as $dep) {
                                                         if (isset($save_info) && !empty($save_info)){
                                                            $selectedcls = ($save_info->department_id == $dep->id) ? 'selected=""':'';
                                                         }else{
                                                            $selectedcls = ($stockdata['department_id'] == $dep->id) ? 'selected=""':'';
                                                         }
                                                ?>
                                                          <option value="<?php echo $dep->id; ?>" <?php echo $selectedcls; ?>><?php echo cc($dep->name); ?></option>
                                                <?php
                                                       }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="reason" class="control-label">Reason For Request </label>
                                            <select class="form-control selectpicker" data-live-search="true" id="reason_for_request" name="reason_for_request">
                                                <option value=""></option>
                                                <option value="1" <?php echo (isset($save_info) && $save_info->reason_for_request == 1) ? 'selected':''; ?>>For Sales Order </option>
                                                <option value="2" <?php echo (isset($save_info) && $save_info->reason_for_request == 2) ? 'selected':''; ?>>For Stock</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 ">
                                      <div class="form-group">
                                          <label for="expected_date" class="control-label">Expected Date</label>
                                          <?php
                                                if (isset($save_info) && !empty($save_info)){
                                                  $expecteddate = $save_info->expected_date;
                                                }else{
                                                  $expecteddate = (isset($stockdata['expected_date']) && $stockdata['expected_date'] != "") ? $stockdata['expected_date'] : "";
                                                }
                                           ?>
                                          <input type="text" class="form-control datepicker" name="expected_date" id="expected_date" value="<?php echo $expecteddate; ?>" required>
                                      </div>
                                    </div>
                                    <div class="col-md-3 ">
                                      <div class="form-group">
                                          <label for="warehouse_id" class="control-label"><?php echo _l('stock_remarks'); ?></label>
                                          <?php
                                                if (isset($save_info) && !empty($save_info)){
                                                  $remarks = $save_info->remark;
                                                }else{
                                                  $remarks = (isset($stockdata['remarks']) && $stockdata['remarks'] != "") ? $stockdata['remarks'] : "";
                                                }
                                           ?>
                                          <textarea id="remarks" class="form-control" name="remarks"><?php echo $remarks; ?></textarea>
                                      </div>
                                    </div>
                                 </div>

                                <div class="row">
                                    <div class="col-md-3 estimate_div" style="display:none;">
                                      <div class="form-group">
                                          <label for="profarma_invoice">Proforma Invoice</label>
                                          <select class="form-control selectpicker" data-live-search="true" id="estimate_id" name="estimate_id">
                                            <option value=""></option>
                                            <?php
                                                if (isset($estimate_list) && !empty($estimate_list)){
                                                   foreach ($estimate_list as $key => $estimate) {
                                                      $client_name = client_info($estimate->clientid)->client_branch_name;
                                                      $selectedcls = (isset($save_info) && $save_info->estimate_id == $estimate->id) ? 'selected':'';
                                                      echo '<option value="'.$estimate->id.'" '.$selectedcls.'>'.$estimate->number.' - '.$client_name.'</option>';
                                                   }
                                                }
                                            ?>
                                          </select>
                                      </div>
                                    </div>
                                    <div class="col-md-6 remarkdiv">
                                      <div class="form-group">
                                           <label for="warehouse_id" class="control-label">Assign To</label>
                                            <select onchange="staffdropdown()" required="" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assign[assignid][]">
                                                <?php
                                                if(isset($stockdata['approvby']))
                                                {
                                                    $approvby=explode(',',$stockdata['approvby']);
                                                }
                                                if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                                    foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value)
                                                    {?>
                                                         <optgroup class="<?php echo 'group'.$Staffgroup_value['id'] ?>">
                                                        <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
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
                                    <div class="col-md-6">
                                        <?php
                                          $chkrequirement = get_staff_info(get_staff_user_id())->createdirectrequirement;
                                        ?>
                                        <div class="form-group">
                                            <label for="warehouse_id" class="control-label"><?php echo _l('stock_approve_by'); ?></label>
                                            <select <?php echo ($chkrequirement == 1) ? '' : 'required=""'; ?> onchange="staffapprovaldropdown()" class="form-control selectpicker" multiple data-live-search="true" id="sendapproval" name="approvalstaff[assign][]">
                                                <?php
                                                if(isset($stockdata['approvby']))
                                                {
                                                    $approvby=explode(',',$stockdata['approvby']);
                                                }
                                                if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                                    foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value)
                                                    {?>
                                                         <optgroup class="<?php echo 'group1'.$Staffgroup_value['id'] ?>">
                                                        <option value="<?php echo 'group1' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
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
                                </div>

                            </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">

                          <?php
                              if(!empty($save_info)){
                                  echo '<input type="hidden" class="save_id" value="'.$save_info->id.'" name="save_id">';
                              }

                              $chkrequirement = get_staff_info(get_staff_user_id())->createdirectrequirement;
                              if ($chkrequirement == 1){
                                  echo '<button class="btn btn-info" name="directsubmit" value="1" type="submit">Direct Approved</button>';
                              }
                          ?>
                          <button class="btn btn-success" name="save" value="1" type="submit">Save</button>
                          <button class="btn btn-info" name="sendapprovalbtn" type="submit">Send for approval</button>
                            <!-- <button class="btn btn-info" value="1" type="submit">Save</button> -->
                            <!-- <input class="btn btn-info" type="submit" name="submit" value="Save" >
                            <button class="btn btn-success" value="2" type="submit">Send for approval</button> -->
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
<!-- $('#myTable tbody').first().append('<tr class="main" id="tr' + newaddmore + '"> <td> <div class="form-group"> <input required="" class="form-control" type="text" list="product_id_' + newaddmore + '" name="componnetdata[' + newaddmore + '][product_name]"> <datalist id="product_id_' + newaddmore + '"> <?php if (!empty($product_info)){ foreach ($product_info as $item_value){ echo '<option value="'.$item_value->name.'">'; } } ?> </datalist> </div></td><td><div class="form-group"><input class="form-control" type="number" name="componnetdata[' + newaddmore + '][quantity]"></div></td><td> <div class="form-group"> <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#fieldmodel_' + newaddmore + '">Item Fields</button> </div><div id="fieldmodel_' + newaddmore + '" class="modal fade" role="dialog"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">Add Custom Fields</h4> </div><div class="modal-body"> <button type="button" class="addmore_model btn btn-info pull-right" style="margin-bottom: 15px;" val="' + newaddmore + '" value="0">Add More <i class="fa fa-plus"></i></button> <table class="table ui-table" id="table_' + newaddmore + '"> <thead> <tr> <th>Name</th> <th>Value</th> <th>Remark</th> <th>Action</th> </tr></thead> <tbody> <tr id="trcf_'+newaddmore+'_0"> <td><input class="form-control" name="customdata[product_field_' + newaddmore + '][0]" type="text" ></td><td><input class="form-control" name="customdata[product_value_' + newaddmore + '][0]" type="text" ></td><td><input class="form-control" name="customdata[product_remark_' + newaddmore + '][0]" type="text" ></td><td><button type="button" value="0" class="btn pull-right btn-danger" onclick="removeprofield('+newaddmore+',0);"><i class="fa fa-remove"></i></button></td></tr></tbody> </table> </div><div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div></div></div></div></td><td> <div class="form-group"> <input type="file" multiple="" name="images_'+newaddmore+'[]" class="form-control"> </div></td><td> <div class="form-group"> <textarea id="remarks" name="componnetdata[' + newaddmore + '][remarks]" class="form-control"></textarea> </div></td><td> <button type="button" class="btn pull-right btn-danger" onclick="removeprocomp(' + newaddmore + ');" ><i class="fa fa-remove"></i></button> </td></tr>'); -->
<script>
    $('.addmore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);

        $('#myTable tbody').first().append('<tr class="main" id="tr' + newaddmore + '"> <td> <div class="form-group"> <input required="" class="form-control" type="text" list="product_id_' + newaddmore + '" name="componnetdata[' + newaddmore + '][product_name]"> <datalist id="product_id_' + newaddmore + '"> <?php if (!empty($product_info)){ foreach ($product_info as $item_value){ echo '<option value="'.$item_value->name.'">'; } } ?> </datalist> </div></td><td><select class="form-control selectpicker" data-live-search="true" id="unit' + newaddmore + '" name="componnetdata[' + newaddmore + '][unit]"><option value=""></option><?php if (isset($unit_list) && !empty($unit_list)){foreach ($unit_list as $value) {?><option value="<?php echo $value->id; ?>"><?php echo cc($value->name); ?></option><?php  }} ?></select></td><td><div class="form-group"><input class="form-control" type="number" name="componnetdata[' + newaddmore + '][quantity]"></div></td><td> <div class="form-group"> <input type="file" multiple="" name="images_'+newaddmore+'[]" class="form-control"> </div></td><td> <div class="form-group"> <textarea id="remarks" name="componnetdata[' + newaddmore + '][remarks]" class="form-control"></textarea> </div></td><td> <button type="button" class="btn pull-right btn-danger" onclick="removeprocomp(' + newaddmore + ');" ><i class="fa fa-remove"></i></button> </td></tr>');
        $('.selectpicker').selectpicker('refresh');
    });


    function removeprocomp(procompid)
    {
        $('#tr' + procompid).remove();
    }

    function staffdropdown()
    {
        $.each($("#assign option:selected"), function () {
            var select = $(this).val();
            $("optgroup." + select).children().attr('selected', 'selected');
        });
        $('.selectpicker').selectpicker('refresh');
        $.each($("#assign option:not(:selected)"), function () {
            var select = $(this).val();
            $("optgroup." + select).children().removeAttr('selected');
        });
        $('.selectpicker').selectpicker('refresh');
    }
    function staffapprovaldropdown()
    {
        $.each($("#sendapproval option:selected"), function () {
            var select = $(this).val();
            $("optgroup." + select).children().attr('selected', 'selected');
        });
        $('.selectpicker').selectpicker('refresh');
        $.each($("#sendapproval option:not(:selected)"), function () {
            var select = $(this).val();
            $("optgroup." + select).children().removeAttr('selected');
        });
        $('.selectpicker').selectpicker('refresh');
    }


</script>


<script type="text/javascript">
    $(document).on('click', '.addmore_model', function(){

        var row = parseInt($(this).attr('val'));
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);


          $('#table_'+row+' tbody').append('<tr id="trcf_'+row+'_'+newaddmore+'"><td><input class="form-control" name="customdata[product_field_'+row+']['+newaddmore+']" type="text" ></td><td><input class="form-control" name="customdata[product_value_'+row+']['+newaddmore+']" type="text" ></td><td><input class="form-control" name="customdata[product_remark_'+row+']['+newaddmore+']" type="text" ></td><td><button type="button" value="'+newaddmore+'" class="btn pull-right btn-danger" onclick="removeprofield('+row+','+newaddmore+');"><i class="fa fa-remove"></i></button></td></tr> ');

    });

    function removeprofield(row,procompid)
    {
        $('#trcf_'+row+'_'+procompid).remove();
    }

    var estimate_id = '<?php echo (isset($save_info)) ? $save_info->estimate_id : 0; ?>';
    var reason_for_request = '<?php echo (isset($save_info)) ? $save_info->reason_for_request : 0; ?>';
    if (estimate_id > 0){
      if (reason_for_request == 1){
         $(".estimate_div").show();
         $(".remarkdiv").removeClass("col-md-6");
         $(".remarkdiv").addClass("col-md-3");
      }else{
         $(".estimate_div").hide();
         $(".remarkdiv").removeClass("col-md-3");
         $(".remarkdiv").addClass("col-md-6");
      }
    }
    $(document).on("change", "#reason_for_request", function(){
        var val = $(this).val();
        if (val == 1){
           $(".estimate_div").show();
           $(".remarkdiv").removeClass("col-md-6");
           $(".remarkdiv").addClass("col-md-3");
        }else{
           $(".estimate_div").hide();
           $(".remarkdiv").removeClass("col-md-3");
           $(".remarkdiv").addClass("col-md-6");
        }
    });
</script>


</body>
</html>
