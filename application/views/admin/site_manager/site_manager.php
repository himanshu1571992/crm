<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'site_manager-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            
                            <div class="col-md-12">
                                <h3><?php
                                    if (isset($site_manager['id']))
                                        echo _l('edit_site');
                                    else
                                        echo _l('add_site');
                                    ?></h3>
                                <hr/>
                            </div>
                            
                            <div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="control-label"><?php echo _l('site_name'); ?> *</label>
                                        <input type="text" id="name" name="name" class="form-control" value="<?php echo (isset($site_manager['name']) && $site_manager['name'] != "") ? $site_manager['name'] : "" ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location" class="control-label"><?php echo _l('site_location'); ?> *</label>
                                        <input type="text" id="location" name="location" class="form-control" value="<?php echo (isset($site_manager['location']) && $site_manager['location'] != "") ? $site_manager['location'] : "" ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="control-label"><?php echo _l('site_description'); ?></label>
                                    <textarea id="description" name="description" class="form-control"><?php echo (isset($site_manager['description']) && $site_manager['description'] != "") ? $site_manager['description'] : "" ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address" class="control-label"><?php echo _l('site_address'); ?> *</label>
                                    <textarea id="address" name="address" onkeyup="countChar(this)" class="form-control site_address" ><?php echo (isset($site_manager['address']) && $site_manager['address'] != "") ? $site_manager['address'] : "" ?></textarea>
                                    <div class="wordcount text-danger"></div>
                                </div>
                                
                            </div>
                            
                            <div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state_id" class="control-label"><?php echo _l('site_state'); ?></label>
                                        <select class="form-control selectpicker" id="state_id" name="state_id" onchange="get_city_by_state(this.value)" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                            if (isset($state_data) && count($state_data) > 0) {
                                                foreach ($state_data as $state_key => $state_value) {
                                                    ?>
                                                    <option value="<?php echo $state_value['id'] ?>" <?php echo (isset($site_manager['state_id']) && $site_manager['state_id'] == $state_value['id']) ? 'selected' : "" ?>><?php echo cc($state_value['name']); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city_id" class="control-label"><?php echo _l('site_city'); ?></label>
                                        <select class="form-control selectpicker" id="city_id" name="city_id" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                            if (isset($city_data) && count($city_data) > 0) {
                                                foreach ($city_data as $city_key => $city_value) {
                                                    ?>
                                                    <option value="<?php echo $city_value['id'] ?>" <?php echo (isset($site_manager['city_id']) && $site_manager['city_id'] == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
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
                                        <label for="landmark" class="control-label"><?php echo _l('site_landmark'); ?></label>
                                        <input type="text" id="landmark" name="landmark" class="form-control" value="<?php echo (isset($site_manager['landmark']) && $site_manager['landmark'] != "") ? $site_manager['landmark'] : "" ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pincode" class="control-label"><?php echo _l('site_pincode'); ?> *</label>
                                        <input type="text" id="location" name="pincode" class="form-control" value="<?php echo (isset($site_manager['pincode']) && $site_manager['pincode'] != "") ? $site_manager['pincode'] : "" ?>">
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
            url : admin_url+'site_manager/get_cities_by_state_id/' + state_id,
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
    var alertcount = 0;
    function countChar(val){
        var len = val.value.length;
        if (len == 0){
            alertcount = 0;
        }
        if (len >= 100 && alertcount <= 0) {
            swal("Please Add (-) Before Word", "", "info");
            ++alertcount;
        }
        $(".wordcount").text(len+" characters");
    };

</script>
</body>
</html>
