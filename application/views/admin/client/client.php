
<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'client-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3><?php
                                    if (isset($client['userid']))
                                        echo _l('edit_client');
                                    else
                                        echo _l('add_client');
                                    ?></h3>
                                <hr/>
                            </div>
                            <?php if (!isset($client['userid'])){ ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="branchcompany" class="control-label">Creating Branch Name With Location</label>
                                    <input type="checkbox" id="branch_with_location" name="branch_with_location" checked>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label for="company" class="control-label"><?php echo _l('client_name'); ?>*</label>
                                    <input type="text" id="company" name="company" class="form-control" value="<?php echo (isset($client['company']) && $client['company'] != "") ? $client['company'] : "" ?>">
                                </div>
                                <div class="form-group">
                                    <label for="phone_no_1" class="control-label"><?php echo _l('client_number1'); ?>*</label>
                                    <input type="text" id="phone_no_1" minlength="10" maxlength="10" name="phone_no_1" class="form-control contact1 onlynumbers" value="<?php echo (isset($client['phone_no_1']) && $client['phone_no_1'] != "") ? $client['phone_no_1'] : "" ?>"><span id="phonenumberdiv1"></span>
                                </div>

                                <div class="form-group">
                                    <label for="phone_no_2" class="control-label"><?php echo _l('client_number2'); ?></label>
                                    <input type="text" id="phone_no_2" minlength="10" maxlength="10" name="phone_no_2" class="form-control contact2 onlynumbers" value="<?php echo (isset($client['phone_no_2']) && $client['phone_no_2'] != "") ? $client['phone_no_2'] : "" ?>"><span id="phonenumberdiv2"></span>
                                </div>

                                <div class="form-group">
                                    <label for="client_person_name" class="control-label">Client Person Name</label>
                                    <input type="text" id="client_person_name" name="client_person_name" class="form-control" value="<?php echo (isset($client['client_person_name']) && $client['client_person_name'] != "") ? $client['client_person_name'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="password" class="control-label"><?php echo _l('client_pass'); ?>*</label>
                                    <input type="password" id="password" name="password" class="form-control" value="<?php echo (isset($client['password']) && $client['password'] != "") ? $client['password'] : "" ?>">
                                </div>
                                <div class="form-group">
                                    <label for="website" class="control-label"><?php echo _l('client_web'); ?></label>
                                    <input type="text" id="website" name="website" class="form-control" value="<?php echo (isset($client['website']) && $client['website'] != "") ? $client['website'] : "" ?>">
                                </div>
                                <!-- <div class="form-group">
    <label for="address" class="control-label"><?php echo _l('Address'); ?>*</label>
    <textarea id="address" name="address" class="form-control"><?php echo (isset($client['address']) && $client['address'] != "") ? $client['address'] : "" ?></textarea>
</div> -->

                                <div class="form-group">
                                    <label for="state_id" class="control-label"><?php echo _l('site_state'); ?>*</label>
                                    <select class="form-control selectpicker"  id="state" name="state" onchange="get_city_by_state(this.value)" data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                        if (isset($state_data) && count($state_data) > 0) {
                                            foreach ($state_data as $state_key => $state_value) {
                                                ?>
                                                <option value="<?php echo $state_value['id'] ?>" <?php echo (isset($client['state']) && $client['state'] == $state_value['id']) ? 'selected' : "" ?>><?php echo cc($state_value['name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="address" class="control-label"><?php echo _l('Address'); ?>*</label>
                                    <input type="text" id="address" name="address" class="form-control" value="<?php echo (isset($client['address']) && $client['address'] != "") ? $client['address'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="landmark" class="control-label"><?php echo _l('client_landmark'); ?>*</label>
                                    <input type="text" id="landmark" name="landmark" class="form-control" value="<?php echo (isset($client['landmark']) && $client['landmark'] != "") ? $client['landmark'] : "" ?>">
                                </div>
                                <div class="form-group">
                                    <label for="followup" class="control-label">Followup Status *</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="followup" name="followup">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($client['followup']) && $client['followup'] == 1) ? 'selected' : "" ?>>On</option>
                                        <option value="0" <?php echo (isset($client['followup']) && $client['followup'] == 0) ? 'selected' : "" ?>>Off</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="multiple_mobile" class="control-label">Multiple Mobile <small>(Comma Separated)</small></label>
                                    <textarea id="multiple_mobile" name="multiple_mobile" class="form-control"><?php echo (isset($client['multiple_mobile']) && $client['multiple_mobile'] != "") ? $client['multiple_mobile'] : "" ?></textarea>
                                </div>
                                <?php
                                    if($section == "add"){
                                ?>
                                <div class="form-group">
                                    <label for="vendor_id" class="control-label">Select Vendor <span data-toggle="tooltip" data-placement="right" title="If Client is our Vendor"><i class="fa fa-info-circle" aria-hidden="true"></i></span></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="vendor_id" name="vendor_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($vendor_list) && count($vendor_list) > 0) {
                                            foreach ($vendor_list as $vendor_key => $vendor_value) {
                                                ?>
                                                <option value="<?php echo $vendor_value->id; ?>" <?php echo (isset($client['vendor_id']) && $client['vendor_id'] == $vendor_value->id) ? 'selected' : "" ?>><?php echo cc($vendor_value->name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>  
                                <?php } ?>      
                            </div>
                            <div class="col-md-6">	
                                <div class="form-group">
                                    <label for="location" class="control-label"><?php echo _l('client_loc'); ?>*</label>
                                    <input type="text" id="location" name="location" class="form-control" value="<?php echo (isset($client['location']) && $client['location'] != "") ? $client['location'] : "" ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email_id" class="control-label"><?php echo _l('client_mail'); ?>*</label>
                                    <input type="text" id="email_id" name="email_id" class="form-control" value="<?php echo (isset($client['email_id']) && $client['email_id'] != "") ? $client['email_id'] : "" ?>">
                                </div> 
                                <div class="form-group">
                                    <label for="client_cat_id" class="control-label"><?php echo _l('client_cat'); ?>*</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="client_cat_id" name="client_cat_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($client_category_data) && count($client_category_data) > 0) {
                                            foreach ($client_category_data as $client_category_key => $client_category_value) {
                                                ?>
                                                <option value="<?php echo $client_category_value['id'] ?>" <?php echo (isset($client['client_cat_id']) && $client['client_cat_id'] == $client_category_value['id']) ? 'selected' : "" ?>><?php echo cc($client_category_value['category_name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pan_no" class="control-label"><?php echo _l('client_pan'); ?></label>
                                    <input type="text" id="pan_no" name="pan_no" class="form-control" value="<?php echo (isset($client['pan_no']) && $client['pan_no'] != "") ? $client['pan_no'] : "" ?>">
                                </div>
                                <div class="form-group">
                                    <label for="vat" class="control-label"><?php echo _l('client_gst'); ?></label>
                                    <input type="text" id="vat" name="vat" class="form-control"  value="<?php echo (isset($client['vat']) && $client['vat'] != "") ? $client['vat'] : "" ?>">
                                </div>
                                <div class="form-group">
                                    <label for="cin_no" class="control-label"><?php echo _l('client_cin_no'); ?>*</label>
                                    <input type="text" id="cin_no" name="cin_no" class="form-control" value="<?php echo (isset($client['cin_no']) && $client['cin_no'] != "") ? $client['cin_no'] : "" ?>">
                                </div>
                                <div class="form-group">
                                    <label for="city_id" class="control-label"><?php echo _l('site_city'); ?>*</label>
                                    <select class="form-control selectpicker" id="city_id" name="city" data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                        if (isset($city_data) && count($city_data) > 0) {
                                            foreach ($city_data as $city_key => $city_value) {
                                                ?>
                                                <option value="<?php echo $city_value['id'] ?>" <?php echo (isset($client['city']) && $client['city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
                                                <?php
                                            }
                                        } else if (isset($client['city']) & $client['city'] != '') {
                                            foreach ($allcity as $city_key => $city_value) {
                                                ?>
                                                <option value="<?php echo $city_value['id'] ?>" <?php echo (isset($client['city']) && $client['city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="zip" class="control-label"><?php echo _l('client_postal_code'); ?> *</label>
                                    <input type="text" id="zip" name="zip" class="form-control" value="<?php echo (isset($client['zip']) && $client['zip'] != "") ? $client['zip'] : "" ?>">
                                </div>


                                <div class="form-group">
                                    <label for="opening" class="control-label">Outstanding opening</label>
                                    <input type="text" id="opening" name="opening" class="form-control" value="<?php echo (isset($client['opening']) && $client['opening'] != "") ? $client['opening'] : "" ?>">
                                </div>


                                <div class="form-group">
                                    <label for="multiple_email" class="control-label">Multiple Email <small>(Comma Separated)</small></label>
                                    <textarea id="multiple_email" name="multiple_email" class="form-control"><?php echo (isset($client['multiple_email']) && $client['multiple_email'] != "") ? $client['multiple_email'] : "" ?></textarea>
                                </div>
                                <?php
                                    if($section == "add"){
                                ?>
                                <div class="form-group">
                                    <label for="assign_sales_parson" class="control-label"> Assign Sales Parson</label>
                                    <select class="form-control selectpicker" data-live-search="true" multiple="" id="sales_parson" name="sales_parson[]">
                                        <option value=""></option>
                                        <?php
                                        if (isset($sales_person_info) && count($sales_person_info) > 0) {
                                            foreach ($sales_person_info as $sales_person_key => $sales_person_value) {
                                                $selected = "";
                                                if (!empty($client['sales_parson'])){
                                                    $sales_parsons = explode(",", $client['sales_parson']);
                                                    $selected = (in_array($sales_person_value->sales_person_id, $sales_parsons)) ? "selected=''" : "";
                                                }
                                                ?>
                                                <option value="<?php echo $sales_person_value->sales_person_id ?>" <?php echo $selected; ?>><?php echo cc(get_employee_name($sales_person_value->sales_person_id)); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php } ?>
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
            init_selectpicker();</script>
<script>
            init_selectpicker();
            function get_city_by_state(state_id) {
            var html = '<option value=""></option>';
                    if (state_id == "") {
            $("#city_id").html('').html(html);
                    $('.selectpicker').selectpicker('refresh');
                    return false;
            }

            $.ajax({
            url : admin_url + 'site_manager/get_cities_by_state_id/' + state_id,
                    method : 'GET',
                    success(res) {
            if (res != "") {
            var resArr = $.parseJSON(res);
                    $.each(resArr, function(k, v) {
                    html += '<option value="' + v.id + '">' + v.name + '</option>';
                    });
            }
            $("#city_id").html('').html(html);
                    $('.selectpicker').selectpicker('refresh');
            }
            });
            }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.contact1').keyup(function() {
            $('span.error-keyup-3').remove();
            var inputVal = $(this).val();
            var characterReg = /^([0-9]{0,10})$/;
            if (!characterReg.test(inputVal)) {
                $(this).after('<span class="error error-keyup-3" style="color: red">Only Numeric, Maximum 10 characters.</span>');
            }
        });
    });
    
    $(function() {
        $('.contact1').on('keypress', function(e) {
            $('span.error-keyup-4').remove();
            if (e.which == 32){
                $("#phonenumberdiv1").html('<span class="error error-keyup-4" style="color: red;">Space not allowed</span>');
                console.log('Space Detected');
                return false;
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.contact2').keyup(function() {
            $('span.error-keyup-3').remove();
            var inputVal = $(this).val();
            var characterReg = /^([0-9]{0,10})$/;
            if (!characterReg.test(inputVal)) {
                $(this).after('<span class="error error-keyup-3" style="color: red">Only Numeric, Maximum 10 characters.</span>');
            }
        });
    });

    $(function() {
        $('.contact2').on('keypress', function(e) {
            $('span.error-keyup-4').remove();
            if (e.which == 32){
                $("#phonenumberdiv2").html('<span class="error error-keyup-4" style="color: red;">Space not allowed</span>');
                console.log('Space Detected');
                return false;
            }
        });
    });
            var validateEmail = function(elementValue) {
                    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                    return emailPattern.test(elementValue);
                }
    $('#email_id').keyup(function() {

        var value = $(this).val();
        var valid = validateEmail(value);
        if (!valid) {
            $(this).css('color', 'red');
        } else {
            $(this).css('color', '#000');
        }
    });

    $('.onlynumbers').keypress(function(event){

        if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
            event.preventDefault(); //stop character from entering input
        }
    });
</script>
</body>
</html>
