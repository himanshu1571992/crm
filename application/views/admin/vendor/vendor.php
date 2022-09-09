<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'vendor-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            
                            <div class="col-md-12">
                                <h3><?php
                                    if (isset($vendor['id']))
                                        echo _l('edit_vendor');
                                    else
                                        echo _l('add_vendor');
                                    ?></h3>
                                <hr/>
                            </div>
                            
                            <div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="control-label"><?php echo _l('vendor_name'); ?> *</label>
                                        <?php
                                            if (isset($_GET['req_vendor_id'])){
                                                $vendor_name = value_by_id("tblrequirement_productvendors", $_GET['req_vendor_id'], 'vendor_name');
                                            }else{
                                                $vendor_name = (isset($vendor['name']) && $vendor['name'] != "") ? $vendor['name'] : "";
                                            }
                                        ?>
                                        <input type="text" id="name" name="name" class="form-control" value="<?php echo $vendor_name; ?>" required="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contact_number" class="control-label"><?php echo _l('vendor_contact_number'); ?></label>
                                                <input type="text" id="contact_number" name="contact_number" minlength="10" maxlength="10" class="form-control onlynumbers" value="<?php echo (isset($vendor['contact_number']) && $vendor['contact_number'] != "") ? $vendor['contact_number'] : "" ?>"><span id="phonenumberdiv0"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="vendor_contact_person" class="control-label">Vendor Contact Parson</label>
                                                <input type="text" id="vendor_contact_person" name="vendor_contact_person" class="form-control" value="<?php echo (isset($vendor['vendor_contact_person']) && $vendor['vendor_contact_person'] != "") ? $vendor['vendor_contact_person'] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="control-label"><?php echo _l('vendor_description'); ?></label>
                                    <textarea id="description" name="description" class="form-control"><?php echo (isset($vendor['description']) && $vendor['description'] != "") ? $vendor['description'] : "" ?></textarea>
                                </div>
                            </div>
                            
                            <div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="control-label"><?php echo _l('vendor_email'); ?> *</label>
                                        <input type="email" id="email" name="email" class="form-control" value="<?php echo (isset($vendor['email']) && $vendor['email'] != "") ? $vendor['email'] : "" ?>" required="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state_id" class="control-label"><?php echo _l('vendor_business_type'); ?></label>
                                        <select class="form-control selectpicker" id="business_type_id" name="business_type_id" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                            if (isset($business_type_data) && count($business_type_data) > 0) {
                                                foreach ($business_type_data as $business_type_key => $business_type_value) {
                                                    ?>
                                                    <option value="<?php echo $business_type_value['id'] ?>" <?php echo (isset($vendor['business_type_id']) && $vendor['business_type_id'] == $business_type_value['id']) ? 'selected' : "" ?>><?php echo cc($business_type_value['name']); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="clear: both;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gst_no" class="control-label"><?php echo _l('vendor_gst_no'); ?></label>
                                        <input type="text" id="gst_no" name="gst_no" class="form-control" value="<?php echo (isset($vendor['gst_no']) && $vendor['gst_no'] != "") ? $vendor['gst_no'] : "" ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pan_no" class="control-label"><?php echo _l('vendor_pan_no'); ?></label>
                                        <input type="text" id="pan_no" name="pan_no" class="form-control" value="<?php echo (isset($vendor['pan_no']) && $vendor['pan_no'] != "") ? $vendor['pan_no'] : "" ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cin_no" class="control-label"><?php echo _l('vendor_cin_no'); ?></label>
                                        <input type="text" id="cin_no" name="cin_no" class="form-control" value="<?php echo (isset($vendor['cin_no']) && $vendor['cin_no'] != "") ? $vendor['cin_no'] : "" ?>">
                                    </div>
                                </div>

                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location" class="control-label"><?php echo _l('vendor_location'); ?></label>
                                        <input type="text" id="location" name="location" class="form-control" value="<?php echo (isset($vendor['location']) && $vendor['location'] != "") ? $vendor['location'] : "" ?>">
                                    </div>
                                </div> 
							</div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address" class="control-label"><?php echo _l('vendor_address'); ?></label>
                                    <textarea id="address" name="address" class="form-control"><?php echo (isset($vendor['address']) && $vendor['address'] != "") ? $vendor['address'] : "" ?></textarea>
                                </div>
                            </div>
                            
                            <div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state_id" class="control-label"><?php echo _l('vendor_state'); ?></label>
                                        <select class="form-control selectpicker" id="state_id" name="state_id" onchange="get_city_by_state(this.value)" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                            if (isset($state_data) && count($state_data) > 0) {
                                                foreach ($state_data as $state_key => $state_value) {
                                                    ?>
                                                    <option value="<?php echo $state_value['id'] ?>" <?php echo (isset($vendor['state_id']) && $vendor['state_id'] == $state_value['id']) ? 'selected' : "" ?>><?php echo cc($state_value['name']); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city_id" class="control-label"><?php echo _l('vendor_city'); ?></label>
                                        <select class="form-control selectpicker" id="city_id" name="city_id" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                            if (isset($city_data) && count($city_data) > 0) {
                                                foreach ($city_data as $city_key => $city_value) {
                                                    ?>
                                                    <option value="<?php echo $city_value['id'] ?>" <?php echo (isset($vendor['city_id']) && $vendor['city_id'] == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="landmark" class="control-label"><?php echo _l('vendor_landmark'); ?></label>
                                        <input type="text" id="landmark" name="landmark" class="form-control" value="<?php echo (isset($vendor['landmark']) && $vendor['landmark'] != "") ? $vendor['landmark'] : "" ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pincode" class="control-label"><?php echo _l('vendor_pincode'); ?></label>
                                        <input type="text" id="location" name="pincode" class="form-control" value="<?php echo (isset($vendor['pincode']) && $vendor['pincode'] != "") ? $vendor['pincode'] : "" ?>">
                                    </div>
                                </div>
                            </div>
                            

                            <div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account_no" class="control-label">Bank A/c No.</label>
                                        <input type="text" id="account_no" name="account_no" class="form-control" value="<?php echo (isset($vendor['account_no']) && $vendor['account_no'] != "") ? $vendor['account_no'] : "" ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ifsc" class="control-label">IFSC No.</label>
                                        <input type="text" id="ifsc" name="ifsc" class="form-control" value="<?php echo (isset($vendor['ifsc']) && $vendor['ifsc'] != "") ? $vendor['ifsc'] : "" ?>">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="lead_time" class="control-label">Lead Time <small>(In Days)</small></label>
                                        <input type="number" id="lead_time" name="lead_time" class="form-control" value="<?php echo (isset($vendor['lead_time']) && $vendor['lead_time'] != "") ? $vendor['lead_time'] : "" ?>">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="payment_terms" class="control-label">Payment Terms <small>(In Days)</small></label>
                                        <input type="number" id="payment_terms" name="payment_terms" class="form-control" value="<?php echo (isset($vendor['payment_terms']) && $vendor['payment_terms'] != "") ? $vendor['payment_terms'] : "" ?>">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="control-label"><?php echo _l('vendor_status'); ?> *</label>
                                        <select class="form-control selectpicker" name="status" required="">
                                            <option value=""></option>
                                            <option value="1" <?php echo (isset($vendor['status']) && $vendor['status'] == 1) ? 'selected' : "" ?>>Enable</option>
                                            <option value="0" <?php echo (isset($vendor['status']) && $vendor['status'] == 0) ? 'selected' : "" ?>>Disable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <?php 
                                if (isset($_GET['req_vendor_id'])){
                            ?>        
                                    <input type="hidden" name="req_vendor_id" value="<?php echo $_GET['req_vendor_id']; ?>">
                            <?php        
                                }
                                if (isset($_GET['req_id'])){
                            ?>        
                                    <input type="hidden" name="req_id" value="<?php echo $_GET['req_id']; ?>">
                            <?php        
                                }
                            ?>
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
    init_selectpicker();

    function get_city_by_state(state_id) {
        var html = '<option value=""></option>';
        
        if(state_id == "") {
            $("#city_id").html('').html(html);
            $('.selectpicker').selectpicker('refresh');
            return false;
        }
        
        $.ajax({
            url : admin_url+'vendor/get_cities_by_state_id/' + state_id,
            method : 'GET',
            success(res) {
                if(res != "") {
                    var resArr = $.parseJSON(res);
                    
                    $.each(resArr, function(k, v) {
                        html+= '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                }
                $("#city_id").html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
    
    $('.onlynumbers').keypress(function(event){



       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){

           event.preventDefault(); //stop character from entering input

       }



   });

    $(function() { 
        $('#contact_number').on('keypress', function(e) {
          $('span.error-keyup-4').remove();
            if (e.which == 32){
              $("#phonenumberdiv0").html('<span class="error error-keyup-4" style="color: red;">Space not allowed</span>');
                console.log('Space Detected');
                return false;
            }
        });
});

var validateEmail = function(elementValue) {
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return emailPattern.test(elementValue);
}
$('#email').keyup(function() {

    var value = $(this).val();
    var valid = validateEmail(value);

    if (!valid) {


        $(this).css('color', 'red');

    } else {


        $(this).css('color', '#000');

    }



});
</script>
</body>
</html>
