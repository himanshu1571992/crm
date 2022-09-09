<?php init_head(); ?>
<style>.error{border:1px solid red !important;}.mrg3{margin-bottom: 3%;margin-top: 3% !important;}table.items tr.main td {padding-top: 8px !important;padding-bottom: 8px !important;}</style>
<div id="wrapper">
    <div class="content">
   <div class="row">
      <div class="col-md-12">
      </div>
<!--      <div class="btn-bottom-toolbar btn-toolbar-container-out text-right">
         <button class="btn btn-info only-save customer-form-submiter">Save</button>
      </div>-->
      
      <div class="col-md-12">
          <?php
            $temp = 1;                                            
            if (empty($check_mail)){
                $temp = 0;
                echo '<div class="alert alert-danger" role="alert">Client Enquiry Form templete not found for send mail to client.</div>';
            }
          ?>
         <div class="panel_s">
            <div class="panel-body">
                
               <div>
                  <div class="tab-content">
                      <h4 class="customer-profile-group-heading"><?php echo isset($title) ? $title: "";?> <div class="pull-right"><input type="checkbox" id="selectAll"> Check All</div></h4>
                      <?php echo form_open($this->uri->uri_string(), array('id' => 'enquirycall-form', 'class' => 'enquirycall-form')); ?>
                        <div class="col-md-12">
                            <div class="row">
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="lead_type" class="control-label">Lead Type</label>
                                        <select class="form-control selectpicker" id="lead_type" name="lead_type" disabled="" data-live-search="true">
                                            <option value=""></option>
                                            <option value="1" <?php echo (isset($enquirycall_info)) ? ($enquirycall_info->lead_type == 1) ? "selected=''": "": ""; ?>>Verified</option>
                                            <option value="2" <?php echo (isset($enquirycall_info)) ? ($enquirycall_info->lead_type == 2) ? "selected=''": "": ""; ?>>Unverified</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="calltype_id" class="control-label">Call Type</label>
                                        <select class="form-control selectpicker" id="call_type" name="call_type" disabled="" data-live-search="true">
                                            <option value=""></option>
                                            <option value="1" <?php echo (isset($enquirycall_info)) ? ($enquirycall_info->call_type == 1) ? "selected=''": "": ""; ?>>Incoming</option>
                                            <option value="2" <?php echo (isset($enquirycall_info)) ? ($enquirycall_info->call_type == 2) ? "selected=''": "": ""; ?>>Outgoing</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="service_type_id" class="control-label">Service Type <input type="checkbox" class="clientfields" style="margin-left: 10px" name="clientfields[service_type]" ></label>
                                        <select class="form-control selectpicker" id="service_type" name="service_type" disabled="" data-live-search="true">
                                            <option value=""></option>
                                            <option value="1" <?php echo (isset($enquirycall_info)) ? ($enquirycall_info->service_type == 1) ? "selected=''": "": ""; ?>>Rent</option>
                                            <option value="2" <?php echo (isset($enquirycall_info)) ? ($enquirycall_info->service_type == 2) ? "selected=''": "": ""; ?>>Sales</option>
                                            <option value="3" <?php echo (isset($enquirycall_info)) ? ($enquirycall_info->service_type == 3) ? "selected=''": "": ""; ?>>Both (rent & sales)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group rent_duration">
                                        <?php if(isset($enquirycall_info) && $enquirycall_info->duration > 0){ ?>
                                        <label for="rent_duration" class="control-label">Duration (In Months) <input type="checkbox" class="clientfields" style="margin-left: 10px" name="clientfields[duration]" ></label></label><input type="number" disabled="" min="1" max="12" id="duration" value="<?php echo $enquirycall_info->duration; ?>" class="form-control" name="duration">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                            if ($enquirycall_info->clientid > 0){
                                                $company_name = client_info($enquirycall_info->clientid)->client_branch_name;
                                            }else{
                                                $company_name = (!empty($enquirycall_info->company_name)) ? cc($enquirycall_info->company_name) : "--";
                                            }
                                        ?>
                                        <label for="company_name" class="control-label">Company Name <input style="margin-left: 10px" type="checkbox" class="clientfields" name="clientfields[company_name]"></label>
                                        <input type="text" id="company_name" class="form-control" disabled="" value="<?php echo $company_name; ?>" name="company_name" placeholder="company name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Contact Person Name" class="control-label">Contact Person Name <input style="margin-left: 10px" type="checkbox" class="clientfields" name="clientfields[contact_parson_name]"></label>
                                        <input type="text" id="contact_parson_name" class="form-control" disabled="" value="<?php echo (isset($enquirycall_info)) ? $enquirycall_info->person_name: ""; ?>" name="contact_parson_name" placeholder="contact parson name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email</label>
                                        <input type="email" id="email" class="form-control" required="" disabled="" name="email" value="<?php echo (isset($enquirycall_info)) ? $enquirycall_info->email: ""; ?>" placeholder="email">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Mobile" class="control-label">Contact Number <input style="margin-left: 10px" type="checkbox" class="clientfields" name="clientfields[mobile]"></label>
                                        <input type="text" id="mobile" class="form-control"  name="mobile" disabled="" value="<?php echo (isset($enquirycall_info) && $enquirycall_info->mobile > 0) ? $enquirycall_info->mobile: ""; ?>" placeholder="contact number">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="state" class="control-label">State <input style="margin-left: 10px" type="checkbox" class="clientfields" name="clientfields[state_id]"></label>
                                        <select class="form-control selectpicker" id="state_id" disabled="" name="state_id" data-live-search="true">
                                            <option value=""></option>
                                            <?php 
                                                if($states_list){
                                                    foreach ($states_list as $state) {
                                                        if (isset($enquirycall_info)){
                                                            $selected = ($enquirycall_info->state_id == $state->id) ? "selected=''": "";
                                                            echo '<option value="'.$state->id.'" '.$selected.' >'.$state->name.'</option>';
                                                        }else{
                                                            echo '<option value="'.$state->id.'">'.$state->name.'</option>';
                                                        }
                                                        
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="control-label">District <input style="margin-left: 10px" type="checkbox" class="clientfields" name="clientfields[city_id]"></label>
                                        <select class="form-control selectpicker" id="city_id" disabled="" name="city_id" data-live-search="true">
                                            <option value=""></option>
                                            <?php if (isset($enquirycall_info) && isset($cities_list)){ 
                                                    foreach ($cities_list as $city) {
                                                        $selected = ($city->id == $enquirycall_info->city_id) ? "selected": "";
                                                        echo '<option value="'.$city->id.'" '.$selected.' >'.$city->name.'</option>';
                                                    }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Address <input style="margin-left: 10px" type="checkbox" class="clientfields" name="clientfields[address]"></label>
                                        <textarea id="address" name="address" class="form-control" disabled="" placeholder="address..."><?php echo (isset($enquirycall_info)) ? $enquirycall_info->address: ""; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h3>Enquiry Questions</h3>
                            <hr>
                            <div class="row">
				<?php
                                    if (!empty($question_list)){
                                        foreach ($question_list as $value) {
//                                            $required = ($value->is_required == 1) ? 'required=""' : "";
                                            $required_cls = ($value->is_required == 1) ? '<span class="text-danger"> * </span>' : "";
                                            $size = $value->size;
                                            $exist = 0;
                                            if (isset($enquirycall_info)){
                                                $calldetails = $this->db->query("SELECT * from `tblenquirycall_details` WHERE `main_id` = ".$enquirycall_info->id." AND `question_id` = ".$value->id." ORDER BY `id` DESC")->row();
                                                switch ($value->type) {
                                                        case 1:
                                                            $ans = (!empty($calldetails)) ? $calldetails->answer : "";
                                                            echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                                    <label for="question" class="control-label">'.$value->question_order.') '.$value->question.$required_cls.'<input style="margin-left: 10px" type="checkbox" class="clientfields" name="clientfields['.$value->id.']"></label><div>
                                                                    <input type="text" disabled="" id="question['.$value->id.']" class="form-control" name="question['.$value->id.']" value="'.$ans.'"></div>
                                                                </div></div>';
                                                            break;
                                                        case 2:
                                                            $ans = (!empty($calldetails)) ? $calldetails->answer : "";
                                                            echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                                    <label for="question" class="control-label">'.$value->question_order.') '.$value->question.$required_cls.'<input style="margin-left: 10px" type="checkbox" class="clientfields" name="clientfields['.$value->id.']"></label><div>
                                                                    <textarea id="question['.$value->id.']" disabled="" name="question['.$value->id.']" rows="4" class="form-control">'.$ans.'</textarea></div>
                                                                </div></div>';
                                                            break;
                                                        case 3:
                                                            
                                                            $options = explode(",", $value->options);
                                                            echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                                    <label for="question" class="control-label">'.$value->question_order.') '.$value->question.$required_cls.'<input style="margin-left: 10px" type="checkbox" class="clientfields" name="clientfields['.$value->id.']"></label><div>
                                                                    <select class="form-control selectpicker" disabled="" id="question['.$value->id.']" name="question['.$value->id.']" data-live-search="true">
                                                                        <option value=""></option>';
                                                                            foreach ($options as $val) {
                                                                                if ((!empty($calldetails)) && $calldetails->answer == $val){
                                                                                    echo '<option value="'.$val.'" selected>'.$val.'</option>';
                                                                                }else{
                                                                                    echo '<option value="'.$val.'">'.$val.'</option>';
                                                                                }
                                                                            }
                                                            echo   '</select></div></div></div>';
                                                            break;
                                                        case 4:
                                                            
                                                            if (!empty($calldetails)) {
                                                                $options = explode(",", $value->options);
                                                                echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                                        <label for="question" class="control-label">'.$value->question_order.') '.$value->question.$required_cls.'<input style="margin-left: 10px" type="checkbox" class="clientfields" name="clientfields['.$value->id.']"></label><div>
                                                                        <select class="form-control selectpicker" disabled="" id="question['.$value->id.']" multiple="" name="question['.$value->id.'][]" data-live-search="true">
                                                                            <option value=""></option>';
                                                                                foreach ($options as $val) {
                                                                                    if (in_array($val, explode(",", $calldetails->answer))){
                                                                                        echo '<option value="'.$val.'" selected>'.$val.'</option>';
                                                                                    }else{
                                                                                        echo '<option value="'.$val.'">'.$val.'</option>';
                                                                                    }
                                                                                }
                                                                echo   '</select></div></div></div>';
                                                            }
                                                            else{
                                                                $options = explode(",", $value->options);
                                                                echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                                        <label for="question" class="control-label">'.$value->question_order.') '.$value->question.$required_cls.'<input style="margin-left: 10px" type="checkbox" class="clientfields" name="clientfields['.$value->id.']"></label><div>
                                                                        <select class="form-control selectpicker" disabled="" id="question['.$value->id.']" multiple="" name="question['.$value->id.'][]" data-live-search="true">
                                                                            <option value=""></option>';
                                                                                foreach ($options as $val) {
                                                                                    echo '<option value="'.$val.'">'.$val.'</option>';
                                                                                }
                                                                echo   '</select></div></div></div>';
                                                            }
                                                            break;    
                                                    }
                                                
                                            }
                                            
                                        }
                                    }
                                ?>						
			    </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <a href="javascript:void(0)" class="btn btn-info submit_btn">Send To Client</a>
<!--                                <button class="btn btn-info" type="submit">
                                        <?php echo _l('submit'); ?>
                                </button>-->
                        </div>
                      <?php echo form_close(); ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="btn-bottom-pusher"></div>
</div>
</div>
<?php init_tail(); ?>


<script type="text/javascript">
    
    $(document).on("click", ".submit_btn", function(){
//        var clientfield = $(".clientfields").val();

        var allChecked = true;
        var temp = "<?php echo $temp; ?>";
        var count = 0;
        $(".clientfields").each(function(index, element){
          if(element.checked){
            count++;
          } 
        });
        
        if (count > 0){
            if (temp > 0){
                $("#enquirycall-form").submit();
            }else{
                alert("Client Enquiry Form Template not found, Please added first and then do this process.");
            }
            
        }else{
            alert("Please check at least 1 field");
        }
    });
    
    $("#selectAll").click(function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
    });

</script>

</body>
</html>
