<?php init_head(); ?>

<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width:100%;height: 75px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>

<input id="check_gst" type='hidden' value="0">

<!-- Modal Contact -->

<div id="wrapper">

    <div class="content accounting-template">

        <a data-toggle="modal" id="modal" data-target="#myModal"></a>

        <div class="row">
            
            <?php echo form_open($this->uri->uri_string(), array('id' => 'proposal-form', 'class' => '_propsal_form proposal-form', 'enctype' => 'multipart/form-data')); ?>

            <div class="col-md-12">
                
                <div class="panel_s">

                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <div class="col-md-12">
                                <div class="row">
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
                                                        }elseif(isset($dchallan_info) && !empty($dchallan_info['vendor_id'])){
                                                            $vendor_id = $dchallan_info['vendor_id'];
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
                                        <div class="form-group">
                                            <label for="delivery_challan_return" class="control-label">Delivery Challan Number</label>
                                            <select class="form-control selectpicker challan_number" data-live-search="true" required="" id="challan_number" name="challan_number">
                                                <option value=""></option>
                                                <?php
                                                if (!empty($dchallan_info)) {

                                                    echo '<option value="' . $dchallan_info['id'] . '" selected>' . "JDC-" . $dchallan_info['id'] . ' - ' . _d($dchallan_info['date']) . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <?php
                                        
                                            $value = _d(date('Y-m-d'));
                                            $mr_number = mr_next_number();
                                            if (isset($materialreceipt_info) && !empty($materialreceipt_info)){
                                                $value = _d($materialreceipt_info->date);
                                                $mr_number = $materialreceipt_info->numer;
                                            }
                                        echo render_date_input('date', 'Material Receipt Date', $value);
                                        ?>
                                    </div>
                                    <div class="col-md-2">	
                                        <div class="form-group" app-field-wrapper="number">
                                            <label for="number" class="control-label">MR Number</label>
                                            <input type="text" id="number" name="number" class="form-control" value="<?php echo $mr_number; ?>">
                                        </div>
                                    </div> 
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="warehouse_id" class="control-label"><?php echo _l('stock_warehouse'); ?></label>
                                        <select class="form-control selectpicker warehouse_id" data-live-search="true" required="" id="warehouse_id" name="warehouse_id">
                                            <option value=""></option>
                                            <?php
                                            if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                                foreach ($all_warehouse as $all_warehouse_key => $all_warehouse_value) {
                                                    
                                                    $warehouse_id = "";
                                                    if (isset($materialreceipt_info) && !empty($materialreceipt_info)){
                                                        $warehouse_id = $all_warehouse_value['id'];
                                                    }
                                                    ?>
                                                    <option value="<?php echo $all_warehouse_value['id'] ?>" <?php echo ($warehouse_id == $all_warehouse_value['id']) ? 'selected' : "" ?>><?php echo $all_warehouse_value['name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="tax_type" class="control-label">Service Type</label>
                                        <?php
                                        
                                            $service_type = "";
                                            if (isset($materialreceipt_info) && !empty($materialreceipt_info)){
                                                $service_type = $materialreceipt_info->service_type;
                                            }elseif(isset($dchallan_info) && !empty($dchallan_info['service_type'])){
                                                $service_type = $dchallan_info['service_type'];
                                            }
                                        ?>
                                        <select class="form-control selectpicker" data-live-search="true" required="" id="service_type" name="service_type">
                                            <option value=""></option>
                                            <option value="1" <?php echo ($service_type == 1) ? 'selected' : ''; ?> >Rent</option>
                                            <option value="2" <?php echo ($service_type == 2) ? 'selected' : ''; ?>>Sales</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">	
                                        <div class="form-group" app-field-wrapper="challan_no">
                                            <label for="challan_no" class="control-label">Challan No.</label>
                                            <?php $challan_no = (isset($materialreceipt_info) && !empty($materialreceipt_info)) ? $materialreceipt_info->challan_no: ""; ?>
                                            <input type="text" id="challan_no" name="challan_no" class="form-control" value="<?php echo $challan_no; ?>">
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
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
                                            <label for="assign" class="control-label"><?php echo _l('stock_approve_by'); ?></label>
                                            <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" required="" name="assignid[]">
                                                <?php
                                                if (isset($stockdata['approvby'])) {
                                                    $approvby = explode(',', $stockdata['approvby']);
                                                }
                                                if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                                    foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                                        ?>
                                                        <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                                            <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                                            <?php
                                                            foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                                ?>
                                                                <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php if (isset($approvby) && in_array($singstaff['staffid'], $approvby)) {
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
                                        <?php
                                        $reference_no = (isset($materialreceipt_info) && !empty($materialreceipt_info)) ? $materialreceipt_info->reference_no : "";
                                        ?>
                                        <?php echo render_input('reference_no', 'reference_no', $reference_no); ?>
                                    </div> 
                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                                $adminnote = (isset($materialreceipt_info) && !empty($materialreceipt_info)) ? $materialreceipt_info->adminnote : "";
                                            ?>
                                            <label for="adminnote" class="control-label"><?php echo _l('stock_remarks'); ?></label>
                                            <textarea id="adminnote" class="form-control" name="adminnote"><?php echo $adminnote; ?></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="form-group col-md-2" app-field-wrapper="complete">
                                        <label for="complete" class="control-label">Mark as complete </label>
                                        <input type="checkbox" name="complete" value="1">
                                    </div>
                                </div>
                            </div>

                        <div class="btn-bottom-toolbar bottom-transaction text-right">
                            <button class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                <?php echo _l('send_for_approval'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row" id="purchase_table">
                            <div class="col-md-10">
                                <h4>Delivery Challan Product Details</h4>
                            </div>
                            <div class="col-md-12">
                                <hr/>
                            </div>
                            <div class="col-md-12">
                                <div >
                                    <div class="form-group" id="docAttachDivVideo" >
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                            <thead>
                                                <tr>
                                                    <td style="width: 1% !important;"><i class="fa fa-cog"></i></td>
                                                    <td style="width: 80px !important;"><?php echo _l('prop_pro_name'); ?></td>
                                                    <td style="width: 20px !important;"><?php echo _l('prop_pro_id'); ?></td>
                                                    <td style="width: 20px !important;">Unit</td>
                                                    <td style="width: 70px !important;">Remark</td>
                                                    <td style="width: 16px  !important;"><?php echo _l('prop_pro_qty'); ?></td>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        <div class="col-xs-12" style="margin-top: 40px;">
                                            <label class="label-control subHeads"><a class="addmoresalepro" value="0">Add More <i class="fa fa-plus"></i></a></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
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

   

    $(function () {

        init_currency_symbol();

        // Maybe items ajax search

        init_ajax_search('items', '#item_select.ajax-search', undefined, admin_url + 'items/search');

        validate_proposal_form();



        $('.rel_id_label').html(_rel_type.find('option:selected').text());

        _rel_type.on('change', function () {

            var clonedSelect = _rel_id.html('').clone();

            _rel_id.selectpicker('destroy').remove();

            _rel_id = clonedSelect;

            $('#rel_id_select').append(clonedSelect);

            proposal_rel_id_select();

            if ($(this).val() != '') {

                _rel_id_wrapper.removeClass('hide');

            } else {

                _rel_id_wrapper.addClass('hide');

            }

            $('.rel_id_label').html(_rel_type.find('option:selected').text());

        });

        proposal_rel_id_select();

    });
   

    function validate_proposal_form() {

        _validate_form($('#proposal-form'), {

            subject: 'required',

            proposal_to: 'required',

            rel_type: 'required',

            rel_id: 'required',

            date: 'required',

            email: {

                email: true,

                required: true

            },

            currency: 'required',

        });

    }

</script>

<script type="text/javascript">

    $('.addmoresalepro').click(function ()
    {

        var addmorerentpro = parseInt($(this).attr('value'));

        var check_gst = parseInt($('#check_gst').val());

        var newaddmorerentpro = addmorerentpro + 1;

        $(this).attr('value', newaddmorerentpro);

        if (check_gst == 0)

        {

            $('.saletable tbody').append('<tr class="trsalepro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removesalepro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select data-dropup-auto="false" class="form-control selectpicker pr_id" style="display:block !important;" onchange="getsaleprodata(' + newaddmorerentpro + ', this)" data-live-search="true" id="saleprodid' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php

if (isset($product_data) && count($product_data) > 0) {

    foreach ($product_data as $product_key => $product_value) {
        $product_code = product_code($product_value['id']);
        ?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'].$product_code ?></option><?php

    }

}

?></select><input class="form-control" type="hidden" id="salepro_name' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_is_temp' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][is_temp]" type="hidden"><input value="" id="salepro_id' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="" name="saleproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averagesaleprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" class="form-control" readonly id="salepro_pro_id_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="hidden" class="form-control" readonly id="salepro_unit_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][unit]"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="salepro_unit1_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][unit_id]"><option value=""></option><?php
    if(isset($unit_list) && count($unit_list)>0){
        foreach ($unit_list as $uvalue) {
            echo '<option value="'.$uvalue->id.'"">'.$uvalue->name.'</option>';
        }
    }
?></select></td><td><input type="text" id="salepro_pro_remark_' + newaddmorerentpro + '" class="form-control" name="saleproposal[' + newaddmorerentpro + '][remark]"></td><td><input type="number" class="form-control qty" id="saleqty_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][qty]"  min="1" value="1.00"></td></tr>');

        } else

        {

            $('.saletable tbody').append('<tr class="trsalepro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removesalepro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select data-dropup-auto="false" class="form-control selectpicker pr_id" style="display:block !important;" onchange="getsaleprodata(' + newaddmorerentpro + ', this)" data-live-search="true" id="saleprodid' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php

if (isset($product_data) && count($product_data) > 0) {

    foreach ($product_data as $product_key => $product_value) {

        ?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'].product_code($product_value['id']) ?></option><?php

    }

}

?></select><input class="form-control" id="salepro_name' + newaddmorerentpro + '" type="hidden" name="saleproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_id' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="" name="saleproposal[' + newaddmorerentpro + '][itemid]" type="hidden"></td><td><input type="text" class="form-control" id="salepro_pro_id_' + newaddmorerentpro + '" readonly name="saleproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="text" class="form-control" readonly id="salepro_unit_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][unit]"></td><td><input type="text" id="salepro_pro_remark_' + newaddmorerentpro + '" class="form-control" name="saleproposal[' + newaddmorerentpro + '][remark]"></td><td><input type="number" class="form-control qty" id="saleqty_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][qty]"  min="1" value="1.00"></td></tr>');

        }

        $('.selectpicker').selectpicker('refresh');

    });

    function removesalepro(value)
    {
        $('.trsalepro' + value).remove();
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

    function getsaleprodata(value, el)
    {
        var prodid = $('#saleprodid' + value).val();
        var vendor_id = $('#vendor_id').val();
        var service_type = $('#service_type').val();
        
        if (service_type != ""){
            var url = '<?php echo base_url(); ?>admin/jobdeliverychallan/getProductDetails';

            $.post(url,
            {
                prodid: prodid,
                service_type: service_type,
            },

            function (data, status) {
                
                var res = JSON.parse(data);
                
                /* this is for redirect to product details on next tab */
                var reurl = '<?php echo base_url(); ?>admin/product_new/view/'+prodid; 
                window.open(reurl, '_blank');

                $('#salepro_id' + value).val(prodid);
                $('#salepro_name' + value).val(res.name);
                $('#saleavailableqty_' + value).val(res.available_qty);
                $('#salepro_pro_id_' + value).val(res.pro_id);
                $('#salepro_unit_' + value).val(res.product_unit);
                $('#salepro_unit1_' + value).val(res.product_unit_id);

                $('.selectpicker').selectpicker('refresh');
            });
        }else{
            alert('Please select service type first!');
            $('#saleprodid' + value).val('');
        }
    }


    function removeclientperson(procompid)

    {

        $('#trcc' + procompid).remove();

    }

    

    function removeshipclientperson(procompid)

    {

        $('#trss' + procompid).remove();

    }

    $('.newsite').click(function () {

        $('.sitedv').fadeToggle();

    });

    $('.addsite').click(function ()

    {

        var sitename = $('#sitename').val();

        var sitestate_id = $('#sitestate_id').val();

        var sitelocation = $('#sitelocation').val();

        var sitedescription = $('#sitedescription').val();

        var siteaddress = $('#siteaddress').val();

        var sitelandmark = $('#sitelandmark').val();

        var sitepincode = $('#sitepincode').val();

        var sitecity_id = $('#sitecity_id').val();

        if (sitename != '' & sitelocation != '' & siteaddress != '' & sitelandmark != '' & sitepincode != '')

        {

            var url = '<?php echo base_url(); ?>admin/Site_manager/site_manager';

            var html = '<option value=""></option>';

            $.post(url,

                    {

                        newsitemanager: '1',

                        name: sitename,

                        state_id: sitestate_id,

                        location: sitelocation,

                        description: sitedescription,

                        address: siteaddress,

                        landmark: sitelandmark,

                        pincode: sitepincode,

                        city_id: sitecity_id,

                    },

                    function (result, status) {

                        var resArr = $.parseJSON(result);

                        $.each(resArr, function (k, v) {

                            html += '<option value="' + v.id + '">' + v.name + '</option>';

                        });

                       // $("#site_id").html('').html(html);

                        $('.selectpicker').selectpicker('refresh');

                        $('.sitedv').find('input:text').val('');

                        $('.sitedv').fadeToggle();

                        $('#sitename').removeClass('error');

                        $('#sitelocation').removeClass('error');

                        $('#siteaddress').removeClass('error');

                        $('#sitelandmark').removeClass('error');

                        $('#sitepincode').removeClass('error');

                    });

        } else

        {

            if (sitename == '')

            {

                $('#sitename').addClass('error');

            } else

            {

                $('#sitename').removeClass('error');

            }

            if (sitelocation == '')

            {

                $('#sitelocation').addClass('error');

            } else

            {

                $('#sitelocation').removeClass('error');

            }

            if (siteaddress == '')

            {

                $('#siteaddress').addClass('error');

            } else

            {

                $('#siteaddress').removeClass('error');

            }

            if (sitelandmark == '')

            {

                $('#sitelandmark').addClass('error');

            } else

            {

                $('#sitelandmark').removeClass('error');

            }

            if (sitepincode == '')

            {

                $('#sitepincode').addClass('error');

            } else

            {

                $('#sitepincode').removeClass('error');

            }

        }

    });

    function get_city_by_stateval(state_id) {

        var html = '<option value=""></option>';



        if (state_id == "") {

            $("#sitecity_id").html('').html(html);

            $('.selectpicker').selectpicker('refresh');

            return false;

        }



        $.ajax({

            url: admin_url + 'site_manager/get_cities_by_state_id/' + state_id,

            method: 'GET',

            success(res) {

                if (res != "") {

                    var resArr = $.parseJSON(res);

                    $.each(resArr, function (k, v) {

                        html += '<option value="' + v.id + '">' + v.name + '</option>';

                    });

                }

                $("#sitecity_id").html('').html(html);

                $('.selectpicker').selectpicker('refresh');

            }

        });

    }

    $('.addcont').click(function () {

        var formData = $('#contact-form').serialize();

        $.ajax({

            url: '<?php echo base_url(); ?>admin/Estimates/add_cont',

            type: 'post',

            data: formData,

            success: function (data, status) {

                jQuery('.close').click();

                dropdownlist();

            }

        });
    });

    function dropdownlist()

    {

        var html = '<option value=""></option>';

        var clintid = $('#clientid').val();

        $.ajax({

            url: admin_url + 'Estimates/getcompnycontact/' + clintid,

            method: 'GET',

            success(res) {

                if (res != "") {

                    var resArr = $.parseJSON(res);

                    $.each(resArr, function (k, v) {

                        html += '<option value="' + v.id + '">' + v.firstname + '</option>';

                    });

                }

                $("#staff_id0").html('').html(html);

                $("#shipstaff_id0").html('').html(html);

                $('.selectpicker').selectpicker('refresh');

            }

        });

    }

    function contact(client_id, contact_id) {

        var client_id = $('#clientid').val();

        if (typeof (contact_id) == 'undefined') {

            contact_id = '';

        }

        requestGet('clients/contact/' + client_id + '/' + contact_id).done(function (response) {

            $('#contact_data').html(response);

            $('#contact').modal({

                show: true,

                backdrop: 'static'

            });

            $('body').off('shown.bs.modal', '#contact');

            $('body').on('shown.bs.modal', '#contact', function () {

                if (contact_id == '') {

                    $('#contact').find('input[name="firstname"]').focus();

                }

            });

            init_selectpicker();

            init_datepicker();

            custom_fields_hyperlink();

            validate_contact_form();

        }).fail(function (error) {

            var response = JSON.parse(error.responseText);

            alert_float('danger', response.message);

        });

    }


</script>

<?php if (!isset($contact)) { ?>

    <script>

        $(function () {

            // Guess auto email notifications based on the default contact permissios

            var permInputs = $('input[name="permissions[]"]');

            $.each(permInputs, function (i, input) {

                input = $(input);

                if (input.prop('checked') === true) {

                    $('#contact_email_notifications [data-perm-id="' + input.val() + '"]').prop('checked', true);

                }

            });

        });

    </script>

<?php } ?>

<script type="text/javascript">

     $('.onlynumbers').keypress(function(event){



       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){

           event.preventDefault(); //stop character from entering input

       }



   });

</script>
<script type="text/javascript">

    $('#vendor_id').change(function () {
        var vendor_id = $('#vendor_id').val();
        if(vendor_id > 0){
            var url = '<?php echo base_url(); ?>admin/Purchase/getvendordtails';
            $.post(url,
                    {
                        vendor_id: vendor_id,
                    },
                    function (data, status) {
                        var res = JSON.parse(data);
                        if(res != ''){
                            $('.billing_street').html(res.address);
                            $('#billing_street').val(res.address);
                            $('.billing_state').html(res.state_name);
                            $('#billing_state').val(res.state_name);
                            $('.billing_city').html(res.city_name);
                            $('#billing_city').val(res.city_name);
                            $('.billing_zip').html(res.pincode);
                            $('#billing_zip').val(res.pincode);
                            $('.billing_country').html('India');
                            $('#billing_country').val('India');
                            tinymce.get("product_terms_and_conditions").setContent(res.product_term_condition);
                        }                       

                    });
        }
    });  


    $('#site_id').change(function(){
        var site_id=$('#site_id').val();
        var url = '<?php echo base_url(); ?>admin/Site_manager/getsitedetails';
        $.post(url,
                {
                    site_id: site_id,
                },
                function (data, status) {
                    var res=JSON.parse(data);
                    

                    $('.shipping_street').html(res.address);
                    $('#shipping_street').val(res.address);
                    $('.shipping_state').html(res.state_name);
                    $('#shipping_state').val(res.state_name);
                    $('.shipping_city').html(res.city_name);
                    $('#shipping_city').val(res.city_name);
                    $('.shipping_zip').html(res.pincode);
                    $('#shipping_zip').val(res.pincode);
                });       

    });
</script>





<script type="text/javascript">

    $( document ).ready(function() {

        var vendor_id = $('#vendor_id').val();

        if(vendor_id > 0){
            var url = '<?php echo base_url(); ?>admin/Purchase/getvendordtails';
            $.post(url,
                    {
                        vendor_id: vendor_id,
                    },
                    function (data, status) {
                        var res = JSON.parse(data);
                        if(res != ''){
                            $('.billing_street').html(res.address);
                            $('#billing_street').val(res.address);
                            $('.billing_state').html(res.state_name);
                            $('#billing_state').val(res.state_name);
                            $('.billing_city').html(res.city_name);
                            $('#billing_city').val(res.city_name);
                            $('.billing_zip').html(res.pincode);
                            $('#billing_zip').val(res.pincode);
                            $('.billing_country').html('India');
                            $('#billing_country').val('India');
                        }                        

                    });
        }


        var warehouse_id = $('#warehouse_id').val();
        var site_id = $('#site_id').val();
        //alert(site_id);
        if(warehouse_id > 0){
            var url = '<?php echo base_url(); ?>admin/Purchase/getwarehousedtails';
                $.post(url,
                {
                    warehouse_id: warehouse_id,
                },
                function (data, status) {
                    var res = JSON.parse(data);
                    $('.shipping_street').html(res.address);
                    $('#shipping_street').val(res.address);
                    $('.shipping_state').html(res.state_name);
                    $('#shipping_state').val(res.state_name);
                    $('.shipping_city').html(res.city_name);
                    $('#shipping_city').val(res.city_name);
                    $('.shipping_zip').html(res.pincode);
                    $('#shipping_zip').val(res.pincode);
                    $('.shipping_country').html('India');
                    $('#shipping_country').val('India');

                });
        }

        if(site_id > 0){
            var url = '<?php echo base_url(); ?>admin/Site_manager/getsitedetails';
            $.post(url,
                    {
                        site_id: site_id,
                    },
                    function (data, status) {
                        var res=JSON.parse(data);
                        

                        $('.shipping_street').html(res.address);
                        $('#shipping_street').val(res.address);
                        $('.shipping_state').html(res.state_name);
                        $('#shipping_state').val(res.state_name);
                        $('.shipping_city').html(res.city_name);
                        $('#shipping_city').val(res.city_name);
                        $('.shipping_zip').html(res.pincode);
                        $('#shipping_zip').val(res.pincode);
                    });
        }
           

    });

</script>

<script type="text/javascript">

	$('#vendor_id').change(function(){

	var vendor_id = $(this).val();

            $.ajax({

                type    : "POST",

                url     : "<?php echo base_url(); ?>admin/Purchase/get_deliverychallan_number",

                data    : {'vendor_id' : vendor_id},

                success : function(response){

                    if(response != ''){

                        $("#challan_number").html(response);

                        $('.selectpicker').selectpicker('refresh');

                    }else{
                        $("#challan_number").html("");
                        $('.selectpicker').selectpicker('refresh');
                    }

                }

           })

	});

</script> 
</body>

</html>

