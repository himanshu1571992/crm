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
                                <h4><?php echo $title;?></h4>
                                <hr/>
                            </div>     
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="source" class="control-label">Customer</label>
                                            <select class="form-control selectpicker" name="client_id" id="client_id" data-live-search="true">
                                                <option value=""></option>
                                                <?php
                                                if (isset($client_data) && count($client_data) > 0) {
                                                    foreach ($client_data as $value) {
                                                        $selected = ($complain_info->client_id == $value->userid) ? "selected=''": "";
                                                        ?>
                                                <option value="<?php echo $value->userid ?>" <?php echo $selected; ?>><?php echo cc($value->company); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">   
                                        <div class="form-group ">
                                            <label for="source" class="control-label">Complain Type</label>
                                            <select class="form-control selectpicker" name="complain_type_id" id="complain_type" data-live-search="true">
                                                <option value=""></option>
                                                <?php
                                                if (isset($complain_type_data) && count($complain_type_data) > 0) {
                                                    foreach ($complain_type_data as $val) {
                                                        ?>
                                                        <option value="<?php echo $val->id ?>" <?php echo (isset($complain_info) && $complain_info->complain_type_id == $val->id) ? "selected": ""?>><?php echo cc($val->title); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">   
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="complain_date" class="control-label">Complain Date</label>
                                                <div class="input-group date">
                                                    <input id="complain_date" name="complain_date" required="" class="form-control datepicker" value="<?php echo (isset($complain_info)) ? _d($complain_info->complain_date) : date("d/m/Y"); ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="resolve_till" class="control-label">Resolve Till</label>
                                                <div class="input-group date">
                                                    <input id="resolve_till" name="resolve_till" required="" class="form-control datepicker" value="<?php echo (isset($complain_info)) ? _d($complain_info->resolve_till) : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>    
                                <div class="row">    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="location" class="control-label">Location</label>
                                            <input type="text" id="location" class="form-control" value="<?php echo (isset($complain_info)) ? $complain_info->location : ""; ?>" name="location">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="remark" class="control-label">Assign</label>
                                            <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assignid[]" required="">
                                                <option>Select</option>
                                                <?php
                                                if (isset($allStaffdata) && count($allStaffdata) > 0) {

                                                    foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                                        ?>

                                                        <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">

                                                            <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>

                                                            <?php
                                                            foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                                ?>
                                                                <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php if (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) {
                                                                    echo'selected';
                                                                    } ?>><?php echo $singstaff['firstname'] ?></option>

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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="remark" class="control-label">Remark</label>
                                            <textarea id="remark" rows="5" name="remark" class="form-control" placeholder="remark..."><?php echo (isset($complain_info)) ? $complain_info->remark : ""; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="table-responsive s_table compdv">
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable" style="margin-top:2%; !important">
                                            <thead>
                                                <tr>
                                                    <th width="35%" align="left">Product Name</th>
                                                    <th width="10%" align="left">Quantity</th>
                                                    <th width="20%" align="left">Defect Remarks</th>
                                                    <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody class="ui-sortable">
                                                <?php
                                                    if (!empty($complain_products)){
                                                        foreach ($complain_products as $key => $value) {
                                                           
                                                ?>
                                                            <tr class="main" id="tr<?php echo $key;?>">
                                                                <td>
                                                                    <div class="form-group">
                                                                        <select class="form-control selectpicker" data-live-search="true" id="assign" name="complaindata[<?php echo $key;?>][product_id]" required="">
                                                                            <option></option>
                                                                                <?php
                                                                                if (isset($product_data) && count($product_data) > 0) {

                                                                                    foreach ($product_data as $product_data_key => $product_data_value) {
                                                                                ?>
                                                                                    <option value="<?php echo $product_data_value["id"] ?>" <?php echo ($value->product_id==$product_data_value["id"]) ? "selected=''": "" ?> ><?php echo cc($product_data_value["name"]); ?></option>
                                                                                <?php
                                                                                    }
                                                                                }    
                                                                                ?>
                                                                        </select>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="number" value="<?php echo $value->qty;?>" name="complaindata[<?php echo $key;?>][qty]">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <textarea id="remarks" name="complaindata[<?php echo $key;?>][defect_remark]" class="form-control"><?php echo $value->defect_remark;?></textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removeprocomp(<?php echo $key;?>);" ><i class="fa fa-remove"></i></button>
                                                                </td>
                                                            </tr>
                                                <?php   }
                                                    }else{
                                                ?>
                                                            <tr class="main" id="tr0">
                                                                <td>
                                                                    <div class="form-group">
                                                                        <select class="form-control selectpicker" data-live-search="true" id="assign" name="complaindata[0][product_id]" required="">
                                                                            <option></option>
                                                                                <?php
                                                                                if (isset($product_data) && count($product_data) > 0) {

                                                                                    foreach ($product_data as $product_data_key => $product_data_value) {
                                                                                ?>
                                                                                    <option value="<?php echo $product_data_value["id"] ?>" ><?php echo cc($product_data_value["name"]); ?></option>
                                                                                <?php
                                                                                    }
                                                                                }    
                                                                                ?>
                                                                        </select>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="number" name="complaindata[0][qty]">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <textarea id="remarks" name="complaindata[0][defect_remark]" class="form-control"></textarea>
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
                                            <label class="label-control subHeads"><a  class="addmore" value="<?php if (!empty($complain_products)) {
                                                                    count($complain_products);
                                                                } else {
                                                                    echo '0';
                                                                } ?>">Add More <i class="fa fa-plus"></i></a></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo _l('submit'); ?>
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
<script>
    $('.addmore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myTable tbody').first().append('<tr class="main" id="tr' + newaddmore + '"> <td> <div class="form-group"> <select class="form-control selectpicker" data-live-search="true" id="assign" name="complaindata[' + newaddmore + '][product_id]" required=""><option value=""></option><?php

if (isset($product_data) && count($product_data) > 0) {

    foreach ($product_data as $product_key => $product_value) {
        if ($product_value['is_temp'] == 0) {
            $product_code = product_code($product_value['id']);
        } else {
            $product_code = temp_product_code($product_value['id']);
        }
        ?><option data-is_temp="<?php echo $product_value['is_temp']; ?>" value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'].$product_code ?></option><?php

    }

}

?></select> </div></td><td><div class="form-group"><input class="form-control" type="number" name="complaindata[' + newaddmore + '][qty]"></div></td><td> <div class="form-group"> <textarea id="remarks" name="complaindata[' + newaddmore + '][defect_remark]" class="form-control"></textarea> </div></td><td> <button type="button" class="btn pull-right btn-danger" onclick="removeprocomp(' + newaddmore + ');" ><i class="fa fa-remove"></i></button> </td></tr>');
$('.selectpicker').selectpicker('refresh');
    
    });
    
    
    function removeprocomp(procompid)
    {
        $('#tr' + procompid).remove();
    }

    /*function staffdropdown()
    {
        $.each($("#assign option:selected"), function(){
           var select=$(this).val();   
           $("optgroup."+select).children().attr('selected','selected');
        });
        $('.selectpicker').selectpicker('refresh');
        $.each($("#assign option:not(:selected)"), function(){
           var select=$(this).val();   
           $("optgroup."+select).children().removeAttr('selected');
        });
        $('.selectpicker').selectpicker('refresh');
    }*/
   
    
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
</script>


</body>
</html>
